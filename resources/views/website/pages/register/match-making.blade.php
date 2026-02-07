@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Match Making Service | Prajapati Ghatasutra
@endsection

{{-- meta description  --}}
@section('meta_description')
    This is the description for this page.
@endsection

{{-- meta keywords --}}
@section('meta_keywords')
    keyword1, keyword2, keyword3
@endsection


{{-- custom csss  --}}
@section('style')
    <style>
        .about--style2 .about__right .default-btn {
            color: black;
        }

        input,
        select {
            width: 100% !important;
            font-weight: bold !important;
        }



        .banner__list h6 {
            margin-top: 1rem;
        }

        .banner__inputlist select {
            padding-block: 10px !important;
        }

        .astrick {
            font-size: 1.2rem;
            font-weight: bold;
            /* color: red !important; */
        }

        .is-invalid {
            border: 1px solid red !important;
        }
    </style>

    {{-- custom modal css  --}}
    <style>
        .custom-modal {
            position: fixed;
            inset: 0;
            display: none;
            z-index: 9999;
        }

        .custom-modal.active {
            display: block;
        }

        .custom-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
        }

        .custom-modal-box {
            position: relative;
            background: #fff;
            max-width: 420px;
            width: 90%;
            margin: 15vh auto;
            border-radius: 10px;
            animation: scaleIn 0.25s ease;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.85);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .custom-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 18px;
            border-bottom: 1px solid #eee;
        }

        .custom-modal-header h5 {
            margin: 0;
            color: var(--orange-color) !important;
            font-size: 18px;
        }

        .custom-modal-header .modal-close {
            font-size: 4rem;
            cursor: pointer;
            color: var(--orange-color) !important;
            line-height: 2rem !important;
        }

        .custom-modal-body {
            padding: 16px 18px;
        }

        .custom-modal-body ul {
            padding-left: 18px;
            margin-top: 10px;
        }

        .custom-modal-body li {
            color: #d32f2f !important;
            cursor: pointer;
            margin-bottom: 6px;
        }

        .custom-modal-body li:hover {
            text-decoration: underline;
        }

        .custom-modal-body .note {
            color: black !important;
        }

        .custom-modal-footer {
            padding: 12px 18px;
            text-align: right;
            border-top: 1px solid #eee;
        }
    </style>

    <style>
        .custom-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .custom-modal-content {
            background: #fff;
            width: 90%;
            max-width: 600px;
            border-radius: 8px;
            animation: fadeIn 0.3s ease;
        }

        .custom-modal-header {
            background: #dc3545;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-modal-body {
            padding: 20px;
        }

        .custom-modal-body ul {
            margin: 0;
            padding-left: 20px;
        }

        .custom-modal-body li {
            color: #dc3545;
            margin-bottom: 8px;
        }

        .custom-modal-footer {
            padding: 15px 20px;
            text-align: right;
        }

        .custom-modal-footer button {
            padding: 8px 16px;
            border: none;
            background: #6c757d;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .custom-close {
            cursor: pointer;
            font-size: 22px;
        }

        @keyframes fadeIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
@endsection

{{-- custom script for this page --}}
@section('script')
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

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            let currentStep = 1;
            const steps = document.querySelectorAll('.banner__list');
            const totalSteps = steps.length;

            const modal = document.getElementById('validationModal');
            const errorList = document.getElementById('errorList');

            function showModal() {
                modal.classList.add('active');
            }

            function hideModal() {
                modal.classList.remove('active');
            }

            function validateCurrentStep(step) {
                const requiredFields = steps[step - 1].querySelectorAll('[required]');
                errorList.innerHTML = '';
                let hasError = false;

                requiredFields.forEach(field => {
                    field.classList.remove('error-field');

                    if (!field.value.trim()) {
                        hasError = true;
                        field.classList.add('error-field');

                        let label = field.dataset.label || 'This field';
                        let li = document.createElement('li');
                        li.textContent = label;

                        li.onclick = () => {
                            hideModal();
                            field.focus();
                        };

                        errorList.appendChild(li);
                    }
                });

                if (hasError) showModal();
                return !hasError;
            }

            document.querySelector('.next-btn').addEventListener('click', () => {
                if (validateCurrentStep(currentStep)) {
                    currentStep++;
                    toggleSteps();
                }
            });

            document.querySelector('.prev-btn').addEventListener('click', () => {
                currentStep--;
                toggleSteps();
            });

            function toggleSteps() {
                steps.forEach((step, index) => {
                    step.style.display = index === currentStep - 1 ? 'block' : 'none';
                });

                document.querySelector('.prev-btn').style.display = currentStep === 1 ? 'none' : 'inline-block';
                document.querySelector('.next-btn').style.display = currentStep === totalSteps ? 'none' :
                    'inline-block';
                document.querySelector('.submit-btn').classList.toggle('d-none', currentStep !== totalSteps);
            }

            document.querySelector('.modal-close').onclick = hideModal;
            document.querySelector('.modal-ok-btn').onclick = hideModal;
            modal.querySelector('.custom-modal-backdrop').onclick = hideModal;

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') hideModal();
            });

            toggleSteps();
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

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorModal = new bootstrap.Modal(
                    document.getElementById('validationErrorModal')
                );
                errorModal.show();
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('customErrorModal');
            if (modal) {
                modal.style.display = 'flex';
            }
        });

        function closeErrorModal() {
            document.getElementById('customErrorModal').style.display = 'none';
        }
    </script>
@endsection


@section('content')

    <!-- ================> Page Header section start here <================== -->
    <div class="pageheader bg_img" style="background-image: url('{{ asset('assets/images/banner/banner-hero2.jpeg') }}');">
        <div class="container" style="padding:5rem 0rem;">
            <div class="pageheader__content text-center">
                <h2>Register For Match Making</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Match Making Service</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ================> Page Header section end here <================== -->


    @include('components.success-modal')
    {{-- @include('components.error-modal') --}}

    @if ($errors->any())
        <div id="customErrorModal" class="custom-modal">
            <div class="custom-modal-content">

                <div class="custom-modal-header">
                    <h4>❌ Please fix the following errors</h4>
                    <span class="custom-close" onclick="closeErrorModal()">&times;</span>
                </div>

                <div class="custom-modal-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="custom-modal-footer">
                    <button onclick="closeErrorModal()">Close</button>
                </div>

            </div>
        </div>
    @endif

    <!-- ================> About section start here <================== -->
    <div class="about about--style2 padding-top pt-xl-0" style="margin-top:2rem">
        <div class="container">
            <div class="section__wrapper wow fadeInUp" data-wow-duration="1.5s">
                <div class="row g-0 justify-content-center row-cols-lg-2 row-cols-1">
                    {{-- <div class="col-lg-12 wow fadeInTop">
                        <div class="about__left">
                            <div class="about__top">
                                <div class="about__content">
                                    <h3>Welcome to Prajapati Ghatasutra</h3>
                                    <p>
                                        Prajapati Ghatasutra offers trusted match making services that unite compatible
                                        individuals through values, tradition, and mutual understanding—creating the
                                        foundation for a happy and lifelong marriage.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div> --}}

                    <div class="col-lg-12 wow fadeInTop website_animation">
                        <div class="about__right">
                            <div class="about__title">
                                <h3>Create Profile</h3>
                            </div>
                            <form action="{{ route('match.making.store') }}" method="POST" enctype="multipart/form-data"
                                novalidate>
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

                                        <div class="col-6">
                                            <label>Register For <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <select name="looking_for" id="looking_for" required
                                                    data-label="Register For">
                                                    <option value="Bride"
                                                        {{ old('looking_for') == 'Bride' ? 'selected' : '' }}>Bride</option>
                                                    <option value="Groom"
                                                        {{ old('looking_for') == 'Groom' ? 'selected' : '' }}>Groom</option>
                                                </select>
                                                @error('looking_for')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Full Name <span class="astrick">*</span></label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="candidate_name"
                                                    placeholder="Enter your full name" value="{{ old('candidate_name') }}"
                                                    required data-label="Full Name">
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
                                                <input type="tel" name="contact_number"
                                                    placeholder="10 digit mobile number" maxlength="13"
                                                    value="{{ old('contact_number') }}" required
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
                                                    value="{{ old('qualification') }}" required
                                                    data-label="Qualification">
                                                @error('qualification')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Company Name</label>
                                            <div class="banner__inputlist">
                                                <input type="text" name="company_name"
                                                    placeholder="Current company name" value="{{ old('company_name') }}"
                                                    data-label="Company Name">
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
                                                <input type="text" name="father_occupation"
                                                    placeholder="Father's occupation"
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
                                                <input type="text" name="mother_occupation"
                                                    placeholder="Mother's occupation"
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
                                                <input type="text" name="family_income"
                                                    placeholder="Total family income" value="{{ old('family_income') }}"
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
                                                <select name="living_with_family" required
                                                    data-label="Living With Family">
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
                                                <input type="text" name="ancestral_origin"
                                                    placeholder="Native place / origin"
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
                                                <input type="file" name="full_photo" required
                                                    data-label="Upload Full Photo">
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

                                <!-- NAVIGATION -->
                                <div class="mt-4 text-center">
                                    <button type="button" class="default-btn prev-btn">Previous</button>
                                    <button type="button" class="default-btn next-btn">Next</button>
                                    <button type="submit" class="default-btn reverse submit-btn d-none">Submit
                                        Profile</button>
                                </div>

                            </form>

                            <!-- Custom Validation Modal -->
                            <div class="custom-modal" id="validationModal">
                                <div class="custom-modal-backdrop"></div>

                                <div class="custom-modal-box">
                                    <div class="custom-modal-header">
                                        <h5>Required Fields Missing</h5>
                                        <span class="modal-close">&times;</span>
                                    </div>

                                    <div class="custom-modal-body">
                                        <p class="note">Please complete the following fields:</p>
                                        <ul id="errorList"></ul>
                                    </div>

                                    <div class="custom-modal-footer">
                                        <button class="default-btn modal-ok-btn">OK</button>
                                    </div>
                                </div>
                            </div>










                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>



@endsection
