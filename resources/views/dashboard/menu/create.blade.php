@extends('dashboard.layout.main')

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Create Menu</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                    <a href="#" class="btn btn-primary btn-round">Add Customer</a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('menu.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_menu" class="form-label">Nama Menu</label>
                                    <input type="text" class="form-control" id="nama_menu" autocomplete="off"
                                        name="nama_menu" required value="{{ old('nama_menu') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="link_menu" class="form-label">Nama URL</label>
                                    <input type="text" class="form-control" id="link_menu" autocomplete="off"
                                        name="link_menu" required value="{{ old('link_menu') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="icon_menu" class="form-label">Icon</label>
                                    <input type="text" class="form-control" id="icon_menu" name="icon_menu"
                                        value="{{ old('icon_menu') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
