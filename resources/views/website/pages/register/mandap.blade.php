@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Mandap Service | Prajapati Ghatasutra
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
                <h2>Register For Mandap</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Mandap Service</li>
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
                                <h3>Mandap Registration Details</h3>
                            </div>

                            <form action="{{ route('mandap.store') }}" method="post">
                                @csrf

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

                                        <!-- Mandap For -->
                                        <div class="col-6">
                                            <label>Looking for <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <select name="mandap_for" required>
                                                    <option value="">Select</option>
                                                    <option value="Marriage"
                                                        {{ old('mandap_for') == 'Marriage' ? 'selected' : '' }}>Marriage
                                                    </option>
                                                    <option value="Thread Ceremony"
                                                        {{ old('mandap_for') == 'Thread Ceremony' ? 'selected' : '' }}>
                                                        Thread Ceremony</option>
                                                    <option value="Birthday"
                                                        {{ old('mandap_for') == 'Birthday' ? 'selected' : '' }}>Birthday
                                                    </option>
                                                    <option value="Get Together"
                                                        {{ old('mandap_for') == 'Get Together' ? 'selected' : '' }}>Get
                                                        Together</option>
                                                    <option value="Family Function"
                                                        {{ old('mandap_for') == 'Family Function' ? 'selected' : '' }}>
                                                        Family Function</option>
                                                    <option value="Conference"
                                                        {{ old('mandap_for') == 'Conference' ? 'selected' : '' }}>
                                                        Conference
                                                    </option>
                                                    <option value="Other"
                                                        {{ old('mandap_for') == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>

                                            @error('mandap_for')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Other Event -->
                                        <div class="col-6">
                                            <label>If Other, Specify</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="other_event" value="{{ old('other_event') }}"
                                                    placeholder="Specify event (optional)">
                                            </div>

                                            @error('other_event')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Full Name -->
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

                                        <!-- Email -->
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

                                        <!-- Gender -->
                                        <div class="col-6">
                                            <label>Gender</label>
                                            <div class="banner__inputlist">
                                                <select name="gender">
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

                                        <!-- DOB -->
                                        <div class="col-6">
                                            <label>Date of Birth ( mm/dd/yyyy)</label>
                                            <div class="banner__inputlist">
                                                <input type="date" name="dob" value="{{ old('dob') }}">
                                            </div>

                                            @error('dob')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Contact -->
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

                                        <!-- WhatsApp -->
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

                                        <!-- Place -->
                                        <div class="col-6">
                                            <label>Place Name / Garden Name <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="place_name" value="{{ old('place_name') }}"
                                                    placeholder="Place Name" required>
                                            </div>

                                            @error('place_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Guest Count -->
                                        <div class="col-6">
                                            <label>Estimated Number of People <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="guest_count"
                                                    value="{{ old('guest_count') }}" placeholder="e.g. 200" required
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            </div>

                                            @error('guest_count')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Location -->
                                        <div class="col-6">
                                            <label>Location Required (with PIN Code) <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="location" value="{{ old('location') }}"
                                                    placeholder="City / Area - PIN Code">
                                            </div>

                                            @error('location')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <!-- Date & Category -->
                                <div class="banner__list">
                                    <div class="row">

                                        <div class="col-6">
                                            <label>Preferred Date <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="date" name="preferred_date"
                                                    value="{{ old('preferred_date') }}" required>
                                            </div>

                                            @error('preferred_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label>Venue Category <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <select name="venue_category" required>
                                                    <option value="">Select</option>
                                                    <option value="Standard"
                                                        {{ old('venue_category') == 'Standard' ? 'selected' : '' }}>
                                                        Standard</option>
                                                    <option value="Premium"
                                                        {{ old('venue_category') == 'Premium' ? 'selected' : '' }}>Premium
                                                    </option>
                                                    <option value="Luxury"
                                                        {{ old('venue_category') == 'Luxury' ? 'selected' : '' }}>Luxury
                                                    </option>
                                                </select>
                                            </div>

                                            @error('venue_category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <!-- Additional -->
                                <div class="banner__list">
                                    <label>Additional Note</label>
                                    <div class="banner__inputlist">
                                        <textarea name="additional_requirements" rows="3"
                                            placeholder="Decoration, parking, AC hall, food arrangement, etc.">{{ old('additional_requirements') }}</textarea>
                                    </div>

                                    @error('additional_requirements')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="default-btn reverse d-block"
                                    style="background: white !important; color: black !important;">
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
