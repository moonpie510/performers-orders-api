<?php

namespace Database\Factories;

use Domains\Order\Enums\OrderStatusEnum;
use Domains\Order\Models\Order;
use Domains\Order\Models\OrderType;
use Domains\Partnership\Models\Partnership;
use Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

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
            'status' => fake()->randomElement(array_column(OrderStatusEnum::cases(), 'value')),
        ];
    }
}
