@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Astro Services'))

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add {{ ucfirst('Astrology Record') }}</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('astrology.store') }}" method="POST">
                        @csrf

                        <div class="banner__list">
                            <div class="row">
                                <input type="hidden" name="redirect" value="admin">

                                {{-- User Type --}}
                                <div class="col-6">
                                    <div class="banner__inputlist radio-select mt-2">
                                        <label class="label-head">
                                            I am Service Provider Consumer? <span class="astrick">*</span>
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

                                {{-- Name --}}
                                <div class="col-6">
                                    <label>Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="name" class="form-control" placeholder="Full Name"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-6">
                                    <label>Email <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Gender --}}
                                <div class="col-6">
                                    <label>Gender <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="gender" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- DOB --}}
                                <div class="col-6">
                                    <label>Date of Birth (mm/dd/yyyy)</label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob') }}">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Contact --}}
                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            placeholder="Enter Contact Number" value="{{ old('contact_number') }}" required
                                            oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                                        @error('contact_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- WhatsApp --}}
                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number" class="form-control"
                                            placeholder="Enter WhatsApp Number" value="{{ old('whatsapp_number') }}"
                                            oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                                        @error('whatsapp_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Specialization --}}
                                <div class="col-6">
                                    <label>Specialization <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="specialization" class="form-control"
                                            placeholder="Vedic, KP, Numerology, Palmistry, Tarot, etc."
                                            value="{{ old('specialization') }}" required>
                                        @error('specialization')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Experience --}}
                                <div class="col-6">
                                    <label>Years of Experience <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="experience_years" class="form-control"
                                            placeholder="e.g. 12" value="{{ old('experience_years') }}" required
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                                        @error('experience_years')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Location --}}
                                <div class="col-6">
                                    <label>Location <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="location" class="form-control"
                                            placeholder="City / Area" value="{{ old('location') }}" required>
                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Services --}}
                                <div class="col-6">
                                    <label>Astrology Services Offered <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="services_offered" class="form-control" required>
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
                                                {{ old('services_offered') == 'Career Guidance' ? 'selected' : '' }}>Career
                                                Guidance</option>
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
                                                {{ old('services_offered') == 'Numerology' ? 'selected' : '' }}>Numerology
                                            </option>
                                            <option value="Gemstone Recommendation"
                                                {{ old('services_offered') == 'Gemstone Recommendation' ? 'selected' : '' }}>
                                                Gemstone Recommendation</option>
                                            <option value="Other"
                                                {{ old('services_offered') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('services_offered')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Other --}}
                                <div class="col-6">
                                    <label>If Other, Specify</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="other_service" class="form-control"
                                            placeholder="Specify service (optional)" value="{{ old('other_service') }}">
                                        @error('other_service')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Additional --}}
                                <div class="banner__list">
                                    <label>Additional Requirements</label>
                                    <div class="banner__inputlist">
                                        <textarea name="add_require" rows="3" class="form-control"
                                            placeholder="Decoration, parking, AC hall, food arrangement, etc.">{{ old('add_require') }}</textarea>
                                        @error('add_require')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-md">
                            <span>Submit Astrologer Profile</span>
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection
