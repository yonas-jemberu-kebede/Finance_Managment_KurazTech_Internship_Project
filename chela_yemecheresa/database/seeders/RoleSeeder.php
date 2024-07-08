<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        //Permission::create(['name'=>'dashboard.total_income_widget']);
        //Permission::create(['name'=>'dashboard.latest_income_widget']);
      // Permission::create(['name'=>'dashboard.latest_expense_widget']);
        //Permission::create(['name'=>'dashboard.total_expense_widget']);
        //Permission::create(['name'=>'dashboard.total_profit_widget']);
        Permission::create(['name'=>'dashboard.cashflow_widget']);
        //Permission::create(['name'=>'dashboard.income_by_category_widget']);
        //Permission::create(['name'=>'dashboard.expense_by_category_widget']);
       //Permission::create(['name'=>'dashboard.account_balance_widget']);
        //Permission::create(['name'=>'customers.list']);
        //Permission::create(['name'=>'customers.create']);
        //Permission::create(['name'=>'customers.show']);
        //Permission::create(['name'=>'customers.edit']);
        //Permission::create(['name'=>'customers.destroy']);

        //Permission::create(['name'=>'vendors.list']);
        //Permission::create(['name'=>'vendors.create']);
        //Permission::create(['name'=>'vendors.show']);
        Permission::create(['name'=>'vendors.edit']);
        //Permission::create(['name'=>'vendors.destroy']);

        //Permission::create(['name'=>'accounts.list']);
        //Permission::create(['name'=>'accounts.create']);
        //Permission::create(['name'=>'accounts.show']);
        //Permission::create(['name'=>'accounts.edit']);
        //Permission::create(['name'=>'accounts.destroy']);
        
        //Permission::create(['name'=>'income.list']);
       // Permission::create(['name'=>'income.create']);
        //Permission::create(['name'=>'income.show']);
        //Permission::create(['name'=>'income.edit']);
        //Permission::create(['name'=>'income.destroy']);

        //Permission::create(['name'=>'expense.list']);
        //Permission::create(['name'=>'expense.create']);
        //Permission::create(['name'=>'expense.show']);
       // Permission::create(['name'=>'expense.edit']);
       // Permission::create(['name'=>'expense.destroy']);

        //Permission::create(['name'=>'currency.list']);
        //Permission::create(['name'=>'currency.create']);
        //Permission::create(['name'=>'currency.show']);
        //Permission::create(['name'=>'currency.edit']);
        //Permission::create(['name'=>'currency.destroy']);

       // Permission::create(['name'=>'income_transaction_categories.list']);
        //Permission::create(['name'=>'income_transaction_categories.create']);
      //  Permission::create(['name'=>'income_transaction_categories.edit']);
       // Permission::create(['name'=>'income_transaction_categories.destroy']);

        //Permission::create(['name'=>'expense_transaction_categories.list']);
        //Permission::create(['name'=>'expense_transaction_categories.create']);
        //Permission::create(['name'=>'expense_transaction_categories.edit']);
        //Permission::create(['name'=>'expense_transaction_categories.destroy']);

       // Permission::create(['name'=>'transfers.list']);
       // Permission::create(['name'=>'transfers.create']);
        //Permission::create(['name'=>'transfers.edit']);
       // Permission::create(['name'=>'transfers.destroy']);
 

        //Permission::create(['name'=>'payment_methods.list']);
        //Permission::create(['name'=>'payment_methods.create']);
        //Permission::create(['name'=>'payment_methods.edit']);
        //Permission::create(['name'=>'payment_methods.destroy']);

        //Permission::create(["name"=>'reports.transaction_report']);
        Permission::create(["name"=>'reports.income_summary']);
        Permission::create(["name"=>'reports.expense_summary']);
        Permission::create(["name"=>'reports.income_expense_summary']);
        //Permission::create(["name"=>'reports.income_by_customers']);
        //Permission::create(["name"=>'reports.expense_by_vendors']);

        $role1=Role::create(['name'=>'admin']);
        $role1->givePermissionTo(Permission::all());

        $role2=Role::create(['name'=>'customer']);
        $role2->givePermissionTo(Permission::all());

        $role3=Role::create(['name'=>'vendor']);
        $role3->givePermissionTo(Permission::all());

        $role4=Role::create(['name'=>'seller']);
        $role4->givePermissionTo(Permission::all());

        $role5=Role::create(['name'=>'purchaser']);
        $role5->givePermissionTo(Permission::all());

        
    }
}
