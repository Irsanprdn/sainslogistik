<section id="about" class="about">
    <div class="container position-realtive" style="z-index: 300;" data-aos="fade-up">

        <div class="section-title">
            <h1 class="text-dark font-weight-bold title-question">{{ $aboutTitle->isi_komponen ?? '' }}</h1>
            {!! $aboutDescription->isi_komponen ?? '' !!}
        </div>
    </div>

    <div class="nocontainer" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-5 mb-3 offset-1">
                <h4 class="border-bottom border-warning our-services-yellow-text">About Us</h4>
                <h1 class="text-dark font-weight-bold font-size-50" id="placeCaptionTitle"></h1>
                <p class="text-justify" id="placeCaptionDescription">
                    
                </p>
                <div class="d-flex justify-content-start" id="btn-prevNext">
                    <a onclick="clickPrev()" class="cursor-pointer mx-2 back-to-left d-flex align-items-center justify-content-center"><i class="bi bi-arrow-left-short"></i></a>
                    <a onclick="clickNext()" class="cursor-pointer mx-2 back-to-right d-flex align-items-center justify-content-center"><i class="bi bi-arrow-right-short"></i></a>
                    <div class="mx-3" id="placePagination"></div>
                </div>
            </div>
            <div class="col-lg-6 col-mb-5 offset-mb-1 mb-3">
                <div class="swiper swiper-about-us">
                    <div class="swiper-wrapper">
                        @foreach( $aboutSlide as $as )
                        <div class="swiper-slide">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('assets') }}/uploads/image/{{ $as->image }}" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ asset('assets') }}/uploads/image/{{ $as->image }}" class="img-fluid border-radius-25" style="height:450px;width:auto;"></a>
                            </div>

                            <div class="caption d-none">
                                <p class="caption-title">{{ $as->image_title ?? '' }}</p>
                                <p class="caption-desc">
                                    {{ $as->image_description ?? '' }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="swiper-slide">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('assets') }}/compro/img/WMS.jpeg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ asset('assets') }}/compro/img/WMS.jpeg" class="img-fluid border-radius-25" style="height:450px;width:auto;"></a>
                            </div>
                            <div class="caption d-none">
                                <p class="caption-title">WMS</p>
                                <p class="caption-desc">Warehouse Management System (WMS) Sistem Manajemen Gudang Terpadu (Sains Storage) yang dikembangkan oleh tim IT kami, serta didukung oleh tenaga kerja yang profesional</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('assets') }}/compro/img/WH.jpeg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ asset('assets') }}/compro/img/WH.jpeg" class="img-fluid border-radius-25" style="height:450px;width:auto;"></a>
                            </div>
                            <div class="caption d-none">
                                <p class="caption-title">Warehouse</p>
                                <p class="caption-desc">Kompleks pergudangan modern yang menyediakan tempat penyimpanan barang konsul (Sharing Warehouse) dan gudang pribadi (Private Warehouse)</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('assets') }}/compro/img/ITMS.jpeg" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ asset('assets') }}/compro/img/ITMS.jpeg" class="img-fluid border-radius-25" style="height:450px;width:auto;"></a>
                            </div>
                            <div class="caption d-none">
                                <p class="caption-title">Intergrated TMS</p>
                                <p class="caption-desc">TMSTransport Management System (TMS) Sistem Manajemen Transportasi Terpadu (Sains Delivery) yang dikembangkan oleh tim IT kami, serta didukung oleh tenaga kerja yang profesional</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="portfolio-wrap">
                                <a href="{{ asset('assets') }}/compro/img/image.png" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ asset('assets') }}/compro/img/image.png" class="img-fluid border-radius-25" style="height:450px;width:auto;" alt=""></a>
                            </div>
                            <div class="caption d-none">
                                <p class="caption-title">Certificate</p>
                                <p class="caption-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                        </div> -->
                    </div>



                    <!-- If we need pagination -->
                    <div class="swiper-pagination d-none" id="pagination-aus"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev d-none" id="btn-prev-swiper"></div>
                    <div class="swiper-button-next d-none" id="btn-next-swiper"></div>
                </div>
            </div>
        </div>
    </div>
</section>