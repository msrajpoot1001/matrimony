@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Karma Training'))

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
                    <h4 class="card-title">All {{ ucfirst('Karma Training') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('karma.training.store') }}" method="POST">
                        @csrf

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
                                                <input type="radio" name="user_type" value="yes" class="form-control"
                                                    {{ old('user_type') == 'yes' ? 'checked' : '' }} required>
                                                <span>Yes</span>
                                            </label>

                                            <label class="radio-card">
                                                <input type="radio" name="user_type" value="no" class="form-control"
                                                    {{ old('user_type') == 'no' ? 'checked' : '' }} required>
                                                <span>No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Full Name --}}
                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="full_name" class="form-control"
                                            value="{{ old('full_name') }}" placeholder="Full Name" required>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-6">
                                    <label>Email</label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="Enter Email">
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
                                    </div>
                                </div>

                                {{-- DOB --}}
                                <div class="col-6">
                                    <label>Date of Birth</label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob') }}">
                                    </div>
                                </div>

                                {{-- Contact --}}
                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            value="{{ old('contact_number') }}" placeholder="Enter Contact Number" required
                                            oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                    </div>
                                </div>

                                {{-- Whatsapp --}}
                                <div class="col-6">
                                    <label>Whatsapp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number" class="form-control"
                                            value="{{ old('whatsapp_number') }}" placeholder="Enter Whatsapp Number"
                                            oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                    </div>
                                </div>

                                {{-- Qualification --}}
                                <div class="col-6">
                                    <label>Qualification <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="qualification" class="form-control"
                                            value="{{ old('qualification') }}" placeholder="Veda, Shastri, Acharya, etc."
                                            required>
                                    </div>
                                </div>

                                {{-- Experience --}}
                                <div class="col-6">
                                    <label>No. of Years of Experience <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="experience_years" class="form-control"
                                            value="{{ old('experience_years') }}" placeholder="e.g. 10" required
                                            oninput="this.value=this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1')">
                                    </div>
                                </div>

                                {{-- Location --}}
                                <div class="col-6">
                                    <label>Location <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="location" class="form-control"
                                            value="{{ old('location') }}" placeholder="City / Area" required>
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
