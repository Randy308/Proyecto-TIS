<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListaParticipantes extends Component
{
    protected $paginationTheme = 'bootstrap';

    use WithPagination;

    public $evento_id;
    public function render()
    {
        $evento = Evento::find($this->evento_id);

        if ($evento) {
            $eventoId = $evento->id;
            //->where('asistencia_eventos.estado', '!=',"Denegado")
            $combinedData = DB::table('asistencia_eventos')
                ->join('users', 'asistencia_eventos.user_id', '=', 'users.id')
                ->where('asistencia_eventos.evento_id', $eventoId)
                ->select(
                    'asistencia_eventos.id as asistencia_id',
                    'users.id as user_id',
                    'users.email',
                    'users.name',
                    'users.cod_estudiante',
                    'users.telefono',
                    'asistencia_eventos.estado',
                    'asistencia_eventos.rol'
                    // Agrega más campos según sea necesario
                )
                ->paginate(10);

            // Ahora, $combinedData contendrá la información combinada de asistencias y usuarios
        }
        return view('livewire.lista-participantes', compact('evento', 'combinedData'));
    }
}
