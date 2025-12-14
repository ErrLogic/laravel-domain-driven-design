<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function test_login_returns_token_with_valid_credentials(): void
    {
        $password = 'password123';

        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['token'],
        ]);
    }

    public function test_login_fails_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'success' => false,
        ]);
    }

    public function test_login_fails_when_user_not_found(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'notfound@example.test',
            'password' => 'password',
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'success' => false,
        ]);
    }
}
