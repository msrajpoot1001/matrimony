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

                    <form action="{{ route('admin.payment-gateway.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="gateway_name" class="form-label">Gateway Name </label>
                            <input type="text" name="gateway_name" id="gateway_name"
                                class="form-control @error('gateway_name') is-invalid @enderror"
                                value="{{ old('gateway_name', $item->gateway_name ?? '') }}">
                            @error('gateway_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="key" class="form-label">Key </label>
                            <input type="text" name="key" id="key"
                                class="form-control @error('key') is-invalid @enderror"
                                value="{{ old('key', $item->key ?? '') }}">
                            @error('key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="secreat" class="form-label">Secreat </label>
                            <input type="text" name="secreat" id="secreat"
                                class="form-control @error('secreat') is-invalid @enderror"
                                value="{{ old('secreat', $item->secreat ?? '') }}">
                            @error('secreat')
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
