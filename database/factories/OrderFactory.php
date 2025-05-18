<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => OrderType::query()->inRandomOrder()->value('id'),
            'partnership_id' => Partnership::query()->inRandomOrder()->value('id'),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'description' => fake()->text(100),
            'date' => fake()->date(),
            'address' => fake()->address(),
            'amount' => fake()->numberBetween(500, 5000),
            'status' => fake()->randomElement(array_column(OrderStatus::cases(), 'value')),
        ];
    }
}
