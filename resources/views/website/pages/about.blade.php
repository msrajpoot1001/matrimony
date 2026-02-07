@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Home | Client Business Name
@endsection

{{-- meta description  --}}
@section('meta_description')
    This is the description for this page.
@endsection

{{-- meta keywords --}}
@section('meta_keywords')
    keyword1, keyword2, keyword3
@endsection


{{-- custom csss  --}}
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <style>
        .about-section {
            padding: 80px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
        }


        .about-wrapper {
            display: flex;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        /* Image Styling */
        .about-image {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .about-image img {
            width: 100%;
            /* border-radius: 20px; */

            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* EXPERIENCE BADGE */
        .experience-badge {
            position: absolute;
            bottom: 25px;
            left: 25px;
            background: var(--primary-color4);
            /* background: var(--orange-color); */
            color: #fff;
            padding: 18px 22px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(177, 18, 38, 0.4);
        }

        /* Text Styling */
        .about-content {
            flex: 1;
            min-width: 300px;
        }

        .sub-title {
            color: var(--primary-color);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 10px;
        }

        .about-content h2 {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .about-content p {
            color: var(--text-color);
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* List & Stats */
        .features-list {
            list-style: none;
            padding: 0;
            margin-bottom: 30px;
        }

        .features-list li {
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .check-icon {
            color: var(--primary-color);
            margin-right: 10px;
        }

        .stats-container {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
            border-top: 1px solid #eee;
            padding-top: 25px;
        }

        .stat-item h3 {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin: 0;
        }

        /* Button */
        .btn-primary {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 15px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(233, 30, 99, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .about-wrapper {
                flex-direction: column;
                text-align: center;
            }

            .stats-container {
                justify-content: center;
            }
        }
    </style>
    <style>
        .swiper-button-next:after,
        .swiper-rtl .swiper-button-prev:after {
            color: var(--primary-color);
        }

        .swiper-button-prev:after,
        .swiper-rtl .swiper-button-next:after {
            color: var(--primary-color);
        }

        .story__thumb span {
            background-color: var(--primary-color) !important;
            background-image: none !important;
        }

        .bg-blur {
            position: relative;
            overflow: hidden;
        }

        .bg-blur::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("assets/images/about/app-bg.png");
            background-size: auto;
            background-repeat: no-repeat;
            background-position: center;
            /* filter: blur(1px); */
            transform: scale(1.1);
            /* prevents edge cut */
            z-index: 0;
        }

        .bg-blur .content {
            position: relative;
            z-index: 1;
        }
    </style>
    <style>
        .pageheader {
            padding-block: 0px !important;
        }
    </style>
    <style>
        .app-download-section {
            padding: 70px 0;
            background: #ffffff;
        }

        .app-container {
            margin: auto;
            display: flex;
            /* grid-template-columns: 1fr 1fr; */
            gap: 10px;
            padding: 0 20px;

            justify-content: center;
            /* horizontal */
            align-items: center;
            /* vertical */
        }

        .app-image {
            /* border: 1px solid red; */
            flex: 1;
            display: flex;
            align-items: flex-end;
            justify-content: center;

        }

        /* Image */
        .app-image img {
            width: 300px;
            max-width: 100%;
            /* box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); */
        }

        .app-content {
            flex: 1;
            padding-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: start;
            flex-direction: column;
            /* border: 1px solid red; */
        }

        .app-content span.app-tag {
            display: inline-block;
            /* background: var(--primary-color2); */
            /* background: #213366; */
            /* color: #fff; */
            padding: 4px 14px;
            border-radius: 6px;
            /* not full round like button */
            font-size: 1.3rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
            font-weight: bold;

            /* box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2); */
        }


        .app-content h2 {
            font-size: 36px;
            margin: 10px 0;
            color: #222;
        }

        .app-content p {
            color: #555;
            line-height: 1.6;
            max-width: 500px;
        }

        /* Buttons */
        .store-buttons {
            display: flex;
            gap: 20px;
            margin-top: 25px;
        }

        .store-buttons img {
            /* border: 1px solid red; */
            height: 5rem;
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .store-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 22px;
            border-radius: 8px;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }

        .store-btn.apple {
            /* background: #000; */
        }

        .store-btn.google {
            /* background: #1aa260; */
        }

        /* Responsive */
        @media (max-width: 768px) {
            .app-container {
                flex-direction: column;
                text-align: center;
            }

            .store-buttons {
                justify-content: center;
                flex-wrap: wrap;
            }
        }

        @media (max-width: 992px) {
            .app-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <style>
        .company-sec {
            padding: 6rem 0px;
        }

        .logo-showing {
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            /* vertical center */
            align-items: center !important;
            /* horizontal center */
        }

        .logo-showing img {
            margin-bottom: 2rem;
        }


        .view-profile-btn {
            border: 1px solid var(--orange-color) !important;
            color: var(--orange-color) !important;
        }

        .view-profile-btn:hover {
            color: white !important;
            background: var(--orange-color) !important;
        }

        .partner-sec .about__thumb img {
            border: 4px solid var(--orange-color);
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
    </style>

    <style>
        .about-main {
            padding: 80px 0;
            background: #fffaf6;
        }

        .about-main .container {
            max-width: 1000px;
            margin: auto;
        }

        .content-block {
            margin-bottom: 35px;
        }

        .content-block p {
            font-size: 16.5px;
            line-height: 1.8;
            color: #444;
            margin-bottom: 18px;
        }
    </style>
@endsection

{{-- custom script for this page --}}
@section('script')
    <script>
        new Swiper(".story-slider", {
            loop: true,
            spaceBetween: 30,
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
            },
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".view-profile-btn").forEach(button => {
                button.addEventListener("click", function() {

                    const name = this.dataset.name;
                    const position = this.dataset.position;
                    const photo = this.dataset.photo;
                    const description = this.dataset.description;
                    const quali = this.dataset.quali;

                    const limitedDescription = description;


                    document.getElementById("modalName").innerText = name;
                    document.getElementById("modalPosition").innerText = "( " + position + " )";
                    document.getElementById("modalPhoto").src = photo;
                    document.getElementById("modalDescription").innerText = limitedDescription;
                    document.getElementById("modalQuali").innerText = "Qualfication - " + quali;
                    quali
                });
            });
        });
    </script>
@endsection

@section('content')
    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url(assets/images/banner/banner-hero2.jpeg);">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2>About Prajapati Ghatasutra</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ================> Page Header section end here <================== -->



    <section class="about-section">
        <div class="container">
            <div class="about-wrapper">

                <!-- LEFT IMAGE -->
                <div class="about-image wow fadeInLeft">
                    <img src="assets/images/about/about4.png" alt="Happy Couple">

                    <div class="experience-badge">
                        <h3 style="color:white">{{ $frontend_content->experience }}</h3>
                        <p>Years of Trusted Matches</p>
                    </div>
                </div>

                <!-- RIGHT CONTENT -->
                <div class="about-content wow fadeInRight">
                    <span class="sub-title sub-section-heading">About Prajapati Ghatasutra</span>

                    <h2 class="about-title text-gradient-color">
                        Bringing Hearts Together <br> Since <span class="text-gradient-color">2014</span>
                    </h2>

                    <p class="about-text">
                        At <strong class="text-gradient-color">Prajapati Ghatasutra</strong>, we believe marriage is a
                        sacred
                        bond built on
                        trust, tradition, and understanding. More than just a platform, we are a
                        committed community that connects families and individuals through
                        shared values, culture, and long-term compatibility.
                    </p>


                    <div>
                        <h4 class="sub-section-heading">Why Choose Prajapati Ghatasutra</h4>
                        <p>Prajapati Ghatasutra is built on trust, tradition, and personalized guidance. We combine cultural
                            values with modern technology to deliver meaningful matchmaking and astrology services.</p>
                    </div>

                    <div class="stats-container">
                        <div class="stat-item">
                            <h3 class="section-heading">{{ $frontend_content->active_members }}</h3>
                            <p>Active Members</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="section-heading">{{ $frontend_content->successfull_marriage }}</h3>
                            <p>Successful Marriages</p>
                        </div>
                    </div>

                    <!-- Optional CTA -->
                    <!-- <a href="#" class="btn-primary">Find Your Perfect Match</a> -->
                </div>

            </div>
        </div>
    </section>


    <section class="company-sec">
        <div class="container">
            <div class="">
                <div class="logo-showing">

                    <img src="{{ $company->logo }}" alt="images" style="height:8rem;width:8rem">
                    <h2 class="section-heading text-center">
                        Most Trusted and Premium Matrimony Services in Odisha
                    </h2>
                </div>

                <h4 class="section-sub-heading" style="color:var(--blue-color)">Welcome to Prajapati Ghatasutra</h4>
                <p>A privileged platform catering to individuals from diverse communities of Odisha. We are dedicated to
                    assisting those who are genuinely seeking a lifelong partner through the sacred institution of marriage.
                </p>
            </div>
        </div>
    </section>

    <div class="about padding-top padding-bottom bg_img partner-sec"
        style="background-image: url(assets/images/bg-img/02.jpg);">
        <div class="container">
            <div class="section__header style-2 text-center">
                <h4 class="section-heading">Congratulations on starting this beautiful journey of love and companionship
                </h4>
                {{-- <p>Our dating platform is like a breath of fresh air. Clean and trendy design with ready to use features we
                    are sure you will love.</p> --}}
            </div>
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center">
                    @foreach ($partners as $item)
                        <div class="col-lg-4">
                            <div class="about__item text-center">
                                <div class="about__inner">
                                    <div class="about__thumb">
                                        <img src="{{ $item->photo }}" alt="{{ $item->name }}"
                                            style="height: 10rem;width:10rem;object-fit:1/1">
                                    </div>

                                    <div class="about__content">
                                        <h4 style="min-height: 4rem">{{ $item->name }}</h4>
                                        {{-- <h5>({{ $item->position }})</h5> --}}

                                        <p>{{ \Illuminate\Support\Str::words(strip_tags($item->description), 10, '...') }}
                                        </p>


                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-outline-primary view-profile-btn"
                                                data-bs-toggle="modal" data-bs-target="#authorProfileModal"
                                                data-name="{{ $item->name }}" data-position="{{ $item->position }}"
                                                data-photo="{{ $item->photo }}" data-quali="{{ $item->quali }}"
                                                data-description="{{ strip_tags($item->description) }}">
                                                View Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>


    <section class="about-main">
        <div class="container">

            <!-- About Description -->
            <div class="content-block">
                <p>
                    Prajapati Ghatasutra is an online Unit of Happy Life Marriage consultation, one of the leading online
                    matrimonial services of Odisha offering various opportunities to people to meet their soulmates on a
                    single platform within Odisha. The site is one of the fast-growing matrimonial portals working towards
                    creating matrimony alliances and successful marriages. The portal extends its services to people
                    belonging to different backgrounds, regions, and casts. The services are offered to privileged Hindus
                    from Odisha. We are always ready to help people who are serious about marriage. They can make use of our
                    user-friendly portal, explore and choose as per their preferences and meet their life partner in few
                    clicks. The site offers various comprehensive features, which make searching for your dream person
                    real-time fun. In-depth analysis has been carried out by our team of professionals to offer you better
                    services compared to other matrimonial services.
                </p>

                <p>
                    We uphold traditional values while embracing modernity. The richness of Odisha culture and the
                    efficiency of technology provide you with a contemporary and user-friendly platform.
                </p>
            </div>

            <!-- Our Services -->
            <div class="content-block">
                <h3 class="section-heading text-center">Our Services</h3>
                <p>
                    We give our services to aspiring males & females who are looking for their best-suited match. We offer
                    both online and offline membership plans to people, and they can choose as per their choice and
                    preferences. Kundali match is one of our best and most trusted consultations on this portal as our
                    Director is a qualified Pandit having MA in Sanskrit and Karma Kanda.
                </p>
            </div>

            <!-- Belief -->
            <div class="content-block">
                <p>
                    At Prajapati Ghatasutra, we believe that love is a celebration and finding the right partner should be
                    an experience for a lifetime filled with hope and excitement. We are honored to be a part of your search
                    for love and happiness in life and look forward to helping you find your life partner. Start your
                    journey towards a blissful union today and pave the way for your happy life ever after!
                </p>
            </div>

            <!-- Additional Services -->
            <div class="content-block">
                <p>
                    Other than Matrimonial service we also provide Brahim Service to perfrom various rituals based on Odia
                    culture and tradition. This not only saves time finding a pandit, it also builds great relationships
                    with people seeking blessings and develops spiritual enviorment at home, work place and shops and other
                    ventures.
                </p>

                <p>
                    We are introducing one stop application where it allows users to select Marriage venues (Kalyan
                    Manadap), Catering services for Birthday, Thread ceremony, marriage, kitty parties and get together. You
                    can select the best service from our various experienced service providers.
                </p>
            </div>

            <!-- Our Mission -->
            {{-- <div class="content-block">
                <h3 class="section-title">Our Mission</h3>
            </div> --}}

            <!-- Our Aim -->
            <div class="content-block">
                <h3 class="section-heading text-center">Our Aim</h3>
                <p>
                    We aim to provide a pleasant, satisfactory, and hassle-free service in matchmaking and all other
                    services to cater to your need. Your information is safe and secure with us. There would be no contact
                    details revealed to other members unless they are chosen to be made public. We give complete control to
                    our members for searching, filtering, and using other features as per their choice.
                </p>

                <p>
                    There are highly dedicated and experienced people with a proactive approach who are committed to their
                    mission and objectives to make this portal useful for everyone. The combination of online and offline
                    services is exclusive in the market, and you won’t be disappointed after associating with us.
                </p>
            </div>

            <!-- Closing -->
            <div class="content-block">
                <p>
                    We thank you for your time and hope that we’re able to serve you better as per your need.
                </p>
            </div>

        </div>
    </section>









    <!-- ================> Story section start here <================== -->
    <div class="story bg_img padding-top padding-bottom" style="background-image: url(assets/images/bg-img/02.jpg);">

        <div class="container">
            <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
                <h2 class="wow fadeInLeft section-heading">Happy Couple Stories from Prajapati Ghatasutra</h2>
                <p>
                    Real marriages, real happiness. Discover how families and couples found
                    their perfect life partners through trust, tradition, and expert guidance.
                </p>
            </div>

            <!-- Slider Wrapper -->
            <div class="swiper story-slider">
                <div class="swiper-wrapper">

                    <!-- Story 1 -->
                    <div class="swiper-slide">
                        <div class="story__item">
                            <div class="story__inner">
                                <div class="story__thumb">
                                    <img src="assets/images/story/01.webp" alt="Happy couple story">
                                    <span class="member__activity member__activity--ofline">
                                        Marriage Success
                                    </span>
                                </div>
                                <div class="story__content">
                                    <h4>From First Match to Forever Together</h4>
                                    <div class="story__content--author">
                                        <div class="story__content--content">
                                            <h6>Ramesh & Neha Prajapati</h6>
                                            <p>Married on January 12, 2024</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Story 2 -->
                    <div class="swiper-slide">
                        <div class="story__item">
                            <div class="story__inner">
                                <div class="story__thumb">
                                    <img src="assets/images/story/02.webp" alt="Astrology match success">
                                    <span class="member__activity member__activity--ofline">
                                        Kundali Match
                                    </span>
                                </div>
                                <div class="story__content">
                                    <h4>When Kundali Matching Created a Perfect Bond</h4>
                                    <div class="story__content--author">
                                        <div class="story__content--content">
                                            <h6>Amit & Pooja Prajapati</h6>
                                            <p>Married on February 08, 2024</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Story 3 -->
                    <div class="swiper-slide">
                        <div class="story__item">
                            <div class="story__inner">
                                <div class="story__thumb">
                                    <img src="assets/images/story/03.webp" alt="Family approved match">
                                    <span class="member__activity member__activity--ofline">
                                        Family Approved
                                    </span>
                                </div>
                                <div class="story__content">
                                    <h4>A Match Approved by Families & Values</h4>
                                    <div class="story__content--author">
                                        <div class="story__content--content">
                                            <h6>Suresh & Kavita Prajapati</h6>
                                            <p>Married on March 20, 2024</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Slider Controls -->

                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>
        </div>
    </div>
    <!-- ================> Story section end here <================== -->



    <section class="app-download-section">
        <div class="app-container container">

            <!-- Mobile Image -->
            <div class="app-image">
                <img src="assets/images/about/phone.png" alt="App Preview">
            </div>

            <!-- Content -->
            <div class="app-content">
                <span class="app-tag sub-section-heading">Download Our App</span>
                <h2 class="text-center section-heading">Connect with Our Community</h2>
                <p class="text-center">
                    Prajapati Ghatasutra is the biggest and most trusted
                    matrimonial service for Odias. Find your perfect match
                    with ease and confidence.
                </p>

                <div class="store-buttons">
                    <a href="#" class="store-btn apple">
                        <img src="assets/images/about/app_store.png" alt="Download on App Store">
                        {{-- App Store --}}
                    </a>
                    <a href="#" class="store-btn google">
                        <img src="assets/images/about/play_store.png" alt="Download on Google Play">
                        {{-- Google Play --}}
                    </a>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="authorProfileModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalName"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <img id="modalPhoto" src="" class="img-fluid rounded-circle mb-3"
                        style="height: 10rem;width:10rem;object-fit:1/1">

                    <h6 id="modalPosition" class="text-muted mb-3"></h6>
                    <h6 id="modalQuali"></h6>
                    <p id="modalDescription"></p>
                </div>

            </div>
        </div>
    </div>
@endsection
