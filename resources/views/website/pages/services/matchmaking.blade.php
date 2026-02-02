@extends('website.layouts.app')

@section('title', 'Matrimony Profiles')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ================= HERO ================= */
        .profiles-hero {
            background: url('/assets/images/banner/banner-hero2.jpeg') center/cover no-repeat;
            padding: 90px 20px;
            /* color: #fff; */
            text-align: center;
            border-radius: 0 0 40px 40px;
        }

        .profiles-hero h1 {
            font-size: 2.6rem;
            font-weight: 700;
        }

        .profiles-hero p {
            font-size: 1.1rem;
            opacity: .9;
        }

        /* ================= CARDS ================= */
        .profile-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            transition: .4s;
        }

        .profile-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 45px rgba(0, 0, 0, .12);
        }

        .profile-img {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .4s;
        }

        .profile-card:hover img {
            transform: scale(1.05);
        }

        .badge-gender {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, #d4af37, #b9962f);
            color: #000;
            font-size: .75rem;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
        }

        /* ================= CONTENT ================= */
        .profile-body h5 {
            font-weight: 700;
        }

        .profile-info li {
            margin-bottom: 4px;
        }

        /* ================= BUTTONS ================= */
        .btn-outline-primary {
            border-radius: 20px;
            font-weight: 600;
        }

        .btn-success {
            border-radius: 20px;
            font-weight: 600;
        }

        /* ================= MODAL ================= */
        .modal-content {
            border-radius: 20px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-body img {
            border-radius: 15px;
        }

        /* ================= PAGINATION ================= */
        .pagination .page-link {
            border-radius: 50% !important;
            margin: 0 4px;
        }

        /* ================= EMPTY ================= */
        .no-profiles {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .view-profile {
            color: white !important;
            background: var(--primary-color) !important;
            border: none !important;
        }

        .modal-title {
            font-size: 2rem !important;
        }

        .application_id {
            color: #8b0000 !important;
        }
    </style>
@endsection

@section('content')

    {{-- HERO --}}
    <section class="profiles-hero">
        <div class="container">
            <h1 >Find Your Perfect Match</h1>
            <p>Verified profiles • Trusted matrimony service</p>
        </div>
    </section>

    {{-- PROFILES --}}
    <section class="profiles-section py-5">
        <div class="container">

            <div class="row g-4">

                @forelse($profiles as $profile)
                    <div class="col-lg-4 col-md-6">

                        <div class="profile-card h-100">

                            {{-- Image --}}
                            <div class="profile-img">
                                <img src="{{ asset($profile->full_photo) }}" alt="Profile Image">
                                <span class="badge-gender">{{ $profile->looking_for }}</span>
                            </div>

                            {{-- Body --}}
                            <div class="profile-body p-3">

                                <h6 class="mb-1 application_id">id : {{ $profile->application_id }}</h6>
                                <h5 class="mb-1">{{ $profile->candidate_name }}</h5>

                                <p class="text-muted small mb-2">
                                    {{ \Carbon\Carbon::parse($profile->dob)->age }} yrs •
                                    {{ $profile->height ? $profile->height . '"' : '—' }} •
                                    {{ $profile->religion }}
                                </p>

                                <ul class="profile-info list-unstyled small mb-3">
                                    <li><strong>Caste:</strong> {{ $profile->caste }}</li>
                                    <li><strong>Education:</strong> {{ $profile->qualification }}</li>
                                    <li><strong>Profession:</strong> {{ $profile->employment_status }}</li>
                                    <li><strong>Location:</strong> {{ $profile->birth_place }}</li>
                                    <li><strong>Make contact as:</strong> +91- XXXXXXXXXX</li>

                                </ul>

                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm view-profile"
                                        data-bs-toggle="modal" data-bs-target="#profileModal"
                                        data-application_id="{{ $profile->application_id }}"
                                        data-name="{{ $profile->candidate_name }}"
                                        data-photo="{{ asset($profile->full_photo) }}"
                                        data-age="{{ \Carbon\Carbon::parse($profile->dob)->age }}"
                                        data-gender="{{ $profile->gender }}" data-religion="{{ $profile->religion }}"
                                        data-height="{{ $profile->height }}" data-marital="{{ $profile->marital_status }}"
                                        data-education="{{ $profile->qualification }}"
                                        data-profession="{{ $profile->employment_status }}"
                                        data-birthplace="{{ $profile->birth_place }}"
                                        data-birthtime="{{ $profile->birth_time }}"
                                        data-father="{{ $profile->father_name }}"
                                        data-mother="{{ $profile->mother_name }}" data-whatsapp="{{ $company->phone }}"
                                        data-caste="{{ $profile->caste ?? '' }}"
                                        data-sub-caste="{{ $profile->sub_caste ?? '' }}">

                                        <i class="bi bi-person"></i>

                                        View Profile
                                    </a>

                                    <a href="https://wa.me/{{ $company->phone1 }}" class="btn btn-success btn-sm"
                                        target="_blank">
                                        <i class="bi bi-whatsapp" style="color:white"></i>
                                        WhatsApp
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="no-profiles">
                            <h5>No Profiles Available</h5>
                            <p class="text-muted mb-0">New profiles will appear soon.</p>
                        </div>
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $profiles->links() }}
            </div>

        </div>
    </section>

    {{-- MODAL --}}
    <div class="modal fade" id="profileModal" tabindex="-1" style="z-index:9999">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h3 class="modal-title" id="modalName"></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img id="modalPhoto" class="img-fluid mb-3">
                        </div>

                        <div class="col-md-7">

                            <h4 id="modalApplicationId"></h4>
                            <p class="text-muted mb-2">

                                <span id="modalAge"></span> yrs •
                                <span id="modalReligion"></span> •

                            </p>

                            <ul class="list-unstyled small">
                                <li><strong>Gender:</strong> <span id="modalGender"></span></li>
                                <li><strong>Height:</strong> <span id="modalHeight"></span> inches</li>
                                <li><strong>Marital Status:</strong> <span id="modalMarital"></span></li>
                                <li><strong>Education:</strong> <span id="modalEducation"></span></li>
                                <li><strong>Profession:</strong> <span id="modalProfession"></span></li>
                                <li><strong>Birth Place:</strong> <span id="modalBirthPlace"></span></li>
                                <li><strong>Birth Time:</strong> <span id="modalBirthTime"></span></li>
                                <li><strong>Caste:</strong> <span id="modalCaste"></span></li>
                                <li><strong>Sub Caste:</strong> <span id="modalSubCaste"></span></li>
                                <li><strong>Make contact as:</strong> +91- XXXXXXXXXX</li>
                            </ul>

                            <hr>

                            <h6 class="fw-bold">Family Details</h6>
                            <p>Father: <span id="modalFather"></span></p>
                            <p>Mother: <span id="modalMother"></span></p>

                            <a id="modalWhatsapp" class="btn btn-success mt-3" target="_blank">
                                <i class="bi bi-whatsapp" style="color:white"></i> Contact on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.view-profile').forEach(btn => {
                btn.addEventListener('click', function() {

                    modalName.innerText = this.dataset.name;
                    modalApplicationId.innerText = this.dataset.application_id;
                    modalPhoto.src = this.dataset.photo;
                    modalAge.innerText = this.dataset.age;
                    modalGender.innerText = this.dataset.gender;
                    modalReligion.innerText = this.dataset.religion;
                    modalHeight.innerText = this.dataset.height ?? '—';
                    modalMarital.innerText = this.dataset.marital;
                    modalEducation.innerText = this.dataset.education;
                    modalProfession.innerText = this.dataset.profession;
                    modalBirthPlace.innerText = this.dataset.birthplace;
                    modalBirthTime.innerText = this.dataset.birthtime ?? '—';
                    modalFather.innerText = this.dataset.father;
                    modalCaste.innerText = this.dataset.caste ?? '—';
                    modalSubCaste.innerText = this.dataset.subCaste ?? '—';


                    modalWhatsapp.href = 'https://wa.me/' + this.dataset.whatsapp;
                });
            });
        });
    </script>

@endsection
