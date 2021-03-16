<!-- header -->
<header class="site-header" id="header">
    <nav class="navbar navbar-expand-lg transparent-bg static-nav">
        <div class="container">
            <a class="navbar-brand" href="index-logistic.html">
                <img src="{{ static_asset('themes/dark/frontend/logistic/images/logo-transparent.png')}}" alt="logo" class="logo-default">
                <img src="{{ static_asset('themes/dark/frontend/logistic/images/logo-transparent.png')}}" alt="logo" class="logo-scrolled">
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Home </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="index-logistic.html">Standard Layout</a>
                            <a class="dropdown-item" href="logistic/index-video.html">Video Background</a>
                            <a class="dropdown-item" href="logistic/index-light.html">Light Version</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logistic/about.html">About</a>
                    </li>
                    <li class="nav-item dropdown static">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Pages </a>
                        <ul class="dropdown-menu megamenu">
                            <li>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <h5 class="dropdown-title bottom10"> General </h5>
                                            <a class="dropdown-item" href="logistic/services.html">Services</a>
                                            <a class="dropdown-item" href="logistic/services-detail.html">Service Detail</a>
                                            <a class="dropdown-item" href="logistic/testimonial.html">Testimonials</a>
                                            <a class="dropdown-item" href="logistic/contact.html">Contact Us</a>
                                            <a class="dropdown-item" href="logistic/team.html">Our Team</a>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <h5 class="dropdown-title opacity-10"> Others </h5>
                                            <a class="dropdown-item" href="logistic/work.html">Work</a>
                                            <a class="dropdown-item" href="logistic/work-detail.html">Work Detail</a>
                                            <a class="dropdown-item" href="logistic/pricing.html">Pricing</a>
                                            <a class="dropdown-item" href="logistic/404.html">404 Error</a>
                                            <a class="dropdown-item" href="logistic/coming-soon.html">Coming Soon</a>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <h5 class="dropdown-title bottom10"> Account </h5>
                                            <a class="dropdown-item" href="logistic/login.html">Login</a>
                                            <a class="dropdown-item" href="logistic/register.html">Register</a>
                                            <a class="dropdown-item" href="logistic/reset-password.html">Reset Password</a>
                                            <a class="dropdown-item" href="logistic/faq.html">FAQ's</a>
                                            <a class="dropdown-item" href="logistic/support.html">Support</a>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <h5 class="dropdown-title bottom10"> Shop Pages </h5>
                                            <a class="dropdown-item" href="logistic/shop.html">Shop</a>
                                            <a class="dropdown-item" href="logistic/shop-detail.html">Shop Detail</a>
                                            <a class="dropdown-item" href="logistic/shop-cart.html">Shopping Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> News </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="logistic/news-1.html">News List</a>
                            <a class="dropdown-item" href="logistic/news-2.html">News Sidebar</a>
                            <a class="dropdown-item" href="logistic/news-detail.html">News Details</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logistic/work.html">Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logistic/contact.html">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--side menu open button-->
        <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
            <span></span> <span></span> <span></span>
        </a>
    </nav>
    <!-- side menu -->
    <div class="side-menu opacity-0 bg-yellow">
        <div class="overlay"></div>
        <div class="inner-wrapper">
            <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>
            <nav class="side-nav w-100">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsePagesSideMenu" data-toggle="collapse" href="#sideNavPages1">
                            Home <i class="fas fa-chevron-down"></i>
                        </a>
                        <div id="sideNavPages1" class="collapse sideNavPages">
                            <ul class="navbar-nav mt-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="index-logistic.html">Standard Layout</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/index-video.html">Video Background</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/index-light.html">Light Version</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logistic/about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsePagesSideMenu" data-toggle="collapse" href="#sideNavPages2">
                            News <i class="fas fa-chevron-down"></i>
                        </a>
                        <div id="sideNavPages2" class="collapse sideNavPages">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="logistic/news-1.html">News List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/news-2.html">News Sidebar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/news-detail.html">News Details</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logistic/work.html">Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsePagesSideMenu" data-toggle="collapse" href="#sideNavPages">
                            Pages <i class="fas fa-chevron-down"></i>
                        </a>
                        <div id="sideNavPages" class="collapse sideNavPages">
                            <ul class="navbar-nav mt-2">
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/team.html">Our Team</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/services.html">Service</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/services-detail.html">Service Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/testimonial.html">Testimonials</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/work.html">Work</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/work-detail.html">Work Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/pricing.html">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/404.html">Error 404</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logistic/coming-soon.html">Coming Soon</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link collapsePagesSideMenu" data-toggle="collapse" href="#inner-2">
                                        Account <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <div id="inner-2" class="collapse sideNavPages sideNavPagesInner">
                                        <ul class="navbar-nav mt-2">
                                            <li class="nav-item">
                                                <a class="nav-link" href="logistic/login.html">Login</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="logistic/register.html">Register</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="logistic/reset-password.html">Forget Password</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="logistic/faq.html">FAQ's</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="logistic/support.html">Support</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link collapsePagesSideMenu" data-toggle="collapse" href="#inner-1">
                                        Shop <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <div id="inner-1" class="collapse sideNavPages sideNavPagesInner">
                                        <ul class="navbar-nav mt-2">
                                            <li class="nav-item">
                                                <a class="nav-link" href="logistic/shop.html">Shop Products</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="logistic/shop-detail.html">Shop Detail</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="logistic/shop-cart.html">Shop Cart</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logistic/contact.html">Contact</a>
                    </li>
                </ul>
            </nav>
            <div class="side-footer w-100">
                <ul class="social-icons-simple white top40">
                    @foreach (setting()->get('social_links_name') as $key => $social_link_name)
                        @if($social_link_name || setting()->get('social_links_icon')[$key])
                            <li><a href="{{setting()->get('social_links_name')[$key]}}" class=""><i class="{{setting()->get('social_links_icon')[$key]}}"></i> </a> </li>
                        @endif
                    @endforeach
                </ul>
                <p class="whitecolor">&copy; 2019 MegaOne. Made With Love by ThemesIndustry</p>
            </div>
        </div>
    </div>
    <div id="close_side_menu" class="tooltip"></div>
    <!-- End side menu -->
</header>
<!-- header -->