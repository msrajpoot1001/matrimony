@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add Hero Content')

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

    {{-- Toggle Button --}}
    <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">
            Create Hero Content
        </button>
    </div>

    {{-- Create Form --}}
    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Hero Content</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.hero-contents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Hero Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Background Image --}}
                        <div class="mb-3">
                            <label class="form-label">Background Image</label>
                            <input type="file" name="bg_image"
                                class="form-control @error('bg_image') is-invalid @enderror">
                            @error('bg_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Listing --}}
    <div class="row mt-4">
        <div class="col">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">All Hero Contents</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Title</th>
                                    <th>Background Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($heroes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $item->title }}</td>

                                        <td>
                                            @if ($item->bg_image)
                                                <img src="{{ asset( $item->bg_image) }}" width="120"
                                                    class="rounded">
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div style="display:flex; align-items:center; gap:8px;">

                                                {{-- Edit --}}
                                                <a href="{{ route('admin.hero-contents.edit', $item->id) }}"
                                                    class="btn btn-sm btn-primary btn-icon" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.hero-contents.destroy', $item->id) }}"
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
                                        <td colspan="100%" class="text-center text-muted">
                                            No Hero Content Found.
                                        </td>
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
