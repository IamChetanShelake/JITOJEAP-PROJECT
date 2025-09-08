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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
     * Display the preview page with all details
     */
    public function preview(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submissionId');

            if (!$submissionId) {
                return redirect()->route('financial-assistance')
                    ->with('error', 'Please complete previous steps first.');
            }

            // Get all related data with proper relationships
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();
            $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();
            $fundingDetails = FundingDetails::bySubmissionId($submissionId)->first();
            $guarantorDetails = GuarantorDetails::bySubmissionId($submissionId)->first();
            $documents = Document::bySubmissionId($submissionId)->get();

            return view('preview-submission', [
                'application' => $application,
                'familyDetails' => $familyDetails,
                'educationDetails' => $educationDetails,
                'fundingDetails' => $fundingDetails,
                'guarantorDetails' => $guarantorDetails,
                'documents' => $documents,
                'submissionId' => $submissionId
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading preview page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'An error occurred while loading the preview. Please try again.');
        }
    }

    /**
     * Process the final submission
     */
    public function store(Request $request)
    {
        try {
            // Check if it's an AJAX request
            $isAjax = $request->ajax() || $request->wantsJson();
            
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            // Validate declaration checkboxes
            $validator = Validator::make($request->all(), [
                'declaration_checkbox_1' => 'required|accepted',
                'declaration_checkbox_2' => 'required|accepted',
            ], [
                'declaration_checkbox_1.required' => 'Please agree to the first declaration.',
                'declaration_checkbox_1.accepted' => 'Please agree to the first declaration.',
                'declaration_checkbox_2.required' => 'Please agree to the second declaration.',
                'declaration_checkbox_2.accepted' => 'Please agree to the second declaration.',
            ]);

            if ($validator->fails()) {
                if ($isAjax) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please check the declaration checkboxes.'
                    ]);
                }
                return redirect()->back()
                    ->withErrors($validator)
                    ->with('error', 'Please check the declaration checkboxes.')
                    ->withInput();
            }

            if (!$submissionId) {
                if ($isAjax) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Session expired. Please start from the beginning.'
                    ]);
                }
                return redirect()->back()
                    ->with('error', 'Session expired. Please start from the beginning.')
                    ->withInput();
            }

            // Handle signature if provided
            $signatureData = [];
            if ($request->has('signature_type')) {
                $signatureData['signature_type'] = $request->input('signature_type');
                $signatureData['signature_date'] = now();
                
                switch ($request->input('signature_type')) {
                    case 'upload':
                        if ($request->hasFile('signature_image')) {
                            $signaturePath = $request->file('signature_image')->store('signatures/' . $submissionId, 'public');
                            $signatureData['signature_image_path'] = $signaturePath;
                        }
                        break;
                    case 'draw':
                        $signatureData['signature_drawn_data'] = $request->input('signature_drawn_data');
                        break;
                    case 'type':
                        $signatureData['signature_typed_name'] = $request->input('signature_typed_name');
                        break;
                }
            }

            // Log the final submission
            Log::info('Final submission processing', [
                'submission_id' => $submissionId,
                'signature_type' => $signatureData['signature_type'] ?? 'none'
            ]);

            // Update the application with signature data and status
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            
            if ($application) {
                $updateData = [
                    'form_status' => 'submitted',
                    'current_step' => 7 // Final step
                ];
                
                // Merge signature data if provided
                if (!empty($signatureData)) {
                    $updateData = array_merge($updateData, $signatureData);
                }
                
                $application->update($updateData);
            }

            // Clear session data
            Session::forget('submission_id');

            Log::info('Final submission completed successfully', [
                'submission_id' => $submissionId,
                'application_id' => $application->id ?? null
            ]);

            // For AJAX requests, return success response with redirect URL
            if ($isAjax && $application) {
                return response()->json([
                    'success' => true,
                    'message' => 'Application submitted successfully!',
                    'redirect_url' => route('financial-assistance.pdf', ['id' => $application->id])
                ]);
            }
            
            // For non-AJAX requests, redirect to PDF download if application exists
            if ($application) {
                return redirect()->route('financial-assistance.pdf', ['id' => $application->id])
                    ->with('success', 'Application submitted successfully! Downloading PDF...');
            }

            // Fallback redirect to main page with success message
            return redirect()->route('main')
                ->with('success', 'Application submitted successfully!');

        } catch (\Exception $e) {
            Log::error('Error processing final submission', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'submission_id' => $submissionId
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing your submission. Please try again.'
                ]);
            }

            return redirect()->back()
                ->with('error', 'An error occurred while processing your submission. Please try again.')
                ->withInput();
        }
    }
}