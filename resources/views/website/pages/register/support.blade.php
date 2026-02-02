@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Wish to contribute for a Happy marriage of Financially Backward Family Service | Prajapati Ghatasutra
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
        .img_head {
            display: flex;
            justify-content: center;
            padding: 2rem 1rem;
        }
    </style>
@endsection

{{-- custom script for this page --}}
@section('script')
@endsection

@section('content')
    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url('{{ asset('assets/images/banner/banner-hero2.jpeg') }}');">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2>Wish to contribute</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Wish to contribute </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ================> Page Header section end here <================== -->
    @include('components.success-modal')
    <!-- ================> About section start here <================== -->
    <div class="about about--style2 padding-top pt-xl-0" style="margin-top:2rem">
        <div class="container">
            <div class="section__wrapper wow fadeInUp" data-wow-duration="1.5s">
                <div class="row g-0 justify-content-center row-cols-lg-2 row-cols-1">

                    <div class="col-lg-12 wow fadeInTop website_animation">
                        <div class="about__right">
                            <div class="about__title">
                                <h3>Wish to contribute for a Happy marriage of Financially Backward Family</h3>
                            </div>

                            <form action="{{ route('support.store') }}" method="POST">
                                @csrf
                                <!-- Contributor Details -->
                                <div class="banner__list">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Full Name <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="full_name" placeholder="Full Name"
                                                    value="{{ old('full_name') }}" required>
                                            </div>
                                            @error('full_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Email Address</label>
                                            <div class="banner__inputlist">
                                                <input type="email" name="email" placeholder="Email Address"
                                                    value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Gender</label>
                                            <div class="banner__inputlist">
                                                <select id="gender" name="gender">
                                                    <option value="">Select</option>
                                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="Female"
                                                        {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                            @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Date of Birth (mm/dd/yyyy)</label>
                                            <div class="banner__inputlist">
                                                <input type="date" name="dob" value="{{ old('dob') }}">
                                            </div>
                                            @error('dob')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Contact Number <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="tel" name="contact_number"
                                                    value="{{ old('contact_number') }}" placeholder="Enter Contact Number"
                                                    required oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                                            </div>
                                            @error('contact_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>WhatsApp Number</label>
                                            <div class="banner__inputlist">
                                                <input type="tel" name="whatsapp_number"
                                                    value="{{ old('whatsapp_number') }}"
                                                    placeholder="Enter WhatsApp Number"
                                                    oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                                            </div>
                                            @error('whatsapp_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Contribution Type <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <select name="contribution_type" required>
                                                    <option value="">Select</option>
                                                    <option value="Financial Support"
                                                        {{ old('contribution_type') == 'Financial Support' ? 'selected' : '' }}>
                                                        Financial Support</option>
                                                    <option value="Marriage Essentials"
                                                        {{ old('contribution_type') == 'Marriage Essentials' ? 'selected' : '' }}>
                                                        Marriage Essentials</option>
                                                    <option value="Food & Catering"
                                                        {{ old('contribution_type') == 'Food & Catering' ? 'selected' : '' }}>
                                                        Food & Catering</option>
                                                    <option value="Mandap & Decoration"
                                                        {{ old('contribution_type') == 'Mandap & Decoration' ? 'selected' : '' }}>
                                                        Mandap & Decoration</option>
                                                    <option value="Clothing & Jewelry"
                                                        {{ old('contribution_type') == 'Clothing & Jewelry' ? 'selected' : '' }}>
                                                        Clothing & Jewelry</option>
                                                    <option value="Other"
                                                        {{ old('contribution_type') == 'Other' ? 'selected' : '' }}>Other
                                                    </option>
                                                </select>
                                            </div>
                                            @error('contribution_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>If Other, Specify here</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="other_contribution"
                                                    placeholder="Specify contribution"
                                                    value="{{ old('other_contribution') }}">
                                            </div>
                                            @error('other_contribution')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Estimated Contribution Amount</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="amount" placeholder="₹ Amount"
                                                    value="{{ old('amount') }}"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            </div>
                                            @error('amount')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Transaction Id</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="transction_id" placeholder="Transaction Id"
                                                    value="{{ old('transction_id') }}">
                                            </div>
                                            @error('transction_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                    </div>
                                </div>


                                <!-- Additional Message -->
                                <div class="banner__list">
                                    <label>Message / Intention</label>
                                    <div class="banner__inputlist">
                                        <textarea name="message" rows="3" placeholder="Your intention or any message for the couple...">{{ old('message') }}</textarea>
                                    </div>
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <button type="submit" class="default-btn reverse d-block"
                                    style="background: white !important;
                                    color: black !important;">
                                    <span>Submit Contribution Request</span>
                                </button>

                            </form>



                        </div>


                    </div>
                    <div class="img_head">
                        <img src="{{ asset('assets/qr/qr_scanner.png') }}" />
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
