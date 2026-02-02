@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Seo Pages'))

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

    {{-- <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst('Seo Pages') }}</button>
    </div> --}}

    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add {{ ucfirst('Seo Pages') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.seo-pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="page_name" class="form-label">Page Name</label>
                            <input type="text" name="page_name" id="page_name"
                                class="form-control @error('page_name') is-invalid @enderror"
                                value="{{ old('page_name') }}">
                            @error('page_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <textarea name="title" id="title" rows="3" class="form-control @error('title') is-invalid @enderror">{{ old('title') }}</textarea>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="descri" rows="3"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keywords" class="form-label">Keywords</label>
                            <textarea name="keywords" id="keywords" rows="3" class="form-control @error('keywords') is-invalid @enderror">{{ old('keywords') }}</textarea>
                            @error('keywords')
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
                    <h4 class="card-title">All {{ ucfirst('Seo Pages') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Page Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Keywords</th>
                                    <th>Is Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td class="v-center">{{ $loop->iteration }}</td>
                                        <td class="v-center">{{ $item->page_name ?? 'N/A' }}</td>
                                        <td class="v-center">{{ $item->title ?? 'N/A' }}</td>
                                        <td class="v-center" style="vertical-align: middle;">
                                            <div
                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                {{ strip_tags($item->description) }}
                                            </div>
                                        </td>
                                        <td class="v-center">{{ $item->keywords ?? 'N/A' }}</td>
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
                                            <a href="{{ route('admin.seo-pages.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary btn-icon m-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- <form action="{{ route('admin-seo-pages.destroy', $item->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm px-4 m-1"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form> --}}
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
