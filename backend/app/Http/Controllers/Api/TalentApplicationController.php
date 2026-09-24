<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SendMessageRequest;
use App\Http\Requests\TalentApplications\StoreTalentApplicationRequest;
use App\Http\Resources\TalentApplicationResource;
use App\Mail\AdminMessageMail;
use App\Models\TalentApplication;
use App\Services\SubmissionNotifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class TalentApplicationController extends Controller
{
    /**
     * Store a new talent application. Public endpoint — called by the
     * Talent Application Form on the frontend.
     */
    public function store(StoreTalentApplicationRequest $request)
    {
        $data = $request->validated();

        $cv = $request->file('cv');
        $cvPath = $cv->store('cvs');

        $application = TalentApplication::query()->create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'city_state' => $data['city_state'],
            'linkedin' => $data['linkedin'],
            'portfolio' => $data['portfolio'] ?? null,
            'professional_status' => $data['status'],
            'experience_range' => $data['experience_range'],
            'job_title' => $data['job_title'],
            'industry' => $data['industry'],
            'cv_path' => $cvPath,
            'cv_original_name' => $cv->getClientOriginalName(),
            'area_of_interest' => $data['area_of_interest'],
            'specific_roles' => $data['specific_roles'],
            'current_level' => $data['current_level'],
            'skills' => array_values($data['skills']),
            'tools' => $data['tools'],
            'proud_project' => $data['proud_project'],
            'opportunity_type' => $data['opportunity_type'],
            'work_arrangement' => $data['work_arrangement'],
            'preferred_location' => $data['preferred_location'],
            'skill_gap' => $data['skill_gap'],
            'learning_goal' => $data['learning_goal'],
            'hours_per_week' => $data['hours_per_week'],
            'willing_assessment' => $data['willing_assessment'],
            'willing_shared' => $data['willing_shared'],
            'why_join' => $data['why_join'],
            'strong_candidate' => $data['strong_candidate'],
            'anything_else' => $data['anything_else'] ?? null,
            'agree' => true,
            'applicant_name' => $data['applicant_name'],
            'declaration_date' => $data['date'],
            'ip_address' => $request->ip(),
        ]);

        app(SubmissionNotifier::class)->talentApplicationSubmitted($application);

        return response()->json(['message' => 'Application received.'], 201);
    }

    /**
     * List talent applications. Admin-only.
     */
    public function index(Request $request)
    {
        $query = TalentApplication::query()->latest();

        if ($request->filled('status')) {
            $query->where('review_status', $request->string('status'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('area_of_interest', 'like', "%{$search}%");
            });
        }

        return TalentApplicationResource::collection($query->paginate(20));
    }

    /**
     * Show a single talent application. Admin-only.
     */
    public function show(TalentApplication $talentApplication)
    {
        return new TalentApplicationResource($talentApplication);
    }

    /**
     * Update the review status / admin notes for a talent application. Admin-only.
     */
    public function update(Request $request, TalentApplication $talentApplication)
    {
        $data = $request->validate([
            'review_status' => ['sometimes', Rule::in(['new', 'contacted', 'shortlisted', 'rejected'])],
            'admin_notes' => ['sometimes', 'nullable', 'string'],
        ]);

        $talentApplication->update($data);

        return new TalentApplicationResource($talentApplication);
    }

    /**
     * Delete a talent application (and its uploaded CV). Admin-only.
     */
    public function destroy(TalentApplication $talentApplication)
    {
        if ($talentApplication->cv_path) {
            Storage::delete($talentApplication->cv_path);
        }

        $talentApplication->delete();

        return response()->json(['message' => 'Application deleted.']);
    }

    /**
     * Download the applicant's CV. Admin-only.
     */
    public function downloadCv(TalentApplication $talentApplication)
    {
        abort_unless($talentApplication->cv_path && Storage::exists($talentApplication->cv_path), 404);

        return Storage::download(
            $talentApplication->cv_path,
            $talentApplication->cv_original_name ?? 'cv.pdf'
        );
    }

    /**
     * Send a one-off email to the applicant from the admin dashboard.
     * Unlike the automatic notifications, this is a deliberate admin action —
     * if it fails, the admin should be told so they can retry.
     */
    public function sendMessage(SendMessageRequest $request, TalentApplication $talentApplication)
    {
        $admin = $request->user();

        try {
            Mail::to($talentApplication->email)->send(new AdminMessageMail(
                recipientName: $talentApplication->full_name,
                subjectLine: $request->validated('subject'),
                bodyText: $request->validated('message'),
                adminName: $admin->name,
                adminEmail: $admin->email,
            ));
        } catch (Throwable $e) {
            Log::error('Admin message email failed to send: '.$e->getMessage());

            return response()->json(['message' => 'Could not send the email. Please try again.'], 502);
        }

        return response()->json(['message' => 'Email sent.']);
    }
}
