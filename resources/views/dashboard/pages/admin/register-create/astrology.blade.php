@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add Astrologer')

@section('content')

    {{-- GLOBAL ERRORS --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Astrologer</h4>
                </div>

                <div class="card-body">
                    <form action="" method="POST">
                        @csrf

                        <div class="row">

                            {{-- USER TYPE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Service Provider Consumer? <span class="astrick">*</span></label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="user_type" value="yes"
                                            {{ old('user_type') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="user_type" value="no"
                                            {{ old('user_type') == 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                @error('user_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- NAME --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name <span class="astrick">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="astrick">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- GENDER --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender <span class="astrick">*</span></label>
                                <select name="gender" class="form-select">
                                    <option value="">Select</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- DOB --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                                @error('dob')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- CONTACT --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Number <span class="astrick">*</span></label>
                                <input type="text" name="contact_number" class="form-control"
                                    value="{{ old('contact_number') }}"
                                    oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                @error('contact_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- WHATSAPP --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" class="form-control"
                                    value="{{ old('whatsapp_number') }}"
                                    oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                @error('whatsapp_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SPECIALIZATION --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Specialization <span class="astrick">*</span></label>
                                <input type="text" name="specialization" class="form-control"
                                    value="{{ old('specialization') }}">
                                @error('specialization')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- EXPERIENCE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Experience (Years) <span class="astrick">*</span></label>
                                <input type="number" step="0.1" name="experience_years" class="form-control"
                                    value="{{ old('experience_years') }}">
                                @error('experience_years')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- LOCATION --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Location <span class="astrick">*</span></label>
                                <input type="text" name="location" class="form-control" value="{{ old('location') }}">
                                @error('location')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SERVICES OFFERED --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Services Offered <span class="astrick">*</span></label>
                                <select name="services_offered" class="form-select">
                                    <option value="">Select</option>
                                    @foreach (['Marriage Matching', 'Horoscope Reading', 'Kundali Analysis', 'Career Guidance', 'Business Astrology', 'Health Astrology', 'Vastu Consultation', 'Numerology', 'Gemstone Recommendation', 'Other'] as $service)
                                        <option value="{{ $service }}"
                                            {{ old('services_offered') == $service ? 'selected' : '' }}>
                                            {{ $service }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('services_offered')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- OTHER SERVICE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Other Service</label>
                                <input type="text" name="other_service" class="form-control"
                                    value="{{ old('other_service') }}">
                                @error('other_service')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ADDITIONAL REQUIREMENTS --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Additional Requirements</label>
                                <textarea name="add_require" rows="3" class="form-control">{{ old('add_require') }}</textarea>
                                @error('add_require')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">
                                Submit Astrologer
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
