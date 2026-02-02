@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit Hero Content')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Hero Content</h4>
                </div>

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

                <div class="card-body">

                    <form action="{{ route('admin.hero-contents.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Hero Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $item->title ?? '') }}">
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

                            @if ($item->bg_image)
                                <div class="mt-2">
                                    <img src="{{ asset($item->bg_image) }}" width="180" class="rounded border">
                                </div>
                            @endif
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ old('status', $item->status) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">
                                Update
                            </button>
                            <a href="{{ route('admin.hero-contents.index') }}" class="btn btn-secondary w-md ms-2">
                                Back
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
