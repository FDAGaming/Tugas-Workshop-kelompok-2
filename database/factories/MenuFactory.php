<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        return [
            'nama_menu' => $this->faker->word(),
            'link_menu' => $this->faker->url(),
            'icon_menu' => $this->faker->optional()->word(),
        ];
    }
}
