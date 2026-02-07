@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Pandit'))


@section('style')
    <style>
        .form-check {
            margin: 0.5rem;
        }


        .form-check-input {
            height: 20px !important;
            width: 20px !important;
            /* margin-top: 0.8rem !important; */
            border: 1px solid var(--primary-color);
            margin-right: 0.5rem;

        }

        .form-check label {
            color: black !important;
        }

        .checkbox-head {
            padding: 1rem 0rem;
            display: flex;
            flex-wrap: wrap;
        }
    </style>
@endsection
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
                    <h4 class="card-title">All {{ ucfirst('Pandit') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pandit.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="redirect" value="admin">

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

                                <!-- Full Name -->
                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}" placeholder="Full Name" required>
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-6">
                                    <label>Email</label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="Enter Email">
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

                                <!-- Qualification -->
                                <div class="col-6">
                                    <label>Qualification <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="qualification" class="form-control"
                                            value="{{ old('qualification') }}" placeholder="Veda, Shastri, Acharya, etc."
                                            required>
                                    </div>
                                    @error('qualification')
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

                            </div>
                        </div>

                        <!-- Services -->
                        <div class="banner__list">
                            <div class="row">
                                <div class="col-12">
                                    <label>Services You Experienced In <span class="astrick">*</span></label>

                                    <div class="banner__inputlist checkbox-head">
                                        @foreach (['Marriage', 'Thread Ceremony', 'House Warming', 'Birthday', '100 Days Celebration', 'Shradha', 'Pinda Dana', 'Puja for Harmony', 'Funeral Rituals', 'Other'] as $index => $service)
                                            @php
                                                $id = 'service_' . $index;
                                            @endphp

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="services_offered[]"
                                                    value="{{ $service }}" id="{{ $id }}"
                                                    {{ in_array($service, old('services_offered', [])) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="{{ $id }}">
                                                    {{ $service }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('services_offered')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Other Service -->
                                <div class="col-6">
                                    <label>If Other, Specify</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="other_service" class="form-control"
                                            value="{{ old('other_service') }}" placeholder="Specify service (optional)">
                                    </div>
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
