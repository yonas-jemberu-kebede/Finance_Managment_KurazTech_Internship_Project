<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionCategory>
 */
class TransactionCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colors = ['red', 'green', 'blue', 'black', 'white', 'yellow', 'purple', 'orange'];
        return [
            'name' => fake()->word,
            'type' => fake()->word,
            'color' => fake()->randomElement($colors),
        ];
    }
}
