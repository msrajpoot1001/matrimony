@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit ' . ucfirst('Support'))

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
                    <h4 class="card-title">Edit {{ ucfirst('Support') }}</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.support.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="redirect" value="admin">

                        <!-- Contributor Details -->
                        <div class="banner__list">
                            <div class="row">

                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="full_name" class="form-control"
                                            value="{{ old('full_name', $item->full_name) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Email Address</label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="form-control read-only"
                                            value="{{ old('email', $item->user->email ?? '') }}" required readonly>
                                    </div>
                                </div>

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

                                <div class="col-6">
                                    <label>Date of Birth ( mm/dd/yyyy) </label>

                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob', optional($item->dob)->format('Y-m-d')) }}">
                                    </div>
                                </div>


                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" class="form-control"
                                            value="{{ old('contact_number', $item->user->contact_number ?? '') }}" required
                                            oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number" class="form-control"
                                            value="{{ old('whatsapp_number', $item->whatsapp_number) }}"
                                            oninput="this.value=this.value.replace(/[^0-9+\-\s]/g,'')">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Contribution Type <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="contribution_type" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach (['Financial Support', 'Marriage Essentials', 'Food & Catering', 'Mandap & Decoration', 'Clothing & Jewelry', 'Other'] as $type)
                                                <option value="{{ $type }}"
                                                    {{ old('contribution_type', $item->contribution_type) == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>If Other, Specify here</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="other_contribution" class="form-control"
                                            value="{{ old('other_contribution', $item->other_contribution) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Estimated Contribution Amount</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="amount" class="form-control"
                                            value="{{ old('amount', $item->amount) }}"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Transaction Id</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="transction_id" class="form-control"
                                            value="{{ old('transction_id', $item->transction_id) }}">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Message -->
                        <div class="banner__list">
                            <label>Message / Intention</label>
                            <div class="banner__inputlist">
                                <textarea name="message" rows="3" class="form-control">{{ old('message', $item->message) }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-md">
                            <span>Update </span>
                        </button>

                        <a href="{{ route('admin.support.index') }}" class="btn btn-secondary w-md">
                            Cancel
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
