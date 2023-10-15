<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - @yield('title') </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets') }}/compro/img/favicon.png">
    <!-- Custom CSS -->
    <link href="{{ asset('assets') }}/admin/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets') }}/admin/css/style.css?v=1.8" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/Responsive/css/responsive.datatables.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/FixedHeader/css/fixedHeader.datatables.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/css/dataTables.responsive.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/DataTables/css/dataTables.FixedHeader.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/bootstrap/css/bootstrap-select.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/admin/plugins/bootstrap/dist/css/bootstrap-datepicker.css" rel="stylesheet">
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

        @include('section.sidebar')

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
    <script src="{{ asset('assets') }}/admin/DataTables/Responsive/js/responsive.datatables.min.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/fixedHeader/js/fixedHeader.datatables.min.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/js/dataTables.responsive.js"></script>
    <script src="{{ asset('assets') }}/admin/DataTables/js/dataTables.FixedHeader.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets') }}/admin/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/admin/plugins/bootstrap/dist/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('assets') }}/admin/js/app-style-switcher.js"></script>
    <script src="{{ asset('assets') }}/compro/vendor/bootstrap/js/bootstrap-select.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('assets') }}/admin/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('assets') }}/admin/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('assets') }}/admin/js/custom.js"></script>


    <script src="{{ asset('assets') }}/admin/plugins/flot/jquery.flot.js"></script>
    <script src="{{ asset('assets') }}/admin/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    @yield('js')
</body>

</html>