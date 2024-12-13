@extends('dashboard.layout.main', ['title' => 'Menu List'])

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Menu</h3>
                    <h6 class="op-7 mb-2">Menu List</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('menu.create') }}" class="btn btn-primary btn-round me-2">Tambah Menu</a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" style="margin-top: 40px;">
                            <h2>Daftar Menu</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Nama URL</th>
                                            <th style="width: 1%; white-space: nowrap; text-align: right;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $menu->nama_menu }}</td>
                                                <td>{{ $menu->link_menu }}</td>
                                                <td class="text-end"
                                                    style="display: flex; justify-content: flex-end; gap: 10px;">
                                                    <a href="{{ route('menu.edit', $menu->id) }}"
                                                        class="btn btn-primary btn-round" title="Edit">
                                                        Edit
                                                    </a>
                                                    </a>

                                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST"
                                                        class="d-inline" title="Delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-round">
                                                            Hapus
                                                        </button>
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
