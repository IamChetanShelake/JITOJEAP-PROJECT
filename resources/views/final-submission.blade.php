<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Financial Assistance Form - Final Submission</title>
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
        .bg-project-primary { background-color: #556EE6; }
        .bg-project-success { background-color: #009846; }
        .bg-project-warning { background-color: #FBBA00; }
        .bg-blue-600 { background-color: #007DFC; }
        .hover\:bg-project-primary:hover { background-color: #4c63d2; }
        .hover\:bg-project-success:hover { background-color: #008139; }
        .hover\:bg-project-warning:hover { background-color: #e6a800; }
        .hover\:bg-blue-600:hover { background-color: #007DFC; }
        .hover\:bg-blue-700:hover { background-color: #007DFC; }
        .border-gray-300 { border-color: rgba(196, 196, 196, 0.55); }
        .shadow-box { box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); }
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

    @if(isset($submissionId))
    <!-- Session Info -->
   
    @endif

    <main class="max-w-[1200px] mx-auto px-6 py-8">
        <form method="POST" action="{{ route('final-submission.store') }}" id="final-submission-form">
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
                    <button id="guarantor-details-tab" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1 hover:bg-green-600 transition-colors cursor-pointer">
                        ✓ Guarantor Details
                    </button>
                    <button id="documents-tab" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1 hover:bg-green-600 transition-colors cursor-pointer">
                        ✓ Documents
                    </button>
                    <button aria-current="step" class="flex items-center gap-1 bg-project-primary text-white rounded px-3 py-1">
                        Submit
                    </button>
                </nav>
            </section>

            <!-- Final Submission Confirmation Section -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
               

                <!-- Declaration Form -->
                <div class="border border-gray-300 rounded-md mb-6">
                    <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                        Declaration
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <p class="text-gray-700 mb-4">
                                I hereby declare that the details in this form are true and correct to the best of my knowledge.
                            </p>
                            <p class="text-gray-700 mb-4">
                                I hereby give my consent to my son / daughter / ward for going to for further studies.
                            </p>
                            <p class="text-gray-700 mb-4">
                                If my Financial Assistance Application is approved, I agree to abide by the terms and conditions of the JITO-JEAP –Domestic/Foreign EducationFinancial Assistance Application
                            </p>
                            <p class="text-gray-700 mb-4">
                                In case of any change in the above information, I will inform the Institution immediately in writing within three days.
                            </p>
                            <p class="text-gray-700 mb-4">
                                I also undertake to keep the office bearers/Trustees informed of my correct address and that of my Parents/Guarantors and recommenders from time to time.
                            </p>
                            <p class="text-gray-700 mb-4">
                                I will send my second stage documents duly completed.
                            </p>
                            <p class="text-gray-700 mb-4">
                                I hereby declare that amount of Financial Assistance will be utilized for education purpose only
                            </p>
                            <p class="text-gray-700 mb-4">
                                I /we agree that JEAP may reject our Financial Assistance application without giving any reasons thereof and that JEAP shall not be held responsible/liable in any manner whatsoever to us for rejection or any delay in notifying us of such rejection including any costs, losses, damages, or expenses or consequences caused by such rejection of financial assistance application
                            </p>
                            <p class="text-gray-700 mb-4">
                                I have read all FAQs mentioned on website and accepting the same.
                            </p>
                        </div>

                        <div class="flex items-start mb-4">
                            <div class="flex items-center h-5">
                                <input id="declaration-checkbox-1" name="declaration_checkbox_1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" required>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="declaration-checkbox-1" class="font-medium text-gray-700">
                                    I have read all the instructions properly and agree to submit the required documents as per the policy and timelines.
                                </label>
                            </div>
                        </div>

                        <div class="flex items-start mb-6">
                            <div class="flex items-center h-5">
                                <input id="declaration-checkbox-2" name="declaration_checkbox_2" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" required>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="declaration-checkbox-2" class="font-medium text-gray-700">
                                    Preview Financial Assistance Application
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center gap-4 mt-8">
                    <button type="button" onclick="window.location.href='{{ route('preview-submission', ['submission_id' => $submissionId ?? '']) }}'" class="bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-600 transition-colors">
                        <i class="fas fa-eye mr-2"></i> Preview Application
                    </button>
                    <button id="submit-btn" type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors">
                        <span id="submit-text">Submit 7/7</span>
                        <span id="loading-text" class="hidden">Processing...</span>
                    </button>
                </div>
            </section>
        </form>
    </main>

    <div id="message-container" class="fixed top-4 right-4 z-50"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('final-submission-form');
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const loadingText = document.getElementById('loading-text');
            const messageContainer = document.getElementById('message-container');

            // Form submission
            form.addEventListener('submit', function(e) {
                // Check if declaration checkboxes are checked
                const checkbox1 = document.getElementById('declaration-checkbox-1');
                const checkbox2 = document.getElementById('declaration-checkbox-2');
                
                if (!checkbox1.checked || !checkbox2.checked) {
                    e.preventDefault();
                    showMessage('Please check both declaration checkboxes to proceed.', 'error');
                    return;
                }

                e.preventDefault();
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
                        showMessage('Application submitted successfully!', 'success');
                        // Redirect to main page
                        setTimeout(() => {
                            window.location.href = '{{ route("main") }}';
                        }, 2000);
                    } else {
                        showMessage(data.message || 'Error submitting application', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
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
            const familyDetailsTab = document.getElementById('family-details-tab');
            const educationDetailsTab = document.getElementById('education-details-tab');
            const fundingDetailsTab = document.getElementById('funding-details-tab');
            const guarantorDetailsTab = document.getElementById('guarantor-details-tab');
            const documentsTab = document.getElementById('documents-tab');

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

            if (guarantorDetailsTab) {
                guarantorDetailsTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');
                    if (submissionId) {
                        window.location.href = `/guarantor-details?submission_id=${submissionId}`;
                    } else {
                        window.location.href = '/guarantor-details';
                    }
                });
            }

            if (documentsTab) {
                documentsTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');
                    if (submissionId) {
                        window.location.href = `/documents?submission_id=${submissionId}`;
                    } else {
                        window.location.href = '/documents';
                    }
                });
            }
        });
    </script>
</body>
</html>