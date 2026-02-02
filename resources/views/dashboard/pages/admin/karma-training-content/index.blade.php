@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Karma Training Content')

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

    {{-- Create Button --}}
    <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">
            Create Karma Training
        </button>
    </div>

    {{-- Create Form --}}
    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Karma Training Content</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.karma-training-content.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="photo" class="form-label">Photo </label>
                                <input type="file" name="photo" id="photo"
                                    class="form-control preview-image-input @error('photo') is-invalid @enderror"
                                    data-preview-id="photo_preview_1" accept="image/*">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 d-flex justify-content-center align-items-center">
                                <img id="photo_preview_1" src=""
                                    style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Small Description</label>
                            <textarea name="short_description" id="description1" rows="4"
                                class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="description2" rows="4"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Author Name --}}
                        <div class="mb-3">
                            <label class="form-label">Author Name</label>
                            <input type="text" name="author_name"
                                class="form-control @error('author_name') is-invalid @enderror"
                                value="{{ old('author_name') }}">
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="author_photo" class="form-label">Author Photo </label>
                                <input type="file" name="author_photo" id="author_photo"
                                    class="form-control preview-image-input @error('author_photo') is-invalid @enderror"
                                    data-preview-id="author_photo_preview_2" accept="image/*">
                                @error('author_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 d-flex justify-content-center align-items-center">
                                <img id="author_photo_preview_2" src=""
                                    style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Author Description</label>
                            <textarea name="author_description" id="description3" rows="4"
                                class="form-control @error('author_description') is-invalid @enderror">{{ old('author_description') }}</textarea>
                            @error('author_description')
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

                        {{-- Submit --}}
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
                    <h4 class="card-title">All Karma Training Contents</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Title</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>

                                            @if ($item->photo)
                                                @if (\Illuminate\Support\Str::endsWith($item->photo, ['.mp4', '.mov', '.avi', '.webm']))
                                                    {{-- <video width="70" height="50" controls>
                                                        <source src="{{ asset($item->photo) }}">
                                                    </video> --}}
                                                    video
                                                @else
                                                    <img src="{{ asset($item->photo) }}" width="70" class="rounded">
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                        <td>{{ $item->is_active == 1 ? 'active' : 'in-active' }}</td>
                                        <td>
                                            <div style="display:flex; gap:8px;">

                                                {{-- Edit --}}
                                                <a href="{{ route('admin.karma-training-content.edit', $item->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form
                                                    action="{{ route('admin.karma-training-content.destroy', $item->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted">
                                            No Data Available
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $items->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
