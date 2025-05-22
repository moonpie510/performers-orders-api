<?php

namespace Tests\Feature\Controllers;

use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class WorkerControllerTest extends TestCase
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

    public function test_get_workers_success()
    {
        $worker = Worker::factory()->create();

        $response = $this->get('/api/v1/workers');

        $response->assertJsonCount(1);
    }

    public function test_login_worker_success()
    {
        $worker = Worker::factory()->create();

        $response = $this->post("/api/v1/workers/{$worker->id}/login");

        $response->assertJson(['success' => true]);
    }
}
