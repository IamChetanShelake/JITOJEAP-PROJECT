<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyDetails extends Model
{
    use HasFactory;

    protected $table = 'family_details';

    protected $fillable = [
        'submission_id',
        'family_member_count',
        'total_family_members',

        // Individual family member details
        'relation_student',
        'family_name',
        'family_age',
        'marital_status',
        'qualification',
        'occupation',
        'mobile_number',
        'email_id',
        'yearly_gross_income',
        'insurance_coverage',
        'premium_paid',

        // Family summary details
        'total_student',
        'total_family_income',
        'family_member_diksha',
        'total_insurance_coverage',
        'total_premium_paid',

        // Family contact details - Parental Uncle
        'parental_uncle_name',
        'parental_uncle_mobile',
        'parental_uncle_email',

        // Family contact details - Maternal Uncle
        'maternal_uncle_name',
        'maternal_uncle_mobile',
        'maternal_uncle_email',

        // Family contact details - Parental Aunty
        'parental_aunty_name',
        'parental_aunty_mobile',
        'parental_aunty_email',

        // Family contact details - Maternal Aunty
        'maternal_aunty_name',
        'maternal_aunty_mobile',
        'maternal_aunty_email',

        'form_status',
    ];

    protected $casts = [
        'submission_id' => 'string',
        'family_member_count' => 'integer',
        'total_family_members' => 'integer',
        'family_age' => 'integer',
        'total_student' => 'integer',
        'yearly_gross_income' => 'decimal:2',
        'insurance_coverage' => 'decimal:2',
        'premium_paid' => 'decimal:2',
        'total_family_income' => 'decimal:2',
        'total_insurance_coverage' => 'decimal:2',
        'total_premium_paid' => 'decimal:2',
    ];

    /**
     * Get the financial assistance record associated with this family details.
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
