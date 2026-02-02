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
    <style>
        .pageheader {
            padding-block: 0px !important;
        }

        .default-btn:hover,
        .default-btn:hover span {
            color: var(--green-color) !important
        }

        .contact-item img {
            background: var(--orange-color);
            border-radius: 30%;
            padding: 1rem;
        }
    </style>

    <style>
        .contact-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .contact-info {
            background: linear-gradient(135deg, var(--orange-color), var(--green-color));
            position: relative;
        }

        .icon-circle {
            width: 90px;
            height: 90px;
            background: #fff;
            color: #6366f1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 36px;
        }

        .btn-submit {
            background: var(--primary-color2);
            color: #fff !important;
            padding: 14px;
            font-weight: 600;
            border-radius: 6px;
            border: none;

        }

        .btn-submit:hover {
            opacity: 0.9;
        }

        .form-control {
            padding: 12px;
            border-radius: 4px;
        }

        .contact-content p {
            height: 2rem;
        }

    </style>
    <style>
        .find-us-item {
            position: relative;
            background: #fff;
            padding: 30px 20px;
            border-radius: 12px;
            transition: all 0.35s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .find-us-item:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
             border-radius: 20%;
        }

        .find-us-item::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(242, 91, 0, 0.12), rgba(255, 186, 120, 0.15));
            opacity: 0;
            transition: opacity 0.35s ease;
            z-index: -1;
        }

        .find-us-item:hover::after {
            opacity: 1;
        }

        .find-us-item .contact-thumb img {
            transition: transform 0.35s ease;
        }

        .find-us-item:hover .contact-thumb img {
            transform: scale(1.15) rotate(3deg);
        }

        .find-us-item .title {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .find-us-item p {
            color: #555;
            font-size: 15px;
        }
    </style>
@endsection

{{-- custom script for this page --}}
@section('script')
    <script></script>
@endsection

@section('content')
    {{-- assets/images/bg-img/pageheader.jpg --}}
    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url(assets/images/banner/banner-hero2.jpeg);">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2>Contact Us</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ================> Page Header section end here <================== -->

    <!-- ===========Info Section Ends Here========== -->
    <div class="info-section padding-top padding-bottom">
        <div class="container">
            <div class="section__header style-2 text-center">
                <h2 class="section-heading">Reach Out to Us</h2>
                <p>Let us know your opinions. Also you can write us if you have any questions.</p>
            </div>
            <div class="section-wrapper">
                <div class="row justify-content-center g-4">

                    <!-- Address -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="contact-item text-center find-us-item">
                            <div class="contact-thumb mb-4">
                                <img src="{{ asset('assets/images/contact/icon/01.png') }}" alt="Office Address">
                            </div>
                            <div class="contact-content">
                                <h6 class="title">Visit Our Office</h6>
                                <p>{{ $company->address1 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="contact-item text-center find-us-item">
                            <div class="contact-thumb mb-4">
                                <img src="{{ asset('assets/images/contact/icon/02.png') }}" alt="Phone Number">
                            </div>
                            <div class="contact-content">
                                <h6 class="title">Call Us</h6>
                                <p>{{ $company->phone1 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="contact-item text-center find-us-item">
                            <div class="contact-thumb mb-4">
                                <img src="{{ asset('assets/images/contact/icon/03.png') }}" alt="Email">
                            </div>
                            <div class="contact-content">
                                <h6 class="title">Email Us</h6>
                                <p>{{ $company->email1 }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- ===========Info Section Ends Here========== -->

    <section class="contact-section py-5 bg-light">
        <div class="container">
            <div class="row g-0 contact-card">

                <!-- LEFT : FORM + ADDRESS -->
                <div class="col-lg-7 p-5 bg-white">
                    <h4 class="fw-bold mb-2">Address</h4>
                    <p class="text-muted mb-4">
                        {{ $company->address1 }}
                    </p>

                    <h3 class="fw-bold mb-4">Feedback</h3>
                    @include('components.success-modal')
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="contact">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control" placeholder="Phone"
                                    value="{{ old('phone') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="subject" class="form-control" placeholder="Subject"
                                    value="{{ old('subject') }}" required>
                            </div>

                            <div class="col-12">
                                <textarea name="message" rows="5" class="form-control" placeholder="Message" required>{{ old('message') }}</textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-submit w-100">
                                    Submit Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- RIGHT : CONTACT INFO -->
                <div class="col-lg-5 contact-info text-white text-center p-5"
                    style="background:url('assets/images/contact/right.png');background-size:100% 100%">
                    {{-- <div class="icon-circle mb-4">
                        <i class="fas fa-phone-alt"></i>
                    </div>

                    <h3 class="fw-bold mb-3">Call Us</h3>
                    <p class="mb-1">{{ $company->phone1 }}</p>
                    <p class="mb-4">{{ $company->phone2 ?? '' }}</p>

                    <h5 class="fw-bold mt-4">Email</h5>
                    <p>{{ $company->email1 }}</p>

                    <h5 class="fw-bold mt-4">Office Time</h5>
                    <p>9 A.M To 5 P.M.</p> --}}
                </div>

            </div>
        </div>
    </section>


    <!-- ================> contact section start here <================== -->
    @include('components.success-modal')
    <div class="contact-section bg-white">
        {{-- <div class="contact-top padding-top padding-bottom">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <div class="contact-form-wrapper text-center"
                            style="padding:1rem;box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);border-radius:10px">
                            <h2>Contact Us</h2>
                            <p class="mb-5">Let us know your opinions. Also you can write us if you have any questions.
                            </p>
                            <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="contact">

                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Your Name"
                                        value="{{ old('name') }}" class="@error('name') is-invalid @enderror" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Your Email"
                                        value="{{ old('email') }}" class="@error('email') is-invalid @enderror"
                                        required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text" name="phone" placeholder="Phone"
                                        value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror"
                                        required>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text" name="subject" placeholder="Subject"
                                        value="{{ old('subject') }}" class="@error('subject') is-invalid @enderror"
                                        required>
                                    @error('subject')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group w-100">
                                    <textarea name="message" rows="8" placeholder="Your Message" class="@error('message') is-invalid @enderror"
                                        required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group w-100 text-center">
                                    <button class="default-btn reverse" type="submit">
                                        <span>Send Message</span>
                                    </button>
                                </div>
                            </form>

                            <p class="form-message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="contact-bottom">
            <div class="contac-bottom">
                <div class="row justify-content-center g-0">
                    <div class="col-12">
                        <div class="location-map">
                            <div id="map">

                                {!! $company->google_map_location !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================> contact section end here <================== -->
@endsection
