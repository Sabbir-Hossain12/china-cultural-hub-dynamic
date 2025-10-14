<!-- Hero Start -->
<div class="hero-gold dark-section parallaxie"
     style="background-image: url('{{ asset($hero->image) }}');
      background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Hero Content Start -->
                <div class="hero-content-gold">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Welcome to China Cultural HUb </h3>
                        <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $hero->title }}</h1>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $hero->text }}</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Hero Button Start -->
                    <div class="hero-btn-gold wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ $hero->btn_link }}" class="btn-default btn-highlighted">Explore China</a>
                        <a href="#" class="btn-default hero-video-btn">Watch Cultural Video</a>
                    </div>
                    <!-- Hero Button End -->
                </div>
                <!-- Hero Content End -->
            </div>
        </div>
    </div>

    <!-- Down Arrow Start -->
    <div class="down-arrow-gold">
        <a href="#about-us">
            <img src="images/arrow-white.svg" alt="">
        </a>
    </div>
    <!-- Down Arrow End -->
</div>
<!-- Hero End -->

