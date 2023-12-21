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
            $image = $request->file('foto_perfil');

            $filename = Str::uuid()->toString() . "_" . preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
            $file_content = file_get_contents($image->getRealPath());
            Storage::disk('public')->put($filename, $file_content);
            $url = '/' . $filename;
        } else {
            $url = "/storage/image/default_user_image.png";
        }
        $user->foto_perfil = $url;

        $user->assignRole($request['rol']);
        $user->save();
    }
    public function store(Request $request)
    {
        $this->validate($request, [

            'nombre' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'telefono' => 'required|regex:#^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s./0-9]*$#',
            'email' => ['required', 'unique:users,email', 'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'],
            'institucion' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);
        $user = new User();
        $user->name = $request['nombre'];
        $user->password = Hash::make($request['password']);
        $user->institucion_id = $request['institucion'];

        $user->telefono = $request['telefono'];

        $user->email = $request['email'];

        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->estado = $request['estado'];
        $url = "/storage/image/default_user_image.png";

        $user->foto_perfil = $url;

        $user->assignRole($request['rol']);
        $user->save();
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
    public function editPassword($id)
    {

        return view('cambiarPassword');
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::findOrFail($id);
        //$my_old_input_password = Hash::make($request['old_password']);
        $my_new_password = Hash::make($request['password']);

        if (Hash::check($request['old_password'], $user->password)) {
            $user->password = $my_new_password;
            $user->save();
            return redirect()->route('editarPerfil')->with('status', 'Se ha cambiado la contraseña exitosamente.');
        } else {
            return redirect()->back()->with('error', 'La contraseña actual no coincide con la del sistema .');
        }
        //return $request;
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
    public function showParticipante($id)
    {
        $user = User::findOrFail($id);
        $institucion = Institucion::findOrFail($user->institucion_id);
        return view('layouts.ver-perfil-participante', [
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
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Usuario Eliminado Exitosamente');
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
            'codsis' => ['nullable',Rule::unique('users', 'cod_estudiante')->ignore($id)],
        ]);
        $user = User::findOrFail($id);
        $user->name = $request['nombre'];
        $user->telefono = $request['telefono'];
        $user->direccion = $request['direccion'];
        $user->email = $request['email'];
        $user->fecha_nac = $request['fecha_nac'];
        if ($request->has('codsis')) {
            $user->cod_estudiante = $request['codsis'];
        }
        $user->institucion_id = $request['institucion'];
        $user->pais = $request['pais'];
        $user->historial_academico = $request['historial'];
        if ($request->hasFile('foto_perfil')) {
            $image = $request->file('foto_perfil');

            $filename = Str::uuid()->toString() . "_" . preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
            $file_content = file_get_contents($image->getRealPath());
            Storage::disk('public')->put($filename, $file_content);
            $url = '/' . $filename;
        } else {
            $url = "/storage/image/default_user_image.png";
        }
        $user->foto_perfil = $url;
        $user->update();

        return redirect()->route('editarPerfil')->with('status', 'Perfil actualizado exitosamente!.');
    }
}
