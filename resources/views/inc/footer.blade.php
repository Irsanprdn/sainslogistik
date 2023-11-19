<footer id="footer">

    <div class="footer-newsletter" id="contact">
        <div class="container position-relative">

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="text-dark font-size-35 font-weight-bold">{{ __('website.textContact1') }}
                    </h4>
                    <p class="text-light font-size-35 font-weight-bold">{{ __('website.textContact2') }}</p>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('subscriber.mail') }}" method="post">
                        @csrf
                        <input type="email" name="email" class="text-left" style="padding-left: 20px;" placeholder="Drop your email here" autocomplete="off" required>
                        <button type="submit">Send <i class="bi bi-send"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-all">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-top">
                        <div class="d-sm-none d-flex justify-content-start footer-links">
                            <h4 class="text-center mb-0">
                                <img src="{{ asset('assets') }}/uploads/logo/{{ $footerLogo->isi_komponen ?? '' }}" alt="Logo Sains Logistik" class="img-fluid w-50">
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-8">
                    <div class="footer-top">
                        <div class="d-none d-sm-block footer-links">
                            <h4>
                                <img src="{{ asset('assets') }}/uploads/logo/{{ $footerLogo->isi_komponen ?? '' }}" alt="Logo Sains Logistik" class="img-fluid w-50">
                            </h4>
                        </div>
                        <div class="d-flex justify-content-start align-items-center position-relative p-1">
                            <i class="bi bi-geo-alt-fill font-size-35 text-base"></i>
                            <p class="mb-0 mx-3">{{ $footerAddress->isi_komponen ?? '' }}</p>
                        </div>
                        <div class="d-flex justify-content-start align-items-center position-relative p-1">
                            <i class="bi bi-envelope-fill font-size-35 text-base"></i>
                            <p class="mb-0 mx-3">{{ $footerMail->isi_komponen ?? '' }}</p>
                        </div>
                        <div class="d-flex justify-content-start align-items-center position-relative p-1">
                            <i class="bi bi-phone-fill font-size-35 text-base"></i>
                            <p class="mb-0 mx-3">{{ $footerPhone->isi_komponen ?? '' }}</p>
                        </div>
                    </div>


                    <div class="position-relative border-top py-2 d-none d-sm-block justify-content-between">
                        <div class="copyright p-0">
                            <div class="row">
                                <div class="col-lg-8">
                                    &copy; Copyright <strong><span class="text-base">2023</span> by Sains Logistik.</strong> All Rights Reserved
                                </div>
                                <div class="col-lg-4 d-none d-sm-flex justify-content-end">
                                    <div class="social-links mr-4">
                                        <a title="{{ $footerIGLink->isi_komponen ?? '' }}" href="{{ $footerIGLink->isi_komponen ?? '' }}" class="instagram"><i class="text-light font-size-20 bx bxl-instagram"></i></a>
                                        <a title="{{ $footerLILink->isi_komponen ?? '' }}" href="{{ $footerLILink->isi_komponen ?? '' }}" class="linkedin"><i class="text-light font-size-20 bx bxl-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-4 d-flex align-item-center">
                    <img src="{{ asset('assets') }}/uploads/image/{{ $footerImage->isi_komponen ?? '' }}" alt="PIC" class="position-relative helpdesk-img">
                </div>
                <div class="col-12 d-sm-none">
                    <div class="position-relative mb-2">
                        <div class="social-links mr-4">
                            <a title="{{ $footerIGLink->isi_komponen ?? '' }}" href="{{ $footerIGLink->isi_komponen ?? '' }}" class="instagram"><i class="text-white font-size-20 bx bxl-instagram"></i></a>
                            <a title="{{ $footerLILink->isi_komponen ?? '' }}" href="{{ $footerLILink->isi_komponen ?? '' }}" class="linkedin"><i class="text-white font-size-20 bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="position-relative border-top py-2 px-0">
                        <div class="copyright p-0">
                            &copy; Copyright <strong><span class="text-base">2023</span> by Sains Logistik.</strong> All Rights Reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>