@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit ' . ucfirst('Perform Kanyadan'))

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
                    <h4 class="card-title">Edit {{ ucfirst('Perform Kanyadan') }}</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.perform-kanyadan.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Donor Details -->
                        <div class="banner__list">
                            <div class="row">

                                <input type="hidden" name="redirect" value="admin">

                                <div class="col-6">
                                    <label>Donor Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="donor_name" class="form-control"
                                            value="{{ old('donor_name', $item->donor_name) }}" placeholder="Full Name"
                                            required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Email Address <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $item->user->email ?? '') }}" placeholder="Email Address"
                                            required readonly>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Gender</label>
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

                                <div class="col-6">
                                    <label>Date of Birth</label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob', optional($item->dob)->format('Y-m-d')) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            value="{{ old('contact_number', $item->user->contact_number ?? '') }}"
                                            placeholder="Enter Contact Number" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number" class="form-control"
                                            value="{{ old('whatsapp_number', $item->whatsapp_number) }}"
                                            placeholder="Enter WhatsApp Number">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Type of Kanyadan Support <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="kanyadan_type" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach (['Complete Kanyadan', 'Financial Support', 'Marriage Ritual Expenses', 'Clothing & Jewelry', 'Food & Catering', 'Mandap & Decoration', 'Other'] as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('kanyadan_type', $item->kanyadan_type) == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>If Other, Specify</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="other_kanyadan" class="form-control"
                                            value="{{ old('other_kanyadan', $item->other_kanyadan) }}"
                                            placeholder="Specify support">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Donation Amount</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="donation_amount" class="form-control"
                                            value="{{ old('donation_amount', $item->donation_amount) }}"
                                            placeholder="₹ Amount" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Transaction Id <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="transction_id" class="form-control"
                                            value="{{ old('transction_id', $item->transction_id) }}"
                                            placeholder="Transaction Id" required>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Blessings -->
                        <div class="banner__list">
                            <label>Blessings / Sankalp</label>
                            <div class="banner__inputlist">
                                <textarea name="blessings" rows="3" class="form-control"
                                    placeholder="Your blessings or sankalp for the bride’s happy married life...">{{ old('blessings', $item->blessings) }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-md">
                            <span>Update</span>
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
