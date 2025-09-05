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
        Schema::create('financial_assistance', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('applicant');
            $table->string('name');
            $table->date('request_date');
            $table->string('financial_asst_type');
            $table->string('financial_asst_for');
            $table->decimal('paid_amount', 15, 2)->nullable();
            $table->decimal('outstanding_amount', 15, 2)->nullable();
            $table->date('approve_date')->nullable();
            $table->enum('form_status', ['draft', 'submitted', 'under_review', 'approved', 'rejected'])->default('draft');
            
            // Personal Details
            $table->string('aadhar_number', 12)->unique();
            $table->date('date_of_birth');
            $table->string('birth_place');
            $table->string('student_first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->string('native_place');
            $table->integer('age');
            $table->string('nationality', 100)->default('Indian');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('religion', 100);
            $table->enum('specially_abled', ['yes', 'no'])->default('no');
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->string('student_email')->unique();
            $table->string('student_mobile', 10);
            $table->string('pan_no', 10)->nullable();
            
            // Permanent Address
            $table->string('flat_no', 50);
            $table->string('floor', 50);
            $table->string('name_of_building');
            $table->string('area');
            $table->string('lane');
            $table->string('landmark');
            $table->string('pincode', 6);
            $table->string('status', 100);
            $table->string('city', 100);
            $table->text('postal_address');
            $table->string('new_zone', 100)->nullable();
            $table->string('district', 100);
            $table->string('chapter');
            
            // Correspondence Address
            $table->boolean('same_as_permanent')->default(false);
            $table->string('corr_flat_no', 50)->nullable();
            $table->string('corr_floor', 50)->nullable();
            $table->string('corr_name_of_building')->nullable();
            $table->string('corr_area')->nullable();
            $table->string('corr_lane')->nullable();
            $table->string('corr_landmark')->nullable();
            $table->string('corr_pincode', 6)->nullable();
            $table->string('corr_status', 100)->nullable();
            $table->string('corr_city', 100)->nullable();
            $table->text('corr_postal_address')->nullable();
            $table->string('corr_new_zone', 100)->nullable();
            $table->string('corr_district', 100)->nullable();
            $table->string('corr_chapter')->nullable();
            $table->string('alternate_mail_id')->nullable();
            $table->string('alternate_mobile', 10)->nullable();
            
            // Indexes for better performance
            $table->index(['aadhar_number', 'student_email']);
            $table->index(['form_status', 'created_at']);
            $table->index('request_date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_assistance');
    }
};
