<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['nama_role' => 'Admin']);
        Role::create(['nama_role' => 'Staff']);
        Role::create(['nama_role' => 'User']);
    }
}