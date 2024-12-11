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
        ]);
    }
}