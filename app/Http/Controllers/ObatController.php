<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::with('kategori', 'user')->get();
        return view('dashboard.obat.index', compact('obats'));
    }

    public function create()
    {
        $kategoris = Kategori::all(); 
        return view('dashboard.obat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'jumlah_stock' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $fotoPath = $request->file('foto') ? $request->file('foto')->store('obat_photos', 'public') : null;

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'tanggal_terima' => $request->tanggal_terima,
            'jumlah_stock' => $request->jumlah_stock,
            'foto' => $fotoPath,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat created successfully.');
    }

    public function edit(Obat $obat)
    {
        $kategoris = Kategori::all();
        return view('dashboard.obat.edit', compact('obat', 'kategoris'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'jumlah_stock' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        if ($request->hasFile('foto')) {
            if ($obat->foto) {
                Storage::disk('public')->delete($obat->foto);
            }
            $obat->foto = $request->file('foto')->store('obat_photos', 'public');
        }

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'tanggal_terima' => $request->tanggal_terima,
            'jumlah_stock' => $request->jumlah_stock,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat updated successfully.');
    }

    public function destroy(Obat $obat)
    {
        if ($obat->foto) {
            Storage::disk('public')->delete($obat->foto); 
        }
        
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat deleted successfully.');
    }
}
