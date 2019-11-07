<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function getUsers(){
        $roles=Role::get();
        $users=User::get();
        return view ('users.all')->with(['roles'=>$roles,'users'=>$users]);
    }
    public function postAssignUserRole(Request $request){
        $user_id=$request['user_id'];
        $role=$request['role'];
        $user=User::whereId($user_id)->firstOrFail();
        $user->syncRoles($role);
        return redirect()->back()->with("info", "The selected user role have been changed.");
    }
}
