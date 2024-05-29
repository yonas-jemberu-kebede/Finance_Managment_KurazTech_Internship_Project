<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\Customer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomeTransaction>
 */
class IncomeTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 0, 10000),
        'type' => fake()->randomElement(['earned', 'passive', 'retirement', 'business', 'investment']),
        'reference' => fake()->unique()->word(),
        'attachment' => fake()->unique()->word(),
       
        'account_id' => Account::factory()->create()->id,
            'customer_id' => Customer::factory()->create()->id,
            'payment_method_id' => PaymentMethod::factory()->create()->id,
        ];
    }
}
