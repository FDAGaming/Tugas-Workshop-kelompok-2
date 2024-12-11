<?php

namespace Database\Seeders;

use App\Models\SettingSubmenu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run()
{
    $this->call([
    RoleSeeder::class,
    UserSeeder::class,
    MenuSeeder::class,
    SettingMenuSeeder::class,
    ]);
}

}