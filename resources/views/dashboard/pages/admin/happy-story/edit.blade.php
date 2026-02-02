@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit Item')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Item</h4>
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

                    <form action="{{ route('admin.happy-story.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo </label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('photo') is-invalid @enderror"
                                        name="photo" id="photo" data-preview-id="photo_preview_photo"
                                        accept="image/*">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="photo_preview_photo" src="{{ asset($item->photo) }}" alt="No Image"
                                    style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                <input type="hidden" name="status_photo" id="status_photo"
                                    value="{{ $item->photo ? 1 : 0 }}">
                                <button type="button" id="statusPhotoBtn_photo" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                            <input type="text" name="reason" id="reason"
                                class="form-control @error('reason') is-invalid @enderror"
                                value="{{ old('reason', $item->reason ?? '') }}">
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading </label>
                            <input type="text" name="heading" id="heading"
                                class="form-control @error('heading') is-invalid @enderror"
                                value="{{ old('heading', $item->heading ?? '') }}">
                            @error('heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sub_heading" class="form-label">Sub Heading </label>
                            <input type="text" name="sub_heading" id="sub_heading"
                                class="form-control @error('sub_heading') is-invalid @enderror"
                                value="{{ old('sub_heading', $item->sub_heading ?? '') }}">
                            @error('sub_heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date ( mm/dd/yyyy)</label>
                            <input type="date" name="date" id="date"
                                class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date', $item->date ?? '') }}">
                            @error('date')
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

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
