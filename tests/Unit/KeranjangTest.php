<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Keranjang;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class KeranjangTest extends TestCase
{
    use RefreshDatabase; // Reset database setelah setiap tes

    #[Test]
    public function it_can_add_an_item_to_keranjang()
    {
        $user = User::factory()->create();
        $obat = Obat::factory()->create();

        $keranjang = Keranjang::create([
            'user_id' => $user->id,
            'obat_id' => $obat->id,
            'kuantitas' => 2,
        ]);

        $this->assertDatabaseHas('keranjangs', [
            'user_id' => $user->id,
            'obat_id' => $obat->id,
            'kuantitas' => 2,
        ]);
    }

}
