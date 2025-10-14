<!-- Footer Start -->
<footer class="main-footer-gold bg-section dark-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <!-- Footer Header Start -->
                <div class="footer-header-gold">
                    <!-- Section Title Start -->
                    <div class="section-title footer-newsletter-title-gold">
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Helpful link, contact, hours & more
                            below</h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- Footer Contact Circle Start -->
                    <div class="footer-contact-circle-gold">
                        <a href="#"><img src="images/contact-now-circle-gold.svg" alt=""></a>
                    </div>
                    <!-- Footer Contact Circle End -->
                </div>
                <!-- Footer Header End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12">
                <!-- About Footer Start -->
                <div class="about-footer-gold">
                    <!-- Footer Logo Start -->
                    <div class="footer-logo-gold">
                        <!--                        <img src="images/logo.svg" alt="">-->
                        <h3 class="text-light">China Cultural Hub</h3>
                    </div>
                    <!-- Footer Logo End -->

                    <!-- About Footer Content Start -->
                    <div class="about-footer-content-gold">
                        <p>{{ $settings->about_text ?? '' }}</p>
                    </div>
                    <!-- About Footer Content End -->

                    <!-- Footer Social Link Start -->
                    <div class="footer-social-links-gold">
                        <ul>
                            <li><a href="{{ $settings->youtube_link ?? '' }}"><i class="fa-brands fa-bilibili"></i></a></li>
                            <li><a href="{{ $settings->twitter_link ?? '' }}"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="{{ $settings->fb_link ?? '' }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="{{ $settings->insta_link }}"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!-- Footer Social Link End -->
                </div>
                <!-- About Footer End -->
            </div>

            <div class="col-lg-8">
                <!-- Footer Links Box Start -->
                <div class="footer-links-box-gold">
                    <!-- Footer Links Start -->
                    <div class="footer-links-gold quick-links-gold">
                        <h3>quick link</h3>
                        <ul>
                            @forelse($usefulls as $page)
                                <li><a href="{{ route('page',$page->slug) }}">{{ $page->title ?? '' }}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    <!-- Footer Links End -->

                    <!-- Footer Links Start -->
                    <div class="footer-links-gold service-links-gold">
                        <h3>Topics</h3>
                        <ul>
                            @forelse($topics as $category)
                                <li>
                                    <a href="{{ route('categoryDetails',$category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                    <!-- Footer Links End -->

                    <!-- Footer Links Start -->
                    <div class="footer-links-gold">
                        <h3>get in touch</h3>
                        <!-- Footer Contact Item Start -->
                        <div class="footer-contact-item-gold">
                            <div class="icon-box">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="footer-contact-content-gold">
                                <p><a href="tel:{{ $settings->phone_1 ?? '' }}">{{ $settings->phone_1 ?? '' }}</a></p>
                            </div>
                        </div>
                        <!-- Footer Contact Item End -->

                        <!-- Footer Contact Item Start -->
                        <div class="footer-contact-item-gold">
                            <div class="icon-box">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="footer-contact-content-gold">
                                <p><a href="mailto:{{ $settings->mail }}">{{ $settings->mail ?? '' }}/a></p>
                            </div>
                        </div>
                        <!-- Footer Contact Item End -->

                        <!-- Footer Contact Item Start -->
                        <div class="footer-contact-item-gold">
                            <div class="icon-box">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="footer-contact-content-gold">
                                <p>{{ $settings->address ?? '' }}</p>
                            </div>
                        </div>
                        <!-- Footer Contact Item End -->
                    </div>
                    <!-- Footer Links End -->
                </div>
                <!-- Footer Links Box End -->
            </div>

            <div class="col-lg-12">
                <!-- Footer Copyright Section Start -->
                <div class="footer-copyright-gold">
                    <!-- Footer Copyright Text Start -->
                    <div class="footer-copyright-text-gold">
                        <p>{{ $settings->copyright_text ?? '' }}</p>
                    </div>
                    <!-- Footer Copyright Text End -->

                    <!-- Footer Privacy Policy Start -->

                    <!-- Footer Privacy Policy End -->
                </div>
                <!-- Footer Copyright Section End -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->
