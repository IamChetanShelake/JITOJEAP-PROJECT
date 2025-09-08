<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * Display the main page of the JITO JEAP application.
     * 
     * This method handles the main landing page which includes:
     * - Financial Assistance overview
     * - Navigation to create new forms
     * - User interface elements matching Figma design
     * - Recent applications table
     *
     * @return View
     */
    public function index(): View
    {
        // Fetch recent applications for display in table
        $applications = \App\Models\FinancialAssistance::with(['familyDetails', 'educationDetails'])
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();
            
        return view('main', [
            'pageTitle' => 'JITO JEAP - Financial Assistance',
            'mainTitle' => 'Financial Assistance',
            'subtitle' => 'Apply for Educational Support',
            'breadcrumbItems' => [
                ['name' => 'EF Assistance', 'active' => false],
                ['name' => 'Financial Assistance', 'active' => true]
            ],
            'applications' => $applications
        ]);
    }

    /**
     * Handle search functionality for applicants
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search', '');
        
        if (strlen($searchTerm) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Search term must be at least 2 characters',
                'results' => []
            ]);
        }
        
        // Search in FinancialAssistance model
        // You can expand this to search in other models as needed
        try {
            $results = \App\Models\FinancialAssistance::where(function($query) use ($searchTerm) {
                $query->where('applicant', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('student_first_name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('middle_name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('aadhar_number', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('student_email', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('student_mobile', 'LIKE', "%{$searchTerm}%");
            })
            ->select('id', 'applicant', 'student_first_name', 'middle_name', 'last_name', 'aadhar_number', 'student_email', 'student_mobile', 'created_at', 'form_status', 'financial_asst_type', 'financial_asst_for')
            ->limit(10)
            ->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Search completed successfully',
                'search_term' => $searchTerm,
                'results' => $results,
                'count' => $results->count()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed: ' . $e->getMessage(),
                'results' => []
            ], 500);
        }
    }

    /**
     * Redirect to financial assistance form creation
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createForm()
    {
        return redirect()->route('financial-assistance');
    }
}