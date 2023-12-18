<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Grupo;
use Livewire\Component;

class ReportEquipoEvento extends Component
{
    public $eventoId;


    public function render()
    {
        $equipos=Evento::join('grupos','grupos.evento_id','=','eventos.id')
                        ->join('users','users.id','=','grupos.user_id')
                        ->select('eventos.id AS evento_id','eventos.user_id AS creadorEvento_id',
                                'grupos.id AS grupo_id','grupos.nombre AS nombreGrupo',
                                'users.id AS user_id','users.name AS nombreCreadorGrupo','users.institucion_id')
                        ->where('grupos.evento_id',$this->eventoId)
                        ->get();


        return view('livewire.report-equipo-evento',compact('equipos'));
    }
}
