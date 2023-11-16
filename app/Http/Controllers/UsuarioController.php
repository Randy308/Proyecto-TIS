<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Models\Institucion;

class UsuarioController extends Controller
{
    private function validacionesCE(Request $request, bool $nuevaContra)
    {
        if ($nuevaContra) {
            $this->validate($request, [
                'nombre' => ['required', 'string', 'min:4', 'regex:/^[a-zA-Z\s]*$/', 'max:60'],
                'telefono' => 'required',
                'direccion' => 'required|string',
                'email' => 'required',
                'fecha_nac' => 'required',
                'institucion' => 'required',
                'pais' => 'required',
                'historial' => '',
                'foto_perfil' => 'image|max:2048',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }
        $this->validate($request, [
            'nombre' => ['required', 'string', 'min:4', 'regex:/^[a-zA-Z\s]*$/', 'max:60'],
            'telefono' => 'required',
            'direccion' => 'required|string',
            'email' => 'required',
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'fecha_nac' => 'required',
            'institucion' => 'required',
            'pais' => 'required',
            'historial' => '',
            'foto_perfil' => 'image|max:2048',

        ]);
    }

    private function guardarUsuario(User $user, Request $request, bool $nuevaContra)
    {

        $user->name = $request['nombre'];
        $user->institucion_id = $request['institucion'];
        $user->historial_academico = $request['historial'];
        $user->pais = $request['pais'];
        $user->telefono = $request['telefono'];
        $user->direccion = $request['direccion'];
        if ($nuevaContra) {
            $user->password = Hash::make($request['password']);
        }

        $user->email = $request['email'];
        $user->fecha_nac = $request['fecha_nac'];
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->estado = $request['estado'];
        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil')->store('public/fotos_usuarios');
            $url = Storage::url($imagen);
        } else {
            $url = "/storage/image/default_user_image.png";
        }
        $user->foto_perfil = $url;

        $user->assignRole($request['rol']);
        $user->save();
    }
    public function store(Request $request)
    {
        $user = new User();
        $this->validacionesCE($request, true);
        $this->guardarUsuario($user, $request, true);
        return redirect()->route('listaUsuarios')->with('status', 'Usuario creado exitosamente!.');
    }

    public function edit(Request $request, $id)
    {
        $boolaux = false;
        if ($request['cambiar_contrasena'] != null) {
            $boolaux = true;
        }
        $this->validacionesCE($request, $boolaux);
        $user = User::findOrFail($id);
        if ($user) {
            $this->guardarUsuario($user, $request, $boolaux);
            return redirect()->route('verUsuario', ['id' => $id])->with('status', 'Usuario editado exitosamente!.');
        }

    }


    public function listaUsuarios()
    {
        return view('lista-usuarios');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $institucion = Institucion::findOrFail($user->institucion_id);
        return view('visualizar-usuario', [
            'usuario' => $user,
            'institucion' => $institucion->nombre_institucion
        ]);
    }

    public function createForm()
    {
        $instituciones = Institucion::all();
        $roles = Role::all();
        return view('crear-usuario', compact('instituciones', 'roles'));
    }

    public function editForm($id)
    {
        $usuario = User::findOrFail($id);
        $instituciones = Institucion::all();
        $roles = Role::all();
        return view('editar-usuario', compact('usuario', 'instituciones', 'roles'));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $email = $request->email;
        $password = $request->password;

        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();

        if (!$tokenData) {
            return redirect()->route('actualizar-password', compact('email'))->withErrors(['email' => 'Token incorrecto']);
        }


        $user = User::where('email', $tokenData->email)->first();

        if (!$user) {
            return redirect()->route('actualizar-password', compact('email'))->withErrors(['email' => 'EL email no existe']);
        }

        $user->password = Hash::make($password);
        $user->update();


        Auth::login($user);


        DB::table('password_resets')->where('email', $user->email)->delete();
        return redirect()->route('index')->with('status', '¡Se ha actualizado su contraseña exitosamente!.');

    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $instituciones = Institucion::all();
        return view('cambiar-perfil', compact('user', 'instituciones'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [

            'nombre' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'telefono' => ['required', 'regex:#^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s./0-9]*$#'],
            'direccion' => 'required|string',
            'email' => ['required', Rule::unique('users', 'email')->ignore($id), 'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'],
            'fecha_nac' => 'required',
            'institucion' => 'required',
            'pais' => 'required',
            'historial' => 'string',
            'foto_perfil' => 'image|max:2048',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request['nombre'];
        $user->telefono = $request['telefono'];
        $user->direccion = $request['direccion'];
        $user->email = $request['email'];
        $user->fecha_nac = $request['fecha_nac'];

        $user->institucion_id = $request['institucion'];
        $user->pais = $request['pais'];
        $user->historial_academico = $request['historial'];
        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil')->store('public/fotos_usuarios');
            $url = Storage::url($imagen);
        } else {
            $url = "/storage/image/default_user_image.png";
        }
        $user->foto_perfil = $url;
        $user->update();

        return view('editar-perfil');

    }
}
