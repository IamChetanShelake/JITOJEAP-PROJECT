<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\FinancialAssistance;

class FinancialAssistanceController extends Controller
{
    public function index()
    {
        return view('financial-assistance');
    }

    public function familyDetails()
    {
        return view('family-details');
    }

    public function store(Request $request)
    {
        try {
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

            // If same_as_permanent is checked, copy permanent address to correspondence address
            if (isset($validatedData['same_as_permanent']) && $validatedData['same_as_permanent']) {
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

            // Add timestamps
            $validatedData['created_at'] = now();
            $validatedData['updated_at'] = now();

            // Save to database
            $application = FinancialAssistance::create($validatedData);

            Log::info('Financial assistance application saved', [
                'id' => $application->id,
                'applicant' => $validatedData['applicant'],
                'student_name' => $validatedData['student_first_name'] . ' ' . $validatedData['last_name'],
                'request_date' => $validatedData['request_date']
            ]);

            // return response()->json([
            //     'success' => true,
            //     'message' => 'Personal details saved successfully!',
            //     'data' => [
            //         'id' => $application->id,
            //         'step' => 1,
            //         'next_step' => 'family-details',
            //         'completion_percentage' => 14.3 // 1/7 steps
            //     ]
            // ], 200);
            return view('family-details');

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
}