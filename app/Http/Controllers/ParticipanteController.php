<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class ParticipanteController extends Controller
{

    public function index()
    {
        $instituciones = Institucion::all();
        return view('registrarParticipante', compact('instituciones'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'telefono' => 'required|regex:#^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s./0-9]*$#',
            'direccion' => 'required|string',
            'email' => ['required', 'unique:users,email', 'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'],
            'fecha_nac' => 'required',
            'institucion' => 'required',
            'pais' => 'required',
            'historial' => '',
            'codsis' => ['nullable','unique:users,cod_estudiante'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

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
        if ($request->has('codsis')) {
            $user->cod_estudiante = $request['codsis'];
        }

        $user->cod_estudiante = $request['codsis'];
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->estado = "Habilitado";
        $url = "/storage/image/default_user_image.png";
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
