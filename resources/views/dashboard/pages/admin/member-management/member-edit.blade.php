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

                    <form action="{{ route('admin.members.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" style="background-color: rgb(234, 232, 232)"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name ?? '') }}" readonly>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">email <span class="text-danger">*</span></label>
                            <input type="text" name="email" id="email" style="background-color: rgb(234, 232, 232)"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email ?? '') }}" readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror"
                                required>
                                @foreach ($user_roles as $item)
                                    <option value="{{ $item->id }}"
                                        {{ isset($user) && $user->role == $item->id ? 'selected' : '' }}>
                                        {{ ucfirst($item->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
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
