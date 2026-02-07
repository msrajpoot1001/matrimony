@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Create Member Role')

@section('content')

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

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-lg-12 mx-auto">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">Create Member Role</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.member-role.store') }}" method="POST">
                        @csrf

                        {{-- Role Name --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Role Name <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter role name"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select name="is_active" class="form-control" required>
                                <option value="">-- Select Status --</option>
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.member-role.index') }}"
                               class="btn btn-secondary me-2">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Save Role
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
