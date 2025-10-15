<!-- Collision Between China and the West Start-->
<div class="about-us-gold" id="about-us3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- About Us Content Start -->
                <div class="about-us-content-gold">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Content</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">{{ $political->title ?? '' }} </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">{{ $political->short_desc ?? '' }}</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- About Us Footer Start -->
                    <div class="about-us-footer-gold wow fadeInUp" data-wow-delay="0.8s">
                        <!-- About Author Box Start -->
                        <!-- About Author Box End -->

                        <!-- About Us Button Start -->
                        <div class="about-us-btn-gold">
                            <a href="{{ route('political') }}" class="btn-default">more about Politics</a>
                        </div>
                        <!-- About Us Button End -->
                    </div>
                    <!-- About Us Footer End -->
                </div>
                <!-- About Us Content End -->
            </div>
            <div class="col-lg-6">
                <!-- About Us Images Start -->
                <div class="about-us-images-gold">

                    <!-- Group for first two images -->
                    <div class="about-image-counter-gold">
                        @foreach(json_decode($political->images, true) as $key => $img)
                            @if($key < 2) {{-- First two images --}}
                            <div class="about-img-1-gold">
                                <figure class="image-anime reveal">
                                    <img src="{{ asset($img) }}" alt="">
                                </figure>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Third image (separate section) -->
                    @php
                        $images = json_decode($political->images, true);
                    @endphp
                    @if(!empty($images) && isset($images[2]))
                        <div class="about-img-2-gold">
                            <figure class="image-anime reveal">
                                <img src="{{ asset($images[2]) }}" alt="">
                            </figure>
                        </div>
                    @endif

                </div>
                <!-- About Us Images End -->
            </div>
        </div>
    </div>
</div>
<!-- Collision Between China and the West End -->


