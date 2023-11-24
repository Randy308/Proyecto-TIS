<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use Illuminate\Http\Request;

class FaseController extends Controller
{
    public function fasesdeEvento($evento_id){
        $fases = Fase::where('evento_id', 1)->get();
        return view('fase',['fases'=>$fases]);
    }
}
