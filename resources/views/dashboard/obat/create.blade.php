@extends('dashboard.layout.main')

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Create New Obat</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('obat.index') }}" class="btn btn-primary btn-round">Back to Obat List</a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_obat" class="form-label">Nama Obat</label>
                                    <input type="text" name="nama_obat" class="form-control" required>
                                    @error('nama_obat')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_terima" class="form-label">Tanggal Terima</label>
                                    <input type="date" name="tanggal_terima" class="form-control" required>
                                    @error('tanggal_terima')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_stock" class="form-label">Jumlah Stock</label>
                                    <input type="number" name="jumlah_stock" class="form-control" required>
                                    @error('jumlah_stock')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" name="harga" class="form-control" step="0.01" required>
                                    @error('harga')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select name="kategori_id" class="form-control" required>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control" accept=".png, .jpg, .jpeg">
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    @error('foto')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{ route('obat.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
