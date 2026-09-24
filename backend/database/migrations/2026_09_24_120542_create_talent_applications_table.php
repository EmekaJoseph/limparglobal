<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('talent_applications', function (Blueprint $table) {
            $table->id();

            // Section 1: Personal Information
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city_state')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('portfolio')->nullable();

            // Section 2: Professional Profile
            $table->string('professional_status')->nullable(); // frontend field name: "status"
            $table->string('experience_range')->nullable();
            $table->string('job_title')->nullable();
            $table->string('industry')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('cv_original_name')->nullable();

            // Section 3: Area of Interest
            $table->string('area_of_interest')->nullable();
            $table->string('specific_roles')->nullable();
            $table->string('current_level')->nullable();

            // Section 4: Skills & Experience
            $table->json('skills')->nullable();
            $table->text('tools')->nullable();
            $table->text('proud_project')->nullable();
            $table->string('opportunity_type')->nullable();
            $table->string('work_arrangement')->nullable();
            $table->string('preferred_location')->nullable();

            // Section 5: Learning & Development
            $table->text('skill_gap')->nullable();
            $table->string('learning_goal')->nullable();
            $table->string('hours_per_week')->nullable();

            // Section 6: Assessment & Verification
            $table->string('willing_assessment')->nullable();
            $table->string('willing_shared')->nullable();

            // Section 7: Final Questions
            $table->text('why_join')->nullable();
            $table->text('strong_candidate')->nullable();
            $table->text('anything_else')->nullable();

            // Declaration & Consent
            $table->boolean('agree')->default(false);
            $table->string('applicant_name')->nullable();
            $table->date('declaration_date')->nullable(); // frontend field name: "date"

            // Admin-managed review workflow
            $table->string('review_status')->default('new'); // new, contacted, shortlisted, rejected
            $table->text('admin_notes')->nullable();

            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_applications');
    }
};
