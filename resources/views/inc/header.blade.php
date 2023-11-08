<header id="header" class="fixed-top d-flex align-items-center shadow">    
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ route('compro') }}" class="logo"><img src="{{ asset('assets') }}/uploads/logo/{{ $homeLogo->isi_komponen ?? '' }}" alt="Logo Sains Logistik" class="img-fluid w-100"></a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="#hero">{{ __('website.menu0') }}</a></li>
                <li><a class="nav-link scrollto" href="#services">{{ __('website.menu1') }}</a></li>
                <li><a class="nav-link scrollto" href="#about">{{ __('website.menu2') }}</a></li>
                <li><a class="nav-link scrollto" href="#clients">{{ __('website.menu3') }}</a></li>
                <li><a class="nav-link scrollto" href="#contact">{{ __('website.menu4') }}</a></li>
                <li class="dropdown"><a href="#hero"><span>{{ __('website.menu5') }}</span> <i class="bi bi-translate"></i> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('compro.language','id') }}">Indonesia</a></li>                        
                        <li><a href="{{ route('compro.language','en') }}">English</a></li>                        
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>