@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit Karma Training')

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
                    <h4 class="card-title">Edit Karma Training</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.karma-training.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="redirect" value="admin">

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
                                                <input type="radio" name="user_type" value="yes" class="form-control"
                                                    {{ old('user_type', $item->user_type) == 'yes' ? 'checked' : '' }}>
                                                <span>Yes</span>
                                            </label>

                                            <label class="radio-card">
                                                <input type="radio" name="user_type" value="no" class="form-control"
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

                                <!-- Email (User Table) -->
                                <div class="col-6">
                                    <label>Email <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control read-only"
                                            value="{{ old('email', $item->user->email ?? '') }}" required readonly>
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

                                <!-- Contact (User Table) -->
                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            value="{{ old('contact_number', $item->user->contact_number ?? '') }}" required>
                                    </div>
                                </div>

                                <!-- WhatsApp -->
                                <div class="col-6">
                                    <label>Whatsapp Number</label>
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
                                    <label>No. of Years of Experience <span class="astrick">*</span></label>
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

                        <!-- Additional Note -->
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

                            <a href="{{ route('admin.karma-training.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
