<?php

namespace Database\Factories;

use Domains\Partnership\Models\Partnership;
use Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'partnership_id' => Partnership::query()->inRandomOrder()->value('id'),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '12345678',
        ];
    }
}
