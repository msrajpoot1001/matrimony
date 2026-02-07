@extends('dashboard.layouts.app')

@section('title', 'Match Making Records')
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function formatDate(dateStr) {
                if (!dateStr) return 'N/A';
                const d = new Date(dateStr);
                if (isNaN(d)) return 'N/A';

                return d.toLocaleDateString('en-IN', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }

            const modal = new bootstrap.Modal(document.getElementById('viewModal'));

            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const item = JSON.parse(this.dataset.item);
                    let rows = '';

                    const fields = {
                        'Application ID': item.application_id ?? 'N/A',
                        'Looking For': item.looking_for ?? 'N/A',
                        'Candidate Name': item.candidate_name ?? 'N/A',

                        // ✅ FROM USER TABLE
                        'Email': item.user?.email ?? 'N/A',
                        'Contact Number': item.user?.contact_number ?? 'N/A',

                        'Gender': item.gender ?? 'N/A',
                        'Date of Birth': formatDate(item.dob),
                        'Height': item.height ? item.height + ' inches' : 'N/A',
                        'WhatsApp Number': item.whatsapp_number ?? 'N/A',

                        'Marital Status': item.marital_status ?? 'N/A',
                        'Religion': item.religion ?? 'N/A',
                        'Caste': item.caste?.name ?? 'N/A',
                        'Sub Caste': item.sub_caste?.name ?? 'N/A',
                        'Manglik Status': item.manglik_status ?? 'N/A',
                        'Inter-Caste Marriage': item.interest_inter_caste ?? 'N/A',

                        'Qualification': item.qualification ?? 'N/A',
                        'Company Name': item.company_name ?? 'N/A',
                        'Designation': item.designation ?? 'N/A',
                        'Place of Work': item.place_of_work ?? 'N/A',
                        'Experience (Years)': item.year_of_experience ?? 'N/A',
                        'Employment Status': item.employment_status ?? 'N/A',
                        'Annual Income': item.annual_income ?? 'N/A',

                        'Father Name': item.father_name ?? 'N/A',
                        'Father Occupation': item.father_occupation ?? 'N/A',
                        'Mother Name': item.mother_name ?? 'N/A',
                        'Mother Occupation': item.mother_occupation ?? 'N/A',
                        'Family Income': item.family_income ?? 'N/A',
                        'Family Status': item.family_status ?? 'N/A',
                        'Family Values': item.family_values ?? 'N/A',
                        'Living With Family': item.living_with_family ?? 'N/A',
                        'Living At': item.living_at ?? 'N/A',
                        'Ancestral Origin': item.ancestral_origin ?? 'N/A',

                        'Birth Place': item.birth_place ?? 'N/A',
                        'Birth Time': item.birth_time ?? 'N/A',
                        'Kundali Details': item.kundali_details ?? 'N/A',
                    };

                    for (const [label, value] of Object.entries(fields)) {
                        rows += `
                    <tr>
                        <th width="35%">${label}</th>
                        <td>${value}</td>
                    </tr>
                `;
                    }

                    /* ================= FILES ================= */

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
                    modal.show();
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
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.match-making.create') }}" class="btn btn-sm btn-primary view-btn">
                            Create Match Making
                        </a>
                    </div>
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
                                            <a href="{{ route('admin.match-making.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary view-btn">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary view-btn"
                                                data-item='@json($item)'>
                                                View
                                            </button>
                                            <form action="{{ route('admin.match-making.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this match makeing?');"
                                                style="display:inline-block;">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>

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
