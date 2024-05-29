<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaymentMethod;
use App\Models\Account;
use App\Models\Vendor;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpenseTransaction>
 */
class ExpenseTransactionFactory extends Factory
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
        'type' => fake()->randomElement(['rent', 'insurance', 'loan', 'tax', 'utilities']),
        'reference' => fake()->unique()->word(),
        'attachment' => fake()->unique()->word(),
        'payment_method_id' => PaymentMethod::factory()->create()->id,
       
        'account_id' => Account::factory()->create()->id,
       
        'vendor_id' => Vendor::factory()->create()->id
       
        ];
    }
}
