<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TalentApplicationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'city_state' => $this->city_state,
            'linkedin' => $this->linkedin,
            'portfolio' => $this->portfolio,
            'professional_status' => $this->professional_status,
            'experience_range' => $this->experience_range,
            'job_title' => $this->job_title,
            'industry' => $this->industry,
            'has_cv' => ! empty($this->cv_path),
            'cv_original_name' => $this->cv_original_name,
            'area_of_interest' => $this->area_of_interest,
            'specific_roles' => $this->specific_roles,
            'current_level' => $this->current_level,
            'skills' => $this->skills,
            'tools' => $this->tools,
            'proud_project' => $this->proud_project,
            'opportunity_type' => $this->opportunity_type,
            'work_arrangement' => $this->work_arrangement,
            'preferred_location' => $this->preferred_location,
            'skill_gap' => $this->skill_gap,
            'learning_goal' => $this->learning_goal,
            'hours_per_week' => $this->hours_per_week,
            'willing_assessment' => $this->willing_assessment,
            'willing_shared' => $this->willing_shared,
            'why_join' => $this->why_join,
            'strong_candidate' => $this->strong_candidate,
            'anything_else' => $this->anything_else,
            'applicant_name' => $this->applicant_name,
            'declaration_date' => $this->declaration_date?->toDateString(),
            'review_status' => $this->review_status,
            'admin_notes' => $this->admin_notes,
            'ip_address' => $this->ip_address,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
