<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserManagmentController extends Controller
{
    public function allusers(){
        $allusers=User::all();

        return response()->json([
            'allusers'=>$allusers
        ]);
    }
    public function create(){
        
    }
}
