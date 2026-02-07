@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('Users'))

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


    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All {{ ucfirst('Users') }}</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.astrology.create') }}" class="btn btn-sm btn-primary view-btn">
                            Create Member
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Name/User Name</th>
                                    <th>Email</th>
                                    <th>Role</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $item)
                                    <tr>
                                        <td class="v-center">{{ $loop->iteration }}</td>
                                        <td class="v-center">{{ $item->name ?? 'N/A' }}</td>
                                        <td class="v-center">{{ $item->email ?? 'N/A' }}</td>
                                        <td class="v-center">{{ $item->userRole->name ?? 'N/A' }}</td>


                                        <td class="v-center">
                                            <a href="{{ route('admin.members.edit', $item->id) }}"
                                                class="btn btn-sm btn-success px-4 m-1">Edit</a>
                                            {{-- <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST"
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
