@extends('admin')
@section('title', 'Home')
@section('content')
<div class="container">
    @if (session('error'))
    <div class="alert my-3 alert-danger">{{ session('error') }}
        <button type="button" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('success'))
    <div class="alert my-3 alert-success">{{ session('success') }}
        <button type="button" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <header id="header" class="d-flex align-items-center shadow">
        <!-- <video src=""></video> -->
        <div class="container d-flex align-items-center justify-content-between">

            <div class="d-flex justify-content-start">
                <a href="{{ route('compro') }}" class="logo"><img src="{{ asset('assets') }}/compro/img/Logo-Horizontal.svg" alt="Logo Sains Logistik" class="img-fluid w-100"></a>
                <button type="button" class="btn btn-warning text-light">
                    Change Logo <i class="bi bi-pencil"></i>
                </button>
            </div>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#clients">Clients</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li class="dropdown"><a href="#hero"><span>Eng</span> <i class="bi bi-translate"></i> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#hero">English</a></li>
                            <li><a href="#hero">Indonesia</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header>

    <!-- ======= hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
        <div class="content-top">
            <button type="button" class="btn btn-warning text-light">
                Change Video <i class="bi bi-pencil"></i>
            </button>
        </div>
        <!-- The video -->
        <video muted loop id="myVideo">
            <source src="{{ asset('assets') }}/uploads/video/COMPANY PROFILE - PT SAINS LOGISTIK INDONESIA.mp4" type="video/mp4">
        </video>

        <div class="btn-play-pause" onclick="playPause(this)">
            <i class="bi bi-play-circle"></i>
        </div>

        <div class="content">
            <div class="d-flex justify-content-center">
                <h1 class="text-white">
                    <input type="text" id="homeTitle" name="homeTitle" value="Spread Excellent Service" class="form-custom form-custom-lg text-light text-center reset-setting font-weight-bold" readonly>
                </h1>
                <button type="button" class="btn btn-warning btn-circle text-light mt-4" onclick="editText(this,'#homeTitle')">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
            <div class="d-flex justify-content-center">
                <p class="text-white w-100">
                    <input type="text" id="descriptionTitle" name="descriptionTitle" value="Tingkatkan efisiensi, kurangi biaya, dan kembangkan bisnis anda dengan berbagai solusi dan teknnologi kami." class="form-custom font-size-20 text-light text-center reset-setting" readonly>
                    <!-- <textarea name="descriptoinHome" id="descriptoinHome" cols="50" class="form-custom font-size-20 text-light text-center font-weight-bold" readonly>Tingkatkan efisiensi, kurangi biaya, dan kembangkan bisnis anda dengan berbagai solusi dan teknnologi kami.
                    </textarea> -->
                </p>
                <button type="button" class="btn btn-warning btn-circle text-light" onclick="editText(this,'#descriptionTitle')">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
            <!-- Use a button to pause/play the video with JavaScript -->
            <a class="btn btn-lg btn-contact-us btn-primary rounded-lg font-size-20 text-light">Fast Response </a><br>
            <button type="button" class="btn btn-warning text-light mt-2">
                Change Hyperlink <i class="bi bi-pencil"></i>
            </button>


        </div>

    </section><!-- End Hero Section -->
    <div style="top:-10px; left:0px; z-index:400;width:25%; position:relative; border-bottom: 25px solid #F5C200;">
    </div>
</div>
@endsection
@section('js')
<script>
    function playPause(e) {
        var btn = $(e).find('.bi');
        if ($(btn).hasClass('bi-play-circle')) {
            $('#myVideo').trigger('play')
            $(btn).removeClass('bi-play-circle')
            $(btn).addClass('bi-pause-circle')
        } else {
            $('#myVideo').trigger('pause');
            $(btn).removeClass('bi-pause-circle')
            $(btn).addClass('bi-play-circle')
        }
    }

    function editText(btn, e) {
        if ($(btn).hasClass('btn-warning')) {
            $('.btn-circle').addClass('btn-warning')
            $(btn).removeClass('btn-warning')
            $(btn).addClass('btn-warning')
        }
        $('.reset-setting').attr('readonly', true);
        $(e).focus()
        $(e).attr('readonly', false);
    }
</script>
@endsection