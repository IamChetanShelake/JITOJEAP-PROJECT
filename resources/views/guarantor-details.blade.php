<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Financial Assistance Form - Guarantor Details</title>
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
                <span class="text-blue-600 font-semibold">Step 5/7 - Guarantor Details</span>
            </div>
        </div>
    </section>
    @endif

    <main class="max-w-[1200px] mx-auto px-6 py-8">
        <form method="POST" action="{{ route('guarantor-details.store') }}" id="guarantor-form">
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
                    <button id="funding-details-tab" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1 hover:bg-green-600 transition-colors cursor-pointer">
                        ✓ Funding Details
                    </button>
                    <button aria-current="step" class="flex items-center gap-1 bg-project-primary text-white rounded px-3 py-1">
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

            <!-- Guarantor Details Section -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <!-- Important Note -->
                <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-6 text-sm text-red-700">
                    <strong>NOTE:</strong> Guarantors should not be more than age of 65, and he/she should be only from JAIN COMMUNITY, No real (father, mother, brother, sister) can be guarantor, Applicant and Guarantor from same address are not allowed, Housewife is not allowed, Both Guarantors from same address are not allowed.
                </div>

                <!-- First Guarantor -->
                <div class="mb-8">
                    <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                        First Guarantor
                    </div>
                    <div class="border border-gray-300 rounded-b-md p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- First Guarantor Name -->
                        <div>
                            <label for="first_guarantor_name" class="block mb-1 text-sm text-gray-700">First Guarantor Name</label>
                            <input id="first_guarantor_name" name="first_guarantor_name" type="text" value="{{ old('first_guarantor_name', $existingData->first_guarantor_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label for="first_guarantor_mobile" class="block mb-1 text-sm text-gray-700">Mobile Number</label>
                            <input id="first_guarantor_mobile" name="first_guarantor_mobile" type="text" value="{{ old('first_guarantor_mobile', $existingData->first_guarantor_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Relation with Student -->
                        <div>
                            <label for="first_guarantor_relation" class="block mb-1 text-sm text-gray-700">Relation with Student</label>
                            <input id="first_guarantor_relation" name="first_guarantor_relation" type="text" value="{{ old('first_guarantor_relation', $existingData->first_guarantor_relation ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Date Of Birth -->
                        <div>
                            <label for="first_guarantor_dob" class="block mb-1 text-sm text-gray-700">Date Of Birth</label>
                            <input id="first_guarantor_dob" name="first_guarantor_dob" type="date" value="{{ old('first_guarantor_dob', $existingData->first_guarantor_dob ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="first_guarantor_gender" class="block mb-1 text-sm text-gray-700">Gender</label>
                            <select id="first_guarantor_gender" name="first_guarantor_gender" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('first_guarantor_gender', $existingData->first_guarantor_gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('first_guarantor_gender', $existingData->first_guarantor_gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('first_guarantor_gender', $existingData->first_guarantor_gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Permanent Address -->
                        <div>
                            <label for="first_guarantor_permanent_address" class="block mb-1 text-sm text-gray-700">Permanent Address</label>
                            <textarea id="first_guarantor_permanent_address" name="first_guarantor_permanent_address" rows="3" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required>{{ old('first_guarantor_permanent_address', $existingData->first_guarantor_permanent_address ?? '') }}</textarea>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="first_guarantor_phone" class="block mb-1 text-sm text-gray-700">Phone Number</label>
                            <input id="first_guarantor_phone" name="first_guarantor_phone" type="text" value="{{ old('first_guarantor_phone', $existingData->first_guarantor_phone ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>

                        <!-- Pan Card Number -->
                        <div>
                            <label for="first_guarantor_pan" class="block mb-1 text-sm text-gray-700">Pan Card Number</label>
                            <input id="first_guarantor_pan" name="first_guarantor_pan" type="text" value="{{ old('first_guarantor_pan', $existingData->first_guarantor_pan ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Income -->
                        <div>
                            <label for="first_guarantor_income" class="block mb-1 text-sm text-gray-700">Income</label>
                            <input id="first_guarantor_income" name="first_guarantor_income" type="number" step="0.01" value="{{ old('first_guarantor_income', $existingData->first_guarantor_income ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Email Id -->
                        <div>
                            <label for="first_guarantor_email" class="block mb-1 text-sm text-gray-700">Email Id</label>
                            <input id="first_guarantor_email" name="first_guarantor_email" type="email" value="{{ old('first_guarantor_email', $existingData->first_guarantor_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Aadhar Card Number -->
                        <div>
                            <label for="first_guarantor_aadhar" class="block mb-1 text-sm text-gray-700">Aadhar Card Number</label>
                            <input id="first_guarantor_aadhar" name="first_guarantor_aadhar" type="text" value="{{ old('first_guarantor_aadhar', $existingData->first_guarantor_aadhar ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Name of Business/ Service -->
                        <div>
                            <label for="first_guarantor_business_name" class="block mb-1 text-sm text-gray-700">Name of Business/ Service</label>
                            <input id="first_guarantor_business_name" name="first_guarantor_business_name" type="text" value="{{ old('first_guarantor_business_name', $existingData->first_guarantor_business_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                    </div>
                </div>

                <!-- Second Guarantor -->
                <div class="mb-8">
                    <div class="bg-gray-300 text-gray-800 text-sm font-bold px-4 py-2 rounded-t-md">
                        Second Guarantor
                    </div>
                    <div class="border border-gray-300 rounded-b-md p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Second Guarantor Name -->
                        <div>
                            <label for="second_guarantor_name" class="block mb-1 text-sm text-gray-700">Second Guarantor Name</label>
                            <input id="second_guarantor_name" name="second_guarantor_name" type="text" value="{{ old('second_guarantor_name', $existingData->second_guarantor_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label for="second_guarantor_mobile" class="block mb-1 text-sm text-gray-700">Mobile Number</label>
                            <input id="second_guarantor_mobile" name="second_guarantor_mobile" type="text" value="{{ old('second_guarantor_mobile', $existingData->second_guarantor_mobile ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Relation with Student -->
                        <div>
                            <label for="second_guarantor_relation" class="block mb-1 text-sm text-gray-700">Relation with Student</label>
                            <input id="second_guarantor_relation" name="second_guarantor_relation" type="text" value="{{ old('second_guarantor_relation', $existingData->second_guarantor_relation ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Date Of Birth -->
                        <div>
                            <label for="second_guarantor_dob" class="block mb-1 text-sm text-gray-700">Date Of Birth</label>
                            <input id="second_guarantor_dob" name="second_guarantor_dob" type="date" value="{{ old('second_guarantor_dob', $existingData->second_guarantor_dob ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="second_guarantor_gender" class="block mb-1 text-sm text-gray-700">Gender</label>
                            <select id="second_guarantor_gender" name="second_guarantor_gender" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('second_guarantor_gender', $existingData->second_guarantor_gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('second_guarantor_gender', $existingData->second_guarantor_gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('second_guarantor_gender', $existingData->second_guarantor_gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Permanent Address -->
                        <div>
                            <label for="second_guarantor_permanent_address" class="block mb-1 text-sm text-gray-700">Permanent Address</label>
                            <textarea id="second_guarantor_permanent_address" name="second_guarantor_permanent_address" rows="3" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required>{{ old('second_guarantor_permanent_address', $existingData->second_guarantor_permanent_address ?? '') }}</textarea>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="second_guarantor_phone" class="block mb-1 text-sm text-gray-700">Phone Number</label>
                            <input id="second_guarantor_phone" name="second_guarantor_phone" type="text" value="{{ old('second_guarantor_phone', $existingData->second_guarantor_phone ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>

                        <!-- Pan Card Number -->
                        <div>
                            <label for="second_guarantor_pan" class="block mb-1 text-sm text-gray-700">Pan Card Number</label>
                            <input id="second_guarantor_pan" name="second_guarantor_pan" type="text" value="{{ old('second_guarantor_pan', $existingData->second_guarantor_pan ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Income -->
                        <div>
                            <label for="second_guarantor_income" class="block mb-1 text-sm text-gray-700">Income</label>
                            <input id="second_guarantor_income" name="second_guarantor_income" type="number" step="0.01" value="{{ old('second_guarantor_income', $existingData->second_guarantor_income ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Email Id -->
                        <div>
                            <label for="second_guarantor_email" class="block mb-1 text-sm text-gray-700">Email Id</label>
                            <input id="second_guarantor_email" name="second_guarantor_email" type="email" value="{{ old('second_guarantor_email', $existingData->second_guarantor_email ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Aadhar Card Number -->
                        <div>
                            <label for="second_guarantor_aadhar" class="block mb-1 text-sm text-gray-700">Aadhar Card Number</label>
                            <input id="second_guarantor_aadhar" name="second_guarantor_aadhar" type="text" value="{{ old('second_guarantor_aadhar', $existingData->second_guarantor_aadhar ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <!-- Name of Business/ Service -->
                        <div>
                            <label for="second_guarantor_business_name" class="block mb-1 text-sm text-gray-700">Name of Business/ Service</label>
                            <input id="second_guarantor_business_name" name="second_guarantor_business_name" type="text" value="{{ old('second_guarantor_business_name', $existingData->second_guarantor_business_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button id="submit-btn" type="submit" class="bg-project-primary hover:bg-project-primary text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors">
                        <span id="submit-text">Save Guarantor Details 5/7</span>
                        <span id="loading-text" class="hidden">Saving...</span>
                    </button>
                </div>
            </section>
        </form>
    </main>

    <div id="message-container" class="fixed top-4 right-4 z-50"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('guarantor-form');
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const loadingText = document.getElementById('loading-text');
            const messageContainer = document.getElementById('message-container');

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');

                const formData = new FormData(form);
                
                // Debug: Log form data
                console.log('Form data being sent:');
                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                }
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', [...response.headers.entries()]);
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const contentType = response.headers.get('content-type');
                    console.log('Content type:', contentType);
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Received non-JSON response from server');
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
                        showMessage('Guarantor details saved successfully!', 'success');
                        // Use the redirect URL from the server response
                        if (data.data.redirect_url) {
                            setTimeout(() => {
                                window.location.href = data.data.redirect_url;
                            }, 1500);
                        }
                    } else {
                        // Display validation errors if any
                        if (data.errors) {
                            let errorMessages = 'Please correct the following errors:\n\n';
                            for (const field in data.errors) {
                                errorMessages += `${field}:\n`;
                                data.errors[field].forEach(error => {
                                    errorMessages += `  - ${error}\n`;
                                });
                                errorMessages += '\n';
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
            const fundingDetailsTab = document.getElementById('funding-details-tab');

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

            if (fundingDetailsTab) {
                fundingDetailsTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');
                    if (submissionId) {
                        window.location.href = `/funding-details?submission_id=${submissionId}`;
                    } else {
                        window.location.href = '/funding-details';
                    }
                });
            }
        });
    </script>
</body>
</html>