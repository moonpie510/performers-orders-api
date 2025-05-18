<?php

namespace Database\Factories;

use App\Models\Partnership;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
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
