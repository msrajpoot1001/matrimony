@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Payment Gateway'))

@section('content')


 

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst('Payment Gateway') }}</button>
    </div>

    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add {{ ucfirst('Payment Gateway') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payment-gateway.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="gateway_name" class="form-label">Gateway Name</label>
                            <input type="text" name="gateway_name" id="gateway_name"
                                class="form-control @error('gateway_name') is-invalid @enderror"
                                value="{{ old('gateway_name') }}">
                            @error('gateway_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="key" class="form-label">Key</label>
                            <input type="text" name="key" id="key"
                                class="form-control @error('key') is-invalid @enderror" value="{{ old('key') }}">
                            @error('key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="secreat" class="form-label">Secreat</label>
                            <input type="text" name="secreat" id="secreat"
                                class="form-control @error('secreat') is-invalid @enderror" value="{{ old('secreat') }}">
                            @error('secreat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active</label>
                            <select name="is_active" id="is_active"
                                class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All {{ ucfirst('Payment Gateway') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Gateway Name</th>
                                    <th>Key</th>
                                    <th>Secreat</th>
                                    <th>Is Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td class="v-center">{{ $loop->iteration }}</td>
                                        <td class="v-center">{{ $item->gateway_name ?? 'N/A' }}</td>
                                        <td class="v-center">{{ $item->key ?? 'N/A' }}</td>
                                        <td class="v-center">{{ $item->secreat ?? 'N/A' }}</td>
                                        <td class="v-center">
                                            @if ($item->is_active == 1)
                                                <span class="badge bg-success">Active</span>
                                            @elseif ($item->is_active == 0)
                                                <span class="badge bg-danger">Inactive</span>
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>
                                        <td class="v-center">

                                            <div style="display:flex; align-items:center; gap:8px;">

                                                {{-- Edit Icon --}}
                                                <a href="{{ route('admin.payment-gateway.edit', $item->id) }}"
                                                    class="btn btn-sm btn-primary btn-icon" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- Delete Icon --}}
                                                <form action="{{ route('admin.payment-gateway.destroy', $item->id) }}"
                                                    method="POST" style="margin:0;"
                                                    onsubmit="return handleDeleteReason(this)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="delete_reason">

                                                    <button type="submit" class="btn btn-sm btn-danger btn-icon"
                                                        title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </div>

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted">No Data available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
