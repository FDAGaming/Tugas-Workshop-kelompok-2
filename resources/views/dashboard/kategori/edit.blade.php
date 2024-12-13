@extends('dashboard.layout.main')

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Edit Kategori</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('kategori.index') }}" class="btn btn-primary btn-round">Back to Kategori List</a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('kategori.update', $kategori) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control"
                                        value="{{ $kategori->nama_kategori }}" required>
                                    @error('nama_kategori')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
