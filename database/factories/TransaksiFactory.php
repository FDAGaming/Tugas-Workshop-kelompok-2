<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Buat user otomatis
            'total_harga' => $this->faker->numberBetween(10000, 500000),
            'status' => 'pending', // Default status awal
            'snap_token' => $this->faker->uuid, // Simulasi token Midtrans
        ];
    }
}
