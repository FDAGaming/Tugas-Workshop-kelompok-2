@extends('dashboard.layout.main')

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Obat Management</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('obat.create') }}" class="btn btn-light btn-outline-primary">Add New Obat</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Obat</th>
                                <th>Tanggal Terima</th>
                                <th>Jumlah Stock</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obats as $obat)
                                <tr>
                                    <td>
                                        <img src="{{ $obat->foto ? asset('storage/' . $obat->foto) : asset('assets/media/avatars/blank.png') }}"
                                            alt="Obat Photo" width="50" class="rounded-circle">
                                    </td>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($obat->tanggal_terima)->format('d M Y') }}</td>
                                    <td>{{ $obat->jumlah_stock }}</td>
                                    <td>{{ number_format($obat->harga, 2, ',', '.') }}</td>
                                    <td>{{ $obat->kategori->nama_kategori ?? 'N/A' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('obat.edit', $obat->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('obat.destroy', $obat->id) }}" method="POST"
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
