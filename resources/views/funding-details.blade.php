<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Financial Assistance Form - Funding Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: "Inter", sans-serif; }
        .project-primary { color: #556EE6; }
        .project-success { color: #009846; }
        .project-warning { color: #FBBA00; }
        .bg-project-primary { background-color: #556EE6; }
        .bg-project-success { background-color: #009846; }
        .bg-project-warning { background-color: #FBBA00; }
        .hover\:bg-project-primary:hover { background-color: #4c63d2; }
        .hover\:bg-project-success:hover { background-color: #008139; }
        .hover\:bg-project-warning:hover { background-color: #e6a800; }
    </style>
</head>
<body class="bg-white text-gray-900">
    <!-- Header Section -->
    <header class="flex justify-between items-center px-6 py-6 max-w-[1200px] mx-auto">
        <!-- Breadcrumb Navigation -->
        <div class="flex items-center space-x-2 text-sm text-gray-700">
            <i class="fas fa-chevron-left text-xs"></i>
            <a class="font-semibold project-primary hover:underline" href="{{ route('main') }}">Financial Assistance</a>
            <span>/ New</span>
        </div>

        <!-- Logo and Navigation Icons -->
        <div class="flex items-center space-x-4" style="display: flex;flex-direction: column;row-gap: 20px;">
            <img alt="JITO JEAP Education Assistance Program logo" class="w-[100px] h-[40px] object-contain"
                 height="40" src="{{ asset('assets/images/logo.png') }}" width="100"/>
            <div class="flex items-center space-x-4 text-gray-700 text-lg" style="display: flex; column-gap: 18px;">
                <i class="far fa-comment-alt cursor-pointer hover:text-blue-600 transition-colors" title="Messages"></i>
                <i class="far fa-bell cursor-pointer hover:text-blue-600 transition-colors" title="Notifications"></i>
                <i class="far fa-user-circle cursor-pointer hover:text-blue-600 transition-colors" title="Profile"></i>
            </div>
        </div>
    </header>

    <!-- Action Buttons Section -->
    <section class="max-w-[1200px] mx-auto px-6">
        <div class="flex flex-wrap gap-3 mb-4">
            <button class="flex items-center gap-2 bg-project-primary hover:bg-project-primary text-white text-sm font-semibold px-4 py-2 rounded transition-colors">
                <i class="fas fa-print"></i> Print
            </button>
            <button class="flex items-center gap-2 bg-project-warning hover:bg-project-warning text-black text-sm font-semibold px-4 py-2 rounded transition-colors">
                <i class="fas fa-cogs"></i> Action
            </button>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-900 text-sm font-normal px-4 py-2 rounded transition-colors">
                Save to Draft
            </button>
        </div>
    </section>

    <!-- Important Note Section -->
    <section class="bg-yellow-50 text-red-600 text-center text-xs font-semibold py-2 mb-6 max-w-[1200px] mx-auto px-6">
        *NOTE:- STUDENT HAS TO FILL ALL THE DETAILS IN 7 PAGES AND IN SUBMIT SECTION PLEASE CLICK
    </section>

    @if(isset($submissionId))
    <!-- Session Info -->
    <section class="max-w-[1200px] mx-auto px-6 mb-4">
        <div class="bg-blue-50 border border-blue-200 rounded-md p-3 text-sm">
            <div class="flex items-center justify-between">
                <span class="text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Session ID: <strong>{{ substr($submissionId, 0, 8) }}...</strong>
                </span>
                <span class="text-blue-600 font-semibold">Step 4/7 - Funding Details</span>
            </div>
        </div>
    </section>
    @endif

    <main class="max-w-[1200px] mx-auto px-6 py-8">
        <form method="POST" action="{{ route('funding-details.store') }}" id="funding-form">
            @csrf
            @if(isset($submissionId))
                <input type="hidden" name="submission_id" value="{{ $submissionId }}">
            @endif

            <!-- Form Navigation Tabs -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <nav class="flex flex-wrap gap-1 text-[11px] font-semibold text-gray-600">
                    <button id="personal-details-tab" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1 hover:bg-green-600 transition-colors cursor-pointer">
                        ✓ Personal Details
                    </button>
                    <button id="family-details-tab" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1 hover:bg-green-600 transition-colors cursor-pointer">
                        ✓ Family Details
                    </button>
                    <button id="education-details-tab" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1 hover:bg-green-600 transition-colors cursor-pointer">
                        ✓ Education Details
                    </button>
                    <button aria-current="step" class="flex items-center gap-1 bg-project-primary text-white rounded px-3 py-1">
                        Funding Details
                    </button>
                    <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1 text-gray-400 cursor-not-allowed">
                        Guarantor Details
                    </button>
                    <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1 text-gray-400 cursor-not-allowed">
                        Documents
                    </button>
                    <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1 text-gray-400 cursor-not-allowed">
                        Submit
                    </button>
                </nav>
            </section>

            <!-- Funding Details Section -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <div class="text-xs text-gray-700 mb-6">

                    <!-- Amount Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 mb-6">
                        <div>
                            <label for="amount_requested_years" class="block mb-1 text-sm">Amount Requested for Years</label>
                            <select id="amount_requested_years" name="amount_requested_years" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm">
                                <option value="">Select Years</option>
                                <option value="1" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '1' ? 'selected' : '' }}>1 Year</option>
                                <option value="2" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '2' ? 'selected' : '' }}>2 Years</option>
                                <option value="3" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '3' ? 'selected' : '' }}>3 Years</option>
                                <option value="4" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '4' ? 'selected' : '' }}>4 Years</option>
                                <option value="5" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '5' ? 'selected' : '' }}>5 Years</option>
                            </select>
                        </div>
                        <div>
                            <label for="tuition_fees_amount" class="block mb-1 text-sm">Amount Tuition Fees in Indian Rupees</label>
                            <input id="tuition_fees_amount" name="tuition_fees_amount" type="number" step="0.01" value="{{ old('tuition_fees_amount', $existingData->tuition_fees_amount ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                    </div>

                    <!-- Funding Details Table -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-sm">Funding Details</h3>
                            {{-- <div class="flex gap-2">
                                <button type="button" id="add-funding" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                    Add
                                </button>
                                <button type="button" id="remove-funding" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                    Remove
                                </button>
                            </div> --}}
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="text-white text-xs" style="background: #0A2478;">
                                        <th class="border border-white px-2 py-2 text-center w-16">Sr. No.</th>
                                        <th class="border border-white px-2 py-2 text-center">Particulars</th>
                                        <th class="border border-white px-2 py-2 text-center">Status</th>
                                        <th class="border border-white px-2 py-2 text-center">Name Of Trust/Institute</th>
                                        <th class="border border-white px-2 py-2 text-center">Name Of Contact Person</th>
                                        <th class="border border-white px-2 py-2 text-center">Contact Number</th>
                                        <th class="border border-white px-2 py-2 text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="funding-table-body">
                                    @if(isset($existingData) && $existingData->funding_details_table && is_array($existingData->funding_details_table))
                                        @foreach($existingData->funding_details_table as $index => $funding)
                                            <tr class="funding-row" style="background-color: {{ ($index % 2 == 0) ? '#FFF7D3' : '#FFC4C4' }};">
                                                <td class="border border-white px-2 py-1 text-center row-number">{{ $index + 1 }}</td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][particulars]" value="{{ old('funding_details_table.'.$index.'.particulars', $funding['particulars'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][status]" value="{{ old('funding_details_table.'.$index.'.status', $funding['status'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][trust_institute_name]" value="{{ old('funding_details_table.'.$index.'.trust_institute_name', $funding['trust_institute_name'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][contact_person_name]" value="{{ old('funding_details_table.'.$index.'.contact_person_name', $funding['contact_person_name'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][contact_number]" value="{{ old('funding_details_table.'.$index.'.contact_number', $funding['contact_number'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="number" name="funding_details_table[{{ $index }}][amount]" value="{{ old('funding_details_table.'.$index.'.amount', $funding['amount'] ?? '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <!-- Default predefined rows based on the reference image -->
                                        <tr class="funding-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">1</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][particulars]" value="{{ old('funding_details_table.0.particulars', 'Own family funding (Father + Mother)') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][status]" value="{{ old('funding_details_table.0.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][trust_institute_name]" value="{{ old('funding_details_table.0.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][contact_person_name]" value="{{ old('funding_details_table.0.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][contact_number]" value="{{ old('funding_details_table.0.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[0][amount]" value="{{ old('funding_details_table.0.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFC4C4;">
                                            <td class="border border-white px-2 py-1 text-center row-number">2</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][particulars]" value="{{ old('funding_details_table.1.particulars', 'Bank Loan') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][status]" value="{{ old('funding_details_table.1.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][trust_institute_name]" value="{{ old('funding_details_table.1.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][contact_person_name]" value="{{ old('funding_details_table.1.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][contact_number]" value="{{ old('funding_details_table.1.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[1][amount]" value="{{ old('funding_details_table.1.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">3</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][particulars]" value="{{ old('funding_details_table.2.particulars', 'Other Assistance(1)') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][status]" value="{{ old('funding_details_table.2.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][trust_institute_name]" value="{{ old('funding_details_table.2.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][contact_person_name]" value="{{ old('funding_details_table.2.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][contact_number]" value="{{ old('funding_details_table.2.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[2][amount]" value="{{ old('funding_details_table.2.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFC4C4;">
                                            <td class="border border-white px-2 py-1 text-center row-number">4</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][particulars]" value="{{ old('funding_details_table.3.particulars', 'Other Assistance(2)') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][status]" value="{{ old('funding_details_table.3.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][trust_institute_name]" value="{{ old('funding_details_table.3.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][contact_person_name]" value="{{ old('funding_details_table.3.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][contact_number]" value="{{ old('funding_details_table.3.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[3][amount]" value="{{ old('funding_details_table.3.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">5</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][particulars]" value="{{ old('funding_details_table.4.particulars', 'Other Assistance(3)') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][status]" value="{{ old('funding_details_table.4.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][trust_institute_name]" value="{{ old('funding_details_table.4.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][contact_person_name]" value="{{ old('funding_details_table.4.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][contact_number]" value="{{ old('funding_details_table.4.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[4][amount]" value="{{ old('funding_details_table.4.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFC4C4;">
                                            <td class="border border-white px-2 py-1 text-center row-number">6</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][particulars]" value="{{ old('funding_details_table.5.particulars', 'Local Assistance') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][status]" value="{{ old('funding_details_table.5.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][trust_institute_name]" value="{{ old('funding_details_table.5.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][contact_person_name]" value="{{ old('funding_details_table.5.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][contact_number]" value="{{ old('funding_details_table.5.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[5][amount]" value="{{ old('funding_details_table.5.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">7</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][particulars]" value="{{ old('funding_details_table.6.particulars', 'Total') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" readonly />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][status]" value="{{ old('funding_details_table.6.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][trust_institute_name]" value="{{ old('funding_details_table.6.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][contact_person_name]" value="{{ old('funding_details_table.6.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][contact_number]" value="{{ old('funding_details_table.6.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[6][amount]" value="{{ old('funding_details_table.6.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent total-amount" readonly />
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Previous Financial Assistance -->
                    <div class="mb-6">
                        <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4 ">
                            <div class="col-lg-4">
                                <label for="family_received_assistance" class="block mb-1 text-sm">Have your Brother/Sister received Financial assistance from JITO JEAP/JATF/SEED or JITO Chapter?</label>
                                <input id="family_received_assistance" name="family_received_assistance" type="text" value="{{ old('family_received_assistance', $existingData->family_received_assistance ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                            </div>
                            <div class="col-lg-4">
                                <label for="ngo_name" class="block mb-1 text-sm">NGO Name</label>
                                <input id="ngo_name" name="ngo_name" type="text" value="{{ old('ngo_name', $existingData->ngo_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                            </div>
                            <div class="col-lg-4">
                                <label for="loan_status" class="block mb-1 text-sm">Loan Status</label>
                                <input id="loan_status" name="loan_status" type="text" value="{{ old('loan_status', $existingData->loan_status ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 mb-6">

                            <div>
                                <label for="applied_year" class="block mb-1 text-sm">Applied for Year</label>
                                <input id="applied_year" name="applied_year" type="text" value="{{ old('applied_year', $existingData->applied_year ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                            </div>
                            <div>
                                <label for="applied_amount" class="block mb-1 text-sm">Applied Amount</label>
                                <input id="applied_amount" name="applied_amount" type="number" step="0.01" value="{{ old('applied_amount', $existingData->applied_amount ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                            </div>
                        </div>
                    </div>

                    <!-- Bank Account Details -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-sm mb-4">Bank Account Details of Applicant</h3>
                        <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-4 text-sm text-red-700">
                            <strong>Bank Account Details of Applicant - </strong>We only accept cheques of Government Nationalized bank and Banks - HDFC Bank, ICICI Bank, Kotak Mahindra Bank, Axis Bank, IndusInd Bank, IDBI Bank, Yes Bank, IDFC First Bank, etc). Please mention those bank details whose Post Dated Cheques will be submitting us in future if your application is getting sanctioned.
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6">
                            <div>
                                <label for="student_name" class="block mb-1 text-sm">Student Name</label>
                                <input id="student_name" name="student_name" type="text" value="{{ old('student_name', $existingData->student_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                            </div>
                            <div>
                                <label for="student_account_number" class="block mb-1 text-sm">Student Account Number</label>
                                <input id="student_account_number" name="student_account_number" type="text" value="{{ old('student_account_number', $existingData->student_account_number ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                            </div>
                            <div>
                                <label for="ifsc_code" class="block mb-1 text-sm">IFSC Code</label>
                                <input id="ifsc_code" name="ifsc_code" type="text" value="{{ old('ifsc_code', $existingData->ifsc_code ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                            </div>
                            <div>
                                <label for="bank_name" class="block mb-1 text-sm">Bank Name</label>
                                <input id="bank_name" name="bank_name" type="text" value="{{ old('bank_name', $existingData->bank_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                            </div>
                            <div>
                                <label for="branch_name" class="block mb-1 text-sm">Branch Name</label>
                                <input id="branch_name" name="branch_name" type="text" value="{{ old('branch_name', $existingData->branch_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                            </div>
                            <div>
                                <label for="bank_address" class="block mb-1 text-sm">Bank Address</label>
                                <textarea id="bank_address" name="bank_address" rows="3" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required>{{ old('bank_address', $existingData->bank_address ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button id="submit-btn" type="submit" class="bg-project-primary hover:bg-project-primary text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors">
                            <span id="submit-text">Save Funding Details 4/7</span>
                            <span id="loading-text" class="hidden">Saving...</span>
                        </button>
                    </div>
                </div>
            </section>
        </form>
    </main>

    <div id="message-container" class="fixed top-4 right-4 z-50"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            const form = document.getElementById('funding-form');
            console.log('Form element:', form);
            
            if (!form) {
                console.error('Form element not found!');
                return;
            }
            
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const loadingText = document.getElementById('loading-text');
            const messageContainer = document.getElementById('message-container');
            // Initialize row count based on existing data
            let fundingRowCount = document.querySelectorAll('.funding-row').length || 7;
            console.log('Initialized funding row count:', fundingRowCount);

            // Function to calculate total amount
            function calculateTotal() {
                const amountInputs = document.querySelectorAll('input[name*="[amount]"]');
                let total = 0;

                amountInputs.forEach((input, index) => {
                    // Skip the last row (Total row)
                    if (index < amountInputs.length - 1) {
                        const value = parseFloat(input.value) || 0;
                        total += value;
                    }
                });

                // Update the total field (last row)
                const totalInput = document.querySelector('.total-amount');
                if (totalInput) {
                    totalInput.value = total.toFixed(2);
                }
            }

            // Add event listeners for amount calculation
            function addAmountListeners() {
                const amountInputs = document.querySelectorAll('input[name*="[amount]"]');
                amountInputs.forEach((input, index) => {
                    // Skip the last row (Total row)
                    if (index < amountInputs.length - 1) {
                        input.addEventListener('input', calculateTotal);
                    }
                });
            }

            // Initialize amount listeners
            addAmountListeners();

            // Calculate initial total
            calculateTotal();

            // Function to update row numbers
            function updateRowNumbers() {
                const rows = document.querySelectorAll('.funding-row');
                rows.forEach((row, index) => {
                    const rowNumber = row.querySelector('.row-number');
                    rowNumber.textContent = index + 1;

                    // Apply alternating colors to entire row (except Total row)
                    const isLastRow = index === rows.length - 1;
                    if (!isLastRow) {
                        const isOddRow = (index % 2) === 0;
                        const backgroundColor = isOddRow ? '#FFF7D3' : '#FFC4C4';
                        row.style.backgroundColor = backgroundColor;
                    }

                    // Update input names (except for Total row)
                    if (!isLastRow) {
                        const inputs = row.querySelectorAll('input');
                        inputs.forEach(input => {
                            const name = input.getAttribute('name');
                            if (name && name.includes('funding_details_table')) {
                                const newName = name.replace(/\[\d+\]/, `[${index}]`);
                                input.setAttribute('name', newName);
                            }
                        });
                    }
                });
            }

            // Add new funding row (before the Total row)
            document.getElementById('add-funding').addEventListener('click', function() {
                const tableBody = document.getElementById('funding-table-body');
                const totalRow = tableBody.querySelector('tr:last-child'); // Get the Total row
                const newRow = document.createElement('tr');
                newRow.className = 'funding-row';

                // Calculate new row index (excluding the Total row)
                const currentRows = document.querySelectorAll('.funding-row');
                const newIndex = currentRows.length - 1; // Exclude Total row from count

                const isOddRow = (newIndex % 2) === 0;
                const backgroundColor = isOddRow ? '#FFF7D3' : '#FFC4C4';
                newRow.style.backgroundColor = backgroundColor;

                newRow.innerHTML = `
                    <td class="border border-white px-2 py-1 text-center row-number">${newIndex + 1}</td>
                    <td class="border border-white px-1 py-1">
                        <input type="text" name="funding_details_table[${newIndex}][particulars]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="text" name="funding_details_table[${newIndex}][status]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="text" name="funding_details_table[${newIndex}][trust_institute_name]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="text" name="funding_details_table[${newIndex}][contact_person_name]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="text" name="funding_details_table[${newIndex}][contact_number]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="number" name="funding_details_table[${newIndex}][amount]" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" />
                    </td>
                `;

                // Insert before the Total row
                tableBody.insertBefore(newRow, totalRow);
                fundingRowCount++;
                updateRowNumbers();
                addAmountListeners();
            });

            // Remove funding row (but not the Total row)
            document.getElementById('remove-funding').addEventListener('click', function() {
                const rows = document.querySelectorAll('.funding-row');
                // Keep at least 2 rows (1 data row + Total row)
                if (rows.length > 2) {
                    // Remove the second-to-last row (keep the Total row)
                    const rowToRemove = rows[rows.length - 2];
                    rowToRemove.remove();
                    fundingRowCount = Math.max(2, fundingRowCount - 1);
                    updateRowNumbers();
                    calculateTotal();
                }
            });

            // Form submission and other functions
            form.addEventListener('submit', function(e) {
                console.log('Form submit event triggered');
                e.preventDefault();
                console.log('Default prevented');
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');

                const formData = new FormData(form);
                console.log('FormData created');
                
                // Debug: Log form data
                console.log('Form data being sent:');
                const formDataLog = {};
                for (let [key, value] of formData.entries()) {
                    if (!formDataLog[key]) {
                        formDataLog[key] = [];
                    }
                    formDataLog[key].push(value);
                }
                console.log(formDataLog);
                
                // Check if CSRF token is present
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log('CSRF Token:', csrfToken);
                
                // Check if required fields are present
                const requiredFields = ['student_name', 'student_account_number', 'ifsc_code', 'bank_name', 'branch_name', 'bank_address'];
                for (const field of requiredFields) {
                    if (!formData.has(field)) {
                        console.warn(`Required field '${field}' not found in form data`);
                    }
                }
                
                // Check if funding details table data is present
                let fundingDetailsFields = [];
                for (let [key, value] of formData.entries()) {
                    if (key.startsWith('funding_details_table')) {
                        fundingDetailsFields.push({key, value});
                    }
                }
                console.log('Funding details table fields:', fundingDetailsFields);
                
                // Check if we have enough funding details table data
                const expectedFieldsPerRow = 6; // particulars, status, trust_institute_name, contact_person_name, contact_number, amount
                const expectedRows = 7; // Based on the predefined rows in the form
                const expectedTotalFields = expectedFieldsPerRow * expectedRows;
                console.log('Expected funding details fields:', expectedTotalFields);
                console.log('Actual funding details fields:', fundingDetailsFields.length);
                
                if (fundingDetailsFields.length < expectedTotalFields) {
                    console.warn('Funding details table data may be incomplete');
                }
                
                console.log('Making fetch request to:', form.action);
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    console.log('Response received:', response);
                    console.log('Response status:', response.status);
                    // Check if the response is JSON
                    const contentType = response.headers.get('content-type');
                    console.log('Content type:', contentType);
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Received non-JSON response from server');
                    }
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Server response:', data);
                    if (data.success) {
                        if (data.data.submission_id) {
                            localStorage.setItem('jito_submission_id', data.data.submission_id);
                            localStorage.setItem('jito_current_step', data.data.step);
                        }
                        showMessage('Funding details saved successfully!', 'success');
                        // Use the redirect URL from the server response
                        if (data.data.redirect_url) {
                            console.log('Redirecting to:', data.data.redirect_url);
                            // Add a small delay to ensure the message is visible
                            setTimeout(() => {
                                window.location.href = data.data.redirect_url;
                            }, 2000);
                        } else {
                            // Fallback redirect
                            const submissionId = data.data.submission_id;
                            if (submissionId) {
                                const redirectUrl = `/guarantor-details?submission_id=${submissionId}`;
                                console.log('Fallback redirecting to:', redirectUrl);
                                setTimeout(() => {
                                    window.location.href = redirectUrl;
                                }, 2000);
                            }
                        }
                    } else {
                        // Display validation errors if any
                        if (data.errors) {
                            let errorMessages = '';
                            for (const field in data.errors) {
                                errorMessages += `${data.errors[field].join(', ')}\n`;
                            }
                            showMessage(errorMessages, 'error');
                        } else {
                            showMessage(data.message || 'Error saving details', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Check if it's a network error or a server error
                    if (error.name === 'TypeError' && error.message.includes('fetch')) {
                        showMessage('Network error. Please check your connection and try again.', 'error');
                    } else if (error.message.includes('HTTP error')) {
                        showMessage('Server error. Please try again later.', 'error');
                    } else if (error.message.includes('JSON')) {
                        showMessage('Invalid response from server. Please try again.', 'error');
                    } else {
                        showMessage('An error occurred. Please try again.', 'error');
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    loadingText.classList.add('hidden');
                });
            });

            function showMessage(message, type) {
                const messageDiv = document.createElement('div');
                const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' :
                              type === 'info' ? 'bg-blue-100 border-blue-400 text-blue-700' :
                              'bg-red-100 border-red-400 text-red-700';

                messageDiv.className = `px-4 py-3 rounded mb-4 border ${bgColor}`;
                messageDiv.innerHTML = `
                    <div class="flex">
                        <div class="flex-1">
                            <p class="text-sm">${message}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-lg font-bold">&times;</button>
                    </div>
                `;

                messageContainer.appendChild(messageDiv);
                setTimeout(() => {
                    if (messageDiv.parentNode) {
                        messageDiv.remove();
                    }
                }, 5000);
            }

            // Navigation tab handlers
            const personalDetailsTab = document.getElementById('personal-details-tab');
            const familyDetailsTab = document.getElementById('family-details-tab');
            const educationDetailsTab = document.getElementById('education-details-tab');

            if (personalDetailsTab) {
                personalDetailsTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');
                    if (submissionId) {
                        window.location.href = `/financial-assistance?submission_id=${submissionId}`;
                    } else {
                        window.location.href = '/financial-assistance';
                    }
                });
            }

            if (familyDetailsTab) {
                familyDetailsTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');
                    if (submissionId) {
                        window.location.href = `/family-details?submission_id=${submissionId}`;
                    } else {
                        window.location.href = '/family-details';
                    }
                });
            }

            if (educationDetailsTab) {
                educationDetailsTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');
                    if (submissionId) {
                        window.location.href = `/education-details?submission_id=${submissionId}`;
                    } else {
                        window.location.href = '/education-details';
                    }
                });
            }
        });
    </script>
</body>
</html>
