<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Obat;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ObatTest extends TestCase
{
    use RefreshDatabase; // Reset database setelah setiap tes

    #[Test]
    public function it_can_create_an_obat()
    {
        $kategori = Kategori::factory()->create();
        $user = User::factory()->create();

        $obat = Obat::factory()->create([
            'nama_obat' => 'Paracetamol',
            'tanggal_terima' => '2025-03-01',
            'jumlah_stock' => 100,
            'foto' => 'obat.jpg',
            'harga' => 5000,
            'kategori_id' => $kategori->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('obats', ['nama_obat' => 'Paracetamol']);
    }

    #[Test]
    public function it_can_read_an_obat()
    {
        $obat = Obat::factory()->create();
        $foundObat = Obat::find($obat->id);

        $this->assertNotNull($foundObat);
        $this->assertEquals($obat->id, $foundObat->id);
    }

    #[Test]
    public function it_can_update_an_obat()
    {
        $obat = Obat::factory()->create();

        $obat->update([
            'harga' => 7500, // Ubah harga obat
            'jumlah_stock' => 50, // Ubah jumlah stok
        ]);

        $this->assertDatabaseHas('obats', [
            'id' => $obat->id,
            'harga' => 7500,
            'jumlah_stock' => 50,
        ]);
    }

    #[Test]
    public function it_can_delete_an_obat()
    {
        $obat = Obat::factory()->create();

        $obat->delete();

        $this->assertDatabaseMissing('obats', ['id' => $obat->id]);
    }
}
