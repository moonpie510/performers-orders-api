<?php

namespace Database\Factories;

use Domains\Worker\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Worker>
 */
class WorkerFactory extends Factory
{
    protected $model = Worker::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'second_name' => fake()->name(),
            'surname' => fake()->name(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
