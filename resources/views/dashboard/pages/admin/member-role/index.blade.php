@extends('dashboard.layouts.app')

@section('title', 'Dashboard | Member Roles')

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
                    <h4 class="card-title">All Member Roles</h4>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.member-role.create') }}" class="btn btn-sm btn-primary view-btn">
                            Create Member Role
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Role Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($member_roles as $items)
                                    <tr>
                                        <td class="v-center">{{ $loop->iteration }}</td>



                                        <td class="v-center">
                                            {{ $items->name ?? 'N/A' }}
                                        </td>


                                        <td class="v-center">
                                            <span>
                                                {{ ucfirst($items->is_active == 1 ? 'active' : 'inactive') }}
                                            </span>
                                        </td>

                                        <td class="v-center">
                                            <a href="{{route('admin.member-role.edit',$items->id)}}" class="btn btn-sm btn-primary px-4 m-1">
                                                Edit
                                            </a>
                                            
                                            <form action="{{ route('admin.member-role.destroy', $items->id) }}"
                                                method="POST" style="display:inline-block;"
                                                onsubmit="return confirm('Are you sure you want to delete this role?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger px-4 m-1">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted">
                                            No orders available.
                                        </td>
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
