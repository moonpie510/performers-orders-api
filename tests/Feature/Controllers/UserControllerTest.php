<?php

namespace Tests\Feature\Controllers;

use App\Models\Partnership;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null,
            'Test Client',
            'http://localhost'
        );

        config([
            'passport.personal_access_client.id' => $client->id,
            'passport.personal_access_client.secret' => $client->plainSecret,
        ]);
    }

    public function test_register_success()
    {
        $partnership = Partnership::factory()->create();

        $newUserData = [
            'partnership_id' => $partnership->id,
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123'
        ];

        $this->assertDatabaseMissing('users', ['email' => $newUserData['email']]);

        $response = $this->post('/api/v1/auth/user/register', $newUserData);

        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('users', ['email' => $newUserData['email']]);
    }

    public function test_login_success()
    {
        $partnership = Partnership::factory()->create();
        $user = User::factory()->create(['password' => 'password123']);

        $response = $this->post('/api/v1/auth/user/login', ['email' => $user->email, 'password' => 'password123']);

        $response->assertJson(['success' => true]);

    }

    public function test_logout_success()
    {
        $partnership = Partnership::factory()->create();
        $user = User::factory()->create(['password' => 'password123']);

        Passport::actingAs($user);

        $response = $this->post('/api/v1/auth/user/logout');

        $response->assertJson(['success' => true]);
    }

    public function test_get_sessions_success()
    {
        $partnership = Partnership::factory()->create();
        $user = User::factory()->create(['password' => 'password123']);

        Passport::actingAs($user);

        $response = $this->get('/api/v1/auth/user/sessions');

        $response->assertOk();
    }

    public function test_close_session_by_id_success()
    {
        $partnership = Partnership::factory()->create();
        $user = User::factory()->create(['password' => 'password123']);

        Passport::actingAs($user);
        $user->createToken('test');
        $token = $user->tokens()->first();

        $response = $this->delete("/api/v1/auth/user/sessions/{$token->id}");

        $response->assertOk();
    }
}
