@extends('website.layouts.app')

@section('title', 'Privacy Policy | Prajapati Ghatasutra')


@section('style')
    <style>
        .navbar.validnavs.navbar-default .navbar-nav li a {
            color: white;
        }

        .navbar.validnavs.navbar-default.scrolled .navbar-nav li a {
            color: black !important;
        }

        .headerContact p,
        .headerContact h5 a {
            color: white !important;
        }

        .headerContact .icon i {
            color: #022b6d !important;
        }

        .navbar.validnavs.navbar-default.scrolled .headerContact p,
        .navbar.validnavs.navbar-default.scrolled .headerContact h5 a {
            color: #022b6d !important;
        }

        .navbar.validnavs.navbar-default.scrolled .headerContact .icon i {
            color: black !important;
        }
    </style>
@endsection

@section('content')



    {{-- <div class="breadcrumb-area bg-cover shadow dark text-center text-light"
        style="background-image: url(assets/img/banner/privacy_banner.jpg);">
        <div class="breadcrum-shape">

        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Privacy Policy</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Privacy Policy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="mt-4 mb-4">
        <h1 style="text-align: center">{{ $item->heading }}
        </h1>
        <div class="container">
            {!! $item->description !!}
        </div>

    </div>

@endsection
