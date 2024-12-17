<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Obat;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class KeranjangController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // Menampilkan halaman keranjang
    public function index()
    {
        $keranjangItems = Keranjang::with('obat')->where('user_id', Auth::id())->get();
        return view('home.keranjang', compact('keranjangItems'));
    }

    // Menambahkan item ke keranjang
    public function store(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('obat_id', $id)
            ->first();

        if ($keranjang) {
            $keranjang->kuantitas += $request->input('kuantitas', 1);
            $keranjang->save();
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'obat_id' => $id,
                'kuantitas' => $request->input('kuantitas', 1),
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Obat berhasil ditambahkan ke keranjang.');
    }

    // Memperbarui kuantitas item di keranjang
    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $keranjang->kuantitas = $request->input('kuantitas');
        $keranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    // Menghapus item dari keranjang
    public function destroy($id)
    {
        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    // Proses Checkout dan Snap Token Midtrans
    public function checkout()
{
    $keranjangItems = Keranjang::with('obat')->where('user_id', Auth::id())->get();

    if ($keranjangItems->isEmpty()) {
        return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong.');
    }

    // Hitung total harga keranjang
    $totalHarga = $keranjangItems->sum(function ($item) {
        return $item->obat->harga * $item->kuantitas;
    });

    // Data untuk Midtrans
    $params = [
        'transaction_details' => [
            'order_id' => uniqid('ORDER-'),
            'gross_amount' => (int) $totalHarga,
        ],
        'customer_details' => [
            'name' => Auth::user()->name ?? 'Pelanggan',
            'email' => Auth::user()->email ?? 'default@example.com',
        ],
        // 'item_details' => $keranjangItems->map(function ($item) {
        //     return [
        //         'id' => $item->obat->id,
        //         'price' => (int) $item->obat->harga,
        //         'quantity' => (int) $item->kuantitas,
        //         'name' => substr($item->obat->nama_obat, 0, 50),
        //     ];
        // })->toArray(),
    ];
    $snapToken = Snap::getSnapToken($params);
    try {
        // Debug parameter untuk Midtrans
        dd($params);

        // Generate Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        dd($snapToken); // Lihat token di sini

        // Kirim Snap Token ke view
        return view('home.checkout', compact('snapToken', 'keranjangItems'));
    } catch (\Exception $e) {
        dd('Error: ' . $e->getMessage());
    }
}

}
