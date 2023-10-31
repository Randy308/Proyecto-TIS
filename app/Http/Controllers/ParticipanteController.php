<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
class ParticipanteController extends Controller
{

    public function index()
    {   $instituciones = Institucion::all();
        return view('registrarParticipante',compact('instituciones'));
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
            'institucion' => 'required',
            'pais' => 'required',
            'historial' => 'required|string',
            'foto_perfil' => 'required|image|max:2048',

        ]);
        $user = new User();
        $user->name = $request['name'];
        $user->institucion_id = $request['institucion'];
        $user->historial_academico = $request['historial'];
        $user->pais = $request['pais'];
        $user->telefono = $request['telefono'];
        $user->direccion = $request['direccion'];
        $user->password = Hash::make($request['password']);
        $user->email = $request['email'];
        $user->fecha_nac = $request['fecha_nac'];
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->estado = "Habilitado";
        $imagen = $request->file('foto_perfil')->store('public/fotos_usuarios');
        $url = Storage::url($imagen);
        $user->foto_perfil = $url;
        $user->assignRole('usuario común');
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
