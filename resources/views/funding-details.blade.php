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
        .border-error { border-color: #ef4444; border-width: 2px; }
        .field-error { border: 2px solid #ef4444 !important; }
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

    {{-- @if(isset($submissionId))
    <!-- Session Info -->
    <!-- <section class="max-w-[1200px] mx-auto px-6 mb-4">
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
    </section> -->
    @endif--}}

    <!-- Toast Messages -->
    @if(session('success'))
    <div class="fixed top-4 right-4 z-50">
        <div class="px-4 py-3 rounded mb-4 border bg-green-100 border-green-400 text-green-700">
            <div class="flex">
                <div class="flex-1">
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-lg font-bold">&times;</button>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="fixed top-4 right-4 z-50">
        <div class="px-4 py-3 rounded mb-4 border bg-red-100 border-red-400 text-red-700">
            <div class="flex">
                <div class="flex-1">
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-lg font-bold">&times;</button>
            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="fixed top-4 right-4 z-50">
        <div class="px-4 py-3 rounded mb-4 border bg-red-100 border-red-400 text-red-700">
            <div class="flex">
                <div class="flex-1">
                    <ul class="text-sm list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-lg font-bold">&times;</button>
            </div>
        </div>
    </div>
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
                            <label for="amount_requested_years" class="block mb-1 text-sm">Amount Requested for Years *</label>
                            <select id="amount_requested_years" name="amount_requested_years" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required>
                                <option value="">Select Years</option>
                                <option value="1" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '1' ? 'selected' : '' }}>1 Year</option>
                                <option value="2" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '2' ? 'selected' : '' }}>2 Years</option>
                                <option value="3" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '3' ? 'selected' : '' }}>3 Years</option>
                                <option value="4" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '4' ? 'selected' : '' }}>4 Years</option>
                                <option value="5" {{ old('amount_requested_years', $existingData->amount_requested_years ?? '') == '5' ? 'selected' : '' }}>5 Years</option>
                            </select>
                        </div>
                        <div>
                            <label for="tuition_fees_amount" class="block mb-1 text-sm">Amount Tuition Fees in Indian Rupees *</label>
                            <input id="tuition_fees_amount" name="tuition_fees_amount" type="number" step="0.01" value="{{ old('tuition_fees_amount', $existingData->tuition_fees_amount ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 50000" />
                        </div>
                    </div>

                    <!-- Funding Details Table -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-sm">Funding Details *</h3>
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
                                        <th class="border border-white px-2 py-2 text-center">Particulars *</th>
                                        <th class="border border-white px-2 py-2 text-center">Status *</th>
                                        <th class="border border-white px-2 py-2 text-center">Name Of Trust/Institute *</th>
                                        <th class="border border-white px-2 py-2 text-center">Name Of Contact Person *</th>
                                        <th class="border border-white px-2 py-2 text-center">Contact Number *</th>
                                        <th class="border border-white px-2 py-2 text-center">Amount *</th>
                                    </tr>
                                </thead>
                                <tbody id="funding-table-body">
                                    @if(isset($existingData) && $existingData->funding_details_table && is_array($existingData->funding_details_table))
                                        @foreach($existingData->funding_details_table as $index => $funding)
                                            <tr class="funding-row" style="background-color: {{ ($index % 2 == 0) ? '#FFF7D3' : '#FFC4C4' }};">
                                                <td class="border border-white px-2 py-1 text-center row-number">{{ $index + 1 }}</td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][particulars]" value="{{ old('funding_details_table.'.$index.'.particulars', $funding['particulars'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Own family funding" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][status]" value="{{ old('funding_details_table.'.$index.'.status', $funding['status'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Approved" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][trust_institute_name]" value="{{ old('funding_details_table.'.$index.'.trust_institute_name', $funding['trust_institute_name'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Family Trust" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][contact_person_name]" value="{{ old('funding_details_table.'.$index.'.contact_person_name', $funding['contact_person_name'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Rajesh Kumar" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="funding_details_table[{{ $index }}][contact_number]" value="{{ old('funding_details_table.'.$index.'.contact_number', $funding['contact_number'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 9876543210" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="number" name="funding_details_table[{{ $index }}][amount]" value="{{ old('funding_details_table.'.$index.'.amount', $funding['amount'] ?? '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 50000" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <!-- Default predefined rows based on the reference image -->
                                        <tr class="funding-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">1</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][particulars]" value="{{ old('funding_details_table.0.particulars', 'Own family funding (Father + Mother)') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Own family funding" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][status]" value="{{ old('funding_details_table.0.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Approved" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][trust_institute_name]" value="{{ old('funding_details_table.0.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Family Trust" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][contact_person_name]" value="{{ old('funding_details_table.0.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Rajesh Kumar" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[0][contact_number]" value="{{ old('funding_details_table.0.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 9876543210" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[0][amount]" value="{{ old('funding_details_table.0.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 50000" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFC4C4;">
                                            <td class="border border-white px-2 py-1 text-center row-number">2</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][particulars]" value="{{ old('funding_details_table.1.particulars', 'Bank Loan') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Bank Loan" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][status]" value="{{ old('funding_details_table.1.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Pending" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][trust_institute_name]" value="{{ old('funding_details_table.1.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. HDFC Bank" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][contact_person_name]" value="{{ old('funding_details_table.1.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Bank Manager" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[1][contact_number]" value="{{ old('funding_details_table.1.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 022-12345678" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[1][amount]" value="{{ old('funding_details_table.1.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 100000" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">3</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][particulars]" value="{{ old('funding_details_table.2.particulars', 'Other Assistance(1)') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Scholarship" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][status]" value="{{ old('funding_details_table.2.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Applied" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][trust_institute_name]" value="{{ old('funding_details_table.2.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. University" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][contact_person_name]" value="{{ old('funding_details_table.2.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Scholarship Officer" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[2][contact_number]" value="{{ old('funding_details_table.2.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 9876543211" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[2][amount]" value="{{ old('funding_details_table.2.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 25000" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFC4C4;">
                                            <td class="border border-white px-2 py-1 text-center row-number">4</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][particulars]" value="{{ old('funding_details_table.3.particulars', 'Other Assistance(2)') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Government Grant" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][status]" value="{{ old('funding_details_table.3.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Approved" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][trust_institute_name]" value="{{ old('funding_details_table.3.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Government" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][contact_person_name]" value="{{ old('funding_details_table.3.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Govt. Officer" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[3][contact_number]" value="{{ old('funding_details_table.3.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 011-23456789" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[3][amount]" value="{{ old('funding_details_table.3.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 30000" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">5</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][particulars]" value="{{ old('funding_details_table.4.particulars', 'Other Assistance(3)') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Private Scholarship" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][status]" value="{{ old('funding_details_table.4.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Pending" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][trust_institute_name]" value="{{ old('funding_details_table.4.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Private Trust" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][contact_person_name]" value="{{ old('funding_details_table.4.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Trust Manager" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[4][contact_number]" value="{{ old('funding_details_table.4.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 9876543212" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[4][amount]" value="{{ old('funding_details_table.4.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 15000" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFC4C4;">
                                            <td class="border border-white px-2 py-1 text-center row-number">6</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][particulars]" value="{{ old('funding_details_table.5.particulars', 'Local Assistance') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Local Assistance" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][status]" value="{{ old('funding_details_table.5.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Approved" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][trust_institute_name]" value="{{ old('funding_details_table.5.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Local Trust" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][contact_person_name]" value="{{ old('funding_details_table.5.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. Local Officer" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[5][contact_number]" value="{{ old('funding_details_table.5.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 9876543213" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[5][amount]" value="{{ old('funding_details_table.5.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 10000" />
                                            </td>
                                        </tr>
                                        <tr class="funding-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">7</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][particulars]" value="{{ old('funding_details_table.6.particulars', 'Total') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" readonly placeholder="Total" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][status]" value="{{ old('funding_details_table.6.status', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" placeholder="e.g. Calculated" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][trust_institute_name]" value="{{ old('funding_details_table.6.trust_institute_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" placeholder="e.g. Total" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][contact_person_name]" value="{{ old('funding_details_table.6.contact_person_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" placeholder="e.g. System" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="funding_details_table[6][contact_number]" value="{{ old('funding_details_table.6.contact_number', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" placeholder="e.g. 0000000000" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="funding_details_table[6][amount]" value="{{ old('funding_details_table.6.amount', '') }}" step="0.01" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent total-amount" readonly placeholder="0.00" />
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
                                <label for="family_received_assistance" class="block mb-1 text-sm">Have your Brother/Sister received Financial assistance from JITO JEAP/JATF/SEED or JITO Chapter? *</label>
                                <input id="family_received_assistance" name="family_received_assistance" type="text" value="{{ old('family_received_assistance', $existingData->family_received_assistance ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Yes/No" />
                            </div>
                            <div class="col-lg-4">
                                <label for="ngo_name" class="block mb-1 text-sm">NGO Name *</label>
                                <input id="ngo_name" name="ngo_name" type="text" value="{{ old('ngo_name', $existingData->ngo_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. JITO JEAP" />
                            </div>
                            <div class="col-lg-4">
                                <label for="loan_status" class="block mb-1 text-sm">Loan Status *</label>
                                <input id="loan_status" name="loan_status" type="text" value="{{ old('loan_status', $existingData->loan_status ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Pending/Approved" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 mb-6">

                            <div>
                                <label for="applied_year" class="block mb-1 text-sm">Applied for Year *</label>
                                <input id="applied_year" name="applied_year" type="text" value="{{ old('applied_year', $existingData->applied_year ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 2023" />
                            </div>
                            <div>
                                <label for="applied_amount" class="block mb-1 text-sm">Applied Amount *</label>
                                <input id="applied_amount" name="applied_amount" type="number" step="0.01" value="{{ old('applied_amount', $existingData->applied_amount ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 100000" />
                            </div>
                        </div>
                    </div>

                    <!-- Bank Account Details -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-sm mb-4">Bank Account Details of Applicant *</h3>
                        <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-4 text-sm text-red-700">
                            <strong>Bank Account Details of Applicant - </strong>We only accept cheques of Government Nationalized bank and Banks - HDFC Bank, ICICI Bank, Kotak Mahindra Bank, Axis Bank, IndusInd Bank, IDBI Bank, Yes Bank, IDFC First Bank, etc). Please mention those bank details whose Post Dated Cheques will be submitting us in future if your application is getting sanctioned.
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6">
                            <div>
                                <label for="student_name" class="block mb-1 text-sm">Student Name *</label>
                                <input id="student_name" name="student_name" type="text" value="{{ old('student_name', $existingData->student_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Rajesh Kumar" />
                            </div>
                            <div>
                                <label for="student_account_number" class="block mb-1 text-sm">Student Account Number *</label>
                                <input id="student_account_number" name="student_account_number" type="text" value="{{ old('student_account_number', $existingData->student_account_number ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 123456789012" />
                            </div>
                            <div>
                                <label for="ifsc_code" class="block mb-1 text-sm">IFSC Code *</label>
                                <input id="ifsc_code" name="ifsc_code" type="text" value="{{ old('ifsc_code', $existingData->ifsc_code ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. HDFC0001234" />
                            </div>
                            <div>
                                <label for="bank_name" class="block mb-1 text-sm">Bank Name *</label>
                                <input id="bank_name" name="bank_name" type="text" value="{{ old('bank_name', $existingData->bank_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. HDFC Bank" />
                            </div>
                            <div>
                                <label for="branch_name" class="block mb-1 text-sm">Branch Name *</label>
                                <input id="branch_name" name="branch_name" type="text" value="{{ old('branch_name', $existingData->branch_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Mumbai Central" />
                            </div>
                            <div>
                                <label for="bank_address" class="block mb-1 text-sm">Bank Address *</label>
                                <textarea id="bank_address" name="bank_address" rows="3" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 123 Main Street, Mumbai, Maharashtra 400001">{{ old('bank_address', $existingData->bank_address ?? '') }}</textarea>
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

            // Check if this is a new form request and handle accordingly
            const urlParams = new URLSearchParams(window.location.search);
            const isNewForm = urlParams.has('new') || urlParams.has('new_form');

            if (isNewForm) {
                console.log('New form detected on funding details - this should not happen');
                console.log('Redirecting to start of new form...');
                // If someone lands on funding details with new form parameter, redirect to start
                localStorage.removeItem('jito_submission_id');
                localStorage.removeItem('jito_current_step');
                localStorage.removeItem('jito_last_saved');
                showMessage('Redirecting to start new form...', 'info');
                setTimeout(() => {
                    window.location.href = '/financial-assistance?new=1';
                }, 1000);
                return;
            }

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

            // Add event listeners to remove error highlighting when user starts typing
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.classList.contains('field-error')) {
                        this.classList.remove('field-error');
                        this.classList.add('border-gray-300');
                    }
                });
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');

                // Clear previous error highlights
                clearErrorHighlights();

                const formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    redirect: 'follow'
                })
                .then(response => {
                    // Handle redirects
                    if (response.redirected) {
                        window.location.href = response.url;
                        return Promise.reject('redirected'); // Use reject to skip further processing
                    }

                    // Check if the response is JSON
                    const contentType = response.headers.get('content-type');

                    if (contentType && contentType.includes('application/json')) {
                        return response.json().then(data => {
                            // If response is not ok, but we have JSON data, pass it along
                            // This handles validation errors (422) that still return JSON
                            return { ok: response.ok, data: data, status: response.status };
                        });
                    } else {
                        // If not JSON, it's likely an HTML redirect or error page
                        if (response.ok) {
                            window.location.reload();
                            return Promise.reject('reload'); // Use reject to skip further processing
                        } else {
                            // Handle non-JSON error responses
                            return response.text().then(text => {
                                throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                            });
                        }
                    }
                })
                .then(result => {
                    // Skip processing if we've already handled redirect or reload
                    if (!result) return;

                    const { ok, data, status } = result;

                    if (ok) {
                        // Success case
                        if (data.success) {
                            showMessage('Funding details saved successfully!', 'success');
                            // Use the redirect URL from the server response
                            if (data.redirect_url) {
                                setTimeout(() => {
                                    window.location.href = data.redirect_url;
                                }, 1500);
                            } else {
                                // Default redirect to guarantor details
                                setTimeout(() => {
                                    const submissionId = document.querySelector('input[name="submission_id"]').value;
                                    window.location.href = '/guarantor-details?submission_id=' + submissionId;
                                }, 1500);
                            }
                        } else {
                            // Handle unexpected success response format
                            showMessage(data.message || 'Operation completed successfully!', 'success');
                        }

                        // Perform redirection
                        if (redirectUrl) {
                            console.log('Preparing to redirect to:', redirectUrl);
                            console.log('Current location:', window.location.href);

                            // Try immediate redirect first, then fallback to delayed
                            const doRedirect = () => {
                                console.log('Executing redirect NOW to:', redirectUrl);
                                try {
                                    // Force redirect using multiple methods for better compatibility
                                    window.location.href = redirectUrl;
                                    // Fallback methods in case the first doesn't work
                                    setTimeout(() => {
                                        if (window.location.href.indexOf('guarantor-details') === -1) {
                                            console.log('First redirect failed, trying window.location.replace');
                                            window.location.replace(redirectUrl);
                                        }
                                    }, 100);
                                    setTimeout(() => {
                                        if (window.location.href.indexOf('guarantor-details') === -1) {
                                            console.log('Second redirect failed, trying window.location.assign');
                                            window.location.assign(redirectUrl);
                                        }
                                    }, 200);
                                } catch (redirectError) {
                                    console.error('All redirect methods failed:', redirectError);
                                    showMessage('Form saved successfully! Please click here to continue to Guarantor Details.', 'info');
                                }
                            };

                            // Short delay for user to see success message, then redirect
                            console.log('Setting redirect timeout for 1 second');
                            setTimeout(() => {
                                console.log('Timeout executed, calling doRedirect function');
                                doRedirect();
                            }, 1000);
                        } else {
                            console.error('No redirect URL available');
                            const submissionId = localStorage.getItem('jito_submission_id');
                            const manualUrl = submissionId ? `/guarantor-details?submission_id=${submissionId}` : '/guarantor-details';
                            showMessage('Success, but unable to determine next step. Please click here to continue.', 'info', true, manualUrl);
                        }
                    } else {
                        // Error case (including validation errors)
                        if (data.errors) {
                            // Display individual field errors as separate toast messages
                            let firstErrorField = null;
                            for (const field in data.errors) {
                                data.errors[field].forEach(error => {
                                    showMessage(`${getFieldLabel(field)}: ${error}`, 'error');
                                });

                                // Highlight the field with error
                                const fieldElement = document.getElementById(field);
                                if (fieldElement) {
                                    fieldElement.classList.remove('border-gray-300');
                                    fieldElement.classList.add('field-error');

                                    // Keep track of the first error field for scrolling
                                    if (!firstErrorField) {
                                        firstErrorField = fieldElement;
                                    }
                                } else {
                                    // For table fields, we need to find them by name attribute
                                    const tableFieldElements = document.querySelectorAll(`[name*="${field}"]`);
                                    if (tableFieldElements.length > 0) {
                                        tableFieldElements.forEach(element => {
                                            element.classList.remove('border-gray-300');
                                            element.classList.add('field-error');
                                        });

                                        // Keep track of the first error field for scrolling
                                        if (!firstErrorField) {
                                            firstErrorField = tableFieldElements[0];
                                        }
                                    }
                                }
                            }

                            // Scroll to the first error field
                            if (firstErrorField) {
                                firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                firstErrorField.focus();
                            }
                        } else {
                            // Handle other types of errors
                            showMessage(data.message || `Error: ${status}`, 'error');
                        }
                    }
                })
                .catch(error => {
                    // Handle network errors or other exceptions
                    console.error('Error:', error);
                    if (error !== 'redirected' && error !== 'reload') {
                        showMessage('An error occurred. Please try again.', 'error');
                    }
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    loadingText.classList.add('hidden');
                });
            });

            // Function to clear error highlights
            function clearErrorHighlights() {
                const errorFields = form.querySelectorAll('.field-error');
                errorFields.forEach(field => {
                    field.classList.remove('field-error');
                    field.classList.add('border-gray-300');
                });
            }

            // Function to get field label for better error messages
            function getFieldLabel(fieldName) {
                const labelMap = {
                    'amount_requested_years': 'Amount Requested for Years',
                    'tuition_fees_amount': 'Tuition Fees Amount',
                    'family_received_assistance': 'Family Received Assistance',
                    'ngo_name': 'NGO Name',
                    'loan_status': 'Loan Status',
                    'applied_year': 'Applied Year',
                    'applied_amount': 'Applied Amount',
                    'student_name': 'Student Name',
                    'student_account_number': 'Student Account Number',
                    'ifsc_code': 'IFSC Code',
                    'bank_name': 'Bank Name',
                    'branch_name': 'Branch Name',
                    'bank_address': 'Bank Address'
                };

                // For table fields
                if (fieldName.includes('funding_details_table')) {
                    if (fieldName.includes('particulars')) return 'Particulars';
                    if (fieldName.includes('status')) return 'Status';
                    if (fieldName.includes('trust_institute_name')) return 'Trust/Institute Name';
                    if (fieldName.includes('contact_person_name')) return 'Contact Person Name';
                    if (fieldName.includes('contact_number')) return 'Contact Number';
                    if (fieldName.includes('amount')) return 'Amount';
                }

                return labelMap[fieldName] || fieldName;
            }

            function showMessage(message, type) {
                const messageDiv = document.createElement('div');
                const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' :
                              type === 'info' ? 'bg-blue-100 border-blue-400 text-blue-700' :
                              'bg-red-100 border-red-400 text-red-700';

                const clickableClass = clickable ? 'cursor-pointer hover:opacity-80' : '';
                messageDiv.className = `px-4 py-3 rounded mb-4 border ${bgColor} ${clickableClass}`;

                const clickHandler = clickable && clickUrl ? `onclick="window.location.href='${clickUrl}'"` : '';

                messageDiv.innerHTML = `
                    <div class="flex" ${clickHandler}>
                        <div class="flex-1">
                            <p class="text-sm">${message}</p>
                            ${clickable ? '<p class="text-xs mt-1 font-semibold">Click this message to navigate manually</p>' : ''}
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-lg font-bold">&times;</button>
                    </div>
                `;

                messageContainer.appendChild(messageDiv);

                // Auto-remove after longer time for clickable messages
                const autoRemoveTime = clickable ? 10000 : 5000;
                setTimeout(() => {
                    if (messageDiv.parentNode) {
                        messageDiv.remove();
                    }
                }, 10000); // Increased timeout to 10 seconds for better visibility
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
