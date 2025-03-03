<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['id' => 1], ['nama_role' => 'Admin']);
        Role::firstOrCreate(['id' => 2], ['nama_role' => 'Staff']);
        Role::firstOrCreate(['id' => 3], ['nama_role' => 'User']);
    }
}