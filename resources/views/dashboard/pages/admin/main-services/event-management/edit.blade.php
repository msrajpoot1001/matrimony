@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit Event Management')

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
                <h4 class="card-title">Edit Event Management</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.event-management.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="redirect" value="admin">

                    <!-- ================= SERVICE PROVIDER DETAILS ================= -->
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
                                <label>Email</label>
                                <div class="banner__inputlist">
                                    <input type="email" name="email" class="form-control read-only"
                                        value="{{ old('email', $item->user->email ?? '') }}" readonly required>
                                </div>
                            </div>

                            <!-- Gender -->
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
                                        value="{{ old('contact_number', $item->user->contact_number ?? '') }}" required oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                </div>
                            </div>

                            <!-- WhatsApp -->
                            <div class="col-6">
                                <label>WhatsApp Number</label>
                                <div class="banner__inputlist">
                                    <input type="tel" name="whatsapp_number" class="form-control"
                                        value="{{ old('whatsapp_number', $item->whatsapp_number) }}" oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                </div>
                            </div>

                            <!-- Experience -->
                            <div class="col-6">
                                <label>Years of Experience <span class="astrick">*</span></label>
                                <div class="banner__inputlist">
                                    <input type="text" name="experience_years" class="form-control"
                                        value="{{ old('experience_years', $item->experience_years) }}" required>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-6">
                                <label>Location <span class="astrick">*</span></label>
                                <div class="banner__inputlist">
                                    <input type="text" name="location" class="form-control"
                                        value="{{ old('location', $item->location) }}" required>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ================= SERVICES OFFERED ================= -->
                    <div class="banner__list">
                        <div class="row">

                            <div class="col-6">
                                <label>Looking For (Services) <span class="astrick">*</span></label>
                                <div class="banner__inputlist">
                                    <select name="services_offered" class="form-control" required>
                                        @foreach ([
                                            'Marriage','Thread Ceremony','House Warming','Birthday',
                                            '100 Days Celebration','Shradha','Pinda Dana',
                                            'Puja for Harmony','Funeral Rituals','Other'
                                        ] as $service)
                                            <option value="{{ $service }}"
                                                {{ old('services_offered', $item->services_offered) == $service ? 'selected' : '' }}>
                                                {{ $service }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Other Service -->
                            <div class="col-6">
                                <label>If Other, Specify</label>
                                <div class="banner__inputlist">
                                    <input type="text" name="other_service" class="form-control"
                                        value="{{ old('other_service', $item->other_service) }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ================= ADDITIONAL ================= -->
                    <div class="banner__list">
                        <label>Additional Note</label>
                        <div class="banner__inputlist">
                            <textarea name="add_require" rows="3" class="form-control">{{ old('add_require', $item->add_require) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success w-md">
                            Update
                        </button>

                        <a href="{{ route('admin.event-management.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
