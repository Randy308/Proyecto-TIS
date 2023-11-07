<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function assignRolesView()
    {
        $users = User::all();
        return view('assign-roles', compact('users'));
    }

    public function assignRole(Request $request)
    {
        $user = User::find($request->user_id);
        $role = Role::where('name', $request->role)->first();
    
        if ($user && $role) {
            $user->assignRole($role);
            return redirect()->route('assign-roles')->with('success', 'Rol asignado con éxito');
        } else {
            return redirect()->route('assign-roles')->with('error', 'Usuario o rol no encontrado');
        }
    }
}
