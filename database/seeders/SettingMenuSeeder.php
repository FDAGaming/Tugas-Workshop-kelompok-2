<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_menus')->truncate();

        $menuAssignments = [
            1 => [1, 2, 3, 4, 5, 6],
        ];

        foreach ($menuAssignments as $role_id => $menu_ids) {
            foreach ($menu_ids as $menu_id) {
                DB::table('setting_menus')->insert([
                    'role_id' => $role_id,
                    'menu_id' => $menu_id,
                ]);
            }
        }
    }
}
