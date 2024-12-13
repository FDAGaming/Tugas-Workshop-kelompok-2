@extends('dashboard.layout.main', ['title' => 'User Management'])

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">User</h3>
                    <h6 class="op-7 mb-2">User Management</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-round me-2">
                        <i class="fa fa-plus"></i> Add New User
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" style="margin-top: 40px;">
                            <h2>Daftar User</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
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
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/media/avatars/blank.png') }}"
                                                        alt="User Photo" width="50" class="rounded-circle">
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role->nama_role ?? 'N/A' }}</td>
                                                <td class="text-end"
                                                    style="display: flex; justify-content: flex-end; gap: 10px;">
                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="btn btn-primary btn-round" title="Edit">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                        class="d-inline" title="Delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-round">Delete</button>
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
            </div>
        </div>
    </div>
@endsection
