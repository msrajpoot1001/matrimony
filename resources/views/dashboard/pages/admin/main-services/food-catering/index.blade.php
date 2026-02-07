@extends('dashboard.layouts.app')

@section('title', 'Food Catering Records')

@section('content')

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Food Catering Registrations</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.food-catering.create') }}" class="btn btn-sm btn-primary view-btn">
                            Create Food Catering
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Service Provider</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                  
                                    <th>Experience</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($foodCaterings as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user_type }}</td>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->user->contact_number }}</td>
                                       
                                        <td>{{ $item->experience_years }} yrs</td>
                                        <td>{{ $item->location }}</td>
                                        <td>
                                            <a href="{{ route('admin.food-catering.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary view-btn">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary view-btn"
                                                data-item='@json($item)'>
                                                View
                                            </button>
                                            <form action="{{ route('admin.food-catering.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this food catering?');"
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
                            {{ $foodCaterings->links() }}
                        </div>
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
                    <h5 class="modal-title">Food Catering Details</h5>
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

            const modal = new bootstrap.Modal(document.getElementById('viewModal'));

            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const item = JSON.parse(this.dataset.item);
                    let html = '';

                    // 🔹 Date formatter
                    const formatDate = (date) => {
                        if (!date) return 'N/A';
                        return new Date(date).toLocaleDateString('en-IN', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        });
                    };

                    const fields = {
                        'User Type': item.user_type ?? 'N/A',

                        // 👤 USER TABLE DATA (from relation)
                        'Full Name': item.user?.name ?? item.full_name ?? 'N/A',
                        'Email': item.user?.email ?? 'N/A',
                        'Contact Number': item.user?.contact_number ?? 'N/A',

                        'Gender': item.gender ?? 'N/A',
                        'DOB': formatDate(item.dob),
                        'WhatsApp Number': item.whatsapp_number ?? 'N/A',
                        'Qualification': item.qualification ?? 'N/A',
                        'Experience (Years)': item.experience_years ?? 'N/A',
                        'Location': item.location ?? 'N/A',
                        'Looking For': item.looking_for ?? 'N/A',
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
