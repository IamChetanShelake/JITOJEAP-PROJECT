<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FundingDetails;
use App\Models\FinancialAssistance;
use Illuminate\Support\Str;

class TestFundingDetailsInsertion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-funding-details-insertion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test funding details insertion';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // First, create a financial assistance record to satisfy the foreign key constraint
            $financialAssistance = FinancialAssistance::first();
            if (!$financialAssistance) {
                $this->error("No financial assistance record found. Creating one...");
                $financialAssistance = new FinancialAssistance();
                $financialAssistance->submission_id = Str::uuid();
                $financialAssistance->full_name = 'Test User';
                $financialAssistance->email = 'test@example.com';
                $financialAssistance->mobile_number = '1234567890';
                $financialAssistance->form_status = 'draft';
                $financialAssistance->current_step = 4; // Set to step 4 to allow funding details
                $financialAssistance->save();
            }
            
            $submissionId = $financialAssistance->submission_id;
            $this->info("Using submission ID: " . $submissionId);
            
            // Check if funding details already exist for this submission
            $existingFundingDetails = FundingDetails::where('submission_id', $submissionId)->first();
            if ($existingFundingDetails) {
                $this->info("Funding details already exist for this submission. Updating...");
                $fundingDetails = $existingFundingDetails;
            } else {
                $this->info("Creating new funding details record...");
                $fundingDetails = new FundingDetails();
                $fundingDetails->submission_id = $submissionId;
            }
            
            $fundingDetails->student_name = 'Test Student';
            $fundingDetails->student_account_number = '1234567890';
            $fundingDetails->ifsc_code = 'IFSC1234567';
            $fundingDetails->bank_name = 'Test Bank';
            $fundingDetails->branch_name = 'Test Branch';
            $fundingDetails->bank_address = 'Test Address';
            $fundingDetails->form_status = 'completed';
            
            // Test funding details table data
            $fundingDetails->funding_details_table = [
                [
                    'particulars' => 'Test Particulars',
                    'status' => 'Active',
                    'trust_institute_name' => 'Test Institute',
                    'contact_person_name' => 'Test Contact',
                    'contact_number' => '1234567890',
                    'amount' => 1000.00
                ]
            ];
            
            if ($fundingDetails->save()) {
                $this->info("Data inserted/updated successfully");
                $this->info("ID: " . $fundingDetails->id);
                $this->info("Submission ID: " . $fundingDetails->submission_id);
                return 0;
            } else {
                $this->error("Failed to insert/update data");
                return 1;
            }
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }
    }
}