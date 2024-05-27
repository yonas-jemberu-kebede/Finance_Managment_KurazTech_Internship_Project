<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1=User::find(1);
        $user1->assignRole('admin');

        $user2=User::find(2);
        $user2->assignRole('customer');

        $user3=User::find(3);
        $user3->assignRole('vendor');

        $user4=User::find(4);
        $user4->assignRole('seller');

        $user5=User::find(5);
        $user5->assignRole('purchaser');
    }
}
