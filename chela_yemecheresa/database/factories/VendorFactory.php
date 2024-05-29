<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'name' => fake()->name,
        'email' => fake()->unique()->safeEmail,
        'registration_number' => fake()->unique()->randomNumber(),
        'vat_id' => fake()->unique()->randomNumber(),
        'company_name' => fake()->company,
        'country' => fake()->country,
        'city' => fake()->city,
        'address' => fake()->address,
        'note' => fake()->text,
        ];
    }
}
