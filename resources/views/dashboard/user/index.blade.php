@extends('dashboard.layout.main')

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">User Management</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('user.create') }}" class="btn btn-light btn-outline-primary">Add New User</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/media/avatars/blank.png') }}"
                                            alt="User Photo" width="50" class="rounded-circle">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->nama_role ?? 'N/A' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
