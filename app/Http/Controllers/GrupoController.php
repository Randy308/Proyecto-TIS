<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{

    public function index($evento_id)
    {
        //
        return view('ver-grupos',compact('evento_id'));
    }


    public function create()
    {
        //
    }

    public function habilitarEstado($evento_id,$grupo_id)
    {
        Grupo::find($grupo_id)
            ->update([
                'estado' => "Habilitado"
            ]);
        return redirect()->route('ver.grupos', compact('evento_id'))->with('status', 'Estado de la participacion actualizada.');
    }
    public function rechazarEstado($evento_id,$grupo_id)
    {
        Grupo::find($grupo_id)
            ->update([
                'estado' => "Denegado"
            ]);
        return redirect()->route('ver.grupos', compact('evento_id'))->with('status', 'Estado de la participacion actualizada');
    }
    public function posponerEstado($evento_id,$grupo_id)
    {
        Grupo::find($grupo_id)
            ->update([
                'estado' => "Pendiente"
            ]);
        return redirect()->route('ver.grupos', compact('evento_id'))->with('status', 'Estado de la participacion actualizada');
    }

    public function store(Request $request)
    {
        //
    }

    public function showIntegrantes($evento_id,$grupo_id)
    {
        //
        return view('visualizar-integrantes-grupo',compact('evento_id','grupo_id'));
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
