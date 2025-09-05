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

    <!-- Main Form Section -->
    <form method="POST" action="{{ route('financial-assistance.store') }}" class="max-w-[1200px] mx-auto px-6">
        @csrf
        
        <!-- Basic Information Section -->
        <section class="mb-8">
            <div class="bg-white border border-gray-200 rounded-md shadow-md p-6 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="name">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="name" 
                           name="name" 
                           type="text" 
                           required/>
                </div>
                <div></div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="applicant">
                        Applicant <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="applicant" 
                           name="applicant" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="request_date">
                        Request Date <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="request_date" 
                           name="request_date" 
                           type="date" 
                           required/>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="financial_asst_type">
                        Financial Asst Type <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                            id="financial_asst_type" 
                            name="financial_asst_type" 
                            required>
                        <option value="">Select Type</option>
                        <option value="education">Education</option>
                        <option value="medical">Medical</option>
                        <option value="emergency">Emergency</option>
                        <option value="business">Business</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="financial_asst_for">
                        Financial Asst For <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="financial_asst_for" 
                           name="financial_asst_for" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="paid_amount">
                        Paid Amount
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="paid_amount" 
                           name="paid_amount" 
                           type="number" 
                           step="0.01"/>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="approve_date">
                        Approve Date
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="approve_date" 
                           name="approve_date" 
                           type="date"/>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="outstanding_amount">
                        Outstanding Amount
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="outstanding_amount" 
                           name="outstanding_amount" 
                           type="number" 
                           step="0.01"/>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1" for="form_status">
                        Form Status
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600" 
                            id="form_status" 
                            name="form_status">
                        <option value="draft">Draft</option>
                        <option value="submitted">Submitted</option>
                        <option value="under_review">Under Review</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
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
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="aadhar_number" 
                           name="aadhar_number" 
                           type="text" 
                           maxlength="12" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="date_of_birth">
                        Date Of Birth <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="date_of_birth" 
                           name="date_of_birth" 
                           type="date" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="birth_place">
                        Birth Place <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="birth_place" 
                           name="birth_place" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="student_first_name">
                        Student First Name <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="student_first_name" 
                           name="student_first_name" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="middle_name">
                        Middle Name
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="middle_name" 
                           name="middle_name" 
                           type="text"/>
                </div>
                <div>
                    <label class="block mb-1" for="last_name">
                        Last Name <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="last_name" 
                           name="last_name" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="marital_status">
                        Marital Status <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                            id="marital_status" 
                            name="marital_status" 
                            required>
                        <option value="">Select Status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1" for="native_place">
                        Native Place <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="native_place" 
                           name="native_place" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="age">
                        Age <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="age" 
                           name="age" 
                           type="number" 
                           min="1" 
                           max="120" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="gender">
                        Gender <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                            id="gender" 
                            name="gender" 
                            required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1" for="student_mobile">
                        Student Mobile Number <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="student_mobile" 
                           name="student_mobile" 
                           type="tel" 
                           maxlength="10" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="religion">
                        Religion <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="religion" 
                           name="religion" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="nationality">
                        Nationality
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="nationality" 
                           name="nationality" 
                           type="text" 
                           value="Indian" 
                           readonly/>
                </div>
                <div>
                    <label class="block mb-1" for="blood_group">
                        Blood Group
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                            id="blood_group" 
                            name="blood_group">
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1" for="student_email">
                        Student E-Mail <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="student_email" 
                           name="student_email" 
                           type="email" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="specially_abled">
                        Specially Abled <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                            id="specially_abled" 
                            name="specially_abled" 
                            required>
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1" for="pan_no">
                        PAN No
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="pan_no" 
                           name="pan_no" 
                           type="text" 
                           maxlength="10"/>
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
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="flat_no" 
                           name="flat_no" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="floor">
                        Floor
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="floor" 
                           name="floor" 
                           type="text"/>
                </div>
                <div>
                    <label class="block mb-1" for="name_of_building">
                        Name of building <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="name_of_building" 
                           name="name_of_building" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="area">
                        Area <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="area" 
                           name="area" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="lane">
                        Lane
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="lane" 
                           name="lane" 
                           type="text"/>
                </div>
                <div>
                    <label class="block mb-1" for="landmark">
                        Landmark
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="landmark" 
                           name="landmark" 
                           type="text"/>
                </div>
                <div>
                    <label class="block mb-1" for="pincode">
                        Pincode <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="pincode" 
                           name="pincode" 
                           type="text" 
                           maxlength="6" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="status">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="status" 
                           name="status" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="city">
                        City <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="city" 
                           name="city" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1 text-[9px]" for="chapter">
                        Chapter (Please select the nearest chapter according to your residentail mail) <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="chapter" 
                           name="chapter" 
                           type="text" 
                           required/>
                </div>
                <div>
                    <label class="block mb-1" for="new_zone">
                        New Zone
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="new_zone" 
                           name="new_zone" 
                           type="text"/>
                </div>
                <div>
                    <label class="block mb-1" for="district">
                        District <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="district" 
                           name="district" 
                           type="text" 
                           required/>
                </div>
                <div class="md:col-span-3">
                    <label class="block mb-1" for="postal_address">
                        Postal Address <span class="text-red-500">*</span>
                    </label>
                    <textarea class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                              id="postal_address" 
                              name="postal_address" 
                              rows="2" 
                              required></textarea>
                </div>
                <div>
                    <label class="block mb-1" for="alternate_mail_id">
                        Alternate Mail Id
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="alternate_mail_id" 
                           name="alternate_mail_id" 
                           type="email"/>
                </div>
                <div>
                    <label class="block mb-1" for="alternate_mobile">
                        Alternate Mobile Number
                    </label>
                    <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                           id="alternate_mobile" 
                           name="alternate_mobile" 
                           type="tel" 
                           maxlength="10"/>
                </div>
            </div>
        </section>

        <!-- Correspondence Address Section -->
        <section class="max-w-[1200px] mx-auto px-6 mb-8">
            <h3 class="text-sm font-semibold mb-4 text-project-secondary">Correspondence Address</h3>
            <div class="text-xs text-gray-700">
                <label class="inline-flex items-center mb-3 cursor-pointer">
                    <input class="form-checkbox border border-gray-300 rounded text-blue-600 focus:ring-0" 
                           type="checkbox" 
                           id="same_as_permanent" 
                           name="same_as_permanent" 
                           value="1"/>
                    <span class="ml-2 text-xs select-none">
                        Same as Permanent Address
                    </span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4">
                    <div>
                        <label class="block mb-1" for="corr_flat_no">
                            Flat No
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_flat_no" 
                               name="corr_flat_no" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_floor">
                            Floor
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_floor" 
                               name="corr_floor" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_name_of_building">
                            Name of building
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_name_of_building" 
                               name="corr_name_of_building" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_area">
                            Area
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_area" 
                               name="corr_area" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_lane">
                            Lane
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_lane" 
                               name="corr_lane" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_landmark">
                            Landmark
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_landmark" 
                               name="corr_landmark" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_pincode">
                            Pincode
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_pincode" 
                               name="corr_pincode" 
                               type="text" 
                               maxlength="6"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_status">
                            Status
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_status" 
                               name="corr_status" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_city">
                            City
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_city" 
                               name="corr_city" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1 text-[9px]" for="corr_chapter">
                            Chapter (Please select the nearest chapter according to your residentail mail)
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_chapter" 
                               name="corr_chapter" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_new_zone">
                            New Zone
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_new_zone" 
                               name="corr_new_zone" 
                               type="text"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_district">
                            District
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_district" 
                               name="corr_district" 
                               type="text"/>
                    </div>
                    <div class="md:col-span-3">
                        <label class="block mb-1" for="corr_postal_address">
                            Postal Address
                        </label>
                        <textarea class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                                  id="corr_postal_address" 
                                  name="corr_postal_address" 
                                  rows="2"></textarea>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_alternate_mail_id">
                            Alternate Mail Id
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_alternate_mail_id" 
                               name="corr_alternate_mail_id" 
                               type="email"/>
                    </div>
                    <div>
                        <label class="block mb-1" for="corr_alternate_mobile">
                            Alternate Mobile Number
                        </label>
                        <input class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" 
                               id="corr_alternate_mobile" 
                               name="corr_alternate_mobile" 
                               type="tel" 
                               maxlength="10"/>
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
            <button class="bg-project-primary hover:bg-project-primary text-white text-xs font-semibold rounded px-6 py-2 transition-colors" 
                    type="submit">
                Save Personal Details 1/7
            </button>
        </section>
    </form>
</body>
</html>