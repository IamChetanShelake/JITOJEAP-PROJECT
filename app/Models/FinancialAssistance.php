<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class FinancialAssistance extends Model
{
    use HasFactory;

    protected $table = 'financial_assistance';

    protected $fillable = [
        // Session and form tracking
        'submission_id',
        'current_step',
        'form_data',

        // Basic Information
        'applicant',
        'name',
        'request_date',
        'financial_asst_type',
        'financial_asst_for',
        'paid_amount',
        'outstanding_amount',
        'approve_date',
        'form_status',

        // Personal Details
        'aadhar_number',
        'date_of_birth',
        'birth_place',
        'student_first_name',
        'middle_name',
        'last_name',
        'marital_status',
        'native_place',
        'age',
        'nationality',
        'gender',
        'religion',
        'specially_abled',
        'blood_group',
        'student_email',
        'student_mobile',
        'pan_no',

        // Permanent Address
        'flat_no',
        'floor',
        'name_of_building',
        'area',
        'lane',
        'landmark',
        'pincode',
        'status',
        'city',
        'postal_address',
        'new_zone',
        'district',
        'chapter',

        // Correspondence Address
        'same_as_permanent',
        'corr_flat_no',
        'corr_floor',
        'corr_name_of_building',
        'corr_area',
        'corr_lane',
        'corr_landmark',
        'corr_pincode',
        'corr_status',
        'corr_city',
        'corr_postal_address',
        'corr_new_zone',
        'corr_district',
        'corr_chapter',
        'alternate_mail_id',
        'alternate_mobile',
    ];

    protected $casts = [
        'submission_id' => 'string',
        'current_step' => 'integer',
        'form_data' => 'array',
        'request_date' => 'date',
        'date_of_birth' => 'date',
        'approve_date' => 'date',
        'same_as_permanent' => 'boolean',
        'paid_amount' => 'decimal:2',
        'outstanding_amount' => 'decimal:2',
        'age' => 'integer',
    ];

    protected $dates = [
        'request_date',
        'date_of_birth',
        'approve_date',
        'created_at',
        'updated_at',
    ];

    // Accessor for full name
    public function getFullNameAttribute()
    {
        $fullName = trim($this->student_first_name . ' ' . $this->middle_name . ' ' . $this->last_name);
        return preg_replace('/\s+/', ' ', $fullName); // Remove extra spaces
    }

    // Accessor for full permanent address
    public function getFullPermanentAddressAttribute()
    {
        return implode(', ', array_filter([
            $this->flat_no,
            $this->floor,
            $this->name_of_building,
            $this->area,
            $this->lane,
            $this->landmark,
            $this->city,
            $this->district,
            $this->pincode
        ]));
    }

    // Accessor for full correspondence address
    public function getFullCorrespondenceAddressAttribute()
    {
        if ($this->same_as_permanent) {
            return $this->full_permanent_address;
        }

        return implode(', ', array_filter([
            $this->corr_flat_no,
            $this->corr_floor,
            $this->corr_name_of_building,
            $this->corr_area,
            $this->corr_lane,
            $this->corr_landmark,
            $this->corr_city,
            $this->corr_district,
            $this->corr_pincode
        ]));
    }

    // Scope for filtering by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('form_status', $status);
    }

    // Scope for filtering by chapter
    public function scopeByChapter($query, $chapter)
    {
        return $query->where('chapter', $chapter);
    }

    // Scope for recent applications
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Get the family details associated with this financial assistance.
     */
    public function familyDetails(): HasOne
    {
        return $this->hasOne(FamilyDetails::class, 'submission_id', 'submission_id');
    }

    /**
     * Get the education details associated with this financial assistance.
     */
    public function educationDetails(): HasOne
    {
        return $this->hasOne(EducationDetails::class, 'submission_id', 'submission_id');
    }

    /**
     * Scope for filtering by submission_id
     */
    public function scopeBySubmissionId($query, $submissionId)
    {
        return $query->where('submission_id', $submissionId);
    }

    /**
     * Generate a unique submission ID for this application
     */
    public static function generateSubmissionId(): string
    {
        return (string) Str::uuid();
    }

    /**
     * Boot method to auto-generate submission_id
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->submission_id)) {
                $model->submission_id = self::generateSubmissionId();
            }
        });
    }
}
