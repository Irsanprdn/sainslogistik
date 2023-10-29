<header id="header" class="fixed-top d-flex align-items-center shadow">    
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ route('compro') }}" class="logo"><img src="{{ asset('assets') }}/uploads/logo/{{ $homeLogo->isi_komponen ?? '' }}" alt="Logo Sains Logistik" class="img-fluid w-100"></a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#clients">Clients</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                <li class="dropdown"><a href="#hero"><span>Eng</span> <i class="bi bi-translate"></i> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('compro.language','en') }}">English</a></li>                        
                        <li><a href="{{ route('compro.language','id') }}">Indonesia</a></li>                        
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>