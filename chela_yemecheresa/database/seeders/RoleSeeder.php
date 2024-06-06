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
       
        Permission::create(['name'=>'create']);
       
        Permission::create(['name'=>'update']);
        
        Permission::create(['name'=>'read']);
        
        Permission::create(['name'=>'delete']);
        

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
