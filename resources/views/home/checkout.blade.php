@extends('home.layout.main')

@section('konten')
<div class="container mt-5">
    <h2>Checkout</h2>
    <p>Silakan klik tombol di bawah untuk menyelesaikan pembayaran.</p>

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
