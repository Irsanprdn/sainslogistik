<nav class="navbar top-navbar navbar-dark d-flex justify-content-end d-md-none" style="height: 6vh;">
    <div class="navbar-header d-flex justify-content-center" data-logobg="skin6">
        <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close" style="font-size: 20px;"></i></a>
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
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('home') }}" aria-expanded="false"><i class="me-3 bi bi-house-gear" aria-hidden="true"></i><span class="hide-menu">Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('about') }}" aria-expanded="false">
                        <i class="me-3 bi bi-info-circle" aria-hidden="true"></i><span class="hide-menu">About Us</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('activity') }}" aria-expanded="false">
                        <i class="me-3 bi bi-activity" aria-hidden="true"></i><span class="hide-menu">Activity</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('contact') }}" aria-expanded="false">
                        <i class="me-3 bi bi-geo-alt" aria-hidden="true"></i><span class="hide-menu">Contact</span></a>
                </li>               
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('master_data') }}" aria-expanded="false"><i class="me-3 bi bi-database" aria-hidden="true"></i><span class="hide-menu">Master Data</span></a>
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