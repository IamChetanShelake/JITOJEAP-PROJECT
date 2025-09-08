<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'submission_id',
        'document_type',
        'file_path',
        'uploaded_at',
        'form_status',
    ];

    protected $casts = [
        'submission_id' => 'string',
        'uploaded_at' => 'datetime',
    ];

    /**
     * Get the financial assistance record associated with this document.
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