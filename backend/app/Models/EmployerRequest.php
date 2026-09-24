<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'organisation_name', 'website', 'industry', 'location', 'contact_name', 'job_title', 'email', 'phone',
    'support_types', 'talent_areas',
    'roles', 'headcount', 'timeline', 'experience_level', 'work_arrangement', 'talent_location',
    'role_description', 'key_skills', 'has_jd', 'jd_path', 'jd_original_name',
    'help_needed', 'anything_else', 'consent',
    'review_status', 'admin_notes', 'ip_address',
])]
class EmployerRequest extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'support_types' => 'array',
            'talent_areas' => 'array',
            'help_needed' => 'array',
            'consent' => 'boolean',
            'headcount' => 'integer',
        ];
    }
}
