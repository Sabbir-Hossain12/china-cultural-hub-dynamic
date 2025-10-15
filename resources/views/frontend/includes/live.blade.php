<!-- The Lives of Ancient Chinese Start -->
<div class="our-features-gold">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">Content</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">{{ $live->title ?? '' }}</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Our Features List Start -->
                <div class="our-features-list-gold">
                    <!-- Our Features Item Start -->
                    <div class="our-features-item-gold">
                        <!-- Our Features Image Start -->
                        @isset($live->image_1)
                        <div class="our-features-image-gold">
                            <figure class="image-anime reveal">
                                <img src="{{ asset($live->image_1) }}" alt="">
                            </figure>
                        </div>
                        @endisset
                        <!-- Our Features Image End -->

                        <!-- Our Features Content Start -->
                        <div class="our-features-content-gold">
                            <div class="our-features-body-gold">
                                {!! $live->content_1 !!}
                            </div>
                            <div class="icon-box">
                                <img src="images/icon-our-features-1-gold.svg" alt="">
                            </div>
                        </div>
                        <!-- Our Features Content End -->
                    </div>
                    <!-- Our Features Item End -->

                    <!-- Our Features Item Start -->
                    <div class="our-features-item-gold">
                        <!-- Our Features Image Start -->
                        @isset($live->image_2)
                        <div class="our-features-image-gold">
                            <figure class="image-anime reveal">
                                <img src="{{ asset($live->image_2) }}" alt="">
                            </figure>
                        </div>
                        @endisset
                        <!-- Our Features Image End -->

                        <!-- Our Features Content Start -->
                        <div class="our-features-content-gold">
                            <div class="our-features-body-gold">
                         {!! $live->content_2 ?? '' !!}
                            </div>
                            <div class="icon-box">
                                <img src="images/icon-our-features-2-gold.svg" alt="">
                            </div>
                        </div>
                        <!-- Our Features Content End -->
                    </div>
                    <!-- Our Features Item End -->

                    <!-- Our Features Item Start -->
                    <div class="our-features-item-gold">
                        <!-- Our Features Image Start -->
                        @isset($live->image_3)
                        <div class="our-features-image-gold">
                            <figure class="image-anime reveal">
                                <img src="{{ asset($live->image_3) }}" alt="">
                            </figure>
                        </div>
                        @endisset
                        <!-- Our Features Image End -->

                        <!-- Our Features Content Start -->
                        <div class="our-features-content-gold">
                            <div class="our-features-body-gold">
                                {!! $live->content_3 !!}
                            </div>
                            <div class="icon-box">
                                <img src="images/icon-our-features-3-gold.svg" alt="">
                            </div>
                        </div>
                        <!-- Our Features Content End -->
                    </div>
                    <!-- Our Features Item End -->
                </div>
                <!-- Our Features List End -->
            </div>
        </div>

        <!-- About Us Footer Start -->
        <div class="about-us-footer-gold wow fadeInUp justify-content-center" data-wow-delay="0.8s">
            <!-- About Author Box Start -->
            <!-- About Author Box End -->

            <!-- About Us Button Start -->
            <div class="about-us-btn-gold">
                <a href="{{ route('lives') }}" class="btn-default">more about Ancient Chinese</a>
            </div>
            <!-- About Us Button End -->
        </div>
        <!-- About Us Footer End -->
    </div>
</div>
<!-- The Lives of Ancient Chinese End -->

