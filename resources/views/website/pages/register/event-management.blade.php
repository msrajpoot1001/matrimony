@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Event Management Service | Prajapati Ghatasutra
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
                <h2>Register For Event Management</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Event Management Service</li>
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
                                <h3>Event Management Registration Details</h3>
                            </div>

                            <form action="{{ route('event.management.store') }}" method="POST">
                                @csrf
                                <!-- Service Provider Details -->
                                <div class="banner__list">
                                    <div class="row">


                                        <!-- User Type -->
                                        <div class="col-6">
                                            <div class="banner__inputlist radio-select mt-2">
                                                <label class="label-head">
                                                    I am Service Provider Consumer?
                                                    <span class="astrick">*</span>
                                                </label>

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
                                            <label>Full Name <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="full_name" value="{{ old('full_name') }}"
                                                    placeholder="Full Name" required>
                                            </div>

                                            @error('full_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Email</label>
                                            <div class="banner__inputlist">
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                    placeholder="Enter Email">
                                            </div>

                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
                                            </div>

                                            @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Date of Birth (mm/dd/yyyy)<span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="date" name="dob" value="{{ old('dob') }}" required>
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
                                            <label>Years of Experience <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="experience_years"
                                                    value="{{ old('experience_years') }}" placeholder="e.g. 12" required
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                                            </div>

                                            @error('experience_years')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Location <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="location" value="{{ old('location') }}"
                                                    placeholder="City / Area" required>
                                            </div>

                                            @error('location')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                                <!-- Services Offered -->
                                <div class="banner__list">
                                    <div class="row">

                                        <div class="col-6">
                                            <label>Looking For (Services) <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <select name="services_offered" required>
                                                    <option value="">Select</option>
                                                    <option value="Marriage"
                                                        {{ old('services_offered') == 'Marriage' ? 'selected' : '' }}>
                                                        Marriage</option>
                                                    <option value="Thread Ceremony"
                                                        {{ old('services_offered') == 'Thread Ceremony' ? 'selected' : '' }}>
                                                        Thread Ceremony</option>
                                                    <option value="House Warming"
                                                        {{ old('services_offered') == 'House Warming' ? 'selected' : '' }}>
                                                        House Warming</option>
                                                    <option value="Birthday"
                                                        {{ old('services_offered') == 'Birthday' ? 'selected' : '' }}>
                                                        Birthday</option>
                                                    <option value="100 Days Celebration"
                                                        {{ old('services_offered') == '100 Days Celebration' ? 'selected' : '' }}>
                                                        100 Days Celebration</option>
                                                    <option value="Shradha"
                                                        {{ old('services_offered') == 'Shradha' ? 'selected' : '' }}>
                                                        Shradha</option>
                                                    <option value="Pinda Dana"
                                                        {{ old('services_offered') == 'Pinda Dana' ? 'selected' : '' }}>
                                                        Pinda Dana</option>
                                                    <option value="Puja for Harmony"
                                                        {{ old('services_offered') == 'Puja for Harmony' ? 'selected' : '' }}>
                                                        Puja for Harmony</option>
                                                    <option value="Funeral Rituals"
                                                        {{ old('services_offered') == 'Funeral Rituals' ? 'selected' : '' }}>
                                                        Funeral Rituals</option>
                                                    <option value="Other"
                                                        {{ old('services_offered') == 'Other' ? 'selected' : '' }}>Other
                                                    </option>
                                                </select>
                                            </div>

                                            @error('services_offered')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>If Other, Specify</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="other_service"
                                                    value="{{ old('other_service') }}"
                                                    placeholder="Specify service (optional)">
                                            </div>

                                            @error('other_service')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                                <!-- Additional Requirements -->
                                <div class="banner__list">
                                    <label>Additional Note</label>
                                    <div class="banner__inputlist">
                                        <textarea name="add_require" rows="3" placeholder="Decoration, parking, AC hall, food arrangement, etc.">{{ old('add_require') }}</textarea>
                                    </div>

                                    @error('add_require')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <button type="submit" class="default-btn reverse d-block"
                                    style="background: white !important;
                                    color: black !important;">
                                    <span>Submit Service Provider Profile</span>
                                </button>

                            </form>



                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
