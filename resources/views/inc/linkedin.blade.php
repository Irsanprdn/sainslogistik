<section id="portfolio" class="portfolio" data-aos="fade-up">
    <div class="portfolio-child">
        <div class="container aos-init aos-animate position-relative" data-aos="fade-up">

            <div class="section-title">
                <h1>{!! $linkedinmediaTitle->isi_komponen ?? '' !!}</h1>
                <p>{!! $linkedinmediaDescription->isi_komponen ?? '' !!}</p>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach( $dataLinkedin as $dl )                    
                    <div class="swiper-slide">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $dl->image }}" alt="{{ $dl->image_title }}" style="height: 325px;">
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