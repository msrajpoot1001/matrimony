@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit Pandit')

@section('style')
    <style>
        .form-check {
            margin: 0.5rem;
        }

        .form-check-input {
            height: 20px !important;
            width: 20px !important;
            border: 1px solid var(--primary-color);
            margin-right: 0.5rem;
        }

        .form-check label {
            color: black !important;
            cursor: pointer;
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
                    <h4 class="card-title">Edit Pandit</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.pandit.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="redirect" value="admin">

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
                                </div>

                                <!-- Name -->
                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $item->name) }}" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-6">
                                    <label>Email</label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control read-only"
                                            value="{{ old('email', $item->user->email ?? '') }}" readonly >
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-6">
                                    <label>Gender</label>
                                    <div class="banner__inputlist">
                                        <select name="gender" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Male"
                                                {{ old('gender', $item->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female"
                                                {{ old('gender', $item->gender) == 'Female' ? 'selected' : '' }}>Female
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
                                            value="{{ old('contact_number', $item->user->contact_number ?? '') }}" required>
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

                                <!-- Qualification -->
                                <div class="col-6">
                                    <label>Qualification <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="qualification" class="form-control"
                                            value="{{ old('qualification', $item->qualification) }}" required>
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

                        <!-- ================= SERVICES ================= -->
                        <div class="banner__list">
                            <label>Services You Experienced In <span class="astrick">*</span></label>

                            <div class="banner__inputlist checkbox-head">
                                @foreach (['Marriage', 'Thread Ceremony', 'House Warming', 'Birthday', '100 Days Celebration', 'Shradha', 'Pinda Dana', 'Puja for Harmony', 'Funeral Rituals', 'Other'] as $index => $service)
                                    @php
                                        $id = 'service_' . $index;
                                    @endphp

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services_offered[]"
                                            value="{{ $service }}" id="{{ $id }}"
                                            {{ in_array($service, old('services_offered', $item->services_offered ?? [])) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="{{ $id }}">
                                            {{ $service }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Other Service -->
                        <div class="banner__list">
                            <label>If Other, Specify</label>
                            <div class="banner__inputlist">
                                <input type="text" name="other_service" class="form-control"
                                    value="{{ old('other_service', $item->other_service) }}">
                            </div>
                        </div>

                        <!-- Additional -->
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
                            <a href="{{ route('admin.pandit.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
