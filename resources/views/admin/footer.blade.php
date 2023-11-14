@extends('admin')
@section('title', 'Footer')
@section('content')
@php
$defaultFoto = ENV('ASSET_URL') . "/assets/compro/img/AIW.png";
$default = ((($footerLogo->isi_komponen ?? '') == '') ? $defaultFoto : ENV('ASSET_URL') . "/assets/uploads/logo/".$footerLogo->isi_komponen );
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
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 footer-links">
                        <div class="d-flex justify-content-start">

                            <img src="{{ asset('assets') }}/uploads/logo/{{ $footerLogo->isi_komponen ?? '' }}" alt="Logo Sains Logistik" class="img-fluid" width="200">

                            <button type="button" class="mx-2 btn btn-sm btn-warning text-light" data-toggle="modal" data-target="#changeLogo">
                                Change Logo <i class="bi bi-pencil"></i>
                            </button>
                        </div>

                        <!-- <div class="card mt-3">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="id-tab" data-bs-toggle="tab" data-bs-target="#id" type="button" role="tab" aria-controls="id" aria-selected="true">Indonesia</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en" type="button" role="tab" aria-controls="en" aria-selected="false">English</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="id" role="tabpanel" aria-labelledby="id-tab">
                                    <div class="d-flex justify-content-start">
                                        <textarea id="footerDescription" data-lang="id" name="footerDescription" rows="7" class="form-custom text-dark reset-setting" readonly>{{ $footerDescription->isi_komponen ?? '' }}</textarea>
                                        <button type="button" class=" mx-2 btn btn-warning btn-circle text-light mt-4" onclick="editText(this,'#footerDescription')" title="Clik to edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="d-flex justify-content-start"><textarea id="footerDescriptionen" data-lang="en" name="footerDescription" rows="7" class="form-custom text-dark reset-setting" readonly>{{ $footerDescriptionen->isi_komponen ?? '' }}
                                        </textarea>
                                        <button type="button" class=" mx-2 btn btn-warning btn-circle text-light mt-4" onclick="editText(this,'#footerDescriptionen')" title="Clik to edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>


                    <!-- <div class="col-lg-2 footer-links">
                        <h4 class="text-base">Company</h4>
                        <ul>
                            <li class="sosmed"><a class="nav-link scrollto active" href="#hero">Home</a></li>
                            <li class="sosmed"><a class="nav-link scrollto" href="#services">Services</a></li>
                            <li class="sosmed"><a class="nav-link scrollto" href="#about">About</a></li>
                            <li class="sosmed"><a class="nav-link scrollto" href="#clients">Clients</a></li>
                            <li class="sosmed"><a class="nav-link scrollto" href="#contact">Contact</a></li>
                        </ul>
                    </div> -->

                </div>
                <div class="d-flex justify-content-start align-items-center">
                    <i class="bi bi-geo-alt-fill font-size-35 text-base"></i>
                    <input type="text" id="footerAddress" name="footerAddress" value="{{ $footerAddress->isi_komponen ?? '' }}" class="form-custom text-light reset-setting" readonly>
                    <button type="button" class="mx-2 btn btn-warning btn-circle text-light" onclick="editText(this,'#footerAddress')" title="Clik to edit">
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid border-top">
            <div class="copyright">
                <div class="row">
                    <div class="col-lg-6">
                        &copy; Copyright <strong><span class="text-base">2023</span> by Sains Logistik.</strong> All Rights Reserved
                    </div>
                    <div class="col-lg-6 d-flex justify-content-end">
                        <div class="social-links">
                            <a title="{{ $footerIGlink->isi_komponen ?? '' }}" href="{{ $footerIGlink->isi_komponen ?? '' }}" class="instagram"><i class="text-light font-size-20 bx bxl-instagram"></i></a>
                            <a title="{{ $footerLIlink->isi_komponen ?? '' }}" href="{{ $footerLIlink->isi_komponen ?? '' }}" class="linkedin"><i class="text-light font-size-20 bx bxl-linkedin"></i></a>
                        </div>
                        <button type="button" class="mx-2 btn btn-sm btn-warning text-light" data-toggle="modal" data-target="#changeSocialMedia">
                            Change Social Media <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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
                    <input type="hidden" name="menu" id="menu" value="footer">
                    <input type="hidden" name="komponen" id="komponen" value="logo">
                    <input type="file" class="form-control d-none" name="imgFile" id="imgFile" onchange="readURL(this)">
                    <div id="preview" class="text-center">
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

<!-- MODAL IG LI LINK -->
<div class="modal fade" id="changeSocialMedia" tabindex="-1" role="dialog" aria-labelledby="changeSocialMediaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('home.post') }}" method="POST" id="formchangeSocialMedia"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changeSocialMediaLabel">Form Change Whatsapp Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Instagram Link </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bx bxl-instagram link"></i>
                            </span>
                            <input type="hidden" name="menu[]" id="menu" value="footer">
                            <input type="hidden" name="komponen[]" id="komponen" value="iglink">
                            <input type="text" class="form-control" placeholder="Instagram Link" aria-label="Instagram Link Link" name="text[]" id="homeLinkWA" value="{{ $footerIGlink->isi_komponen ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Linkedin Link </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bx bxl-linkedin link"></i>
                            </span>
                            <input type="hidden" name="menu[]" id="menu" value="footer">
                            <input type="hidden" name="komponen[]" id="komponen" value="lilink">
                            <input type="text" class="form-control" placeholder="Linkedin Link" aria-label="Linkedin Link Link" name="text[]" id="homeLinkWA" value="{{ $footerLIlink->isi_komponen ?? '' }}">
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
        var lang = $(e).attr('data-lang')

        var komponen = "";
            if ( lang == 'id' ) {
                komponen = (e == '#footerDescription' ? 'description' : 'address')            
            }else{
                komponen = (e == '#footerDescriptionen' ? 'description' : 'address')
            }

        var data = {
            _token: '{{ csrf_token() }}',
            menu: 'footer',
            komponen: komponen,
            language: lang,
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