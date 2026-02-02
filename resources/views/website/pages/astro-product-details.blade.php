@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    {{ $astro_products_detail->name }} | Prajapati Ghatasutra
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
    </style>
@endsection

{{-- custom script for this page --}}
@section('script')
    <script></script>
@endsection

@section('content')
    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url({{ asset('assets/images/banner/banner-hero2.jpeg') }}
);">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2> Prajapati Ghatasutra </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Karma Training Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ================> Page Header section end here <================== -->

    <!-- ================> Blog section start here <================== -->
    <div class="blog blog--style2 padding-top padding-bottom aside-bg">
        <div class="container">
            <div class="section-wrapper">

                <div class="row  pb-15">
                    <div class="col-lg-8 col-12">
                        <h2 class="mb-4">{{ $astro_products_detail->name }}</h2>
                    </div>
                    <div class="col-lg-8 col-12">

                        <article>
                            <div class="blog__item">
                                <div class="blog__inner">
                                    <div class="blog__thumb">
                                        {{-- <img src="{{ asset($astro_products_detail->photo) }}" alt="blog"> --}}
                                        @if (\Illuminate\Support\Str::endsWith($astro_products_detail->photo, ['.mp4', '.mov', '.avi', '.webm']))
                                            <video class="w-100" autoplay muted loop playsinline
                                                oncontextmenu="return false;">

                                                <source src="{{ asset($astro_products_detail->photo) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="{{ asset($astro_products_detail->photo) }}" alt="blog-thumb"
                                                class="w-100" style="height: 15rem;object-fit:contain;margin-top:2rem">
                                        @endif
                                    </div>
                                    <div class="blog__content">
                                        <h2 style="color:var(--green-color)">₹ {{ $astro_products_detail->price }}</h2>
                                        <a href="{{ route('astro.buy.now', $astro_products_detail->slug) }}"
                                            class="default-btn reverse default-primary-bg" style="margin-bottom:1rem">
                                            <span>Buy Now</span>
                                        </a>
                                        {{-- <ul class="blog__date">
                                            <li><span><i class="fa-solid fa-calendar-days"></i>January 01, 2022 10:59 am
                                                </span></li>
                                            <li><span><i class="fa-solid fa-user"></i><a href="#">Rajib Raj</a></span>
                                            </li>
                                            <li><span><i class="fa-solid fa-comments"></i><a href="#">09
                                                        Comments</a></span></li>
                                        </ul> --}}
                                        <div>
                                            {!! $astro_products_detail->description !!}
                                        </div>
                                        <blockquote class="single-quote mb-4">
                                            <div class="quotes">
                                                {!! $astro_products_detail->short_description !!}
                                            </div>
                                        </blockquote>
                                    </div>



                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-4 col-md-7 col-12">
                        <aside>

                            <div class="widget widget-post">
                                <div class="widget-header">
                                    <h5>Recent Training Session</h5>
                                </div>
                                <ul class="lab-ul widget-wrapper">
                                    @foreach ($items as $item)
                                        <li class="d-flex align-items-start mb-3">

                                            <!-- 1 part (thumb) -->
                                            <div class="">
                                                <a href="{{ route('astro.product.detail', $item->slug) }}">
                                                    @php
                                                        $ext = pathinfo($item->photo, PATHINFO_EXTENSION);
                                                    @endphp

                                                    @if (in_array(strtolower($ext), ['mp4', 'webm', 'ogg']))
                                                        <video class="w-100 rounded" autoplay muted loop playsinline
                                                            style="width:100%!important">
                                                            <source src="{{ asset($item->photo) }}">
                                                        </video>
                                                    @else
                                                        <img src="{{ asset($item->photo) }}" alt="product"
                                                            class="img-fluid rounded"
                                                            style="height: 10rem;object-fit:contain;">
                                                    @endif
                                                </a>
                                                <div class="mt-2">
                                                    <a href="{{ route('astro.product.detail', $item->slug) }}">
                                                        <h6 class="mb-1">{{ $item->name }}</h6>
                                                    </a>

                                                    <p class="mb-0 text-muted">
                                                        {{ $item->created_at->format('d F Y') }}
                                                    </p>
                                                </div>
                                            </div>


                                        </li>
                                    @endforeach


                                </ul>
                            </div>

                            {{-- <div class="widget widget-category">
                                <div class="widget-header">
                                    <h5>Post Categories</h5>
                                </div>
                                <ul class="lab-ul widget-wrapper list-bg-none">
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Show all</span><span>18</span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Business</span><span>20</span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Creative</span><span>25</span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Inspiation</span><span>30</span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>News</span><span>28</span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Photography</span><span>20</span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Smart</span><span>26</span></a>
                                    </li>
                                </ul>
                            </div> --}}

                            <div class="widget widget-category">
                                <div class="widget-header">
                                    <h5>Services</h5>
                                </div>
                                <ul class="lab-ul widget-wrapper list-bg-none">
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Match Making
                                                Service</span><span></span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Astrology
                                                Service</span><span></span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Mandap
                                                Service</span><span></span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Priest / Pandit
                                                Service</span><span></span></a>
                                    </li>

                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Food
                                                Catering</span><span></span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Event
                                                Management</span><span></span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Karma Kanda
                                                Training</span><span></span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Wish to contribute for a Happy
                                                marriage of Financially Backward Family</span><span></span></a>
                                    </li>
                                    <li>
                                        <a href="#" class="d-flex flex-wrap justify-content-between"><span><i
                                                    class="fa-solid fa-angles-right"></i>Wish To Perform
                                                Kanyadan</span><span></span></a>
                                    </li>

                                </ul>
                            </div>

                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> Blog section end here <================== -->
@endsection
