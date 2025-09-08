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
        Schema::create('guarantor_details', function (Blueprint $table) {
            $table->id();

            // Foreign key relationship
            $table->uuid('submission_id');
            $table->foreign('submission_id')->references('submission_id')->on('financial_assistance')->onDelete('cascade');

            // First Guarantor Details
            $table->string('first_guarantor_name');
            $table->string('first_guarantor_mobile', 10);
            $table->string('first_guarantor_relation');
            $table->date('first_guarantor_dob');
            $table->enum('first_guarantor_gender', ['male', 'female', 'other']);
            $table->text('first_guarantor_permanent_address');
            $table->string('first_guarantor_phone')->nullable();
            $table->string('first_guarantor_pan', 10);
            $table->decimal('first_guarantor_income', 12, 2);
            $table->string('first_guarantor_email');
            $table->string('first_guarantor_aadhar', 12);
            $table->string('first_guarantor_business_name')->nullable();

            // Second Guarantor Details
            $table->string('second_guarantor_name');
            $table->string('second_guarantor_mobile', 10);
            $table->string('second_guarantor_relation');
            $table->date('second_guarantor_dob');
            $table->enum('second_guarantor_gender', ['male', 'female', 'other']);
            $table->text('second_guarantor_permanent_address');
            $table->string('second_guarantor_phone')->nullable();
            $table->string('second_guarantor_pan', 10);
            $table->decimal('second_guarantor_income', 12, 2);
            $table->string('second_guarantor_email');
            $table->string('second_guarantor_aadhar', 12);
            $table->string('second_guarantor_business_name')->nullable();

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
        Schema::dropIfExists('guarantor_details');
    }
};