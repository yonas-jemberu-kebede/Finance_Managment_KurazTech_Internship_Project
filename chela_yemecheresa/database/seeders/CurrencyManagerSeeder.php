<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\currency_manager;

class CurrencyManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'US Dollar', 'exchange_rate' => 57.712, 'is_basecurrency' =>false, 'status'=>'Active'],
            ['name' => 'ETB', 'exchange_rate' => 1.00, 'is_basecurrency' => true, 'status'=>'Active'],
            ['name' => 'Euro', 'exchange_rate' => 62.94, 'is_basecurrency' => false, 'status'=>'Active'],
            ['name' => 'Japanese Yen', 'exchange_rate' => 0.36, 'is_basecurrency' => false, 'status'=>'Active'],
            ['name' => 'British Pound', 'exchange_rate' => 74.88, 'is_basecurrency' => false, 'status'=>'Active'],
            ['name' => 'Australian Dollar', 'exchange_rate' => 39.11, 'is_basecurrency' => false, 'status'=>'Active'],
            // Add more currencies as needed
        ];

        foreach ($currencies as $currency) {
            currency_manager::create($currency);
        }
        
    }
}
