<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/'); // ganti dengan route setelah login kalau beda
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_wrong_credentials()
    {
        $user = User::factory()->create([
            'email' => 'user1@tegal.com',
            'password' => Hash::make('123'),
        ]);

          // Input password SALAH
    $response = $this->post('/login', [
        'email' => 'user1@tegal.com',
        'password' => 'wrong-password', // password salah
    ]);


        $response->assertSessionHasErrors(); // biasanya menampilkan error di sesi
        $this->assertGuest();
    }

    public function test_guest_can_see_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('pages.auth.login'); // pastikan view login-nya sesuai
    }
}
