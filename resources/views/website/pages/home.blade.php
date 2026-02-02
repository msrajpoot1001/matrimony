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
        .about .about__inner {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 40px 20px;
        }

        .about .about__inner .about__content {
            background-color: white;
            border-radius: 5px;
            padding: 0.5rem;
            /* text-shadow: 0 0 5px #ff2b2b, 0 0 10px #ff2b2b, 0 0 20px #ff2b2b; */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            min-height: 12rem;
        }

        .about .about__inner .about__content h4 {
            /* margin-bottom: 2rem !important; */
        }



        .about .about__inner .about__content p {
            margin-top: 1rem !important;
            white-space: normal !important;
            /* allow wrapping */
            overflow: visible !important;
            /* let the container expand */
            text-overflow: clip !important;
            /* remove ellipsis */
        }
    </style>
    <style>
        .about-section {
            padding: 90px 0;
            background: #fff;
        }

        .about-wrapper {
            display: flex;
            align-items: center;
            gap: 60px;
            flex-wrap: wrap;
        }

        /* IMAGE AREA */
        .about-image {
            position: relative;
            flex: 1;
        }

        .about-image img {
            width: 100%;
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        /* EXPERIENCE BADGE */
        .experience-badge {
            position: absolute;
            bottom: 25px;
            right: 25px;
            background: var(--primary-color4);
            /* background: var(--orange-color); */
            color: #fff;
            padding: 18px 22px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(177, 18, 38, 0.4);
        }

        .experience-badge span {
            font-size: 32px;
            font-weight: 700;
            display: block;
        }

        /* CONTENT AREA */
        .about-content {
            flex: 1;
        }

        .sub-title {
            /* color: var(--green-color); */
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .about-title {
            font-size: 42px;
            line-height: 1.3;
            margin-bottom: 18px;
        }

        .about-title span {
            /* color: var(--green-color); */
        }

        .about-text {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
            margin-bottom: 25px;
        }

        /* FEATURES */
        .features-list {
            list-style: none;
            padding: 0;
            margin-bottom: 30px;
        }

        .features-list li {
            font-size: 16px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .check-icon {
            color: #b11226;
            font-weight: 700;
            margin-right: 10px;
        }

        /* STATS */
        .stats-container {
            display: flex;
            gap: 40px;
        }

        .stat-item h3 {
            font-size: 36px;
            color: #b11226;
            margin-bottom: 5px;
        }

        .stat-item p {
            color: #666;
            font-size: 15px;
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .about-wrapper {
                flex-direction: column;
            }

            .about-title {
                font-size: 34px;
            }
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
            color: var(--primary-color2);
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
            color: var(--primary-color2);
            margin: 0;
        }

        /* Button */
        .btn-primary {
            display: inline-block;
            background: var(--primary-color2);
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

        .default-btn-new,
        .default-btn-new * {
            color: black !important;
        }
    </style>
    <style>
        .swiper-button-next:after,
        .swiper-rtl .swiper-button-prev:after {
            color: var(--primary-color2);
        }

        .swiper-button-prev:after,
        .swiper-rtl .swiper-button-next:after {
            color: var(--primary-color2);
        }

        .story__thumb span {
            background-color: var(--primary-color2) !important;
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
            background-image: url("assets/images/about/phone2.jpeg");
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
        .floating-text {
            font-weight: 700;
            background: #b11226;
            background-size: 300% 300%;
            animation: textFloat 6s linear infinite;

            /* Make gradient visible inside text */
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
        }

        /* Floating animation */
        @keyframes textFloat {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }
    </style>
    <style>
        .app-auto-rotate {
            display: flex;
            gap: 20px;
            list-style: none;
            padding: 0;
        }

        /* Card setup */
        .app-card {
            position: relative;
            display: inline-block;
            perspective: 1000px;
        }

        /* Image */
        .app-card img {
            display: block;
            width: 180px;
            border-radius: 8px;
            backface-visibility: hidden;
            animation: rotateCard 2s infinite;
        }

        /* Text */
        .app-text {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            backface-visibility: hidden;
            transform: rotateY(180deg);
            animation: rotateText 2s infinite;
            padding: 1rem;
            margin-top: -4rem !important
        }

        /* Image rotation */
        @keyframes rotateCard {

            0%,
            40% {
                transform: rotateY(0deg);
            }

            50%,
            90% {
                transform: rotateY(180deg);
            }

            100% {
                transform: rotateY(360deg);
            }
        }

        /* Text sync */
        @keyframes rotateText {

            0%,
            40% {
                transform: rotateY(180deg);
            }

            50%,
            90% {
                transform: rotateY(360deg);
            }

            100% {
                transform: rotateY(540deg);
            }
        }
    </style>


    {{-- slide left to right and right to left --}}
    <style>
        /* Common animation setup */
        .slide-right,
        .slide-left {
            animation-duration: 3s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
        }

        /* Left → Right */
        .slide-right {
            animation-name: slideRight;
        }

        /* Right → Left */
        .slide-left {
            animation-name: slideLeft;
        }

        /* Keyframes */
        @keyframes slideRight {
            0% {
                transform: translateX(-80px);
                opacity: 0;
            }

            25% {
                transform: translateX(0);
                opacity: 1;
            }

            75% {
                transform: translateX(0);
                opacity: 1;
            }

            100% {
                transform: translateX(80px);
                opacity: 0;
            }
        }

        @keyframes slideLeft {
            0% {
                transform: translateX(80px);
                opacity: 0;
            }

            25% {
                transform: translateX(0);
                opacity: 1;
            }

            75% {
                transform: translateX(0);
                opacity: 1;
            }

            100% {
                transform: translateX(-80px);
                opacity: 0;
            }
        }
    </style>

    <style>
        /* ================= Banner Background Styles ================= */
        .banner {
            position: relative;
            /* for positioning shapes or overlay */
            background-size: cover;
            /* cover entire container */
            background-position: center;
            /* center the image */
            background-repeat: no-repeat;
            /* no repeating */
            width: 100%;
            /* full width */
            min-height: 600px;
            /* adjust height as needed */
            display: flex;
            align-items: center;
            /* vertically center content */
            padding-top: 5rem;
            padding-bottom: 5rem;
            overflow: hidden;
            /* hide overflowed shapes */
        }

        /* Optional: dark overlay on image for better text readability */
        .banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            /* adjust opacity as needed */
            z-index: 1;
        }

        /* Content wrapper inside banner */
        .banner__wrapper {
            position: relative;
            z-index: 2;
            /* above overlay */
        }

        /* Banner text styles */
        .banner__title .text {
            z-index: 999;
            /* font-size: 2rem; */
            font-weight: 700;
            text-align: center;
            line-height: 1;
            color: white;
            text-shadow: 1px 1px 2px #000;

        }








        /* Responsive adjustments */
        @media (max-width: 992px) {
            .banner {
                min-height: 500px;
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            .banner__title .text {
                /* font-size: 1.5rem; */
            }


        }

        @media (max-width: 576px) {
            .banner {
                min-height: 400px;
                padding-top: 2rem;
                padding-bottom: 2rem;
            }

            .banner__title .text {
                /* font-size: 1rem; */

            }


        }
    </style>

    <style>
        .karma-section .blog__thumb img {
            height: 15rem;

        }
    </style>

    {{-- query modal  --}}
    <style>
        /* Modal container */
        .query-modal {
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        /* Header */
        .query-modal-header {
            background: linear-gradient(135deg, var(--orange-color), var(--green-color));
            color: #000;
            border-bottom: none;
            padding: 1.2rem 1.5rem;
        }

        /* Inputs */
        .query-modal .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: none;
        }

        .query-modal .form-control:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 0.15rem rgba(212, 175, 55, 0.25);
        }

        /* Button */
        .query-modal .btn-primary {
            border-radius: 30px;
            background: linear-gradient(135deg, var(--orange-color), var(--green-color));
            border: none;
            font-weight: 600;
            /* box-shadow: 0 8px 22px #e65a5a; */
        }

        .query-modal .btn-primary:hover {
            /* box-shadow: 0 12px 28px #d24444; */
            transform: translateY(-1px);
        }
    </style>

    <style>
        .default-primary-bg {
            background: var(--primary-color2) !important;

        }

        .default-primary-bg:hover {
            color: white !important
        }


        .default-primary-bg span {
            color: white !important;

        }

        .default-primary-bg:hover span {
            color: white !important;
        }
    </style>

    <style>
        .app-download-section {
            /* background: url('assets/images/home/app-sec-bg.png'); */
            padding: 70px 0;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            /* background: #ffffff; */
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
        .main-karma-section .blog__thumb img,
        .main-karma-section .blog__thumb img {
            height: 20rem !important;
        }
    </style>
    <style>
        .search_form .banner__inputlist {

            border-radius: 40px;
        }

        .search_form .banner__inputlist input,
        .search_form .banner__inputlist select,
        .search_form .banner__inputlist select option {
            color: black !important;
        }
    </style>

    {{-- astro section  --}}
    <style>
        /* Background */
        .astro-bg {
            background: url('assets/images/home/astro-product-bg.jpeg') no-repeat center / cover;
        }

        /* Slider spacing */
        .astro-product-slider {
            padding: 20px 0;
            overflow: hidden;
        }

        /* Fixed slide width for smooth continuous motion */
        .astro-product-slider .swiper-slide {
            width: 320px;
        }

        /* Card styling */
        .blog__inner {
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .blog__thumb img {
            border-radius: 10px 10px 0 0;
        }

        /* Text */
        .blog__content h2 {
            color: #00ab43;
            font-weight: 700;
        }

        .blog__content h3 {
            margin-bottom: 10px;
        }

        /* Smooth hover */
        .blog__item:hover {
            transform: translateY(-6px);
            transition: all 0.3s ease;
        }
    </style>

    <style>
        .astro-name {
            min-height: 4rem !important;
        }
    </style>
    <style>
        .story-slider,
        .adv-slider {
            padding-bottom: 100px !important;
        }


        /* Style dots (optional – modern look) */
        .story-slider .swiper-pagination-bullet,
        .adv-slider .swiper-pagination-bullet {
            width: 15px;
            height: 15px;
        }

        .story-slider .swiper-pagination-bullet-active,
        .adv-slider .swiper-pagination-bullet-active {
            background: var(--orange-color);
            /* match theme color */
        }
    </style>

    <style>
        @media (min-width:1200px) {
            .find_your_sec {
                position: relative;
                top: 7rem;
                margin-bottom: 7rem;
            }
        }
    </style>
    <style>
        .banner__title {
            margin-top: -23%;
        }

        @media (max-width: 1400px) {
            .banner__title {
                margin-top: -27%;
            }
        }

        @media (max-width: 1200px) {
            .banner__title {
                margin-top: -32%;
            }
        }

        @media (max-width: 768px) {
            .banner__title {
                margin-top: -45%;
            }
        }

        @media (max-width: 576px) {
            .banner__title {
                margin-top: -35%;
            }
        }

        @media (max-width: 470px) {
            .banner__title {
                margin-top: -40%;
            }
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
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
            },
        });

        new Swiper(".adv-slider", {
            loop: true,
            spaceBetween: 30,
            autoplay: {
                delay: 2500,
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
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 2,
                },
            },
        });
    </script>
    <script>
        // Select the carousel element
        var bannerCarousel = document.querySelector('#bannerCarousel');

        // Initialize Bootstrap carousel with JS
        var carousel = new bootstrap.Carousel(bannerCarousel, {
            interval: 3000, // 3 seconds
            ride: 'carousel', // auto start
            pause: 'hover', // optional: pause on hover
            wrap: true // optional: infinite loop
        });

        // Example: Dynamically change interval after 10 seconds
        // setTimeout(() => {
        //     carousel._config.interval = 5000; // change to 5 seconds
        // }, 10000);
    </script>
    @if (!(session()->has('contact_success') || session()->has('subscribe_success')) && $frontend_content->query_form)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalEl = document.getElementById('queryModal');
                if (modalEl && typeof bootstrap !== 'undefined') {
                    const queryModal = new bootstrap.Modal(modalEl);
                    queryModal.show();
                }
            });
        </script>
    @endif

    <script>
        const swiper = new Swiper(".astro-product-slider", {
            loop: true,
            speed: 9000,
            spaceBetween: 30,

            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            freeMode: true,
            freeModeMomentum: false,

            slidesPerView: "auto",
            loopAdditionalSlides: 20,
            watchSlidesProgress: true,

            allowTouchMove: true, // ✅ ENABLE drag
            grabCursor: true, // ✅ show hand cursor

            breakpoints: {
                0: {
                    slidesPerView: 1.2
                },
                768: {
                    slidesPerView: 2.5
                },
                1200: {
                    slidesPerView: 3.5
                },
            },
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#casteSelect').on('change', function() {
            var casteId = $(this).val();
            if (casteId) {
                $.ajax({
                    url: '/get-sub-castes/' + casteId,
                    type: 'GET',
                    success: function(data) {
                        $('#subCasteSelect').empty(); // clear previous
                        $('#subCasteSelect').append('<option value="">Any</option>');

                        $.each(data, function(key, value) {
                            $('#subCasteSelect').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#subCasteSelect').empty();
                $('#subCasteSelect').append('<option value="">Any</option>');
            }
        });
    </script>
@endsection

@section('content')
    {{-- query modal  --}}
    <!-- Query Modal -->
    @include('components.success-modal')
    <div class="modal fade" id="queryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content query-modal">

                <!-- Header -->
                <div class="modal-header query-modal-header">
                    <h5 class="modal-title" style="color:white">
                        <i class="fa-solid fa-comments me-2"></i> Quick Enquiry
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4">


                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="type" value="query">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-lg"
                                placeholder="Enter your full name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control form-control-lg"
                                placeholder="Enter your phone number" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Your Query</label>
                            <textarea name="message" rows="3" class="form-control" placeholder="Type your message here..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                            Submit Enquiry
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div id="bannerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">

            @foreach ($home_hero as $item)
                <!-- Slide 1 -->
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="banner banner--style2 padding-top bg_img"
                        style="background-image: url('{{ asset($item->bg_image) }}'); padding-bottom: 5rem;">
                        <div class="container">
                            <div class="banner__wrapper">
                                <div class="row g-0 justify-content-center text-set">
                                    <div class="col-lg-12 col-12">
                                        <div class="banner__content wow fadeInLeft" data-wow-duration="1.5s">
                                            <div class="banner__title">
                                                <h3 class="text">
                                                    {{ $item->title }}</h3>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-8 col-12">
                                        <div class="banner__thumb wow fadeInUp" data-wow-duration="1.5s">
                                            <div class="banner__thumb--shape">
                                                <div class="shapeimg shapeimg__one">
                                                    <img src="assets/images/banner/shape/home2/01.png"
                                                        alt="matrimonial shape">
                                                </div>
                                                <div class="shapeimg shapeimg__two">
                                                    <img src="assets/images/banner/shape/home2/02.png"
                                                        alt="matrimonial shape">
                                                </div>
                                                <div class="shapeimg shapeimg__three">
                                                    <img src="assets/images/banner/shape/home2/03.png"
                                                        alt="matrimonial shape">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <!-- Add more buttons as per slides -->
        </div>
    </div>
    <!-- ================> Banner Carousel End <================== -->


    <!-- ================> About section start here <================== -->
    <div class="about about--style2 padding-top pt-xl-0 find_your_sec">
        <div class="container">
            <div class="section__wrapper wow fadeInUp" data-wow-duration="1.5s">
                <div class="row g-0 justify-content-center row-cols-lg-1 row-cols-1">
                    <div class="col wow fadeInTop ">
                        <div class="about__right" style="border-radius: 10px">
                            <div class="about__title">
                                <h3 class="text-center">Find Your Perfect Life Partner</h3>
                            </div>
                            <form action="#" class="search_form">
                                <div class="banner__list">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3">
                                            <label>Profile Type</label>
                                            <div class="banner__inputlist">
                                                <select>
                                                    <option>Select</option>
                                                    <option selected>Bride</option>
                                                    <option>Groom</option>
                                                    <option>Divorcee</option>
                                                    <option>Widow</option>
                                                    <option>Widower</option>
                                                    <option>NRI</option>
                                                    <option>Second Marriage</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-3">
                                            <label>Looking For</label>
                                            <div class="banner__inputlist">
                                                <select>
                                                    <option>Select Gender</option>
                                                    <option>Male</option>
                                                    <option selected>Female</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-3">
                                            <label for="age_from">Age From</label>
                                            <div class="banner__inputlist">
                                                <select name="age_from" id="age_from">
                                                    @for ($age = 18; $age <= 45; $age++)
                                                        <option value="{{ $age }}">{{ $age }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-3">
                                            <label for="age_to">Age To</label>
                                            <div class="banner__inputlist">
                                                <select name="age_to" id="age_to">
                                                    @for ($age = 18; $age <= 45; $age++)
                                                        <option value="{{ $age }}"
                                                            {{ $age == 45 ? 'selected' : '' }}>
                                                            {{ $age }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-3">
                                            <label>Country</label>
                                            <div class="banner__inputlist">
                                                <select>
                                                    <option selected>India</option>
                                                    <option>United States</option>
                                                    <option>United Kingdom</option>
                                                    <option>Canada</option>
                                                    <option>Australia</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3">
                                            <label>Religion</label>
                                            <div class="banner__inputlist">
                                                <select>
                                                    <option selected>Select</option>
                                                    <option>Hindu</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3">
                                            <label>Caste</label>
                                            <div class="banner__inputlist">
                                                <select name="caste" id="casteSelect">
                                                    <option selected value="">Any</option>
                                                    @foreach ($caste as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-3">
                                            <label>Sub Caste</label>
                                            <div class="banner__inputlist">
                                                <select name="sub_caste" id="subCasteSelect">
                                                    <option selected value="">Any</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <button type="submit" class="default-btn default-btn-new reverse d-block"
                                                style="background: #0a0857 !important; color: #ffffff !important; border-radius: 40px;margin-top:2rem">
                                                <span style="color:white!important">Search Matching Profiles</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>



                                {{-- <button type="submit" class="default-btn default-btn-new reverse d-block"
                                    style="background: #0a0857 !important; color: #ffffff !important; border-radius: 40px;">
                                    <span style="color:white!important">Search Matching Profiles</span>
                                </button> --}}
                            </form>
                        </div>
                    </div>
                    <div class="col" style="height:4rem">
                    </div>
                    <div class="col">
                        <div class="about__left">
                            <div class="about__top">
                                <div class="about__content">
                                    <h2 class="section-heading">Welcome to Prajapati Ghatasutra </h2>
                                    <p>
                                        Prajapati Ghatasutra is a trusted matrimonial platform dedicated to helping
                                        individuals
                                        and families find meaningful and lifelong relationships. With a strong foundation of
                                        values, traditions, and trust, we bring compatible matches together for a happy and
                                        successful married life.
                                    </p>
                                </div>
                            </div>
                            <div class="about__bottom">
                                <div class="about__bottom--head">
                                    <h5>Recently Registered Profiles</h5>
                                    <div class="about__bottom--navi">
                                        <div class="ragi-prev"><i class="fa-solid fa-chevron-left"></i></div>
                                        <div class="ragi-next active"><i class="fa-solid fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                <div class="about__bottom--body">
                                    <div class="ragi__slider overflow-hidden">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="member-single.html"><img
                                                            src="assets/images/home/profile/img1.jpg" alt="profile"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="member-single.html"><img
                                                            src="assets/images/home/profile/img2.jpg" alt="profile"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="member-single.html"><img
                                                            src="assets/images/home/profile/img31.jpg" alt="profile"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="member-single.html"><img
                                                            src="assets/images/home/profile/img4.jpg" alt="profile"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="member-single.html"><img
                                                            src="assets/images/home/profile/img5.jpg" alt="profile"></a>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="ragi__thumb">
                                                    <a href="member-single.html"><img
                                                            src="assets/images/home/profile/img6.jpg" alt="profile"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="height:4rem">
                    </div>



                </div>
            </div>
        </div>
    </div>




    <section class="about-section">
        <div class="container">
            <div class="about-wrapper">

                <!-- LEFT IMAGE -->
                <div class="about-image wow fadeInLeft">
                    <img src="assets/images/about/about4.png" alt="Happy Couple">

                    <div class="experience-badge">
                        <span>{{ $frontend_content->experience }}</span>
                        <p>Years of Trusted Matches</p>
                    </div>
                </div>

                <!-- RIGHT CONTENT -->
                <div class="about-content wow fadeInRight">
                    <span class="sub-title sub-section-heading ">About Prajapati Ghatasutra</span>

                    <h2 class="about-title section-heading">
                        Bringing Hearts Together Since 2014
                    </h2>

                    <p class="about-text">
                        At <strong class="sub-section-heading">Prajapati Ghatasutra</strong>, we believe marriage is a
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



    <!-- ================> About section end here <================== -->

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


                    @foreach ($happy_stories as $item)
                        <!-- Story 1 -->
                        <div class="swiper-slide">
                            <div class="story__item">
                                <div class="story__inner" style="padding:0px;">
                                    <div class="story__thumb"
                                        style="padding:0px;border-top-right-radius: 12px;border-top-left-radius: 12px;">
                                        <img src="{{ $item->photo ?? 'assets/images/story/01.webp' }}"
                                            alt="Happy couple story">
                                        <span class="member__activity member__activity--ofline" style="font-size:1rem">
                                            {{ $item->reason }}
                                        </span>
                                    </div>
                                    <div class="story__content">
                                        <h4>{{ $item->heading }}</h4>
                                        <div class="story__content--author">
                                            <div class="story__content--content">
                                                <h6>{{ $item->sub_heading }}</h6>
                                                <p>
                                                    Married on {{ $item->date->format('F d, Y') }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

                <!-- Slider Controls -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- ================> Story section end here <================== -->



    <!-- ================> About section start here <================== -->
    {{-- <div class="about padding-top padding-bottom bg_img" style="background-image: url(assets/images/bg-img/02.jpg);">
        <div class="container">
            <div class="section__header style-2 text-center wow fadeInUp" data-wow-duration="1.5s">
                <h2 class="wow fadeInLeft section-heading">Why Choose Prajapati Ghatasutra</h2>
                <p>
                    Prajapati Ghatasutra is built on trust, tradition, and personalized guidance.
                    We combine cultural values with modern technology to deliver meaningful
                    matchmaking and astrology services.
                </p>
            </div>

            <div class="section__wrapper">
                <div class="row g-4 justify-content-center row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1">

                    <div class="col wow fadeInUp" data-wow-duration="1.5s">
                        <div class="about__item text-center">
                            <div class="about__inner" style="background-image: url('assets/images/img/img1.webp');">
                                <div class="about__thumb">
                                    <img src="assets/images/about/01.jpg" alt="service thumb">
                                </div>
                                <div class="about__content">
                                    <h4>Trusted & Reliable</h4>
                                    <p style="margin-top:2rem">
                                        A trusted platform connecting families with verified
                                        profiles and genuine matchmaking support.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col wow fadeInUp" data-wow-duration="1.6s">
                        <div class="about__item text-center">
                            <div class="about__inner" style="background-image: url('assets/images/img/img2.png');">
                                <div class="about__thumb">
                                    <img src="assets/images/about/02.jpg" alt="service thumb">
                                </div>
                                <div class="about__content">
                                    <h4>Personalized Matching</h4>
                                    <p>
                                        Matches are curated based on preferences, values,
                                        and astrological compatibility.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col wow fadeInUp" data-wow-duration="1.7s">
                        <div class="about__item text-center">
                            <div class="about__inner" style="background-image: url('assets/images/img/img3.webp');">
                                <div class="about__thumb">
                                    <img src="assets/images/about/03.jpg" alt="service thumb">
                                </div>
                                <div class="about__content">
                                    <h4>Easy & Secure Process</h4>
                                    <p>
                                        Simple registration, secure data handling,
                                        and a smooth experience for everyone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col wow fadeInUp" data-wow-duration="1.8s">
                        <div class="about__item text-center">
                            <div class="about__inner" style="background-image: url('assets/images/img/img4.jpg');">
                                <div class="about__thumb">
                                    <img src="assets/images/about/04.jpg" alt="service thumb">
                                </div>
                                <div class="about__content">
                                    <h4>Expert Guidance</h4>
                                    <p>
                                        Professional astrologers and consultants
                                        guiding you at every step of your journey.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> --}}
    <!-- ================> About section end here <================== -->




    <!-- ================> karma training start here <================== -->
    <div class="blog karma-section main-karma-section padding-top padding-bottom">
        <div class="container">
            <div class="section-wrapper">
                <div class="section-header text-center mb-5">
                    <h2 class="title section-heading">Karma Training Programs</h2>
                    <p class="subtitle">
                        Transform your life through conscious actions, awareness, and spiritual discipline
                    </p>
                </div>

                <div class="row g-4 justify-content-center">

                    @foreach ($karma_content as $item)
                        <div class="col-lg-4 col-12">
                            <div class="blog__item">
                                <div class="blog__inner"
                                    style="padding:0px!important;border-top-right-radius: 10px;border-top-left-radius: 10px;">
                                    <div class="blog__thumb"
                                        style="border-top-right-radius: 10px;border-top-left-radius: 10px;">
                                        @if ($item->photo)
                                            @if (\Illuminate\Support\Str::endsWith($item->photo, ['.mp4', '.mov', '.avi', '.webm']))
                                                <video class="w-100" autoplay muted loop playsinline
                                                    oncontextmenu="return false;">

                                                    <source src="{{ asset($item->photo) }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <img src="{{ asset($item->photo) }}" alt="blog-thumb" class="w-100">
                                            @endif
                                        @endif

                                    </div>
                                    <div class="blog__content px-3 py-4">
                                        <a href="{{ route('karma.details', $item->slug) }}">
                                            <h3 style="min-height:4rem;overflow:hidden">{{ $item->title }}</h3>
                                        </a>
                                        <div class="blog__metapost">
                                            <a href="{{ route('karma.details', $item->slug) }}">Trainer</a>
                                            <a href="{{ route('karma.details', $item->slug) }}">Karma Training</a>
                                        </div>
                                        <p>
                                            {!! $item->short_description !!}
                                        </p>
                                        <a href="{{ route('karma.details', $item->slug) }}"
                                            class="default-primary-bg default-btn  reverse">
                                            <span>Read More</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12 col-12">
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('karma.trainings') }}" class="default-primary-bg default-btn reverse">
                                <span>More Training Programs</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ================> karma training end here <================== -->
    </div>


    <!-- ================> astro section <================== -->
    <div class="blog karma-section padding-top padding-bottom astro-bg">
        <div class="container">
            <div class="section-wrapper">

                <!-- Section Header -->
                <div class="section-header text-center mb-5">
                    <h2 class="title section-heading">Prajapati Divine Astro Products</h2>
                    <p class="subtitle">
                        We believe that the universe holds answers to life’s most important questions. Our mission is to
                        guide you toward harmony, prosperity, and peace by offering authentic astro products and expert
                        astrological services.
                    </p>
                    <p>
                        Are you ready to align your life with the stars? Explore our products or book a consultation today.
                    </p>
                </div>

                <!-- Continuous Slider -->
                <div class="swiper astro-product-slider">
                    <div class="swiper-wrapper">

                        @foreach ($astro_products as $item)
                            <div class="swiper-slide">
                                <div class="blog__item">
                                    <div class="blog__inner">
                                        <div class="blog__thumb" style="height:13rem;">
                                            <a href="{{ route('astro.product.detail', $item->slug) }}"
                                                style="width:100%">
                                                <img src="{{ asset($item->photo) }}" alt="{{ $item->name }}"
                                                    class="w-100">
                                            </a>
                                        </div>

                                        <div class="blog__content px-3 py-4">
                                            <a href="{{ route('astro.product.detail', $item->slug) }}">
                                                <h3 style="color:var(--green-color)">₹ {{ $item->price }}</h3>
                                                <h4 class="astro-name">
                                                    {{ \Illuminate\Support\Str::limit($item->name, 30) }}
                                                </h4>


                                                <div class="mb-4">
                                                    {{ $item->short_description }}
                                                </div>
                                            </a>
                                            <a href="{{ route('astro.product.detail', $item->slug) }}"
                                                class="default-btn reverse default-primary-bg mt-2">
                                                <span>Read More</span>
                                            </a>

                                            <a href="{{ route('astro.buy.now', $item->slug) }}" class="buy-now-btn mt-2">
                                                <span>Buy Now</span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center mt-4">
                    <a href="{{ route('astro.products') }}" class="default-primary-bg default-btn reverse">
                        <span>More Astro Products</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- ================> astro section end <================== -->




    <!-- ================> Work section start here <================== -->
    {{-- <div class="work work--style2 padding-top padding-bottom bg_img"
        style="background-image: url(assets/images/bg-img/01.jpg);">
        <div class="container">
            <div class="section__wrapper">
                <div class="row g-4 justify-content-center">

                    <!-- LEFT -->
                    <div class="col-xl-6 col-lg-8 col-12 slide-right">
                        <div class="work__item">
                            <div class="work__inner">
                                <div class="work__thumb">
                                    <img src="assets/images/work/09.png">
                                </div>
                                <div class="work__content">
                                    <h3>Trust And Safety</h3>
                                    <p>Choose from one of our membership levels and unlock features you need.</p>
                                    <a href="policy.html" class="default-btn"><span>See More Details</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <div class="col-xl-6 col-lg-8 col-12 slide-left">
                        <div class="work__item">
                            <div class="work__inner">
                                <div class="work__thumb">
                                    <img src="assets/images/work/10.png">
                                </div>
                                <div class="work__content">
                                    <h3>Simple Membership</h3>
                                    <p>Choose from one of our membership levels and unlock features you need.</p>
                                    <a href="membership.html" class="default-btn reverse">
                                        <span>Membership Details</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div> --}}
    <!-- ================> Work section end here <================== -->


    <!-- ================> App section start here <================== -->
    {{-- <div class="app app--style2 padding-top padding-bottom bg-blur">
        <div class="content">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    <div class="col-xxl-6 col-12">
                        <div class="app__item wow fadeInUp" data-wow-duration="1.5s">
                            <div class="app__inner">
                                <div class="app__content text-center">
                                    <h4 class="wow fadeInTop" style="color:black">Download Our App</h4>
                                    <h2 class="wow fadeInLeft floating-text"
                                        style="color:white;text-shadow: 1px 1px 2px #000;">Connect
                                        with Trusted Matchmaking & Astrology Experts</h2>
                                    <p style="color:white;text-shadow: 1px 1px 2px #000;">
                                        Finding the right match and guidance has never been easier.
                                        Join thousands of users who trust our platform for personalized
                                        matchmaking and accurate astrology services. Start your journey
                                        today with just one click.
                                    </p>
                                    <ul class="justify-content-center app-auto-rotate">
                                        <li>
                                            <a href="#" class="app-card wow fadeInLeft">
                                                <img src="assets/images/app/01.jpg" alt="Download on Google Play">
                                                <span class="app-text">Download the App</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="app-card wow fadeInRight">
                                                <img src="assets/images/app/02.jpg" alt="Download on App Store">
                                                <span class="app-text">Download the App</span>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ================> App section end here <================== -->

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


    <!-- ================> Advertisement section start here <================== -->
    <div class="story bg_img padding-top padding-bottom" style="background-image: url(assets/images/bg-img/02.jpg);">

        <div class="container">

            <!-- Slider Wrapper -->
            <div class="swiper adv-slider">
                <div class="swiper-wrapper">


                    @foreach ($adv as $item)
                        <!-- Ad 1 -->
                        <div class="swiper-slide">
                            <div class="story__item">
                                <div class="story__inner"
                                    style="padding:0px!important;border-top-right-radius: 10px;border-top-left-radius: 10px;">
                                    <div class="story__thumb"
                                        style="height:20rem;border-top-right-radius: 10px;border-top-left-radius: 10px;">
                                        <img src="{{ asset($item->photo) }}" alt="Trusted matrimony service">

                                    </div>
                                    <div class="story__content">
                                        <h4>{{ $item->heading }}</h4>
                                        <div class="story__content--author">
                                            <div class="story__content--content">
                                                <h6>{{ $item->sub_heading }}</h6>
                                                <p>{!! $item->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>

                <!-- Slider Controls -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- ================> Advertisement section end here <================== -->
@endsection
