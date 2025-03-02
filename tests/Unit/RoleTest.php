<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Menu;
use App\Models\SettingMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class RoleTest extends TestCase
{
    use RefreshDatabase; // Reset database setelah setiap tes

    #[Test]
    public function it_can_create_a_role()
    {
        $role = Role::factory()->create([
            'nama_role' => 'Admin',
        ]);

        $this->assertDatabaseHas('roles', ['nama_role' => 'Admin']);
    }

    #[Test]
    public function it_can_read_a_role()
    {
        $role = Role::factory()->create();

        $foundRole = Role::find($role->id);

        $this->assertNotNull($foundRole);
        $this->assertEquals($role->id, $foundRole->id);
    }

    #[Test]
    public function it_can_update_a_role()
    {
        $role = Role::factory()->create();

        $role->update([
            'nama_role' => 'Updated Role',
        ]);

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'nama_role' => 'Updated Role',
        ]);
    }

    #[Test]
    public function it_can_delete_a_role_and_related_data()
    {
        $role = Role::factory()->create();

        // Buat user dengan role ini
        $user = User::factory()->create(['role_id' => $role->id]);

        // Buat menu dan setting menu yang terkait dengan role ini
        $menu = Menu::factory()->create();
        $settingMenu = SettingMenu::factory()->create([
            'role_id' => $role->id,
            'menu_id' => $menu->id,
        ]);

        // Hapus role
        $role->delete();

        // Pastikan role dan data terkait ikut terhapus
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
        $this->assertDatabaseMissing('users', ['role_id' => $role->id]);
        $this->assertDatabaseMissing('setting_menus', ['role_id' => $role->id]);
    }
}
