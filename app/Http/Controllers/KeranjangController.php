<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Obat;

class KeranjangController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $keranjangItems = Keranjang::with('obat')->where('user_id', auth()->id())->get();
        return view('home.keranjang', compact('keranjangItems'));
    }

    // Menambahkan item ke keranjang
    public function store(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        // Periksa apakah obat sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('obat_id', $id)
            ->first();

        if ($keranjang) {
            // Jika sudah ada, tambahkan kuantitasnya
            $keranjang->kuantitas += $request->input('kuantitas', 1);
            $keranjang->save();
        } else {
            // Jika belum ada, tambahkan ke keranjang
            Keranjang::create([
                'user_id' => auth()->id(),
                'obat_id' => $id,
                'kuantitas' => $request->input('kuantitas', 1),
            ]);
        }

        return redirect()->route('keranjang.index')->with('success', 'Obat berhasil ditambahkan ke keranjang.');
    }

    // Mengupdate kuantitas item di keranjang
    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $keranjang->kuantitas = $request->input('kuantitas');
        $keranjang->save();

        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    // Menghapus item dari keranjang
    public function destroy($id)
    {
        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $keranjang->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
