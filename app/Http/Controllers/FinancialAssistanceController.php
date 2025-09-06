<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use App\Models\EducationDetails;
use Illuminate\Support\Str;

class FinancialAssistanceController extends Controller
{
    public function index(Request $request)
    {
        // Check if there's an existing submission in progress
        $submissionId = $request->get('submission_id') ?? Session::get('submission_id');
        $existingData = null;

        if ($submissionId) {
            $existingData = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($existingData) {
                Session::put('submission_id', $submissionId);
            }
        }

        return view('financial-assistance', [
            'existingData' => $existingData,
            'submissionId' => $submissionId
        ]);
    }

    public function familyDetails(Request $request)
    {
        // Get submission ID from session or URL parameter
        $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

        if (!$submissionId) {
            return redirect()->route('financial-assistance')
                ->with('error', 'Please complete personal details first.');
        }

        // Check if personal details step is completed
        $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
        if (!$personalDetails || $personalDetails->current_step < 1) {
            return redirect()->route('financial-assistance')
                ->with('error', 'Please complete personal details first.');
        }

        // Get existing family details if any
        $existingData = FamilyDetails::bySubmissionId($submissionId)->first();

        return view('family-details', [
            'existingData' => $existingData,
            'submissionId' => $submissionId,
            'personalDetails' => $personalDetails
        ]);
    }

    public function educationDetails(Request $request)
    {
        // Get submission ID from session or URL parameter
        $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

        if (!$submissionId) {
            return redirect()->route('financial-assistance')
                ->with('error', 'Please complete previous steps first.');
        }

        // Check if family details step is completed
        $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
        $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();

        if (!$personalDetails || $personalDetails->current_step < 2) {
            return redirect()->route('family-details', ['submission_id' => $submissionId])
                ->with('error', 'Please complete family details first.');
        }

        // Get existing education details if any
        $existingData = EducationDetails::bySubmissionId($submissionId)->first();

        return view('education-details', [
            'existingData' => $existingData,
            'submissionId' => $submissionId,
            'personalDetails' => $personalDetails,
            'familyDetails' => $familyDetails
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Get or create submission ID
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            if (!$submissionId) {
                $submissionId = FinancialAssistance::generateSubmissionId();
                Session::put('submission_id', $submissionId);
            }
            // Validation rules as per Figma form requirements
            $validator = Validator::make($request->all(), [
                // Basic Information
                'applicant' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'request_date' => 'required|date',
                'financial_asst_type' => 'required|string',
                'financial_asst_for' => 'required|string|max:255',

                // Personal Details
                'aadhar_number' => 'required|string|size:12|regex:/^[0-9]{12}$/',
                'date_of_birth' => 'required|date|before:today',
                'birth_place' => 'required|string|max:255',
                'student_first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'marital_status' => 'required|in:single,married,divorced,widowed',
                'native_place' => 'required|string|max:255',
                'age' => 'required|integer|min:1|max:120',
                'nationality' => 'required|string|max:100',
                'gender' => 'required|in:male,female,other',
                'religion' => 'required|string|max:100',
                'specially_abled' => 'nullable|in:yes,no',
                'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'student_email' => 'required|email|max:255',
                'student_mobile' => 'required|string|regex:/^[0-9]{10}$/',
                'pan_no' => 'nullable|string|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',

                // Permanent Address
                'flat_no' => 'required|string|max:50',
                'floor' => 'required|string|max:50',
                'name_of_building' => 'required|string|max:255',
                'area' => 'required|string|max:255',
                'lane' => 'required|string|max:255',
                'landmark' => 'required|string|max:255',
                'pincode' => 'required|string|regex:/^[0-9]{6}$/',
                'status' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'postal_address' => 'required|string',
                'new_zone' => 'nullable|string|max:100',
                'district' => 'required|string|max:100',
                'chapter' => 'required|string',

                // Correspondence Address
                'same_as_permanent' => 'nullable|boolean',
                'corr_flat_no' => 'nullable|string|max:50',
                'corr_floor' => 'nullable|string|max:50',
                'corr_name_of_building' => 'nullable|string|max:255',
                'corr_area' => 'nullable|string|max:255',
                'corr_lane' => 'nullable|string|max:255',
                'corr_landmark' => 'nullable|string|max:255',
                'corr_pincode' => 'nullable|string|regex:/^[0-9]{6}$/',
                'corr_status' => 'nullable|string|max:100',
                'corr_city' => 'nullable|string|max:100',
                'corr_postal_address' => 'nullable|string',
                'corr_new_zone' => 'nullable|string|max:100',
                'corr_district' => 'nullable|string|max:100',
                'corr_chapter' => 'nullable|string',
                'alternate_mail_id' => 'nullable|email|max:255',
                'alternate_mobile' => 'nullable|string|regex:/^[0-9]{10}$/',

                // Financial Details
                'paid_amount' => 'nullable|numeric|min:0',
                'outstanding_amount' => 'nullable|numeric|min:0',
                'approve_date' => 'nullable|date',
                'form_status' => 'nullable|in:draft,submitted,under_review,approved,rejected',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed', [
                    'errors' => $validator->errors(),
                    'request_data' => $request->all()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validatedData = $validator->validated();

            // Set default values
            $validatedData['submission_id'] = $submissionId;
            $validatedData['current_step'] = 1;
            $validatedData['nationality'] = $validatedData['nationality'] ?? 'Indian';
            $validatedData['form_status'] = $validatedData['form_status'] ?? 'draft';
            $validatedData['specially_abled'] = $validatedData['specially_abled'] ?? 'no';

            // Convert checkbox value
            $validatedData['same_as_permanent'] = isset($validatedData['same_as_permanent']) ? true : false;
            // If same_as_permanent is checked, copy permanent address to correspondence address
            if ($validatedData['same_as_permanent']) {
                $addressFields = [
                    'flat_no' => 'corr_flat_no',
                    'floor' => 'corr_floor',
                    'name_of_building' => 'corr_name_of_building',
                    'area' => 'corr_area',
                    'lane' => 'corr_lane',
                    'landmark' => 'corr_landmark',
                    'pincode' => 'corr_pincode',
                    'status' => 'corr_status',
                    'city' => 'corr_city',
                    'postal_address' => 'corr_postal_address',
                    'new_zone' => 'corr_new_zone',
                    'district' => 'corr_district',
                    'chapter' => 'corr_chapter'
                ];

                foreach ($addressFields as $permanent => $correspondence) {
                    if (isset($validatedData[$permanent])) {
                        $validatedData[$correspondence] = $validatedData[$permanent];
                    }
                }
            }

            // Check if this is an update or new submission
            $existingApplication = FinancialAssistance::bySubmissionId($submissionId)->first();

            if ($existingApplication) {
                // Update existing record
                $existingApplication->update($validatedData);
                $application = $existingApplication;
            } else {
                // Create new record
                $application = FinancialAssistance::create($validatedData);
            }

            // Store submission ID in session
            Session::put('submission_id', $submissionId);

            Log::info('Financial assistance application saved', [
                'id' => $application->id,
                'submission_id' => $submissionId,
                'applicant' => $validatedData['applicant'],
                'student_name' => $validatedData['student_first_name'] . ' ' . $validatedData['last_name'],
                'request_date' => $validatedData['request_date']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Personal details saved successfully!',
                'data' => [
                    'id' => $application->id,
                    'submission_id' => $submissionId,
                    'step' => 2,
                    'next_step' => 'family-details',
                    'completion_percentage' => 28.6, // 2/7 steps
                    'redirect_url' => route('family-details', ['submission_id' => $submissionId])
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error processing financial assistance application', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your application. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    public function edit($id)
    {
        // Handle editing existing application
        try {
            $application = FinancialAssistance::findOrFail($id);

            return view('financial-assistance', [
                'mode' => 'edit',
                'application_id' => $id,
                'data' => $application
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading application for editing', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Application not found.');
        }
    }

    public function print($id)
    {
        // Handle printing application
        try {
            $application = FinancialAssistance::findOrFail($id);

            return view('financial-assistance-print', [
                'application_id' => $id,
                'data' => $application
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading application for printing', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Application not found.');
        }
    }

    public function saveDraft(Request $request)
    {
        try {
            // Handle saving draft with less strict validation
            $data = $request->all();
            $data['form_status'] = 'draft';
            $data['created_at'] = now();
            $data['updated_at'] = now();

            // Save draft logic
            $application = FinancialAssistance::create($data);

            Log::info('Financial assistance draft saved', [
                'id' => $application->id,
                'applicant' => $data['applicant'] ?? 'Unknown',
                'timestamp' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Draft saved successfully!',
                'data' => [
                    'id' => $application->id,
                    'status' => 'draft',
                    'saved_at' => now()->toISOString()
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error saving draft', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error saving draft. Please try again.'
            ], 500);
        }
    }

    public function storeFamilyDetails(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            if (!$submissionId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please start from the beginning.',
                    'redirect_url' => route('financial-assistance')
                ], 400);
            }

            // Validate family details
            $validator = Validator::make($request->all(), [
                'family_member_count' => 'nullable|integer|min:0',
                'total_family_members' => 'nullable|integer|min:0',
                'relation_student' => 'required|string|max:255',
                'family_name' => 'required|string|max:255',
                'family_age' => 'required|integer|min:0|max:120',
                'marital_status' => 'required|in:single,married,divorced,widowed',
                'qualification' => 'nullable|string|max:255',
                'occupation' => 'nullable|string|max:255',
                'mobile_number' => 'nullable|string|regex:/^[0-9]{10}$/',
                'email_id' => 'nullable|email',
                'yearly_gross_income' => 'nullable|numeric|min:0',
                'insurance_coverage' => 'nullable|numeric|min:0',
                'premium_paid' => 'nullable|numeric|min:0',
                'total_student' => 'nullable|integer|min:0',
                'total_family_income' => 'nullable|numeric|min:0',
                'family_member_diksha' => 'nullable|string|max:255',
                'total_insurance_coverage' => 'nullable|numeric|min:0',
                'total_premium_paid' => 'nullable|numeric|min:0',

                // Family contact validation
                'parental_uncle_name' => 'nullable|string|max:255',
                'parental_uncle_mobile' => 'nullable|string|regex:/^[0-9]{10}$/',
                'parental_uncle_email' => 'nullable|email',
                'maternal_uncle_name' => 'nullable|string|max:255',
                'maternal_uncle_mobile' => 'nullable|string|regex:/^[0-9]{10}$/',
                'maternal_uncle_email' => 'nullable|email',
                'parental_aunty_name' => 'nullable|string|max:255',
                'parental_aunty_mobile' => 'nullable|string|regex:/^[0-9]{10}$/',
                'parental_aunty_email' => 'nullable|email',
                'maternal_aunty_name' => 'nullable|string|max:255',
                'maternal_aunty_mobile' => 'nullable|string|regex:/^[0-9]{10}$/',
                'maternal_aunty_email' => 'nullable|email',
            ], [
                'relation_student.required' => 'Relation with student is required.',
                'family_name.required' => 'Family member name is required.',
                'family_age.required' => 'Family member age is required.',
                'family_age.min' => 'Age must be at least 0.',
                'family_age.max' => 'Age cannot be more than 120.',
                'marital_status.required' => 'Marital status is required.',
                'mobile_number.regex' => 'Mobile number must be exactly 10 digits.',
                'email_id.email' => 'Please enter a valid email address.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check the form for errors.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validatedData = $validator->validated();
            $validatedData['submission_id'] = $submissionId;
            $validatedData['form_status'] = 'completed';

            // Check if family details already exist for this submission
            $existingFamilyDetails = FamilyDetails::bySubmissionId($submissionId)->first();

            if ($existingFamilyDetails) {
                // Update existing record
                $existingFamilyDetails->update($validatedData);
                $familyDetails = $existingFamilyDetails;
            } else {
                // Create new record
                $familyDetails = FamilyDetails::create($validatedData);
            }

            // Update the main application step
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step < 3) {
                $application->update(['current_step' => 3]);
            }

            Log::info('Family details saved', [
                'submission_id' => $submissionId,
                'family_details_id' => $familyDetails->id,
                'family_name' => $validatedData['family_name']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Family details saved successfully!',
                'data' => [
                    'submission_id' => $submissionId,
                    'step' => 3,
                    'next_step' => 'education-details',
                    'completion_percentage' => 42.9, // 3/7 steps
                    'redirect_url' => route('education-details', ['submission_id' => $submissionId])
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error processing family details', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token'])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing family details. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    public function storeEducationDetails(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            if (!$submissionId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please start from the beginning.',
                    'redirect_url' => route('financial-assistance')
                ], 400);
            }

            // Validate education details
            $validator = Validator::make($request->all(), [
                // Previous Education Details (dynamic table)
                'previous_education' => 'nullable|array',
                'previous_education.*.exam_name' => 'nullable|string|max:255',
                'previous_education.*.course_name' => 'nullable|string|max:255',
                'previous_education.*.exam_month' => 'nullable|string|max:50',
                'previous_education.*.exam_year' => 'nullable|integer|min:1950|max:' . date('Y'),
                'previous_education.*.out_of_marks' => 'nullable|numeric|min:0',
                'previous_education.*.marks_obtained' => 'nullable|numeric|min:0',
                'previous_education.*.percentage' => 'nullable|numeric|min:0|max:100',

                // Work Experience and Activities
                'extracurricular_activities' => 'nullable|string',
                'research_projects' => 'nullable|string',
                'work_experience_years' => 'nullable|numeric|min:0',
                'company_name' => 'nullable|string|max:255',
                'remuneration' => 'nullable|numeric|min:0',
                'ctc_yearly' => 'nullable|numeric|min:0',
                'work_profile' => 'nullable|string',

                // Current Education Details
                'course_name_current' => 'nullable|string|max:255',
                'pursuing_education' => 'nullable|string|max:255',
                'university_college_name' => 'nullable|string|max:255',
                'commencement_month_year' => 'nullable|string|max:50',
                'completion_month_year' => 'nullable|string|max:50',
                'city' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'qs_ranking_foreign' => 'nullable|string|max:255',
                'nirf_ranking_domestic' => 'nullable|string|max:255',
            ], [
                'previous_education.*.exam_year.integer' => 'Exam year must be a valid year.',
                'previous_education.*.exam_year.min' => 'Exam year must be 1950 or later.',
                'previous_education.*.exam_year.max' => 'Exam year cannot be in the future.',
                'previous_education.*.out_of_marks.numeric' => 'Out of marks must be a number.',
                'previous_education.*.marks_obtained.numeric' => 'Marks obtained must be a number.',
                'previous_education.*.percentage.numeric' => 'Percentage must be a number.',
                'work_experience_years.numeric' => 'Work experience must be a number.',
                'remuneration.numeric' => 'Remuneration must be a number.',
                'ctc_yearly.numeric' => 'CTC must be a number.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check the form for errors.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validatedData = $validator->validated();
            $validatedData['submission_id'] = $submissionId;
            $validatedData['form_status'] = 'completed';

            // Check if education details already exist for this submission
            $existingEducationDetails = EducationDetails::bySubmissionId($submissionId)->first();

            if ($existingEducationDetails) {
                // Update existing record
                $existingEducationDetails->update($validatedData);
                $educationDetails = $existingEducationDetails;
            } else {
                // Create new record
                $educationDetails = EducationDetails::create($validatedData);
            }

            // Update the main application step
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step < 4) {
                $application->update(['current_step' => 4]);
            }

            Log::info('Education details saved', [
                'submission_id' => $submissionId,
                'education_details_id' => $educationDetails->id,
                'course_name_current' => $validatedData['course_name_current'] ?? 'Not specified'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Education details saved successfully!',
                'data' => [
                    'submission_id' => $submissionId,
                    'step' => 4,
                    'next_step' => 'funding-details',
                    'completion_percentage' => 57.1, // 4/7 steps
                    'redirect_url' => route('funding-details', ['submission_id' => $submissionId])
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error processing education details', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token'])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing education details. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Resume session API endpoint for browser-side session recovery
     */
    public function resumeSession(Request $request)
    {
        try {
            $submissionId = $request->input('submission_id');

            if (!$submissionId) {
                return response()->json([
                    'success' => false,
                    'message' => 'No submission ID provided'
                ], 400);
            }

            // Find the main application record
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();

            if (!$application) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session not found'
                ], 404);
            }

            // Store in Laravel session
            Session::put('submission_id', $submissionId);

            // Determine next URL based on current step
            $nextUrls = [
                1 => route('financial-assistance', ['submission_id' => $submissionId]),
                2 => route('family-details', ['submission_id' => $submissionId]),
                3 => route('education-details', ['submission_id' => $submissionId]),
                4 => route('funding-details', ['submission_id' => $submissionId]),
                // Add more steps as needed
                // 5 => route('guarantor-details', ['submission_id' => $submissionId]),
                // etc.
            ];

            $currentStep = $application->current_step;
            $nextUrl = $nextUrls[$currentStep] ?? $nextUrls[1];

            return response()->json([
                'success' => true,
                'message' => 'Session resumed successfully',
                'data' => $application->toArray(),
                'current_step' => $currentStep,
                'next_url' => $nextUrl,
                'submission_id' => $submissionId
            ]);

        } catch (\Exception $e) {
            Log::error('Error resuming session', [
                'error' => $e->getMessage(),
                'submission_id' => $request->input('submission_id')
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error resuming session'
            ], 500);
        }
    }

    /**
     * Clear session data (useful for starting fresh)
     */
    public function clearSession(Request $request)
    {
        try {
            // Clear Laravel session
            Session::forget('submission_id');

            return response()->json([
                'success' => true,
                'message' => 'Session cleared successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error clearing session'
            ], 500);
        }
    }
}
