<?php

namespace App\Http\Controllers;

use App\Models\FundingDetails;
use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use App\Models\EducationDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class FundingDetailsController extends Controller
{
    /**
     * Display the funding details form
     */
    public function index(Request $request)
    {
        // Get submission ID from session or request
        $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

        if (!$submissionId) {
            return redirect()->route('financial-assistance')
                ->with('error', 'Please complete previous steps first.');
        }

        // Check if previous steps are completed
        $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
        $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();
        $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();

        if (!$personalDetails || $personalDetails->current_step < 4) {
            return redirect()->route('education-details', ['submission_id' => $submissionId])
                ->with('error', 'Please complete education details first.');
        }

        // Get existing funding details if any
        $existingData = FundingDetails::bySubmissionId($submissionId)->first();

        return view('funding-details', [
            'existingData' => $existingData,
            'submissionId' => $submissionId,
            'personalDetails' => $personalDetails,
            'familyDetails' => $familyDetails,
            'educationDetails' => $educationDetails
        ]);
    }

    /**
     * Store or update funding details
     */
    public function store(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');
            
            Log::info('Funding details submission attempt', [
                'submission_id_from_request' => $request->get('submission_id'),
                'submission_id_from_session' => Session::get('submission_id'),
                'final_submission_id' => $submissionId
            ]);

            if (!$submissionId) {
                Log::warning('No submission ID found for funding details');
                // Return with toast message instead of JSON
                return redirect()->back()
                    ->with('error', 'Session expired. Please start from the beginning.')
                    ->withInput();
            }
            
            // Check if financial assistance record exists
            $financialAssistance = FinancialAssistance::bySubmissionId($submissionId)->first();
            if (!$financialAssistance) {
                Log::warning('No financial assistance record found for submission ID', [
                    'submission_id' => $submissionId
                ]);
                return redirect()->back()
                    ->with('error', 'Financial assistance record not found. Please start from the beginning.')
                    ->withInput();
            }
            
            // Check if previous steps are completed
            if ($financialAssistance->current_step < 4) {
                Log::warning('Previous steps not completed for submission ID', [
                    'submission_id' => $submissionId,
                    'current_step' => $financialAssistance->current_step
                ]);
                return redirect()->back()
                    ->with('error', 'Please complete previous steps first.')
                    ->withInput();
            }
            
            // Log the incoming request data for debugging
            Log::info('Funding details form submission', [
                'submission_id' => $submissionId,
                'request_data' => $request->except(['_token']),
                'funding_details_table' => $request->input('funding_details_table')
            ]);
            
            // Check if funding details table data is present in the request
            if (!$request->has('funding_details_table')) {
                Log::warning('Funding details table data not found in request', [
                    'submission_id' => $submissionId
                ]);
            }
            
            // Check if required fields are present
            $requiredFields = ['student_name', 'student_account_number', 'ifsc_code', 'bank_name', 'branch_name', 'bank_address'];
            foreach ($requiredFields as $field) {
                if (!$request->has($field)) {
                    Log::warning("Required field '$field' not found in request", [
                        'submission_id' => $submissionId
                    ]);
                }
            }

            // Validate funding details - Making all fields required
            $validator = Validator::make($request->all(), [
                // Amount and Funding Information
                'amount_requested_years' => 'required|string|max:255',
                'tuition_fees_amount' => 'required|numeric|min:0',

                // Funding Details Table (dynamic table)
                'funding_details_table' => 'required|array',
                'funding_details_table.*.particulars' => 'required|string|max:255',
                'funding_details_table.*.status' => 'required|string|max:255',
                'funding_details_table.*.trust_institute_name' => 'required|string|max:255',
                'funding_details_table.*.contact_person_name' => 'required|string|max:255',
                'funding_details_table.*.contact_number' => 'required|string|max:20',
                'funding_details_table.*.amount' => 'required|numeric|min:0',

                // Previous Financial Assistance
                'family_received_assistance' => 'required|string|max:255',
                'ngo_name' => 'required|string|max:255',
                'loan_status' => 'required|string|max:255',
                'applied_year' => 'required|string|max:50',
                'applied_amount' => 'required|numeric|min:0',

                // Bank Account Details
                'student_name' => 'required|string|max:255',
                'student_account_number' => 'required|string|max:50',
                'ifsc_code' => 'required|string|max:11',
                'bank_name' => 'required|string|max:255',
                'branch_name' => 'required|string|max:255',
                'bank_address' => 'required|string',
            ], [
                // Custom error messages for all fields
                'amount_requested_years.required' => 'Amount requested for years is required.',
                'tuition_fees_amount.required' => 'Tuition fees amount is required.',
                'tuition_fees_amount.numeric' => 'Tuition fees amount must be a number.',
                'funding_details_table.required' => 'Funding details table is required.',
                'funding_details_table.*.particulars.required' => 'Particulars field is required.',
                'funding_details_table.*.status.required' => 'Status field is required.',
                'funding_details_table.*.trust_institute_name.required' => 'Trust/Institute name field is required.',
                'funding_details_table.*.contact_person_name.required' => 'Contact person name field is required.',
                'funding_details_table.*.contact_number.required' => 'Contact number field is required.',
                'funding_details_table.*.amount.required' => 'Amount field is required.',
                'family_received_assistance.required' => 'Family received assistance field is required.',
                'ngo_name.required' => 'NGO name is required.',
                'loan_status.required' => 'Loan status is required.',
                'applied_year.required' => 'Applied year is required.',
                'applied_amount.required' => 'Applied amount is required.',
                'applied_amount.numeric' => 'Applied amount must be a number.',
                'student_name.required' => 'Student name is required.',
                'student_account_number.required' => 'Student account number is required.',
                'ifsc_code.required' => 'IFSC code is required.',
                'ifsc_code.max' => 'IFSC code must not exceed 11 characters.',
                'bank_name.required' => 'Bank name is required.',
                'branch_name.required' => 'Branch name is required.',
                'bank_address.required' => 'Bank address is required.',
            ]);

            if ($validator->fails()) {
                Log::info('Funding details validation failed', [
                    'submission_id' => $submissionId,
                    'errors' => $validator->errors()
                ]);
                
                // Check if this is an AJAX request
                if ($request->wantsJson() || $request->ajax() || $request->headers->get('X-Requested-With') === 'XMLHttpRequest') {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                        'message' => 'Please check the form for errors.'
                    ], 422);
                }
                
                // Return with validation errors as toast message for non-AJAX requests
                return redirect()->back()
                    ->withErrors($validator)
                    ->with('error', 'Please check the form for errors.')
                    ->withInput();
            }

            $validatedData = $validator->validated();
            $validatedData['submission_id'] = $submissionId;
            $validatedData['form_status'] = 'completed';

            // Log validated data
            Log::info('Funding details validated data', [
                'submission_id' => $submissionId,
                'validated_data' => $validatedData,
                'funding_details_table' => $validatedData['funding_details_table'] ?? null
            ]);
            
            // Check if funding details table data is properly structured
            if (isset($validatedData['funding_details_table']) && is_array($validatedData['funding_details_table'])) {
                Log::info('Funding details table structure', [
                    'count' => count($validatedData['funding_details_table']),
                    'keys' => array_keys($validatedData['funding_details_table'])
                ]);
                
                foreach ($validatedData['funding_details_table'] as $index => $row) {
                    Log::info("Funding details table row $index", [
                        'data' => $row
                    ]);
                }
                
                // Filter out empty rows
                $filteredFundingDetails = array_filter($validatedData['funding_details_table'], function($row) {
                    return !empty(array_filter($row, function($value) {
                        return $value !== null && $value !== '';
                    }));
                });
                
                Log::info('Filtered funding details table', [
                    'count' => count($filteredFundingDetails),
                    'data' => $filteredFundingDetails
                ]);
                
                $validatedData['funding_details_table'] = array_values($filteredFundingDetails); // Re-index array
                
                // Ensure the data is properly encoded as JSON
                $jsonEncoded = json_encode($validatedData['funding_details_table']);
                Log::info('Funding details table JSON encoded', [
                    'json' => $jsonEncoded,
                    'error' => json_last_error_msg()
                ]);
            } else {
                Log::info('No funding details table data or not an array', [
                    'data' => $validatedData['funding_details_table'] ?? null
                ]);
                $validatedData['funding_details_table'] = null; // Set to null instead of empty array
            }

            // Check if funding details already exist for this submission
            $existingFundingDetails = FundingDetails::bySubmissionId($submissionId)->first();
            
            if ($existingFundingDetails) {
                // Update existing record
                Log::info('Updating existing funding details', [
                    'submission_id' => $submissionId,
                    'funding_details_id' => $existingFundingDetails->id
                ]);
                
                $updateResult = $existingFundingDetails->update($validatedData);
                $fundingDetails = $existingFundingDetails;
                
                Log::info('Update result', [
                    'success' => $updateResult,
                    'funding_details_id' => $fundingDetails->id
                ]);
            } else {
                // Create new record
                Log::info('Creating new funding details record', [
                    'submission_id' => $submissionId
                ]);
                
                $fundingDetails = FundingDetails::create($validatedData);
                
                Log::info('Created funding details record', [
                    'funding_details_id' => $fundingDetails->id,
                    'submission_id' => $fundingDetails->submission_id
                ]);
            }

            // Update the main application step
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application) {
                Log::info('Found financial assistance record', [
                    'submission_id' => $submissionId,
                    'current_step' => $application->current_step
                ]);
                
                if ($application->current_step < 5) {
                    $updateResult = $application->update(['current_step' => 5]);
                    Log::info('Application step updated', [
                        'submission_id' => $submissionId,
                        'new_step' => 5,
                        'update_result' => $updateResult
                    ]);
                } else {
                    Log::info('Application step already at or beyond step 5', [
                        'submission_id' => $submissionId,
                        'current_step' => $application->current_step
                    ]);
                }
            } else {
                Log::warning('Financial assistance record not found for step update', [
                    'submission_id' => $submissionId
                ]);
            }

            Log::info('Funding details saved', [
                'submission_id' => $submissionId,
                'funding_details_id' => $fundingDetails->id,
                'student_name' => $validatedData['student_name'] ?? 'N/A',
                'funding_details_table_count' => count($validatedData['funding_details_table'] ?? [])
            ]);

            // Redirect to the next step with success message
            return redirect()->route('guarantor-details', ['submission_id' => $submissionId])
                ->with('success', 'Funding details saved successfully!');

        } catch (\Exception $e) {
            Log::error('Error processing funding details', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token']),
                'submission_id' => $submissionId ?? null
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while processing your request.')
                ->withInput();
        }
    }

    /**
     * Display specific funding details for editing
     */
    public function edit($submissionId)
    {
        $fundingDetails = FundingDetails::bySubmissionId($submissionId)->first();

        if (!$fundingDetails) {
            return redirect()->route('funding-details')
                ->with('error', 'Funding details not found.');
        }

        $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
        $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();
        $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();

        return view('funding-details', [
            'existingData' => $fundingDetails,
            'submissionId' => $submissionId,
            'personalDetails' => $personalDetails,
            'familyDetails' => $familyDetails,
            'educationDetails' => $educationDetails
        ]);
    }

    /**
     * Delete funding details
     */
    public function destroy($submissionId)
    {
        try {
            $fundingDetails = FundingDetails::bySubmissionId($submissionId)->first();

            if (!$fundingDetails) {
                return redirect()->back()
                    ->with('error', 'Funding details not found.');
            }

            $fundingDetails->delete();

            // Update the main application step back to 4
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step > 4) {
                $application->update(['current_step' => 4]);
            }

            Log::info('Funding details deleted', [
                'submission_id' => $submissionId,
                'funding_details_id' => $fundingDetails->id
            ]);

            return redirect()->back()
                ->with('success', 'Funding details deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Error deleting funding details', [
                'error' => $e->getMessage(),
                'submission_id' => $submissionId
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while deleting funding details.');
        }
    }
}