<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::insert(
            [
                [
                    'name' => 'yonas',
                    'email' => 'john.doe@example.com',
                    'company_name' => 'Doe Industries',
                    'country' => 'USA',
                    'city' => 'New York',
                    'address' => '123 Main St',
                    'note' => 'VIP customer',
                ],
                [
                    'name' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'company_name' => 'Doe Industries',
                    'country' => 'USA',
                    'city' => 'New York',
                    'address' => '123 Main St',
                    'note' => 'VIP customer',
                ],
                [
                    'name' => 'Jane Smith',
                    'email' => 'jane.smith@example.com',
                    'company_name' => 'Smith LLC',
                    'country' => 'Canada',
                    'city' => 'Toronto',
                    'address' => '456 Queen St',
                    'note' => null,
                ],
                [
                    'name' => 'Alice Johnson',
                    'email' => 'alice.johnson@example.com',
                    'company_name' => null,
                    'country' => 'UK',
                    'city' => 'London',
                    'address' => '789 King St',
                    'note' => 'Frequent buyer',
                ],
                [
                    'name' => 'Bob Brown',
                    'email' => 'bob.brown@example.com',
                    'company_name' => 'Brown Co.',
                    'country' => 'Australia',
                    'city' => 'Sydney',
                    'address' => '101 North St',
                    'note' => null,
                ],
                [
                    'name' => 'Charlie Davis',
                    'email' => 'charlie.davis@example.com',
                    'company_name' => null,
                    'country' => 'New Zealand',
                    'city' => 'Auckland',
                    'address' => '202 South St',
                    'note' => 'Likes discounts',
                ],
                [
                    'name' => 'Eva Green',
                    'email' => 'eva.green@example.com',
                    'company_name' => 'Green Enterprises',
                    'country' => 'USA',
                    'city' => 'San Francisco',
                    'address' => '303 East St',
                    'note' => null,
                    ]
            ]
        );
    }
}
