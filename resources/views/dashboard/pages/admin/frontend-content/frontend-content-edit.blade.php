@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Edit Frontend Content')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Frontend Content</h4>
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
                    <form action="{{ route('admin.frontend-content.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-6">
                                {{-- Query Form --}}
                                <div class="mb-3">
                                    <label class="form-label">Enable Query Form</label>
                                    <select name="query_form" class="form-select @error('query_form') is-invalid @enderror">
                                        <option value="1"
                                            {{ old('query_form', $item->query_form) == 1 ? 'selected' : '' }}>
                                            Enable
                                        </option>
                                        <option value="0"
                                            {{ old('query_form', $item->query_form) == 0 ? 'selected' : '' }}>
                                            Disable
                                        </option>
                                    </select>
                                    @error('query_form')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                {{-- Query Form --}}
                                <div class="mb-3">
                                    <label class="form-label">Enable Query Form</label>
                                    <select name="chat_bot" class="form-select @error('chat_bot') is-invalid @enderror">
                                        <option value="1"
                                            {{ old('chat_bot', $item->chat_bot) == 1 ? 'selected' : '' }}>
                                            Enable
                                        </option>
                                        <option value="0"
                                            {{ old('chat_bot', $item->chat_bot) == 0 ? 'selected' : '' }}>
                                            Disable
                                        </option>
                                    </select>
                                    @error('chat_bot')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Experience</label>
                                    <input type="text" name="experience"
                                        class="form-control @error('experience') is-invalid @enderror"
                                        value="{{ old('experience', $item->experience ?? '') }}">
                                    @error('experience')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Active Members</label>
                                    <input type="text" name="active_members"
                                        class="form-control @error('active_members') is-invalid @enderror"
                                        value="{{ old('active_members', $item->active_members ?? '') }}">
                                    @error('active_members')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Successfull Marriages</label>
                                    <input type="text" name="successfull_marriage"
                                        class="form-control @error('successfull_marriage') is-invalid @enderror"
                                        value="{{ old('successfull_marriage', $item->successfull_marriage ?? '') }}">
                                    @error('successfull_marriage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
