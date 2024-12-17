<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Obat;
use App\Models\checkout;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjangItems = Keranjang::with('obat')->where('user_id', auth()->id())->get();
        return view('home.keranjang', compact('keranjangItems'));
    }

    public function store(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('obat_id', $id)
            ->first();

        if ($keranjang) {
            $keranjang->kuantitas += $request->input('kuantitas', 1);
            $keranjang->save();
        } else {
            Keranjang::create([
                'user_id' => auth()->id(),
                'obat_id' => $id,
                'kuantitas' => $request->input('kuantitas', 1),
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Obat berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $keranjang->kuantitas = $request->input('kuantitas');
        $keranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $keranjangs = Keranjang::with('nft')->where('user_id', Auth::id())->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong.');
        }

        $totalHarga = $keranjangs->sum(function ($keranjang) {
            return $keranjang->nft->harga_akhir ?? 0;
        });

        $checkout = Checkout::updateOrCreate(
            ['user_id' => Auth::id(), 'status' => 'pending'],
            ['total_harga' => $totalHarga, 'status' => 'pending']
        );

        return redirect()->route('checkout.index');
    }
}
