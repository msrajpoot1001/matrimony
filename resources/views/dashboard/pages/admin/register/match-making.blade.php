@extends('dashboard.layouts.app')

@section('title', 'Match Making Records')

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function formatDate(dateStr) {
                if (!dateStr) return 'N/A';
                const d = new Date(dateStr);
                if (isNaN(d)) return 'N/A';
                return `${String(d.getDate()).padStart(2,'0')}/${String(d.getMonth()+1).padStart(2,'0')}/${d.getFullYear()}`;
            }

            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const item = JSON.parse(this.dataset.item);
                    let rows = '';

                    const fields = {
                        'Application ID': item.application_id,
                        'Looking For': item.looking_for,
                        'Candidate Name': item.candidate_name,
                        'Email': item.email,
                        'Gender': item.gender,
                        'Date of Birth': formatDate(item.dob),
                        'Height': item.height ? item.height + ' inches' : 'N/A',
                        'Contact Number': item.contact_number,
                        'WhatsApp Number': item.whatsapp_number,

                        'Marital Status': item.marital_status,
                        'Religion': item.religion,
                        'Caste': item.caste,
                        'Sub Caste': item.sub_caste,
                        'Manglik Status': item.manglik_status,
                        'Inter-Caste Marriage': item.interest_inter_caste,

                        'Qualification': item.qualification,
                        'Company Name': item.company_name,
                        'Designation': item.designation,
                        'Place of Work': item.place_of_work,
                        'Experience (Years)': item.year_of_experience,
                        'Employment Status': item.employment_status,
                        'Annual Income': item.annual_income,

                        'Father Name': item.father_name,
                        'Father Occupation': item.father_occupation,
                        'Mother Name': item.mother_name,
                        'Mother Occupation': item.mother_occupation,
                        'Family Income': item.family_income,
                        'Family Status': item.family_status,
                        'Family Values': item.family_values,
                        'Living With Family': item.living_with_family,
                        'Living At': item.living_at,
                        'Ancestral Origin': item.ancestral_origin,

                        'Birth Place': item.birth_place,
                        'Birth Time': item.birth_time,
                        'Kundali Details': item.kundali_details,
                    };

                    for (const [label, value] of Object.entries(fields)) {
                        rows += `
                    <tr>
                        <th width="35%">${label}</th>
                        <td>${value ?? 'N/A'}</td>
                    </tr>
                `;
                    }

                    if (item.full_photo) {
                        rows += `
                    <tr>
                        <th>Photo</th>
                        <td>
                            <img src="/${item.full_photo}" class="img-thumbnail" width="120">
                        </td>
                    </tr>
                `;
                    }

                    if (item.govt_id_proof) {
                        rows += `
                    <tr>
                        <th>Govt ID Proof</th>
                        <td>
                            <a href="/${item.govt_id_proof}" target="_blank">View Document</a>
                        </td>
                    </tr>
                `;
                    }

                    if (item.kundali) {
                        rows += `
                    <tr>
                        <th>Kundali File</th>
                        <td>
                            <a href="/${item.kundali}" target="_blank">View Kundali</a>
                        </td>
                    </tr>
                `;
                    }

                    document.getElementById('modalBody').innerHTML = rows;
                    new bootstrap.Modal(document.getElementById('viewModal')).show();
                });
            });
        });
    </script>
@endsection

@section('content')

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Match Making Profiles</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>App ID</th>
                                    <th>Name</th>
                                    <th>Looking For</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Religion</th>
                                    <th>Marital Status</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($matchMakings as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->application_id }}</td>
                                        <td>{{ $item->candidate_name }}</td>
                                        <td>{{ $item->looking_for }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->contact_number }}</td>
                                        <td>{{ $item->religion }}</td>
                                        <td>{{ $item->marital_status }}</td>

                                        <td>
                                            @if ($item->full_photo)
                                                <img src="{{ asset($item->full_photo) }}" width="60"
                                                    class="img-thumbnail">
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-primary view-btn"
                                                data-item='@json($item)'>
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">
                                            No records found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $matchMakings->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- VIEW MODAL -->
    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Match Making Profile Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody id="modalBody"></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
