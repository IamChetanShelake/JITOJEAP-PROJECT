<?php

namespace App\Http\Controllers;

use App\Models\FinancialAssistance;
use App\Models\FamilyDetails;
use App\Models\EducationDetails;
use App\Models\FundingDetails;
use App\Models\GuarantorDetails;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Generate and download PDF for the financial assistance application
     */
    public function generatePDF($id)
    {
        try {
            // Get all related data
            $application = FinancialAssistance::findOrFail($id);
            $familyDetails = FamilyDetails::bySubmissionId($application->submission_id)->first();
            $educationDetails = EducationDetails::bySubmissionId($application->submission_id)->first();
            $fundingDetails = FundingDetails::bySubmissionId($application->submission_id)->first();
            $guarantorDetails = GuarantorDetails::bySubmissionId($application->submission_id)->first();

            // Prepare data for the PDF view
            $data = [
                'application' => $application,
                'familyDetails' => $familyDetails,
                'educationDetails' => $educationDetails,
                'fundingDetails' => $fundingDetails,
                'guarantorDetails' => $guarantorDetails,
            ];

            // Load the PDF view
            $pdf = Pdf::loadView('pdf.application-form', $data);

            // Set paper size and orientation
            $pdf->setPaper('A4', 'portrait');

            // Return the PDF as a download
            return $pdf->download('JEAP-EF-ASST-APPLICATION-FORM-' . $application->submission_id . '.pdf');
        } catch (\Exception $e) {
            // Log the error and redirect back with error message
            \Log::error('Error generating PDF: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('main')->with('error', 'Error generating PDF. Please try again.');
        }
    }
}