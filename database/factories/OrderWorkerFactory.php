<?php

namespace Database\Factories;

use Domains\Order\Models\Order;
use Domains\Order\Models\OrderWorker;
use Domains\Worker\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderWorker>
 */
class OrderWorkerFactory extends Factory
{
    protected $model = OrderWorker::class;

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
