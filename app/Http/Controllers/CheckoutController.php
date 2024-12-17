<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     */
    public function index()
{
    $keranjangItems = auth()->user()->keranjang()->with('obat')->get(); // Menggunakan relasi yang sudah didefinisikan

    // Periksa apakah keranjang kosong
    if ($keranjangItems->isEmpty()) {
        return redirect('/keranjang')->with('error', 'Keranjang belanja Anda kosong.');
    }

    // Kalkulasi total harga
    $totalHarga = $keranjangItems->sum(function ($item) {
        return $item->obat->harga * $item->kuantitas;
    });

    return view('checkout.index', compact('keranjangItems', 'totalHarga'));
}


    /**
     * Memproses checkout dan mengurangi stok barang.
     */
    public function prosesCheckout()
{
    DB::transaction(function () {
        $keranjangItems = auth()->user()->keranjang;

        foreach ($keranjangItems as $item) {
            $obat = $item->obat;

            // Periksa apakah stok cukup
            if ($obat->jumlah_stock < $item->kuantitas) {
                throw new \Exception('Stok obat ' . $obat->nama_obat . ' tidak mencukupi.');
            }

            // Kurangi stok
            $obat->jumlah_stock -= $item->kuantitas;
            $obat->save();

            // // Simpan transaksi (opsional)
            // DB::table('transaksi')->insert([
            //     'user_id' => auth()->id(),
            //     'obat_id' => $obat->id,
            //     'kuantitas' => $item->kuantitas,
            //     'total_harga' => $obat->harga * $item->kuantitas,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ]);
        }

        // Kosongkan keranjang
        DB::table('keranjangs')->where('user_id', auth()->id())->delete();
    });

    return redirect('/')->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');
}

}
