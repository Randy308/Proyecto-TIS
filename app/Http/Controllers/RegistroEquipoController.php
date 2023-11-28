<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class RegistroEquipoController extends Controller
{
    //
    public function view($evento_id){
        $evento=Evento::find($evento_id);
        return view('registrar-grupo',['evento'=>$evento]);
    }
}
