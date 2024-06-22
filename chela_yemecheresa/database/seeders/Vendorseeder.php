<?php

namespace Database\Seeders;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Vendorseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::insert([
            
                [
                    "name"=> "yonas",
                    "email"=> "vendor1@example.com",
                    "registration_number"=> "REG123456",
                    "vat_id"=> "VAT123456",
                    "company_name"=> "Vendor One LLC",
                    "country"=> "USA",
                    "city"=> "New York",
                    "address"=> "1234 Market St",
                    "note"=> "First vendor in the system."
                ],
                [
                    "name"=> "Vendor Two",
                    "email"=> "vendor2@example.com",
                    "registration_number"=> "REG654321",
                    "vat_id"=> "VAT654321",
                    "company_name"=> null,
                    "country"=> "Canada",
                    "city"=> "Toronto",
                    "address"=> "5678 Queen St",
                    "note"=> "This is a note for vendor two."
                ],
                [
                    "name"=> "Vendor Three",
                    "email"=> "vendor3@example.com",
                    "registration_number"=> "REG111111",
                    "vat_id"=> "VAT111111",
                    "company_name"=> "Vendor Three Inc.",
                    "country"=> "UK",
                    "city"=> "London",
                    "address"=> "12 Baker St",
                    "note"=> "Vendor three's details are all valid."
                ],
                [
                    "name"=> "Vendor Four",
                    "email"=> "vendor4@example.com",
                    "registration_number"=> "REG222222",
                    "vat_id"=> "VAT222222",
                    "company_name"=> "Vendor Four Ltd.",
                    "country"=> "Australia",
                    "city"=> "Sydney",
                    "address"=> "34 George St",
                    "note"=> "Fourth vendor note with additional details."
                ],
                [
                    "name"=> "Vendor Five",
                    "email"=> "vendor5@example.com",
                    "registration_number"=> "REG333333",
                    "vat_id"=> "VAT333333",
                    "company_name"=> "Vendor Five Pty",
                    "country"=> null,
                    "city"=> null,
                    "address"=> null,
                    "note"=> "Vendor five is based in an unknown location."
                ]
            
            
        ]);
    }
}
