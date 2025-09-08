<?php

namespace App\Http\Controllers;

use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use App\Models\EducationDetails;
use App\Models\FundingDetails;
use App\Models\GuarantorDetails;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class FinalSubmissionController extends Controller
{
    /**
     * Display the final submission confirmation page
     */
    public function index(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            Log::info('Accessing final submission page', [
                'submission_id_from_request' => $request->get('submission_id'),
                'submission_id_from_session' => Session::get('submission_id'),
                'final_submission_id' => $submissionId
            ]);

            if (!$submissionId) {
                Log::warning('No submission ID found for final submission');
                return redirect()->route('financial-assistance')
                    ->with('error', 'Please complete previous steps first.');
            }

            // Check if all previous steps are completed
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            
            if (!$application || $application->current_step < 7) {
                Log::warning('Previous steps not completed for final submission', [
                    'submission_id' => $submissionId,
                    'current_step' => $application->current_step ?? null
                ]);
                
                // Redirect to the appropriate step based on current_step
                $redirectRoutes = [
                    1 => route('family-details', ['submission_id' => $submissionId]),
                    2 => route('education-details', ['submission_id' => $submissionId]),
                    3 => route('funding-details', ['submission_id' => $submissionId]),
                    4 => route('guarantor-details', ['submission_id' => $submissionId]),
                    5 => route('documents', ['submission_id' => $submissionId]),
                    6 => route('documents', ['submission_id' => $submissionId]), // If at documents step
                ];
                
                $redirectUrl = $redirectRoutes[$application->current_step] ?? route('financial-assistance');
                
                return redirect($redirectUrl)
                    ->with('error', 'Please complete all previous steps first.');
            }

            // Get all related data
            $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();
            $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();
            $fundingDetails = FundingDetails::bySubmissionId($submissionId)->first();
            $guarantorDetails = GuarantorDetails::bySubmissionId($submissionId)->first();
            $documents = Document::bySubmissionId($submissionId)->get();

            Log::info('Loading final submission page successfully', [
                'submission_id' => $submissionId
            ]);

            return view('final-submission', [
                'application' => $application,
                'familyDetails' => $familyDetails,
                'educationDetails' => $educationDetails,
                'fundingDetails' => $fundingDetails,
                'guarantorDetails' => $guarantorDetails,
                'documents' => $documents,
                'submissionId' => $submissionId
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading final submission page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('financial-assistance')
                ->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Process the final submission
     */
    public function store(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            if (!$submissionId) {
                return redirect()->back()
                    ->with('error', 'Session expired. Please start from the beginning.')
                    ->withInput();
            }

            // Log the final submission
            Log::info('Final submission processing', [
                'submission_id' => $submissionId
            ]);

            // Update the application status to submitted
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            
            if ($application) {
                $application->update([
                    'form_status' => 'submitted',
                    'current_step' => 7 // Final step
                ]);
            }

            // Clear session data
            Session::forget('submission_id');

            Log::info('Final submission completed successfully', [
                'submission_id' => $submissionId,
                'application_id' => $application->id ?? null
            ]);

            // Redirect to main page with success message
            return redirect()->route('main')
                ->with('success', 'Application submitted successfully!');

        } catch (\Exception $e) {
            Log::error('Error processing final submission', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'submission_id' => $submissionId
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while processing your submission. Please try again.')
                ->withInput();
        }
    }
}