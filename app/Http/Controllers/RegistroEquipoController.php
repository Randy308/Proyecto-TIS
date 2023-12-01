<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RegistroEquipoController extends Controller
{
    //
    public function view($evento_id){
        $evento=Evento::find($evento_id);
        $grupoExists = Grupo::where('user_id', Auth::user()->id)->where('evento_id', $evento_id)->exists();
        if($grupoExists){
            return redirect()->back()->with('warning', 'Ya pertenece a un grupo');
        }
        return view('registrar-grupo',['evento'=>$evento]);
    }
}
