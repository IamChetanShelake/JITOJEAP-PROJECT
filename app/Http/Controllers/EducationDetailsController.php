<?php

namespace App\Http\Controllers;

use App\Models\EducationDetails;
use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EducationDetailsController extends Controller
{
    /**
     * Display the education details form
     */
    public function index(Request $request)
    {
        // Get submission ID from session or request
        $submissionId = $request->get('submission_id') ?? Session::get('submission_id');

        if (!$submissionId) {
            return redirect()->route('financial-assistance')
                ->with('error', 'Please complete previous steps first.');
        }

        // Check if personal details and family details are completed
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

    /**
     * Store or update education details
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
     * Display specific education details for editing
     */
    public function edit($submissionId)
    {
        $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();

        if (!$educationDetails) {
            return redirect()->route('education-details')
                ->with('error', 'Education details not found.');
        }

        $personalDetails = FinancialAssistance::bySubmissionId($submissionId)->first();
        $familyDetails = FamilyDetails::bySubmissionId($submissionId)->first();

        return view('education-details', [
            'existingData' => $educationDetails,
            'submissionId' => $submissionId,
            'personalDetails' => $personalDetails,
            'familyDetails' => $familyDetails
        ]);
    }

    /**
     * Delete education details
     */
    public function destroy($submissionId)
    {
        try {
            $educationDetails = EducationDetails::bySubmissionId($submissionId)->first();

            if (!$educationDetails) {
                return response()->json([
                    'success' => false,
                    'message' => 'Education details not found.'
                ], 404);
            }

            $educationDetails->delete();

            // Update the main application step back to 3
            $application = FinancialAssistance::bySubmissionId($submissionId)->first();
            if ($application && $application->current_step > 3) {
                $application->update(['current_step' => 3]);
            }

            Log::info('Education details deleted', [
                'submission_id' => $submissionId,
                'education_details_id' => $educationDetails->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Education details deleted successfully.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting education details', [
                'error' => $e->getMessage(),
                'submission_id' => $submissionId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting education details.'
            ], 500);
        }
    }
}
