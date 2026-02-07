@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit ' . ucfirst('Astro Services'))

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
                    <h4 class="card-title mb-0">Edit {{ ucfirst('Astrology Record') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.astrology.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="banner__list">
                            <div class="row">

                                {{-- User Type --}}
                                <div class="col-6">
                                    <div class="banner__inputlist radio-select mt-2">
                                        <label class="label-head">
                                            I am Service Provider Consumer? <span class="astrick">*</span>
                                        </label>

                                        <div class="input-sec">
                                            <label class="radio-card">
                                                <input type="radio" name="user_type" value="yes"
                                                    {{ old('user_type', $item->user_type) == 'yes' ? 'checked' : '' }}
                                                    required>
                                                <span>Yes</span>
                                            </label>

                                            <label class="radio-card">
                                                <input type="radio" name="user_type" value="no"
                                                    {{ old('user_type', $item->user_type) == 'no' ? 'checked' : '' }}
                                                    required>
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
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $item->user->name) }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-6">
                                    <label>Email <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control read-only"
                                            value="{{ old('email', $item->user->email) }}" required readonly >
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
                                            <option value="Male"
                                                {{ old('gender', $item->gender) == 'Male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="Female"
                                                {{ old('gender', $item->gender) == 'Female' ? 'selected' : '' }}>
                                                Female
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
                                            value="{{ old('dob', \Carbon\Carbon::parse($item->dob)->format('Y-m-d')) }}">

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
                                            value="{{ old('contact_number', $item->user->contact_number) }}" required
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
                                            value="{{ old('whatsapp_number', $item->whatsapp_number) }}"
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
                                            value="{{ old('specialization', $item->specialization) }}" required>
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
                                            value="{{ old('experience_years', $item->experience_years) }}" required
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
                                            value="{{ old('location', $item->location) }}" required>
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
                                            @foreach (['Marriage Matching', 'Horoscope Reading', 'Kundali Analysis', 'Career Guidance', 'Business Astrology', 'Health Astrology', 'Vastu Consultation', 'Numerology', 'Gemstone Recommendation', 'Other'] as $service)
                                                <option value="{{ $service }}"
                                                    {{ old('services_offered', $item->services_offered) == $service ? 'selected' : '' }}>
                                                    {{ $service }}
                                                </option>
                                            @endforeach
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
                                            value="{{ old('other_service', $item->other_service) }}">
                                        @error('other_service')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Additional --}}
                                <div class="banner__list">
                                    <label>Additional Requirements</label>
                                    <div class="banner__inputlist">
                                        <textarea name="add_require" rows="3" class="form-control">{{ old('add_require', $item->add_require) }}</textarea>
                                        @error('add_require')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-md">
                            <span>Update Astrologer Profile</span>
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
