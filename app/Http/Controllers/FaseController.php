<?php

namespace App\Http\Controllers;
use App\Models\FaseEvento;
use Illuminate\Http\Request;
use App\Rules\ValidarSuperposicionFechasFases;
use App\Rules\FechaMaximaFase;
use App\Rules\FechaMenorQue;
use App\Rules\FechaMinimaFase;
class FaseController extends Controller
{
    public function store(Request $request,$eventoId)
    {
       
        $this->validate($request, [
            'nombre_fase' => ['required','string' ,'min:4', 'regex:/^[a-zA-Z0-9__ñÑ]+$/', 'max:30'],
            'descripcion_fase' => 'required',
            new ValidarSuperposicionFechasFases($eventoId),
            'fechaInicio' => ['required',
                              new FechaMenorQue($request['fechaFin']),
                              new FechaMinimaFase($eventoId)   
                             ],
            'fechaFin' => ['required', new FechaMaximaFase($eventoId)],
            'tipo' => 'required',
            
        ]);
        $fase = new FaseEvento();
        $fase->evento_id = $eventoId;
        $fase->nombre_fase =  $request['nombre_fase'];
        $fase->descripcion_fase =  $request['descripcion_fase'];
        $fase->fechaInicio =  $request['fechaInicio'];
        $fase->fechaFin =  $request['fechaFin'];
        $fase->tipo =  $request['tipo'];
        $fase->actual =  false;

        $fase->save();
        return redirect()->back()->with('status', 'La fase se creó exitosamente');
    
    }

    public function edit(Request $request,$faseId){

    }

}
