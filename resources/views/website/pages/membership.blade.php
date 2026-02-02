@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Prajapati Membership
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
    <style>
        .pageheader {
            padding-block: 0px !important;
            padding-top: 4rem !important;
            padding-bottom: 4rem !important;
        }

        .pricing-section {
            background: #f9fafb;
        }

        .pricing-card {
            background: #fff;
            border-radius: 20px;
            padding: 35px 25px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease;
            position: relative;
        }

        .pricing-card:hover {
            transform: translateY(-8px);
        }

        .plan-title {
            font-size: 20px;
            font-weight: 600;
        }

        .plan-sub {
            color: #777;
            font-size: 14px;
        }

        .price {
            font-size: 34px;
            margin: 15px 0;
        }

        .price span {
            font-size: 14px;
            color: #777;
        }

        .features {
            list-style: none;
            padding: 0;
            margin: 25px 0;
        }

        .features li {
            margin-bottom: 12px;
            font-size: 15px;
        }

        .features .active {
            color: #2ecc71;
        }

        .features .inactive {
            color: #ccc;
            text-decoration: line-through;
        }

        .plan-btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 30px;
            border: 1px solid #ff7a18;
            color: #ff7a18;
            text-decoration: none;
            font-weight: 500;
        }

        .plan-btn.primary {
            background: linear-gradient(135deg, #ff7a18, #2ecc71);
            color: #fff;
            border: none;
        }

        .popular {
            border: 2px solid #ff7a18;
        }

        .badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #ff7a18;
            color: #fff;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
        }
    </style>
@endsection

{{-- custom script for this page --}}
@section('script')
    <script></script>
@endsection

@section('content')
    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url(assets/images/banner/banner-hero2.jpeg);">
        <div class="container">
            <div class="pageheader__content text-center">
                <h2 >Prajapati Membership</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Membership</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ================> Page Header section end here <================== -->




    <!-- ================> Membership start here <================== -->
    <section class="membership pricing-section padding-top padding-bottom">
        <div class="container">
            <div class="section__header text-center">
                <h2 class="section-heading" >Membership Plans</h2>
                <p>Unlock premium features to connect, chat, and build meaningful relationships with verified profiles.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Free -->
                <div class="col-lg-3 col-md-6">
                    <div class="pricing-card">
                        <h4 class="plan-title">Free</h4>
                        <p class="plan-sub">Get Started</p>
                        <h3 class="price">₹0</h3>

                        <ul class="features">
                            <li class="active">Browse Profiles</li>
                            <li class="active">View Basic Details</li>
                            <li class="inactive">Send Messages</li>
                            <li class="inactive">View Contact Details</li>
                        </ul>

                        <a href="login.html" class="plan-btn">Get Started</a>
                    </div>
                </div>

                <!-- Bronze -->
                <div class="col-lg-3 col-md-6">
                    <div class="pricing-card">
                        <h4 class="plan-title">Bronze</h4>
                        <p class="plan-sub">Starter Plan</p>
                        <h3 class="price">₹499<span>/month</span></h3>

                        <ul class="features">
                            <li class="active">Browse Profiles</li>
                            <li class="active">Send Limited Messages</li>
                            <li class="active">View Photos</li>
                            <li class="inactive">Contact Details</li>
                        </ul>

                        <a href="login.html" class="plan-btn">Choose Plan</a>
                    </div>
                </div>

                <!-- Silver (Popular) -->
                <div class="col-lg-3 col-md-6">
                    <div class="pricing-card popular">
                        <span class="badge">Most Popular</span>
                        <h4 class="plan-title">Silver</h4>
                        <p class="plan-sub">Best for Serious Matches</p>
                        <h3 class="price">₹999<span>/month</span></h3>

                        <ul class="features">
                            <li class="active">Unlimited Messaging</li>
                            <li class="active">View Contact Details</li>
                            <li class="active">Profile Boost</li>
                            <li class="active">Priority Support</li>
                        </ul>

                        <a href="login.html" class="plan-btn primary">Choose Plan</a>
                    </div>
                </div>

                <!-- Gold -->
                <div class="col-lg-3 col-md-6">
                    <div class="pricing-card">
                        <h4 class="plan-title">Gold</h4>
                        <p class="plan-sub">Premium Experience</p>
                        <h3 class="price">₹1499<span>/month</span></h3>

                        <ul class="features">
                            <li class="active">All Silver Features</li>
                            <li class="active">Profile Highlight</li>
                            <li class="active">Direct Chat Access</li>
                            <li class="active">Relationship Manager</li>
                        </ul>

                        <a href="login.html" class="plan-btn">Choose Plan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================> Membership end here <================== -->
@endsection
