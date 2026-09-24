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
        Schema::create('employer_requests', function (Blueprint $table) {
            $table->id();

            // Section 1: Organisation
            $table->string('organisation_name')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->string('location')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            // Section 2: What Do You Need?
            $table->json('support_types')->nullable();
            $table->json('talent_areas')->nullable();

            // Section 3: Talent Requirement
            $table->string('roles')->nullable();
            $table->unsignedInteger('headcount')->nullable();
            $table->string('timeline')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('work_arrangement')->nullable();
            $table->string('talent_location')->nullable();

            // Section 4: What Are You Looking For?
            $table->text('role_description')->nullable();
            $table->text('key_skills')->nullable();
            $table->string('has_jd')->nullable();
            $table->string('jd_path')->nullable();
            $table->string('jd_original_name')->nullable();

            // Section 5: How Can Limpar Help?
            $table->json('help_needed')->nullable();
            $table->text('anything_else')->nullable();

            $table->boolean('consent')->default(false);

            // Admin-managed review workflow
            $table->string('review_status')->default('new'); // new, contacted, in_progress, closed
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
        Schema::dropIfExists('employer_requests');
    }
};
