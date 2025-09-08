<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Financial Assistance Form - Documents</title>
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
        .document-btn {
            background-color: #0A2478;
            color: white;
            border-radius: 5px;
            padding: 12px 20px;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 100%;
            margin-bottom: 20px;
        }
        .document-btn:hover {
            background-color: #081d60;
        }
        .document-btn i {
            margin-right: 10px;
        }
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
                <span class="text-blue-600 font-semibold">Step 6/7 - Documents</span>
            </div>
        </div>
    </section>
    @endif

    <main class="max-w-[1200px] mx-auto px-6 py-8">
        <form method="POST" action="{{ route('documents.store') }}" id="documents-form" enctype="multipart/form-data">
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
                    <button aria-current="step" class="flex items-center gap-1 bg-project-primary text-white rounded px-3 py-1">
                        Documents
                    </button>
                    <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1 text-gray-400 cursor-not-allowed">
                        Submit
                    </button>
                </nav>
            </section>

            <!-- Documents Section -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-6 text-sm text-red-700">
                    <strong>NOTE:</strong> Please download and upload the required documents. Only JPG, JPEG, PNG, and PDF files are allowed. Maximum file size is 2MB.
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Step 1: Load Document List -->
                    <div class="border border-gray-300 rounded-md">
                        <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                            Step 1 Load Document List
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 mb-4">
                                *If you want to upload document then click on Step 1 Load document list*
                            </p>
                            
                            <!-- Recommendation Letter Button -->
                            <button type="button" class="document-btn" onclick="downloadPDF('Recommendation-Letter.pdf')">
                                <i class="fas fa-upload"></i> Recommendation Letter
                            </button>
                            
                            <!-- Jain Sangh Certification Button -->
                            <button type="button" class="document-btn" onclick="downloadPDF('SANGH-CERTIFICATE-FORM.pdf')">
                                <i class="fas fa-upload"></i> Jain Sangh Certification
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Upload and View Document -->
                    <div class="border border-gray-300 rounded-md">
                        <div class="bg-green-700 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                            Step 2 Upload and View Document
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 mb-4">
                                *The max file size can be 5 MB.** Only files with .PDF, .JPG, .JPEG will be allowed for upload.*Click on the file name to Upload File
                            </p>
                            
                            <!-- File Upload Fields -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-1 text-sm text-gray-700">Upload Recommendation Letter *</label>
                                    <input type="file" name="recommendation_letter" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" accept=".jpg,.jpeg,.png,.pdf" required />
                                </div>
                                
                                <div>
                                    <label class="block mb-1 text-sm text-gray-700">Upload Jain Sangh Certification *</label>
                                    <input type="file" name="jain_sangh_certification" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" accept=".jpg,.jpeg,.png,.pdf" required />
                                </div>
                                
                                <div>
                                    <label class="block mb-1 text-sm text-gray-700">Upload Other Required Documents *</label>
                                    <input type="file" name="other_documents" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" accept=".jpg,.jpeg,.png,.pdf" required />
                                </div>
                                
                                <div>
                                    <label class="block mb-1 text-sm text-gray-700">Upload Additional Documents</label>
                                    <input type="file" name="additional_documents" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" accept=".jpg,.jpeg,.png,.pdf" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-8">
                    <button id="submit-btn" type="submit" class="bg-project-primary hover:bg-project-primary text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors">
                        <span id="submit-text">Save Documents 6/7</span>
                        <span id="loading-text" class="hidden">Saving...</span>
                    </button>
                </div>
            </section>
        </form>
    </main>

    <div id="message-container" class="fixed top-4 right-4 z-50"></div>
    <script>
        // Function to download PDF files
        function downloadPDF(filename) {
            const link = document.createElement('a');
            link.href = `{{ asset('assets/pdfs') }}/${filename}`;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('documents-form');
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
                        showMessage('Documents saved successfully!', 'success');
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
                            showMessage(data.message || 'Error saving documents', 'error');
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
            const guarantorDetailsTab = document.getElementById('guarantor-details-tab');

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
        });
    </script>
</body>
</html>