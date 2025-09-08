<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use App\Models\EducationDetails;
use App\Models\FundingDetails;
use App\Models\GuarantorDetails;
use App\Models\Document;
use Illuminate\Support\Str;

class FinancialAssistanceController extends Controller
{
    public function index(Request $request)
    {
        // Check if this is a request for a new form (clear any existing session)
        $newForm = $request->has('new') || $request->has('new_form');

        if ($newForm) {
            // Clear existing session data for new form
            Session::forget('submission_id');
            $submissionId = null;
            $existingData = null;

            Log::info('Starting new form - session cleared', [
                'request_params' => $request->all()
            ]);
        } else {
            // Check if there's an existing submission in progress
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');
            $existingData = null;

            if ($submissionId) {
                $existingData = FinancialAssistance::bySubmissionId($submissionId)->first();
                if ($existingData) {
                    Session::put('submission_id', $submissionId);
                    Log::info('Resuming existing form session', [
                        'submission_id' => $submissionId,
                        'current_step' => $existingData->current_step
                    ]);
                } else {
                    // Invalid submission ID, clear it
                    Session::forget('submission_id');
                    $submissionId = null;
                }
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

            // Handle profile photo upload
            $profilePhotoPath = null;
            if ($request->hasFile('profile_photo')) {
                $profilePhoto = $request->file('profile_photo');
                // Validate file type
                if ($profilePhoto->getClientOriginalExtension() === 'jpg' || $profilePhoto->getClientOriginalExtension() === 'jpeg') {
                    // Store the file in the public/profile_photos directory
                    $profilePhotoPath = $profilePhoto->store('profile_photos', 'public');
                }
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
                'profile_photo' => 'nullable|image|mimes:jpeg,jpg|max:2048', // 2MB max

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
                'corr_flat_no' => 'nullable|required_if:same_as_permanent,0|string|max:50',
                'corr_floor' => 'nullable|required_if:same_as_permanent,0|string|max:50',
                'corr_name_of_building' => 'nullable|required_if:same_as_permanent,0|string|max:255',
                'corr_area' => 'nullable|required_if:same_as_permanent,0|string|max:255',
                'corr_lane' => 'nullable|required_if:same_as_permanent,0|string|max:255',
                'corr_landmark' => 'nullable|required_if:same_as_permanent,0|string|max:255',
                'corr_pincode' => 'nullable|required_if:same_as_permanent,0|string|regex:/^[0-9]{6}$/',
                'corr_status' => 'nullable|required_if:same_as_permanent,0|string|max:100',
                'corr_city' => 'nullable|required_if:same_as_permanent,0|string|max:100',
                'corr_postal_address' => 'nullable|required_if:same_as_permanent,0|string',
                'corr_new_zone' => 'nullable|string|max:100',
                'corr_district' => 'nullable|required_if:same_as_permanent,0|string|max:100',
                'corr_chapter' => 'nullable|required_if:same_as_permanent,0|string',
                'alternate_mail_id' => 'nullable|email|max:255',
                'alternate_mobile' => 'nullable|string|regex:/^[0-9]{10}$/',

                // Financial Details
                'paid_amount' => 'nullable|numeric|min:0',
                'outstanding_amount' => 'nullable|numeric|min:0',
                'approve_date' => 'nullable|date',
                'form_status' => 'nullable|in:draft,submitted,under_review,approved,rejected',
            ], [
                // Custom error messages
                'applicant.required' => 'Applicant name is required.',
                'name.required' => 'Name is required.',
                'request_date.required' => 'Request date is required.',
                'financial_asst_type.required' => 'Financial assistance type is required.',
                'financial_asst_for.required' => 'Financial assistance for is required.',
                'aadhar_number.required' => 'Aadhar number is required.',
                'aadhar_number.size' => 'Aadhar number must be exactly 12 digits.',
                'aadhar_number.regex' => 'Aadhar number must contain only digits.',
                'date_of_birth.required' => 'Date of birth is required.',
                'date_of_birth.date' => 'Please enter a valid date.',
                'date_of_birth.before' => 'Date of birth must be in the past.',
                'birth_place.required' => 'Birth place is required.',
                'student_first_name.required' => 'Student first name is required.',
                'last_name.required' => 'Last name is required.',
                'marital_status.required' => 'Marital status is required.',
                'native_place.required' => 'Native place is required.',
                'age.required' => 'Age is required.',
                'age.integer' => 'Age must be a number.',
                'age.min' => 'Age must be at least 1.',
                'age.max' => 'Age cannot be more than 120.',
                'nationality.required' => 'Nationality is required.',
                'gender.required' => 'Gender is required.',
                'religion.required' => 'Religion is required.',
                'student_email.required' => 'Student email is required.',
                'student_email.email' => 'Please enter a valid email address.',
                'student_mobile.required' => 'Student mobile number is required.',
                'student_mobile.regex' => 'Mobile number must be exactly 10 digits.',
                'pan_no.regex' => 'PAN number must follow the format ABCDE1234F.',
                'flat_no.required' => 'Flat number is required.',
                'name_of_building.required' => 'Name of building is required.',
                'area.required' => 'Area is required.',
                'lane.required' => 'Lane is required.',
                'landmark.required' => 'Landmark is required.',
                'pincode.required' => 'Pincode is required.',
                'pincode.regex' => 'Pincode must be exactly 6 digits.',
                'status.required' => 'Status is required.',
                'city.required' => 'City is required.',
                'postal_address.required' => 'Postal address is required.',
                'district.required' => 'District is required.',
                'chapter.required' => 'Chapter is required.',
                'corr_flat_no.required_if' => 'Correspondence flat number is required.',
                'corr_name_of_building.required_if' => 'Correspondence building name is required.',
                'corr_area.required_if' => 'Correspondence area is required.',
                'corr_lane.required_if' => 'Correspondence lane is required.',
                'corr_landmark.required_if' => 'Correspondence landmark is required.',
                'corr_pincode.required_if' => 'Correspondence pincode is required.',
                'corr_pincode.regex' => 'Correspondence pincode must be exactly 6 digits.',
                'corr_status.required_if' => 'Correspondence status is required.',
                'corr_city.required_if' => 'Correspondence city is required.',
                'corr_postal_address.required_if' => 'Correspondence postal address is required.',
                'corr_district.required_if' => 'Correspondence district is required.',
                'corr_chapter.required_if' => 'Correspondence chapter is required.',
                'alternate_mobile.regex' => 'Alternate mobile number must be exactly 10 digits.',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed', [
                    'errors' => $validator->errors(),
                    'request_data' => $request->all()
                ]);

                // Check if this is an AJAX request
                if ($request->wantsJson() || $request->ajax() || $request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Please check the form for errors.'
                    ], 422);
                }

                return redirect()->back()
                    ->withErrors($validator)
                    ->with('error', 'Validation failed')
                    ->withInput();
            }

            $validatedData = $validator->validated();

            // Set default values
            $validatedData['submission_id'] = $submissionId;
            $validatedData['current_step'] = 1;
            $validatedData['nationality'] = $validatedData['nationality'] ?? 'Indian';
            $validatedData['form_status'] = $validatedData['form_status'] ?? 'draft';
            $validatedData['specially_abled'] = $validatedData['specially_abled'] ?? 'no';

            // Add profile photo path if uploaded
            if ($profilePhotoPath) {
                $validatedData['profile_photo_path'] = $profilePhotoPath;
            }

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

            return redirect()->route('family-details', ['submission_id' => $submissionId])
                ->with('success', 'Personal details saved successfully!');

        } catch (\Exception $e) {
            Log::error('Error processing financial assistance application', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            // Handle specific database constraint violations
            $errorMessage = 'An error occurred while processing your application. Please try again.';

            if (str_contains($e->getMessage(), 'aadhar_number_unique')) {
                $errorMessage = 'This Aadhar number is already registered. Please use a different Aadhar number or contact support if this is your correct Aadhar number.';
            } elseif (str_contains($e->getMessage(), 'student_email_unique')) {
                $errorMessage = 'This email address is already registered. Please use a different email address.';
            } elseif (str_contains($e->getMessage(), 'Duplicate entry')) {
                if (str_contains($e->getMessage(), 'aadhar_number')) {
                    $errorMessage = 'This Aadhar number is already registered. Please use a different Aadhar number or contact support if this is your correct Aadhar number.';
                } elseif (str_contains($e->getMessage(), 'student_email')) {
                    $errorMessage = 'This email address is already registered. Please use a different email address.';
                }
            }

            // Check if this is an AJAX request
            if ($request->wantsJson() || $request->ajax() || $request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage,
                    'error_type' => 'database_constraint'
                ], 422);
            }

            return redirect()->back()
                ->with('error', $errorMessage)
                ->withInput();
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

            return redirect()->back()
                ->with('success', 'Draft saved successfully!');

        } catch (\Exception $e) {
            Log::error('Error saving draft', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()
                ->with('error', 'Error saving draft. Please try again.')
                ->withInput();
        }
    }

    public function storeFamilyDetails(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            if (!$submissionId) {
                return redirect()->back()
                    ->with('error', 'Session expired. Please start from the beginning.')
                    ->withInput();
            }

            // Validate family details - Making all fields required
            $validator = Validator::make($request->all(), [
                'family_member_count' => 'required|integer|min:0',
                'total_family_members' => 'required|integer|min:0',
                'relation_student' => 'required|string|max:255',
                'family_name' => 'required|string|max:255',
                'family_age' => 'required|integer|min:0|max:120',
                'marital_status' => 'required|in:single,married,divorced,widowed',
                'qualification' => 'required|string|max:255',
                'occupation' => 'required|string|max:255',
                'mobile_number' => 'required|string|regex:/^[0-9]{10}$/',
                'email_id' => 'required|email',
                'yearly_gross_income' => 'required|numeric|min:0',
                'insurance_coverage' => 'required|numeric|min:0',
                'premium_paid' => 'required|numeric|min:0',
                'total_student' => 'required|integer|min:0',
                'total_family_income' => 'required|numeric|min:0',
                'family_member_diksha' => 'required|string|max:255',
                'total_insurance_coverage' => 'required|numeric|min:0',
                'total_premium_paid' => 'required|numeric|min:0',

                // Family contact validation - Making all fields required
                'parental_uncle_name' => 'required|string|max:255',
                'parental_uncle_mobile' => 'required|string|regex:/^[0-9]{10}$/',
                'parental_uncle_email' => 'required|email',
                'maternal_uncle_name' => 'required|string|max:255',
                'maternal_uncle_mobile' => 'required|string|regex:/^[0-9]{10}$/',
                'maternal_uncle_email' => 'required|email',
                'parental_aunty_name' => 'required|string|max:255',
                'parental_aunty_mobile' => 'required|string|regex:/^[0-9]{10}$/',
                'parental_aunty_email' => 'required|email',
                'maternal_aunty_name' => 'required|string|max:255',
                'maternal_aunty_mobile' => 'required|string|regex:/^[0-9]{10}$/',
                'maternal_aunty_email' => 'required|email',
            ], [
                // Custom error messages for all fields
                'family_member_count.required' => 'Family member count is required.',
                'family_member_count.integer' => 'Family member count must be a number.',
                'total_family_members.required' => 'Total family members is required.',
                'total_family_members.integer' => 'Total family members must be a number.',
                'relation_student.required' => 'Relation with student is required.',
                'family_name.required' => 'Family member name is required.',
                'family_age.required' => 'Family member age is required.',
                'family_age.integer' => 'Age must be a number.',
                'family_age.min' => 'Age must be at least 0.',
                'family_age.max' => 'Age cannot be more than 120.',
                'marital_status.required' => 'Marital status is required.',
                'qualification.required' => 'Qualification is required.',
                'occupation.required' => 'Occupation is required.',
                'mobile_number.required' => 'Mobile number is required.',
                'mobile_number.regex' => 'Mobile number must be exactly 10 digits.',
                'email_id.required' => 'Email ID is required.',
                'email_id.email' => 'Please enter a valid email address.',
                'yearly_gross_income.required' => 'Yearly gross income is required.',
                'yearly_gross_income.numeric' => 'Yearly gross income must be a number.',
                'insurance_coverage.required' => 'Insurance coverage is required.',
                'insurance_coverage.numeric' => 'Insurance coverage must be a number.',
                'premium_paid.required' => 'Premium paid is required.',
                'premium_paid.numeric' => 'Premium paid must be a number.',
                'total_student.required' => 'Total number of students is required.',
                'total_student.integer' => 'Total number of students must be a number.',
                'total_family_income.required' => 'Total family income is required.',
                'total_family_income.numeric' => 'Total family income must be a number.',
                'family_member_diksha.required' => 'Family member taken diksha is required.',
                'total_insurance_coverage.required' => 'Total insurance coverage is required.',
                'total_insurance_coverage.numeric' => 'Total insurance coverage must be a number.',
                'total_premium_paid.required' => 'Total premium paid is required.',
                'total_premium_paid.numeric' => 'Total premium paid must be a number.',

                // Family contact error messages - Making all fields required
                'parental_uncle_name.required' => 'Parental uncle name is required.',
                'parental_uncle_mobile.required' => 'Parental uncle mobile number is required.',
                'parental_uncle_mobile.regex' => 'Parental uncle mobile number must be exactly 10 digits.',
                'parental_uncle_email.required' => 'Parental uncle email is required.',
                'parental_uncle_email.email' => 'Please enter a valid email address for parental uncle.',
                'maternal_uncle_name.required' => 'Maternal uncle name is required.',
                'maternal_uncle_mobile.required' => 'Maternal uncle mobile number is required.',
                'maternal_uncle_mobile.regex' => 'Maternal uncle mobile number must be exactly 10 digits.',
                'maternal_uncle_email.required' => 'Maternal uncle email is required.',
                'maternal_uncle_email.email' => 'Please enter a valid email address for maternal uncle.',
                'parental_aunty_name.required' => 'Parental aunty name is required.',
                'parental_aunty_mobile.required' => 'Parental aunty mobile number is required.',
                'parental_aunty_mobile.regex' => 'Parental aunty mobile number must be exactly 10 digits.',
                'parental_aunty_email.required' => 'Parental aunty email is required.',
                'parental_aunty_email.email' => 'Please enter a valid email address for parental aunty.',
                'maternal_aunty_name.required' => 'Maternal aunty name is required.',
                'maternal_aunty_mobile.required' => 'Maternal aunty mobile number is required.',
                'maternal_aunty_mobile.regex' => 'Maternal aunty mobile number must be exactly 10 digits.',
                'maternal_aunty_email.required' => 'Maternal aunty email is required.',
                'maternal_aunty_email.email' => 'Please enter a valid email address for maternal aunty.',
            ]);

            if ($validator->fails()) {
                // Check if this is an AJAX request
                if ($request->wantsJson() || $request->ajax() || $request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Please check the form for errors.'
                    ], 422);
                }

                return redirect()->back()
                    ->withErrors($validator)
                    ->with('error', 'Please check the form for errors.')
                    ->withInput();
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

            // Check if this is an AJAX request
            if ($request->wantsJson() || $request->ajax() || $request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => 'Family details saved successfully!',
                    'redirect_url' => route('education-details', ['submission_id' => $submissionId])
                ]);
            }

            return redirect()->route('education-details', ['submission_id' => $submissionId])
                ->with('success', 'Family details saved successfully!');

        } catch (\Exception $e) {
            Log::error('Error processing family details', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token'])
            ]);

            // Check if this is an AJAX request
            if ($request->wantsJson() || $request->ajax() || $request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing family details. Please try again.'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'An error occurred while processing family details. Please try again.')
                ->withInput();
        }
    }

    public function storeEducationDetails(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            if (!$submissionId) {
                return redirect()->back()
                    ->with('error', 'Session expired. Please start from the beginning.')
                    ->withInput();
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
                return redirect()->back()
                    ->withErrors($validator)
                    ->with('error', 'Please check the form for errors.')
                    ->withInput();
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

            return redirect()->route('funding-details', ['submission_id' => $submissionId])
                ->with('success', 'Education details saved successfully!');

        } catch (\Exception $e) {
            Log::error('Error processing education details', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token'])
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while processing education details. Please try again.')
                ->withInput();
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

    /**
     * Delete an entire application and all related data
     */
    public function deleteApplication($submissionId)
    {
        try {
            Log::info('Attempting to delete application', [
                'submission_id' => $submissionId
            ]);

            // Find the main application
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();

            if (!$application) {
                return response()->json([
                    'success' => false,
                    'message' => 'Application not found'
                ], 404);
            }

            // Delete related records first (foreign key constraints)
            $deletedRecords = [];

            // Delete family details
            $familyDetails = \App\Models\FamilyDetails::bySubmissionId($submissionId)->first();
            if ($familyDetails) {
                $familyDetails->delete();
                $deletedRecords[] = 'family_details';
            }

            // Delete education details
            $educationDetails = \App\Models\EducationDetails::bySubmissionId($submissionId)->first();
            if ($educationDetails) {
                $educationDetails->delete();
                $deletedRecords[] = 'education_details';
            }

            // Delete funding details
            $fundingDetails = \App\Models\FundingDetails::bySubmissionId($submissionId)->first();
            if ($fundingDetails) {
                $fundingDetails->delete();
                $deletedRecords[] = 'funding_details';
            }

            // Delete guarantor details
            $guarantorDetails = \App\Models\GuarantorDetails::bySubmissionId($submissionId)->first();
            if ($guarantorDetails) {
                $guarantorDetails->delete();
                $deletedRecords[] = 'guarantor_details';
            }

            // Delete documents
            $documents = \App\Models\Document::bySubmissionId($submissionId)->get();
            foreach ($documents as $document) {
                $document->delete();
                $deletedRecords[] = 'documents';
            }

            // Finally delete the main application
            $studentName = $application->fullName ?? $application->name ?? 'Unknown';
            $application->delete();
            $deletedRecords[] = 'financial_assistance';

            Log::info('Application deleted successfully', [
                'submission_id' => $submissionId,
                'student_name' => $studentName,
                'deleted_records' => $deletedRecords
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Application deleted successfully',
                'data' => [
                    'submission_id' => $submissionId,
                    'student_name' => $studentName,
                    'deleted_records' => $deletedRecords
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting application', [
                'submission_id' => $submissionId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the application',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}
