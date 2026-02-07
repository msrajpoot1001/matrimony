@extends('dashboard.layouts.app')

@section('title', 'Order Records')

@section('content')

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Orders</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Order No</th>
                                    <th>Product</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Amount (₹)</th>
                                    <th>Status</th>
                                    <th>Ordered At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->order_no }}</td>
                                        <td>{{ $order->product->name ?? 'N/A' }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td> {{ number_format($order->amount) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status === 'paid' ? 'success' : 'warning' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary view-btn"
                                                data-item='@json($order)'>
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted">
                                            No orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 🔍 VIEW ORDER MODAL -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
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

            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap JS not loaded');
                return;
            }

            const modal = new bootstrap.Modal(document.getElementById('viewModal'));

            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function() {

                    const order = JSON.parse(this.getAttribute('data-item'));
                    let html = '';

                    const formatDate = (date) => {
                        if (!date) return 'N/A';
                        const d = new Date(date);
                        return d.toLocaleDateString('en-IN', {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    };

                    const fields = {
                        'Order No': order.order_no ?? 'N/A',
                        // 'Product ID': order.astro_product_id ?? 'N/A',
                        'Customer Name': order.name ?? 'N/A',
                        'Email': order.email ?? 'N/A',
                        'Phone': order.phone ?? 'N/A',
                        'Delivery Address': order.address ?? 'N/A',
                        'Pincode': order.pincode ?? 'N/A',
                        'Amount': '₹ ' + order.amount,
                        'Payment Status': order.status ?? 'N/A',
                        'Razorpay Order ID': order.razorpay_order_id ?? 'N/A',
                        'Razorpay Payment ID': order.razorpay_payment_id ?? 'N/A',
                        'Ordered At': formatDate(order.created_at),
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
