@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Perform Kanyadan'))

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
                    <h4 class="card-title">All {{ ucfirst('Perform Kanyadan') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('perform.kanyadan.store') }}" method="POST">
                        @csrf

                        <!-- Donor Details -->
                        <div class="banner__list">
                            <div class="row">

                                <input type="hidden" name="redirect" value="admin">

                                <div class="col-6">
                                    <label>Donor Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="donor_name" class="form-control" placeholder="Full Name"
                                            value="{{ old('donor_name') }}" required>
                                    </div>
                                    @error('donor_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>Email Address <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Email Address" value="{{ old('email') }}" required >
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>Gender</label>
                                    <div class="banner__inputlist">
                                        <select name="gender" class="form-control" required>
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

                                <div class="col-6">
                                    <label>Date of Birth (mm/dd/yyyy)</label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob') }}">
                                    </div>
                                    @error('dob')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            value="{{ old('contact_number') }}" placeholder="Enter Contact Number"
                                            required>
                                    </div>
                                    @error('contact_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number" class="form-control"
                                            value="{{ old('whatsapp_number') }}" placeholder="Enter WhatsApp Number">
                                    </div>
                                    @error('whatsapp_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>Type of Kanyadan Support <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="kanyadan_type" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach (['Complete Kanyadan', 'Financial Support', 'Marriage Ritual Expenses', 'Clothing & Jewelry', 'Food & Catering', 'Mandap & Decoration', 'Other'] as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('kanyadan_type') == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('kanyadan_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>If Other, Specify</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="other_kanyadan" class="form-control"
                                            placeholder="Specify support" value="{{ old('other_kanyadan') }}">
                                    </div>
                                    @error('other_kanyadan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>Donation Amount</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="donation_amount" class="form-control"
                                            placeholder="₹ Amount" value="{{ old('donation_amount') }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    </div>
                                    @error('donation_amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label>Transaction Id<span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="transction_id" class="form-control"
                                            placeholder="Transaction Id" value="{{ old('transction_id') }}" required>
                                    </div>
                                    @error('transction_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Blessing / Sankalp -->
                        <div class="banner__list">
                            <label>Blessings / Sankalp</label>
                            <div class="banner__inputlist">
                                <textarea name="blessings" rows="3" class="form-control"
                                    placeholder="Your blessings or sankalp for the bride’s happy married life...">{{ old('blessings') }}</textarea>
                            </div>
                            @error('blessings')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-md">
                            <span>Submit</span>
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
