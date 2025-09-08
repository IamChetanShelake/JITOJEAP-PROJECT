<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JITO JEAP Education Assistance Program Application</title>
    <style>
        /* Advanced PDF Styling */
        @page {
            margin: 20mm;
            font-family: 'Helvetica', 'Arial', sans-serif;
            size: A4;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .pdf-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
        }
        
        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 2px solid #393185;
            margin-bottom: 20px;
        }
        
        .logo-container {
            width: 120px;
        }
        
        .logo-container img {
            width: 100%;
            height: auto;
            max-height: 50px;
            object-fit: contain;
        }
        
        .header-content {
            text-align: center;
            flex-grow: 1;
            padding: 0 20px;
        }
        
        .header-content h1 {
            color: #393185;
            font-size: 18pt;
            margin: 0 0 5px 0;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        
        .header-content .subtitle {
            color: #556EE6;
            font-size: 12pt;
            margin: 0;
            font-weight: normal;
        }
        
        .photo-container {
            width: 100px;
            text-align: right;
        }
        
        .profile-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid #ddd;
            object-fit: cover;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        /* Document Info */
        .document-info {
            text-align: right;
            font-size: 10pt;
            margin-bottom: 20px;
            color: #666;
        }
        
        /* Section Styles */
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-header {
            background-color: #393185;
            color: white;
            padding: 10px 15px;
            font-size: 12pt;
            font-weight: bold;
            border-radius: 4px 4px 0 0;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .section-content {
            padding: 0 10px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: bold;
            width: 220px;
            min-width: 220px;
            color: #393185;
        }
        
        .detail-value {
            flex: 1;
            color: #444;
        }
        
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0 20px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        th {
            background-color: #556EE6;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 10pt;
        }
        
        td {
            padding: 8px 10px;
            vertical-align: top;
            border: 1px solid #ddd;
            font-size: 10pt;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #f0f0f0;
        }
        
        /* Signature Section */
        .signature-section {
            margin-top: 40px;
            page-break-inside: avoid;
        }
        
        .signature-box-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .signature-box {
            width: 45%;
            text-align: center;
        }
        
        .signature-area {
            height: 100px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
        }
        
        .signature-area img {
            max-width: 100%;
            max-height: 90px;
        }
        
        .signature-label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #393185;
        }
        
        .signature-date {
            font-size: 9pt;
            color: #666;
            margin-top: 5px;
        }
        
        /* Footer */
        .footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9pt;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        
        .page-number:before {
            content: "Page " counter(page);
        }
        
        /* Page Break */
        .page-break {
            page-break-before: always;
        }
        
        /* Responsive Utilities */
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .mt-20 {
            margin-top: 20px;
        }
        
        .mb-10 {
            margin-bottom: 10px;
        }
        
        /* Print-specific styles */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="pdf-container">
        <!-- Header with Logo, Title, and Profile Photo -->
        <div class="header">
            <div class="logo-container">
                <img src="{{ public_path('assets/images/logo.png') }}" alt="JITO JEAP Logo">
            </div>
            <div class="header-content">
                <h1>JITO JEAP EDUCATION ASSISTANCE PROGRAM</h1>
                <p class="subtitle">Application Form for Financial Assistance</p>
            </div>
            <div class="photo-container">
                @if($application->profile_photo_path)
                    <img src="{{ storage_path('app/public/' . $application->profile_photo_path) }}" alt="Applicant Photo" class="profile-photo">
                @else
                    <div style="width: 80px; height: 80px; border: 2px dashed #ccc; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #999; font-size: 8pt;">
                        No Photo
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Document Info -->
        <div class="document-info">
            <p><strong>Application ID:</strong> {{ $application->submission_id ?? 'N/A' }}</p>
            <p><strong>Print Date:</strong> {{ now()->format('d M Y') }}</p>
        </div>

        <!-- Personal Details -->
        <div class="section">
            <div class="section-header">Personal Details</div>
            <div class="section-content">
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
                    <div class="detail-value">{{ $application->request_date ? $application->request_date->format('d M Y') : 'N/A' }}</div>
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
                    <div class="detail-value">{{ $application->date_of_birth ? $application->date_of_birth->format('d M Y') : 'N/A' }}</div>
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
        </div>

        <!-- Permanent Address -->
        <div class="section">
            <div class="section-header">Permanent Address</div>
            <div class="section-content">
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
                    <div class="detail-label">District:</div>
                    <div class="detail-value">{{ $application->district ?? 'N/A' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Chapter:</div>
                    <div class="detail-value">{{ $application->chapter ?? 'N/A' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Postal Address:</div>
                    <div class="detail-value">{{ $application->postal_address ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Correspondence Address -->
        <div class="section">
            <div class="section-header">Correspondence Address</div>
            <div class="section-content">
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
                    <div class="detail-label">District:</div>
                    <div class="detail-value">{{ $application->corr_district ?? 'N/A' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Chapter:</div>
                    <div class="detail-value">{{ $application->corr_chapter ?? 'N/A' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Postal Address:</div>
                    <div class="detail-value">{{ $application->corr_postal_address ?? 'N/A' }}</div>
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
        </div>

        <!-- Family Details -->
        <div class="section">
            <div class="section-header">Family Details</div>
            <div class="section-content">
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
        </div>

        <!-- Education Details -->
        <div class="section">
            <div class="section-header">Education Details</div>
            <div class="section-content">
                @if(isset($educationDetails->previous_education) && is_array($educationDetails->previous_education))
                <table>
                    <thead>
                        <tr>
                            <th>Exam Name</th>
                            <th>Course Name</th>
                            <th>Exam Month/Year</th>
                            <th>Out of Marks</th>
                            <th>Marks Obtained</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($educationDetails->previous_education as $edu)
                        <tr>
                            <td>{{ $edu['exam_name'] ?? 'N/A' }}</td>
                            <td>{{ $edu['course_name'] ?? 'N/A' }}</td>
                            <td>{{ ($edu['exam_month'] ?? 'N/A') }} {{ ($edu['exam_year'] ?? '') }}</td>
                            <td>{{ $edu['out_of_marks'] ?? 'N/A' }}</td>
                            <td>{{ $edu['marks_obtained'] ?? 'N/A' }}</td>
                            <td>{{ $edu['percentage'] ?? 'N/A' }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>No previous education details found.</p>
                @endif

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
        </div>

        <!-- Funding Details -->
        <div class="section">
            <div class="section-header">Funding Details</div>
            <div class="section-content">
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
        </div>

        <!-- Guarantor Details -->
        <div class="section">
            <div class="section-header">Guarantor Details</div>
            <div class="section-content">
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
                    <div class="detail-label">Office Address:</div>
                    <div class="detail-value">{{ $guarantorDetails->first_guarantor_permanent_address ?? 'N/A' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">City:</div>
                    <div class="detail-value">{{ $application->city ?? 'N/A' }}</div>
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
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="section-header">Signature</div>
            <div class="section-content">
                <div class="detail-row">
                    <div class="detail-label">Signature Method:</div>
                    <div class="detail-value">{{ ucfirst($application->signature_type ?? 'N/A') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Signature Date:</div>
                    <div class="detail-value">{{ $application->signature_date ? $application->signature_date->format('d M Y, H:i:s') : 'N/A' }}</div>
                </div>
                
                <div class="signature-box-container">
                    <div class="signature-box">
                        <div class="signature-label">Applicant Signature</div>
                        <div class="signature-area">
                            @if($application->signature_type === 'upload' && $application->signature_image_path)
                                <img src="{{ storage_path('app/public/' . $application->signature_image_path) }}" alt="Signature">
                            @elseif($application->signature_type === 'draw' && $application->signature_drawn_data)
                                <img src="{{ $application->signature_drawn_data }}" alt="Signature">
                            @elseif($application->signature_type === 'type' && $application->signature_typed_name)
                                <div>{{ $application->signature_typed_name }}</div>
                            @else
                                <div style="color: #999;">No signature provided</div>
                            @endif
                        </div>
                        <div class="signature-date">Signed on: {{ $application->signature_date ? $application->signature_date->format('d M Y') : 'N/A' }}</div>
                    </div>
                    
                    <div class="signature-box">
                        <div class="signature-label">Authorized Signatory</div>
                        <div class="signature-area">
                            <div style="color: #999;">For official use</div>
                        </div>
                        <div class="signature-date">Date: ________________</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="page-number"></div>
            <div>JITO JEAP Education Assistance Program | Generated on {{ now()->format('d M Y') }}</div>
        </div>
    </div>
</body>
</html>