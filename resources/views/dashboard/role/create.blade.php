@extends('dashboard.layout.main', ['title' => 'Create New Role'])

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Create New Role</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('role.index') }}" class="btn btn-secondary">Back to Role List</a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('role.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Role Name</label>
                                    <input type="text" name="nama_role" class="form-control" required>
                                    @error('nama_role')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{ route('role.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
