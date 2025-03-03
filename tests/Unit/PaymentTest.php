<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Keranjang;
use App\Models\Obat;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Test;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Route::shouldReceive('get')->andReturnSelf();
        Route::shouldReceive('post')->andReturnSelf();
    }

    #[Test]
    public function it_fails_checkout_when_cart_is_empty()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/keranjang/checkout'); // Gunakan URL langsung jika route helper error

        $response->assertRedirect('/keranjang')
                 ->assertSessionHas('error', 'Keranjang Anda kosong.');
    }

    #[Test]
    public function it_can_calculate_total_price_correctly()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $kategori = Kategori::factory()->create();
        $obat1 = Obat::factory()->create(['harga' => 10000, 'kategori_id' => $kategori->id]);
        $obat2 = Obat::factory()->create(['harga' => 5000, 'kategori_id' => $kategori->id]);

        Keranjang::create(['user_id' => $user->id, 'obat_id' => $obat1->id, 'kuantitas' => 2]);
        Keranjang::create(['user_id' => $user->id, 'obat_id' => $obat2->id, 'kuantitas' => 3]);

        $response = $this->get('/keranjang/checkout');

        $totalHarga = (2 * 10000) + (3 * 5000);
        $this->assertDatabaseHas('transaksis', ['user_id' => $user->id, 'total_harga' => $totalHarga]);
    }

    #[Test]
public function it_generates_snap_token_successfully()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $kategori = Kategori::factory()->create();
    $obat = Obat::factory()->create(['harga' => 10000, 'kategori_id' => $kategori->id]);

    Keranjang::create(['user_id' => $user->id, 'obat_id' => $obat->id, 'kuantitas' => 1]);

    // Simulasi Snap Token Midtrans tanpa menggunakan shouldReceive()
    $midtransMock = $this->getMockBuilder(\Midtrans\Snap::class)
                         ->disableOriginalConstructor()
                         ->onlyMethods(['getSnapToken'])
                         ->getMock();

    $midtransMock->method('getSnapToken')->willReturn('dummy-snap-token');

    // Gunakan Mock Midtrans
    $this->app->instance(\Midtrans\Snap::class, $midtransMock);

    $response = $this->get('/keranjang/checkout');

    $this->assertDatabaseHas('transaksis', ['user_id' => $user->id, 'snap_token' => 'dummy-snap-token']);
}


    #[Test]
    public function it_updates_payment_status_when_midtrans_callback_received()
    {
        $transaksi = Transaksi::factory()->create(['status' => 'pending']);

        $request = new Request([
            'transaction_status' => 'settlement',
            'order_id' => 'ORDER-' . $transaksi->id,
        ]);

        $this->post('/checkout/notification', $request->toArray());

        $this->assertDatabaseHas('transaksis', ['id' => $transaksi->id, 'status' => 'success']);
    }
}
