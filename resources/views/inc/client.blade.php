<section id="clients" class="clients" data-aos="fade-up">
    <div class="section-title text-center">
        <h1 class="text-dark text-capitalize">Our Clients<span class="text-base font-size-35">.</span></h1>
    </div>
    <div class="container" data-aos="zoom-in">
        <div class="clients-slider swiper" data-swiper-autoplay="50">
            <div class="swiper-wrapper align-items-center">                
                @foreach( $ourClient as $c )
                <div class="swiper-slide"><img src="{{ asset('assets') }}/uploads/clients/{{ $c->client_logo }}" class="img-fluid px-3 our-clients-img" style="max-width: 200%;" alt="{{ $c->client_name }}"></div>
                @endforeach
            </div>
            <div class="swiper-pagination pt-4"></div>
        </div>
    </div>
</section>