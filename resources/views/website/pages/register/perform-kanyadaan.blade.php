@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Kanyadaan Seva (Wish Fulfillment) | Prajapati Ghatasutra
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
        .about--style2 .about__right .default-btn {
            color: black;
        }

        input,
        select {
            width: 100% !important;
            font-weight: bold !important;
        }

        input::placeholder,
        textarea::placeholder {
            color: white
        }

        .banner__list h6 {
            margin-top: 1rem;
        }

        .banner__inputlist select {
            padding-block: 10px !important;
        }
    </style>
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
    <script>
        document.getElementById('looking_for').addEventListener('change', function() {
            const gender = document.getElementById('gender');

            if (this.value === 'Bride') {
                gender.value = 'Male';
            } else if (this.value === 'Groom') {
                gender.value = 'Other';
            } else {
                gender.value = '';
            }
        });
    </script>
@endsection

@section('content')
    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url('{{ asset('assets/images/banner/banner-hero2.jpeg') }}');">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2>Kanyadaan Seva (Wish Fulfillment)</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Kanyadaan Seva (Wish Fulfillment)</li>
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
                                <h3>Kanyadaan Seva (Wish Fulfillment) Registration</h3>
                            </div>

                            <form action="{{ route('perform.kanyadan.store') }}" method="POST">
                                @csrf
                                <!-- Donor Details -->
                                <div class="banner__list">
                                    <div class="row">

                                        <div class="col-6">
                                            <label>Donor Name <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="donor_name" placeholder="Full Name"
                                                    value="{{ old('donor_name') }}" required>
                                            </div>
                                            @error('donor_name')
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
                                                <select id="gender" name="gender" required>
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
                                            <label>Date of Birth ( mm/dd/yyyy)</label>
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
                                                    required>
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
                                                    placeholder="Enter WhatsApp Number">
                                            </div>
                                            @error('whatsapp_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Type of Kanyadan Support <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <select name="kanyadan_type" required>
                                                    <option value="">Select</option>
                                                    <option value="Complete Kanyadan"
                                                        {{ old('kanyadan_type') == 'Complete Kanyadan' ? 'selected' : '' }}>
                                                        Complete Kanyadan</option>
                                                    <option value="Financial Support"
                                                        {{ old('kanyadan_type') == 'Financial Support' ? 'selected' : '' }}>
                                                        Financial Support</option>
                                                    <option value="Marriage Ritual Expenses"
                                                        {{ old('kanyadan_type') == 'Marriage Ritual Expenses' ? 'selected' : '' }}>
                                                        Marriage Ritual Expenses</option>
                                                    <option value="Clothing & Jewelry"
                                                        {{ old('kanyadan_type') == 'Clothing & Jewelry' ? 'selected' : '' }}>
                                                        Clothing & Jewelry</option>
                                                    <option value="Food & Catering"
                                                        {{ old('kanyadan_type') == 'Food & Catering' ? 'selected' : '' }}>
                                                        Food & Catering</option>
                                                    <option value="Mandap & Decoration"
                                                        {{ old('kanyadan_type') == 'Mandap & Decoration' ? 'selected' : '' }}>
                                                        Mandap & Decoration</option>
                                                    <option value="Other"
                                                        {{ old('kanyadan_type') == 'Other' ? 'selected' : '' }}>Other
                                                    </option>
                                                </select>
                                            </div>
                                            @error('kanyadan_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>If Other, Specify</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="other_kanyadan" placeholder="Specify support"
                                                    value="{{ old('other_kanyadan') }}">
                                            </div>
                                            @error('other_kanyadan')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Donation Amount</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="donation_amount" placeholder="₹ Amount"
                                                    value="{{ old('donation_amount') }}"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            </div>
                                            @error('donation_amount')
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

                                <!-- Blessing / Sankalp -->
                                <div class="banner__list">
                                    <label>Blessings / Sankalp</label>
                                    <div class="banner__inputlist">
                                        <textarea name="blessings" rows="3"
                                            placeholder="Your blessings or sankalp for the bride’s happy married life...">{{ old('blessings') }}</textarea>
                                    </div>
                                    @error('blessings')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <button type="submit" class="default-btn reverse d-block"
                                    style="background: white !important;
                                    color: black !important;">
                                    <span>Donate Kanyadan</span>
                                </button>

                            </form>

                            <div class="img_head">
                                <img src="{{ asset('assets/qr/qr_scanner.png') }}" />
                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
