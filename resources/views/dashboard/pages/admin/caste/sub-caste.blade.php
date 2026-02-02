@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('sub-caste'))

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

    <div class="mb-2 text-end">
        <button id="toggleButton" class="btn btn-sm btn-success">Create {{ ucfirst('Sub Caste') }}</button>
    </div>

    <div id="create-form-section">
        <div class="card">
            <div class="card-header">
                <h4>Add {{ ucfirst('Sub Caste') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sub-caste.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Caste <span class="text-danger">*</span></label>
                                <select name="ref_id" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($items1 as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('ref_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Is Active </label>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-header">
            <h4>All {{ ucfirst('Sub Caste') }}</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label>Caste <span class="text-danger">*</span></label>
                        <select name="ref_id" class="form-control" id="casteSelect" required>
                            <option value="">-- Select --</option>
                            @foreach ($items1 as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('ref_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('casteSelect').addEventListener('change', function() {
                    let id = this.value;
                    if (id) {
                        // Redirect with query parameter
                        window.location.href = "{{ route('admin.sub-caste.index') }}?ref_id=" + id;
                    }
                });
            </script>

        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Caste</th>
                        <th>Name</th>
                        <th>Is Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items2 as $item)
                        <tr>
                            <td class="v-center">{{ $loop->iteration }}</td>
                            <td class="v-center">{{ $item->caste->name ?? 'N/A' }}</td>
                            <td class="v-center">{{ $item->name ?? 'N/A' }}</td>
                            <td class="v-center">
                                @if ($item->is_active == 1)
                                    <span class="badge bg-success">Active</span>
                                @elseif($item->is_active == 0)
                                    <span class="badge bg-danger">Inactive</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td class="v-center">
                                <a href="{{ route('admin.sub-caste.edit', $item->id) }}"
                                    class="btn btn-sm btn-success">Edit</a>
                                <form action="{{ route('admin.sub-caste.destroy', $item->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center text-muted">No Data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $items2->links() }}
            </div>


        </div>
    </div>
@endsection
