<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
{
    $kategoris = Kategori::all();
    $obats = Obat::all();

    return view('home.index', compact('kategoris', 'obats'));
}

}