<!-- ======= hero Section ======= -->
<section id="hero" class="d-flex justify-content-center align-items-center" onclick="playPause(this)">
    <!-- The video -->
    <video muted loop id="myVideo" >
        <source src="{{ asset('assets') }}/uploads/video/COMPANY PROFILE - PT SAINS LOGISTIK INDONESIA.mp4" type="video/mp4">
    </video>

    <div class="btn-play-pause">
        <i class="bi bi-play-circle" ></i>
    </div>

    <div class="content">        
        <h1 class="text-center text-white">{{ $homeTitle->isi_komponen ?? '' }}</h1>
        <p class="text-center text-white">{{ $homeDescription->isi_komponen ?? '' }}</p>
        <!-- Use a button to pause/play the video with JavaScript -->
        <a class="btn btn-lg btn-contact-us btn-primary rounded-lg font-size-20" >Fast Response</a>
    </div>

</section><!-- End Hero Section -->
<div style="top:-10px; left:0px; z-index:400;width:25%; position:relative; border-bottom: 25px solid #F5C200;">
</div>