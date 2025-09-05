<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemoController extends Controller
{
    /**
     * Display the demo form
     */
    public function index()
    {
        return view('demo', [
            'title' => 'JITO JEAP - Demo Form'
        ]);
    }
    
    /**
     * Handle form submission
     */
    public function submit(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'category' => 'required|in:business,personal,education,other',
            'message' => 'required|string|max:1000'
        ]);
        
        // Check if validation fails
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Process the form data
        $formData = $validator->validated();
        
        // Here you can save to database or send email
        // For now, we'll just log the data
        \Log::info('Demo form submitted', $formData);
        
        // Success response
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully!',
                'data' => $formData
            ]);
        }
        
        return redirect()->back()->with('success', 'Form submitted successfully! Thank you for your submission.');
    }
    
    /**
     * API endpoint for form submission (JSON only)
     */
    public function apiSubmit(Request $request)
    {
        // Validation with JSON response
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255', 
            'phone' => 'required|string|max:20',
            'category' => 'required|in:business,personal,education,other',
            'message' => 'required|string|max:1000'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        
        $formData = $validator->validated();
        
        // Process data (save to database, send notifications, etc.)
        \Log::info('API Demo form submitted', $formData);
        
        return response()->json([
            'success' => true,
            'message' => 'Form submitted successfully via API!',
            'data' => $formData
        ], 200);
    }
}
