<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sains Logistik Indonesia</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets') }}/compro/img/Logo-Sains-Potrait.png" rel="icon">
    <link href="{{ asset('assets') }}/compro/img/Logo-Sains-Potrait.png" rel="icon">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets') }}/compro/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/compro/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets') }}/compro/css/style.css?v=3.7" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    @include('inc.header')


    @include('inc.slider')

    <main id="main">

        <!-- ======= Services Section ======= -->
        @include('inc.services')
        <!-- End About Us Section -->
        
        <!-- ======= About Section ======= -->
        @include('inc.about-us')
        <!-- End Icon Boxes Section -->

        <!-- ======= Video Section ======= -->
        @include('inc.video')
        <!-- End Video Section -->

        <!-- ======= Video Section ======= -->
        @include('inc.linkedin')
        <!-- End Video Section -->

        <!-- ======= Clients Section ======= -->
        @include('inc.client')
        <!-- End Clients Section -->

    </main><!-- End #main -->


    <!-- ======= Footer ======= -->
    @include('inc.footer')
    <!-- End  Footer -->

    <div class="modal fade" id="modalPopUpImage" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="width: auto !important;">
            <div class="modal-content" style="background-color: transparent; border:none;">
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img src="" alt="Pop Up Image" id="popUpImage" width="300">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets') }}/compro/vendor/aos/aos.js"></script>
    <script src="{{ asset('assets') }}/compro/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/compro/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('assets') }}/compro/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('assets') }}/compro/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets') }}/compro/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets') }}/compro/js/main.js"></script>
    <script src="{{ asset('assets') }}/compro/js/jquery.js"></script>
</body>
<script>
    var baseUrl = "{{ asset('assets') }}";
    $(document).ready(function() {
        cloneCaptionSliderServices()
    });

    function cloneCaptionSliderServices() {
        var captionTitle = $('.swiper-slide-active').find('.caption-title').text()   
        var captionDescription = $('.swiper-slide-active').find('.caption-desc').text()                
       
        $('#placeCaptionTitle').text(captionTitle)
        $('#placeCaptionDescription').text(captionDescription)
        var paginationAUS = $('#pagination-aus').html()
        $('#placePagination').html(paginationAUS)
        $('#placePagination').find('#pagination-aus').removeClass('d-none')
    }

    // Create a function that initializes Swiper and returns a Promise
    function initSwiper() {
        return new Promise((resolve) => {
            var swiper = new Swiper(".swiper-about-us", {
                slidesPerView: 1.5,
                spaceBetween: 35,
                centeredSlides: false,
                loop: true,
                grabCursor: false,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                }
            });
        });
    }

    // Call the initSwiper function to initialize Swiper and wait for it to finish
    initSwiper().then(function() {
        // Swiper initialization is complete, you can call another function here
        anotherFunction();
    });

    // Define the function you want to call after Swiper initialization
    function anotherFunction() {
        // Your code here
        let clone = document.getElementById('#pagination-aus').innerHTML
        console.log(clone)
        document.getElementById('#place-pagination').innerHTML = 'abs'
    }

    function resetCollapse(e) {
        if ( $(e).hasClass('bg-base') ) {
            $('.our-services').removeClass('bg-base') 
        }else{                       
            $('.our-services').removeClass('bg-base') 
            $('.collapseAll').removeClass('show')
            $(e).addClass('bg-base')
        }

        // var elem = document.getElementsByClassName('our-services');
        // for (var i = 0; i < elem.length; i++) {
        //     elem[i].classList.remove("bg-base");
        // }
        // e.classList.add("bg-base");

        // var elements = document.getElementsByClassName('collapseAll');
        // for (var i = 0; i < elements.length; i++) {
        //     elements[i].classList.remove("show");
        // }
    }


    var swiper = new Swiper(".mySwiper", {
        grabCursor: true,
        centeredSlides: false,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1.2,
                spaceBetween: 10
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 2.2,
                spaceBetween: 20
            },
            // when window width is >= 640px
            640: {
                slidesPerView: 3.2,
                spaceBetween: 30
            }
        }
    });

    function clickPrev() {
        document.getElementById('btn-prev-swiper').click()
        cloneCaptionSliderServices()
    }

    function clickNext() {
        document.getElementById('btn-next-swiper').click()
        cloneCaptionSliderServices()
    }

    function playPause(e){
        if ( $(e).hasClass('bi-play-circle') ) {
            $('#myVideo').trigger('play')
            $(e).removeClass('bi-play-circle')
            $(e).addClass('bi-pause-circle')
        }else{
            $('#myVideo').trigger('pause');
            $(e).removeClass('bi-pause-circle')
            $(e).addClass('bi-play-circle')
        }
    }
</script>

</html>