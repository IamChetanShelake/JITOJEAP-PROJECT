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
        .bg-project-primary { background-color: #556EE6; }
        .bg-project-success { background-color: #009846; }
        .bg-project-warning { background-color: #FBBA00; }
        .bg-project-secondary { background-color: #393185; }
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

    @if(isset($submissionId))
    <!-- Session Info -->
    <!-- <section class="max-w-[1200px] mx-auto px-6 mb-4">
        <div class="bg-blue-50 border border-blue-200 rounded-md p-3 text-sm">
            <div class="flex items-center justify-between">
                <span class="text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Session ID: <strong>{{ substr($submissionId, 0, 8) }}...</strong>
                </span>
                <span class="text-blue-600 font-semibold">
                    Step 2/7 - Family Details
                </span>
            </div>
        </div>
    </section> -->
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
                    <button id="personal-details-tab" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1 hover:bg-green-600 transition-colors cursor-pointer">
                        ✓ Personal Details
                    </button>
                    <button aria-current="step" class="flex items-center gap-1 bg-project-primary text-white rounded px-3 py-1">
                        Family Details
                    </button>
                    <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1 text-gray-400 cursor-not-allowed">
                        Education Details
                    </button>
                    <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1 text-gray-400 cursor-not-allowed">
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
                    />

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6">
                        <div>
                            <label for="relation_student" class="block mb-1">Relation with Student <span class="text-red-500">*</span></label>
                            <input id="relation_student" name="relation_student" type="text" value="{{ old('relation_student', $existingData->relation_student ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>
                        <div>
                            <label for="family_name" class="block mb-1">Name <span class="text-red-500">*</span></label>
                            <input id="family_name" name="family_name" type="text" value="{{ old('family_name', $existingData->family_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>
                        <div>
                            <label for="family_age" class="block mb-1">Age <span class="text-red-500">*</span></label>
                            <input id="family_age" name="family_age" type="number" min="0" value="{{ old('family_age', $existingData->family_age ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
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
                            <label for="qualification" class="block mb-1">Qualification</label>
                            <input id="qualification" name="qualification" type="text" value="{{ old('qualification', $existingData->qualification ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                        <div>
                            <label for="occupation" class="block mb-1">Occupation</label>
                            <input id="occupation" name="occupation" type="text" value="{{ old('occupation', $existingData->occupation ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>

                        <div>
                            <label for="mobile_number" class="block mb-1">Mobile Number</label>
                            <input id="mobile_number" name="mobile_number" type="tel" maxlength="10" value="{{ old('mobile_number', $existingData->mobile_number ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                        <div>
                            <label for="email_id" class="block mb-1">Email ID</label>
                            <input id="email_id" name="email_id" type="email" value="{{ old('email_id', $existingData->email_id ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                        <div>
                            <label for="yearly_gross_income" class="block mb-1">Yearly Gross Income</label>
                            <input id="yearly_gross_income" name="yearly_gross_income" type="number" step="0.01" value="{{ old('yearly_gross_income', $existingData->yearly_gross_income ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>

                        <div>
                            <label for="insurance_coverage" class="block mb-1">Individual Insurance coverage value</label>
                            <input id="insurance_coverage" name="insurance_coverage" type="number" step="0.01" value="{{ old('insurance_coverage', $existingData->insurance_coverage ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                        <div>
                            <label for="premium_paid" class="block mb-1">Individual Premium paid per year</label>
                            <input id="premium_paid" name="premium_paid" type="number" step="0.01" value="{{ old('premium_paid', $existingData->premium_paid ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
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
                    />

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="total_student" class="block mb-1">Total No of Student</label>
                            <input id="total_student" name="total_student" type="number" min="0" value="{{ old('total_student', $existingData->total_student ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="total_family_income" class="block mb-1">Total Family Income</label>
                            <input id="total_family_income" name="total_family_income" type="number" step="0.01" value="{{ old('total_family_income', $existingData->total_family_income ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="family_member_diksha" class="block mb-1">Family Member taken diksha</label>
                            <input id="family_member_diksha" name="family_member_diksha" type="text" value="{{ old('family_member_diksha', $existingData->family_member_diksha ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>

                        <div>
                            <label for="total_insurance_coverage" class="block mb-1">Total Insurance Coverage of Family</label>
                            <input id="total_insurance_coverage" name="total_insurance_coverage" type="number" step="0.01" value="{{ old('total_insurance_coverage', $existingData->total_insurance_coverage ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="total_premium_paid" class="block mb-1">Total Premium paid in rupees per/year</label>
                            <input id="total_premium_paid" name="total_premium_paid" type="number" step="0.01" value="{{ old('total_premium_paid', $existingData->total_premium_paid ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div></div>
                    </div>

                    <div class="mb-4 font-semibold text-sm">Family Contact Details</div>

                    <div class="mb-2 font-semibold text-sm">Parental Uncle</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="parental_uncle_name" class="block mb-1">Name</label>
                            <input id="parental_uncle_name" name="parental_uncle_name" type="text" value="{{ old('parental_uncle_name', $existingData->parental_uncle_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="parental_uncle_mobile" class="block mb-1">Mobile Number</label>
                            <input id="parental_uncle_mobile" name="parental_uncle_mobile" type="tel" maxlength="10" value="{{ old('parental_uncle_mobile', $existingData->parental_uncle_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="parental_uncle_email" class="block mb-1">Email Id</label>
                            <input id="parental_uncle_email" name="parental_uncle_email" type="email" value="{{ old('parental_uncle_email', $existingData->parental_uncle_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Maternal Uncle</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="maternal_uncle_name" class="block mb-1">Name</label>
                            <input id="maternal_uncle_name" name="maternal_uncle_name" type="text" value="{{ old('maternal_uncle_name', $existingData->maternal_uncle_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="maternal_uncle_mobile" class="block mb-1">Mobile Number</label>
                            <input id="maternal_uncle_mobile" name="maternal_uncle_mobile" type="tel" maxlength="10" value="{{ old('maternal_uncle_mobile', $existingData->maternal_uncle_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="maternal_uncle_email" class="block mb-1">Email Id</label>
                            <input id="maternal_uncle_email" name="maternal_uncle_email" type="email" value="{{ old('maternal_uncle_email', $existingData->maternal_uncle_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Parental Aunty</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="parental_aunty_name" class="block mb-1">Name</label>
                            <input id="parental_aunty_name" name="parental_aunty_name" type="text" value="{{ old('parental_aunty_name', $existingData->parental_aunty_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="parental_aunty_mobile" class="block mb-1">Mobile Number</label>
                            <input id="parental_aunty_mobile" name="parental_aunty_mobile" type="tel" maxlength="10" value="{{ old('parental_aunty_mobile', $existingData->parental_aunty_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="parental_aunty_email" class="block mb-1">Email Id</label>
                            <input id="parental_aunty_email" name="parental_aunty_email" type="email" value="{{ old('parental_aunty_email', $existingData->parental_aunty_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Maternal Aunty</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="maternal_aunty_name" class="block mb-1">Name</label>
                            <input id="maternal_aunty_name" name="maternal_aunty_name" type="text" value="{{ old('maternal_aunty_name', $existingData->maternal_aunty_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="maternal_aunty_mobile" class="block mb-1">Mobile Number</label>
                            <input id="maternal_aunty_mobile" name="maternal_aunty_mobile" type="tel" maxlength="10" value="{{ old('maternal_aunty_mobile', $existingData->maternal_aunty_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="maternal_aunty_email" class="block mb-1">Email Id</label>
                            <input id="maternal_aunty_email" name="maternal_aunty_email" type="email" value="{{ old('maternal_aunty_email', $existingData->maternal_aunty_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
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

            // Function to clear all validation errors
            function clearValidationErrors() {
                document.querySelectorAll('.error-message').forEach(el => el.remove());
                document.querySelectorAll('.border-red-500').forEach(el => {
                    el.classList.remove('border-red-500', 'border-red-400');
                    el.classList.add('border-gray-300');
                });
            }

            // Function to display validation errors
            function displayValidationErrors(errors) {
                clearValidationErrors();

                Object.keys(errors).forEach(fieldName => {
                    const field = document.getElementById(fieldName);
                    if (field) {
                        field.classList.remove('border-gray-300');
                        field.classList.add('border-red-500');

                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message text-red-500 text-xs mt-1';
                        errorDiv.textContent = errors[fieldName][0];

                        field.parentNode.insertBefore(errorDiv, field.nextSibling);

                        if (Object.keys(errors)[0] === fieldName) {
                            field.focus();
                            field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }
                });
            }

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                clearValidationErrors();

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
                        return;
                    }
                    
                    // Check if the response is JSON
                    const contentType = response.headers.get('content-type');
                    
                    if (contentType && contentType.includes('application/json')) {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    } else {
                        // If not JSON, it's likely an HTML redirect or error page
                        window.location.reload();
                        return;
                    }
                })
                .then(data => {
                    if (!data) return; // If redirected, data will be undefined
                    
                    if (data.success) {
                        clearValidationErrors();
                        showMessage('Family details saved successfully!', 'success');
                        // Redirect to education details page
                        setTimeout(() => {
                            window.location.href = '{{ route("education-details", ["submission_id" => $submissionId ?? ""]) }}';
                        }, 1500);
                    } else {
                        if (data.errors) {
                            displayValidationErrors(data.errors);
                            showMessage('Please correct the errors below and try again.', 'error');
                        } else {
                            showMessage(data.message || 'Error saving details', 'error');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    clearValidationErrors();
                    showMessage('An error occurred. Please try again.', 'error');
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
