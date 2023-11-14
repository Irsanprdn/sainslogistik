<footer id="footer">

    <div class="footer-newsletter" id="contact">
        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="text-dark font-size-35 font-weight-bold">{{ __('website.textContact1') }}
                    </h4>
                    <p class="text-light font-size-35 font-weight-bold">{{ __('website.textContact2') }}</p>
                </div>
                <div class="col-lg-6">
                    <form action="" method="post">
                        <input type="email" name="email" class="text-left" style="padding-left: 20px;" placeholder="Drop your email here">
                        <button type="submit">Send <i class="bi bi-send"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-6 footer-links">
                    <h4>
                        <img src="{{ asset('assets') }}/uploads/logo/{{ $footerLogo->isi_komponen ?? '' }}" alt="Logo Sains Logistik" class="img-fluid" width="200">
                    </h4>
                    <!-- <p class="text-justify mb-4">{{ $footerDescription->isi_komponen ?? '' }}</p> -->

                </div>


                <!-- <div class="col-lg-2 offset-lg-5 col-md-6 footer-links">
                    <h4 class="text-base">Company</h4>
                    <ul>
                        <li class="sosmed"><a class="nav-link scrollto active" href="#hero">{{ __('website.menu0') }}</a></li>
                        <li class="sosmed"><a class="nav-link scrollto" href="#services">{{ __('website.menu1') }}</a></li>
                        <li class="sosmed"><a class="nav-link scrollto" href="#about">{{ __('website.menu2') }}</a></li>
                        <li class="sosmed"><a class="nav-link scrollto" href="#clients">{{ __('website.menu3') }}</a></li>
                        <li class="sosmed"><a class="nav-link scrollto" href="#contact">{{ __('website.menu4') }}</a></li>
                    </ul>
                </div> -->

            </div>
            <div class="d-flex justify-content-start align-items-center">
                <i class="bi bi-geo-alt-fill font-size-35 text-base"></i>
                <p class="mb-0 mx-3">{{ $footerAddress->isi_komponen ?? '' }}</p>
            </div>
        </div>
    </div>

    <div class="container border-top">
        <div class="copyright">
            <div class="row">
                <div class="col-lg-6">
                    &copy; Copyright <strong><span class="text-base">2023</span> by Sains Logistik.</strong> All Rights Reserved
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <div class="social-links mr-4">
                        <a title="{{ $footerIGLink->isi_komponen ?? '' }}" href="{{ $footerIGLink->isi_komponen ?? '' }}" class="instagram"><i class="text-light font-size-20 bx bxl-instagram"></i></a>
                        <a title="{{ $footerLILink->isi_komponen ?? '' }}" href="{{ $footerLILink->isi_komponen ?? '' }}" class="linkedin"><i class="text-light font-size-20 bx bxl-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>