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

            <!-- Keranjang Kosong -->
            @if ($keranjangItems->isEmpty())
                <p class="text-center mt-3">Keranjang Anda kosong.</p>
            @else
                <!-- Tabel Keranjang -->
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
                                    <img src="{{ asset('storage/' . $item->obat->foto) }}" 
                                        alt="{{ $item->obat->nama_obat }}" 
                                        class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
                                </td>
                                <td>{{ $item->obat->nama_obat }}</td>
                                <td>Rp {{ number_format($item->obat->harga, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ url('/keranjang/' . $item->id . '/update') }}" method="POST">
                                        @csrf
                                        <input type="number" name="kuantitas" value="{{ $item->kuantitas }}" min="1" 
                                               class="form-control" style="width: 80px;">
                                        <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                                    </form>
                                </td>
                                <td>Rp {{ number_format($item->obat->harga * $item->kuantitas, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ url('/keranjang/' . $item->id . '/delete') }}" 
                                       class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tombol Bayar Sekarang -->
                @if (isset($snapToken))
                    <div class="text-center mt-4">
                        
                        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
                    </div>

                    <!-- Midtrans Snap JS -->
                    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
                            data-client-key="{{ config('services.midtrans.client_key') }}">
                    </script>
                    <script type="text/javascript">
                        document.getElementById('pay-button').onclick = function () {
                            snap.pay('{{ $snapToken }}', {
                                onSuccess: function(result) {
                                    alert("Pembayaran sukses!");
                                    console.log(result);
                                    window.location.href = "/";
                                },
                                onPending: function(result) {
                                    alert("Pembayaran tertunda.");
                                    console.log(result);
                                },
                                onError: function(result) {
                                    alert("Pembayaran gagal.");
                                    console.log(result);
                                }
                            });
                        };
                    </script>
                @else
                    <div class="alert alert-warning text-center mt-4">
                        Token pembayaran tidak tersedia. Silakan coba lagi.
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
