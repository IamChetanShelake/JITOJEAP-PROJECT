<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuarantorDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function testGuarantor(Request $request)
    {
        // Log all request data
        Log::info('Test guarantor request data', [
            'all_data' => $request->all()
        ]);
        
        // Try to validate with the same rules as GuarantorDetailsController
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
        ]);
        
        if ($validator->fails()) {
            Log::info('Test guarantor validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // If validation passes, try to create a record
        try {
            $validatedData = $validator->validated();
            $validatedData['submission_id'] = 'test-submission-id';
            $validatedData['form_status'] = 'completed';
            
            $guarantorDetails = GuarantorDetails::create($validatedData);
            
            return response()->json([
                'success' => true,
                'message' => 'Test successful',
                'data' => $guarantorDetails
            ]);
        } catch (\Exception $e) {
            Log::error('Test guarantor creation failed', [
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Creation failed: ' . $e->getMessage()
            ], 500);
        }
    }
}