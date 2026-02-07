@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit Mandap Record')

@section('content')

    {{-- Validation Errors --}}
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
                    <h4 class="card-title mb-0">Edit Mandap Record</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.mandap.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- ================= BASIC DETAILS ================= -->
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
                                                    {{ old('user_type', $item->user_type) == 'yes' ? 'checked' : '' }}>
                                                <span>Yes</span>
                                            </label>

                                            <label class="radio-card">
                                                <input type="radio" name="user_type" value="no"
                                                    {{ old('user_type', $item->user_type) == 'no' ? 'checked' : '' }}>
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
                                        <select name="mandap_for" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach (['Marriage', 'Thread Ceremony', 'Birthday', 'Get Together', 'Family Function', 'Conference', 'Other'] as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('mandap_for', $item->mandap_for) == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
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
                                        <input type="text" name="other_event" class="form-control"
                                            value="{{ old('other_event', $item->other_event) }}">
                                    </div>
                                </div>

                                <!-- Full Name -->
                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="full_name" class="form-control"
                                            value="{{ old('full_name', $item->full_name) }}" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-6">
                                    <label>Email <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control read-only"
                                            value="{{ old('email', $item->user->email) }}" required readonly>
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-6">
                                    <label>Gender</label>
                                    <div class="banner__inputlist">
                                        <select name="gender" class="form-control">
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
                                    </div>
                                </div>

                                <!-- DOB -->
                                <div class="col-6">
                                    <label>Date of Birth</label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob', optional($item->dob)->format('Y-m-d')) }}">
                                    </div>
                                </div>

                                <!-- Contact -->
                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            value="{{ old('contact_number', $item->user->contact_number) }}" required>
                                    </div>
                                </div>

                                <!-- WhatsApp -->
                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number" class="form-control"
                                            value="{{ old('whatsapp_number', $item->whatsapp_number) }}">
                                    </div>
                                </div>

                                <!-- Place -->
                                <div class="col-6">
                                    <label>Place Name / Garden Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="place_name" class="form-control"
                                            value="{{ old('place_name', $item->place_name) }}" required>
                                    </div>
                                </div>

                                <!-- Guest Count -->
                                <div class="col-6">
                                    <label>Estimated Number of People <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="guest_count" class="form-control"
                                            value="{{ old('guest_count', $item->guest_count) }}" required>
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="col-6">
                                    <label>Location Required (with PIN Code)</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="location" class="form-control"
                                            value="{{ old('location', $item->location) }}">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- ================= DATE & CATEGORY ================= -->
                        <div class="banner__list">
                            <div class="row">

                                <div class="col-6">
                                    <label>Preferred Date <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="preferred_date" class="form-control"
                                            value="{{ old('preferred_date', optional($item->preferred_date)->format('Y-m-d')) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Venue Category <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="venue_category" class="form-control" required>
                                            <option value="Standard"
                                                {{ old('venue_category', $item->venue_category) == 'Standard' ? 'selected' : '' }}>
                                                Standard
                                            </option>
                                            <option value="Premium"
                                                {{ old('venue_category', $item->venue_category) == 'Premium' ? 'selected' : '' }}>
                                                Premium
                                            </option>
                                            <option value="Luxury"
                                                {{ old('venue_category', $item->venue_category) == 'Luxury' ? 'selected' : '' }}>
                                                Luxury
                                            </option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- ================= ADDITIONAL ================= -->
                        <div class="banner__list">
                            <label>Additional Note</label>
                            <div class="banner__inputlist">
                                <textarea name="additional_requirements" class="form-control" rows="3">{{ old('additional_requirements', $item->additional_requirements) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success w-md">
                                Update
                            </button>
                            <a href="{{ route('admin.mandap.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
