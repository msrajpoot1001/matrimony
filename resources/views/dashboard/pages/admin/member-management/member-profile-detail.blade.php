@extends('dashboard.layouts.app')

@section('title', 'User Profile Details')

@section('content')

    <div class="row mt-4">

        {{-- USER BASIC INFORMATION --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="background:#4c1f84; color:white;">
                    <h5 class="mb-0" style="color:white">User Details</h5>
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name ?? 'N/A' }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email ?? 'N/A' }}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td>{{ $user->userRole->name ?? 'N/A' }}</td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

        {{-- USER PROFILE (dob, gender, message) --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="background:#4c1f84; color:white;">
                    <h5 class="mb-0" style="color:white">Profile Information</h5>
                </div>

                <div class="card-body">
                    @if ($user->profile)
                        <table class="table table-bordered">

                            <tr>
                                <th>Date of Birth</th>
                                <td>
                                    {{ $user->profile->dob ? \Carbon\Carbon::parse($user->profile->dob)->format('d M Y') : 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Gender</th>
                                <td>{{ ucfirst($user->profile->gender) }}</td>
                            </tr>

                            <tr>
                                <th>Message</th>
                                <td>{{ $user->profile->message ?? 'N/A' }}</td>
                            </tr>

                        </table>
                    @else
                        <p class="text-muted">Profile details not added.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>



    {{-- USER ADDRESS DETAILS --}}
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header" style="background:#4c1f84; color:white;">
                    <h5 class="mb-0" style="color:white">Address Details</h5>
                </div>

                <div class="card-body">
                    @if ($user->addresses->count() > 0)

                        <table class="table table-bordered table-striped">
                            <thead style="background:#4c1f84; color:white;">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Street</th>
                                    <th>Landmark</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Postal Code</th>
                                    <th>Type</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($user->addresses as $index => $address)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $address->name }}</td>
                                        <td>{{ $address->phone }}</td>
                                        <td>{{ $address->street }}</td>
                                        <td>{{ $address->landmark }}</td>
                                        <td>{{ $address->city }}</td>
                                        <td>{{ $address->state }}</td>
                                        <td>{{ $address->country }}</td>
                                        <td>{{ $address->postal_code }}</td>
                                        <td>{{ ucfirst($address->type) }}</td>
                                        <td>{{ $address->created_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No address records found.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>


    {{-- PARTNER INFORMATION --}}
    @if ($user->partnerInformation)
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header" style="background:#4c1f84; color:white;">
                        <h5 class="mb-0" style="color:white">Partner Information</h5>
                    </div>

                    <div class="card-body">


                        @php
                            $p = $user->partnerInformation;
                        @endphp

                        <table class="table table-bordered table-striped">
                            <thead style="background:#4c1f84; color:white;">
                                <tr>
                                    <th>Field</th>
                                    <th>Details</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><strong>Application Type</strong></td>
                                    <td>{{ $p->application_type }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Legal Name</strong></td>
                                    <td>{{ $p->legal_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Business Name</strong></td>
                                    <td>{{ $p->business_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>PAN</strong></td>
                                    <td>{{ $p->pan }}</td>
                                </tr>
                                <tr>
                                    <td><strong>GSTIN</strong></td>
                                    <td>{{ $p->gstin ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Qualification</strong></td>
                                    <td>{{ $p->qualification }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Prof. Qualification</strong></td>
                                    <td>{{ $p->professional_qualification }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Authorized Signatory</strong></td>
                                    <td>{{ $p->authorised_signatory ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Signatory PAN</strong></td>
                                    <td>{{ $p->pan_authorised_signatory ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Signatory Mobile</strong></td>
                                    <td>{{ $p->contact_authorised_mobile ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Signatory Email</strong></td>
                                    <td>{{ $p->contact_authorised_email ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Street</strong></td>
                                    <td>{{ $p->street ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Landmark</strong></td>
                                    <td>{{ $p->landmark ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City</strong></td>
                                    <td>{{ $p->city }}</td>
                                </tr>
                                <tr>
                                    <td><strong>State</strong></td>
                                    <td>{{ $p->state }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Country</strong></td>
                                    <td>{{ $p->country }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Postal Code</strong></td>
                                    <td>{{ $p->postal_code }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Official Email</strong></td>
                                    <td>{{ $p->official_email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Primary Mobile</strong></td>
                                    <td>{{ $p->primary_mobile }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Website</strong></td>
                                    <td>{{ $p->website ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Agency Focus</strong></td>
                                    <td>{{ $p->agency_focus }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Experience (Years)</strong></td>
                                    <td>{{ $p->experience_years }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Specialization</strong></td>
                                    <td>{{ $p->specialization ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Commitments</strong></td>
                                    <td>{{ $p->commitments ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Conflict of Interest</strong></td>
                                    <td>{{ ucfirst($p->conflict_interest_flag) }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Account Holder</strong></td>
                                    <td>{{ $p->account_holder }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Bank Name</strong></td>
                                    <td>{{ $p->bank_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Account Number</strong></td>
                                    <td>{{ $p->account_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>IFSC</strong></td>
                                    <td>{{ $p->ifsc }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Declaration</strong></td>
                                    <td>{{ $p->declaration ? 'Accepted' : 'Not Accepted' }}</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>

                </div>
            </div>
        </div>
    @endif


@endsection
