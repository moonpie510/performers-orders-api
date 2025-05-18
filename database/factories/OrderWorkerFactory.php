<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderWorker;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderWorker>
 */
class OrderWorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::query()->inRandomOrder()->value('id'),
            'worker_id' => Worker::query()->inRandomOrder()->value('id'),
            'amount' => fake()->numberBetween(500, 5000),
        ];
    }
}
