<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Financial Assistance Form - Family Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
        .project-primary { color: #556EE6; }
        .project-success { color: #009846; }
        .project-warning { color: #FBBA00; }
        .project-secondary { color: #393185; }
        .project-light { background-color: #FFF7D3; }
        .bg-project-primary { background-color: #556EE6 !important; }
        .bg-project-success { background-color: #009846 !important; }
        .bg-project-warning { background-color: #FBBA00 !important; }
        .bg-project-secondary { background-color: #393185; }
        .hover\:bg-project-primary:hover { background-color: #4c63d2; }
        .hover\:bg-project-success:hover { background-color: #008139; }
        .hover\:bg-project-warning:hover { background-color: #e6a800; }
        .border-error { border-color: #ef4444; border-width: 2px; }
        .field-error { border: 2px solid #ef4444 !important; }
        
        nav {
            display: flex;
            justify-content: center;
            gap: 8px;
            overflow-x: auto;
            white-space: nowrap;
        }

        .step-arrow {
            position: relative;
            display: flex;
            align-items: center;
            padding: 12px 48px 12px 24px;
            font-size: 13px;
            cursor: default;
            user-select: none;
            white-space: nowrap;
            clip-path: polygon(0 0,
                    calc(100% - 20px) 0,
                    100% 50%,
                    calc(100% - 20px) 100%,
                    0 100%,
                    20px 50%);
            /* background-color: #FBBA00 !important; */ /* Removed hardcoded color to allow class-based colors */
        }

        .step-arrow:not(:last-child) {
            margin-right: 20px;
        }

        /* Remove the conflicting specific tab styles */
    </style>
</head>
<body class="bg-white text-gray-900">
    <!-- Header Section -->
    <header class="flex justify-between items-center px-6 py-6 max-w-[1200px] mx-auto">
        <!-- Breadcrumb Navigation -->
        <div class="flex items-center space-x-2 text-sm text-gray-700">
            <i class="fas fa-chevron-left text-xs"></i>
            <a class="font-semibold project-primary hover:underline" href="{{ route('main') }}">
                Financial Assistance
            </a>
            <span>/ New</span>
        </div>

        <!-- Logo and Navigation Icons -->
        <div class="flex items-center space-x-4" style="display: flex;flex-direction: column;row-gap: 20px;">
            <!-- JITO JEAP Logo -->
            <img alt="JITO JEAP Education Assistance Program logo"
                 class="w-[100px] h-[40px] object-contain"
                 height="40"
                 src="{{ asset('assets/images/logo.png') }}"
                 width="100"/>

            <!-- Navigation Icons -->
            <div class="flex items-center space-x-4 text-gray-700 text-lg" style="    display: flex
                    ;
                /* justify-content: space-evenly; */
                column-gap: 18px;">
                <!-- Messages Icon -->
                <i class="far fa-comment-alt cursor-pointer hover:text-blue-600 transition-colors"
                   title="Messages"></i>

                <!-- Notifications Icon -->
                <i class="far fa-bell cursor-pointer hover:text-blue-600 transition-colors"
                   title="Notifications"></i>

                <!-- Profile Icon -->
                <i class="far fa-user-circle cursor-pointer hover:text-blue-600 transition-colors"
                   title="Profile"></i>
            </div>
        </div>
    </header>

    <!-- Action Buttons Section -->
    <section class="max-w-[1200px] mx-auto px-6">
        <div class="flex flex-wrap gap-3 mb-4">

            <button class="flex items-center gap-2 bg-project-primary hover:bg-project-primary text-white text-sm font-semibold px-4 py-2 rounded transition-colors">
                <i class="fas fa-print"></i>
                Print
            </button>
            <button class="flex items-center gap-2 bg-project-warning hover:bg-project-warning text-black text-sm font-semibold px-4 py-2 rounded transition-colors">
                <i class="fas fa-cogs"></i>
                Action
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
        <form method="POST" action="{{ route('family-details.store') }}" id="family-form">
            @csrf

            @if(isset($submissionId))
                <input type="hidden" name="submission_id" value="{{ $submissionId }}">
            @endif

            <!-- Form Navigation Tabs -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <nav class="flex flex-wrap gap-1 text-[11px] font-semibold text-gray-600">
                    <button
                        class="flex items-center gap-1 bg-project-success px-6 py-1 step-arrow">
                        Personal Details
                    </button>
                    <button aria-current="step" class="flex items-center gap-1 bg-project-primary px-6 py-1 step-arrow font-bold">
                        Family Details
                    </button>
                    <button class="flex items-center gap-1 bg-project-warning px-6 py-1 step-arrow">
                        Education Details
                    </button>
                    <button class="flex items-center gap-1 bg-project-warning px-6 py-1 step-arrow">
                        Funding Details
                    </button>
                    <button class="flex items-center gap-1 bg-project-warning px-6 py-1 step-arrow">
                        Guarantor Details
                    </button>
                    <button class="flex items-center gap-1 bg-project-warning px-6 py-1 step-arrow">
                        Documents
                    </button>
                    <button class="flex items-center gap-1 bg-project-warning px-6 py-1 step-arrow">
                        Submit
                    </button>
                </nav>
            </section>

            <!-- Family Details Section -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <div class="text-xs text-gray-700 mb-6">
                    <p class="mb-2">
                        Please Enter Number Of Family member including student for <br />
                        e.g. Father, Mother, Brother, Sister, Grand parents(2 or 5)
                    </p>
                    <input
                        type="number"
                        name="family_member_count"
                        min="0"
                        value="{{ old('family_member_count', $existingData->family_member_count ?? '0') }}"
                        class="w-24 border border-gray-300 rounded px-2 py-1 mb-6 focus:outline-none focus:ring-1 focus:ring-blue-600"
                        placeholder="e.g. 5"
                        required
                    />

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6">
                        <div>
                            <label for="relation_student" class="block mb-1">Relation with Student <span class="text-red-500">*</span></label>
                            <input id="relation_student" name="relation_student" type="text" value="{{ old('relation_student', $existingData->relation_student ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Father" />
                        </div>
                        <div>
                            <label for="family_name" class="block mb-1">Name <span class="text-red-500">*</span></label>
                            <input id="family_name" name="family_name" type="text" value="{{ old('family_name', $existingData->family_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Rajesh Kumar" />
                        </div>
                        <div>
                            <label for="family_age" class="block mb-1">Age <span class="text-red-500">*</span></label>
                            <input id="family_age" name="family_age" type="number" min="0" value="{{ old('family_age', $existingData->family_age ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 45" />
                        </div>

                        <div>
                            <label for="marital_status" class="block mb-1">Marital Status <span class="text-red-500">*</span></label>
                            <select id="marital_status" name="marital_status" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required>
                                <option value="">Select Status</option>
                                <option value="single" {{ old('marital_status', $existingData->marital_status ?? '') == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ old('marital_status', $existingData->marital_status ?? '') == 'married' ? 'selected' : '' }}>Married</option>
                                <option value="divorced" {{ old('marital_status', $existingData->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="widowed" {{ old('marital_status', $existingData->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                            </select>
                        </div>
                        <div>
                            <label for="qualification" class="block mb-1">Qualification <span class="text-red-500">*</span></label>
                            <input id="qualification" name="qualification" type="text" value="{{ old('qualification', $existingData->qualification ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. B.Tech" />
                        </div>
                        <div>
                            <label for="occupation" class="block mb-1">Occupation <span class="text-red-500">*</span></label>
                            <input id="occupation" name="occupation" type="text" value="{{ old('occupation', $existingData->occupation ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Software Engineer" />
                        </div>

                        <div>
                            <label for="mobile_number" class="block mb-1">Mobile Number <span class="text-red-500">*</span></label>
                            <input id="mobile_number" name="mobile_number" type="tel" maxlength="10" value="{{ old('mobile_number', $existingData->mobile_number ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 9876543210" />
                        </div>
                        <div>
                            <label for="email_id" class="block mb-1">Email ID <span class="text-red-500">*</span></label>
                            <input id="email_id" name="email_id" type="email" value="{{ old('email_id', $existingData->email_id ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. example@email.com" />
                        </div>
                        <div>
                            <label for="yearly_gross_income" class="block mb-1">Yearly Gross Income <span class="text-red-500">*</span></label>
                            <input id="yearly_gross_income" name="yearly_gross_income" type="number" step="0.01" value="{{ old('yearly_gross_income', $existingData->yearly_gross_income ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 500000" />
                        </div>

                        <div>
                            <label for="insurance_coverage" class="block mb-1">Individual Insurance coverage value <span class="text-red-500">*</span></label>
                            <input id="insurance_coverage" name="insurance_coverage" type="number" step="0.01" value="{{ old('insurance_coverage', $existingData->insurance_coverage ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 5000000" />
                        </div>
                        <div>
                            <label for="premium_paid" class="block mb-1">Individual Premium paid per year <span class="text-red-500">*</span></label>
                            <input id="premium_paid" name="premium_paid" type="number" step="0.01" value="{{ old('premium_paid', $existingData->premium_paid ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 25000" />
                        </div>
                        <div></div>
                    </div>

                    <div class="mb-4 font-semibold text-sm">Family Member Details</div>
                    <p class="mb-2 text-sm">
                        Please Enter Number Of Family member including student for <br />
                        e.g. Father, Mother, Brother, Sister, Grand parents(2 or 5)
                    </p>
                    <input
                        type="number"
                        name="total_family_members"
                        min="0"
                        value="{{ old('total_family_members', $existingData->total_family_members ?? '') }}"
                        class="w-24 border border-gray-300 rounded px-2 py-1 mb-6 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm"
                        placeholder="e.g. 5"
                        required
                    />

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="total_student" class="block mb-1">Total No of Student <span class="text-red-500">*</span></label>
                            <input id="total_student" name="total_student" type="number" min="0" value="{{ old('total_student', $existingData->total_student ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. 2" />
                        </div>
                        <div>
                            <label for="total_family_income" class="block mb-1">Total Family Income <span class="text-red-500">*</span></label>
                            <input id="total_family_income" name="total_family_income" type="number" step="0.01" value="{{ old('total_family_income', $existingData->total_family_income ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. 800000" />
                        </div>
                        <div>
                            <label for="family_member_diksha" class="block mb-1">Family Member taken diksha <span class="text-red-500">*</span></label>
                            <input id="family_member_diksha" name="family_member_diksha" type="text" value="{{ old('family_member_diksha', $existingData->family_member_diksha ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. Yes/No" />
                        </div>

                        <div>
                            <label for="total_insurance_coverage" class="block mb-1">Total Insurance Coverage of Family <span class="text-red-500">*</span></label>
                            <input id="total_insurance_coverage" name="total_insurance_coverage" type="number" step="0.01" value="{{ old('total_insurance_coverage', $existingData->total_insurance_coverage ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. 10000000" />
                        </div>
                        <div>
                            <label for="total_premium_paid" class="block mb-1">Total Premium paid in rupees per/year <span class="text-red-500">*</span></label>
                            <input id="total_premium_paid" name="total_premium_paid" type="number" step="0.01" value="{{ old('total_premium_paid', $existingData->total_premium_paid ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. 50000" />
                        </div>
                        <div></div>
                    </div>

                    <div class="mb-4 font-semibold text-sm">Family Contact Details</div>

                    <div class="mb-2 font-semibold text-sm">Parental Uncle</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="parental_uncle_name" class="block mb-1">Name <span class="text-red-500">*</span></label>
                            <input id="parental_uncle_name" name="parental_uncle_name" type="text" value="{{ old('parental_uncle_name', $existingData->parental_uncle_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. Uncle Name" />
                        </div>
                        <div>
                            <label for="parental_uncle_mobile" class="block mb-1">Mobile Number <span class="text-red-500">*</span></label>
                            <input id="parental_uncle_mobile" name="parental_uncle_mobile" type="tel" maxlength="10" value="{{ old('parental_uncle_mobile', $existingData->parental_uncle_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. 9876543210" />
                        </div>
                        <div>
                            <label for="parental_uncle_email" class="block mb-1">Email Id <span class="text-red-500">*</span></label>
                            <input id="parental_uncle_email" name="parental_uncle_email" type="email" value="{{ old('parental_uncle_email', $existingData->parental_uncle_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. uncle@email.com" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Maternal Uncle</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="maternal_uncle_name" class="block mb-1">Name <span class="text-red-500">*</span></label>
                            <input id="maternal_uncle_name" name="maternal_uncle_name" type="text" value="{{ old('maternal_uncle_name', $existingData->maternal_uncle_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. Uncle Name" />
                        </div>
                        <div>
                            <label for="maternal_uncle_mobile" class="block mb-1">Mobile Number <span class="text-red-500">*</span></label>
                            <input id="maternal_uncle_mobile" name="maternal_uncle_mobile" type="tel" maxlength="10" value="{{ old('maternal_uncle_mobile', $existingData->maternal_uncle_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. 9876543210" />
                        </div>
                        <div>
                            <label for="maternal_uncle_email" class="block mb-1">Email Id <span class="text-red-500">*</span></label>
                            <input id="maternal_uncle_email" name="maternal_uncle_email" type="email" value="{{ old('maternal_uncle_email', $existingData->maternal_uncle_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. uncle@email.com" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Parental Aunty</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="parental_aunty_name" class="block mb-1">Name <span class="text-red-500">*</span></label>
                            <input id="parental_aunty_name" name="parental_aunty_name" type="text" value="{{ old('parental_aunty_name', $existingData->parental_aunty_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. Aunty Name" />
                        </div>
                        <div>
                            <label for="parental_aunty_mobile" class="block mb-1">Mobile Number <span class="text-red-500">*</span></label>
                            <input id="parental_aunty_mobile" name="parental_aunty_mobile" type="tel" maxlength="10" value="{{ old('parental_aunty_mobile', $existingData->parental_aunty_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. 9876543210" />
                        </div>
                        <div>
                            <label for="parental_aunty_email" class="block mb-1">Email Id <span class="text-red-500">*</span></label>
                            <input id="parental_aunty_email" name="parental_aunty_email" type="email" value="{{ old('parental_aunty_email', $existingData->parental_aunty_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. aunty@email.com" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Maternal Aunty</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="maternal_aunty_name" class="block mb-1">Name <span class="text-red-500">*</span></label>
                            <input id="maternal_aunty_name" name="maternal_aunty_name" type="text" value="{{ old('maternal_aunty_name', $existingData->maternal_aunty_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. Aunty Name" />
                        </div>
                        <div>
                            <label for="maternal_aunty_mobile" class="block mb-1">Mobile Number <span class="text-red-500">*</span></label>
                            <input id="maternal_aunty_mobile" name="maternal_aunty_mobile" type="tel" maxlength="10" value="{{ old('maternal_aunty_mobile', $existingData->maternal_aunty_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. 9876543210" />
                        </div>
                        <div>
                            <label for="maternal_aunty_email" class="block mb-1">Email Id <span class="text-red-500">*</span></label>
                            <input id="maternal_aunty_email" name="maternal_aunty_email" type="email" value="{{ old('maternal_aunty_email', $existingData->maternal_aunty_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" required placeholder="e.g. aunty@email.com" />
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button
                            id="submit-btn"
                            type="submit"
                            class="bg-project-primary hover:bg-project-primary text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors"
                        >
                            <span id="submit-text">Family Details 2/7</span>
                            <span id="loading-text" class="hidden">Saving...</span>
                        </button>
                    </div>
                </div>
            </section>
        </form>
    </main>

    <!-- Success/Error Messages -->
    <div id="message-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('family-form');
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

            // Check for existing submission_id and load data if available
            checkExistingSession();

            function checkExistingSession() {
                const existingSubmissionId = localStorage.getItem('jito_submission_id');
                const currentSubmissionId = document.querySelector('input[name="submission_id"]')?.value;

                if (existingSubmissionId && !currentSubmissionId) {
                    // Add submission_id to form if missing
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'submission_id';
                    hiddenInput.value = existingSubmissionId;
                    form.appendChild(hiddenInput);
                }
            }

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
                    'family_member_count': 'Family Member Count',
                    'total_family_members': 'Total Family Members',
                    'relation_student': 'Relation with Student',
                    'family_name': 'Family Member Name',
                    'family_age': 'Family Member Age',
                    'marital_status': 'Marital Status',
                    'qualification': 'Qualification',
                    'occupation': 'Occupation',
                    'mobile_number': 'Mobile Number',
                    'email_id': 'Email ID',
                    'yearly_gross_income': 'Yearly Gross Income',
                    'insurance_coverage': 'Insurance Coverage',
                    'premium_paid': 'Premium Paid',
                    'total_student': 'Total Number of Students',
                    'total_family_income': 'Total Family Income',
                    'family_member_diksha': 'Family Member Taken Diksha',
                    'total_insurance_coverage': 'Total Insurance Coverage',
                    'total_premium_paid': 'Total Premium Paid',
                    'parental_uncle_name': 'Parental Uncle Name',
                    'parental_uncle_mobile': 'Parental Uncle Mobile',
                    'parental_uncle_email': 'Parental Uncle Email',
                    'maternal_uncle_name': 'Maternal Uncle Name',
                    'maternal_uncle_mobile': 'Maternal Uncle Mobile',
                    'maternal_uncle_email': 'Maternal Uncle Email',
                    'parental_aunty_name': 'Parental Aunty Name',
                    'parental_aunty_mobile': 'Parental Aunty Mobile',
                    'parental_aunty_email': 'Parental Aunty Email',
                    'maternal_aunty_name': 'Maternal Aunty Name',
                    'maternal_aunty_mobile': 'Maternal Aunty Mobile',
                    'maternal_aunty_email': 'Maternal Aunty Email'
                };
                
                return labelMap[fieldName] || fieldName;
            }

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
                }, 10000); // Increased timeout to 10 seconds for better visibility
            }

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                clearErrorHighlights();

                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest' // This header helps Laravel identify AJAX requests
                    },
                    redirect: 'follow' // Follow redirects
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
                            showMessage('Family details saved successfully!', 'success');
                            // Redirect to education details page
                            setTimeout(() => {
                                window.location.href = data.redirect_url || '{{ route("education-details", ["submission_id" => $submissionId ?? ""]) }}';
                            }, 1500);
                        } else {
                            // Handle unexpected success response format
                            showMessage(data.message || 'Operation completed successfully!', 'success');
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

            // Navigation tab handlers
            const personalDetailsTab = document.getElementById('personal-details-tab');

            if (personalDetailsTab) {
                personalDetailsTab.addEventListener('click', function(e) {
                    e.preventDefault();

                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');

                    if (submissionId) {
                        // Navigate to financial assistance page with submission_id for editing
                        showMessage('Navigating to Personal Details...', 'info');
                        setTimeout(() => {
                            window.location.href = `/financial-assistance?submission_id=${submissionId}`;
                        }, 500);
                    } else {
                        showMessage('No active session found. Starting new form...', 'info');
                        setTimeout(() => {
                            window.location.href = '/financial-assistance';
                        }, 500);
                    }
                });
            }
        });
    </script>
</body>
</html>
