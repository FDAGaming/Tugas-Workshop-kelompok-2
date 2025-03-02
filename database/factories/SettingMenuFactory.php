<?php

namespace Database\Factories;

use App\Models\SettingMenu;
use App\Models\Role;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingMenuFactory extends Factory
{
    protected $model = SettingMenu::class;

    public function definition(): array
    {
        return [
            'role_id' => Role::factory(), // Buat role otomatis
            'menu_id' => Menu::factory(), // Buat menu otomatis
        ];
    }
}
