@extends('dashboard.layout.main', ['title' => 'Edit Menu'])

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Edit Menu</h6>
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
                            <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nama_menu" class="form-label">Nama Menu</label>
                                    <input type="text" autocomplete="off" class="form-control" id="nama_menu"
                                        name="nama_menu" value="{{ $menu->nama_menu }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="link_menu" class="form-label">Nama URL</label>
                                    <input type="text" autocomplete="off" class="form-control" id="link_menu"
                                        name="link_menu" value="{{ $menu->link_menu }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="icon_menu" class="form-label">Icon</label>
                                    <input type="text" autocomplete="off" class="form-control" id="icon_menu"
                                        name="icon_menu" value="{{ $menu->icon_menu }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
