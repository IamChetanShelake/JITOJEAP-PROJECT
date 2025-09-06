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
        Schema::create('family_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('submission_id');

            // Family member count
            $table->integer('family_member_count')->default(0);
            $table->integer('total_family_members')->nullable();

            // Individual family member details
            $table->string('relation_student')->nullable();
            $table->string('family_name')->nullable();
            $table->integer('family_age')->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->string('qualification')->nullable();
            $table->string('occupation')->nullable();
            $table->string('mobile_number', 10)->nullable();
            $table->string('email_id')->nullable();
            $table->decimal('yearly_gross_income', 15, 2)->nullable();
            $table->decimal('insurance_coverage', 15, 2)->nullable();
            $table->decimal('premium_paid', 15, 2)->nullable();

            // Family summary details
            $table->integer('total_student')->nullable();
            $table->decimal('total_family_income', 15, 2)->nullable();
            $table->string('family_member_diksha')->nullable();
            $table->decimal('total_insurance_coverage', 15, 2)->nullable();
            $table->decimal('total_premium_paid', 15, 2)->nullable();

            // Family contact details - Parental Uncle
            $table->string('parental_uncle_name')->nullable();
            $table->string('parental_uncle_mobile', 10)->nullable();
            $table->string('parental_uncle_email')->nullable();

            // Family contact details - Maternal Uncle
            $table->string('maternal_uncle_name')->nullable();
            $table->string('maternal_uncle_mobile', 10)->nullable();
            $table->string('maternal_uncle_email')->nullable();

            // Family contact details - Parental Aunty
            $table->string('parental_aunty_name')->nullable();
            $table->string('parental_aunty_mobile', 10)->nullable();
            $table->string('parental_aunty_email')->nullable();

            // Family contact details - Maternal Aunty
            $table->string('maternal_aunty_name')->nullable();
            $table->string('maternal_aunty_mobile', 10)->nullable();
            $table->string('maternal_aunty_email')->nullable();

            // Form metadata
            $table->enum('form_status', ['draft', 'completed'])->default('draft');

            $table->timestamps();

            // Indexes
            $table->index('submission_id');
            $table->foreign('submission_id')->references('submission_id')->on('financial_assistance')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_details');
    }
};
