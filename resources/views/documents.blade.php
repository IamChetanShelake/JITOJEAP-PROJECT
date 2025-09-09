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
        body {
            font-family: "Inter", sans-serif;
        }
        .project-primary {
            color: #556EE6;
        }
        .project-success {
            color: #009846;
        }
        .project-warning {
            color: #FBBA00;
        }
        .project-secondary {
            color: #393185;
        }
        .project-light {
            background-color: #FFF7D3;
        }
        .bg-project-primary {
            background-color: #556EE6 !important;
        }
        .bg-project-success {
            background-color: #009846 !important;
        }
        .bg-project-warning {
            background-color: #FBBA00 !important;
        }
        .bg-project-secondary {
            background-color: #393185;
        }
        .hover\:bg-project-primary:hover {
            background-color: #4c63d2;
        }
        .hover\:bg-project-success:hover {
            background-color: #008139;
        }
        .hover\:bg-project-warning:hover {
            background-color: #e6a800;
        }
        .border-error {
            border-color: #ef4444;
            border-width: 2px;
        }
        .field-error {
            border: 2px solid #ef4444 !important;
        }
        
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
    @endif --}}

    <main class="max-w-[1200px] mx-auto px-6 py-8">
        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Display success/error messages -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6 text-sm text-green-700">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6 text-sm text-red-700">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('documents.store') }}" id="documents-form" enctype="multipart/form-data">
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
                    <button class="flex items-center gap-1 bg-project-success px-6 py-1 step-arrow">
                        Family Details
                    </button>
                    <button class="flex items-center gap-1 bg-project-success px-6 py-1 step-arrow">
                        Education Details
                    </button>
                    <button class="flex items-center gap-1 bg-project-success px-6 py-1 step-arrow">
                        Funding Details
                    </button>
                    <button class="flex items-center gap-1 bg-project-success px-6 py-1 step-arrow">
                        Guarantor Details
                    </button>
                    <button aria-current="step" class="flex items-center gap-1 bg-project-primary px-6 py-1 step-arrow font-bold">
                        Documents
                    </button>
                    <button class="flex items-center gap-1 bg-project-warning px-6 py-1 step-arrow">
                        Submit
                    </button>
                </nav>
            </section>

            <!-- Documents Section -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-6 text-sm text-red-700">
                    <strong>NOTE:</strong> Please download and upload the required documents. Only JPG, JPEG, PNG, and PDF files are allowed. Maximum file size is 2MB.
                </div>

                {{-- @if(isset($existingDocuments) && $existingDocuments->count() > 0)
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                        <h3 class="text-sm font-semibold text-blue-800 mb-3">
                            <i class="fas fa-file-alt mr-2"></i>
                            Uploaded Documents Summary ({{ $existingDocuments->count() }} of 4 possible)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($existingDocuments as $doc)
                                <div class="bg-white border border-blue-200 rounded p-3">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-sm font-medium text-gray-800">{{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}</div>
                                            <div class="text-xs text-gray-500">{{ $doc->uploaded_at ? $doc->uploaded_at->format('d M Y') : 'N/A' }}</div>
                                        </div>
                                        <div class="text-green-600">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-6">
                        <div class="flex items-center text-yellow-800">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span class="text-sm font-medium">No documents uploaded yet. Please upload all required documents below.</span>
                        </div>
                    </div>
                @endif --}}

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
                                @php
                                    $documentTypes = [
                                        'recommendation_letter' => 'Recommendation Letter',
                                        'jain_sangh_certification' => 'Jain Sangh Certification',
                                        'other_documents' => 'Other Required Documents',
                                        'additional_documents' => 'Additional Documents'
                                    ];
                                    $requiredTypes = ['recommendation_letter', 'jain_sangh_certification', 'other_documents'];
                                @endphp

                                @foreach($documentTypes as $type => $label)
                                <div>
                                    @php
                                        $existingDoc = isset($existingDocuments) ? $existingDocuments->where('document_type', $type)->first() : null;
                                        $isRequired = in_array($type, $requiredTypes) && !$existingDoc;
                                    @endphp

                                    <label class="block mb-1 text-sm text-gray-700">
                                        Upload {{ $label }}{{ $isRequired ? ' *' : '' }}
                                        @if($existingDoc)
                                            <span class="text-green-600 font-semibold">(Already Uploaded)</span>
                                        @endif
                                    </label>

                                    @if($existingDoc)
                                        <!-- Show existing document info -->
                                        <div class="mb-2 p-3 bg-green-50 border border-green-200 rounded">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <div class="text-sm font-medium text-green-800">{{ $label }}</div>
                                                    <div class="text-xs text-green-600">Uploaded: {{ $existingDoc->uploaded_at ? $existingDoc->uploaded_at->format('d M Y, h:i A') : 'N/A' }}</div>
                                                </div>
                                                <div class="flex gap-2">
                                                    @if($existingDoc->file_path)
                                                        @php
                                                            $extension = pathinfo($existingDoc->file_path, PATHINFO_EXTENSION);
                                                        @endphp
                                                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <button type="button" onclick="viewImage('{{ asset('storage/' . $existingDoc->file_path) }}', '{{ $label }}')" class="text-blue-600 hover:underline text-xs">
                                                                View Image
                                                            </button>
                                                        @else
                                                            <a href="{{ asset('storage/' . $existingDoc->file_path) }}" target="_blank" class="text-blue-600 hover:underline text-xs">
                                                                View Document
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Option to replace existing document -->
                                        <div class="text-xs text-gray-600 mb-1">Choose a new file to replace the existing document:</div>
                                    @endif

                                    <input type="file"
                                           name="{{ $type }}"
                                           class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm"
                                           accept=".jpg,.jpeg,.png,.pdf"
                                           {{ $isRequired ? 'required' : '' }} />

                                    @error($type)
                                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-8">
                    <button id="submit-btn" type="submit" class="bg-project-primary hover:bg-project-primary text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors">
                        <span id="submit-text">
                            @if(isset($existingDocuments) && $existingDocuments->count() > 0)
                                Update Documents 6/7
                            @else
                                Save Documents 6/7
                            @endif
                        </span>
                        <span id="loading-text" class="hidden">Saving...</span>
                    </button>
                </div>
            </section>
        </form>
    </main>

    <div id="message-container" class="fixed top-4 right-4 z-50"></div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white p-4 rounded-lg max-w-4xl max-h-[90vh] overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 id="imageModalTitle" class="text-lg font-semibold">Document Preview</h3>
                <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <img id="imageModalImg" src="" alt="Document" class="max-w-full h-auto">
        </div>
    </div>
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

        // Function to view images in modal
        function viewImage(imageSrc, title) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('imageModalImg');
            const modalTitle = document.getElementById('imageModalTitle');

            modalImg.src = imageSrc;
            modalTitle.textContent = title;
            modal.classList.remove('hidden');
        }

        // Function to close image modal
        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

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
                        showMessage('Documents saved successfully!', 'success');
                        // Redirect to final submission page
                        setTimeout(() => {
                            window.location.href = '{{ route("final-submission.index", ["submission_id" => $submissionId ?? ""]) }}';
                        }, 1500);
                    } else {
                        // Display validation errors if any
                        if (data.errors) {
                            let errorMessages = 'Please correct the following errors:\\n\\n';
                            for (const field in data.errors) {
                                errorMessages += `${field}:\\n`;
                                data.errors[field].forEach(error => {
                                    errorMessages += `  - ${error}\\n`;
                                });
                                errorMessages += '\\n';
                            }
                            showMessage(errorMessages, 'error');
                        } else {
                            showMessage(data.message || 'Error saving documents', 'error');
                        }
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
