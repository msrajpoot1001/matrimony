@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Match Making'))


@section('style')
    <style>
        h6 {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.querySelector('form[action="{{ route('match.making.store') }}"]');

            if (!form) return;

            form.querySelectorAll('input:not([type="radio"]):not([type="checkbox"]), select, textarea')
                .forEach(el => {
                    el.classList.add('form-control');
                });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lookingFor = document.getElementById('looking_for');
            const gender = document.getElementById('gender');

            if (!lookingFor || !gender) return;

            function syncGender() {
                if (lookingFor.value === 'Bride') {
                    gender.value = 'Female';
                } else if (lookingFor.value === 'Groom') {
                    gender.value = 'Male';
                } else {
                    gender.value = 'Female';
                }
            }

            // Run on change
            lookingFor.addEventListener('change', syncGender);

            // Run once on page load (for old() values)
            syncGender();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#casteSelect').on('change', function() {
                var casteId = $(this).val();

                // Clear previous sub-caste options
                $('#subCasteSelect').empty().append('<option value="">-- Select Sub Caste --</option>');

                if (casteId) {
                    $.ajax({
                        url: '/get-sub-castes/' + casteId, // your route
                        type: 'GET',
                        success: function(data) {
                            $.each(data, function(key, sub) {
                                $('#subCasteSelect').append('<option value="' + sub.id +
                                    '">' + sub.name + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Failed to fetch sub-castes.');
                        }
                    });
                }
            });

            // Trigger change if old input exists (preload sub-castes on validation fail)
            @if (old('caste'))
                $('#casteSelect').trigger('change');
            @endif

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document
                .querySelectorAll('input:not([type="radio"]):not([type="checkbox"]), select, textarea')
                .forEach(function(el) {
                    el.classList.add('form-control');
                });

        });
    </script>
@endsection

@section('content')


    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All {{ ucfirst('Match Making') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.match-making.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- ALL ERRORS --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- ================= STEP 1 : BASIC DETAILS ================= -->
                        <div class="banner__list form-step1">
                            <h6>Basic Details</h6>
                            <div class="row">
                                <input type="hidden" name="redirect" value="admin">

                                <div class="col-6">
                                    <label>Register For <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="looking_for" required>
                                            <option value="Bride"
                                                {{ old('looking_for', $item->looking_for) == 'Bride' ? 'selected' : '' }}>
                                                Bride</option>
                                            <option value="Groom"
                                                {{ old('looking_for', $item->looking_for) == 'Groom' ? 'selected' : '' }}>
                                                Groom</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="candidate_name"
                                            value="{{ old('candidate_name', $item->candidate_name) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Email <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" class="read-only"
                                            value="{{ old('email', $item->user->email ?? '') }}" readonly required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Gender <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="gender" required>
                                            <option value="Female"
                                                {{ old('gender', $item->gender) == 'Female' ? 'selected' : '' }}>Female
                                            </option>
                                            <option value="Male"
                                                {{ old('gender', $item->gender) == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Date of Birth <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob"
                                            value="{{ old('dob', optional($item->dob)->format('Y-m-d')) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Height <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="height" required>
                                            @for ($ft = 4; $ft <= 7; $ft++)
                                                @for ($in = 0; $in <= 11; $in++)
                                                    @php $h = number_format($ft + $in / 12, 1); @endphp
                                                    <option value="{{ $h }}"
                                                        {{ old('height', $item->height) == $h ? 'selected' : '' }}>
                                                        {{ $h }} ft
                                                    </option>
                                                @endfor
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number"
                                            value="{{ old('contact_number', $item->user->contact_number ?? '') }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number"
                                            value="{{ old('whatsapp_number', $item->whatsapp_number) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ================= STEP 2 : PERSONAL & RELIGION ================= -->
                        <div class="banner__list form-step2">
                            <h6>Personal & Religion</h6>
                            <div class="row">

                                <div class="col-6">
                                    <label>Marital Status <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="marital_status" required>
                                            @foreach (['Never Married', 'Separated', 'Awaiting Divorce', 'Annulled'] as $m)
                                                <option value="{{ $m }}"
                                                    {{ old('marital_status', $item->marital_status) == $m ? 'selected' : '' }}>
                                                    {{ $m }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Religion <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="religion" required>
                                            <option value="Hindu" selected>Hindu</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Caste <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="caste_id" required>
                                            @foreach ($caste as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ old('caste', $item->caste) == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Sub Caste</label>
                                    <div class="banner__inputlist">
                                        <select name="sub_caste_id">
                                            @foreach ($subCastes ?? [] as $sub)
                                                <option value="{{ $sub->id }}"
                                                    {{ old('sub_caste', $item->sub_caste) == $sub->id ? 'selected' : '' }}>
                                                    {{ $sub->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ================= STEP 3 : PROFESSIONAL ================= -->
                        <div class="banner__list form-step3">
                            <h6>Professional Details</h6>
                            <div class="row">

                                <div class="col-6">
                                    <label>Qualification <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="qualification"
                                            value="{{ old('qualification', $item->qualification) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Company Name</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="company_name"
                                            value="{{ old('company_name', $item->company_name) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Designation</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="designation"
                                            value="{{ old('designation', $item->designation) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Place of Work</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="place_of_work"
                                            value="{{ old('place_of_work', $item->place_of_work) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Experience (Years)</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="year_of_experience"
                                            value="{{ old('year_of_experience', $item->year_of_experience) }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Employment Status <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="employment_status" required>
                                            <option value="Working"
                                                {{ old('employment_status', $item->employment_status) == 'Working' ? 'selected' : '' }}>
                                                Working</option>
                                            <option value="Not Working"
                                                {{ old('employment_status', $item->employment_status) == 'Not Working' ? 'selected' : '' }}>
                                                Not Working</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Annual Income</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="annual_income"
                                            value="{{ old('annual_income', $item->annual_income) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ================= STEP 4 : FAMILY ================= -->
                        <div class="banner__list form-step4">
                            <h6>Family Details</h6>
                            <div class="row">

                                <div class="col-6">
                                    <label>Father Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="father_name" class="form-control"
                                            placeholder="Father's full name"
                                            value="{{ old('father_name', $item->father_name) }}" required
                                            data-label="Father Name">
                                        @error('father_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Father Occupation <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="father_occupation" class="form-control"
                                            placeholder="Father's occupation"
                                            value="{{ old('father_occupation', $item->father_occupation) }}" required
                                            data-label="Father Occupation">
                                        @error('father_occupation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Mother Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="mother_name" class="form-control"
                                            placeholder="Mother's full name"
                                            value="{{ old('mother_name', $item->mother_name) }}" required
                                            data-label="Mother Name">
                                        @error('mother_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Mother Occupation <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="mother_occupation" class="form-control"
                                            placeholder="Mother's occupation"
                                            value="{{ old('mother_occupation', $item->mother_occupation) }}" required
                                            data-label="Mother Occupation">
                                        @error('mother_occupation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Family Income</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="family_income" class="form-control"
                                            placeholder="Total family income"
                                            value="{{ old('family_income', $item->family_income) }}"
                                            data-label="Family Income"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        @error('family_income')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Family Status <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="family_status" class="form-control" required
                                            data-label="Family Status">
                                            <option value="">Select</option>
                                            <option value="Middle Class"
                                                {{ old('family_status', $item->family_status) == 'Middle Class' ? 'selected' : '' }}>
                                                Middle Class
                                            </option>
                                            <option value="Upper Middle Class"
                                                {{ old('family_status', $item->family_status) == 'Upper Middle Class' ? 'selected' : '' }}>
                                                Upper Middle Class
                                            </option>
                                            <option value="Rich and Affluent"
                                                {{ old('family_status', $item->family_status) == 'Rich and Affluent' ? 'selected' : '' }}>
                                                Rich and Affluent
                                            </option>
                                        </select>
                                        @error('family_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Family Values <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="family_values" class="form-control" required
                                            data-label="Family Values">
                                            <option value="">Select</option>
                                            <option value="Orthodox"
                                                {{ old('family_values', $item->family_values) == 'Orthodox' ? 'selected' : '' }}>
                                                Orthodox
                                            </option>
                                            <option value="Modern"
                                                {{ old('family_values', $item->family_values) == 'Modern' ? 'selected' : '' }}>
                                                Modern
                                            </option>
                                            <option value="Liberal"
                                                {{ old('family_values', $item->family_values) == 'Liberal' ? 'selected' : '' }}>
                                                Liberal
                                            </option>
                                            <option value="Spiritually Inclined"
                                                {{ old('family_values', $item->family_values) == 'Spiritually Inclined' ? 'selected' : '' }}>
                                                Spiritually Inclined
                                            </option>
                                        </select>
                                        @error('family_values')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Living With Family <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="living_with_family" class="form-control" required
                                            data-label="Living With Family">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                {{ old('living_with_family', $item->living_with_family) == 'Yes' ? 'selected' : '' }}>
                                                Yes
                                            </option>
                                            <option value="No"
                                                {{ old('living_with_family', $item->living_with_family) == 'No' ? 'selected' : '' }}>
                                                No
                                            </option>
                                        </select>
                                        @error('living_with_family')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Living At</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="living_at" class="form-control"
                                            placeholder="Current city" value="{{ old('living_at', $item->living_at) }}"
                                            data-label="Living At">
                                        @error('living_at')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Ancestral Origin</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="ancestral_origin" class="form-control"
                                            placeholder="Native place / origin"
                                            value="{{ old('ancestral_origin', $item->ancestral_origin) }}"
                                            data-label="Ancestral Origin">
                                        @error('ancestral_origin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- ================= STEP 5 : HOROSCOPE & UPLOADS ================= -->
                        <div class="banner__list form-step5">
                            <h6>Horoscope & Uploads</h6>
                            <div class="row">

                                <div class="col-6">
                                    <label>Birth Place <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="birth_place"
                                            value="{{ old('birth_place', $item->birth_place) }}" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Birth Time</label>
                                    <div class="banner__inputlist">
                                        <input type="time" name="birth_time"
                                            value="{{ old('birth_time', $item->birth_time) }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label>Kundali Details</label>
                                    <div class="banner__inputlist">
                                        <textarea name="kundali_details" rows="3">{{ old('kundali_details', $item->kundali_details) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Upload Full Photo</label>
                                    <div class="banner__inputlist">

                                        @if (!empty($item->full_photo))
                                            <div class="mb-2">
                                                <img src="{{ asset($item->full_photo) }}" alt="Full Photo"
                                                    class="img-thumbnail" width="120">
                                            </div>

                                            <a href="{{ asset($item->full_photo) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary mb-2">
                                                View / Download
                                            </a>

                                            <div class="mt-2">
                                                <input type="file" name="full_photo">
                                                <small class="text-muted d-block">
                                                    Upload new photo to replace existing
                                                </small>
                                            </div>
                                        @else
                                            <input type="file" name="full_photo">
                                        @endif

                                    </div>
                                </div>


                                <div class="col-6">
                                    <label>Govt ID Proof</label>
                                    <div class="banner__inputlist">

                                        @if (!empty($item->govt_id_proof))
                                            <a href="{{ asset($item->govt_id_proof) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary mb-2">
                                                Download Govt ID
                                            </a>

                                            <div class="mt-2">
                                                <input type="file" name="govt_id_proof">
                                                <small class="text-muted d-block">
                                                    Upload new document to replace existing
                                                </small>
                                            </div>
                                        @else
                                            <input type="file" name="govt_id_proof">
                                        @endif

                                    </div>
                                </div>


                                <div class="col-6">
                                    <label>Upload Kundali</label>
                                    <div class="banner__inputlist">

                                        @if (!empty($item->kundali))
                                            <a href="{{ asset($item->kundali) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary mb-2">
                                                Download Kundali
                                            </a>

                                            <div class="mt-2">
                                                <input type="file" name="kundali">
                                                <small class="text-muted d-block">
                                                    Upload new kundali to replace existing
                                                </small>
                                            </div>
                                        @else
                                            <input type="file" name="kundali">
                                        @endif

                                    </div>
                                </div>



                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-md mt-2">
                            <span>Update</span>
                        </button>
                    </form>





                </div>
            </div>
        </div>
    </div>

@endsection
