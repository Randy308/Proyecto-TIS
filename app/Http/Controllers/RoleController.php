<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
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


    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate(['rol' => ['required', 'string',Rule::unique('roles', 'name')]],);
        $role = new Role();
        $role->name = $request['rol'];
        $role->save();
        return redirect()->back();
    }


    public function show($id)
    {
        //
    }


    public function edit(User $user)
    {
        //

        $user_roles = $user->getRoleNames();
        $roles = Role::all();
        return view('asignarRoles',compact('user','user_roles','roles'));
    }


    public function update(Request $request, User $user)
    {
        //
        $user->syncRoles($request->name);
        return back();
    }


    public function destroy($id)
    {
        //
        $role = Role::findOrFail($id);
        $role->delete();
        return back()->with('success', 'Rol Eliminado Exitosamente');
    }
}
