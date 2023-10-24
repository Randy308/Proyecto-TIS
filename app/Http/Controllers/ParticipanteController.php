<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class ParticipanteController extends Controller
{

    public function index()
    {
        return view('registrarParticipante');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'telefono' => 'required',
            'direccion' => 'required|string',
            'email' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'fecha_nac' => 'required',
            'carrera' => 'required',
            'foto_perfil' => 'required|image|max:2048',

        ]);
        $user = new User();
        $rol = Rol::where('nombre_rol', 'usuario_comun')->first();
        $user->name = $request['name'];
        $user->rol_id = $rol->id;
        $user->telefono = $request['telefono'];
        $user->direccion = $request['direccion'];
        $user->password = Hash::make($request['password']);
        $user->email = $request['email'];
        $user->carrera = $request['carrera'];
        $user->fecha_nac = $request['fecha_nac'];
        $imagen = $request->file('foto_perfil')->store('public/imagenes');
        $url = Storage::url($imagen);
        $user->foto_perfil = $url;
        $user->save();
        return redirect()->route('index')->with('status', 'Usuario creado exitosamente!.');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
