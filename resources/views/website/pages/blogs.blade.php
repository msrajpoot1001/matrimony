@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Blogs | Prajapati Ghatasutra
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
        }

        .mainmenu ul li a {
            padding: 10px 5px !important;
        }
    </style>
@endsection

{{-- custom script for this page --}}
@section('script')
    <script></script>
@endsection

@section('content')
    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url(assets/images/bg-img/pageheader.jpg);">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2>Our Blog Post</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ================> Page Header section end here <================== -->

    <!-- ================> Blog section start here <================== -->
    <div class="blog padding-top padding-bottom">
        <div class="container">
            <div class="section-wrapper">
                <div class="row g-4 justify-content-center">
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="blog__item">
                            <div class="blog__inner">
                                <div class="blog-thumb">
                                    <img src="assets/images/blogs/img1.webp" alt="Find Your Perfect Life Partner"
                                        class="w-100">
                                </div>
                                <div class="blog__content px-3 py-4">
                                    <a href="blog-single.html">
                                        <h3>How to Find Your Perfect Life Partner Through Matrimony</h3>
                                    </a>
                                    <div class="blog__metapost">
                                        <a href="#">Admin</a>
                                        <a href="#">10 March 2024</a>
                                    </div>
                                    <p>Choosing the right life partner is one of the most important decisions. Learn how our
                                        matrimony platform helps you find compatible matches.</p>
                                    <a href="blog-single.html" class="default-btn"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="blog__item">
                            <div class="blog__inner">
                                <div class="blog__thumb">
                                    <img src="assets/images/blogs/img1.webp" alt="Matrimony Profile Tips" class="w-100">
                                </div>
                                <div class="blog__content px-3 py-4">
                                    <a href="blog-single.html">
                                        <h3>Tips to Create an Attractive Matrimony Profile</h3>
                                    </a>
                                    <div class="blog__metapost">
                                        <a href="#">Admin</a>
                                        <a href="#">18 March 2024</a>
                                    </div>
                                    <p>Your profile is the first impression. Discover simple yet effective tips to create a
                                        profile that attracts genuine matches.</p>
                                    <a href="blog-single.html" class="default-btn"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="blog__item">
                            <div class="blog__inner">
                                <div class="blog__thumb">
                                    <img src="assets/images/blogs/img1.webp" alt="Safe Online Matrimony" class="w-100">
                                </div>
                                <div class="blog__content px-3 py-4">
                                    <a href="blog-single.html">
                                        <h3>Safe and Secure Online Matrimony: What You Should Know</h3>
                                    </a>
                                    <div class="blog__metapost">
                                        <a href="#">Admin</a>
                                        <a href="#">25 March 2024</a>
                                    </div>
                                    <p>We prioritize your privacy and safety. Learn about the security features that protect
                                        your personal information.</p>
                                    <a href="blog-single.html" class="default-btn"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="blog__item">
                            <div class="blog__inner">
                                <div class="blog__thumb">
                                    <img src="assets/images/blogs/img1.webp" alt="Compatibility in Marriage" class="w-100">
                                </div>
                                <div class="blog__content px-3 py-4">
                                    <a href="blog-single.html">
                                        <h3>Why Compatibility Matters More Than Perfection in Marriage</h3>
                                    </a>
                                    <div class="blog__metapost">
                                        <a href="#">Admin</a>
                                        <a href="#">02 April 2024</a>
                                    </div>
                                    <p>Compatibility builds strong relationships. Understand the key factors that lead to a
                                        happy and lasting marriage.</p>
                                    <a href="blog-single.html" class="default-btn"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="blog__item">
                            <div class="blog__inner">
                                <div class="blog__thumb">
                                    <img src="assets/images/blogs/img1.webp" alt="Successful Marriage Stories"
                                        class="w-100">
                                </div>
                                <div class="blog__content px-3 py-4">
                                    <a href="blog-single.html">
                                        <h3>Real Success Stories: Finding Love Through Our Matrimony</h3>
                                    </a>
                                    <div class="blog__metapost">
                                        <a href="#">Admin</a>
                                        <a href="#">12 April 2024</a>
                                    </div>
                                    <p>Read inspiring success stories of couples who found their perfect match through our
                                        trusted matrimony platform.</p>
                                    <a href="blog-single.html" class="default-btn"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="blog__item">
                            <div class="blog__inner">
                                <div class="blog__thumb">
                                    <img src="assets/images/blogs/img1.webp" alt="Family-Oriented Matchmaking"
                                        class="w-100">
                                </div>
                                <div class="blog__content px-3 py-4">
                                    <a href="blog-single.html">
                                        <h3>Family-Oriented Matchmaking for Meaningful Relationships</h3>
                                    </a>
                                    <div class="blog__metapost">
                                        <a href="#">Admin</a>
                                        <a href="#">20 April 2024</a>
                                    </div>
                                    <p>Our matrimony service focuses on family values, cultural compatibility, and long-term
                                        relationship goals.</p>
                                    <a href="blog-single.html" class="default-btn"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- ================> Blog section end here <================== -->
@endsection
