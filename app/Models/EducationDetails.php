<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationDetails extends Model
{
    protected $fillable = [
        'submission_id',

        // Previous Education Details (JSON)
        'previous_education',

        // Work Experience and Activities
        'extracurricular_activities',
        'research_projects',
        'work_experience_years',
        'company_name',
        'remuneration',
        'ctc_yearly',
        'work_profile',

        // Current Education Details
        'course_name_current',
        'pursuing_education',
        'university_college_name',
        'commencement_month_year',
        'completion_month_year',
        'city',
        'country',
        'qs_ranking_foreign',
        'nirf_ranking_domestic',

        'form_status',
    ];

    protected $casts = [
        'submission_id' => 'string',
        'previous_education' => 'array',
        'work_experience_years' => 'decimal:1',
        'remuneration' => 'decimal:2',
        'ctc_yearly' => 'decimal:2',
    ];

    /**
     * Get the financial assistance record associated with this education details.
     */
    public function financialAssistance(): BelongsTo
    {
        return $this->belongsTo(FinancialAssistance::class, 'submission_id', 'submission_id');
    }

    /**
     * Scope for filtering by submission_id
     */
    public function scopeBySubmissionId($query, $submissionId)
    {
        return $query->where('submission_id', $submissionId);
    }

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('form_status', $status);
    }
}
