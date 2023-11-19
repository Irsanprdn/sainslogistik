<section id="about" class="about">
    <div class="container position-realtive" style="z-index: 300;" data-aos="fade-up">

        <div class="section-title">
            <h1 class="text-dark font-weight-bold title-question">{{ $aboutTitle->isi_komponen ?? '' }}</h1>
            {!! $aboutDescription->isi_komponen ?? '' !!}
        </div>
    </div>

    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-5 mb-3">
                <h4 class="border-bottom border-warning our-services-yellow-text">{{ $aboutimageTitle->isi_komponen ?? '' }}</h4>
                <h1 class="text-dark font-weight-bold font-size-50" id="placeCaptionTitle"></h1>
                <p class="text-justify" id="placeCaptionDescription">
                    
                </p>
                <div class="d-flex justify-content-start" id="btn-prevNext">
                    <a onclick="clickPrev()" class="cursor-pointer mx-2 back-to-left d-flex align-items-center justify-content-center"><i class="bi bi-arrow-left-short"></i></a>
                    <a onclick="clickNext()" class="cursor-pointer mx-2 back-to-right d-flex align-items-center justify-content-center"><i class="bi bi-arrow-right-short"></i></a>
                    <div class="mx-3" id="placePagination"></div>
                </div>
            </div>
            <div class="col-lg-7 col-mb-7 mb-3">
                <div class="swiper swiper-about-us">
                    <div class="swiper-wrapper" >
                        @foreach( $aboutSlide as $as )
                        <div class="swiper-slide" >
                            <div class="portfolio-wrap">
                                <a href="{{ asset('assets') }}/uploads/image/{{ $as->image }}"  target="_blank" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ asset('assets') }}/uploads/image/{{ $as->image }}" class="img-fluid border-radius-25" style="height:400px;width:530px;" ></a>
                            </div>

                            <div class="caption d-none">
                                <p class="caption-title">{{ $as->image_title ?? '' }}</p>
                                <p class="caption-desc">
                                    {{ $as->image_description ?? '' }}
                                </p>
                            </div>
                        </div>
                        @endforeach                       
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