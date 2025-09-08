<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Financial Assistance Form - Preview</title>
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
        .section-divider { border-bottom: 2px solid #e5e7eb; margin: 2rem 0; }
        .detail-row { display: flex; margin-bottom: 0.5rem; }
        .detail-label { font-weight: 600; width: 250px; }
        .detail-value { flex: 1; }
    </style>
</head>
<body class="bg-white text-gray-900">
    <!-- Header Section -->
    <header class="flex justify-between items-center px-6 py-6 max-w-[1200px] mx-auto">
        <!-- Breadcrumb Navigation -->
        <div class="flex items-center space-x-2 text-sm text-gray-700">
            <i class="fas fa-chevron-left text-xs"></i>
            <a class="font-semibold project-primary hover:underline" href="{{ route('main') }}">Financial Assistance</a>
            <span>/ Preview</span>
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
            <button class="flex items-center gap-2 bg-project-primary hover:bg-project-primary text-white text-sm font-semibold px-4 py-2 rounded transition-colors" onclick="window.print()">
                <i class="fas fa-print"></i> Print
            </button>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-900 text-sm font-normal px-4 py-2 rounded transition-colors" onclick="window.location.href='{{ route('final-submission.index', ['submission_id' => $submissionId ?? '']) }}'">
                Back to Submit
            </button>
        </div>
    </section>

    <!-- Important Note Section -->
    <section class="bg-yellow-50 text-red-600 text-center text-xs font-semibold py-2 mb-6 max-w-[1200px] mx-auto px-6">
        *NOTE:- Please review all details carefully before submitting
    </section>

    <main class="max-w-[1200px] mx-auto px-6 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Financial Assistance Application Preview</h1>
            <p class="text-gray-600 mt-2">Review all details before final submission</p>
        </div>

        <!-- Personal Details Section -->
        <section class="border border-gray-300 rounded-md mb-8">
            <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                Personal Details
            </div>
            <div class="p-6">
                @if($application)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Profile Photo -->
                    @if($application->profile_photo_path)
                    <div class="mb-4">
                        <div class="detail-row">
                            <div class="detail-label">Profile Photo:</div>
                            <div class="detail-value">
                                <img src="{{ asset('storage/' . $application->profile_photo_path) }}" alt="Profile Photo" class="w-32 h-32 object-cover rounded">
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="detail-row">
                        <div class="detail-label">Applicant Name:</div>
                        <div class="detail-value">{{ $application->applicant ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Student Name:</div>
                        <div class="detail-value">{{ $application->student_first_name ?? '' }} {{ $application->middle_name ?? '' }} {{ $application->last_name ?? '' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Request Date:</div>
                        <div class="detail-value">{{ $application->request_date ? $application->request_date->format('Y-m-d') : 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Financial Assistance Type:</div>
                        <div class="detail-value">{{ $application->financial_asst_type ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Financial Assistance For:</div>
                        <div class="detail-value">{{ $application->financial_asst_for ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Aadhar Number:</div>
                        <div class="detail-value">{{ $application->aadhar_number ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Date of Birth:</div>
                        <div class="detail-value">{{ $application->date_of_birth ? $application->date_of_birth->format('Y-m-d') : 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Birth Place:</div>
                        <div class="detail-value">{{ $application->birth_place ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Marital Status:</div>
                        <div class="detail-value">{{ $application->marital_status ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Native Place:</div>
                        <div class="detail-value">{{ $application->native_place ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Age:</div>
                        <div class="detail-value">{{ $application->age ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Nationality:</div>
                        <div class="detail-value">{{ $application->nationality ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Gender:</div>
                        <div class="detail-value">{{ $application->gender ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Religion:</div>
                        <div class="detail-value">{{ $application->religion ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Specially Abled:</div>
                        <div class="detail-value">{{ $application->specially_abled ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Blood Group:</div>
                        <div class="detail-value">{{ $application->blood_group ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Student Email:</div>
                        <div class="detail-value">{{ $application->student_email ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Student Mobile:</div>
                        <div class="detail-value">{{ $application->student_mobile ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">PAN Number:</div>
                        <div class="detail-value">{{ $application->pan_no ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Permanent Address -->
                <div class="section-divider"></div>
                <h3 class="text-lg font-semibold mb-4">Permanent Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="detail-row">
                        <div class="detail-label">Flat No:</div>
                        <div class="detail-value">{{ $application->flat_no ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Floor:</div>
                        <div class="detail-value">{{ $application->floor ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Building Name:</div>
                        <div class="detail-value">{{ $application->name_of_building ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Area:</div>
                        <div class="detail-value">{{ $application->area ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Lane:</div>
                        <div class="detail-value">{{ $application->lane ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Landmark:</div>
                        <div class="detail-value">{{ $application->landmark ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Pincode:</div>
                        <div class="detail-value">{{ $application->pincode ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status:</div>
                        <div class="detail-value">{{ $application->status ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">City:</div>
                        <div class="detail-value">{{ $application->city ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">State:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Pincode:</div>
                        <div class="detail-value">{{ $application->pincode ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Postal Address:</div>
                        <div class="detail-value">{{ $application->postal_address ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Zone:</div>
                        <div class="detail-value">{{ $application->new_zone ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">District:</div>
                        <div class="detail-value">{{ $application->district ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Chapter:</div>
                        <div class="detail-value">{{ $application->chapter ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Correspondence Address -->
                <div class="section-divider"></div>
                <h3 class="text-lg font-semibold mb-4">Correspondence Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="detail-row">
                        <div class="detail-label">Same as Permanent:</div>
                        <div class="detail-value">{{ $application->same_as_permanent ? 'Yes' : 'No' }}</div>
                    </div>
                    @if(!$application->same_as_permanent)
                    <div class="detail-row">
                        <div class="detail-label">Flat No:</div>
                        <div class="detail-value">{{ $application->corr_flat_no ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Floor:</div>
                        <div class="detail-value">{{ $application->corr_floor ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Building Name:</div>
                        <div class="detail-value">{{ $application->corr_name_of_building ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Area:</div>
                        <div class="detail-value">{{ $application->corr_area ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Lane:</div>
                        <div class="detail-value">{{ $application->corr_lane ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Landmark:</div>
                        <div class="detail-value">{{ $application->corr_landmark ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Pincode:</div>
                        <div class="detail-value">{{ $application->corr_pincode ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status:</div>
                        <div class="detail-value">{{ $application->corr_status ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">City:</div>
                        <div class="detail-value">{{ $application->corr_city ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Postal Address:</div>
                        <div class="detail-value">{{ $application->corr_postal_address ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Zone:</div>
                        <div class="detail-value">{{ $application->corr_new_zone ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">District:</div>
                        <div class="detail-value">{{ $application->corr_district ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Chapter:</div>
                        <div class="detail-value">{{ $application->corr_chapter ?? 'N/A' }}</div>
                    </div>
                    @endif
                    <div class="detail-row">
                        <div class="detail-label">Alternate Email:</div>
                        <div class="detail-value">{{ $application->alternate_mail_id ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Alternate Mobile:</div>
                        <div class="detail-value">{{ $application->alternate_mobile ?? 'N/A' }}</div>
                    </div>
                </div>
                @else
                <p class="text-gray-500">No personal details found.</p>
                @endif
            </div>
        </section>

        <!-- Family Details Section -->
        <section class="border border-gray-300 rounded-md mb-8">
            <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                Family Details
            </div>
            <div class="p-6">
                @if($familyDetails)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="detail-row">
                        <div class="detail-label">Family Member Count:</div>
                        <div class="detail-value">{{ $familyDetails->family_member_count ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Family Members:</div>
                        <div class="detail-value">{{ $familyDetails->total_family_members ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Relation with Student:</div>
                        <div class="detail-value">{{ $familyDetails->relation_student ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Family Member Name:</div>
                        <div class="detail-value">{{ $familyDetails->family_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Family Member Age:</div>
                        <div class="detail-value">{{ $familyDetails->family_age ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Marital Status:</div>
                        <div class="detail-value">{{ $familyDetails->marital_status ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Qualification:</div>
                        <div class="detail-value">{{ $familyDetails->qualification ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Occupation:</div>
                        <div class="detail-value">{{ $familyDetails->occupation ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Designation:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Organization Name:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Business Type:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mobile Number:</div>
                        <div class="detail-value">{{ $familyDetails->mobile_number ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email ID:</div>
                        <div class="detail-value">{{ $familyDetails->email_id ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Yearly Gross Income:</div>
                        <div class="detail-value">{{ $familyDetails->yearly_gross_income ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Insurance Coverage:</div>
                        <div class="detail-value">{{ $familyDetails->insurance_coverage ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Premium Paid:</div>
                        <div class="detail-value">{{ $familyDetails->premium_paid ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Students:</div>
                        <div class="detail-value">{{ $familyDetails->total_student ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Family Income:</div>
                        <div class="detail-value">{{ $familyDetails->total_family_income ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Family Member Taken Diksha:</div>
                        <div class="detail-value">{{ $familyDetails->family_member_diksha ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Insurance Coverage:</div>
                        <div class="detail-value">{{ $familyDetails->total_insurance_coverage ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Premium Paid:</div>
                        <div class="detail-value">{{ $familyDetails->total_premium_paid ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Family Contact Details -->
                <div class="section-divider"></div>
                <h3 class="text-lg font-semibold mb-4">Family Contact Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <h4 class="font-medium col-span-2">Parental Uncle</h4>
                    <div class="detail-row">
                        <div class="detail-label">Name:</div>
                        <div class="detail-value">{{ $familyDetails->parental_uncle_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mobile:</div>
                        <div class="detail-value">{{ $familyDetails->parental_uncle_mobile ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">{{ $familyDetails->parental_uncle_email ?? 'N/A' }}</div>
                    </div>

                    <h4 class="font-medium col-span-2 mt-4">Maternal Uncle</h4>
                    <div class="detail-row">
                        <div class="detail-label">Name:</div>
                        <div class="detail-value">{{ $familyDetails->maternal_uncle_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mobile:</div>
                        <div class="detail-value">{{ $familyDetails->maternal_uncle_mobile ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">{{ $familyDetails->maternal_uncle_email ?? 'N/A' }}</div>
                    </div>

                    <h4 class="font-medium col-span-2 mt-4">Parental Aunty</h4>
                    <div class="detail-row">
                        <div class="detail-label">Name:</div>
                        <div class="detail-value">{{ $familyDetails->parental_aunty_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mobile:</div>
                        <div class="detail-value">{{ $familyDetails->parental_aunty_mobile ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">{{ $familyDetails->parental_aunty_email ?? 'N/A' }}</div>
                    </div>

                    <h4 class="font-medium col-span-2 mt-4">Maternal Aunty</h4>
                    <div class="detail-row">
                        <div class="detail-label">Name:</div>
                        <div class="detail-value">{{ $familyDetails->maternal_aunty_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mobile:</div>
                        <div class="detail-value">{{ $familyDetails->maternal_aunty_mobile ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email:</div>
                        <div class="detail-value">{{ $familyDetails->maternal_aunty_email ?? 'N/A' }}</div>
                    </div>
                </div>
                @else
                <p class="text-gray-500">No family details found.</p>
                @endif
            </div>
        </section>

        <!-- Education Details Section -->
        <section class="border border-gray-300 rounded-md mb-8">
            <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                Education Details
            </div>
            <div class="p-6">
                @if($educationDetails)
                <!-- Previous Education Details -->
                <h3 class="text-lg font-semibold mb-4">Previous Education Details</h3>
                @if(isset($educationDetails->previous_education) && is_array($educationDetails->previous_education))
                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">Exam Name</th>
                                <th class="border border-gray-300 px-4 py-2">Course Name</th>
                                <th class="border border-gray-300 px-4 py-2">Exam Month/Year</th>
                                <th class="border border-gray-300 px-4 py-2">Out of Marks</th>
                                <th class="border border-gray-300 px-4 py-2">Marks Obtained</th>
                                <th class="border border-gray-300 px-4 py-2">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($educationDetails->previous_education as $edu)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $edu['exam_name'] ?? 'N/A' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $edu['course_name'] ?? 'N/A' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ ($edu['exam_month'] ?? 'N/A') }} {{ ($edu['exam_year'] ?? '') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $edu['out_of_marks'] ?? 'N/A' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $edu['marks_obtained'] ?? 'N/A' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $edu['percentage'] ?? 'N/A' }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-gray-500 mb-6">No previous education details found.</p>
                @endif

                <!-- Work Experience and Activities -->
                <div class="section-divider"></div>
                <h3 class="text-lg font-semibold mb-4">Work Experience and Activities</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="detail-row">
                        <div class="detail-label">Extracurricular Activities:</div>
                        <div class="detail-value">{{ $educationDetails->extracurricular_activities ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Research Projects:</div>
                        <div class="detail-value">{{ $educationDetails->research_projects ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Work Experience (Years):</div>
                        <div class="detail-value">{{ $educationDetails->work_experience_years ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Company Name:</div>
                        <div class="detail-value">{{ $educationDetails->company_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Remuneration:</div>
                        <div class="detail-value">{{ $educationDetails->remuneration ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">CTC (Yearly):</div>
                        <div class="detail-value">{{ $educationDetails->ctc_yearly ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Work Profile:</div>
                        <div class="detail-value">{{ $educationDetails->work_profile ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Current Education Details -->
                <div class="section-divider"></div>
                <h3 class="text-lg font-semibold mb-4">Current Education Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="detail-row">
                        <div class="detail-label">Course Name:</div>
                        <div class="detail-value">{{ $educationDetails->course_name_current ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Pursuing Education:</div>
                        <div class="detail-value">{{ $educationDetails->pursuing_education ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">University/College Name:</div>
                        <div class="detail-value">{{ $educationDetails->university_college_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Commencement (Month/Year):</div>
                        <div class="detail-value">{{ $educationDetails->commencement_month_year ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Completion (Month/Year):</div>
                        <div class="detail-value">{{ $educationDetails->completion_month_year ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">City:</div>
                        <div class="detail-value">{{ $educationDetails->city ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Country:</div>
                        <div class="detail-value">{{ $educationDetails->country ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">QS Ranking (Foreign):</div>
                        <div class="detail-value">{{ $educationDetails->qs_ranking_foreign ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">NIRF Ranking (Domestic):</div>
                        <div class="detail-value">{{ $educationDetails->nirf_ranking_domestic ?? 'N/A' }}</div>
                    </div>
                </div>
                @else
                <p class="text-gray-500">No education details found.</p>
                @endif
            </div>
        </section>

        <!-- Funding Details Section -->
        <section class="border border-gray-300 rounded-md mb-8">
            <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                Funding Details
            </div>
            <div class="p-6">
                @if($fundingDetails)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="detail-row">
                        <div class="detail-label">Total Cost of Education:</div>
                        <div class="detail-value">{{ $fundingDetails->tuition_fees_amount ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Own Contribution:</div>
                        <div class="detail-value">
                            @php
                                $ownContribution = 0;
                                $fundingArray = $fundingDetails->funding_details_table ?? [];
                                // Ensure it's decoded as an array if it's still JSON string
                                if (is_string($fundingArray)) {
                                    $fundingArray = json_decode($fundingArray, true) ?? [];
                                }
                                foreach($fundingArray as $funding) {
                                    // Check for own family funding
                                    if (isset($funding['particulars']) && stripos($funding['particulars'], 'own family funding') !== false) {
                                        $ownContribution += floatval($funding['amount'] ?? 0);
                                    }
                                }
                                echo $ownContribution > 0 ? number_format($ownContribution, 2) : 'N/A';
                            @endphp
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Scholarship from Institute:</div>
                        <div class="detail-value">
                            @php
                                $scholarshipInstitute = 0;
                                $fundingArray = $fundingDetails->funding_details_table ?? [];
                                // Ensure it's decoded as an array if it's still JSON string
                                if (is_string($fundingArray)) {
                                    $fundingArray = json_decode($fundingArray, true) ?? [];
                                }
                                foreach($fundingArray as $funding) {
                                    // Check for scholarship from institute
                                    if (isset($funding['particulars']) && (stripos($funding['particulars'], 'scholarship') !== false && stripos($funding['particulars'], 'institute') !== false)) {
                                        $scholarshipInstitute += floatval($funding['amount'] ?? 0);
                                    }
                                }
                                echo $scholarshipInstitute > 0 ? number_format($scholarshipInstitute, 2) : 'N/A';
                            @endphp
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Scholarship from Other Source:</div>
                        <div class="detail-value">
                            @php
                                $scholarshipOther = 0;
                                $fundingArray = $fundingDetails->funding_details_table ?? [];
                                // Ensure it's decoded as an array if it's still JSON string
                                if (is_string($fundingArray)) {
                                    $fundingArray = json_decode($fundingArray, true) ?? [];
                                }
                                foreach($fundingArray as $funding) {
                                    // Check for other assistance or local assistance
                                    if (isset($funding['particulars']) && (stripos($funding['particulars'], 'other assistance') !== false || stripos($funding['particulars'], 'local assistance') !== false)) {
                                        $scholarshipOther += floatval($funding['amount'] ?? 0);
                                    }
                                }
                                echo $scholarshipOther > 0 ? number_format($scholarshipOther, 2) : 'N/A';
                            @endphp
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Concession from Institute:</div>
                        <div class="detail-value">
                            @php
                                $concessionInstitute = 0;
                                $fundingArray = $fundingDetails->funding_details_table ?? [];
                                // Ensure it's decoded as an array if it's still JSON string
                                if (is_string($fundingArray)) {
                                    $fundingArray = json_decode($fundingArray, true) ?? [];
                                }
                                foreach($fundingArray as $funding) {
                                    // Check for concession from institute
                                    if (isset($funding['particulars']) && stripos($funding['particulars'], 'concession') !== false) {
                                        $concessionInstitute += floatval($funding['amount'] ?? 0);
                                    }
                                }
                                echo $concessionInstitute > 0 ? number_format($concessionInstitute, 2) : 'N/A';
                            @endphp
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Loan from Bank:</div>
                        <div class="detail-value">
                            @php
                                $loanBank = 0;
                                $fundingArray = $fundingDetails->funding_details_table ?? [];
                                // Ensure it's decoded as an array if it's still JSON string
                                if (is_string($fundingArray)) {
                                    $fundingArray = json_decode($fundingArray, true) ?? [];
                                }
                                foreach($fundingArray as $funding) {
                                    // Check for bank loan
                                    if (isset($funding['particulars']) && stripos($funding['particulars'], 'bank loan') !== false) {
                                        $loanBank += floatval($funding['amount'] ?? 0);
                                    }
                                }
                                echo $loanBank > 0 ? number_format($loanBank, 2) : 'N/A';
                            @endphp
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Loan from Other Source:</div>
                        <div class="detail-value">
                            @php
                                $loanOther = 0;
                                $fundingArray = $fundingDetails->funding_details_table ?? [];
                                // Ensure it's decoded as an array if it's still JSON string
                                if (is_string($fundingArray)) {
                                    $fundingArray = json_decode($fundingArray, true) ?? [];
                                }
                                foreach($fundingArray as $funding) {
                                    // Check for other loans (not bank loan)
                                    if (isset($funding['particulars']) && stripos($funding['particulars'], 'loan') !== false && stripos($funding['particulars'], 'bank') === false) {
                                        $loanOther += floatval($funding['amount'] ?? 0);
                                    }
                                }
                                echo $loanOther > 0 ? number_format($loanOther, 2) : 'N/A';
                            @endphp
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Funding:</div>
                        <div class="detail-value">
                            @php
                                $totalFunding = 0;
                                $fundingArray = $fundingDetails->funding_details_table ?? [];
                                // Ensure it's decoded as an array if it's still JSON string
                                if (is_string($fundingArray)) {
                                    $fundingArray = json_decode($fundingArray, true) ?? [];
                                }
                                foreach($fundingArray as $funding) {
                                    $totalFunding += floatval($funding['amount'] ?? 0);
                                }
                                echo $totalFunding > 0 ? number_format($totalFunding, 2) : 'N/A';
                            @endphp
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Financial Assistance Required:</div>
                        <div class="detail-value">
                            @php
                                $totalFunding = 0;
                                $fundingArray = $fundingDetails->funding_details_table ?? [];
                                // Ensure it's decoded as an array if it's still JSON string
                                if (is_string($fundingArray)) {
                                    $fundingArray = json_decode($fundingArray, true) ?? [];
                                }
                                foreach($fundingArray as $funding) {
                                    $totalFunding += floatval($funding['amount'] ?? 0);
                                }
                                $required = ($fundingDetails->tuition_fees_amount ?? 0) - $totalFunding;
                                echo $required > 0 ? number_format($required, 2) : '0.00';
                            @endphp
                        </div>
                    </div>
                </div>
                @else
                <p class="text-gray-500">No funding details found.</p>
                @endif
            </div>
        </section>

        <!-- Guarantor Details Section -->
        <section class="border border-gray-300 rounded-md mb-8">
            <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                Guarantor Details
            </div>
            <div class="p-6">
                @if($guarantorDetails)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="detail-row">
                        <div class="detail-label">First Guarantor Name:</div>
                        <div class="detail-value">{{ $guarantorDetails->first_guarantor_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Relationship with Student:</div>
                        <div class="detail-value">{{ $guarantorDetails->first_guarantor_relation ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Age:</div>
                        <div class="detail-value">
                            @if($guarantorDetails->first_guarantor_dob)
                                @php
                                    try {
                                        $dob = new DateTime($guarantorDetails->first_guarantor_dob);
                                        $today = new DateTime();
                                        $age = $today->diff($dob)->y;
                                        echo $age > 0 ? $age : 'N/A';
                                    } catch (Exception $e) {
                                        echo 'N/A';
                                    }
                                @endphp
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Marital Status:</div>
                        <div class="detail-value">{{ $guarantorDetails->first_guarantor_marital_status ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Qualification:</div>
                        <div class="detail-value">{{ $familyDetails->qualification ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Occupation:</div>
                        <div class="detail-value">{{ $familyDetails->occupation ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Designation:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Organization Name:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Business Type:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Office Address:</div>
                        <div class="detail-value">{{ $guarantorDetails->first_guarantor_permanent_address ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">City:</div>
                        <div class="detail-value">{{ $application->city ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">State:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Pincode:</div>
                        <div class="detail-value">{{ $application->pincode ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mobile Number:</div>
                        <div class="detail-value">{{ $guarantorDetails->first_guarantor_mobile ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Email ID:</div>
                        <div class="detail-value">{{ $guarantorDetails->first_guarantor_email ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Residence Phone:</div>
                        <div class="detail-value">{{ $guarantorDetails->first_guarantor_phone ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Official Phone:</div>
                        <div class="detail-value">{{ $application->alternate_mobile ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Experience:</div>
                        <div class="detail-value">{{ $educationDetails->work_experience_years ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Annual Income:</div>
                        <div class="detail-value">{{ $guarantorDetails->first_guarantor_income ? number_format($guarantorDetails->first_guarantor_income, 2) : 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Other Income Source:</div>
                        <div class="detail-value">N/A</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Bank Name:</div>
                        <div class="detail-value">{{ $fundingDetails->bank_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Branch Name:</div>
                        <div class="detail-value">{{ $fundingDetails->branch_name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Account Number:</div>
                        <div class="detail-value">{{ $fundingDetails->student_account_number ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">IFSC Code:</div>
                        <div class="detail-value">{{ $fundingDetails->ifsc_code ?? 'N/A' }}</div>
                    </div>
                </div>
                @else
                <p class="text-gray-500">No guarantor details found.</p>
                @endif
            </div>
        </section>

        <!-- Documents Section -->
        <section class="border border-gray-300 rounded-md mb-8">
            <div class="bg-blue-900 text-white text-sm font-bold px-4 py-2 rounded-t-md">
                Documents
            </div>
            <div class="p-6">
                @if(isset($documents) && $documents->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($documents as $document)
                    <div class="border border-gray-200 rounded p-4">
                        <div class="font-semibold mb-2">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</div>
                        <div class="text-sm text-gray-600 mb-2">Uploaded: {{ $document->uploaded_at ? $document->uploaded_at->format('d M Y') : 'N/A' }}</div>
                        @if($document->file_path)
                        <div class="mt-2">
                            @php
                                $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
                            @endphp
                            @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('storage/' . $document->file_path) }}" alt="{{ $document->document_type }}" class="w-full h-32 object-cover rounded">
                            @else
                                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="text-blue-600 hover:underline">View Document</a>
                            @endif
                        </div>
                        @else
                        <div class="text-gray-500">No file uploaded</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500">No documents uploaded.</p>
                @endif
            </div>
        </section>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-4 mt-8">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-600 transition-colors" onclick="window.location.href='{{ route('documents', ['submission_id' => $submissionId ?? '']) }}'">
                Back to Documents
            </button>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 transition-colors" onclick="window.location.href='{{ route('final-submission.index', ['submission_id' => $submissionId ?? '']) }}'">
                Done Preview
            </button>
        </div>
    </main>
</body>
</html>