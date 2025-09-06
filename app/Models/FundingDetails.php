<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FundingDetails extends Model
{
    protected $fillable = [
        'submission_id',

        // Amount and Funding Information
        'amount_requested_years',
        'tuition_fees_amount',

        // Funding Details Table (JSON)
        'funding_details_table',

        // Previous Financial Assistance
        'family_received_assistance',
        'ngo_name',
        'loan_status',
        'applied_year',
        'applied_amount',

        // Bank Account Details
        'student_name',
        'student_account_number',
        'ifsc_code',
        'bank_name',
        'branch_name',
        'bank_address',

        'form_status',
    ];

    protected $casts = [
        'submission_id' => 'string',
        'funding_details_table' => 'array',
        'tuition_fees_amount' => 'decimal:2',
        'applied_amount' => 'decimal:2',
    ];

    /**
     * Get the financial assistance record associated with this funding details.
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
