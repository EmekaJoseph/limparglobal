<?php

namespace App\Http\Requests\EmployerRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployerRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Mirrors the required/optional fields of the Employer Talent & Workforce
     * Request Form in the frontend (app/components/forms/EmployerRequestForm.vue).
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // Section 1: Organisation
            'organisation_name' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],

            // Section 2: What Do You Need?
            'support_types' => ['required', 'array', 'min:1'],
            'support_types.*' => ['string', 'max:255'],
            'talent_areas' => ['required', 'array', 'min:1'],
            'talent_areas.*' => ['string', 'max:255'],

            // Section 3: Talent Requirement
            'roles' => ['required', 'string', 'max:255'],
            'headcount' => ['required', 'integer', 'min:1'],
            'timeline' => ['required', 'string', 'max:255'],
            'experience_level' => ['required', 'string', 'max:255'],
            'work_arrangement' => ['required', 'string', 'max:255'],
            'talent_location' => ['required', 'string', 'max:255'],

            // Section 4: What Are You Looking For?
            'role_description' => ['required', 'string'],
            'key_skills' => ['required', 'string'],
            'has_jd' => ['required', 'string', 'max:255'],
            'jd_file' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],

            // Section 5: How Can Limpar Help?
            'help_needed' => ['required', 'array', 'min:1'],
            'help_needed.*' => ['string', 'max:255'],
            'anything_else' => ['nullable', 'string'],

            'consent' => ['required', 'accepted'],
        ];
    }
}
