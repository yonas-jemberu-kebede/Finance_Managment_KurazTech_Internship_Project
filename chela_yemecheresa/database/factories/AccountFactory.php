<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'account_number'=>fake()->unique()->numerify(),
            'account_currency'=>fake()->currencyCode(),    
           'opening_balance'=>fake()->randomFloat(2,25),
           'contact_person'=>fake()->name(),
           'contact_email'=>fake()->email(),
           'note'=>fake()->paragraph()
        ];
    }
}
