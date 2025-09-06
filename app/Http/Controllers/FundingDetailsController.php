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

            if (!$submissionId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please start from the beginning.',
                    'redirect_url' => route('financial-assistance')
                ], 400);
            }

            // Validate funding details
            $validator = Validator::make($request->all(), [
                // Amount and Funding Information
                'amount_requested_years' => 'nullable|string|max:255',
                'tuition_fees_amount' => 'nullable|numeric|min:0',

                // Funding Details Table (dynamic table)
                'funding_details_table' => 'nullable|array',
                'funding_details_table.*.particulars' => 'nullable|string|max:255',
                'funding_details_table.*.status' => 'nullable|string|max:255',
                'funding_details_table.*.trust_institute_name' => 'nullable|string|max:255',
                'funding_details_table.*.contact_person_name' => 'nullable|string|max:255',
                'funding_details_table.*.contact_number' => 'nullable|string|max:20',
                'funding_details_table.*.amount' => 'nullable|numeric|min:0',

                // Previous Financial Assistance
                'family_received_assistance' => 'nullable|string|max:255',
                'ngo_name' => 'nullable|string|max:255',
                'loan_status' => 'nullable|string|max:255',
                'applied_year' => 'nullable|string|max:50',
                'applied_amount' => 'nullable|numeric|min:0',

                // Bank Account Details
                'student_name' => 'required|string|max:255',
                'student_account_number' => 'required|string|max:50',
                'ifsc_code' => 'required|string|max:11',
                'bank_name' => 'required|string|max:255',
                'branch_name' => 'required|string|max:255',
                'bank_address' => 'required|string',
            ], [
                'student_name.required' => 'Student name is required.',
                'student_account_number.required' => 'Student account number is required.',
                'ifsc_code.required' => 'IFSC code is required.',
                'ifsc_code.max' => 'IFSC code must not exceed 11 characters.',
                'bank_name.required' => 'Bank name is required.',
                'branch_name.required' => 'Branch name is required.',
                'bank_address.required' => 'Bank address is required.',
                'tuition_fees_amount.numeric' => 'Tuition fees amount must be a number.',
                'applied_amount.numeric' => 'Applied amount must be a number.',
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

            // Check if funding details already exist for this submission
            $existingFundingDetails = FundingDetails::bySubmissionId($submissionId)->first();

            if ($existingFundingDetails) {
                // Update existing record
                $existingFundingDetails->update($validatedData);
                $fundingDetails = $existingFundingDetails;
            } else {
                // Create new record
                $fundingDetails = FundingDetails::create($validatedData);
            }

            // Update the main application step
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step < 5) {
                $application->update(['current_step' => 5]);
            }

            Log::info('Funding details saved', [
                'submission_id' => $submissionId,
                'funding_details_id' => $fundingDetails->id,
                'student_name' => $validatedData['student_name']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Funding details saved successfully!',
                'data' => [
                    'submission_id' => $submissionId,
                    'step' => 5,
                    'next_step' => 'guarantor-details',
                    'completion_percentage' => 71.4, // 5/7 steps
                    'redirect_url' => route('funding-details', ['submission_id' => $submissionId]) . '?saved=true'
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error processing funding details', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token'])
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing funding details. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
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
                return response()->json([
                    'success' => false,
                    'message' => 'Funding details not found.'
                ], 404);
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

            return response()->json([
                'success' => true,
                'message' => 'Funding details deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting funding details', [
                'error' => $e->getMessage(),
                'submission_id' => $submissionId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting funding details.'
            ], 500);
        }
    }
}
