<?php

namespace App\Http\Controllers;

use App\Models\CalificacionParticipante;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Http\Request;

class CalificacionParticipanteController extends Controller
{

    public function index()
    {   //$users = User::paginate(20);
        $evento = Evento::find(1);

        // Verifica si el evento existe
        if ($evento) {
            // Obtén los usuarios que participan en este evento
            $users = $evento->users()->get();


        }
        //$users = User::where('estado', 'Habilitado')->get();
        return view('calificar-participantes', compact('users'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($evento_id)
    {

        $evento = Evento::find($evento_id);
        if ($evento) {
            $users = $evento->users()->get();


        }
        return view('calificar-participantes', compact('users'));
    }


    public function edit(CalificacionParticipante $calificacionParticipante)
    {
        //
    }


    public function update(Request $request, CalificacionParticipante $calificacionParticipante)
    {
        if ($request->ajax()) {
            User::find($request->pk)
                ->update([
                    $request->name => $request->value
                ]);

            return response()->json(['success' => true]);
        }
    }


    public function destroy(CalificacionParticipante $calificacionParticipante)
    {
        //
    }
}
