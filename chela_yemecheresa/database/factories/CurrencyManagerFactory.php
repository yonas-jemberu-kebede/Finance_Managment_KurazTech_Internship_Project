<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\currency_manager>
 */
class CurrencyManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'exchange_rate' => $this->faker->randomFloat(4, 0, 100), // 4 decimal places, between 0 and 100
            'base_currency' => $this->faker->boolean, // Randomly true or false
            'status' => $this->faker->boolean(true),
        ];
    }
}
