@extends('admin')
@section('title', 'Home')
@section('content')
@php
$defaultFoto = ENV('ASSET_URL') . "/assets/compro/img/AIW.png";
$default = ((($homeLogo->isi_komponen ?? '') == '') ? $defaultFoto :  ENV('ASSET_URL') . "/assets/uploads/logo/".$homeLogo->isi_komponen );
@endphp
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
                <a href="{{ route('compro') }}" class="logo"><img src="{{ asset('assets') }}/uploads/logo/{{ $homeLogo->isi_komponen ?? '' }}" alt="Logo Sains Logistik" class="img-fluid w-100"></a>
                <button type="button" class="mx-2 btn btn-warning text-light" data-toggle="modal" data-target="#changeLogo">
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
            <button type="button" class="btn btn-warning text-light" data-toggle="modal" data-target="#changeVideo">
                Change Video <i class="bi bi-pencil"></i>
            </button>
        </div>
        <!-- The video -->
        <video muted loop id="myVideo">
            <source src="{{ asset('assets') }}/uploads/video/{{ $homeVideo->isi_komponen ?? '' }}" type="video/mp4">
        </video>

        <div class="btn-play-pause" onclick="playPause(this)">
            <i class="bi bi-play-circle"></i>
        </div>

        <div class="content">
            <div class="d-flex justify-content-center">
                <h1 class="text-white">
                    <input type="text" id="homeTitle" name="homeTitle" value="{{ $homeTitle->isi_komponen ?? '' }}" class="form-custom form-custom-lg text-light text-center reset-setting font-weight-bold" readonly>
                </h1>
                <button type="button" class=" mx-2 btn btn-warning btn-circle text-light mt-4" onclick="editText(this,'#homeTitle')" title="Clik to edit">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
            <div class="d-flex justify-content-center">
                <p class="text-white w-100">
                    <input type="text" id="homeDescription" name="homeDescription" value="{{ $homeDescription->isi_komponen ?? '' }}" class="form-custom font-size-20 text-light text-center reset-setting font-weight-bold" readonly>
                </p>
                <button type="button" class="mx-2 btn btn-warning btn-circle text-light" onclick="editText(this,'#homeDescription')" title="Clik to edit" >
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
            <!-- Use a button to pause/play the video with JavaScript -->
            <a href="{{ $homeWAlink->isi_komponen ?? '' }}" title="{{ $homeWAlink->isi_komponen ?? '' }}" class="btn btn-lg btn-contact-us btn-primary rounded-lg font-size-20 text-light">Fast Response </a><br>
            <button type="button" class="btn btn-warning text-light mt-2" data-toggle="modal" data-target="#changeWhatsappLink">
                Change Whatsapp Link <i class="bi bi-pencil"></i>
            </button>


        </div>

    </section><!-- End Hero Section -->
    <div style="top:-10px; left:0px; z-index:250;width:25%; position:relative; border-bottom: 25px solid #F5C200;">
    </div>
</div>


<!-- MODAL LOGO -->
<div class="modal fade" id="changeLogo" tabindex="-1" role="dialog" aria-labelledby="changeLogoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('home.post') }}" enctype="multipart/form-data" method="POST" id="formchangeLogo"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changeLogoLabel">Form Change Logo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">File input must be format jpg,jpeg,png Max Size( 4 mb )</label>
                    <input type="hidden" name="menu" id="menu" value="home">
                    <input type="hidden" name="komponen" id="komponen" value="logo">
                    <input type="file" class="form-control d-none" name="imgFile" id="imgFile" onchange="readURL(this)">
                    <div id="preview" class="text-center cursor-pointer">
                        <img id="viewImg" src="{{$default}}" alt="Upload Preview" onclick="openFormFile()" style="width: 320px;height:320px;">
                    </div>
                    <p>*Click image for browse file</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL VIDEO -->
<div class="modal fade" id="changeVideo" tabindex="-1" role="dialog" aria-labelledby="changeVideoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('home.post') }}" enctype="multipart/form-data" method="POST" id="formchangeVideo"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changeVideoLabel">Form Change Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">File input must be format mp4,mov,ogg,3gp,avi,wmv Max Size( 128 mb )</label>
                    <input type="hidden" name="menu" id="menu" value="home">
                    <input type="hidden" name="komponen" id="komponen" value="video">
                    <input type="file" class="form-control" name="videoFile" id="videoFile" onchange="readURL(this)">                                       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL WA LINK -->
<div class="modal fade" id="changeWhatsappLink" tabindex="-1" role="dialog" aria-labelledby="changeWhatsappLinkLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('home.post') }}" method="POST" id="formChangeWhatsappLink"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changeWhatsappLinkLabel">Form Change Whatsapp Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Whatsapp Link </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-whatsapp link"></i>
                            </span>
                            <input type="hidden" name="menu" id="menu" value="home">
                            <input type="hidden" name="komponen" id="komponen" value="walink">
                            <input type="text" class="form-control" placeholder="Whatsapp Link" aria-label="Whatsapp Link Link" name="text" id="homeLinkWA" value="{{ $homeWAlink->isi_komponen ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
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
            $('.btn-circle').find('.bi').removeClass('bi-save')
            $('.btn-circle').find('.bi').addClass('bi-pencil')

            $('.btn-circle').removeClass('btn-primary')
            $('.btn-circle').addClass('btn-warning')

            $('.btn-circle').attr('title', 'Click to edit')

            $(btn).find('.bi').removeClass('bi-pencil')
            $(btn).find('.bi').addClass('bi-save')

            $(btn).removeClass('btn-warning')
            $(btn).addClass('btn-primary')
            $(btn).attr('title', 'Click to save')

            $(e).focus()
            $(e).attr('readonly', false);
        } else {
            $('.btn-circle').find('.bi').removeClass('bi-save')
            $('.btn-circle').find('.bi').addClass('bi-pencil')

            $('.btn-circle').removeClass('btn-primary')
            $('.btn-circle').addClass('btn-warning')

            $(btn).find('.bi').removeClass('bi-save')
            $(btn).find('.bi').addClass('bi-pencil')

            $(btn).removeClass('btn-primary')
            $(btn).addClass('btn-warning')

            $('.reset-setting').attr('readonly', true);

            saveText(e)
        }
    }

    function saveText(e) {
        var text = $(e).val()
        var komponen = (e == '#homeTitle' ? 'title' : 'description')
        var data = {
            _token: '{{ csrf_token() }}',
            menu: 'home',
            komponen: komponen,
            text: text
        }

        var urle = "{{  route('home.post') }}";
        var datae = JSON.stringify(data);
        postData(urle, datae)

    }

    function postData(urle, datae) {
        $.ajax({
            type: 'POST',
            url: urle,
            contentType: "application/json",
            processData: false,
            data: datae,
            success: function(response) {
                // console.log(response)
                if (response.code == 200) {
                    alert('Successfully')
                } else {
                    alert('Failed')
                }
            }
        });
    }

    function openFormFile() {
        $('#imgFile').click();
    }

    function readURL(input) {
        var defaults = "{{ $default }}";
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewImg')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#viewImg').attr('src', defaults);
        }
    } 
</script>
@endsection