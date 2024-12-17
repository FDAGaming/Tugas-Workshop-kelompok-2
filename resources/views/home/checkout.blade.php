@extends('home.layout.main')

@section('konten')
<div class="container mt-5">
    <h2>Checkout</h2>
    <table class="table table-bordered mt-4">
      <thead>
          <tr>
              <th>Foto</th>
              <th>Obat</th>
              <th>Harga</th>
              <th>Kuantitas</th>
              <th>Total</th>

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
                      {{number_format($item->kuantitas)}}

                  </td>
                  <td>Rp {{ number_format($item->obat->harga * $item->kuantitas, 0, ',', '.') }}</td>

              </tr>
          @endforeach
      </tbody>
  </table>

    <!-- Tombol Bayar Sekarang -->
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
</div>
@endsection
