@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Karma Training Service | Prajapati Ghatasutra
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
                <h2>Register For Karma Training</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Karma Training Service</li>
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
                                <h3>Karma Training Registration Details</h3>
                            </div>

                            <form action="{{ route('karma.training.store') }}" method="POST">
                                @csrf

                                <div class="banner__list service-provider-fields">
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

                                        {{-- Full Name --}}
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

                                        {{-- Email --}}
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

                                        {{-- Gender --}}
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

                                        {{-- DOB --}}
                                        <div class="col-6">
                                            <label>Date of Birth (mm/dd/yyyy)<span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="date" name="dob" value="{{ old('dob') }}" required>
                                            </div>
                                            @error('dob')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- Contact --}}
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

                                        {{-- Whatsapp --}}
                                        <div class="col-6">
                                            <label>Whatsapp Number</label>
                                            <div class="banner__inputlist">
                                                <input type="tel" name="whatsapp_number"
                                                    value="{{ old('whatsapp_number') }}"
                                                    placeholder="Enter Whatsapp Number"
                                                    oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                                            </div>
                                            @error('whatsapp_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- Qualification --}}
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

                                        {{-- Experience --}}
                                        <div class="col-6">
                                            <label>No. of Years of Experience <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="experience_years"
                                                    value="{{ old('experience_years') }}" placeholder="e.g. 10" required
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                                            </div>
                                            @error('experience_years')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- Location --}}
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
                                    <span>Submit</span>
                                </button>

                            </form>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
