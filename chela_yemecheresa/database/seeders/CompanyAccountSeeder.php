<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyAccount;

class CompanyAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyAccount::create([
            'name' => 'cashlite',
            'account_number' => 'ACC123456789',
            'account_currency' => 'USD',
            'opening_balance' => '10000.00',
            'amount' => 10000.0000,
            'contact_person' => 'John Doe',
            'contact_email' => 'john@example.com',
            'note' => 'Initial deposit',
        ]);
    }
}
