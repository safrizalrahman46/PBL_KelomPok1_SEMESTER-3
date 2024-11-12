<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Web Report Violation</title>
    <!-- Core CSS and JS -->
    <link rel="stylesheet" href="{{ asset('public/template/') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('public/template/') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/template/') }}/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('public/template/') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/template/') }}/js/select.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('public/template/') }}/css/vertical-layout-light/style.css">
    <link rel="stylesheet"
        href="{{ asset('public/template/') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="shortcut icon" href="{{ asset('public//') }}/POLINEMA-LOGO.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Additional Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />

    <!-- Lightbox2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        div,
        span,
        p,
        html,
        body,
        table,
        tr,
        td,
        th,
        ul,
        li,
        ol {
            font-family: 'Outfit', sans-serif;
        }

        /* Custom styles to widen the sidebar */
        .sidebar-offcanvas {
            width: 300px;
            /* Adjust the width as needed */
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ url('/') }}">
                    <img src="{{ asset('public/POLINEMA-LOGO.png') }}" class="mr-2" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
                    <img src="{{ asset('public/POLINEMA-LOGO.png') }}" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <!-- Search input if needed -->
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="https://cdn-icons-png.flaticon.com/512/3541/3541871.png" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">

                            <a class="dropdown-item" href="#">
                                <i class="ti-user text-primary"></i>
                                Hi, {{ ucfirst(Auth::user()->name) }}
                            </a>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('signout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        {{--  New  --}}
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#masterData" aria-expanded="false" aria-controls="masterData">
                            <i class="icon-book menu-icon"></i>
                            <span class="menu-title">Master Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="masterData">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/admins') }}">Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/dosen') }}">Dosen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/mahasiswa') }}">Mahasiswa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/department') }}">Department</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/fakultas') }}">Fakultas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/kelas') }}">Kelas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/violation_type') }}">Violation Types</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/violation_level') }}">Violation Levels</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/notification') }}">Notifications</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#penaltyManagement" aria-expanded="false" aria-controls="penaltyManagement">
                            <i class="icon-book menu-icon"></i>
                            <span class="menu-title">Penalty Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="penaltyManagement">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/pelanggaran_mahasiswa') }}">Student Violations</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/komisi_discipline_decision') }}">Discipline Decisions</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#userManagement" aria-expanded="false" aria-controls="userManagement">
                            <i class="fas fa-users menu-icon"></i>
                            <span class="menu-title">User  Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="userManagement">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/users') }}">Manage Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/drivers') }}">Manage Drivers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/mahasiswa') }}">Mahasiswa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/department') }}">Department</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/fakultas') }}">Fakultas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/kelas') }}">Kelas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/violation_type') }}">Violation Types</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/violation_level') }}">Violation Levels</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/notification') }}">Notifications</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#rewardManagement" aria-expanded="false" aria-controls="rewardManagement">
                            <i class="fas fa-gift menu-icon"></i>
                            <span class="menu-title">Reward Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="rewardManagement">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/reward_points') }}">Reward Points</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/reward_archive') }}">Reward Archive</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Reports</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="reports">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/violation_report') }}">Violation Reports</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/admin_task_log') }}">Admin Task Logs</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#dpaManagement" aria-expanded="false" aria-controls="dpaManagement">
                            <i class="fas fa-user-graduate menu-icon"></i>
                            <span class="menu-title">DPA Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="dpaManagement">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/dpa') }}">DPA List</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#disciplineCommittee" aria-expanded="false" aria-controls="disciplineCommittee">
                            <i class="fas fa-user-shield menu-icon"></i>
                            <span class="menu-title">Discipline Committee</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="disciplineCommittee">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/komite_disiplin_mahasiswa') }}">Committee Members</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                            <i class="icon-cog menu-icon"></i>
                            <span class="menu-title">Settings</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="settings">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/system_settings') }}">System Settings</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            2024 By Tommy Kreatif</span>
                    </div>
                </footer>
            </div>
        </div>

        {{--  OLD  --}}

        {{--  <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#masterData" aria-expanded="false"
                            aria-controls="masterData">
                            <i class="icon-book menu-icon"></i>
                            <span class="menu-title">Master Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="masterData">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/car_brand') }}">Car Brand</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/cars') }}">Car</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/additional_servicess') }}">Additional
                                        Services</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/promotions') }}"> Promotions</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/tour_packages') }}">Tour
                                        Packages</a>
                                </li>


                            </ul>
                        </div>
                    </li>






                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#BookingManagement" aria-expanded="false"
                            aria-controls="BookingManagement">
                            <i class="icon-book menu-icon"></i>
                            <span class="menu-title">Booking Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="BookingManagement">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/Bookings') }}">Bookings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/Manage-Booking') }}">Create
                                        Booking</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">

                        <a class="nav-link" data-toggle="collapse" href="#deliveryCharges" aria-expanded="false" aria-controls="deliveryCharges">
                            <i class="fas fa-truck "></i>

                        <a class="nav-link" data-toggle="collapse" href="#deliveryCharges" aria-expanded="false"
                            aria-controls="deliveryCharges">
                            <i class="icon-paper menu-icon"></i>

                            <span class="menu-title">Delivery & Pickup Charges</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="deliveryCharges">


                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/backoffice/Delivery-pickup-charges') }}"> Delivery Pickup Charges</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/backoffice/Charges') }}"> Charges</a>
                                    </li>
                                </ul>

                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#tourPackages" aria-expanded="false" aria-controls="tourPackages">
                            <i class="icon-map menu-icon"></i>
                            <span class="menu-title">Tour Packages</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tourPackages">

                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/Delivery-pickup-charges') }}">
                                        Delivery Pickup Charges</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/Charges') }}"> Charges</a>
                                </li>
                            </ul>

                        </div>
                    </li>

                    <li class="nav-item">

                        <a class="nav-link" data-toggle="collapse" href="#areaZones" aria-expanded="false" aria-controls="areaZones">
                            <i class="fas fa-map-marker-alt menu-icon"></i>

                        <a class="nav-link" data-toggle="collapse" href="#areaZones" aria-expanded="false"
                            aria-controls="areaZones">
                            <i class="icon-paper menu-icon"></i>

                            <span class="menu-title">Area Zones</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="areaZones">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/Zones') }}"> Zones</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#promotions" aria-expanded="false" aria-controls="promotions">
                            <i class="fas fa-gift menu-icon"></i>
                            <span class="menu-title">Promotions</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="promotions">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/Promotions') }}"> Promotions</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#userManagement" aria-expanded="false" aria-controls="userManagement">
                            <i class="fas fa-users menu-icon"></i>



                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#userManagement" aria-expanded="false"
                            aria-controls="userManagement">
                            <i class="icon-paper menu-icon"></i>

                            <span class="menu-title">User Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="userManagement">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/users') }}">Manage Users</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/drivers') }}">Manage Driver</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/admins') }}">Manage Admin </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#Deposit" aria-expanded="false" aria-controls="Deposit">
                            <i class="fas fa-wallet menu-icon"></i>
                            <span class="menu-title">Deposit</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="Deposit">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/Deposit') }}"> Deposit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/backoffice/SecurityDeposit') }}"> Security Deposit</a>
                                </li>
                            </ul>
                        </div>
                    </li>





                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            2024 By Tommy Kreatif</span>
                    </div>
                </footer>
            </div>
        </div>  --}}



    </div>

    <script>
        lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true // Allows continuous navigation from the last image back to the first
        })
    </script>
    <!-- Core JS -->
    <script src="{{ asset('public/template/') }}/vendors/js/vendor.bundle.base.js"></script>
    <script src="{{ asset('public/template/') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('public/template/') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('public/template/') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('public/template/') }}/js/dataTables.select.min.js"></script>
    <script src="{{ asset('public/template/') }}/js/off-canvas.js"></script>
    <script src="{{ asset('public/template/') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('public/template/') }}/js/template.js"></script>
    <script src="{{ asset('public/template/') }}/js/settings.js"></script>
    <script src="{{ asset('public/template/') }}/js/todolist.js"></script>
    <script src="{{ asset('public/template/') }}/js/dashboard.js"></script>
    <script src="{{ asset('public/template/') }}/js/Chart.roundedBarCharts.js"></script>
</body>

</html>
