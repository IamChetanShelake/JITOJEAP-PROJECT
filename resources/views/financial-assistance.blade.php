<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Financial Assistance Form - JITO JEAP</title>
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
            <!-- <button onclick="clearSession()" class="bg-red-500 hover:bg-red-600 text-white text-sm font-normal px-4 py-2 rounded transition-colors">
                Clear Session
            </button> -->
        </div>
    </section>

    <!-- Important Note Section -->
    <section class="bg-yellow-50 text-red-600 text-center text-xs font-semibold py-2 mb-6 max-w-[1200px] mx-auto px-6">
        *NOTE:- STUDENT HAS TO FILL ALL THE DETAILS IN 7 PAGES AND IN SUBMIT SECTION PLEASE CLICK
    </section>

    <!-- Success Message -->
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

    <!-- Error Message -->
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

    <!-- Validation Errors -->
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
    {{-- <section class="max-w-[1200px] mx-auto px-6 mb-4">
        <div class="bg-blue-50 border border-blue-200 rounded-md p-3 text-sm">
            <div class="flex items-center justify-between">
                <span class="text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Session ID: <strong>{{ substr($submissionId, 0, 8) }}...</strong>
                </span>
                <span class="text-blue-600 font-semibold">
                    Step 1/7 - Personal Details
                </span>
            </div>
        </div>
    </section>  --}}
    @endif

    <!-- Main Form Section -->
    <form method="POST" action="{{ route('financial-assistance.store') }}" class="max-w-[1200px] mx-auto px-6">
        @csrf

        @if(isset($submissionId))
            <input type="hidden" name="submission_id" value="{{ $submissionId }}">
        @endif

        <!-- Basic Information Section -->
        <section class="mb-8">
            <div class="bg-white border border-gray-200 rounded-md shadow-md p-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="name">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('name') border-red-500 @enderror"
                           id="name"
                           name="name"
                           type="text"
                           value="{{ old('name', $existingData->name ?? '') }}"
                           placeholder="e.g. John Doe"
                           required/>
                    @error('name')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div></div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="applicant">
                        Applicant <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('applicant') border-red-500 @enderror"
                           id="applicant"
                           name="applicant"
                           type="text"
                           value="{{ old('applicant', $existingData->applicant ?? '') }}"
                           placeholder="e.g. Parent/Guardian Name"
                           required/>
                    @error('applicant')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="request_date">
                        Request Date <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('request_date') border-red-500 @enderror"
                           id="request_date"
                           name="request_date"
                           type="date"
                           value="{{ old('request_date', $existingData && $existingData->request_date ? $existingData->request_date->format('Y-m-d') : '') }}"
                           placeholder="Select date"
                           required/>
                    @error('request_date')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="financial_asst_type">
                        Financial Asst Type <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('financial_asst_type') border-red-500 @enderror"
                            id="financial_asst_type"
                            name="financial_asst_type"
                            required>
                        <option value="">Select Type</option>
                        <option value="education" {{ old('financial_asst_type', $existingData->financial_asst_type ?? '') == 'education' ? 'selected' : '' }}>Education</option>
                        <option value="medical" {{ old('financial_asst_type', $existingData->financial_asst_type ?? '') == 'medical' ? 'selected' : '' }}>Medical</option>
                        <option value="emergency" {{ old('financial_asst_type', $existingData->financial_asst_type ?? '') == 'emergency' ? 'selected' : '' }}>Emergency</option>
                        <option value="business" {{ old('financial_asst_type', $existingData->financial_asst_type ?? '') == 'business' ? 'selected' : '' }}>Business</option>
                    </select>
                    @error('financial_asst_type')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="financial_asst_for">
                        Financial Asst For <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('financial_asst_for') border-red-500 @enderror"
                           id="financial_asst_for"
                           name="financial_asst_for"
                           type="text"
                           value="{{ old('financial_asst_for', $existingData->financial_asst_for ?? '') }}"
                           placeholder="e.g. Education/Books"
                           required/>
                    @error('financial_asst_for')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="paid_amount">
                        Paid Amount
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('paid_amount') border-red-500 @enderror"
                           id="paid_amount"
                           name="paid_amount"
                           type="number"
                           step="0.01"
                           value="{{ old('paid_amount', $existingData->paid_amount ?? '') }}"
                           placeholder="e.g. 5000"/>
                    @error('paid_amount')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="approve_date">
                        Approve Date
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('approve_date') border-red-500 @enderror"
                           id="approve_date"
                           name="approve_date"
                           type="date"
                           value="{{ old('approve_date', $existingData && $existingData->approve_date ? $existingData->approve_date->format('Y-m-d') : '') }}"
                           placeholder="Select date"/>
                    @error('approve_date')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="outstanding_amount">
                        Outstanding Amount
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('outstanding_amount') border-red-500 @enderror"
                           id="outstanding_amount"
                           name="outstanding_amount"
                           type="number"
                           step="0.01"
                           value="{{ old('outstanding_amount', $existingData->outstanding_amount ?? '') }}"
                           placeholder="e.g. 10000"/>
                    @error('outstanding_amount')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="form_status">
                        Form Status
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 @error('form_status') border-red-500 @enderror"
                            id="form_status"
                            name="form_status">
                        <option value="">Select Status</option>
                        <option value="draft" {{ old('form_status', $existingData->form_status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="submitted" {{ old('form_status', $existingData->form_status ?? '') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="under_review" {{ old('form_status', $existingData->form_status ?? '') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="approved" {{ old('form_status', $existingData->form_status ?? '') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('form_status', $existingData->form_status ?? '') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('form_status')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </section>

        <!-- Student Information Note -->
        <section class="max-w-[1200px] mx-auto px-6 mb-6 text-[9px] text-red-600 font-semibold leading-[1.1]">
            <p class="mb-1 font-bold text-[10px]">
                NOTE FOR STUDENT
            </p>
            <ul class="list-disc pl-4 space-y-0.5">
                <li>PLEASE ENSURE THAT YOUR PHOTO HAS BEEN UPLOADED IN THE PHOTO BOX AND ONLY IN. JPEG OR. JPG FORMAT ONLY.</li>
                <li>APART FROM PHOTOGRAPHS, ALL FILES SHOULD BE UPLOADED IN PDF FORMAT.</li>
                <li>PLEASE ENTER N/A IN THE FIELDS WHERE YOU DON'T HAVE THE RELEVANT INFORMATION BUT DO NOT KEEP ANY FIELDS BLANK OR INCOMPLETE.</li>
                <li>ONLY ONE APPLICATION IS ALLOWED PER ACCOUNT AND PER STUDENT'S AADHAAR DETAILS.</li>
                <li>PLEASE FILL THE FORM IN "BLOCK LETTERS ONLY".</li>
                <li>FORM ONCE SUBMITTED WILL NOT BE EDITABLE; HENCE ENTER INFORMATION CORRECTLY.</li>
                <li>"RED" COLOUR FIELD'S ARE MANDATORY IN THE FORM</li>
            </ul>
        </section>

        <!-- Profile Photo Upload Section -->
        <section class="max-w-[1200px] mx-auto px-6 mb-8">
            <h3 class="text-sm font-semibold mb-4 text-project-secondary">Profile Photo</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 text-xs text-gray-700">
                <div class="md:col-span-3">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-camera text-gray-500 text-xl"></i>
                            </div>
                            <p class="text-gray-600 mb-2">Drag & Drop Image Here</p>
                            <p class="text-gray-500 text-xs mb-4">or</p>
                            <input type="file" id="profile_photo" name="profile_photo" accept="image/jpeg,image/jpg" class="hidden">
                            <button type="button" id="upload-btn" class="bg-project-primary hover:bg-project-primary text-white px-4 py-2 rounded text-xs">
                                Browse Files
                            </button>
                            <p class="text-gray-500 text-xs mt-2">Only JPEG/JPG format allowed</p>
                            <div id="file-name" class="text-xs text-gray-600 mt-2 hidden"></div>
                            @error('profile_photo')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                            @if(isset($existingData) && $existingData->profile_photo_path)
                                <div class="mt-4">
                                    <p class="text-xs text-gray-600 mb-1">Current Photo:</p>
                                    <img src="{{ asset($existingData->profile_photo_path) }}" alt="Profile Photo" class="w-24 h-24 object-cover rounded">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Navigation Tabs -->
        <section class="max-w-[1200px] mx-auto px-6 mb-8">
            <nav class="flex flex-wrap gap-1 text-[11px] font-semibold text-gray-600">
                <button aria-current="step" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1">
                    Personal Details
                </button>
                <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1">
                    Family Details
                </button>
                <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1">
                    Education Details
                </button>
                <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1">
                    Funding Details
                </button>
                <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1">
                    Guarantor Details
                </button>
                <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1">
                    Documents
                </button>
                <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1">
                    Submit
                </button>
            </nav>
        </section>

        <!-- Personal Details Section -->
        <section class="max-w-[1200px] mx-auto px-6 mb-8">
            <h3 class="text-sm font-semibold mb-4 text-project-secondary">Personal Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 text-xs text-gray-700">
                <div>
                    <label class="block mb-1" for="aadhar_number">
                        Aadhar Number <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('aadhar_number') border-red-500 @enderror"
                           id="aadhar_number"
                           name="aadhar_number"
                           type="text"
                           maxlength="12"
                           value="{{ old('aadhar_number', $existingData->aadhar_number ?? '') }}"
                           placeholder="e.g. 123456789012"
                           required/>
                    <div class="text-xs text-gray-500 mt-1">Each Aadhar number can only be used once</div>
                    @error('aadhar_number')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="date_of_birth">
                        Date Of Birth <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('date_of_birth') border-red-500 @enderror"
                           id="date_of_birth"
                           name="date_of_birth"
                           type="date"
                           value="{{ old('date_of_birth', $existingData && $existingData->date_of_birth ? $existingData->date_of_birth->format('Y-m-d') : '') }}"
                           placeholder="Select date"
                           required/>
                    @error('date_of_birth')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="birth_place">
                        Birth Place <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('birth_place') border-red-500 @enderror"
                           id="birth_place"
                           name="birth_place"
                           type="text"
                           value="{{ old('birth_place', $existingData->birth_place ?? '') }}"
                           placeholder="e.g. Mumbai"
                           required/>
                    @error('birth_place')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="student_first_name">
                        Student First Name <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('student_first_name') border-red-500 @enderror"
                           id="student_first_name"
                           name="student_first_name"
                           type="text"
                           value="{{ old('student_first_name', $existingData->student_first_name ?? '') }}"
                           placeholder="e.g. John"
                           required/>
                    @error('student_first_name')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="middle_name">
                        Middle Name
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('middle_name') border-red-500 @enderror"
                           id="middle_name"
                           name="middle_name"
                           type="text"
                           value="{{ old('middle_name', $existingData->middle_name ?? '') }}"
                           placeholder="e.g. Michael"/>
                    @error('middle_name')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="last_name">
                        Last Name <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('last_name') border-red-500 @enderror"
                           id="last_name"
                           name="last_name"
                           type="text"
                           value="{{ old('last_name', $existingData->last_name ?? '') }}"
                           required/>
                    @error('last_name')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="marital_status">
                        Marital Status <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('marital_status') border-red-500 @enderror"
                            id="marital_status"
                            name="marital_status"
                            required>
                        <option value="">Select Status</option>
                        <option value="single" {{ old('marital_status', $existingData->marital_status ?? '') == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="married" {{ old('marital_status', $existingData->marital_status ?? '') == 'married' ? 'selected' : '' }}>Married</option>
                        <option value="divorced" {{ old('marital_status', $existingData->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="widowed" {{ old('marital_status', $existingData->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                    @error('marital_status')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="native_place">
                        Native Place <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('native_place') border-red-500 @enderror"
                           id="native_place"
                           name="native_place"
                           type="text"
                           value="{{ old('native_place', $existingData->native_place ?? '') }}"
                           required/>
                    @error('native_place')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="age">
                        Age <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('age') border-red-500 @enderror"
                           id="age"
                           name="age"
                           type="number"
                           min="1"
                           max="120"
                           value="{{ old('age', $existingData->age ?? '') }}"
                           required/>
                    @error('age')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="gender">
                        Gender <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('gender') border-red-500 @enderror"
                            id="gender"
                            name="gender"
                            required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender', $existingData->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $existingData->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $existingData->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="student_mobile">
                        Student Mobile Number <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('student_mobile') border-red-500 @enderror"
                           id="student_mobile"
                           name="student_mobile"
                           type="tel"
                           maxlength="10"
                           value="{{ old('student_mobile', $existingData->student_mobile ?? '') }}"
                           required/>
                    @error('student_mobile')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="religion">
                        Religion <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('religion') border-red-500 @enderror"
                           id="religion"
                           name="religion"
                           type="text"
                           value="{{ old('religion', $existingData->religion ?? '') }}"
                           required/>
                    @error('religion')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="nationality">
                        Nationality
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('nationality') border-red-500 @enderror"
                           id="nationality"
                           name="nationality"
                           type="text"
                           value="{{ old('nationality', $existingData->nationality ?? 'Indian') }}"
                           readonly/>
                    @error('nationality')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="blood_group">
                        Blood Group
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('blood_group') border-red-500 @enderror"
                            id="blood_group"
                            name="blood_group">
                        <option value="">Select Blood Group</option>
                        <option value="A+" {{ old('blood_group', $existingData->blood_group ?? '') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('blood_group', $existingData->blood_group ?? '') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('blood_group', $existingData->blood_group ?? '') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('blood_group', $existingData->blood_group ?? '') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ old('blood_group', $existingData->blood_group ?? '') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('blood_group', $existingData->blood_group ?? '') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ old('blood_group', $existingData->blood_group ?? '') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('blood_group', $existingData->blood_group ?? '') == 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                    @error('blood_group')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="student_email">
                        Student E-Mail <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('student_email') border-red-500 @enderror"
                           id="student_email"
                           name="student_email"
                           type="email"
                           value="{{ old('student_email', $existingData->student_email ?? '') }}"
                           placeholder="e.g. student@example.com"
                           required/>
                    <div class="text-xs text-gray-500 mt-1">Each email address can only be used once</div>
                    @error('student_email')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="specially_abled">
                        Specially Abled <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('specially_abled') border-red-500 @enderror"
                            id="specially_abled"
                            name="specially_abled"
                            required>
                        <option value="no" {{ old('specially_abled', $existingData->specially_abled ?? 'no') == 'no' ? 'selected' : '' }}>No</option>
                        <option value="yes" {{ old('specially_abled', $existingData->specially_abled ?? 'no') == 'yes' ? 'selected' : '' }}>Yes</option>
                    </select>
                    @error('specially_abled')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="pan_no">
                        PAN No
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('pan_no') border-red-500 @enderror"
                           id="pan_no"
                           name="pan_no"
                           type="text"
                           maxlength="10"
                           value="{{ old('pan_no', $existingData->pan_no ?? '') }}"/>
                    @error('pan_no')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </section>

        <!-- Permanent Address Section -->
        <section class="max-w-[1200px] mx-auto px-6 mb-8">
            <h3 class="text-sm font-semibold mb-4 text-project-secondary">Permanent Address (Enter as per Aadhar Card)</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 text-xs text-gray-700">
                <div>
                    <label class="block mb-1" for="flat_no">
                        Flat No <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('flat_no') border-red-500 @enderror"
                           id="flat_no"
                           name="flat_no"
                           type="text"
                           value="{{ old('flat_no', $existingData->flat_no ?? '') }}"
                           placeholder="e.g. 123"
                           required/>
                    @error('flat_no')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="floor">
                        Floor
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('floor') border-red-500 @enderror"
                           id="floor"
                           name="floor"
                           type="text"
                           value="{{ old('floor', $existingData->floor ?? '') }}"
                           placeholder="e.g. 2nd Floor"/>
                    @error('floor')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="name_of_building">
                        Name of building <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('name_of_building') border-red-500 @enderror"
                           id="name_of_building"
                           name="name_of_building"
                           type="text"
                           value="{{ old('name_of_building', $existingData->name_of_building ?? '') }}"
                           placeholder="e.g. Apartment Name"
                           required/>
                    @error('name_of_building')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="area">
                        Area <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('area') border-red-500 @enderror"
                           id="area"
                           name="area"
                           type="text"
                           value="{{ old('area', $existingData->area ?? '') }}"
                           placeholder="e.g. Area Name"
                           required/>
                    @error('area')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="lane">
                        Lane
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('lane') border-red-500 @enderror"
                           id="lane"
                           name="lane"
                           type="text"
                           value="{{ old('lane', $existingData->lane ?? '') }}"
                           placeholder="e.g. Lane Name"/>
                    @error('lane')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="landmark">
                        Landmark
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('landmark') border-red-500 @enderror"
                           id="landmark"
                           name="landmark"
                           type="text"
                           value="{{ old('landmark', $existingData->landmark ?? '') }}"
                           placeholder="e.g. Near School"/>
                    @error('landmark')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="pincode">
                        Pincode <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('pincode') border-red-500 @enderror"
                           id="pincode"
                           name="pincode"
                           type="text"
                           maxlength="6"
                           value="{{ old('pincode', $existingData->pincode ?? '') }}"
                           placeholder="e.g. 400001"
                           required/>
                    @error('pincode')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="status">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('status') border-red-500 @enderror"
                           id="status"
                           name="status"
                           type="text"
                           value="{{ old('status', $existingData->status ?? '') }}"
                           placeholder="e.g. Maharashtra"
                           required/>
                    @error('status')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="city">
                        City <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('city') border-red-500 @enderror"
                           id="city"
                           name="city"
                           type="text"
                           value="{{ old('city', $existingData->city ?? '') }}"
                           placeholder="e.g. Mumbai"
                           required/>
                    @error('city')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1 text-[9px]" for="chapter">
                        Chapter (Please select the nearest chapter according to your residentail mail) <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('chapter') border-red-500 @enderror"
                           id="chapter"
                           name="chapter"
                           type="text"
                           value="{{ old('chapter', $existingData->chapter ?? '') }}"
                           placeholder="e.g. Mumbai Chapter"
                           required/>
                    @error('chapter')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="new_zone">
                        New Zone
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('new_zone') border-red-500 @enderror"
                           id="new_zone"
                           name="new_zone"
                           type="text"
                           value="{{ old('new_zone', $existingData->new_zone ?? '') }}"
                           placeholder="e.g. Zone Name"/>
                    @error('new_zone')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="district">
                        District <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('district') border-red-500 @enderror"
                           id="district"
                           name="district"
                           type="text"
                           value="{{ old('district', $existingData->district ?? '') }}"
                           placeholder="e.g. Mumbai District"
                           required/>
                    @error('district')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-3">
                    <label class="block mb-1" for="postal_address">
                        Postal Address <span class="text-red-500">*</span>
                    </label>
                    <textarea class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('postal_address') border-red-500 @enderror"
                              id="postal_address"
                              name="postal_address"
                              rows="2"
                              placeholder="e.g. Full postal address including all details"
                              required>{{ old('postal_address', $existingData->postal_address ?? '') }}</textarea>
                    @error('postal_address')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="alternate_mail_id">
                        Alternate Mail Id
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('alternate_mail_id') border-red-500 @enderror"
                           id="alternate_mail_id"
                           name="alternate_mail_id"
                           type="email"
                           value="{{ old('alternate_mail_id', $existingData->alternate_mail_id ?? '') }}"
                           placeholder="e.g. alternate@example.com"/>
                    @error('alternate_mail_id')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1" for="alternate_mobile">
                        Alternate Mobile Number
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('alternate_mobile') border-red-500 @enderror"
                           id="alternate_mobile"
                           name="alternate_mobile"
                           type="tel"
                           maxlength="10"
                           value="{{ old('alternate_mobile', $existingData->alternate_mobile ?? '') }}"
                           placeholder="e.g. 9876543210"/>
                </div>
            </div>
        </section>

        <!-- Correspondence Address Section -->
        <section class="max-w-[1200px] mx-auto px-6 mb-8">
            <h3 class="text-sm font-semibold mb-4 text-project-secondary">Correspondence Address</h3>
            <div class="text-xs text-gray-700">
                <label class="inline-flex items-center mb-3 cursor-pointer">
                    <input class="form-checkbox border border-gray-300 rounded text-blue-600 focus:ring-0 @error('same_as_permanent') border-red-500 @enderror"
                           type="checkbox"
                           id="same_as_permanent"
                           name="same_as_permanent"
                           value="1"
                           {{ old('same_as_permanent', $existingData->same_as_permanent ?? false) ? 'checked' : '' }}/>
                    <span class="ml-2 text-xs select-none">
                        Same as Permanent Address
                    </span>
                </label>
                @error('same_as_permanent')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4">
                    <div>
                        <label class="block mb-1" for="corr_flat_no">
                            Flat No
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_flat_no') border-red-500 @enderror"
                               id="corr_flat_no"
                               name="corr_flat_no"
                               type="text"
                               value="{{ old('corr_flat_no', $existingData->corr_flat_no ?? '') }}"
                               placeholder="e.g. 123"/>
                        @error('corr_flat_no')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_floor">
                            Floor
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_floor') border-red-500 @enderror"
                               id="corr_floor"
                               name="corr_floor"
                               type="text"
                               value="{{ old('corr_floor', $existingData->corr_floor ?? '') }}"
                               placeholder="e.g. 2nd Floor"/>
                        @error('corr_floor')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_name_of_building">
                            Name of building
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_name_of_building') border-red-500 @enderror"
                               id="corr_name_of_building"
                               name="corr_name_of_building"
                               type="text"
                               value="{{ old('corr_name_of_building', $existingData->corr_name_of_building ?? '') }}"
                               placeholder="e.g. Apartment Name"/>
                        @error('corr_name_of_building')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_area">
                            Area
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_area') border-red-500 @enderror"
                               id="corr_area"
                               name="corr_area"
                               type="text"
                               value="{{ old('corr_area', $existingData->corr_area ?? '') }}"
                               placeholder="e.g. Area Name"/>
                        @error('corr_area')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_lane">
                            Lane
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_lane') border-red-500 @enderror"
                               id="corr_lane"
                               name="corr_lane"
                               type="text"
                               value="{{ old('corr_lane', $existingData->corr_lane ?? '') }}"
                               placeholder="e.g. Lane Name"/>
                        @error('corr_lane')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_landmark">
                            Landmark
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_landmark') border-red-500 @enderror"
                               id="corr_landmark"
                               name="corr_landmark"
                               type="text"
                               value="{{ old('corr_landmark', $existingData->corr_landmark ?? '') }}"
                               placeholder="e.g. Near School"/>
                        @error('corr_landmark')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_pincode">
                            Pincode
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_pincode') border-red-500 @enderror"
                               id="corr_pincode"
                               name="corr_pincode"
                               type="text"
                               maxlength="6"
                               value="{{ old('corr_pincode', $existingData->corr_pincode ?? '') }}"
                               placeholder="e.g. 400001"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_status">
                            Status
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_status') border-red-500 @enderror"
                               id="corr_status"
                               name="corr_status"
                               type="text"
                               value="{{ old('corr_status', $existingData->corr_status ?? '') }}"
                               placeholder="e.g. Maharashtra"/>
                        @error('corr_status')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_city">
                            City
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_city') border-red-500 @enderror"
                               id="corr_city"
                               name="corr_city"
                               type="text"
                               value="{{ old('corr_city', $existingData->corr_city ?? '') }}"
                               placeholder="e.g. Mumbai"/>
                        @error('corr_city')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1 text-[9px]" for="corr_chapter">
                            Chapter (Please select the nearest chapter according to your residentail mail)
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_chapter') border-red-500 @enderror"
                               id="corr_chapter"
                               name="corr_chapter"
                               type="text"
                               value="{{ old('corr_chapter', $existingData->corr_chapter ?? '') }}"
                               placeholder="e.g. Mumbai Chapter"/>
                        @error('corr_chapter')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_new_zone">
                            New Zone
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_new_zone') border-red-500 @enderror"
                               id="corr_new_zone"
                               name="corr_new_zone"
                               type="text"
                               value="{{ old('corr_new_zone', $existingData->corr_new_zone ?? '') }}"
                               placeholder="e.g. Zone Name"/>
                        @error('corr_new_zone')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_district">
                            District
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_district') border-red-500 @enderror"
                               id="corr_district"
                               name="corr_district"
                               type="text"
                               value="{{ old('corr_district', $existingData->corr_district ?? '') }}"
                               placeholder="e.g. Mumbai District"/>
                        @error('corr_district')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:col-span-3">
                        <label class="block mb-1" for="corr_postal_address">
                            Postal Address
                        </label>
                        <textarea class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_postal_address') border-red-500 @enderror"
                                  id="corr_postal_address"
                                  name="corr_postal_address"
                                  rows="2"
                                  placeholder="e.g. Full postal address including all details">{{ old('corr_postal_address', $existingData->corr_postal_address ?? '') }}</textarea>
                        @error('corr_postal_address')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_alternate_mail_id">
                            Alternate Mail Id
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_alternate_mail_id') border-red-500 @enderror"
                               id="corr_alternate_mail_id"
                               name="corr_alternate_mail_id"
                               type="email"
                               value="{{ old('corr_alternate_mail_id', $existingData->corr_alternate_mail_id ?? '') }}"
                               placeholder="e.g. alternate@example.com"/>
                        @error('corr_alternate_mail_id')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_alternate_mobile">
                            Alternate Mobile Number
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 @error('corr_alternate_mobile') border-red-500 @enderror"
                               id="corr_alternate_mobile"
                               name="corr_alternate_mobile"
                               type="tel"
                               maxlength="10"
                               value="{{ old('corr_alternate_mobile', $existingData->corr_alternate_mobile ?? '') }}"
                               placeholder="e.g. 9876543210"/>
                        @error('corr_alternate_mobile')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </section>

        <!-- Final Note Section -->
        <section class="max-w-[1200px] mx-auto px-6 mb-6 text-[9px] text-green-700 font-semibold leading-tight">
            <p class="font-bold mb-1">
                NOTE FOR STUDENTS:-
            </p>
            <p>
                Note : Student has to fill all the details in above tabs and in submit section please click on checkbox and press the submit application button. Also wait till you get the pop up of application submitted. (You will get Rainbow like message)
            </p>
        </section>

        <!-- Submit Button Section -->
        <section class="max-w-[1200px] mx-auto px-6 mb-12 text-center">
            <button id="submit-btn" class="bg-project-primary hover:bg-project-primary text-white text-xs font-semibold rounded px-6 py-2 transition-colors"
                    type="submit">
                <span id="submit-text">Save Personal Details 1/7</span>
                <span id="loading-text" class="hidden">Saving...</span>
            </button>
        </section>
    </form>

    <!-- Success/Error Messages -->
    <div id="message-container" class="fixed top-4 right-4 z-50"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const loadingText = document.getElementById('loading-text');
            const messageContainer = document.getElementById('message-container');
            const sameAsPermCheckbox = document.getElementById('same_as_permanent');

            // Check for existing submission_id in localStorage on page load
            // But only if this is not a request for a new form
            const urlParams = new URLSearchParams(window.location.search);
            const isNewForm = urlParams.has('new') || urlParams.has('new_form');

            if (!isNewForm) {
                checkExistingSession();
            } else {
                console.log('New form requested - skipping session recovery');
                // Clear any existing session data
                localStorage.removeItem('jito_submission_id');
                localStorage.removeItem('jito_current_step');
                localStorage.removeItem('jito_last_saved');
                showMessage('Starting a new form...', 'info');
            }

            // Add event listeners to remove error highlighting when user starts typing
            const inputs = form.querySelectorAll("input, select, textarea");
            inputs.forEach(input => {
                input.addEventListener("input", function () {
                    if (this.classList.contains("border-red-500")) {
                        this.classList.remove("border-red-500");
                        this.classList.add("border-gray-300");
                        // Remove associated error message
                        const errorDiv = this.parentNode.querySelector(".error-message");
                        if (errorDiv) {
                            errorDiv.remove();
                        }
                    }
                });
            });

            function checkExistingSession() {
                const existingSubmissionId = localStorage.getItem('jito_submission_id');
                const currentSubmissionId = document.querySelector('input[name="submission_id"]')?.value;

                if (existingSubmissionId && !currentSubmissionId) {
                    // User has an existing session, fetch and resume
                    showMessage('Found existing session. Loading your data...', 'info');

                    fetch('/api/resume-session', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ submission_id: existingSubmissionId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.data) {
                            // Add hidden input for submission_id
                            if (!document.querySelector('input[name="submission_id"]')) {
                                const hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'submission_id';
                                hiddenInput.value = existingSubmissionId;
                                form.appendChild(hiddenInput);
                            }

                            // Populate form with existing data
                            populateFormData(data.data);

                            // Redirect to appropriate step if not on step 1
                            if (data.current_step > 1) {
                                showMessage('Redirecting to your last step...', 'success');
                                setTimeout(() => {
                                    window.location.href = data.next_url;
                                }, 1500);
                            } else {
                                showMessage('Session resumed. You can continue from where you left off.', 'success');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Session recovery error:', error);
                        // Clear invalid session
                        localStorage.removeItem('jito_submission_id');
                    });
                }
            }

            function populateFormData(data) {
                // Populate all form fields with existing data
                Object.keys(data).forEach(fieldName => {
                    const field = document.getElementById(fieldName) || document.querySelector(`[name="${fieldName}"]`);
                    if (field && data[fieldName]) {
                        if (field.type === 'checkbox') {
                            field.checked = data[fieldName] === '1' || data[fieldName] === true;
                        } else if (field.type === 'radio') {
                            if (field.value === data[fieldName]) {
                                field.checked = true;
                            }
                        } else {
                            field.value = data[fieldName];
                        }
                    }
                });
            }

            // Function to clear all validation errors
            function clearValidationErrors() {
                document.querySelectorAll('.error-message').forEach(el => el.remove());
                document.querySelectorAll('.border-red-500').forEach(el => {
                    el.classList.remove('border-red-500', 'border-red-400');
                    el.classList.add('border-gray-300');
                });
            }

            // Function to get field label for better error messages
            function getFieldLabel(fieldName) {
                const labelMap = {
                    'name': 'Name',
                    'applicant': 'Applicant',
                    'request_date': 'Request Date',
                    'financial_asst_type': 'Financial Assistance Type',
                    'financial_asst_for': 'Financial Assistance For',
                    'aadhar_number': 'Aadhar Number',
                    'date_of_birth': 'Date of Birth',
                    'birth_place': 'Birth Place',
                    'student_first_name': 'Student First Name',
                    'middle_name': 'Middle Name',
                    'last_name': 'Last Name',
                    'marital_status': 'Marital Status',
                    'native_place': 'Native Place',
                    'age': 'Age',
                    'nationality': 'Nationality',
                    'gender': 'Gender',
                    'religion': 'Religion',
                    'specially_abled': 'Specially Abled',
                    'blood_group': 'Blood Group',
                    'student_email': 'Student Email',
                    'student_mobile': 'Student Mobile',
                    'pan_no': 'PAN Number',
                    'flat_no': 'Flat Number',
                    'floor': 'Floor',
                    'name_of_building': 'Name of Building',
                    'area': 'Area',
                    'lane': 'Lane',
                    'landmark': 'Landmark',
                    'pincode': 'Pincode',
                    'status': 'Status',
                    'city': 'City',
                    'postal_address': 'Postal Address',
                    'new_zone': 'New Zone',
                    'district': 'District',
                    'chapter': 'Chapter',
                    'alternate_mail_id': 'Alternate Mail Id',
                    'alternate_mobile': 'Alternate Mobile',
                    'corr_flat_no': 'Correspondence Flat Number',
                    'corr_floor': 'Correspondence Floor',
                    'corr_name_of_building': 'Correspondence Building Name',
                    'corr_area': 'Correspondence Area',
                    'corr_lane': 'Correspondence Lane',
                    'corr_landmark': 'Correspondence Landmark',
                    'corr_pincode': 'Correspondence Pincode',
                    'corr_status': 'Correspondence Status',
                    'corr_city': 'Correspondence City',
                    'corr_postal_address': 'Correspondence Postal Address',
                    'corr_new_zone': 'Correspondence New Zone',
                    'corr_district': 'Correspondence District',
                    'corr_chapter': 'Correspondence Chapter',
                    'corr_alternate_mail_id': 'Correspondence Alternate Mail Id',
                    'corr_alternate_mobile': 'Correspondence Alternate Mobile',
                    'paid_amount': 'Paid Amount',
                    'approve_date': 'Approve Date',
                    'outstanding_amount': 'Outstanding Amount',
                    'form_status': 'Form Status'
                };

                return labelMap[fieldName] || fieldName;
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

            // Handle "Same as Permanent Address" checkbox
            if (sameAsPermCheckbox) {
                sameAsPermCheckbox.addEventListener('change', function() {
                    const permanentFields = {
                        'flat_no': 'corr_flat_no',
                        'floor': 'corr_floor',
                        'name_of_building': 'corr_name_of_building',
                        'area': 'corr_area',
                        'lane': 'corr_lane',
                        'landmark': 'corr_landmark',
                        'pincode': 'corr_pincode',
                        'status': 'corr_status',
                        'city': 'corr_city',
                        'postal_address': 'corr_postal_address',
                        'new_zone': 'corr_new_zone',
                        'district': 'corr_district',
                        'chapter': 'corr_chapter'
                    };

                    if (this.checked) {
                        Object.keys(permanentFields).forEach(permField => {
                            const permInput = document.getElementById(permField);
                            const corrInput = document.getElementById(permanentFields[permField]);
                            if (permInput && corrInput) {
                                corrInput.value = permInput.value;
                                corrInput.disabled = true;
                            }
                        });
                    } else {
                        Object.values(permanentFields).forEach(corrField => {
                            const corrInput = document.getElementById(corrField);
                            if (corrInput) {
                                corrInput.disabled = false;
                                corrInput.value = '';
                            }
                        });
                    }
                });
            }

            // Profile photo upload functionality
            const uploadBtn = document.getElementById('upload-btn');
            const fileInput = document.getElementById('profile_photo');
            const fileName = document.getElementById('file-name');

            if (uploadBtn && fileInput) {
                uploadBtn.addEventListener('click', function() {
                    fileInput.click();
                });

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        const fileType = file.type;
                        const fileNameText = file.name;

                        // Check if file is JPEG or JPG
                        if (fileType === 'image/jpeg' || fileNameText.toLowerCase().endsWith('.jpg')) {
                            fileName.textContent = 'Selected: ' + fileNameText;
                            fileName.classList.remove('hidden');

                            // Preview the image
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                // You can add image preview functionality here if needed
                            }
                            reader.readAsDataURL(file);
                        } else {
                            alert('Please select a JPEG or JPG file only.');
                            this.value = ''; // Clear the input
                            fileName.classList.add('hidden');
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
                        return response.json().then(data => {
                            // Return both response status and data for proper error handling
                            return { ok: response.ok, data: data, status: response.status };
                        });
                    } else {
                        // If not JSON, it's likely an HTML redirect or error page
                        window.location.reload();
                        return;
                    }
                })
                .then(result => {
                    if (!result) return; // If redirected, result will be undefined

                    const { ok, data, status } = result;

                    if (ok) {
                        // Success case
                        if (data.success) {
                            clearValidationErrors();
                            showMessage('Personal details saved successfully!', 'success');
                            // Redirect to family details page
                            setTimeout(() => {
                                window.location.href = '{{ route("family-details", ["submission_id" => $submissionId ?? ""]) }}';
                            }, 1500);
                        } else {
                            showMessage(data.message || 'Error saving details', 'error');
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
                                    fieldElement.classList.add('border-red-500');

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
                        } else if (data.error_type === 'database_constraint') {
                            // Handle database constraint violations (like duplicate Aadhar number)
                            showMessage(data.message || 'Database constraint violation', 'error');

                            // If it's an Aadhar number issue, highlight that field
                            if (data.message && data.message.includes('Aadhar number')) {
                                const aadharField = document.getElementById('aadhar_number');
                                if (aadharField) {
                                    aadharField.classList.remove('border-gray-300');
                                    aadharField.classList.add('border-red-500');
                                    aadharField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    aadharField.focus();
                                }
                            }

                            // If it's an email issue, highlight that field
                            if (data.message && data.message.includes('email')) {
                                const emailField = document.getElementById('student_email');
                                if (emailField) {
                                    emailField.classList.remove('border-gray-300');
                                    emailField.classList.add('border-red-500');
                                    emailField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    emailField.focus();
                                }
                            }
                        } else {
                            // Handle other types of errors
                            showMessage(data.message || `Error: ${status}`, 'error');
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
        });

        // Global function to clear session (for testing)
        window.clearSession = function() {
            if (confirm('Are you sure you want to clear your session? This will delete all saved data.')) {
                localStorage.removeItem('jito_submission_id');
                localStorage.removeItem('jito_current_step');
                localStorage.removeItem('jito_last_saved');

                fetch('/api/clear-session', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(() => {
                    showMessage('Session cleared successfully!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error clearing session:', error);
                    showMessage('Session cleared from browser', 'info');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                });
            }
        };
    </script>
</body>
</html>
