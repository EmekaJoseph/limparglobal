<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployerRequests\StoreEmployerRequestRequest;
use App\Http\Resources\EmployerRequestResource;
use App\Models\EmployerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployerRequestController extends Controller
{
    /**
     * Store a new employer workforce request. Public endpoint — called by
     * the Employer Talent & Workforce Request Form on the frontend.
     */
    public function store(StoreEmployerRequestRequest $request)
    {
        $data = $request->validated();

        $jdFile = $request->file('jd_file');
        $jdPath = $jdFile?->store('job-descriptions');

        EmployerRequest::query()->create([
            'organisation_name' => $data['organisation_name'],
            'website' => $data['website'],
            'industry' => $data['industry'],
            'location' => $data['location'],
            'contact_name' => $data['contact_name'],
            'job_title' => $data['job_title'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'support_types' => array_values($data['support_types']),
            'talent_areas' => array_values($data['talent_areas']),
            'roles' => $data['roles'],
            'headcount' => $data['headcount'],
            'timeline' => $data['timeline'],
            'experience_level' => $data['experience_level'],
            'work_arrangement' => $data['work_arrangement'],
            'talent_location' => $data['talent_location'],
            'role_description' => $data['role_description'],
            'key_skills' => $data['key_skills'],
            'has_jd' => $data['has_jd'],
            'jd_path' => $jdPath,
            'jd_original_name' => $jdFile?->getClientOriginalName(),
            'help_needed' => array_values($data['help_needed']),
            'anything_else' => $data['anything_else'] ?? null,
            'consent' => true,
            'ip_address' => $request->ip(),
        ]);

        return response()->json(['message' => 'Request received.'], 201);
    }

    /**
     * List employer requests. Admin-only.
     */
    public function index(Request $request)
    {
        $query = EmployerRequest::query()->latest();

        if ($request->filled('status')) {
            $query->where('review_status', $request->string('status'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('organisation_name', 'like', "%{$search}%")
                    ->orWhere('contact_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return EmployerRequestResource::collection($query->paginate(20));
    }

    /**
     * Show a single employer request. Admin-only.
     */
    public function show(EmployerRequest $employerRequest)
    {
        return new EmployerRequestResource($employerRequest);
    }

    /**
     * Update the review status / admin notes for an employer request. Admin-only.
     */
    public function update(Request $request, EmployerRequest $employerRequest)
    {
        $data = $request->validate([
            'review_status' => ['sometimes', Rule::in(['new', 'contacted', 'in_progress', 'closed'])],
            'admin_notes' => ['sometimes', 'nullable', 'string'],
        ]);

        $employerRequest->update($data);

        return new EmployerRequestResource($employerRequest);
    }

    /**
     * Delete an employer request (and its uploaded job description). Admin-only.
     */
    public function destroy(EmployerRequest $employerRequest)
    {
        if ($employerRequest->jd_path) {
            Storage::delete($employerRequest->jd_path);
        }

        $employerRequest->delete();

        return response()->json(['message' => 'Request deleted.']);
    }

    /**
     * Download the attached job description. Admin-only.
     */
    public function downloadJd(EmployerRequest $employerRequest)
    {
        abort_unless($employerRequest->jd_path && Storage::exists($employerRequest->jd_path), 404);

        return Storage::download(
            $employerRequest->jd_path,
            $employerRequest->jd_original_name ?? 'job-description.pdf'
        );
    }
}
