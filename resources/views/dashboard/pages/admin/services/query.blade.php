@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Query Messages')

@section('content')

    {{-- Flash Success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="card-title mb-0">All Query Messages</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Name</th>                
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Received At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td style="max-width:250px;">
                                            {{ Str::limit($contact->message, 80) }}
                                        </td>
                                        <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#viewContactModal" data-name="{{ $contact->name }}"
                                                    data-phone="{{ $contact->phone }}"
                                                 
                                                    data-message="{{ $contact->message }}"
                                                    data-date="{{ $contact->created_at->format('d M Y, h:i A') }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>


                                                {{-- Delete --}}
                                                <form action="{{ route('admin.delete.contact', $contact->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            No contact messages found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $contacts->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewContactModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Query Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th width="30%">Name</th>
                            <td id="modal-name"></td>
                        </tr>
                      
                        <tr>
                            <th>Phone</th>
                            <td id="modal-phone"></td>
                        </tr>
                       
                        <tr>
                            <th>Message</th>
                            <td id="modal-message"></td>
                        </tr>
                        <tr>
                            <th>Received At</th>
                            <td id="modal-date"></td>
                        </tr>
                    </table>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        const viewContactModal = document.getElementById('viewContactModal');

        viewContactModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            document.getElementById('modal-name').textContent = button.getAttribute('data-name');
            document.getElementById('modal-phone').textContent = button.getAttribute('data-phone');
            document.getElementById('modal-message').textContent = button.getAttribute('data-message');
            document.getElementById('modal-date').textContent = button.getAttribute('data-date');
        });
    </script>




@endsection
