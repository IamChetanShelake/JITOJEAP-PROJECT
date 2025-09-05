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
        $applications = \App\Models\FinancialAssistance::latest()
            ->take(10)
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
                $query->where('applicant_name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('aadhar_number', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('mobile_number', 'LIKE', "%{$searchTerm}%");
            })
            ->select('id', 'applicant_name', 'aadhar_number', 'email', 'mobile_number', 'created_at')
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