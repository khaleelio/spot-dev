<!--Site Footer Here-->
<footer id="site-footer" class=" bgprimary padding_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer_panel padding_bottom_half bottom20">
                    <a href="index-logistic.html" class="footer_logo bottom25"><img src="@if(setting()->get('main_footer_logo')) {{asset('/storage/app/public/'. setting()->get('main_footer_logo') )}} @else {{ static_asset('themes/dark/frontend/logistic/images/logo-transparent.png')}} @endif" alt="MegaOne"></a>
                    <p class="whitecolor bottom25">Keep away from people who try to belittle your ambitions Small people always do that but the really great Friendly.</p>
                    <div class="d-table w-100 address-item whitecolor bottom25">
                        <span class="d-table-cell align-middle"><i class="fas fa-mobile-alt"></i></span>
                        <p class="d-table-cell align-middle bottom0">
                            +01 - 123 - 4567 <a class="d-block" href="mailto:web@support.com">web@support.com</a>
                        </p>
                    </div>
                    <ul class="social-icons white wow fadeInUp" data-wow-delay="300ms">
                        @foreach (setting()->get('main_social_links_name') as $key => $social_link_name)
                            @if($social_link_name || setting()->get('main_social_links_icon')[$key])
                                <li><a href="{{setting()->get('main_social_links_name')[$key]}}" target="_blank" class=""><i class="{{setting()->get('main_social_links_icon')[$key]}}"></i> </a> </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer_panel padding_bottom_half bottom20">
                    <h3 class="whitecolor bottom25">Latest News</h3>
                    <ul class="latest_news whitecolor">
                        <li> <a href="#.">Aenean tristique justo et... </a> <span class="date defaultcolor">15 March 2019</span> </li>
                        <li> <a href="#.">Phasellus dapibus dictum augue... </a> <span class="date defaultcolor">15 March 2019</span> </li>
                        <li> <a href="#.">Mauris blandit vitae. Praesent non... </a> <span class="date defaultcolor">15 March 2019</span> </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer_panel padding_bottom_half bottom20 pl-0 pl-lg-5">
                    <h3 class="whitecolor bottom25">Our Services</h3>
                    <ul class="links">
                        <li><a href="index-logistic.html">Home</a></li>
                        <li><a href="logistic/about.html">About Us</a></li>
                        <li><a href="logistic/news-1.html">Latest News</a></li>
                        <li><a href="logistic/pricing.html">Business Planning</a></li>
                        <li><a href="logistic/contact.html">Contact Us</a></li>
                        <li><a href="logistic/faq.html">Faq's</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer_panel padding_bottom_half bottom20">
                    <h3 class="whitecolor bottom25">Business hours</h3>
                    <p class="whitecolor bottom25">Our support available to help you 24 hours a day, seven days week</p>
                    <ul class="hours_links whitecolor">
                        <li><span>Monday-Saturday:</span> <span>8.00-18.00</span></li>
                        <li><span>Friday:</span> <span>09:00-21:00</span></li>
                        <li><span>Sunday:</span> <span>09:00-20:00</span></li>
                        <li><span>Calendar Events:</span> <span>24-Hour Shift</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="py-4 d-flex flex-lg-column" style="color: white">
            <!--begin::Container-->
            <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!--begin::Copyright-->
                <div class="order-2 order-md-1">
                    {!! setting()->get('main_footer_copy_right') ?? '' !!}
                </div>
                <!--end::Copyright-->
                <!--begin::Nav-->
                <div class="nav nav-dark">
                    {!! setting()->get('main_designed_by') ?? '' !!}
                </div>
                <!--end::Nav-->
            </div>
            <!--end::Container-->
        </div>
    </div>
</footer>
<!--Footer ends-->