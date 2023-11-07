<section id="portfolio" class="portfolio">
    <div class="portfolio-child">
        <div class="container aos-init aos-animate position-relative" data-aos="fade-up">

            <div class="section-title">
                <h1>Sains Logistik LinkedIn</h1>
                <p>Newest or lastes our posting in LinkedIn website. You can see news about Sains Logistik Indonesia in there.</p>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach( $dataLinkedin as $dl )
                    <!-- 
                        <div class="portfolio-wrap">
                            <a href="{{ $dl->image }}" class="glightbox"><img src="{{ $dl->image }}" class="img-fluid" alt="{{ $dl->image_title }}"></a>
                            <div class="portfolio-info" style="height: 300px;">
                                <div class="d-flex justify-content-between">
                                    <h4><a href="portfolio-details.html" title="More Details">{{ $dl->image_title }}</a></h4>
                                    <i class="text-info font-size-20 bx bxl-linkedin"></i>
                                </div>
                                <p  style="height: 50px;">{{ $dl->image_description }}</p>
                                <h4 class="text-base mb-0 mt-5" posit><a href="{{ $dl->embed }}" title="More Details">Lihat Selengkapnya</a></h4>
                            </div>
                        </div>
                    </div> -->
                    <div class="swiper-slide">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $dl->image }}" alt="{{ $dl->image_title }}">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $dl->image_title }}</h5>
                                <p class="card-text text-truncate">{{ $dl->image_description }}</p>
                                <h6 class="text-base mb-0 mt-3"><a target="_blank" href="{{ $dl->embed }}" title="More Details">Lihat Selengkapnya</a></h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>