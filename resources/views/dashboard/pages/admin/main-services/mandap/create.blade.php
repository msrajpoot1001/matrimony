@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Mandap Records'))

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

    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add {{ ucfirst('Mandap Records') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.seo-pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="redirect" value="admin">
                        <div class="mb-3">
                            <label for="page_name" class="form-label">Page Name</label>
                            <input type="text" name="page_name" id="page_name"
                                class="form-control @error('page_name') is-invalid @enderror"
                                value="{{ old('page_name') }}">
                            @error('page_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <textarea name="title" id="title" rows="3" class="form-control @error('title') is-invalid @enderror">{{ old('title') }}</textarea>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="descri" rows="3"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keywords" class="form-label">Keywords</label>
                            <textarea name="keywords" id="keywords" rows="3" class="form-control @error('keywords') is-invalid @enderror">{{ old('keywords') }}</textarea>
                            @error('keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active</label>
                            <select name="is_active" id="is_active"
                                class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All {{ ucfirst('Mandap Records') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('mandap.store') }}" method="POST">
                        @csrf

                        <!-- ================= BASIC DETAILS ================= -->
                        <div class="banner__list">
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

                                <!-- Mandap For -->
                                <div class="col-6">
                                    <label>Looking for <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="mandap_for" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach (['Marriage', 'Thread Ceremony', 'Birthday', 'Get Together', 'Family Function', 'Conference', 'Other'] as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('mandap_for') == $type ? 'selected' : '' }}>
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
                                            value="{{ old('other_event') }}" placeholder="Specify event (optional)">
                                    </div>

                                    @error('other_event')
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
                                            value="{{ old('email') }}" placeholder="Enter Email" required>
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
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                                Female</option>
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
                                            value="{{ old('contact_number') }}" placeholder="Enter Contact Number"
                                            required oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
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

                                <!-- Place -->
                                <div class="col-6">
                                    <label>Place Name / Garden Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="place_name" class="form-control"
                                            value="{{ old('place_name') }}" placeholder="Place Name" required>
                                    </div>

                                    @error('place_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Guest Count -->
                                <div class="col-6">
                                    <label>Estimated Number of People <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="guest_count" class="form-control"
                                            value="{{ old('guest_count') }}" placeholder="e.g. 200" required
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    </div>

                                    @error('guest_count')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Location -->
                                <div class="col-6">
                                    <label>Location Required (with PIN Code) <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="location" class="form-control"
                                            value="{{ old('location') }}" placeholder="City / Area - PIN Code">
                                    </div>

                                    @error('location')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
                                            value="{{ old('preferred_date') }}" required>
                                    </div>

                                    @error('preferred_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>Venue Category <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="venue_category" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Standard"
                                                {{ old('venue_category') == 'Standard' ? 'selected' : '' }}>Standard
                                            </option>
                                            <option value="Premium"
                                                {{ old('venue_category') == 'Premium' ? 'selected' : '' }}>Premium</option>
                                            <option value="Luxury"
                                                {{ old('venue_category') == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                                        </select>
                                    </div>

                                    @error('venue_category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- ================= ADDITIONAL ================= -->
                        <div class="banner__list">
                            <label>Additional Note</label>
                            <div class="banner__inputlist">
                                <textarea name="additional_requirements" class="form-control" rows="3"
                                    placeholder="Decoration, parking, AC hall, food arrangement, etc.">{{ old('additional_requirements') }}</textarea>
                            </div>

                            @error('additional_requirements')
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
