<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
use App\Models\currency_manager;
use App\Models\PaymentMethod;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TansferTransaction>
 */
class TansferTransactionFactory extends Factory
{
    /** 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(1, 10000),
            'reference' => $this->faker->unique()->word,
            'attachment' => $this->faker->optional()->word,
            'note' => $this->faker->optional()->sentence,
            'payment_method_id' =>PaymentMethod::class,
            'account_name' => Account::factory(), // Define account relationship
            'target_account_name' => Account::factory(), // Define target account relationship
            'currency_manager_id' =>currency_manager::factory(), // Define currency manager relationship
        ];
    }
}
