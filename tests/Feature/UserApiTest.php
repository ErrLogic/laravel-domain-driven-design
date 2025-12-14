<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function test_index_returns_paginated_users()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                '*' => ['id', 'name', 'email'],
            ],
            'meta' => ['total', 'count', 'per_page', 'current_page', 'last_page'],
        ]);

        $this->assertCount(3, $response->json('data'));
    }

    public function test_show_returns_single_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $user->id,
            'email' => $user->email,
        ]);
    }

    public function test_store_creates_user()
    {
        $payload = [
            'name' => 'Bang Tester',
            'email' => 'tester+'.Str::random(6).'@example.test',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/users', $payload);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'User created successfully.',
        ]);

        $this->assertDatabaseHas('users', ['email' => $payload['email']]);
    }

    public function test_update_modifies_user()
    {
        $user = User::factory()->create();
        $payload = ['name' => 'Updated Name'];

        $response = $this->patchJson("/api/users/{$user->id}", $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }

    public function test_delete_removes_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
