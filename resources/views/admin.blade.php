<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - @yield('title') </title>
    <!-- Favicon icon -->
    <link href="{{ asset('assets') }}/compro/img/Logo-Sains-Potrait.png" rel="icon">
    <link href="{{ asset('assets') }}/compro/img/Logo-Sains-Potrait.png" rel="icon">
    <!-- Custom CSS -->
    <link href="{{ asset('assets') }}/admin/css/style.css?v=1.8" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/rowReOrder.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/Responsive/css/responsive.datatables.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/FixedHeader/css/fixedHeader.datatables.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/css/dataTables.responsive.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/css/dataTables.FixedHeader.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/plugins/bootstrap/dist/css/bootstrap-datepicker.css" rel="stylesheet">


    <!-- FRONT -->   

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets') }}/compro/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets') }}/compro/css/style.css?v=4.0" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/css/cms.css?v=1.1" rel="stylesheet">
    <!-- END FRONT -->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <nav class="navbar top-navbar navbar-dark d-flex justify-content-end d-md-none" style="height: 6vh;">
            <div class="navbar-header d-flex justify-content-center pt-3" data-logobg="skin6">
                <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)">
                    <i class="ti-menu ti-close" style="font-size: 20px;"></i>
                </a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </nav>

        <aside class="left-sidebar p-0" data-sidebarbg="skin6">

            <!-- navbar-expand-md  -->
            <nav class="navbar top-navbar navbar-dark justify-content-center">
                <div class="navbar-header d-flex justify-content-center" data-logobg="skin6">
                    <a class="navbar-brand" href="#">
                        <b class="logo-icon">

                            <img src="{{ asset('assets') }}/compro/img/Logo-Sains-Potrait.png" width="100" alt="homepage" class="dark-logo" />
                        </b>
                    </a>

                </div>
            </nav>

            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('subscriber') }}" aria-expanded="false">
                                <span class="hide-menu">Subscriber</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                                <span class="hide-menu">Home</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('ourservice') }}" aria-expanded="false">

                                <span class="hide-menu">Service</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('service') }}" aria-expanded="false">

                                <span class="hide-menu">Service Image</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('about') }}" aria-expanded="false">

                                <span class="hide-menu">About</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('image') }}" aria-expanded="false">

                                <span class="hide-menu">About Image</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('client') }}" aria-expanded="false">

                                <span class="hide-menu">Client</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('linkedinmedia') }}" aria-expanded="false">

                                <span class="hide-menu">Linkedin</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('linkedin') }}" aria-expanded="false">

                                <span class="hide-menu">Linkedin Image</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link ml-2 waves-effect waves-dark sidebar-link" href="{{ route('footer') }}" aria-expanded="false">

                                <span class="hide-menu">Footer</span></a>
                        </li>
                     
                        <li class="text-center p-20 upgrade-btn mt-5">
                            <a href="{{ route('logout') }}" class="btn btn-danger text-white mt-4">Logout</a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-6">
                        <div class="d-flex align-items-center ">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li style="font-size: 15px;" class="breadcrumb-item"><a href="#">Admin</a></li>
                                    <li style="font-size: 15px;" class="breadcrumb-item active" aria-current="page">> @yield('title')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-6 col-6 align-self-center text-right">
                        <p style="font-size: 15px;" class="page-title mb-0 p-0">{{ auth()->user()->fullname}}</p>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body" id="getHeight" style="height: 85vh; overflow-y:auto;">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Recent blogss -->
            <!-- ============================================================== -->
        </div>
    </div>


    <script src="{{ asset('assets') }}/admin/plugins/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/login/js/popper.min.js"></script>
    <!-- datatales -->
    <script src="{{ asset('assets') }}/admin/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/rowReOrder.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/Responsive/js/responsive.datatables.min.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/fixedHeader/js/fixedHeader.datatables.min.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/js/dataTables.responsive.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/js/dataTables.FixedHeader.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets') }}/admin/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/admin/plugins/bootstrap/dist/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('assets') }}/admin/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('assets') }}/admin/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('assets') }}/admin/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('assets') }}/admin/js/custom.js"></script>
    <!-- tinymce -->
    <script src="{{ asset('assets') }}/admin/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('assets') }}/compro/vendor/swiper/swiper-bundle.min.js"></script>

    <script src="{{ asset('assets') }}/admin/plugins/flot/jquery.flot.js"></script>
    <script src="{{ asset('assets') }}/admin/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    @yield('js')
</body>

</html>