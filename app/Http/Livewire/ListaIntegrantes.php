<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Grupo;
use App\Models\PertenecenGrupo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListaIntegrantes extends Component
{
    protected $paginationTheme = 'bootstrap';

    use WithPagination;

    public $grupo_id;
    public $evento_id;
    public function render()
    {
        $grupo = Grupo::find($this->grupo_id);

        if ($grupo) {
            $evento = Evento::find($this->evento_id);
            $integrantes =$grupo->users_pertenecen_grupos;
            // Ahora, $combinedData contendrá la información combinada de asistencias y usuarios
        }   return view('livewire.lista-integrantes',compact('grupo','evento','integrantes'));
    }
}
