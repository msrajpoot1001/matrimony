@php
    $company = DB::table('company_infos')->first();
    $frontend_content = DB::table('frontend_contents')->first();
@endphp
<style>
    .website_animation {
        background: linear-gradient(90deg,
                var(--orange-color), var(--green-color));
        background-size: 400% 400%;
        animation: floatingGradient 8s ease-in-out infinite;
    }

    /* Floating color animation */
    @keyframes floatingGradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }
</style>


<style>
    .header__bottom {
        padding-block: 0px !important;
    }

    .mainmenu ul li.active>a {
        /* text-decoration: line-through; */
        text-decoration: none;


    }

    .navbar {
        padding-top: 0rem !important;
        padding-bottom: 0rem !important;
    }

    .navbar-brand img {
        /* box-shadow: 0 10px 25px rgba(139, 0, 0, 0.1); */
        /* border-radius: 50px; */
    }

    .service_list i {
        color: var(--green-color);
    }

    .service_list li:hover i {
        color: #fff;
    }

    @media(min-width:991px) {
        .service_list {
            width: 20rem !important;
        }
    }

    @media(max-width:992px) {
        .my-account-btn {
            margin-bottom: 2rem;
        }
    }
</style>


{{-- modal css  --}}
<style>
    .service-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .service-card {
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 18px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        background: #fff;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--orange-color);
    }

    .service-card i {
        font-size: 32px;
        color: var(--green-color);
        margin-bottom: 10px;
        display: block;
    }

    .service-card h6 {
        margin: 0;
        font-size: 15px;
        font-weight: 600;
        color: #333;
    }

    .modal-header {
        border-bottom: none;
        justify-content: center;
    }

    .modal-title {
        font-weight: 700;
        font-size: 20px;
    }

    .modal-content {
        border-radius: 16px;
        padding: 10px;
    }

    @media (max-width: 576px) {
        .service-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<style>
    .my-account-link {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 14px 28px;
        border-radius: 999px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        background: linear-gradient(135deg, #25D366, #1ebe5d);
        color: #fff;
        box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
        transition: all .3s ease;
        position: relative;
        overflow: hidden;
        margin-left: 1rem;
    }

    /* Hover effect */
    .my-account-link:hover,
    {
    transform: translateY(-3px);
    box-shadow: 0 16px 36px rgba(37, 211, 102, 0.45);
    color: #fff !important;
    }

    .my-account-link:hover span {
        box-shadow: 0 16px 36px rgba(37, 211, 102, 0.45);
        color: #fff !important;
    }


    .my-account-link:hover i {
        box-shadow: 0 16px 36px rgba(37, 211, 102, 0.45);
        color: #fff !important;
    }

    /* WhatsApp Icon */
    .my-account-link i {
        font-size: 20px;
    }

    /* Text */
    .my-account-link span {
        white-space: nowrap;
    }

    /* Subtle shine animation */
    .my-account-link::after {
        content: '';
        position: absolute;
        top: 0;
        left: -60%;
        width: 50%;
        height: 100%;
        background: linear-gradient(120deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent);
        transform: skewX(-20deg);
    }

    .my-account-link:hover::after {
        animation: shine 0.8s ease;
    }

    @keyframes shine {
        100% {
            left: 130%;
        }
    }

    /* Click feedback */
    .my-account-link:active {
        transform: scale(0.96);
    }


    /* Disable sticky / fixed header */
    #navbar {
        position: relative !important;
        top: auto !important;
        z-index: auto !important;
    }

    /* reverse of it  */
    /* #navbar {
        position: fixed !important;
        top: 0 !important;
        left: 0;
        width: 100%;
        z-index: 9999 !important;
    } */
</style>

<style>
    .service-mega-menu-li {
        padding-bottom: 1rem;
    }

    .service-mega-menu {
        width: 900px !important;
        height: auto !important;
        left: -500px !important;

        background: linear-gradient(90deg,
                var(--orange-color), var(--green-color)) !important;

        background-size: 400% 400% !important;
        animation: floatingGradient 8s ease-in-out infinite;
        border-radius: 14px;
        padding: 15px;
    }


    .service-mobile-view {
        display: none !important;
    }

    .service-laptop-view {
        display: absolute !important;
    }

    @media (max-width: 992px) {
        .service-mobile-view {
            display: block !important;
        }

        .service-laptop-view {
            display: none !important;
        }
    }

    @media (min-width: 992px) {

        .navbar-list-item {
            /* border: 1px solid red; */
        }

        .navbar-list-item li a {
            /* border: 1px solid blue; */
            margin-bottom: -1.7rem !important;
        }

        .mainmenu ul li a {
            padding-left: 20px !important;
            padding-right: 20px !important
        }
    }



    .service-mega-menu li a {
        margin: 1rem 0.5rem !important;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(255, 255, 255, 0.3);
        background: white !important;
        display: flex !important;
        align-items: center !important;
        justify-content: start !important;
        flex-direction: row !important;
    }

    .service-mega-menu li a i {
        font-size: 2rem !important;
        margin-right: 0.5rem !important;
    }

    .service-mega-menu li a:hover {
        color: black !important;
    }

    .service-mega-menu li a:hover i {
        color: var(--orange-color) !important;
    }

    .my-account-btn-new {
        background-color: transparent !important;
        color: black !important;
        font-weight: 500 !important;
    }

    /* Default: closed */
    .service-mega-menu-li .icon-up {
        display: none;
    }

    /* When menu is open (hover) */
    .service-mega-menu-li:hover .icon-down {
        display: none;
    }

    .service-mega-menu-li:hover .icon-up {
        display: inline-block;
    }

    .services_anchor::before,
    .services_anchor::after {
        content: none !important;
    }

    @media(min-width:993px) and (max-width:1200px) {
        .astro-products {
            display: none;
        }
    }
</style>
<style>
    /* Facebook */
    .social-links li.facebook i {
        color: #1877f2;
        font-weight: bold;
    }

    .social-links li.facebook a {
        color: #1877f2;
    }

    /* Instagram */
    .social-links li.instagram i {
        color: #e1306c;
        font-weight: bold;
    }

    .social-links li.instagram a {
        color: #e1306c;
    }

    /* Twitter / X */
    .social-links li.twitter i {
        color: #1da1f2;
        font-weight: bold;
    }

    .social-links li.twitter a {
        color: #1da1f2;
    }

    /* YouTube */
    .social-links li.youtube i {
        color: #ff0000;
        font-weight: bold;
    }

    .social-links li.youtube a {
        color: #ff0000;
    }

    /* LinkedIn */
    .social-links li.linkedin i {
        color: #0a66c2;
        font-weight: bold;
    }

    .social-links li.linkedin a {
        color: #0a66c2;
    }

    /* Pinterest */
    .social-links li.pinterest i {
        color: #bd081c;
        font-weight: bold;
    }

    .social-links li.pinterest a {
        color: #bd081c;
    }

    /* Common anchor style */
    .social-links li a {
        font-weight: normal;
        background: white !important;
        padding: 0.2rem 0.5rem;
        border-radius: 10px
    }
</style>

<style>
    .top-header li a {
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .top-header li a:hover {
        color: #25D366;
        /* WhatsApp green or change as needed */
    }

    .google_map_link {
        display: inline-flex;
        align-items: center;
        border-radius: 30px;

        color: #e63946;
        font-weight: 500;
        text-decoration: none;

        transition: all 0.3s ease;
        background: var(--green-color);
        padding: 0.2rem 0.5rem;

    }

    .google_map_link i {
        font-size: 16px;
    }

    .google_map_link:hover {
        background-color: var(--orange-color);
        border: 1px solid var(--green-color);
        color: #fff;
        transform: translateY(-2px);

    }

    .google_map_link:hover i {
        color: #fff;
    }

    .google_map_link:hover span {
        color: #fff;
    }

    .google_map_link span,
    .google_map_link i {
        font-size: 0.8rem !important;
    }

    .social-links a {
        position: relative;
        display: inline-block;
        color: #555;
        overflow: hidden;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    /* Shine layer */
    .social-links a::before {
        content: "";
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: linear-gradient(120deg,
                transparent,
                rgba(255, 255, 255, 0.6),
                transparent);
        transform: skewX(-20deg);
    }

    /* Hover effects */
    .social-links a:hover {
        color: #1877f2;
        transform: translateX(4px);
    }

    /* Animate shine */
    .social-links a:hover::before {
        animation: shine 0.75s ease-in-out;
    }

    /* Keyframes */
    @keyframes shine {
        0% {
            left: -75%;
        }

        100% {
            left: 125%;
        }
    }
</style>


<script>
    window.addEventListener("scroll", function() {
        const header = document.querySelector("header");

        if (window.innerWidth > 993 && window.scrollY > 100) {
            header.style.marginTop = "-2rem";
        } else {
            header.style.marginTop = "0";
        }
    });
</script>



<!-- preloader start here -->
{{-- <div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div> --}}
<!-- preloader ending here -->





<!-- scrollToTop start here -->
<a href="#" class="scrollToTop"><i class="fa-solid fa-angle-up"></i></a>
<!-- scrollToTop ending here -->


<!-- ================> header section start here <================== -->
<header class="header " id="navbar">

    {{-- website_animation --}}
    <div class="header__top d-none d-lg-block " style="background: var(2)">
        <div class="container">
            <div class="header__top--area">
                <div class="header__top--left">
                    <ul class="top-header">
                        <li>
                            <a href="tel:{{ $company->phone1 }}">
                                <i class="fa-solid fa-phone"></i>
                                <span>{{ $company->phone1 }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="tel:{{ $company->phone2 }}">
                                <i class="fa-solid fa-phone"></i>
                                <span>{{ $company->phone2 }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $company->phone3) }}" target="_blank">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>{{ $company->phone3 }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ $company->google_map_link }}" target="_blank" class="google_map_link">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>Locate Us</span>
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="header__top--right">
                    <ul class="social-links">

                        @if (!empty($company->facebook))
                            <li class="facebook">
                                <a href="{{ $company->facebook }}" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-facebook-f"></i> Facebook
                                </a>
                            </li>
                        @endif

                        @if (!empty($company->instagram))
                            <li class="instagram">
                                <a href="{{ $company->instagram }}" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-instagram"></i> Instagram
                                </a>
                            </li>
                        @endif

                        @if (!empty($company->twitter))
                            <li class="twitter">
                                <a href="{{ $company->twitter }}" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-twitter"></i> Twitter
                                </a>
                            </li>
                        @endif

                        @if (!empty($company->youtube))
                            <li class="youtube">
                                <a href="{{ $company->youtube }}" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-youtube"></i> YouTube
                                </a>
                            </li>
                        @endif

                        @if (!empty($company->linkedin))
                            <li class="linkedin">
                                <a href="{{ $company->linkedin }}" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-linkedin-in"></i> LinkedIn
                                </a>
                            </li>
                        @endif

                        @if (!empty($company->pinterest))
                            <li class="pinterest">
                                <a href="{{ $company->pinterest }}" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-pinterest-p"></i> Pinterest
                                </a>
                            </li>
                        @endif

                    </ul>

                </div>

            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">

                <a class="navbar-brand wow fadeInLeft" href="{{ route('home') }}"><img
                        src="{{ asset($company->logo ?? 'assets/images/logo/logo.png') }}" alt="logo"
                        style="height:7rem"></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler--icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav mainmenu">
                        <ul class="navbar-list-item">
                            {{-- class="active" --}}
                            <li><a href="{{ route('home') }}">Home</a></li>


                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('membership') }}"> Membership</a></li>
                            <li><a href="{{ route('astro.products') }}" class="astro-products"> Prajapati Divine Astro
                                    Products</a></li>
                            <li class="service-mobile-view">
                                <a href="#0">Services</a>
                                <ul class="service_list">
                                    <li><a href="{{ route('service.match.making') }}"><i class="fa-solid fa-heart"></i>
                                            Match Making
                                            Service</a></li>
                                    <li><a href="comingsoon.html"><i class="fa-solid fa-star"></i> Astrology Service</a>
                                    </li>
                                    <li><a href="comingsoon.html"><i class="fa-solid fa-gopuram"></i> Mandap Service</a>
                                    </li>
                                    <li><a href="comingsoon.html"><i class="fa-solid fa-pray"></i> Priest/Pandit
                                            Service</a></li>
                                    <li><a href="comingsoon.html"><i class="fa-solid fa-utensils"></i> Food and Catering
                                            Service</a></li>
                                    <li><a href="comingsoon.html"><i class="fa-solid fa-calendar-check"></i> Event
                                            Management</a></li>
                                    <li><a href="comingsoon.html"><i class="fa-solid fa-book-open"></i> Learning and
                                            Training of Karma Kandas</a></li>
                                    <li><a href="comingsoon.html"><i class="fas fa-ring"></i> Wish to contribute for a
                                            Happy
                                            marriage of Financially Backward Family</a></li>
                                    <li><a href="comingsoon.html"><i class="fas fa-om"></i> Wishing To Perform
                                            Kanyadan</a>
                                </ul>


                            </li>
                            <li class="service-mega-menu-li service-laptop-view">
                                <a href="#" class="services_anchor">
                                    Services
                                    <i class="fa-solid fa-angle-down icon-down"></i>
                                    <i class="fa-solid fa-angle-up icon-up"></i>
                                </a>

                                {{-- website_animation --}}
                                <ul class="service_list service-mega-menu " style="padding:0px!important">
                                    <div class=""
                                        style="display:grid!important;grid-template-columns: repeat(2, 1fr) !important;padding:1rem;background: var(--primary-color4)">
                                        <li><a href="{{ route('service.match.making') }}"
                                                style="padding: 1rem 0.5rem !important;"><i
                                                    class="fa-solid fa-heart"></i>
                                                Match Making
                                                Service</a></li>
                                        <li><a href="comingsoon.html" style="padding: 1rem 0.5rem !important;"><i
                                                    class="fa-solid fa-star"></i> Astrology Service</a>
                                        </li>
                                        <li><a href="comingsoon.html" style="padding: 1rem 0.5rem !important;"><i
                                                    class="fa-solid fa-gopuram"></i> Mandap Service</a>
                                        </li>
                                        <li><a href="comingsoon.html" style="padding: 1rem 0.5rem !important;"><i
                                                    class="fa-solid fa-pray"></i> Priest/Pandit
                                                Service</a></li>
                                        <li><a href="comingsoon.html" style="padding: 1rem 0.5rem !important;"><i
                                                    class="fa-solid fa-utensils"></i> Food and Catering
                                                Service</a></li>
                                        <li><a href="comingsoon.html" style="padding: 1rem 0.5rem !important;"><i
                                                    class="fa-solid fa-calendar-check"></i> Event
                                                Management</a></li>
                                        <li><a href="comingsoon.html" style="padding: 1rem 0.5rem !important;"><i
                                                    class="fa-solid fa-book-open"></i> Learning and
                                                Training of Karma Kandas</a></li>
                                        <li><a href="comingsoon.html" style="padding: 1rem 0.5rem !important;"><i
                                                    class="fas fa-ring"></i> Wish to contribute for a Happy
                                                marriage of Financially Backward Family</a></li>
                                        <li><a href="comingsoon.html" style="padding: 1rem 0.5rem !important;"><i
                                                    class="fas fa-om"></i> Wishing To Perform Kanyadan</a>
                                        </li>
                                    </div>
                                </ul>


                            </li>

                            <li><a href="{{ route('contact') }}">contact</a></li>

                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#serviceModal"
                                    style="color: var(--green-color)" class="text-gradient-color">Sign In |
                                    Sign Up <i class="fa-solid fa-user"></i>
                                </a></li>

                        </ul>
                    </div>
                    <div class="header__more">
                        {{-- <button class="default-btn dropdown-toggle my-account-btn" type="button" id="moreoption"
                            data-bs-toggle="dropdown" aria-expanded="false">My Account</button> --}}
                        {{-- <button class=" dropdown-toggle my-account-btn my-account-btn-new" type="button"
                            id="moreoption" data-bs-toggle="dropdown" aria-expanded="false">Sign In | Sign
                            Up</button>
                        <ul class="dropdown-menu" aria-labelledby="moreoption">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Log In</a></li>
                            <li><a class="dropdown-item" href="register.html" class="default-btn"
                                    data-bs-toggle="modal" data-bs-target="#serviceModal">Sign Up</a></li>
                        </ul> --}}
                    </div>

                    {{-- <a href="https://wa.me/{{ $company->phone1 }}" class="default-btn my-account-link"
                        aria-label="Chat with us on WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>How Can I Help You?</span>
                    </a> --}}



                </div>
            </nav>
        </div>
    </div>
</header>
<!-- ================> header section end here <================== -->



<div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        {{-- website_animation --}}
        <div class="modal-content " style="background: var(--primary-color4)">

            <div class="modal-header">
                <h5 class="modal-title" style="color:white">Register For ? <a href="{{ route('login') }}"
                        style="text-decoration: underline;color:white">Login</a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="service-grid">

                    <a href="{{ route('match.making.create') }}" class="service-card">
                        <i class="fas fa-heart"></i>
                        <h6>Match Making Service</h6>
                    </a>

                    <a href="{{ route('astrology.create') }}" class="service-card">
                        <i class="fas fa-star"></i>
                        <h6>Astrology Service</h6>
                    </a>

                    <a href="{{ route('mandap.create') }}" class="service-card">
                        <i class="fas fa-gopuram"></i>
                        <h6>Mandap Service</h6>
                    </a>

                    <a href="{{ route('pandit.create') }}" class="service-card">
                        <i class="fas fa-om"></i>
                        <h6>Priest / Pandit Service</h6>
                    </a>

                    <a href="{{ route('food.catering.create') }}" class="service-card">
                        <i class="fas fa-utensils"></i>
                        <h6>Food & Catering</h6>
                    </a>

                    <a href="{{ route('event.management.create') }}" class="service-card">
                        <i class="fas fa-calendar-check"></i>
                        <h6>Event Management</h6>
                    </a>

                    <a href="{{ route('karma.training.create') }}" class="service-card">
                        <i class="fas fa-book-open"></i>
                        <h6>Karma Kanda Training</h6>
                    </a>

                    <a href="{{ route('support.create') }}" class="service-card">
                        <i class="fas fa-ring"></i>
                        <h6>Wish to contribute for a Happy marriage of Financially Backward Family</h6>
                    </a>

                    <a href="{{ route('perform.kanyadan.create') }}" class="service-card">
                        <i class="fas fa-om"></i>
                        <h6>Wishing To Perform Kanyadan</h6>
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>



@if ($frontend_content->chat_bot)
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6958f32ed51646197ecbb734/1je1nbrq0';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
@endif
