<?php

namespace App\Http\Controllers;

use App\Mail\EnviarMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class RecuperarCuentaController extends Controller
{

    public function index()
    {
        $email = null;
        $currentTab = null;
        return view('recuperar-cuenta', compact('email', 'currentTab'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //

    }
    public function enviarEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);
            $tokenData = DB::table('password_resets')->where('email', $request->email)->first();

            Mail::to('randyh308@gmail.com')->send(new EnviarMail($tokenData->token, $user->name));
            return redirect()->route('actualizar-password',['email' => base64_encode($email)]);
        } else {
            return redirect()->route('index')->with('error', 'El correo electronico proporcionado no existe en el sistema.');
        }

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
