<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthUser extends Controller
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
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string',]]);
        if (!Auth::attempt($credentials)) {
            //return redirect()->route('my.index')->with('failed','Cuenta no verificada espere confirmacion! ');
            return  redirect()->route('index')->withErrors(['msg' => 'Credenciales incorrectos ']);

        }
        //return 'you are loggin';

        $user = User::FindOrFail(Auth::id());
        return redirect()->back()->with('status', 'Inicio Exitoso! ');
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


    public function destroy(Request $request)
    {
        //
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index')->with('info', 'Se ha cerrado sesion');
    }
}
