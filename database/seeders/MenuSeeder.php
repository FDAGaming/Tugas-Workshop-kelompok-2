<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->insert([
            [
                'id' => 1,
                'nama_menu' => 'Menu',
                'link_menu' => 'menu',
                'icon_menu' => 'bi bi-tablet'
            ],
            [
                'id' => 2,
                'nama_menu' => 'Setting Menu',
                'link_menu' => 'setting_menus',
                'icon_menu' => 'bi bi-gear'
            ],

            [
                'id' => 3,
                'nama_menu' => 'Role',
                'link_menu' => 'role',
                'icon_menu' => 'bi bi-gear'
            ],

            [
                'id' => 4,
                'nama_menu' => 'User',
                'link_menu' => 'user',
                'icon_menu' => 'bi bi-gear'
            ],

            [
                'id' => 5,
                'nama_menu' => 'Kategori',
                'link_menu' => 'kategori',
                'icon_menu' => 'bi bi-gear'
            ],

            [
                'id' => 6,
                'nama_menu' => 'Obat',
                'link_menu' => 'obat',
                'icon_menu' => 'bi bi-gear'
            ],
        ]);
    }
}
