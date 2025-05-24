<?php

namespace Database\Factories;

use Domains\Partnership\Models\Partnership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partnership>
 */
class PartnershipFactory extends Factory
{
    protected $model = Partnership::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
        ];
    }
}
