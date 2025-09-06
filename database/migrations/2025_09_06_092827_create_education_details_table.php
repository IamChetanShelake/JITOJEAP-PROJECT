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
        Schema::create('education_details', function (Blueprint $table) {
            $table->id();

            // Foreign key relationship
            $table->uuid('submission_id');

            // Previous Education Details (JSON field for dynamic table)
            $table->json('previous_education')->nullable();

            // Work Experience and Activities
            $table->text('extracurricular_activities')->nullable();
            $table->text('research_projects')->nullable();
            $table->decimal('work_experience_years', 4, 1)->nullable();
            $table->string('company_name')->nullable();
            $table->decimal('remuneration', 10, 2)->nullable();
            $table->decimal('ctc_yearly', 10, 2)->nullable();
            $table->text('work_profile')->nullable();

            // Current Education Details
            $table->string('course_name_current')->nullable();
            $table->string('pursuing_education')->nullable();
            $table->string('university_college_name')->nullable();
            $table->string('commencement_month_year')->nullable();
            $table->string('completion_month_year')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('qs_ranking_foreign')->nullable();
            $table->string('nirf_ranking_domestic')->nullable();

            // Form metadata
            $table->enum('form_status', ['draft', 'completed'])->default('draft');

            $table->timestamps();

            // Indexes and foreign key
            $table->index('submission_id');
            $table->foreign('submission_id')->references('submission_id')->on('financial_assistance')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_details');
    }
};
