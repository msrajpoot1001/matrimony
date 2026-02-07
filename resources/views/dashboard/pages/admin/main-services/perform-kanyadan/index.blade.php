@extends('dashboard.layouts.app')

@section('title', 'Perform Kanyadan Records')

@section('content')

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Kanyadan Contributions</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.perform-kanyadan.create') }}" class="btn btn-sm btn-primary view-btn">
                            Create Kanyadan
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>SN</th>

                                    <th>Donor</th>
                                    <th>Contact</th>
                                    <th>Type</th>
                                    <th>Amount</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($kanyadans as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $item->donor_name }}</td>
                                        <td>{{ $item->contact_number }}</td>
                                        <td>{{ $item->kanyadan_type }}</td>
                                        <td>{{ $item->donation_amount ? '₹' . $item->donation_amount : 'N/A' }}</td>

                                        <td>
                                            <a href="{{ route('admin.perform-kanyadan.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary view-btn">
                                                Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-primary view-btn"
                                                data-item='@json($item)'>
                                                View
                                            </button>
                                            <form action="{{ route('admin.perform-kanyadan.destroy', $item->id) }}"
                                                method="POST"
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
                            {{ $kanyadans->links() }}
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
                    <h5 class="modal-title">Kanyadan Details</h5>
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

            // Date formatter (India format)
            const formatDate = (date) => {
                if (!date) return 'N/A';
                return new Date(date).toLocaleDateString('en-IN', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            };

            document.querySelectorAll('.view-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const item = JSON.parse(this.dataset.item);
                    let html = '';

                    const fields = {
                        'Donor Name': item.donor_name ?? 'N/A',

                        // 🔗 FROM USER TABLE
                        'Email': item.user?.email ?? 'N/A',
                        'Contact Number': item.user?.contact_number ?? 'N/A',

                        'Gender': item.gender ?? 'N/A',
                        'DOB': formatDate(item.dob),
                        'WhatsApp Number': item.whatsapp_number ?? 'N/A',
                      
                        'Kanyadan Type': item.kanyadan_type ?? 'N/A',
                        'Donation Amount': item.donation_amount ?
                            '₹' + Number(item.donation_amount).toLocaleString('en-IN') :
                            'N/A',
                        'Other Kanyadan': item.other_kanyadan ?? 'N/A',
                        'Blessings / Sankalp': item.blessings ?? 'N/A',
                        'Submitted At': formatDate(item.created_at)
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
