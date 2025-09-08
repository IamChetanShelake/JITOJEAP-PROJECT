<?php

namespace App\Http\Controllers;

use App\Models\GuarantorDetails;
use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use App\Models\EducationDetails;
use App\Models\FundingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class GuarantorDetailsController extends Controller
{
    /**
     * Display the guarantor details form
     */
    public function index(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            Log::info('Accessing guarantor details page', [
                'submission_id_from_request' => $request->get('submission_id'),
                'submission_id_from_session' => Session::get('submission_id'),
                'final_submission_id' => $submissionId
            ]);

            if (!$submissionId) {
                Log::warning('No submission ID found for guarantor details');
                return redirect()->route('financial-assistance')
                    ->with('error', 'Please complete previous steps first.');
            }

            // Check if previous steps are completed
            $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
            $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();
            $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();
            $fundingDetails = FundingDetails::bySubmissionId($submissionId)->first();

            if (!$personalDetails || $personalDetails->current_step < 5) {
                Log::warning('Previous steps not completed for guarantor details', [
                    'submission_id' => $submissionId,
                    'current_step' => $personalDetails->current_step ?? null
                ]);
                return redirect()->route('funding-details', ['submission_id' => $submissionId])
                    ->with('error', 'Please complete funding details first.');
            }

            // Get existing guarantor details if any
            $existingData = GuarantorDetails::bySubmissionId($submissionId)->first();

            Log::info('Loading guarantor details page successfully', [
                'submission_id' => $submissionId,
                'existing_data' => $existingData ? 'yes' : 'no'
            ]);

            return view('guarantor-details', [
                'existingData' => $existingData,
                'submissionId' => $submissionId,
                'personalDetails' => $personalDetails,
                'familyDetails' => $familyDetails,
                'educationDetails' => $educationDetails,
                'fundingDetails' => $fundingDetails
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading guarantor details page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('financial-assistance')
                ->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Store or update guarantor details
     */
    public function store(Request $request)
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

            // Log the incoming request data for debugging
            Log::info('Guarantor details form submission', [
                'submission_id' => $submissionId,
                'request_data' => $request->except(['_token'])
            ]);

            // Validate guarantor details
            $validator = Validator::make($request->all(), [
                // First Guarantor Details
                'first_guarantor_name' => 'required|string|max:255',
                'first_guarantor_mobile' => 'required|string|regex:/^[0-9]{10}$/',
                'first_guarantor_relation' => 'required|string|max:255',
                'first_guarantor_dob' => 'required|date',
                'first_guarantor_gender' => 'required|in:male,female,other',
                'first_guarantor_permanent_address' => 'required|string',
                'first_guarantor_phone' => 'nullable|string|max:20',
                'first_guarantor_pan' => 'required|string|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                'first_guarantor_income' => 'required|numeric|min:0',
                'first_guarantor_email' => 'required|email|max:255',
                'first_guarantor_aadhar' => 'required|string|size:12|regex:/^[0-9]{12}$/',
                'first_guarantor_business_name' => 'nullable|string|max:255',

                // Second Guarantor Details
                'second_guarantor_name' => 'required|string|max:255',
                'second_guarantor_mobile' => 'required|string|regex:/^[0-9]{10}$/',
                'second_guarantor_relation' => 'required|string|max:255',
                'second_guarantor_dob' => 'required|date',
                'second_guarantor_gender' => 'required|in:male,female,other',
                'second_guarantor_permanent_address' => 'required|string',
                'second_guarantor_phone' => 'nullable|string|max:20',
                'second_guarantor_pan' => 'required|string|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                'second_guarantor_income' => 'required|numeric|min:0',
                'second_guarantor_email' => 'required|email|max:255',
                'second_guarantor_aadhar' => 'required|string|size:12|regex:/^[0-9]{12}$/',
                'second_guarantor_business_name' => 'nullable|string|max:255',
            ], [
                // Custom error messages
                'first_guarantor_name.required' => 'First guarantor name is required.',
                'first_guarantor_mobile.required' => 'First guarantor mobile number is required.',
                'first_guarantor_mobile.regex' => 'First guarantor mobile number must be 10 digits.',
                'first_guarantor_relation.required' => 'First guarantor relation is required.',
                'first_guarantor_dob.required' => 'First guarantor date of birth is required.',
                'first_guarantor_gender.required' => 'First guarantor gender is required.',
                'first_guarantor_permanent_address.required' => 'First guarantor permanent address is required.',
                'first_guarantor_pan.required' => 'First guarantor PAN number is required.',
                'first_guarantor_pan.regex' => 'First guarantor PAN number format is invalid. It should be in the format ABCDE1234F.',
                'first_guarantor_income.required' => 'First guarantor income is required.',
                'first_guarantor_email.required' => 'First guarantor email is required.',
                'first_guarantor_email.email' => 'First guarantor email must be a valid email address.',
                'first_guarantor_aadhar.required' => 'First guarantor Aadhar number is required.',
                'first_guarantor_aadhar.size' => 'First guarantor Aadhar number must be 12 digits.',
                'first_guarantor_aadhar.regex' => 'First guarantor Aadhar number must contain only digits.',

                'second_guarantor_name.required' => 'Second guarantor name is required.',
                'second_guarantor_mobile.required' => 'Second guarantor mobile number is required.',
                'second_guarantor_mobile.regex' => 'Second guarantor mobile number must be 10 digits.',
                'second_guarantor_relation.required' => 'Second guarantor relation is required.',
                'second_guarantor_dob.required' => 'Second guarantor date of birth is required.',
                'second_guarantor_gender.required' => 'Second guarantor gender is required.',
                'second_guarantor_permanent_address.required' => 'Second guarantor permanent address is required.',
                'second_guarantor_pan.required' => 'Second guarantor PAN number is required.',
                'second_guarantor_pan.regex' => 'Second guarantor PAN number format is invalid. It should be in the format ABCDE1234F.',
                'second_guarantor_income.required' => 'Second guarantor income is required.',
                'second_guarantor_email.required' => 'Second guarantor email is required.',
                'second_guarantor_email.email' => 'Second guarantor email must be a valid email address.',
                'second_guarantor_aadhar.required' => 'Second guarantor Aadhar number is required.',
                'second_guarantor_aadhar.size' => 'Second guarantor Aadhar number must be 12 digits.',
                'second_guarantor_aadhar.regex' => 'Second guarantor Aadhar number must contain only digits.',
            ]);

            if ($validator->fails()) {
                Log::info('Guarantor details validation failed', [
                    'errors' => $validator->errors()->toArray(),
                    'request_data' => $request->except(['_token'])
                ]);
                
                // Return detailed error information
                return response()->json([
                    'success' => false,
                    'message' => 'Please check the form for errors.',
                    'errors' => $validator->errors(),
                    'debug_info' => [
                        'first_guarantor_mobile' => $request->get('first_guarantor_mobile'),
                        'first_guarantor_pan' => $request->get('first_guarantor_pan'),
                        'first_guarantor_aadhar' => $request->get('first_guarantor_aadhar'),
                        'second_guarantor_mobile' => $request->get('second_guarantor_mobile'),
                        'second_guarantor_pan' => $request->get('second_guarantor_pan'),
                        'second_guarantor_aadhar' => $request->get('second_guarantor_aadhar'),
                    ]
                ], 422);
            }

            $validatedData = $validator->validated();
            $validatedData['submission_id'] = $submissionId;
            $validatedData['form_status'] = 'completed';

            // Check if guarantor details already exist for this submission
            $existingGuarantorDetails = GuarantorDetails::bySubmissionId($submissionId)->first();

            if ($existingGuarantorDetails) {
                // Update existing record
                $existingGuarantorDetails->update($validatedData);
                $guarantorDetails = $existingGuarantorDetails;
            } else {
                // Create new record
                $guarantorDetails = GuarantorDetails::create($validatedData);
            }

            // Update the main application step
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step < 6) {
                $application->update(['current_step' => 6]);
            }

            Log::info('Guarantor details saved', [
                'submission_id' => $submissionId,
                'guarantor_details_id' => $guarantorDetails->id,
                'first_guarantor_name' => $validatedData['first_guarantor_name'],
                'second_guarantor_name' => $validatedData['second_guarantor_name']
            ]);

            // Redirect to the documents page
            return response()->json([
                'success' => true,
                'message' => 'Guarantor details saved successfully!',
                'data' => [
                    'submission_id' => $submissionId,
                    'step' => 6,
                    'next_step' => 'documents',
                    'completion_percentage' => 85.7, // 6/7 steps
                    'redirect_url' => route('documents', ['submission_id' => $submissionId])
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error processing guarantor details', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token'])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing guarantor details. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Display specific guarantor details for editing
     */
    public function edit($submissionId)
    {
        $guarantorDetails = GuarantorDetails::bySubmissionId($submissionId)->first();

        if (!$guarantorDetails) {
            return redirect()->route('guarantor-details')
                ->with('error', 'Guarantor details not found.');
        }

        $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
        $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();
        $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();
        $fundingDetails = FundingDetails::bySubmissionId($submissionId)->first();

        return view('guarantor-details', [
            'existingData' => $guarantorDetails,
            'submissionId' => $submissionId,
            'personalDetails' => $personalDetails,
            'familyDetails' => $familyDetails,
            'educationDetails' => $educationDetails,
            'fundingDetails' => $fundingDetails
        ]);
    }

    /**
     * Delete guarantor details
     */
    public function destroy($submissionId)
    {
        try {
            $guarantorDetails = GuarantorDetails::bySubmissionId($submissionId)->first();

            if (!$guarantorDetails) {
                return response()->json([
                    'success' => false,
                    'message' => 'Guarantor details not found.'
                ], 404);
            }

            $guarantorDetails->delete();

            // Update the main application step back to 5
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step > 5) {
                $application->update(['current_step' => 5]);
            }

            Log::info('Guarantor details deleted', [
                'submission_id' => $submissionId,
                'guarantor_details_id' => $guarantorDetails->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Guarantor details deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting guarantor details', [
                'error' => $e->getMessage(),
                'submission_id' => $submissionId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting guarantor details.'
            ], 500);
        }
    }
}