<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class UserTest extends TestCase
{
    use RefreshDatabase; // Reset database setelah setiap tes

    #[Test]
    public function it_can_create_a_user()
    {
        // Buat role dulu agar user bisa dibuat
        $role = Role::factory()->create(['nama_role' => 'Admin']);

        // Buat user dengan semua kolom yang diperlukan
        $user = User::factory()->create([
            'name' => 'Lala',
            'email' => 'lala@example.com',
            'password' => bcrypt('password123'),
            'foto' => 'default.jpg', // Pastikan kolom foto ada
            'role_id' => $role->id,
            'remember_token' => 'randomtoken123',
        ]);

        // Pastikan user tersimpan di database
        $this->assertDatabaseHas('users', ['email' => 'lala@example.com']);
    }

    #[Test]
    public function it_can_read_a_user()
    {
        $role = Role::factory()->create(['nama_role' => 'User']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $foundUser = User::find($user->id);

        $this->assertNotNull($foundUser);
        $this->assertEquals($user->id, $foundUser->id);
    }

    #[Test]
    public function it_can_update_a_user()
    {
        $role = Role::factory()->create(['nama_role' => 'Editor']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $user->update([
            'name' => 'Updated Name',
            'foto' => 'updated_photo.jpg', // Ubah foto juga
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'foto' => 'updated_photo.jpg'
        ]);
    }

    #[Test]
    public function it_can_delete_a_user()
    {
        $role = Role::factory()->create(['nama_role' => 'Guest']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $user->delete();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
