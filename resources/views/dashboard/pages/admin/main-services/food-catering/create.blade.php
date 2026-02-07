@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Food Catering'))

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

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All {{ ucfirst('Food Catering') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('food.catering.store') }}" method="POST">
                        @csrf

                        <!-- Service Provider Details -->
                        <div class="banner__list service-provider-fields">
                            <div class="row">
                                <input type="hidden" name="redirect" value="admin">

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

                                <!-- Full Name -->
                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="full_name" class="form-control"
                                            value="{{ old('full_name') }}" placeholder="Full Name" required>
                                    </div>
                                    @error('full_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-6">
                                    <label>Email <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="Enter Email" required readonly>
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="col-6">
                                    <label>Gender</label>
                                    <div class="banner__inputlist">
                                        <select name="gender" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- DOB -->
                                <div class="col-6">
                                    <label>Date of Birth</label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob') }}">
                                    </div>
                                    @error('dob')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Contact -->
                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            value="{{ old('contact_number') }}" placeholder="Enter Contact Number" required
                                            oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                    </div>
                                    @error('contact_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- WhatsApp -->
                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number" class="form-control"
                                            value="{{ old('whatsapp_number') }}" placeholder="Enter WhatsApp Number"
                                            oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                    </div>
                                    @error('whatsapp_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Experience -->
                                <div class="col-6">
                                    <label>Years of Experience <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="experience_years" class="form-control"
                                            value="{{ old('experience_years') }}" placeholder="e.g. 12" required
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    </div>
                                    @error('experience_years')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Location -->
                                <div class="col-6">
                                    <label>Location <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="location" class="form-control"
                                            value="{{ old('location') }}" placeholder="City / Area" required>
                                    </div>
                                    @error('location')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Looking For -->
                                <div class="col-6">
                                    <label>Looking For <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="looking_for" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach (['Marriage', 'Thread Ceremony', 'House Warming', 'Birthday', '100 Days Celebration', 'Shradha', 'Pinda Dana', 'Puja for Harmony', 'Funeral Rituals', 'Other'] as $option)
                                                <option value="{{ $option }}"
                                                    {{ old('looking_for') == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('looking_for')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Other Service -->
                                <div class="col-6">
                                    <label>If Other, Specify</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="other_service" class="form-control"
                                            value="{{ old('other_service') }}" placeholder="Specify service">
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
                                <textarea name="add_require" rows="3" class="form-control"
                                    placeholder="Decoration, parking, AC hall, food arrangement, etc.">{{ old('add_require') }}</textarea>
                            </div>
                            @error('add_require')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-md">
                            <span>Submit </span>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
