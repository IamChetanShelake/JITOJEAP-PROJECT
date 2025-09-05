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

    <main class="max-w-[1200px] mx-auto px-6 py-8">
        <form method="POST" action="{{ route('financial-assistance.store') }}">
            @csrf

            <!-- Form Navigation Tabs -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <nav class="flex flex-wrap gap-1 text-[11px] font-semibold text-gray-600">
                    <button class="flex items-center gap-1 border border-gray-300 rounded px-3 py-1">
                        Personal Details
                    </button>
                    <button aria-current="step" class="flex items-center gap-1 bg-project-success text-white rounded px-3 py-1">
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
                        value="0"
                        class="w-24 border border-gray-300 rounded px-2 py-1 mb-6 focus:outline-none focus:ring-1 focus:ring-blue-600"
                    />
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6">
                        <div>
                            <label for="relation_student" class="block mb-1">Relation with Student <span class="text-red-500">*</span></label>
                            <input id="relation_student" name="relation_student" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>
                        <div>
                            <label for="family_name" class="block mb-1">Name <span class="text-red-500">*</span></label>
                            <input id="family_name" name="family_name" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>
                        <div>
                            <label for="family_age" class="block mb-1">Age <span class="text-red-500">*</span></label>
                            <input id="family_age" name="family_age" type="number" min="0" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>

                        <div>
                            <label for="marital_status" class="block mb-1">Marital Status <span class="text-red-500">*</span></label>
                            <select id="marital_status" name="marital_status" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required>
                                <option value="">Select Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                        <div>
                            <label for="qualification" class="block mb-1">Qualification</label>
                            <input id="qualification" name="qualification" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                        <div>
                            <label for="occupation" class="block mb-1">Occupation</label>
                            <input id="occupation" name="occupation" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>

                        <div>
                            <label for="mobile_number" class="block mb-1">Mobile Number</label>
                            <input id="mobile_number" name="mobile_number" type="tel" maxlength="10" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                        <div>
                            <label for="email_id" class="block mb-1">Email ID</label>
                            <input id="email_id" name="email_id" type="email" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                        <div>
                            <label for="yearly_gross_income" class="block mb-1">Yearly Gross Income</label>
                            <input id="yearly_gross_income" name="yearly_gross_income" type="number" step="0.01" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>

                        <div>
                            <label for="insurance_coverage" class="block mb-1">Individual Insurance coverage value</label>
                            <input id="insurance_coverage" name="insurance_coverage" type="number" step="0.01" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
                        </div>
                        <div>
                            <label for="premium_paid" class="block mb-1">Individual Premium paid per year</label>
                            <input id="premium_paid" name="premium_paid" type="number" step="0.01" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" />
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
                        class="w-24 border border-gray-300 rounded px-2 py-1 mb-6 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm"
                    />

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="total_student" class="block mb-1">Total No of Student</label>
                            <input id="total_student" name="total_student" type="number" min="0" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="total_family_income" class="block mb-1">Total Family Income</label>
                            <input id="total_family_income" name="total_family_income" type="number" step="0.01" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="family_member_diksha" class="block mb-1">Family Member taken diksha</label>
                            <input id="family_member_diksha" name="family_member_diksha" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>

                        <div>
                            <label for="total_insurance_coverage" class="block mb-1">Total Insurance Coverage of Family</label>
                            <input id="total_insurance_coverage" name="total_insurance_coverage" type="number" step="0.01" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="total_premium_paid" class="block mb-1">Total Premium paid in rupees per/year</label>
                            <input id="total_premium_paid" name="total_premium_paid" type="number" step="0.01" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div></div>
                    </div>

                    <div class="mb-4 font-semibold text-sm">Family Contact Details</div>

                    <div class="mb-2 font-semibold text-sm">Parental Uncle</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="parental_uncle_name" class="block mb-1">Name</label>
                            <input id="parental_uncle_name" name="parental_uncle_name" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="parental_uncle_mobile" class="block mb-1">Mobile Number</label>
                            <input id="parental_uncle_mobile" name="parental_uncle_mobile" type="tel" maxlength="10" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="parental_uncle_email" class="block mb-1">Email Id</label>
                            <input id="parental_uncle_email" name="parental_uncle_email" type="email" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Maternal Uncle</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="maternal_uncle_name" class="block mb-1">Name</label>
                            <input id="maternal_uncle_name" name="maternal_uncle_name" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="maternal_uncle_mobile" class="block mb-1">Mobile Number</label>
                            <input id="maternal_uncle_mobile" name="maternal_uncle_mobile" type="tel" maxlength="10" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="maternal_uncle_email" class="block mb-1">Email Id</label>
                            <input id="maternal_uncle_email" name="maternal_uncle_email" type="email" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Parental Aunty</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="parental_aunty_name" class="block mb-1">Name</label>
                            <input id="parental_aunty_name" name="parental_aunty_name" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="parental_aunty_mobile" class="block mb-1">Mobile Number</label>
                            <input id="parental_aunty_mobile" name="parental_aunty_mobile" type="tel" maxlength="10" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="parental_aunty_email" class="block mb-1">Email Id</label>
                            <input id="parental_aunty_email" name="parental_aunty_email" type="email" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                    </div>

                    <div class="mb-2 font-semibold text-sm">Maternal Aunty</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6 text-sm">
                        <div>
                            <label for="maternal_aunty_name" class="block mb-1">Name</label>
                            <input id="maternal_aunty_name" name="maternal_aunty_name" type="text" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="maternal_aunty_mobile" class="block mb-1">Mobile Number</label>
                            <input id="maternal_aunty_mobile" name="maternal_aunty_mobile" type="tel" maxlength="10" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                        <div>
                            <label for="maternal_aunty_email" class="block mb-1">Email Id</label>
                            <input id="maternal_aunty_email" name="maternal_aunty_email" type="email" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600" />
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button
                            type="submit"
                            class="bg-project-primary hover:bg-project-primary text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors"
                        >
                            Family Details 2/7
                        </button>
                    </div>
                </div>
            </section>
        </form>
    </main>
</body>
</html>