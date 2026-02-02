@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Astrology Service | Prajapati Ghatasutra
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

        .default-btn {}
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
                <h2>Register For Astrology</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Astrology Service</li>
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
                    {{-- <div class="col-lg-12 wow fadeInTop">
                        <div class="about__left">
                            <div class="about__top">
                                <div class="about__content">
                                    <h3>Welcome to Prajapati Ghatasutra</h3>
                                    <p>
                                        Prajapati Ghatasutra provides trusted astrology services to guide life decisions
                                        through accurate horoscope analysis, kundali matching, and traditional wisdom for
                                        harmony and success.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div> --}}

                    <div class="col-lg-12 wow fadeInTop website_animation">
                        <div class="about__right">
                            <div class="about__title">
                                <h3>Astrology Registration Details</h3>
                            </div>

                            <form action="{{ route('astrology.store') }}" method="POST">
                                @csrf
                                <!-- Astrologer Details -->
                                <div class="banner__list">
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="banner__inputlist radio-select mt-2">
                                                <label class="label-head">I am Service Provider Consumer?
                                                    <span class="astrick">*</span></label>
                                                <div class="input-sec">
                                                    <label class="radio-card">
                                                        <input type="radio" name="user_type" value="yes"
                                                            {{ old('user_type') == 'yes' ? 'checked' : '' }} required>
                                                        <span>Yes</span>
                                                    </label>

                                                    <label class="radio-card">
                                                        <input type="radio" name="user_type" value="no"
                                                            {{ old('user_type') == 'no' ? 'checked' : '' }} required>
                                                        <span>No</span>
                                                    </label>
                                                </div>
                                            </div>

                                            @error('user_type')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Name <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="name" placeholder="Full Name"
                                                    value="{{ old('name') }}" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Email <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="email" name="email" placeholder="Enter Email"
                                                    value="{{ old('email') }}" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Gender <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <select id="gender" name="gender" required>
                                                    <option value="">Select</option>
                                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                                        Male</option>
                                                    <option value="Female"
                                                        {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Date of Birth (mm/dd/yyyy)</label>
                                            <div class="banner__inputlist">
                                                <input type="date" name="dob" value="{{ old('dob') }}">
                                                @error('dob')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Contact Number <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="tel" name="contact_number"
                                                    placeholder="Enter Contact Number" value="{{ old('contact_number') }}"
                                                    required oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                                                @error('contact_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>WhatsApp Number</label>
                                            <div class="banner__inputlist">
                                                <input type="tel" name="whatsapp_number"
                                                    placeholder="Enter WhatsApp Number"
                                                    value="{{ old('whatsapp_number') }}"
                                                    oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                                                @error('whatsapp_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Specialization <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="specialization"
                                                    placeholder="Vedic, KP, Numerology, Palmistry, Tarot, etc."
                                                    value="{{ old('specialization') }}" required>
                                                @error('specialization')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Years of Experience <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="experience_years" placeholder="e.g. 12"
                                                    value="{{ old('experience_years') }}" required
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                                                @error('experience_years')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Location <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="location" placeholder="City / Area"
                                                    value="{{ old('location') }}" required>
                                                @error('location')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Astrology Services Offered <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <select name="services_offered" required>
                                                    <option value="">Select</option>
                                                    <option value="Marriage Matching"
                                                        {{ old('services_offered') == 'Marriage Matching' ? 'selected' : '' }}>
                                                        Marriage Matching</option>
                                                    <option value="Horoscope Reading"
                                                        {{ old('services_offered') == 'Horoscope Reading' ? 'selected' : '' }}>
                                                        Horoscope Reading</option>
                                                    <option value="Kundali Analysis"
                                                        {{ old('services_offered') == 'Kundali Analysis' ? 'selected' : '' }}>
                                                        Kundali Analysis</option>
                                                    <option value="Career Guidance"
                                                        {{ old('services_offered') == 'Career Guidance' ? 'selected' : '' }}>
                                                        Career Guidance</option>
                                                    <option value="Business Astrology"
                                                        {{ old('services_offered') == 'Business Astrology' ? 'selected' : '' }}>
                                                        Business Astrology</option>
                                                    <option value="Health Astrology"
                                                        {{ old('services_offered') == 'Health Astrology' ? 'selected' : '' }}>
                                                        Health Astrology</option>
                                                    <option value="Vastu Consultation"
                                                        {{ old('services_offered') == 'Vastu Consultation' ? 'selected' : '' }}>
                                                        Vastu Consultation</option>
                                                    <option value="Numerology"
                                                        {{ old('services_offered') == 'Numerology' ? 'selected' : '' }}>
                                                        Numerology</option>
                                                    <option value="Gemstone Recommendation"
                                                        {{ old('services_offered') == 'Gemstone Recommendation' ? 'selected' : '' }}>
                                                        Gemstone Recommendation</option>
                                                    <option value="Other"
                                                        {{ old('services_offered') == 'Other' ? 'selected' : '' }}>Other
                                                    </option>
                                                </select>
                                                @error('services_offered')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>If Other, Specify</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="other_service"
                                                    placeholder="Specify service (optional)"
                                                    value="{{ old('other_service') }}">
                                                @error('other_service')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="banner__list">
                                            <label>Additional Requirements</label>
                                            <div class="banner__inputlist">
                                                <textarea name="add_require" rows="3" placeholder="Decoration, parking, AC hall, food arrangement, etc.">{{ old('add_require') }}</textarea>
                                                @error('add_require')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <button type="submit" class="default-btn reverse d-block"
                                    style="background: white !important;
                                    color: black !important;">
                                    <span>Submit Astrologer Profile</span>
                                </button>

                            </form>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
