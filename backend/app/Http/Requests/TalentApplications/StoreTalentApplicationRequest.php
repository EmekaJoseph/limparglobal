<?php

namespace App\Http\Requests\TalentApplications;

use Illuminate\Foundation\Http\FormRequest;

class StoreTalentApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Mirrors the required/optional fields of the Talent Application Form
     * in the frontend (app/components/forms/TalentApplicationForm.vue).
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // Section 1: Personal Information
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'country' => ['required', 'string', 'max:255'],
            'city_state' => ['required', 'string', 'max:255'],
            'linkedin' => ['required', 'string', 'max:255'],
            'portfolio' => ['nullable', 'string', 'max:255'],

            // Section 2: Professional Profile
            'status' => ['required', 'string', 'max:255'],
            'experience_range' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string', 'max:255'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],

            // Section 3: Area of Interest
            'area_of_interest' => ['required', 'string', 'max:255'],
            'specific_roles' => ['required', 'string', 'max:500'],
            'current_level' => ['required', 'string', 'max:255'],

            // Section 4: Skills & Experience
            'skills' => ['required', 'array', 'size:5'],
            'skills.*' => ['required', 'string', 'max:255'],
            'tools' => ['required', 'string'],
            'proud_project' => ['required', 'string'],
            'opportunity_type' => ['required', 'string', 'max:255'],
            'work_arrangement' => ['required', 'string', 'max:255'],
            'preferred_location' => ['required', 'string', 'max:255'],

            // Section 5: Learning & Development
            'skill_gap' => ['required', 'string'],
            'learning_goal' => ['required', 'string', 'max:255'],
            'hours_per_week' => ['required', 'string', 'max:255'],

            // Section 6: Assessment & Verification
            'willing_assessment' => ['required', 'string', 'max:10'],
            'willing_shared' => ['required', 'string', 'max:10'],

            // Section 7: Final Questions
            'why_join' => ['required', 'string'],
            'strong_candidate' => ['required', 'string'],
            'anything_else' => ['nullable', 'string'],

            // Declaration & Consent
            'agree' => ['required', 'accepted'],
            'applicant_name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ];
    }
}
