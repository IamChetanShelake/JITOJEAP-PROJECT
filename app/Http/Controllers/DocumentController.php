<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use App\Models\EducationDetails;
use App\Models\FundingDetails;
use App\Models\GuarantorDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    /**
     * Display the documents form
     */
    public function index(Request $request)
    {
        try {
            // Get submission ID from session or request
            $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

            Log::info('Accessing documents page', [
                'submission_id_from_request' => $request->get('submission_id'),
                'submission_id_from_session' => Session::get('submission_id'),
                'final_submission_id' => $submissionId
            ]);

            if (!$submissionId) {
                Log::warning('No submission ID found for documents');
                return redirect()->route('financial-assistance')
                    ->with('error', 'Please complete previous steps first.');
            }

            // Check if previous steps are completed
            $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
            $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();
            $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();
            $fundingDetails = FundingDetails::bySubmissionId($submissionId)->first();
            $guarantorDetails = GuarantorDetails::bySubmissionId($submissionId)->first();

            if (!$personalDetails || $personalDetails->current_step < 6) {
                Log::warning('Previous steps not completed for documents', [
                    'submission_id' => $submissionId,
                    'current_step' => $personalDetails->current_step ?? null
                ]);
                return redirect()->route('guarantor-details', ['submission_id' => $submissionId])
                    ->with('error', 'Please complete guarantor details first.');
            }

            // Get existing documents if any
            $existingDocuments = Document::bySubmissionId($submissionId)->get();

            Log::info('Loading documents page successfully', [
                'submission_id' => $submissionId,
                'existing_documents_count' => $existingDocuments->count()
            ]);

            return view('documents', [
                'existingDocuments' => $existingDocuments,
                'submissionId' => $submissionId,
                'personalDetails' => $personalDetails,
                'familyDetails' => $familyDetails,
                'educationDetails' => $educationDetails,
                'fundingDetails' => $fundingDetails,
                'guarantorDetails' => $guarantorDetails
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading documents page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('financial-assistance')
                ->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Store or update documents
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

            // Log the incoming request data for debugging
            Log::info('Documents form submission', [
                'submission_id' => $submissionId,
                'request_data' => $request->except(['_token'])
            ]);

            // Define required document types
            $requiredDocumentTypes = [
                'recommendation_letter',
                'jain_sangh_certification',
                'other_documents'
            ];

            // Validate that all required documents are uploaded
            $errors = [];
            foreach ($requiredDocumentTypes as $docType) {
                if (!$request->hasFile($docType)) {
                    $errors[$docType] = ["The {$docType} document is required."];
                }
            }

            if (!empty($errors)) {
                return redirect()->back()
                    ->withErrors($errors)
                    ->with('error', 'Please upload all required documents.')
                    ->withInput();
            }

            // Process and store each document
            foreach (array_merge($requiredDocumentTypes, ['additional_documents']) as $docType) {
                if ($request->hasFile($docType)) {
                    $file = $request->file($docType);
                    
                    // Validate file
                    $validator = Validator::make([$docType => $file], [
                        $docType => 'file|mimes:jpeg,png,jpg,pdf|max:2048' // 2MB max
                    ], [
                        "{$docType}.file" => "The {$docType} must be a file.",
                        "{$docType}.mimes" => "The {$docType} must be a file of type: jpeg, png, jpg, pdf.",
                        "{$docType}.max" => "The {$docType} may not be greater than 2MB."
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->with('error', 'Please check the documents for errors.')
                            ->withInput();
                    }

                    // Store file
                    $filePath = $file->store('documents/' . $submissionId, 'public');
                    
                    // Save document record
                    Document::updateOrCreate(
                        [
                            'submission_id' => $submissionId,
                            'document_type' => $docType
                        ],
                        [
                            'file_path' => $filePath,
                            'uploaded_at' => now(),
                            'form_status' => 'completed'
                        ]
                    );
                }
            }

            // Update the main application step
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step < 7) {
                $application->update(['current_step' => 7]);
            }

            Log::info('Documents saved', [
                'submission_id' => $submissionId,
                'document_count' => count($requiredDocumentTypes)
            ]);

            // Redirect to the final submit page with success message
            return redirect()->route('final-submission', ['submission_id' => $submissionId])
                ->with('success', 'Documents saved successfully!');

        } catch (\Exception $e) {
            Log::error('Error processing documents', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token'])
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while processing documents. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display specific document for editing
     */
    public function edit($submissionId)
    {
        $documents = Document::bySubmissionId($submissionId)->get();

        if ($documents->isEmpty()) {
            return redirect()->route('documents')
                ->with('error', 'Documents not found.');
        }

        $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
        $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();
        $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();
        $fundingDetails = FundingDetails::bySubmissionId($submissionId)->first();
        $guarantorDetails = GuarantorDetails::bySubmissionId($submissionId)->first();

        return view('documents', [
            'existingDocuments' => $documents,
            'submissionId' => $submissionId,
            'personalDetails' => $personalDetails,
            'familyDetails' => $familyDetails,
            'educationDetails' => $educationDetails,
            'fundingDetails' => $fundingDetails,
            'guarantorDetails' => $guarantorDetails
        ]);
    }

    /**
     * Delete document
     */
    public function destroy($submissionId)
    {
        try {
            $documents = Document::bySubmissionId($submissionId)->get();

            if ($documents->isEmpty()) {
                return redirect()->back()
                    ->with('error', 'Documents not found.');
            }

            // Delete document records
            foreach ($documents as $document) {
                // Delete file from storage
                if (Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
                
                // Delete database record
                $document->delete();
            }

            // Update the main application step back to 6
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step > 6) {
                $application->update(['current_step' => 6]);
            }

            Log::info('Documents deleted', [
                'submission_id' => $submissionId,
                'document_count' => $documents->count()
            ]);

            return redirect()->back()
                ->with('success', 'Documents deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Error deleting documents', [
                'error' => $e->getMessage(),
                'submission_id' => $submissionId
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while deleting documents.');
        }
    }
}