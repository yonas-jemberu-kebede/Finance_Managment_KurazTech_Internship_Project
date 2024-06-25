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
    public function allroles(){

        $allroles=Role::all();

        return response()->json([
            'allroles'=>$allroles
        ]);
        
    }

    public function createrole(){
        return view('role.create');
    }

    public function storerole(Request $request){
        $validated=$request->validate(
            [
                'name'=>'required|string',
                'description'=>'nullable|string'
            ]
            );


            Role::create($validated);
             
            return response()->json(['message'=>'role created successfully']);
    }

    public function viewrole(Role $role){
        return response()->json([
            'role'=>$role
        ]);
    }
    public function editrole(Role $role){
        return view('role.edit',[
            'role'=>$role
        ]);
    }

    public function updaterole(Role $role,Request $request){

        $validated=$request->validate([
            'name'=>['required','string'],
            'description'=>['nullable','string']
        ]);
        $role->update($validated);

        return response()->json([
            'message','role updated successfully'
        ]);
    }

    public function deleterole(Role $role,Request $request){
    $role->delete();
    return response()->json(['message','role deleted successfully']);
    }


public function setpermission(Request $request){
    $validated=$request->validate([
        'role'=>'required|string|exists:roles,name',
        'permissions'=>'required|array',
        'permission.*'=>'required|string|exists:permissions,name',
    ]);

    $role=Role::findByName($validated['role']);
    $role->syncPermissions($validated['permissions']);

    return response()->json([
        'message'=>"permission added succesfully!",
        'role'=>$role->name,
        'permission'=>$role->permissions
    ]);
}

    public function viewuser(User $user){
        return response()->json([
            'user'=>$user
        ]);
    }
    public function edituser(User $user){
        return view('user.edit',[
            'user'=>$user
        ]);
    }

    public function updateuser(User $user,Request $request){

        $validated=$request->validate([
            'name'=>['required','string'],
            'description'=>['nullable','string']
        ]);
        $user->update($validated);

        return response()->json([
            'message','user updated successfully'
        ]);
    }

    public function deleteuser(User $user,Request $request){
    $user->delete();
    return response()->json(['message','user deleted successfully']);

    }
}
