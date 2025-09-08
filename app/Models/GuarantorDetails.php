<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuarantorDetails extends Model
{
    protected $fillable = [
        'submission_id',

        // First Guarantor Details
        'first_guarantor_name',
        'first_guarantor_mobile',
        'first_guarantor_relation',
        'first_guarantor_dob',
        'first_guarantor_gender',
        'first_guarantor_permanent_address',
        'first_guarantor_phone',
        'first_guarantor_pan',
        'first_guarantor_income',
        'first_guarantor_email',
        'first_guarantor_aadhar',
        'first_guarantor_business_name',

        // Second Guarantor Details
        'second_guarantor_name',
        'second_guarantor_mobile',
        'second_guarantor_relation',
        'second_guarantor_dob',
        'second_guarantor_gender',
        'second_guarantor_permanent_address',
        'second_guarantor_phone',
        'second_guarantor_pan',
        'second_guarantor_income',
        'second_guarantor_email',
        'second_guarantor_aadhar',
        'second_guarantor_business_name',

        'form_status',
    ];

    protected $casts = [
        'submission_id' => 'string',
        'first_guarantor_income' => 'decimal:2',
        'second_guarantor_income' => 'decimal:2',
        'first_guarantor_dob' => 'date',
        'second_guarantor_dob' => 'date',
    ];

    /**
     * Get the financial assistance record associated with this guarantor details.
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