@extends('website.layouts.app')
{{-- title for this page --}}
@section('title')
    Divine Astro Products | Prajapati Ghatasutra
@endsection

{{-- meta description --}}
@section('meta_description')
    Explore authentic Divine Astro Products by Prajapati Ghatasutra. Energized spiritual items, astrology remedies, and
    sacred products designed for peace, prosperity, and positivity.
@endsection

{{-- meta keywords --}}
@section('meta_keywords')
    Divine Astro Products, Astrology Products, Spiritual Remedies, Vastu Products, Energized Puja Items, Astrology
    Solutions, Prajapati Ghatasutra, Spiritual Healing Products
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
    <div class="pageheader bg_img" style="background-image: url(assets/images/banner/banner-hero2.jpeg);">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2>Prajapati Divine Astro Products</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Prajapati Astro Divine Products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ================> Page Header section end here <================== -->

    <!-- ================> karma training start here <================== -->
    <div class="blog karma-section main-karma-section padding-top padding-bottom">
        <div class="container">
            <div class="section-wrapper">


                <div class="row g-4 ">

                    @foreach ($items as $item)
                        <div class="col-lg-3 col-12">
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
                                                <img src="{{ asset($item->photo) }}" alt="blog-thumb" class="w-100"
                                                    style="height:15rem">
                                            @endif
                                        @endif

                                    </div>
                                    <div class="blog__content px-3 py-3">
                                        <a href="{{ route('astro.product.detail', $item->slug) }}">
                                            <h3 style="min-height:3rem;overflow:hidden">{{ $item->name }}</h3>
                                        </a>
                                        <div class="blog__metapost" style="margin:0px">
                                            <a>
                                                <h2>₹ {{ $item->price }}</h2>
                                            </a>
                                        </div>
                                        <p>
                                            {!! $item->short_description !!}
                                        </p>
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


                    <div class="d-flex justify-content-center mt-4">
                        <nav class="pagination-sm">
                            {{ $items->links('pagination::bootstrap-5') }}
                        </nav>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- ================> karma training end here <================== -->
@endsection
