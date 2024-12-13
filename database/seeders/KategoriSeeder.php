<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        Kategori::create(['nama_kategori' => 'Kapsul']);
        Kategori::create(['nama_kategori' => 'Cair']);
        Kategori::create(['nama_kategori' => 'Oles']);
    }
}