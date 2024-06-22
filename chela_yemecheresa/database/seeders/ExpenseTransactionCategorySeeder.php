<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExpenseTransactionCategory;

class ExpenseTransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpenseTransactionCategory::insert([
            [
             'name'=>'payroll',
             'type'=>'expense',
             'color'=>'red'
            ],
            [
                'name'=>'cashout',
                'type'=>'expense',
                'color'=>'yellow'
            ],
             [
                'name'=>'purchase',
                'type'=>'expense',
                'color'=>'blue'
            ],
             [
                'name'=>'boat',
                'type'=>'expense',
                'color'=>'orange'
               ],
               [
                'name'=>'cooking oil',
                'type'=>'expense',
                'color'=>'pink'
               ]
        ]);
    }
}
