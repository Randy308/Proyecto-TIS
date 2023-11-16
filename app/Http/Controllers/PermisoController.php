<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisoController extends Controller
{

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
        //
    }


    public function show($id)
    {
        //
    }


    public function edit(Role $role)
    {
        //

        $rol_permisos = $role->permissions()->get();
        $permisos = Permission::all();
        return view('permisos',compact('role','permisos','rol_permisos'));
    }


    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->name);
        return back();
    }


    public function destroy($id)
    {
        //
    }
}
