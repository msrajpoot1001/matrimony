@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    {{ $karma_detail->title }} | Prajapati Ghatasutra
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

        .widget-author .author-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .widget-author .author-img img {
            border: 3px solid var(--primary-color, #f25b00);
        }

        .widget-author h6 {
            font-weight: 600;

        }

        .widget-header1 h5 {
            padding-top: 1rem !important;
            margin: 0px !important;
        }

        .view-profile-btn {
            border: 1px solid var(--orange-color) !important;
            color: var(--orange-color) !important;
        }

        .view-profile-btn:hover {
            color: white !important;
            background: var(--orange-color) !important;
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
                        <h2 class="mb-4">{{ $karma_detail->title }}</h2>
                    </div>
                    <div class="col-lg-8 col-12">

                        <article>
                            <div class="blog__item">
                                <div class="blog__inner">
                                    <div class="blog__thumb">
                                        {{-- <img src="{{ asset($karma_detail->photo) }}" alt="blog"> --}}
                                        @if (\Illuminate\Support\Str::endsWith($karma_detail->photo, ['.mp4', '.mov', '.avi', '.webm']))
                                            <video class="w-100" autoplay muted loop playsinline
                                                oncontextmenu="return false;">

                                                <source src="{{ asset($karma_detail->photo) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="{{ asset($karma_detail->photo) }}" alt="blog-thumb" class="w-100">
                                        @endif
                                    </div>
                                    <div class="blog__content">


                                        <div>
                                            {!! $karma_detail->description !!}
                                        </div>
                                        <blockquote class="single-quote mb-4">
                                            <div class="quotes">
                                                {!! $karma_detail->short_description !!}
                                            </div>
                                        </blockquote>
                                    </div>



                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-4 col-md-7 col-12">
                        <aside>


                            @if ($karma_detail->author_name)
                                <div class="widget widget-author text-center">
                                    <div class="widget-header widget-header1">
                                        <h5>Course Publisher</h5>
                                    </div>

                                    <div class="author-box p-3">
                                        <div class="author-img mb-3">
                                            <img src="{{ asset($karma_detail->author_photo) }}" alt="Publisher"
                                                class="rounded-circle img-fluid" width="100" height="100">
                                        </div>

                                        <h6 class="mb-1">{{ $karma_detail->author_name }}</h6>

                                        <p class="small text-muted mb-2">
                                            {{ Str::words(strip_tags($karma_detail->author_description), 20) }}
                                        </p>

                                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary view-profile-btn"
                                            data-bs-toggle="modal" data-bs-target="#authorProfileModal">
                                            View Profile
                                        </a>
                                    </div>
                                </div>
                            @endif



                            <div class="widget widget-post">
                                <div class="widget-header">
                                    <h5>Recent Training Session</h5>
                                </div>
                                <ul class="lab-ul widget-wrapper">
                                    @foreach ($items as $item)
                                        <li class="d-flex align-items-start mb-3">

                                            <!-- 1 part (thumb) -->
                                            <div class="">
                                                <a href="{{ route('karma.details', $item->slug) }}">
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
                                                            class="img-fluid rounded">
                                                    @endif
                                                </a>
                                                <div class="">
                                                    <a href="{{ route('karma.details', $item->slug) }}">
                                                        <h6 class="mb-1">{{ $item->title }}</h6>
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


    <div class="modal fade" id="authorProfileModal" tabindex="-1" aria-labelledby="authorProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="authorProfileModalLabel">
                        {{ $karma_detail->author_name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <img src="{{ asset($karma_detail->author_photo) }}" class="rounded-circle mb-3" width="120"
                        height="120" alt="{{ $karma_detail->author_name }}">

                    <div class="text-start mt-3">
                        {!! $karma_detail->author_description !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
