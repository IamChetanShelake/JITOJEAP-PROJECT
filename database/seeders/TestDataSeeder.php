<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use App\Models\EducationDetails;
use App\Models\FundingDetails;
use App\Models\GuarantorDetails;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test financial assistance application
        $application = FinancialAssistance::create([
            'submission_id' => 'TEST-' . time(),
            'current_step' => 5,
            'form_status' => 'submitted',
            'applicant' => 'Raj Kumar',
            'name' => 'Raj Kumar Sharma',
            'student_first_name' => 'Raj',
            'middle_name' => 'Kumar',
            'last_name' => 'Sharma',
            'request_date' => now(),
            'financial_asst_type' => 'Education',
            'financial_asst_for' => 'Higher Education',
            'aadhar_number' => '223456789012', // Changed to unique value
            'date_of_birth' => '1995-05-15',
            'birth_place' => 'Mumbai',
            'marital_status' => 'single',
            'native_place' => 'Delhi',
            'age' => 28,
            'nationality' => 'Indian',
            'gender' => 'male',
            'religion' => 'Hindu',
            'specially_abled' => 'no',
            'blood_group' => 'O+',
            'student_email' => 'raj.kumar3@example.com', // Changed to unique value
            'student_mobile' => '8876543210', // Changed to unique value
            'pan_no' => 'BCDEF1234G', // Changed to unique value
            'flat_no' => '101',
            'floor' => 'Ground',
            'name_of_building' => 'Sai Heights',
            'area' => 'Andheri West',
            'lane' => 'Main Road',
            'landmark' => 'Near Metro Station',
            'pincode' => '400058',
            'status' => 'Active',
            'city' => 'Mumbai',
            'postal_address' => 'Andheri West, Mumbai',
            'district' => 'Mumbai',
            'chapter' => 'Mumbai Chapter',
            'same_as_permanent' => true,
            'signature_type' => 'type',
            'signature_typed_name' => 'Raj Kumar',
            'signature_date' => now(),
        ]);

        // Create family details
        FamilyDetails::create([
            'submission_id' => $application->submission_id,
            'family_member_count' => 4,
            'total_family_members' => 4,
            'relation_student' => 'Father',
            'family_name' => 'Ramesh Sharma',
            'family_age' => 55,
            'marital_status' => 'married',
            'qualification' => 'Graduate',
            'occupation' => 'Business',
            'mobile_number' => '8876543211', // Changed to unique value
            'email_id' => 'ramesh.sharma3@example.com', // Changed to unique value
            'yearly_gross_income' => 800000,
            'insurance_coverage' => 500000,
            'premium_paid' => 25000,
            'total_student' => 1,
            'total_family_income' => 800000,
            'family_member_diksha' => 'No',
            'total_insurance_coverage' => 500000,
            'total_premium_paid' => 25000,
        ]);

        // Create education details
        EducationDetails::create([
            'submission_id' => $application->submission_id,
            'previous_education' => json_encode([
                [
                    'exam_name' => '10th Standard',
                    'course_name' => 'SSC',
                    'exam_month' => 'March',
                    'exam_year' => '2010',
                    'out_of_marks' => 100,
                    'marks_obtained' => 85,
                    'percentage' => 85
                ],
                [
                    'exam_name' => '12th Standard',
                    'course_name' => 'HSC',
                    'exam_month' => 'March',
                    'exam_year' => '2012',
                    'out_of_marks' => 100,
                    'marks_obtained' => 78,
                    'percentage' => 78
                ]
            ]),
            'extracurricular_activities' => 'Cricket, Music',
            'research_projects' => 'None',
            'work_experience_years' => 2,
            'company_name' => 'Tech Solutions Pvt Ltd',
            'remuneration' => 40000,
            'ctc_yearly' => 480000,
            'work_profile' => 'Software Developer',
            'course_name_current' => 'MBA',
            'pursuing_education' => 'Full Time',
            'university_college_name' => 'IIM Ahmedabad',
            'commencement_month_year' => 'July 2023',
            'completion_month_year' => 'May 2025',
            'city' => 'Ahmedabad',
            'country' => 'India',
            'qs_ranking_foreign' => 'N/A',
            'nirf_ranking_domestic' => '1',
        ]);

        // Create funding details
        FundingDetails::create([
            'submission_id' => $application->submission_id,
            'tuition_fees_amount' => 1000000,
            'funding_details_table' => json_encode([
                [
                    'particulars' => 'Own Family Funding',
                    'amount' => 300000
                ],
                [
                    'particulars' => 'Scholarship from Institute',
                    'amount' => 200000
                ],
                [
                    'particulars' => 'Bank Loan',
                    'amount' => 500000
                ]
            ]),
            'bank_name' => 'State Bank of India',
            'branch_name' => 'Mumbai Main Branch',
            'student_account_number' => '223456789012', // Changed to unique value
            'ifsc_code' => 'SBIN0002499',
        ]);

        // Create guarantor details
        GuarantorDetails::create([
            'submission_id' => $application->submission_id,
            'first_guarantor_name' => 'Suresh Sharma',
            'first_guarantor_mobile' => '8876543212', // Changed to unique value
            'first_guarantor_relation' => 'Father',
            'first_guarantor_dob' => '1970-01-01',
            'first_guarantor_gender' => 'male',
            'first_guarantor_permanent_address' => '101, Sai Heights, Andheri West, Mumbai',
            'first_guarantor_phone' => '022-22345678', // Changed to unique value
            'first_guarantor_pan' => 'FGHIJ5678K',
            'first_guarantor_income' => 800000,
            'first_guarantor_email' => 'suresh.sharma3@example.com', // Changed to unique value
            'first_guarantor_aadhar' => '223456789013', // Changed to unique value
            'first_guarantor_business_name' => 'Sharma Enterprises',
            'second_guarantor_name' => 'Priya Sharma',
            'second_guarantor_mobile' => '8876543213', // Changed to unique value
            'second_guarantor_relation' => 'Mother',
            'second_guarantor_dob' => '1972-05-10',
            'second_guarantor_gender' => 'female',
            'second_guarantor_permanent_address' => '101, Sai Heights, Andheri West, Mumbai',
            'second_guarantor_phone' => '022-22345679', // Changed to unique value
            'second_guarantor_pan' => 'LMNOP9012Q',
            'second_guarantor_income' => 600000,
            'second_guarantor_email' => 'priya.sharma3@example.com', // Changed to unique value
            'second_guarantor_aadhar' => '223456789014', // Changed to unique value
            'second_guarantor_business_name' => 'Priya Boutique',
            'form_status' => 'submitted',
        ]);
    }
}