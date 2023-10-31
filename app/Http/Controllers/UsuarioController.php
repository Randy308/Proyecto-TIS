<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function listaUsuarios()
    {
        return view('lista-usuarios');
    }

    public function show($id)
    {
        return view('visualizar-usuario', [
            'usuario' => User::findOrFail($id)
        ]);
    }

    public function createForm()
    {
        return view('crear-usuario');

    }
    
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $password = $request->password;

        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();

        if (!$tokenData) {
            return redirect()->back()->withErrors(['email' => 'Token incorrecto']);
        }


        $user = User::where('email', $tokenData->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'EL email no existe']);
        }

        $user->password = Hash::make($password);
        $user->update();


        Auth::login($user);


        DB::table('password_resets')->where('email', $user->email)->delete();
        return redirect()->route('index')->with('status', '¡Se ha actualizado su contraseña exitosamente!.');

    }
}
