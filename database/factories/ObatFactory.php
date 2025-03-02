<?php

namespace Database\Factories;

use App\Models\Obat;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObatFactory extends Factory
{
    protected $model = Obat::class;

    public function definition(): array
    {
        return [
            'nama_obat' => $this->faker->word(),
            'tanggal_terima' => $this->faker->date(),
            'jumlah_stock' => $this->faker->numberBetween(1, 200),
            'foto' => 'default.jpg',
            'harga' => $this->faker->numberBetween(1000, 50000),
            'kategori_id' => Kategori::factory()->create()->id, // Buat kategori otomatis
            'user_id' => User::factory()->create()->id, // Buat user otomatis
        ];
    }
}
