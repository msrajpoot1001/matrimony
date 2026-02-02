@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit Karma Training')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Karma Training Content</h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('admin.karma-training-content.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $item->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo </label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('photo') is-invalid @enderror"
                                        name="photo" id="photo" data-preview-id="photo_preview_photo"
                                        accept="image/*,video/*">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                @php
                                    $extension = pathinfo($item->photo, PATHINFO_EXTENSION);
                                    $videoExtensions = ['mp4', 'webm', 'ogg'];
                                @endphp

                                @if (in_array(strtolower($extension), $videoExtensions))
                                    <video id="photo_preview_photo" src="{{ asset($item->photo) }}" controls
                                        style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                    </video>
                                @else
                                    <img id="photo_preview_photo" src="{{ asset($item->photo) }}" alt="No Image"
                                        style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                @endif

                                <input type="hidden" name="status_photo" id="status_photo"
                                    value="{{ $item->photo ? 1 : 0 }}">

                                <button type="button" id="statusPhotoBtn_photo" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>

                        </div>



                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" id="description1" rows="4"
                                class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $item->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="description2" rows="4"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Author Name</label>
                            <input type="text" name="author_name"
                                class="form-control @error('author_name') is-invalid @enderror"
                                value="{{ old('author_name', $item->author_name) }}">
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="author_photo" class="form-label">Author Photo </label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('author_photo') is-invalid @enderror"
                                        name="author_photo" id="author_photo" data-preview-id="photo_preview_author_photo"
                                        accept="image/*,video/*">
                                    @error('author_photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="photo_preview_author_photo" src="{{ asset($item->author_photo) }}" alt="No Image"
                                    style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                <input type="hidden" name="status_author_photo" id="status_author_photo"
                                    value="{{ $item->author_photo ? 1 : 0 }}">
                                <button type="button" id="statusPhotoBtn_author_photo" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Author Description</label>
                            <textarea name="author_description" id="description3" rows="4"
                                class="form-control @error('author_description') is-invalid @enderror">{{ old('author_description', $item->author_description) }}</textarea>
                            @error('author_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active </label>
                            <select name="is_active" id="is_active"
                                class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active', $item->is_active) == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('is_active', $item->is_active) == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Update --}}
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">
                                Update
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
