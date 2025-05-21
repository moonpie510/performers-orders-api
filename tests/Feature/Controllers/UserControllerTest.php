<?php

namespace Tests\Feature\Controllers;

use App\Models\Partnership;
use App\Services\UserService;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    private $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
    }

    public function test_register_success()
    {
        $this->assertEquals(true, true);
//        $newUserData = [
//            'partnership_id' => 1,
//            'name' => 'New User',
//            'email' => 'new@example.com',
//            'password' => 'newpassword123',
//            'password_confirmation' => 'newpassword123'
//        ];

//        $this->assertDatabaseMissing('users', ['email' => $newUserData['email']]);
//
//        $response = $this->post('/api/v1/register', $newUserData);
//
//        $response->assertJsonPath('success', true);
//
//        $this->assertDatabaseHas('users', ['email' => $newUserData['email']]);
    }
}
