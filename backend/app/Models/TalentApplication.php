<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'full_name', 'email', 'phone', 'country', 'city_state', 'linkedin', 'portfolio',
    'professional_status', 'experience_range', 'job_title', 'industry', 'cv_path', 'cv_original_name',
    'area_of_interest', 'specific_roles', 'current_level',
    'skills', 'tools', 'proud_project', 'opportunity_type', 'work_arrangement', 'preferred_location',
    'skill_gap', 'learning_goal', 'hours_per_week',
    'willing_assessment', 'willing_shared',
    'why_join', 'strong_candidate', 'anything_else',
    'agree', 'applicant_name', 'declaration_date',
    'review_status', 'admin_notes', 'ip_address',
])]
class TalentApplication extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'agree' => 'boolean',
            'declaration_date' => 'date',
        ];
    }
}
