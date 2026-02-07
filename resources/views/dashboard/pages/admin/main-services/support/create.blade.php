@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Support'))

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
                    <h4 class="card-title">All {{ ucfirst('Support') }}</h4>
                </div>
                <div class="card-body">


                    <form action="{{ route('support.store') }}" method="POST">
                        @csrf

                        <!-- Contributor Details -->
                        <div class="banner__list">
                            <div class="row">
                                <input type="hidden" name="redirect" value="admin">
                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="full_name" class="form-control"
                                            value="{{ old('full_name') }}" placeholder="Full Name" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Email Address</label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="Email Address">
                                    </div>
                                </div>

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
                                </div>

                                <div class="col-6">
                                    <label>Date of Birth</label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            value="{{ old('contact_number') }}" placeholder="Enter Contact Number" required
                                            oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number" class="form-control"
                                            value="{{ old('whatsapp_number') }}" placeholder="Enter WhatsApp Number"
                                            oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Contribution Type <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="contribution_type" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Financial Support"
                                                {{ old('contribution_type') == 'Financial Support' ? 'selected' : '' }}>
                                                Financial Support
                                            </option>
                                            <option value="Marriage Essentials"
                                                {{ old('contribution_type') == 'Marriage Essentials' ? 'selected' : '' }}>
                                                Marriage Essentials
                                            </option>
                                            <option value="Food & Catering"
                                                {{ old('contribution_type') == 'Food & Catering' ? 'selected' : '' }}>
                                                Food & Catering
                                            </option>
                                            <option value="Mandap & Decoration"
                                                {{ old('contribution_type') == 'Mandap & Decoration' ? 'selected' : '' }}>
                                                Mandap & Decoration
                                            </option>
                                            <option value="Clothing & Jewelry"
                                                {{ old('contribution_type') == 'Clothing & Jewelry' ? 'selected' : '' }}>
                                                Clothing & Jewelry
                                            </option>
                                            <option value="Other"
                                                {{ old('contribution_type') == 'Other' ? 'selected' : '' }}>
                                                Other
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>If Other, Specify here</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="other_contribution" class="form-control"
                                            value="{{ old('other_contribution') }}" placeholder="Specify contribution">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Estimated Contribution Amount</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="amount" class="form-control"
                                            value="{{ old('amount') }}" placeholder="₹ Amount"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Transaction Id</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="transction_id" class="form-control"
                                            value="{{ old('transction_id') }}" placeholder="Transaction Id">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Additional Message -->
                        <div class="banner__list">
                            <label>Message / Intention</label>
                            <div class="banner__inputlist">
                                <textarea name="message" rows="3" class="form-control"
                                    placeholder="Your intention or any message for the couple...">{{ old('message') }}</textarea>
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
