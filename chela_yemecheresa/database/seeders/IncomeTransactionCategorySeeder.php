<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IncomeTransactionCategory;

class IncomeTransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    IncomeTransactionCategory::insert([
        [
         'name'=>'deposit',
         'type'=>'income',
         'color'=>'green'
        ],
        [
            'name'=>'fee',
            'type'=>'income',
            'color'=>'yellow'
           ],
           [
            'name'=>'cashin',
            'type'=>'income',
            'color'=>'blue'
           ],
           [
            'name'=>'passive',
            'type'=>'income',
            'color'=>'orange'
           ]
    ]);
    }
}
