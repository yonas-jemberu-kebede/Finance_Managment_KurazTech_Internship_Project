<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'company_name' => $this->faker->optional()->company,
            'country' => $this->faker->optional()->country,
            'city' => $this->faker->optional()->city,
            'address' => $this->faker->optional()->address,
            'note' => $this->faker->optional()->sentence,
        ];
    }
}
