<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class MenuTest extends TestCase
{
    use RefreshDatabase; // Reset database setelah setiap tes

    #[Test]
    public function it_can_create_a_menu()
    {
        $menu = Menu::factory()->create([
            'nama_menu' => 'Dashboard',
            'link_menu' => '/dashboard',
            'icon_menu' => 'dashboard-icon',
        ]);

        $this->assertDatabaseHas('menus', ['nama_menu' => 'Dashboard']);
    }

    #[Test]
    public function it_can_read_a_menu()
    {
        $menu = Menu::factory()->create();

        $foundMenu = Menu::find($menu->id);

        $this->assertNotNull($foundMenu);
        $this->assertEquals($menu->id, $foundMenu->id);
    }

    #[Test]
    public function it_can_update_a_menu()
    {
        $menu = Menu::factory()->create();

        $menu->update([
            'nama_menu' => 'Updated Menu',
            'icon_menu' => 'updated-icon',
        ]);

        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'nama_menu' => 'Updated Menu',
            'icon_menu' => 'updated-icon',
        ]);
    }

    #[Test]
    public function it_can_delete_a_menu()
    {
        $menu = Menu::factory()->create();

        $menu->delete();

        $this->assertDatabaseMissing('menus', ['id' => $menu->id]);
    }
}
