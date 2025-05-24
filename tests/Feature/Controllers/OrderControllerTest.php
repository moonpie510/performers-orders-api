<?php

namespace Tests\Feature\Controllers;

use Domains\Order\Enums\OrderStatusEnum;
use Domains\Order\Enums\OrderTypeEnum;
use Domains\Order\Models\Order;
use Domains\Order\Models\OrderType;
use Domains\Partnership\Models\Partnership;
use Domains\User\Models\User;
use Domains\Worker\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Tests\TestCase;

class OrderControllerTest extends TestCase
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

    public function test_order_created_success()
    {
        $partnership = Partnership::factory()->create();
        $user = User::factory()->create();
        $type = OrderType::query()->create(['name' => OrderTypeEnum::Loading->value]);

        Passport::actingAs($user);

        $orderData = [
            "type_id" =>  $type->id,
            "partnership_id" => $partnership->id,
            "description" => "Описание для заказа",
            "date" => "2025-05-18",
            "address" => "ул Пушкина",
            "amount" => 1000
        ];

        $response = $this->post('/api/v1/orders', $orderData);

        $response->assertJson(['success' => true]);
    }

    public function test_assign_worker_success()
    {
        $partnership = Partnership::factory()->create();
        $user = User::factory()->create();
        $worker = Worker::factory()->create();
        $type = OrderType::query()->create(['name' => OrderTypeEnum::Loading->value]);
        $order = Order::factory()->create(['status' => OrderStatusEnum::Created->value]);

        Passport::actingAs($user);

                $response = $this->post('/api/v1/orders/assign-worker', ['order_id' => $order->id, 'worker_id' => $worker->id]);

        $response->assertJson(['success' => true]);
    }

    public function test_assign_worker_wrong_order_status_success()
    {
        $partnership = Partnership::factory()->create();
        $user = User::factory()->create();
        $worker = Worker::factory()->create();
        $type = OrderType::query()->create(['name' => OrderTypeEnum::Loading->value]);
        $order = Order::factory()->create(['status' => OrderStatusEnum::Completed->value]);

        Passport::actingAs($user);

        $response = $this->post('/api/v1/orders/assign-worker', ['order_id' => $order->id, 'worker_id' => $worker->id]);

        $response->assertJson(['message' => 'Назначить работника можно только на созданный заказ']);
    }

    public function test_update_order_status_success()
    {
//        Broadcast::shouldReceive('event')->andReturnNull();

        $partnership = Partnership::factory()->create();
        $user = User::factory()->create();
        $worker = Worker::factory()->create();
        $type = OrderType::query()->create(['name' => OrderTypeEnum::Loading->value]);
        $order = Order::factory()->create(['status' => OrderStatusEnum::Appointed->value]);

        Passport::actingAs($user);

        $response = $this->put("/api/v1/orders/{$order->id}/status", ['status' => OrderStatusEnum::Completed->value]);

        $response->assertJson(['success' => true]);
    }
}
