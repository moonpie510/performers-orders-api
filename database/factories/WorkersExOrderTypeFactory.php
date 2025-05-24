<?php

namespace Database\Factories;

use Domains\Order\Models\OrderType;
use Domains\Worker\Models\Worker;
use Domains\Worker\Models\WorkersExOrderType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkersExOrderType>
 */
class WorkersExOrderTypeFactory extends Factory
{
    protected $model = WorkersExOrderType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'worker_id' => Worker::query()->inRandomOrder()->value('id'),
            'order_type_id' => OrderType::query()->inRandomOrder()->value('id'),
        ];
    }
}
