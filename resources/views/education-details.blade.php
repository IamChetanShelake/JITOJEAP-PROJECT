<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Financial Assistance Form - Education Details</title>
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
    <!-- <section class="max-w-[1200px] mx-auto px-6 mb-4">
        <div class="bg-blue-50 border border-blue-200 rounded-md p-3 text-sm">
            <div class="flex items-center justify-between">
                <span class="text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Session ID: <strong>{{ substr($submissionId, 0, 8) }}...</strong>
                </span>
                <span class="text-blue-600 font-semibold">Step 3/7 - Education Details</span>
            </div>
        </div>
    </section> -->
    @endif

    <main class="max-w-[1200px] mx-auto px-6 py-8">
        <form method="POST" action="{{ route('education-details.store') }}" id="education-form">
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
                    <button aria-current="step" class="flex items-center gap-1 bg-project-primary text-white rounded px-3 py-1">
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

            <!-- Education Details Section -->
            <section class="max-w-[1200px] mx-auto px-6 mb-8">
                <div class="text-xs text-gray-700 mb-6">

                    <!-- Previous Education Details -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-sm">Previous Education Details *</h3>
                            <div class="flex gap-2">
                                <button type="button" id="add-education" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                    Add
                                </button>
                                <button type="button" id="remove-education" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition-colors">
                                    Remove
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="text-white text-xs" style="background: #0A2478;">
                                        <th class="border border-white px-2 py-2 text-center w-16">Sr. No.</th>
                                        <th class="border border-white px-2 py-2 text-center">Exam Name *</th>
                                        <th class="border border-white px-2 py-2 text-center">Course Name *</th>
                                        <th class="border border-white px-2 py-2 text-center">Exam Month *</th>
                                        <th class="border border-white px-2 py-2 text-center">Exam Year *</th>
                                        <th class="border border-white px-2 py-2 text-center">Out of Marks *</th>
                                        <th class="border border-white px-2 py-2 text-center">Marks Obtained *</th>
                                        <th class="border border-white px-2 py-2 text-center">Percentage *</th>
                                    </tr>
                                </thead>
                                <tbody id="education-table-body">
                                    @if(isset($existingData) && $existingData->previous_education && is_array($existingData->previous_education))
                                        @foreach($existingData->previous_education as $index => $education)
                                            <tr class="education-row" style="background-color: {{ ($index % 2 == 0) ? '#FFF7D3' : '#FFC4C4' }};">
                                                <td class="border border-white px-2 py-1 text-center row-number">{{ $index + 1 }}</td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="previous_education[{{ $index }}][exam_name]" value="{{ old('previous_education.'.$index.'.exam_name', $education['exam_name'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. SSC" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="previous_education[{{ $index }}][course_name]" value="{{ old('previous_education.'.$index.'.course_name', $education['course_name'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 10th Grade" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="text" name="previous_education[{{ $index }}][exam_month]" value="{{ old('previous_education.'.$index.'.exam_month', $education['exam_month'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. March" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="number" name="previous_education[{{ $index }}][exam_year]" value="{{ old('previous_education.'.$index.'.exam_year', $education['exam_year'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 2020" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="number" name="previous_education[{{ $index }}][out_of_marks]" value="{{ old('previous_education.'.$index.'.out_of_marks', $education['out_of_marks'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent marks-input" data-row="{{ $index }}" required placeholder="e.g. 100" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="number" name="previous_education[{{ $index }}][marks_obtained]" value="{{ old('previous_education.'.$index.'.marks_obtained', $education['marks_obtained'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent marks-input" data-row="{{ $index }}" required placeholder="e.g. 85" />
                                                </td>
                                                <td class="border border-white px-1 py-1">
                                                    <input type="number" name="previous_education[{{ $index }}][percentage]" value="{{ old('previous_education.'.$index.'.percentage', $education['percentage'] ?? '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent percentage-display" step="0.01" readonly placeholder="e.g. 85.00" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <!-- Default rows when no existing data -->
                                        <tr class="education-row" style="background-color: #FFF7D3;">
                                            <td class="border border-white px-2 py-1 text-center row-number">1</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="previous_education[0][exam_name]" value="{{ old('previous_education.0.exam_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. SSC" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="previous_education[0][course_name]" value="{{ old('previous_education.0.course_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 10th Grade" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="previous_education[0][exam_month]" value="{{ old('previous_education.0.exam_month', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. March" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="previous_education[0][exam_year]" value="{{ old('previous_education.0.exam_year', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 2020" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="previous_education[0][out_of_marks]" value="{{ old('previous_education.0.out_of_marks', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent marks-input" data-row="0" required placeholder="e.g. 100" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="previous_education[0][marks_obtained]" value="{{ old('previous_education.0.marks_obtained', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent marks-input" data-row="0" required placeholder="e.g. 85" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="previous_education[0][percentage]" value="{{ old('previous_education.0.percentage', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent percentage-display" step="0.01" readonly placeholder="e.g. 85.00" />
                                            </td>
                                        </tr>
                                        <tr class="education-row" style="background-color: #FFC4C4;">
                                            <td class="border border-white px-2 py-1 text-center row-number">2</td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="previous_education[1][exam_name]" value="{{ old('previous_education.1.exam_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. HSC" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="previous_education[1][course_name]" value="{{ old('previous_education.1.course_name', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 12th Grade" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="text" name="previous_education[1][exam_month]" value="{{ old('previous_education.1.exam_month', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. March" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="previous_education[1][exam_year]" value="{{ old('previous_education.1.exam_year', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 2022" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="previous_education[1][out_of_marks]" value="{{ old('previous_education.1.out_of_marks', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent marks-input" data-row="1" required placeholder="e.g. 100" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="previous_education[1][marks_obtained]" value="{{ old('previous_education.1.marks_obtained', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent marks-input" data-row="1" required placeholder="e.g. 90" />
                                            </td>
                                            <td class="border border-white px-1 py-1">
                                                <input type="number" name="previous_education[1][percentage]" value="{{ old('previous_education.1.percentage', '') }}" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent percentage-display" step="0.01" readonly placeholder="e.g. 90.00" />
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 mb-6">
                        <div>
                            <label for="extracurricular_activities" class="block mb-1 text-sm">Please specify if any extra curricular activities at school/college/university level *</label>
                            <textarea id="extracurricular_activities" name="extracurricular_activities" rows="3" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Sports, Music, Dance, etc.">{{ old('extracurricular_activities', $existingData->extracurricular_activities ?? '') }}</textarea>
                        </div>
                        <div>
                            <label for="research_projects" class="block mb-1 text-sm">Please specify if any research and development projects undertake *</label>
                            <textarea id="research_projects" name="research_projects" rows="3" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. AI Research, Data Analysis, etc.">{{ old('research_projects', $existingData->research_projects ?? '') }}</textarea>
                        </div>
                        <div>
                            <label for="work_experience_years" class="block mb-1 text-sm">Work experience in years *</label>
                            <input id="work_experience_years" name="work_experience_years" type="number" step="0.1" value="{{ old('work_experience_years', $existingData->work_experience_years ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 2.5" />
                        </div>
                        <div>
                            <label for="company_name" class="block mb-1 text-sm">Name of company *</label>
                            <input id="company_name" name="company_name" type="text" value="{{ old('company_name', $existingData->company_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. ABC Corporation" />
                        </div>
                        <div>
                            <label for="remuneration" class="block mb-1 text-sm">Remuneration *</label>
                            <input id="remuneration" name="remuneration" type="number" step="0.01" value="{{ old('remuneration', $existingData->remuneration ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 25000" />
                        </div>
                        <div>
                            <label for="ctc_yearly" class="block mb-1 text-sm">CTC (Yearly) *</label>
                            <input id="ctc_yearly" name="ctc_yearly" type="number" step="0.01" value="{{ old('ctc_yearly', $existingData->ctc_yearly ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 300000" />
                        </div>
                        <div class="md:col-span-2">
                            <label for="work_profile" class="block mb-1 text-sm">Work Profile *</label>
                            <textarea id="work_profile" name="work_profile" rows="3" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Software Developer, Marketing Executive, etc.">{{ old('work_profile', $existingData->work_profile ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Current Education Details -->
                    <div class="mb-6 font-semibold text-sm">Current Education Details *</div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 mb-6">
                        <div>
                            <label for="course_name_current" class="block mb-1">Name of course *</label>
                            <input id="course_name_current" name="course_name_current" type="text" value="{{ old('course_name_current', $existingData->course_name_current ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Computer Science" />
                        </div>
                        <div>
                            <label for="pursuing_education" class="block mb-1">Pursuing Education *</label>
                            <input id="pursuing_education" name="pursuing_education" type="text" value="{{ old('pursuing_education', $existingData->pursuing_education ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. B.Tech" />
                        </div>
                        <div>
                            <label for="university_college_name" class="block mb-1">University and college name *</label>
                            <input id="university_college_name" name="university_college_name" type="text" value="{{ old('university_college_name', $existingData->university_college_name ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. IIT Bombay" />
                        </div>
                        <div>
                            <label for="commencement_month_year" class="block mb-1">Commencement month/year *</label>
                            <input id="commencement_month_year" name="commencement_month_year" type="text" placeholder="MM/YYYY" value="{{ old('commencement_month_year', $existingData->commencement_month_year ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>
                        <div>
                            <label for="completion_month_year" class="block mb-1">Completion Month/year *</label>
                            <input id="completion_month_year" name="completion_month_year" type="text" placeholder="MM/YYYY" value="{{ old('completion_month_year', $existingData->completion_month_year ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required />
                        </div>
                        <div>
                            <label for="city" class="block mb-1">City *</label>
                            <input id="city" name="city" type="text" value="{{ old('city', $existingData->city ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. Mumbai" />
                        </div>
                        <div>
                            <label for="country" class="block mb-1">Country *</label>
                            <input id="country" name="country" type="text" value="{{ old('country', $existingData->country ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. India" />
                        </div>
                        <div>
                            <label for="qs_ranking_foreign" class="block mb-1">Q S Ranking for Foreign *</label>
                            <input id="qs_ranking_foreign" name="qs_ranking_foreign" type="text" value="{{ old('qs_ranking_foreign', $existingData->qs_ranking_foreign ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 50" />
                        </div>
                        <div>
                            <label for="nirf_ranking_domestic" class="block mb-1">NIRF Ranking for domestic(list attached on website) *</label>
                            <input id="nirf_ranking_domestic" name="nirf_ranking_domestic" type="text" value="{{ old('nirf_ranking_domestic', $existingData->nirf_ranking_domestic ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-600 text-sm" required placeholder="e.g. 10" />
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button id="submit-btn" type="submit" class="bg-project-primary hover:bg-project-primary text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors">
                            <span id="submit-text">Save Education Details 3/7</span>
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
            const form = document.getElementById('education-form');
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

            // Initialize row count based on existing data
            let educationRowCount = document.querySelectorAll('.education-row').length || 2;

            // Function to update row numbers
            function updateRowNumbers() {
                const rows = document.querySelectorAll('.education-row');
                rows.forEach((row, index) => {
                    const rowNumber = row.querySelector('.row-number');
                    rowNumber.textContent = index + 1;

                    // Apply alternating colors to entire row
                    const isOddRow = (index % 2) === 0; // 0-based index, so even index = odd row number
                    const backgroundColor = isOddRow ? '#FFF7D3' : '#FFC4C4';
                    row.style.backgroundColor = backgroundColor;

                    // Update input names
                    const inputs = row.querySelectorAll('input');
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        if (name && name.includes('previous_education')) {
                            const newName = name.replace(/\[\d+\]/, `[${index}]`);
                            input.setAttribute('name', newName);
                            input.setAttribute('data-row', index);
                        }
                    });
                });
            }

            // Function to calculate percentage
            function calculatePercentage(row) {
                const outOfMarks = parseFloat(row.querySelector(`input[name*="out_of_marks"]`).value) || 0;
                const marksObtained = parseFloat(row.querySelector(`input[name*="marks_obtained"]`).value) || 0;
                const percentageInput = row.querySelector(`input[name*="percentage"]`);

                if (outOfMarks > 0) {
                    const percentage = (marksObtained / outOfMarks) * 100;
                    percentageInput.value = percentage.toFixed(2);
                } else {
                    percentageInput.value = '';
                }
            }

            // Add event listeners for marks calculation
            function addMarksListeners(row) {
                const marksInputs = row.querySelectorAll('.marks-input');
                marksInputs.forEach(input => {
                    input.addEventListener('input', function() {
                        calculatePercentage(row);
                    });
                });
            }

            // Initialize existing rows
            document.querySelectorAll('.education-row').forEach(row => {
                addMarksListeners(row);
            });

            // Add new education row
            document.getElementById('add-education').addEventListener('click', function() {
                const tableBody = document.getElementById('education-table-body');
                const newRow = document.createElement('tr');
                newRow.className = 'education-row';

                // Alternate between the two colors based on row index
                const isOddRow = (educationRowCount % 2) === 0; // 0-based index, so even index = odd row number
                const backgroundColor = isOddRow ? '#FFF7D3' : '#FFC4C4';
                newRow.style.backgroundColor = backgroundColor;

                newRow.innerHTML = `
                    <td class="border border-white px-2 py-1 text-center row-number">${educationRowCount + 1}</td>
                    <td class="border border-white px-1 py-1">
                        <input type="text" name="previous_education[${educationRowCount}][exam_name]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. SSC" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="text" name="previous_education[${educationRowCount}][course_name]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 10th Grade" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="text" name="previous_education[${educationRowCount}][exam_month]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. March" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="number" name="previous_education[${educationRowCount}][exam_year]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent" required placeholder="e.g. 2020" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="number" name="previous_education[${educationRowCount}][out_of_marks]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent marks-input" data-row="${educationRowCount}" required placeholder="e.g. 100" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="number" name="previous_education[${educationRowCount}][marks_obtained]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent marks-input" data-row="${educationRowCount}" required placeholder="e.g. 85" />
                    </td>
                    <td class="border border-white px-1 py-1">
                        <input type="number" name="previous_education[${educationRowCount}][percentage]" class="w-full border-0 px-1 py-1 text-xs focus:outline-none bg-transparent percentage-display" step="0.01" readonly placeholder="e.g. 85.00" />
                    </td>
                `;

                tableBody.appendChild(newRow);
                addMarksListeners(newRow);
                educationRowCount++;
                
                // Add event listener to remove error highlighting for new inputs
                const newInputs = newRow.querySelectorAll('input');
                newInputs.forEach(input => {
                    input.addEventListener('input', function() {
                        if (this.classList.contains('field-error')) {
                            this.classList.remove('field-error');
                            this.classList.add('border-gray-300');
                        }
                    });
                });
            });

            // Remove education row
            document.getElementById('remove-education').addEventListener('click', function() {
                const rows = document.querySelectorAll('.education-row');
                if (rows.length > 1) {
                    rows[rows.length - 1].remove();
                    educationRowCount = Math.max(1, educationRowCount - 1);
                    updateRowNumbers();
                }
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
                    'extracurricular_activities': 'Extracurricular Activities',
                    'research_projects': 'Research Projects',
                    'work_experience_years': 'Work Experience Years',
                    'company_name': 'Company Name',
                    'remuneration': 'Remuneration',
                    'ctc_yearly': 'CTC Yearly',
                    'work_profile': 'Work Profile',
                    'course_name_current': 'Course Name',
                    'pursuing_education': 'Pursuing Education',
                    'university_college_name': 'University/College Name',
                    'commencement_month_year': 'Commencement Month/Year',
                    'completion_month_year': 'Completion Month/Year',
                    'city': 'City',
                    'country': 'Country',
                    'qs_ranking_foreign': 'QS Ranking',
                    'nirf_ranking_domestic': 'NIRF Ranking'
                };
                
                // For table fields
                if (fieldName.includes('previous_education')) {
                    if (fieldName.includes('exam_name')) return 'Exam Name';
                    if (fieldName.includes('course_name')) return 'Course Name';
                    if (fieldName.includes('exam_month')) return 'Exam Month';
                    if (fieldName.includes('exam_year')) return 'Exam Year';
                    if (fieldName.includes('out_of_marks')) return 'Out of Marks';
                    if (fieldName.includes('marks_obtained')) return 'Marks Obtained';
                    if (fieldName.includes('percentage')) return 'Percentage';
                }
                
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
                            showMessage('Education details saved successfully!', 'success');
                            // Redirect to funding details page
                            setTimeout(() => {
                                window.location.href = '{{ route("funding-details", ["submission_id" => $submissionId ?? ""]) }}';
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

            // Navigation tab handlers
            const personalDetailsTab = document.getElementById('personal-details-tab');
            const familyDetailsTab = document.getElementById('family-details-tab');

            if (personalDetailsTab) {
                personalDetailsTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');
                    if (submissionId) {
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

            if (familyDetailsTab) {
                familyDetailsTab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submissionId = document.querySelector('input[name="submission_id"]')?.value || localStorage.getItem('jito_submission_id');
                    if (submissionId) {
                        showMessage('Navigating to Family Details...', 'info');
                        setTimeout(() => {
                            window.location.href = `/family-details?submission_id=${submissionId}`;
                        }, 500);
                    } else {
                        showMessage('No active session found. Starting new form...', 'info');
                        setTimeout(() => {
                            window.location.href = '/family-details';
                        }, 500);
                    }
                });
            }
        });
    </script>
</body>
</html>