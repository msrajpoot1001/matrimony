@extends('dashboard.layouts.app')

@section('title', 'dashboard | company information')

@section('content')


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Company Information</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('admin.company-info.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- company name  --}}
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                name="company_name" placeholder="Enter Company Name"
                                value="{{ old('company_name', $companyinfos->company_name) }}">
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Client Name  --}}
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Client Name</label>
                            <input type="text" class="form-control @error('client_name') is-invalid @enderror"
                                name="client_name" placeholder="Enter Client Name"
                                value="{{ old('client_name', $companyinfos->client_name) }}">
                            @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Company Title  --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Company Title</label>
                            <textarea class="form-control @error('title') is-invalid @enderror" id="description1" name="title"
                                placeholder="Enter Company Title">{{ old('title', $companyinfos->title) }}</textarea>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Company Description  --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Company Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description2" name="description"
                                placeholder="Enter Company Description">{{ old('description', $companyinfos->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>





                        {{-- Website Logo --}}
                        <h5 style="text-decoration: underline">Image</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Website Logo / Business Logo <span
                                            class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('logo') is-invalid @enderror"
                                        name="logo" id="logo" data-preview-id="photo_preview_logo" accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="photo_preview_logo" src="{{ asset($companyinfos->logo) }}" alt="No Image"
                                    style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                <input type="hidden" name="status_logo" id="status_logo"
                                    value="{{ $companyinfos->logo ? 1 : 0 }}">
                                <button type="button" id="statusPhotoBtn_logo" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>
                        </div>


                        {{-- Favicon Icon --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="favicon" class="form-label">Company Favicon Icon (png/svg/ico) <span
                                            class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('favicon') is-invalid @enderror"
                                        name="favicon" id="favicon" data-preview-id="photo_preview_favicon"
                                        accept="image/*">
                                    @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="photo_preview_favicon" src="{{ asset($companyinfos->favicon) }}" alt="No Image"
                                    style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                <input type="hidden" name="status_favicon" id="status_favicon"
                                    value="{{ $companyinfos->favicon ? 1 : 0 }}">
                                <button type="button" id="statusPhotoBtn_favicon" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>
                        </div>


                        {{-- Brochure  --}}
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="brochure" class="form-label">Brochure(PDF)<span
                                            class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('brochure') is-invalid @enderror"
                                        name="brochure" id="brochure" data-preview-id="photo_preview_brochure"
                                        accept="application/pdf">
                                    @error('brochure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">

                                @if ($companyinfos->brochure)
                                    <a href="{{ url($companyinfos->brochure) }}" class="btn btn-primary btn-sm" download>
                                        <i class="fas fa-file-download"></i> Download PDF
                                    </a>

                                    <input type="hidden" name="status_brochure" id="status_brochure" value="1">
                                @else
                                    <span>No PDF Uploaded</span>
                                    <input type="hidden" name="status_brochure" id="status_brochure" value="0">
                                @endif
                            </div>

                        </div> --}}
                        <hr>

                        {{-- Website url  --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="website_url" class="form-label">Website URL</label>
                                    <input type="url" class="form-control @error('website_url') is-invalid @enderror"
                                        name="website_url" placeholder="Enter website url"
                                        value="{{ old('website_url', $companyinfos->website_url) }}">
                                    @error('website_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                        </div>


                        <div class="row">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="google_map_location" class="form-label">Google Map Location (Iframe
                                        )</label>
                                    <input type="text"
                                        class="form-control @error('google_map_location') is-invalid @enderror"
                                        name="google_map_location" placeholder="Enter website url"
                                        value="{{ old('google_map_location', $companyinfos->google_map_location) }}">
                                    @error('google_map_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="google_map_link" class="form-label">Google Map Link (Url
                                        )</label>
                                    <input type="text"
                                        class="form-control @error('google_map_link') is-invalid @enderror"
                                        name="google_map_link" placeholder="Enter website url"
                                        value="{{ old('google_map_link', $companyinfos->google_map_link) }}">
                                    @error('google_map_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                        </div>






                        <div class="row">
                            <h5 style="text-decoration: underline">Email</h5>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email1" class="form-label">Enter Email 1</label>
                                    <input type="email" class="form-control @error('email1') is-invalid @enderror"
                                        name="email1" placeholder="Enter Email1"
                                        value="{{ old('email1', $companyinfos->email1) }}">
                                    @error('email1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email2" class="form-label">Enter Email 2</label>
                                    <input type="email" class="form-control @error('email2') is-invalid @enderror"
                                        name="email2" placeholder="Enter Email2"
                                        value="{{ old('email2', $companyinfos->email2) }}">
                                    @error('email2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email3" class="form-label">Enter Email 3</label>
                                    <input type="email" class="form-control @error('email3') is-invalid @enderror"
                                        name="email3" placeholder="Enter Email3"
                                        value="{{ old('email3', $companyinfos->email3) }}">
                                    @error('email3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                        </div>


                        <div class="row">
                            <h5 style="text-decoration: underline">Phone</h5>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone1" class="form-label">Phone No. 1</label>
                                    <input type="text" class="form-control @error('phone1') is-invalid @enderror"
                                        name="phone1" placeholder="Enter Phone1 No."
                                        value="{{ old('phone1', $companyinfos->phone1) }}" maxlength="20"
                                        oninput="this.value = this.value.replace(/[^0-9+\- ]/g, '')">
                                    @error('phone1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone2" class="form-label">Phone No. 2</label>
                                    <input type="text" class="form-control @error('phone2') is-invalid @enderror"
                                        name="phone2" placeholder="Enter Phone No."
                                        value="{{ old('phone2', $companyinfos->phone2) }}" maxlength="20"
                                        oninput="this.value = this.value.replace(/[^0-9+\- ]/g, '')">

                                    @error('phone2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone3" class="form-label"> Phone No. 3 (Whatsapp No.)</label>
                                    <input type="text" class="form-control @error('phone3') is-invalid @enderror"
                                        name="phone3" placeholder="Enter Phone No."
                                        value="{{ old('phone3', $companyinfos->phone3) }}" maxlength="20"
                                        oninput="this.value = this.value.replace(/[^0-9+\- ]/g, '')">
                                    @error('phone3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                        </div>



                        <div class="row">
                            <h5 style="text-decoration: underline">Address</h5>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address1" class="form-label">Address 1</label>
                                    <input type="text" class="form-control @error('address1') is-invalid @enderror"
                                        name="address1" placeholder="Enter address1"
                                        value="{{ old('address1', $companyinfos->address1) }}">
                                    @error('address1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address2" class="form-label">Address 2</label>
                                    <input type="text" class="form-control @error('address2') is-invalid @enderror"
                                        name="address2" placeholder="Enter address2"
                                        value="{{ old('address2', $companyinfos->address2) }}">
                                    @error('address2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address3" class="form-label">Address 3</label>
                                    <input type="text" class="form-control @error('address3') is-invalid @enderror"
                                        name="address3" placeholder="Enter address3"
                                        value="{{ old('address3', $companyinfos->address3) }}">
                                    @error('address3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                        </div>





                        <div class="row">
                            <h5 style="text-decoration: underline">Social Media</h5>
                            @foreach (['facebook', 'instagram', 'twitter', 'youtube', 'linkedin', 'pinterest'] as $social)
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="{{ $social }}"
                                            class="form-label">{{ ucfirst($social) }}</label>
                                        <input type="url" class="form-control @error($social) is-invalid @enderror"
                                            name="{{ $social }}" placeholder="Enter {{ ucfirst($social) }} link"
                                            value="{{ old($social, $companyinfos->$social) }}">
                                        @error($social)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                            <a href="{{ route('admin.dashboard.index') }}" class="btn btn-secondary w-md">Back</a>
                        </div>
                    </form>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection
