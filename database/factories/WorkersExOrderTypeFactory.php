<?php

namespace Database\Factories;

use App\Models\OrderType;
use App\Models\Worker;
use App\Models\WorkersExOrderType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkersExOrderType>
 */
class WorkersExOrderTypeFactory extends Factory
{
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
