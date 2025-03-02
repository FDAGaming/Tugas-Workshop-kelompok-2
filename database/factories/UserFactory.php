<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Enkripsi password
            'foto' => 'default.jpg', // Default foto
            'role_id' => Role::factory(), // Buat role otomatis
            'remember_token' => Str::random(10),
        ];
    }
}
