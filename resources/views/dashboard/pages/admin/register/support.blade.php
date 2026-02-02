@extends('dashboard.layouts.app')

@section('title', 'Support Contributions')

@section('content')

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Contribution Requests</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Support</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($supports as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user_type }}</td>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->contact_number }}</td>
                                        <td>{{ $item->contribution_type }}</td>
                                        <td>{{ $item->amount ? '₹' . $item->amount : 'N/A' }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary view-btn"
                                                data-item='@json($item)'>
                                                View
                                            </button>
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
                            {{ $supports->links() }}
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
                    <h5 class="modal-title">Contribution Details</h5>
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

                    const fields = {
                        'User Type': item.user_type,
                        'Full Name': item.full_name,
                        'Email': item.email ?? 'N/A',
                        'Gender': item.gender ?? 'N/A',
                        'DOB': item.dob ?? 'N/A',
                        'Contact Number': item.contact_number,
                        'WhatsApp Number': item.whatsapp_number ?? 'N/A',
                        'Location': item.location,
                        'Contribution Type': item.contribution_type,
                        'Amount': item.amount ? '₹' + item.amount : 'N/A',
                        'Transaction ID': item.transction_id ?? 'N/A',
                        'Other Contribution': item.other_contribution ?? 'N/A',
                        'Message': item.message ?? 'N/A',
                        'Submitted At': item.created_at
                    };

                    for (const key in fields) {
                        html += `<tr><th>${key}</th><td>${fields[key]}</td></tr>`;
                    }

                    document.getElementById('modalBody').innerHTML = html;
                    modal.show();
                });
            });

        });
    </script>
@endpush
