@extends('dashboard.layouts.app')

@section('title', 'Astrologer Records')

@section('content')

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Astrologer Registrations</h4>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.astrology.create') }}" class="btn btn-sm btn-primary view-btn">
                            Create Astrology
                        </a>
                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Service Provider    </th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Specialization</th>
                                    <th>Experience</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($astrologers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user_type }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->user->contact_number }}</td>
                                        <td>{{ $item->specialization }}</td>
                                        <td>{{ $item->experience_years }} yrs</td>
                                        <td>{{ $item->location }}</td>
                                        <td>
                                            <a href="{{ route('admin.astrology.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary view-btn">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary view-btn"
                                                data-item='@json($item)'>
                                                View
                                            </button>
                                            <form action="{{ route('admin.astrology.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this astrologer?');"
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
                                        <td colspan="100%" class="text-center text-muted">
                                            No records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $astrologers->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 🔍 VIEW MODAL -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Astrologer Details</h5>
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

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Ensure Bootstrap is loaded
            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap JS not loaded');
                return;
            }

            const modalElement = document.getElementById('viewModal');
            const modal = new bootstrap.Modal(modalElement);

            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function() {

                    const item = JSON.parse(this.getAttribute('data-item'));
                    let html = '';

                    // DOB formatting function
                    const formatDate = (date) => {
                        if (!date) return 'N/A';
                        const d = new Date(date);
                        return d.toLocaleDateString('en-IN', {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric'
                        });
                    };

                    const fields = {
                        'I am Service Provider Consumer? ': item.user_type ?? 'N/A',

                        // USER RELATION DATA
                        'Name': item.user?.name ?? 'N/A',
                        'Email': item.user?.email ?? 'N/A',
                        'Gender': item.gender ?? 'N/A',
                        'Date of Birth': formatDate(item.dob),
                        'Contact Number': item.user?.contact_number ?? 'N/A',
                        'WhatsApp Number': item.whatsapp_number ?? 'N/A',

                        // ASTROLOGY DATA
                        'Specialization': item.specialization ?? 'N/A',
                        'Experience (Years)': item.experience_years ?? 'N/A',
                        'Location': item.location ?? 'N/A',
                        'Services Offered': item.services_offered ?? 'N/A',
                        'Other Service': item.other_service ?? 'N/A',
                        'Registered At': formatDate(item.created_at)
                    };

                    for (const key in fields) {
                        html += `
                <tr>
                    <th>${key}</th>
                    <td>${fields[key]}</td>
                </tr>
            `;
                    }

                    document.getElementById('modalBody').innerHTML = html;
                    modal.show();
                });
            });


        });
    </script>
@endpush
