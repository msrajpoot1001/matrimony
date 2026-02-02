@extends('dashboard.layouts.app')

@section('title', 'View Records')

@section('content')

    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">All Records</h4>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>SNo.</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($records as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>{{ $item->email }}</td>

                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            {{-- Edit --}}
                                            <button type="button" class="btn btn-sm btn-primary edit-btn1"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $item->id }}" data-email="{{ $item->email }}"
                                                data-status="{{ $item->is_active }}">
                                                Edit
                                            </button>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.subscriptions.destroy', $item->id) }}"
                                                method="POST" class="m-0"
                                                onsubmit="return confirm('Are you sure you want to delete this subscription?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        No records found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>


    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Subscription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="editEmail" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="is_active" id="editStatus" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.edit-btn1').forEach(button => {
                button.addEventListener('click', function() {

                    const id = this.dataset.id;
                    const email = this.dataset.email;
                    const status = this.dataset.status;

                    document.getElementById('editEmail').value = email;
                    document.getElementById('editStatus').value = status;

                    document.getElementById('editForm').action =
                        "{{ url('admin/subscriptions') }}/" + id;
                });
            });

        });
    </script>





@endsection
