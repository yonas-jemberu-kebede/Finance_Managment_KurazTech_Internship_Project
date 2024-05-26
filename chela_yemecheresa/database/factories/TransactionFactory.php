<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'type' => $this->faker->randomElement(['income', 'expense', 'transfer']),
            'reference' => $this->faker->unique()->bothify('REF-####-????'),
            'attachment' => $this->faker->optional()->imageUrl(),
           
            'account_id' => Account::factory(),
            'target_account_id' => $this->faker->randomElement([\App\Models\Account::factory(), null]),
        ];
    }
}
