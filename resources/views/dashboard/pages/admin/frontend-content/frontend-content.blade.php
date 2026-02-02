@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Frontend Content')

@section('style')
    <style>
        .card-title {
            display: flex;
            flex-direction: row;
            justify-content: space-between
        }

        .card-title a {
            border: 1px solid red;
        }
    </style>
@endsection

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
    {{-- <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">
            Create Frontend Content
        </button>
    </div> --}}

    {{-- Create Form --}}
    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"><span>Customize Frontend Content</span> {{-- Edit --}}

                    </h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('admin.frontend-content.store') }}" method="POST">
                        @csrf

                        {{-- Query Form --}}
                        <div class="mb-3">
                            <label class="form-label">Enable Query Form</label>
                            <select name="query_form" class="form-select @error('query_form') is-invalid @enderror">
                                <option value="1" {{ old('query_form') == '1' ? 'selected' : '' }}>Enable</option>
                                <option value="0" {{ old('query_form') == '0' ? 'selected' : '' }}>Disable</option>
                            </select>
                            @error('query_form')
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
                    <h4 class="card-title">Frontend Content Settings <a
                            href="{{ route('admin.frontend-content.edit', $item->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a></h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Action Name</th>
                                    <th>Status/Content</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>Query From Open</td>
                                    <td>{{ $item->query_form == 1 ? 'Enable' : 'Disable' }}</td>
                                </tr>
                                <tr>
                                    <td>Chat Bot</td>
                                    <td>{{ $item->chat_bot == 1 ? 'Enable' : 'Disable' }}</td>
                                </tr>
                                <tr>
                                    <td>Experience</td>
                                    <td>{{ $item->experience }}</td>
                                </tr>
                                <tr>
                                    <td>Active Members</td>
                                    <td>{{ $item->active_members }}</td>
                                </tr>
                                <tr>
                                    <td>Successfull Marriages</td>
                                    <td>{{ $item->successfull_marriage }}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{-- {{ $items->links() }} --}}
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
