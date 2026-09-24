<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployerRequestResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'organisation_name' => $this->organisation_name,
            'website' => $this->website,
            'industry' => $this->industry,
            'location' => $this->location,
            'contact_name' => $this->contact_name,
            'job_title' => $this->job_title,
            'email' => $this->email,
            'phone' => $this->phone,
            'support_types' => $this->support_types,
            'talent_areas' => $this->talent_areas,
            'roles' => $this->roles,
            'headcount' => $this->headcount,
            'timeline' => $this->timeline,
            'experience_level' => $this->experience_level,
            'work_arrangement' => $this->work_arrangement,
            'talent_location' => $this->talent_location,
            'role_description' => $this->role_description,
            'key_skills' => $this->key_skills,
            'has_jd' => $this->has_jd,
            'has_jd_file' => ! empty($this->jd_path),
            'jd_original_name' => $this->jd_original_name,
            'help_needed' => $this->help_needed,
            'anything_else' => $this->anything_else,
            'review_status' => $this->review_status,
            'admin_notes' => $this->admin_notes,
            'ip_address' => $this->ip_address,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
