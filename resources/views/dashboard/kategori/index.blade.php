@extends('dashboard.layout.main')

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Kategori Management</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('kategori.create') }}" class="btn btn-light btn-outline-primary">Add New Kategori</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
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
