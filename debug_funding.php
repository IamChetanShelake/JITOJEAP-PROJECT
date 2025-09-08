<?php
require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\FundingDetails;

// Get the funding details for the submission ID
$fundingDetails = FundingDetails::where('submission_id', '0d6acdad-c799-442c-aecb-a75fb2e42613')->first();

if ($fundingDetails) {
    echo "Funding Details Table Data:\n";
    echo json_encode($fundingDetails->funding_details_table, JSON_PRETTY_PRINT);
    echo "\n\n";
    
    // Let's also check the structure of each item
    if (is_array($fundingDetails->funding_details_table)) {
        foreach ($fundingDetails->funding_details_table as $index => $item) {
            echo "Item $index:\n";
            print_r($item);
            echo "\n";
        }
    }
} else {
    echo "No funding details found for the given submission ID.\n";
}