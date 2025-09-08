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
                return redirect()->back()
                    ->with('error', 'Session expired. Please start from the beginning.')
                    ->withInput();
            }

            // Validate education details - Making all fields required
            $validator = Validator::make($request->all(), [
                // Previous Education Details (dynamic table)
                'previous_education' => 'required|array',
                'previous_education.*.exam_name' => 'required|string|max:255',
                'previous_education.*.course_name' => 'required|string|max:255',
                'previous_education.*.exam_month' => 'required|string|max:50',
                'previous_education.*.exam_year' => 'required|integer|min:1950|max:' . date('Y'),
                'previous_education.*.out_of_marks' => 'required|numeric|min:0',
                'previous_education.*.marks_obtained' => 'required|numeric|min:0',
                'previous_education.*.percentage' => 'required|numeric|min:0|max:100',

                // Work Experience and Activities
                'extracurricular_activities' => 'required|string',
                'research_projects' => 'required|string',
                'work_experience_years' => 'required|numeric|min:0',
                'company_name' => 'required|string|max:255',
                'remuneration' => 'required|numeric|min:0',
                'ctc_yearly' => 'required|numeric|min:0',
                'work_profile' => 'required|string',

                // Current Education Details
                'course_name_current' => 'required|string|max:255',
                'pursuing_education' => 'required|string|max:255',
                'university_college_name' => 'required|string|max:255',
                'commencement_month_year' => 'required|string|max:50',
                'completion_month_year' => 'required|string|max:50',
                'city' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'qs_ranking_foreign' => 'required|string|max:255',
                'nirf_ranking_domestic' => 'required|string|max:255',
            ], [
                // Custom error messages for all fields
                'previous_education.required' => 'Previous education details are required.',
                'previous_education.*.exam_name.required' => 'Exam name is required.',
                'previous_education.*.course_name.required' => 'Course name is required.',
                'previous_education.*.exam_month.required' => 'Exam month is required.',
                'previous_education.*.exam_year.required' => 'Exam year is required.',
                'previous_education.*.exam_year.integer' => 'Exam year must be a valid year.',
                'previous_education.*.exam_year.min' => 'Exam year must be 1950 or later.',
                'previous_education.*.exam_year.max' => 'Exam year cannot be in the future.',
                'previous_education.*.out_of_marks.required' => 'Out of marks is required.',
                'previous_education.*.out_of_marks.numeric' => 'Out of marks must be a number.',
                'previous_education.*.marks_obtained.required' => 'Marks obtained is required.',
                'previous_education.*.marks_obtained.numeric' => 'Marks obtained must be a number.',
                'previous_education.*.percentage.required' => 'Percentage is required.',
                'previous_education.*.percentage.numeric' => 'Percentage must be a number.',
                'extracurricular_activities.required' => 'Extracurricular activities field is required.',
                'research_projects.required' => 'Research projects field is required.',
                'work_experience_years.required' => 'Work experience years field is required.',
                'work_experience_years.numeric' => 'Work experience must be a number.',
                'company_name.required' => 'Company name is required.',
                'remuneration.required' => 'Remuneration field is required.',
                'remuneration.numeric' => 'Remuneration must be a number.',
                'ctc_yearly.required' => 'CTC yearly field is required.',
                'ctc_yearly.numeric' => 'CTC must be a number.',
                'work_profile.required' => 'Work profile field is required.',
                'course_name_current.required' => 'Course name is required.',
                'pursuing_education.required' => 'Pursuing education field is required.',
                'university_college_name.required' => 'University/college name is required.',
                'commencement_month_year.required' => 'Commencement month/year is required.',
                'completion_month_year.required' => 'Completion month/year is required.',
                'city.required' => 'City is required.',
                'country.required' => 'Country is required.',
                'qs_ranking_foreign.required' => 'QS ranking field is required.',
                'nirf_ranking_domestic.required' => 'NIRF ranking field is required.',
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

            // Redirect to the next step with success message
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
                return redirect()->back()
                    ->with('error', 'Education details not found.');
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

            return redirect()->back()
                ->with('success', 'Education details deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Error deleting education details', [
                'error' => $e->getMessage(),
                'submission_id' => $submissionId
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while deleting education details.');
        }
    }
}