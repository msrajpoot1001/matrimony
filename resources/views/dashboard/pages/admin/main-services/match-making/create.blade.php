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
@endsection

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
                    <h4 class="card-title">All {{ ucfirst('Match Making') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('match.making.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

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
                                        <select name="looking_for" id="looking_for" required data-label="Register For">
                                            <option value="Bride" {{ old('looking_for') == 'Bride' ? 'selected' : '' }}>
                                                Bride</option>
                                            <option value="Groom" {{ old('looking_for') == 'Groom' ? 'selected' : '' }}>
                                                Groom</option>
                                        </select>
                                        @error('looking_for')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Full Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="candidate_name" placeholder="Enter your full name"
                                            value="{{ old('candidate_name') }}" required data-label="Full Name">
                                        @error('candidate_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Email <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="email" name="email" placeholder="Enter email address"
                                            value="{{ old('email') }}" data-label="Email" required>

                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Gender <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="gender" id="gender" required data-label="Gender">
                                            <option value="Female"
                                                {{ old('gender', 'Female') == 'Female' ? 'selected' : '' }}>Female
                                            </option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                                Male</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Date of Birth (mm/dd/yyyy) <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="date" name="dob" value="{{ old('dob') }}" required
                                            data-label="Date of Birth">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Height (In Feet) <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="height" required data-label="Height">
                                            <option value="">Select Height</option>
                                            @for ($ft = 4; $ft <= 7; $ft++)
                                                @for ($in = 0; $in <= 11; $in++)
                                                    @php
                                                        $decimalHeight = number_format($ft + $in / 12, 1);
                                                    @endphp
                                                    <option value="{{ $decimalHeight }}"
                                                        {{ old('height') == $decimalHeight ? 'selected' : '' }}>
                                                        {{ $decimalHeight }} ft
                                                    </option>
                                                @endfor
                                            @endfor
                                        </select>
                                        @error('height')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Contact Number <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="contact_number" placeholder="10 digit mobile number"
                                            maxlength="13" value="{{ old('contact_number') }}" required
                                            data-label="Contact Number"
                                            oninput="this.value = this.value.replace(/[^0-9+\-\s]/g, '')">
                                        @error('contact_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>WhatsApp Number</label>
                                    <div class="banner__inputlist">
                                        <input type="tel" name="whatsapp_number"
                                            placeholder="WhatsApp number (if different)"
                                            value="{{ old('whatsapp_number') }}" data-label="WhatsApp Number">
                                        @error('whatsapp_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                        <select name="marital_status" required data-label="Marital Status">
                                            <option value="">Select</option>
                                            @foreach (['Never Married', 'Separated', 'Awaiting Divorce', 'Annulled'] as $m)
                                                <option {{ old('marital_status') == $m ? 'selected' : '' }}>
                                                    {{ $m }}</option>
                                            @endforeach
                                        </select>
                                        @error('marital_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Religion <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="religion" required data-label="Religion">
                                            <option value="">Select</option>
                                            @foreach (['Hindu'] as $r)
                                                <option {{ old('religion') == $r ? 'selected' : '' }}>
                                                    {{ $r }}</option>
                                            @endforeach
                                        </select>
                                        @error('religion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Caste <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="caste_id" id="casteSelect" required data-label="Caste"
                                            class="form-control">

                                            <option value="">-- Select Caste --</option>
                                            @foreach ($caste as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('caste') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('caste')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Sub Caste</label>
                                    <div class="banner__inputlist">
                                        <select name="sub_caste_id" id="subCasteSelect" class="form-control"
                                            data-label="Sub Caste">
                                            <option value="">-- Select Sub Caste --</option>
                                            @if (old('caste') && $subCastes)
                                                @foreach ($subCastes as $sub)
                                                    <option value="{{ $sub->id }}"
                                                        {{ old('sub_caste') == $sub->id ? 'selected' : '' }}>
                                                        {{ $sub->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('sub_caste')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-6">
                                    <label>Manglik Status</label>
                                    <div class="banner__inputlist">
                                        <select name="manglik_status" data-label="Manglik Status">
                                            <option value="">Select</option>
                                            @foreach (['Yes', 'No', "Don't Know"] as $m)
                                                <option {{ old('manglik_status') == $m ? 'selected' : '' }}>
                                                    {{ $m }}</option>
                                            @endforeach
                                        </select>
                                        @error('manglik_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Interested for Inter-Caste Marriage</label>
                                    <div class="banner__inputlist">
                                        <select name="interest_inter_caste"
                                            data-label="Interested for Inter-Caste Marriage">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                {{ old('interest_inter_caste') == 'Yes' ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="No"
                                                {{ old('interest_inter_caste') == 'No' ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('interest_inter_caste')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                        <input type="text" name="qualification" placeholder="e.g. B.Tech, MBA"
                                            value="{{ old('qualification') }}" required data-label="Qualification">
                                        @error('qualification')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Company Name</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="company_name" placeholder="Current company name"
                                            value="{{ old('company_name') }}" data-label="Company Name">
                                        @error('company_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Designation</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="designation" placeholder="Your job title"
                                            value="{{ old('designation') }}" data-label="Designation">
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Place of Work</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="place_of_work" placeholder="City / Location"
                                            value="{{ old('place_of_work') }}" data-label="Place of Work">
                                        @error('place_of_work')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Experience (Years)</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="year_of_experience"
                                            placeholder="Total experience in years"
                                            value="{{ old('year_of_experience') }}"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                                            data-label="Experience (Years)">
                                        @error('year_of_experience')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Employment Status <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="employment_status" required data-label="Employment Status">
                                            <option value="">Select</option>
                                            <option value="Working"
                                                {{ old('employment_status') == 'Working' ? 'selected' : '' }}>
                                                Working
                                            </option>
                                            <option value="Not Working"
                                                {{ old('employment_status') == 'Not Working' ? 'selected' : '' }}>
                                                Not Working
                                            </option>
                                        </select>
                                        @error('employment_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Annual Income (INR)</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="annual_income" placeholder="e.g. 5,00,000"
                                            value="{{ old('annual_income') }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            data-label="Annual Income">
                                        @error('annual_income')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                        <input type="text" name="father_name" placeholder="Father's full name"
                                            value="{{ old('father_name') }}" required data-label="Father Name">
                                        @error('father_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Father Occupation <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="father_occupation" placeholder="Father's occupation"
                                            value="{{ old('father_occupation') }}" required
                                            data-label="Father Occupation">
                                        @error('father_occupation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Mother Name <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="mother_name" placeholder="Mother's full name"
                                            value="{{ old('mother_name') }}" required data-label="Mother Name">
                                        @error('mother_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Mother Occupation <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="mother_occupation" placeholder="Mother's occupation"
                                            value="{{ old('mother_occupation') }}" required
                                            data-label="Mother Occupation">
                                        @error('mother_occupation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Family Income</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="family_income" placeholder="Total family income"
                                            value="{{ old('family_income') }}" data-label="Family Income"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        @error('family_income')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Family Status <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <select name="family_status" required data-label="Family Status">
                                            <option value="">Select</option>
                                            <option value="Middle Class"
                                                {{ old('family_status') == 'Middle Class' ? 'selected' : '' }}>
                                                Middle Class
                                            </option>
                                            <option value="Upper Middle Class"
                                                {{ old('family_status') == 'Upper Middle Class' ? 'selected' : '' }}>
                                                Upper Middle Class
                                            </option>
                                            <option value="Rich and Affluent"
                                                {{ old('family_status') == 'Rich and Affluent' ? 'selected' : '' }}>
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
                                        <select name="family_values" required data-label="Family Values">
                                            <option value="">Select</option>
                                            <option value="Orthodox"
                                                {{ old('family_values') == 'Orthodox' ? 'selected' : '' }}>Orthodox
                                            </option>
                                            <option value="Modern"
                                                {{ old('family_values') == 'Modern' ? 'selected' : '' }}>Modern
                                            </option>
                                            <option value="Liberal"
                                                {{ old('family_values') == 'Liberal' ? 'selected' : '' }}>Liberal
                                            </option>
                                            <option value="Spiritually Inclined"
                                                {{ old('family_values') == 'Spiritually Inclined' ? 'selected' : '' }}>
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
                                        <select name="living_with_family" required data-label="Living With Family">
                                            <option value="">Select</option>
                                            <option value="Yes"
                                                {{ old('living_with_family') == 'Yes' ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="No"
                                                {{ old('living_with_family') == 'No' ? 'selected' : '' }}>No
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
                                        <input type="text" name="living_at" placeholder="Current city"
                                            value="{{ old('living_at') }}" data-label="Living At">
                                        @error('living_at')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Ancestral Origin</label>
                                    <div class="banner__inputlist">
                                        <input type="text" name="ancestral_origin" placeholder="Native place / origin"
                                            value="{{ old('ancestral_origin') }}" data-label="Ancestral Origin">
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
                                        <input type="text" name="birth_place" placeholder="City of birth"
                                            value="{{ old('birth_place') }}" required data-label="Birth Place">
                                        @error('birth_place')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Birth Time</label>
                                    <div class="banner__inputlist">
                                        <input type="time" name="birth_time" value="{{ old('birth_time') }}"
                                            data-label="Birth Time">
                                        @error('birth_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label>Kundali Details</label>
                                    <div class="banner__inputlist">
                                        <textarea name="kundali_details" rows="3" placeholder="Any kundali or horoscope notes"
                                            data-label="Kundali Details">{{ old('kundali_details') }}</textarea>
                                        @error('kundali_details')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Upload Full Photo <span class="astrick">*</span></label>
                                    <div class="banner__inputlist">
                                        <input type="file" name="full_photo" required data-label="Upload Full Photo">
                                        @error('full_photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Govt ID Proof </label>
                                    <div class="banner__inputlist">
                                        <input type="file" name="govt_id_proof" data-label="Govt ID Proof">
                                        @error('govt_id_proof')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>Upload Kundali</label>
                                    <div class="banner__inputlist">
                                        <input type="file" name="kundali" data-label="Upload Kundali">
                                        @error('kundali')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-md mt-2">
                            <span>Submit</span>
                        </button>



                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
