@php
    use Illuminate\Support\Facades\DB;
    $company = DB::table('company_infos')->first();
@endphp

@extends('dashboard.layouts.app')

@section('title', 'dashboard')



@section('content')
    @if (auth()->user()->userRole->name === 'admin')
        <div class="row pt-5">
            {{-- <a class="" href="{{ route('companyinfo') }}">Edit Company Info</a> --}}
            <div class="col-xxl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <!-- Company Header Section -->
                        <div class="position-relative">
                            <!-- Background Header -->
                            <div class="bg-primary rounded-top" style="background-color: #1f58c7; height: 80px;"></div>

                            <!-- Edit Button -->
                            <div class="position-absolute top-0 end-0 me-3 mt-3">
                                <a href="{{ route('admin.company-info.edit') }}" class="btn btn-sm btn-light fw-bold">
                                    Edit
                                </a>
                            </div>
                        </div>

                        <!-- end user-profile-img -->

                        @if ($company)
                            <div class="p-4 pt-0">


                                <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                    <img src="{{ !empty($company->logo) ? asset($company->logo) : asset('default/image/company_logo/company_logo.png') }}"
                                        alt="Company Logo" class="avatar-xl rounded-circle img-thumbnail">


                                    <div class="mt-3">
                                        <h5 class="mb-1">{{ $company->company_name }}</h5>
                                    </div>

                                </div>

                                <div class="table-responsive mt-3 border-bottom pb-3">
                                    <table
                                        class="table align-middle table-sm table-nowrap table-borderless table-centered mb-0">
                                        <tbody>

                                            <tr>
                                                <th class="fw-bold">Company Description</th>
                                                <td class="text-muted">{!! $company->description !!}</td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Email :</th>
                                                <td class="text-muted">{{ $company->email1 }}</td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Phone :</th>
                                                <td class="text-muted">{{ $company->phone1 }}</td>
                                            </tr>

                                            @php($phone2 = trim($company->phone2 ?? ''))
                                            @if (!blank($phone2))
                                                <tr>
                                                    <th class="fw-bold">2nd Phone :</th>
                                                    <td class="text-muted">{{ $company->phone2 }}</td>
                                                </tr>
                                            @endif

                                            @php($phone3 = trim($company->phone3 ?? ''))
                                            @if (!blank($phone3))
                                                <tr>
                                                    <th class="fw-bold">3rd Phone :</th>
                                                    <td class="text-muted">{{ $company->phone3 }}</td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <th class="fw-bold">
                                                    Address :</th>
                                                <td class="text-muted">{{ $company->address1 }}</td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Facebook :</th>
                                                <td class="text-muted"><a href="{{ $company->facebook }}"
                                                        target="_blank">Facebook Profile</a></td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Instagram :</th>
                                                <td class="text-muted"><a href="{{ $company->instagram }}"
                                                        target="_blank">Instagram Profile</a></td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">LinkedIn :</th>
                                                <td class="text-muted"><a href="{{ $company->linkedin }}"
                                                        target="_blank">LinkedIn Profile</a></td>
                                            </tr>

                                            <tr>
                                                <th class="fw-bold">Pinterest :</th>
                                                <td class="text-muted"><a href="{{ $company->pinterest }}"
                                                        target="_blank">Pinterest Profile</a></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    @endif
    <!-- container-fluid -->

@endsection
