@extends('website.layouts.app')

@section('title', 'Cookie Policy | Prajapati Ghatasutra')

@section('content')


    <!-- Start Breadcrumb
                                                        ============================================= -->
    <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url(assets/img/banner/cookie_banner.jpeg);">
        <div class="breadcrum-shape">
            {{-- <img src="assets/img/shape/50.png" alt="Image Not Found"> --}}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Cookie Policy</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Cookie Policy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="mt-4 mb-4">
        <h1 style="text-align: center">{{ $item->heading }}
        </h1>
        <div class="container">
            {!! $item->description !!}
        </div>

    </div>
@endsection
