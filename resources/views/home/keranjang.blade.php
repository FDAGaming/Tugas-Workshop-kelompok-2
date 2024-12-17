@extends('home.layout.main')

@section('konten')
    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <h2>Keranjang Belanja</h2>

                <!-- Pesan Notifikasi -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($keranjangItems->isEmpty())
                    <p class="text-center mt-3">Keranjang Anda kosong.</p>
                @else
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Obat</th>
                                <th>Harga</th>
                                <th>Kuantitas</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keranjangItems as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $item->obat->foto) }}" alt="{{ $item->obat->nama_obat }}" class="img-fluid"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td>{{ $item->obat->nama_obat }}</td>
                                    <td>Rp {{ number_format($item->obat->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ url('/keranjang/' . $item->id . '/update') }}" method="POST">
                                            @csrf
                                            <input type="number" name="kuantitas" value="{{ $item->kuantitas }}" min="1" class="form-control" style="width: 80px;">
                                            <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                                        </form>
                                    </td>
                                    <td>Rp {{ number_format($item->obat->harga * $item->kuantitas, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ url('/keranjang/' . $item->id . '/delete') }}" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Tombol Checkout -->
                    <div class="text-end mt-4">
                        <form action="{{ route('checkout.proses') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Proses Checkout</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
