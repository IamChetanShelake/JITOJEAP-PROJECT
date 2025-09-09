<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JITO JEAP - Financial Assistance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .brand-logo {
            width: 144px;
            height: 73px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .icon-btn {
            width: 32px;
            height: 32px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }

        .icon-btn:hover {
            background-color: rgba(85, 110, 230, 0.1);
        }

        .icon-image {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }

        .notification-dot {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 10px;
            height: 10px;
            background-color: #556EE6;
            border-radius: 50%;
        }

        .create-btn {
            background-color: #393185;
            color: white;
            padding: 11px 57px;
            border-radius: 5px;
            border: none;
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 700;
            font-size: 20px;
            line-height: 1.424;
            letter-spacing: 3%;
            cursor: pointer;
        }

        .search-container {
            background-color: #FFFFFF;
            border: 1px solid rgba(196, 196, 196, 0.33);
            border-radius: 10px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            width: 344px;
            height: 50px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            position: relative;
        }

        .search-input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 400;
            font-size: 13px;
            color: #000000;
            padding-right: 30px;
        }

        .search-input::placeholder {
            color: #4E4E4E;
        }

        .search-icon {
            position: absolute;
            right: 20px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .search-icon:hover {
            transform: scale(1.1);
        }

        .main-title {
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 700;
            font-size: 24px;
            line-height: 1.424;
            letter-spacing: 3%;
            color: #222222;
        }

        .subtitle {
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.424;
            letter-spacing: 3%;
            color: #222222;
        }

        .breadcrumb {
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 700;
            font-size: 20px;
            line-height: 1.424;
            letter-spacing: 3%;
            color: #000000;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .breadcrumb:hover {
            color: #556EE6;
        }

        .breadcrumb.active {
            color: #0A2478;
        }

        .breadcrumb-normal {
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 400;
            font-size: 20px;
            line-height: 1.424;
            letter-spacing: 3%;
            color: #000000;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .breadcrumb-normal:hover {
            color: #556EE6;
        }

        .breadcrumb-normal.active {
            color: #0A2478;
        }

        .search-text {
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 400;
            font-size: 13px;
            line-height: 1.424;
            letter-spacing: 3%;
            color: #4E4E4E;
            margin-left: 10px;
        }

        .accent-line {
            width: 125px;
            height: 3px;
            background-color: #0A2478;
            margin: 3px 0;
        }

        /* Table Styles */
        .applications-table {
            width: calc(100% - 282px);
            margin: 0 141px;
            margin-top: 200px;
            background-color: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .table-header {
            background-color: #393185;
            color: #FFFFFF;
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 700;
            font-size: 14px;
            line-height: 1.424;
            letter-spacing: 3%;
        }

        .table-header th {
            padding: 15px 12px;
            text-align: left;
            border-right: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-header th:last-child {
            border-right: none;
        }

        .table-body {
            background-color: #FFFFFF;
        }

        .table-row {
            border-bottom: 1px solid rgba(196, 196, 196, 0.33);
            transition: background-color 0.2s ease;
        }

        .table-row:hover {
            background-color: rgba(85, 110, 230, 0.05);
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-cell {
            padding: 12px;
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 400;
            font-size: 13px;
            line-height: 1.424;
            letter-spacing: 3%;
            color: #000000;
            border-right: 1px solid rgba(196, 196, 196, 0.2);
        }

        .table-cell:last-child {
            border-right: none;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
            display: inline-block;
            min-width: 70px;
        }

        .status-pending {
            background-color: #FFF7D3;
            color: #FBBA00;
        }

        .status-approved {
            background-color: #E8F5E8;
            color: #009846;
        }

        .status-rejected {
            background-color: #FFE6E6;
            color: #DC2626;
        }

        .status-draft {
            background-color: #F0F0F0;
            color: #4E4E4E;
        }

        .status-submitted {
            background-color: #E3F2FD;
            color: #1976D2;
        }

        .table-title {
            font-family: 'Source Sans 3', sans-serif;
            font-weight: 700;
            font-size: 20px;
            line-height: 1.424;
            letter-spacing: 3%;
            color: #222222;
            margin-bottom: 20px;
            margin-left: 141px;
            margin-top: 180px;
        }

        /* Action Buttons Styles */
        .actions-cell {
            min-width: 160px !important;
            padding: 8px 4px !important;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            justify-content: center;
            align-items: center;
        }

        .action-btn {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 3px;
            white-space: nowrap;
        }

        .action-btn i {
            font-size: 10px;
        }

        .continue-btn {
            background-color: #556EE6;
            color: white;
        }

        .continue-btn:hover {
            background-color: #4c63d2;
            transform: translateY(-1px);
        }

        .edit-btn {
            background-color: #009846;
            color: white;
        }

        .edit-btn:hover {
            background-color: #008139;
            transform: translateY(-1px);
        }

        .print-btn {
            background-color: #FBBA00;
            color: black;
        }

        .print-btn:hover {
            background-color: #e6a800;
            transform: translateY(-1px);
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        /* Comprehensive Responsive Design - Mobile First Approach */

        /* Base Mobile Styles (320px to 480px) */
        @media (max-width: 480px) {
            body {
                overflow-x: hidden;
            }

            /* Header Mobile */
            header {
                height: auto !important;
                min-height: 200px;
                padding: 15px 0;
            }

            .brand-logo {
                position: static !important;
                text-align: center;
                margin: 10px auto 15px;
                width: 100px !important;
                height: 50px !important;
                left: auto !important;
                top: auto !important;
            }

            /* Navigation Menu Mobile */
            header .container>div:nth-child(2) {
                position: static !important;
                text-align: center;
                margin: 15px 0;
                left: auto !important;
                top: auto !important;
            }

            header .container>div:nth-child(2)>div {
                justify-content: center;
                flex-direction: column;
                gap: 15px;
            }

            .breadcrumb,
            .breadcrumb-normal {
                font-size: 14px !important;
                padding: 8px 16px;
                display: inline-block;
            }

            .accent-line {
                width: 60px !important;
                left: 50% !important;
                transform: translateX(-50%);
                top: 35px !important;
            }

            /* Navigation Icons Mobile */
            header .container>div:nth-child(3) {
                position: static !important;
                text-align: center;
                margin: 15px 0;
                right: auto !important;
                top: auto !important;
            }

            header .container>div:nth-child(3)>div {
                justify-content: center;
                gap: 12px;
            }

            .icon-btn {
                width: 28px !important;
                height: 28px !important;
            }

            .icon-image {
                width: 18px !important;
                height: 18px !important;
            }

            /* Search Bar Mobile */
            .search-container {
                position: static !important;
                width: calc(100% - 40px) !important;
                margin: 15px 20px !important;
                right: auto !important;
                top: auto !important;
                transform: none !important;
            }

            /* Main Content Mobile */
            main {
                margin-top: 20px;
            }

            main .container>div {
                position: static !important;
                text-align: center;
                padding: 0 20px;
                left: auto !important;
                top: auto !important;
            }

            .main-title {
                font-size: 18px !important;
                margin-bottom: 10px;
            }

            .absolute {
                position: static !important;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }

        .subtitle {
            font-size: 14px !important;
            margin-bottom: 20px;
        }

        .create-btn {
            width: 100%;
            max-width: 250px;
            padding: 12px 20px;
            font-size: 16px !important;
        }

        /* Table Mobile */
        .applications-table {
            width: calc(100% - 20px) !important;
            margin: 30px 10px 50px !important;
            font-size: 12px;
            overflow-x: auto;
        }

        .table-cell {
            padding: 6px 4px !important;
            font-size: 10px !important;
            min-width: 80px;
        }

        .table-header th {
            padding: 8px 4px !important;
            font-size: 11px !important;
            min-width: 80px;
        }

        /* Action Buttons Mobile */
        .action-buttons {
            flex-direction: column;
            gap: 2px;
        }

        .action-btn {
            width: 100%;
            padding: 3px 6px;
            font-size: 9px;
            justify-content: center;
        }

        .actions-cell {
            min-width: 80px !important;
            padding: 4px 2px !important;
        }
        }

        /* Mobile Large (481px to 767px) */
        @media (min-width: 481px) and (max-width: 767px) {
            header {
                height: auto !important;
                min-height: 180px;
                padding: 20px 0;
            }

            .brand-logo {
                position: static !important;
                text-align: center;
                margin: 15px auto;
                width: 120px !important;
                height: 60px !important;
            }

            /* Navigation Menu Mobile Large */
            header .container>div:nth-child(2) {
                position: static !important;
                text-align: center;
                margin: 20px 0;
            }

            header .container>div:nth-child(2)>div {
                justify-content: center;
                gap: 30px;
            }

            .breadcrumb,
            .breadcrumb-normal {
                font-size: 16px !important;
            }

            .accent-line {
                width: 80px !important;
                left: 50% !important;
                transform: translateX(-50%);
            }

            /* Navigation Icons Mobile Large */
            header .container>div:nth-child(3) {
                position: static !important;
                text-align: center;
                margin: 15px 0;
            }

            /* Search Bar Mobile Large */
            .search-container {
                position: static !important;
                width: 80% !important;
                max-width: 320px;
                margin: 20px auto !important;
                right: auto !important;
                top: auto !important;
            }

            /* Main Content Mobile Large */
            main .container>div {
                position: static !important;
                text-align: center;
                padding: 0 30px;
                margin: 30px 0;
            }

            .main-title {
                font-size: 20px !important;
            }

            .subtitle {
                font-size: 15px !important;
            }

            /* Table Mobile Large */
            .applications-table {
                width: calc(100% - 40px) !important;
                margin: 40px 20px !important;
                margin-top: 50px !important;
            }
        }

        /* Tablet Portrait (768px to 1024px) */
        @media (min-width: 768px) and (max-width: 1024px) {
            header {
                height: 140px !important;
            }

            .brand-logo {
                left: 60px !important;
                top: 50px !important;
                width: 130px !important;
                height: 65px !important;
            }

            /* Navigation Menu Tablet */
            header .container>div:nth-child(2) {
                left: 250px !important;
                top: 75px !important;
            }

            header .container>div:nth-child(2)>div {
                gap: 25px;
            }

            .breadcrumb,
            .breadcrumb-normal {
                font-size: 16px !important;
            }

            .accent-line {
                width: 100px !important;
                top: 25px !important;
            }

            /* Navigation Icons Tablet */
            header .container>div:nth-child(3) {
                right: 60px !important;
                top: 50px !important;
            }

            /* Search Bar Tablet */
            .search-container {
                right: 60px !important;
                top: 90px !important;
                width: 280px !important;
            }

            /* Main Content Tablet */
            main .container>div {
                left: 60px !important;
                top: 60px !important;
            }

            .main-title {
                font-size: 22px !important;
            }

            .create-btn {
                padding: 12px 40px;
                font-size: 18px !important;
            }

            /* Table Tablet */
            .applications-table {
                width: calc(100% - 120px) !important;
                margin: 0 60px !important;
                margin-top: 160px !important;
            }
        }

        /* Desktop Small (1025px to 1199px) */
        @media (min-width: 1025px) and (max-width: 1199px) {
            .brand-logo {
                left: 80px !important;
                top: 58px !important;
            }

            header .container>div:nth-child(2) {
                left: 280px !important;
                top: 78px !important;
            }

            header .container>div:nth-child(3) {
                right: 80px !important;
                top: 80px !important;
            }

            .search-container {
                right: 80px !important;
                top: 70px !important;
                width: 320px !important;
            }

            main .container>div {
                left: 100px !important;
                top: 80px !important;
            }

            .applications-table {
                width: calc(100% - 200px) !important;
                margin: 0 100px !important;
                margin-top: 185px !important;
            }
        }

        /* Desktop Medium (1200px to 1439px) */
        @media (min-width: 1200px) and (max-width: 1439px) {
            .brand-logo {
                left: 90px !important;
            }

            header .container>div:nth-child(2) {
                left: 300px !important;
            }

            header .container>div:nth-child(3) {
                right: 90px !important;
            }

            .search-container {
                right: 90px !important;
                width: 330px !important;
            }

            main .container>div {
                left: 120px !important;
            }

            .applications-table {
                width: calc(100% - 240px) !important;
                margin: 0 120px !important;
                margin-top: 190px !important;
            }
        }

        /* Desktop Large (1440px and above) */
        @media (min-width: 1440px) {
            .container {
                max-width: 1440px;
                margin: 0 auto;
            }

            .applications-table {
                width: calc(100% - 282px) !important;
                margin: 0 141px !important;
                margin-top: 200px !important;
            }
        }

        /* Landscape Orientation for Mobile/Tablet */
        @media (orientation: landscape) and (max-height: 600px) {
            header {
                height: 100px !important;
                min-height: 100px;
            }

            .brand-logo {
                top: 30px !important;
            }

            header .container>div:nth-child(2) {
                top: 55px !important;
            }

            header .container>div:nth-child(3) {
                top: 30px !important;
            }

            .search-container {
                top: 30px !important;
            }

            main .container>div {
                top: 30px !important;
            }
        }

        /* Ultra-wide screens (1920px and above) */
        @media (min-width: 1920px) {
            .container {
                max-width: 1600px;
            }
        }

        /* High DPI Display Adjustments */
        @media (-webkit-min-device-pixel-ratio: 2),
        (min-resolution: 192dpi) {
            .icon-image {
                image-rendering: -webkit-optimize-contrast;
                image-rendering: crisp-edges;
            }
        }

        /* Print Styles */
        @media print {
            header {
                display: none;
            }

            .search-container {
                display: none;
            }

            .applications-table {
                width: 100% !important;
                margin: 0 !important;
                box-shadow: none !important;
            }
        }
        
    </style>
</head>

<body class="bg-white min-h-screen">
    <!-- Header Section -->
    <header class="w-full bg-white" style="height: 153px;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-0 relative">
            <!-- Logo/Brand -->
            <div class="brand-logo absolute" style="left: 100px; top: 64px;">
                <img src="{{ asset('assets/images/logo.png') }}" alt="JITO JEAP Logo" class="logo-image">
            </div>

            <!-- Navigation Menu (Center) -->
            <div class="absolute" style="left: 328px; top: 82px;">
                <div class="flex space-x-4 items-center">
                    <span class="breadcrumb active" id="ef-assistance" onclick="switchTab('ef-assistance')"
                        style="cursor: pointer;">EF Assistance</span>
                    <span class="breadcrumb-normal" id="financial-assistance"
                        onclick="switchTab('financial-assistance')" style="cursor: pointer;">Financial Assistance</span>
                </div>
                <!-- Accent Line (properly aligned under active tab in navbar) -->
                <div class="accent-line absolute" id="accent-line" style="left: 0px; top: 27px;"></div>
            </div>

            <!-- Navigation Icons (Right Side) -->
            <div class="absolute" style="right: 100px; top: 85px;">
                <div class="flex space-x-4">
                    <!-- Message Icon -->
                    <div class="icon-btn">
                        <img src="{{ asset('assets/images/message.png') }}" alt="Messages" class="icon-image">
                        <div class="notification-dot"></div>
                    </div>

                    <!-- Notification Icon -->
                    <div class="icon-btn">
                        <img src="{{ asset('assets/images/notification.png') }}" alt="Notifications" class="icon-image">
                        <div class="notification-dot"></div>
                    </div>

                    <!-- Profile Icon -->
                    <div class="icon-btn">
                        <img src="{{ asset('assets/images/profile.png') }}" alt="Profile" class="icon-image">
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="search-container absolute" style="right: -849px; top: 76px;">
                <input type="text" class="search-input" id="search-input" placeholder="Search Applicant"
                    onkeyup="performSearch()">
                <svg class="search-icon" onclick="performSearch()" width="16" height="16" viewBox="0 0 16 16"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7 1C10.866 1 14 4.134 14 8C14 9.76667 13.3467 11.3917 12.2533 12.6267L14.8133 15.1867C15.0933 15.4667 15.0933 15.9267 14.8133 16.2067C14.5333 16.4867 14.0733 16.4867 13.7933 16.2067L11.2333 13.6467C9.99833 14.74 8.373 15.3933 6.60667 15.3933C2.74 15.3933 -0.393333 12.2593 -0.393333 8.393C-0.393333 4.527 2.74 1.393 6.60667 1.393L7 1Z"
                        fill="black" />
                </svg>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-0">
        <!-- Main Title Section -->
        <div class="absolute" style="left: 200px; top: 190px;">
            <h1 class="main-title">Financial Assistance</h1>
            <p class="subtitle mt-2">Apply for Educational Support</p>

            <!-- Create Form Button -->
            <button class="create-btn mt-5" onclick="startNewForm()">
                Create Form
            </button>
        </div>

        <!-- Applications Table -->
        <div class="applications-table">
            <table style="width: 100%; border-collapse: collapse;">
                <thead class="table-header">
                    <tr>
                        <th>Student Name</th>
                        <th>Applicant</th>
                        <th>Aadhar Number</th>
                        <th>Financial Assistance Type</th>
                        <th>Financial Assistance For</th>
                        <th>Form Status</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @if (isset($applications) && $applications->count() > 0)
                        @foreach ($applications as $application)
                            <tr class="table-row">
                                <td class="table-cell">{{ $application->fullName ?? 'N/A' }}</td>
                                <td class="table-cell">{{ $application->applicant ?? 'N/A' }}</td>
                                <td class="table-cell">{{ $application->aadhar_number ?? 'N/A' }}</td>
                                <td class="table-cell">{{ $application->financial_asst_type ?? 'N/A' }}</td>
                                <td class="table-cell">{{ $application->financial_asst_for ?? 'N/A' }}</td>
                                <td class="table-cell">
                                    <span
                                        class="status-badge
                                    @if ($application->form_status == 'draft') status-draft
                                    @elseif($application->form_status == 'submitted') status-submitted
                                    @elseif($application->form_status == 'approved') status-approved
                                    @elseif($application->form_status == 'rejected') status-rejected
                                    @else status-pending @endif">
                                        {{ ucfirst($application->form_status ?? 'pending') }}
                                    </span>
                                </td>
                                <td class="table-cell">
                                    {{ $application->created_at ? $application->created_at->format('d M Y') : 'N/A' }}
                                </td>
                                <td class="table-cell actions-cell">
                                    <div class="action-buttons">
                                        @if ($application->form_status == 'draft' || $application->current_step < 7)
                                            <!-- Continue Button for incomplete forms -->
                                            <button class="action-btn continue-btn"
                                                onclick="continueForm('{{ $application->submission_id }}', {{ $application->current_step ?? 1 }})"
                                                title="Continue Form">
                                                <i class="fas fa-play"></i> Continue
                                            </button>
                                        @endif

                                        @if ($application->form_status == 'submitted' || $application->current_step >= 7)
                                            <!-- View/Edit Button for completed forms -->
                                            <button class="action-btn edit-btn"
                                                onclick="editForm('{{ $application->submission_id }}')"
                                                title="View/Edit Form">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Print Button for completed forms -->
                                            <button class="action-btn print-btn"
                                                onclick="printForm('{{ $application->submission_id }}')"
                                                title="Print Form">
                                                <i class="fas fa-print"></i> Print
                                            </button>
                                        @endif

                                        <!-- Delete Button (always available) -->
                                        <button class="action-btn delete-btn"
                                            onclick="deleteForm('{{ $application->submission_id }}', '{{ $application->fullName }}')"
                                            title="Delete Form">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="table-row">
                            <td class="table-cell text-center" colspan="8">No applications found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </main>

    <script>
        // Form action functions
        function continueForm(submissionId, currentStep) {
            console.log('Continuing form:', submissionId, 'at step:', currentStep);

            // Clear any existing session data first
            localStorage.removeItem('jito_submission_id');
            localStorage.removeItem('jito_current_step');
            localStorage.removeItem('jito_last_saved');

            // Set the new session data
            localStorage.setItem('jito_submission_id', submissionId);
            localStorage.setItem('jito_current_step', currentStep);

            // Navigate to appropriate step
            const stepRoutes = {
                1: '/financial-assistance',
                2: '/family-details',
                3: '/education-details',
                4: '/funding-details',
                5: '/guarantor-details',
                6: '/documents',
                7: '/final-submission'
            };

            const route = stepRoutes[currentStep] || '/financial-assistance';
            const url = `${route}?submission_id=${submissionId}`;

            console.log('Redirecting to:', url);
            window.location.href = url;
        }

        function editForm(submissionId) {
            console.log('Editing completed form:', submissionId);

            // Set session data for editing
            localStorage.setItem('jito_submission_id', submissionId);
            localStorage.setItem('jito_current_step', '1');

            // Always start editing from the first step
            window.location.href = `/financial-assistance?submission_id=${submissionId}`;
        }

        function printForm(submissionId) {
            console.log('Printing form:', submissionId);

            // Open print view in new tab/window
            const printUrl = `/financial-assistance/${submissionId}/print`;
            window.open(printUrl, '_blank');
        }

        function deleteForm(submissionId, studentName) {
            console.log('Deleting form:', submissionId);

            // Confirm deletion
            const confirmMessage =
                `Are you sure you want to delete the application for "${studentName}"?\n\nThis action cannot be undone.`;

            if (confirm(confirmMessage)) {
                // Show loading state
                const deleteButtons = document.querySelectorAll(`[onclick*="${submissionId}"]`);
                deleteButtons.forEach(btn => {
                    if (btn.classList.contains('delete-btn')) {
                        btn.disabled = true;
                        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                    }
                });

                // Make delete request
                console.log('Making DELETE request to:', `/delete-application/${submissionId}`);
                fetch(`/delete-application/${submissionId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        console.log('Response headers:', response.headers);

                        // Check if response is JSON
                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            return response.text().then(text => {
                                console.log('Non-JSON response:', text);
                                throw new Error('Server returned non-JSON response: ' + text.substring(0, 200));
                            });
                        }

                        if (!response.ok) {
                            return response.json().then(data => {
                                console.log('Error response data:', data);
                                throw new Error(data.message || `HTTP error! status: ${response.status}`);
                            }).catch(() => {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            });
                        }

                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            alert('Application deleted successfully!');
                            // Reload page to refresh the list
                            window.location.reload();
                        } else {
                            alert('Error deleting application: ' + (data.message || 'Unknown error'));
                            // Restore button state
                            deleteButtons.forEach(btn => {
                                if (btn.classList.contains('delete-btn')) {
                                    btn.disabled = false;
                                    btn.innerHTML = '<i class="fas fa-trash"></i> Delete';
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Delete error details:', {
                            name: error.name,
                            message: error.message,
                            stack: error.stack
                        });

                        let errorMessage = 'Error deleting application. ';
                        if (error.message.includes('Non-JSON')) {
                            errorMessage += 'Server returned invalid response. ';
                        } else if (error.message.includes('HTTP error')) {
                            errorMessage += 'Server error occurred. ';
                        } else if (error.name === 'TypeError') {
                            errorMessage += 'Network connection error. ';
                        } else {
                            errorMessage += error.message + ' ';
                        }
                        errorMessage += 'Please try again.';

                        alert(errorMessage);

                        // Restore button state
                        deleteButtons.forEach(btn => {
                            if (btn.classList.contains('delete-btn')) {
                                btn.disabled = false;
                                btn.innerHTML = '<i class="fas fa-trash"></i> Delete';
                            }
                        });
                    });
            }
        }

        // Tab switching functionality with responsive considerations
        function switchTab(tabName) {
            const efAssistance = document.getElementById('ef-assistance');
            const financialAssistance = document.getElementById('financial-assistance');
            const accentLine = document.getElementById('accent-line');
            const mainTitle = document.querySelector('.main-title');
            const subtitle = document.querySelector('.subtitle');
            const createBtn = document.querySelector('.create-btn');

            // Reset all tabs
            efAssistance.className = 'breadcrumb';
            financialAssistance.className = 'breadcrumb-normal';

            // Get viewport width for responsive accent line positioning
            const viewportWidth = window.innerWidth;

            if (tabName === 'ef-assistance') {
                // Activate EF Assistance
                efAssistance.className = 'breadcrumb active';

                // Responsive accent line positioning
                if (viewportWidth <= 480) {
                    accentLine.style.left = '50%';
                    accentLine.style.transform = 'translateX(-50%)';
                } else if (viewportWidth <= 767) {
                    accentLine.style.left = '50%';
                    accentLine.style.transform = 'translateX(-50%)';
                } else {
                    accentLine.style.left = '0px';
                    accentLine.style.transform = 'none';
                }

                // Show Financial Assistance content in EF section
                mainTitle.style.display = 'block';
                subtitle.style.display = 'block';
                createBtn.style.display = 'block';

                // Update content for EF section
                mainTitle.textContent = 'Financial Assistance';
                subtitle.textContent = 'Apply for Educational Support';

            } else if (tabName === 'financial-assistance') {
                // Activate Financial Assistance
                financialAssistance.className = 'breadcrumb-normal active';

                // Responsive accent line positioning
                if (viewportWidth <= 480) {
                    accentLine.style.left = '50%';
                    accentLine.style.transform = 'translateX(-50%)';
                } else if (viewportWidth <= 767) {
                    accentLine.style.left = '50%';
                    accentLine.style.transform = 'translateX(-50%)';
                } else {
                    accentLine.style.left = '180px';
                    accentLine.style.transform = 'none';
                }

                // Show Financial Assistance content
                mainTitle.style.display = 'block';
                subtitle.style.display = 'block';
                createBtn.style.display = 'block';

                // Update content for Financial Assistance section
                mainTitle.textContent = 'Financial Assistance';
                subtitle.textContent = 'Apply for Educational Support';
            }
        }

        // Search functionality
        function performSearch() {
            const searchTerm = document.getElementById('search-input').value;

            if (searchTerm.length > 2) {
                console.log('Searching for:', searchTerm);

                // Make AJAX request to search endpoint
                fetch(`{{ route('main.search') }}?search=${encodeURIComponent(searchTerm)}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Search results:', data);
                        // Handle search results here
                        // You can display results in a dropdown or modal
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                    });
            }
        }

        // Function to start a completely new form
        function startNewForm() {
            console.log('Starting new form - clearing any existing session data');

            // Clear localStorage
            localStorage.removeItem('jito_submission_id');
            localStorage.removeItem('jito_current_step');
            localStorage.removeItem('jito_last_saved');

            // Clear server session and redirect to new form
            fetch('/api/clear-session', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Session cleared, redirecting to new form');
                    // Redirect to financial assistance with new form parameter
                    window.location.href = '{{ route('financial-assistance') }}?new=1';
                })
                .catch(error => {
                    console.error('Error clearing session:', error);
                    // Still redirect even if clearing failed
                    console.log('Proceeding with redirect despite session clear error');
                    window.location.href = '{{ route('financial-assistance') }}?new=1';
                });
        }

        // Initialize default state (Financial Assistance active)
        document.addEventListener('DOMContentLoaded', function() {
            switchTab('financial-assistance');

            // Add resize event listener for responsive adjustments
            window.addEventListener('resize', function() {
                // Re-trigger tab switching to adjust positioning on resize
                const activeTab = document.querySelector('.breadcrumb.active') ? 'ef-assistance' :
                    'financial-assistance';
                switchTab(activeTab);
            });

            // Add touch event handling for mobile
            if ('ontouchstart' in window) {
                document.getElementById('ef-assistance').addEventListener('touchstart', function() {
                    switchTab('ef-assistance');
                });

                document.getElementById('financial-assistance').addEventListener('touchstart', function() {
                    switchTab('financial-assistance');
                });
            }
        });
    </script>
</body>

</html>
