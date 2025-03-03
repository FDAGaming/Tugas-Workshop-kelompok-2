<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;

class AuthTest extends TestCase
{
    use RefreshDatabase; // Reset database setelah setiap tes

    protected function setUp(): void
    {
        parent::setUp();

        // Reset database dan jalankan seeder agar role tersedia sebelum test
        //$this->artisan('migrate:fresh');
        $this->seed(\Database\Seeders\RoleSeeder::class);
    }

    #[Test]
    public function it_can_register_a_user()
    {
        // Ambil role "User" dari database
        $role = Role::where('nama_role', 'User')->firstOrFail();

        // Kirim request ke endpoint /register
        $response = $this->post('/register', [
            'name' => 'Lala',
            'email' => 'lala@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role_id' => $role->id, // Gunakan role yang sudah ada
            'foto' => null,
        ]);

        // Pastikan user terdaftar di database
        $this->assertDatabaseHas('users', ['email' => 'lala@example.com']);

        // Pastikan user diarahkan ke halaman login setelah register
        $response->assertRedirect('/login');

        // Pastikan user belum login setelah register
        $this->assertGuest();
    }

    #[Test]
    public function it_can_login_a_user()
    {
        // Pastikan role 'User' ada dan ambil ID-nya
        $role = Role::where('nama_role', 'User')->first();
        
        if (!$role) {
            $role = Role::factory()->create(['nama_role' => 'User']);
        }

        // Buat user dengan role yang valid
        $user = User::factory()->create([
            'email' => 'lala@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $role->id, // Ambil dari database
            'foto' => 'profile.jpg',
        ]);

        // Kirim request ke endpoint /login
        $response = $this->post('/login', [
            'email' => 'lala@example.com',
            'password' => 'password123',
        ]);

        // Pastikan user diarahkan ke dashboard
        $response->assertRedirect('/dashboard');

        // Pastikan user terautentikasi
        $this->assertAuthenticatedAs($user);
    }



    #[Test]
    public function it_can_logout_a_user()
    {
        // Buat user dan login
        $user = User::factory()->create([
            'role_id' => 2,
        ]);
        $this->actingAs($user); // Login user

        // Kirim request ke endpoint /logout
        $response = $this->post(route('logout'));

        // Pastikan user diarahkan ke halaman utama setelah logout
        $response->assertRedirect('/');

        // Pastikan user sudah logout
        $this->assertGuest();
    }

    #[Test]
public function it_cannot_login_with_invalid_credentials()
{
    // Buat user dengan password yang benar
    $user = User::factory()->create([
        'email' => 'lala@example.com',
        'password' => Hash::make('password123'),
    ]);

    // Kirim request ke endpoint /login dengan password yang salah
    $response = $this->post('/login', [
        'email' => 'lala@example.com',
        'password' => 'wrongpassword', // Password salah
    ]);

    // Pastikan login gagal dan kembali ke halaman sebelumnya
    $response->assertStatus(302); // 302 = redirect back

    // Periksa apakah session memiliki error untuk email
    $response->assertSessionHasErrors(['email' => 'Kombinasi email dan password tidak cocok.']);

    // Pastikan user tetap guest (tidak login)
    $this->assertGuest();
}

#[Test]
public function it_cannot_login_with_non_existent_email()
{
    // Kirim request ke endpoint /login dengan email yang tidak terdaftar
    $response = $this->post('/login', [
        'email' => 'notfound@example.com', // Email tidak terdaftar
        'password' => 'password123',
    ]);

    // Pastikan login gagal dan kembali ke halaman sebelumnya
    $response->assertStatus(302); // 302 = redirect back

    // Periksa apakah session memiliki error untuk email
    $response->assertSessionHasErrors(['email' => 'Kombinasi email dan password tidak cocok.']);

    // Pastikan user tetap guest (tidak login)
    $this->assertGuest();
}


}
