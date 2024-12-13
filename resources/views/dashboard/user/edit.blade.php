@extends('dashboard.layout.main')

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Edit User</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-round">Back to Users</a>
                </div>
            </div>

            <!-- Edit User Form -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                        required>
                                    @error('name')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                        required>
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password (optional)</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                    @error('password_confirmation')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Role</label>
                                    <select name="role_id" class="form-control" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->nama_role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Photo</label>
                                    <input type="file" name="foto" class="form-control" accept=".png, .jpg, .jpeg">
                                    @if ($user->foto)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $user->foto) }}" alt="User Photo"
                                                width="100">
                                        </div>
                                    @endif
                                    <div class="form-text">
                                        Allowed file types: png, jpg, jpeg.
                                    </div>
                                    @error('foto')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
