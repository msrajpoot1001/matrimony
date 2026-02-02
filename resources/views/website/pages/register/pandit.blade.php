@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Pandit Service | Prajapati Ghatasutra
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
        .form-check {
            margin-left: 0.8rem;
            margin-right: 0.8rem;


        }


        .form-check-input {
            height: 20px !important;
            width: 20px !important;
            margin-top: 0.8rem !important;

        }

        .form-check label {
            color: black !important;
        }
    </style>
@endsection


@section('content')
    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url('{{ asset('assets/images/banner/banner-hero2.jpeg') }}');">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2>Register For Pandit/Priest</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Pandit/Priest Service</li>
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
                                <h3>Pandit/Priest Registration Details</h3>
                            </div>

                            <form action="{{ route('pandit.store') }}" method="POST">
                                @csrf
                                <!-- Pandit Details -->
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
                                                <input type="text" name="name" placeholder="Full Name"
                                                    value="{{ old('name') }}" required>
                                            </div>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Email</label>
                                            <div class="banner__inputlist">
                                                <input type="email" name="email" placeholder="Enter Email"
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
                                            <label>Qualification <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="qualification"
                                                    value="{{ old('qualification') }}"
                                                    placeholder="Veda, Shastri, Acharya, etc." required>
                                            </div>
                                            @error('qualification')
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


                                        <div class="banner__list">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label>
                                                        Services You Experienced In <span class="astrick">*</span>
                                                    </label>

                                                    <div class="banner__inputlist checkbox-head">

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="Marriage"
                                                                id="service_marriage"
                                                                {{ in_array('Marriage', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="service_marriage">Marriage</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="Thread Ceremony"
                                                                id="service_thread"
                                                                {{ in_array('Thread Ceremony', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="service_thread">Thread
                                                                Ceremony</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="House Warming"
                                                                id="service_house"
                                                                {{ in_array('House Warming', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="service_house">House
                                                                Warming</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="Birthday"
                                                                id="service_birthday"
                                                                {{ in_array('Birthday', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="service_birthday">Birthday</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="100 Days Celebration"
                                                                id="service_100days"
                                                                {{ in_array('100 Days Celebration', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="service_100days">100 Days
                                                                Celebration</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="Shradha"
                                                                id="service_shradha"
                                                                {{ in_array('Shradha', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="service_shradha">Shradha</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="Pinda Dana"
                                                                id="service_pinda"
                                                                {{ in_array('Pinda Dana', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="service_pinda">Pinda
                                                                Dana</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="Puja for Harmony"
                                                                id="service_puja"
                                                                {{ in_array('Puja for Harmony', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="service_puja">Puja for
                                                                Harmony</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="Funeral Rituals"
                                                                id="service_funeral"
                                                                {{ in_array('Funeral Rituals', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="service_funeral">Funeral
                                                                Rituals</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="services_offered[]" value="Other"
                                                                id="service_other"
                                                                {{ in_array('Other', old('services_offered', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="service_other">Other</label>
                                                        </div>

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

                                    </div>
                                </div>

                                <!-- Additional Requirements -->
                                <div class="banner__list"> <label>Additional Note</label>
                                    <div class="banner__inputlist">
                                        <textarea name="add_require" rows="3" placeholder="Decoration, parking, AC hall, food arrangement, etc."></textarea>
                                    </div>
                                </div>



                                <button type="submit" class="default-btn reverse d-block"
                                    style="background: white !important;
                                    color: black !important;">
                                    <span>Submit Pandit Profile</span>
                                </button>

                            </form>



                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
