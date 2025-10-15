<!-- Migration and China's Social Changes Start -->
<div class="intro-video-gold dark-section parallaxie"
     style="background-image: url('https://images.slm.com.au/fotoweb/embed/2022/12/d10f663c206440ce8a196403f8d8cce3.jpg')">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">Content</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ $migration->title ?? '' }}</h2>

                </div>
                <!-- Section Title End -->

                <!-- Intro Video Button Start -->
                <div class="intro-video-button-gold">
                    <a href="{{ $migration->video ?? '' }}" class="popup-video"
                       data-cursor-text="Play">
                        <figure>
                            <img src="images/intro-video-circle-gold.svg" alt="">
                        </figure>

                        <div class="into-video-play-icon-gold">
                            <img src="images/intro-video-play-btn-gold.svg" alt="">
                        </div>
                    </a>
                </div>
                <!-- Intro Video Button End -->
            </div>
        </div>

        <div class="about-us-footer-gold wow fadeInUp justify-content-center" data-wow-delay="0.8s">
            <!-- About Author Box Start -->
            <!-- About Author Box End -->

            <!-- About Us Button Start -->
            <div class="about-us-btn-gold">
                <a href="{{ route('chinaMigration') }}" class="btn-default">more about Migration</a>
            </div>
            <!-- About Us Button End -->
        </div>
    </div>
</div>
<!-- Migration and China's Social Changes End -->


