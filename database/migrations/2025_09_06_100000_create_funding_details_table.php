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
        Schema::create('funding_details', function (Blueprint $table) {
            $table->id();

            // Foreign key relationship
            $table->uuid('submission_id');
            $table->foreign('submission_id')->references('submission_id')->on('financial_assistance')->onDelete('cascade');

            // Amount and Funding Information
            $table->string('amount_requested_years')->nullable();
            $table->decimal('tuition_fees_amount', 12, 2)->nullable();

            // Funding Details Table (JSON field for dynamic table)
            $table->json('funding_details_table')->nullable();

            // Previous Financial Assistance
            $table->boolean('family_received_assistance')->nullable();
            $table->string('ngo_name')->nullable();
            $table->string('loan_status')->nullable();
            $table->string('applied_year')->nullable();
            $table->decimal('applied_amount', 12, 2)->nullable();

            // Bank Account Details
            $table->string('student_name')->nullable();
            $table->string('student_account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->text('bank_address')->nullable();

            // Form metadata
            $table->enum('form_status', ['draft', 'completed', 'submitted'])->default('draft');

            $table->timestamps();

            // Indexes
            $table->index('submission_id');
            $table->index('form_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funding_details');
    }
};
