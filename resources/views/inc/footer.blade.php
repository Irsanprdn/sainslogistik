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
                <div class="col-md-9">
                    <div class="footer-top">
                        <div class=" footer-links">
                            <h4>
                                <img src="{{ asset('assets') }}/uploads/logo/{{ $footerLogo->isi_komponen ?? '' }}" alt="Logo Sains Logistik" class="img-fluid" width="200">
                            </h4>
                        </div>
                        <div class="d-flex justify-content-start align-items-center position-relative mb-4">
                            <i class="bi bi-geo-alt-fill font-size-35 text-base"></i>
                            <p class="mb-0 mx-3">{{ $footerAddress->isi_komponen ?? '' }}</p>
                        </div>
                    </div>


                    <div class="container position-relative border-top">
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
                </div>
                <div class="col-md-3">
                    <img src="{{ asset('assets') }}/compro/img/anggi.jpeg" alt="PIC" class="position-relative w-100">
                </div>
            </div>
        </div>
    </div>
</footer>