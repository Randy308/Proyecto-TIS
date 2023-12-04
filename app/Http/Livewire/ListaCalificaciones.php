<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListaCalificaciones extends Component
{
    protected $paginationTheme = 'bootstrap';

    use WithPagination;

    public $evento_id;
    public function render()
    {
        $evento = Evento::find($this->evento_id);

        if ($evento) {
            $calificaciones = $evento->calificacions;
            // Ahora, $combinedData contendrá la información combinada de asistencias y usuarios
        }
        return view('livewire.lista-calificaciones',compact('evento','calificaciones'));
    }
}
