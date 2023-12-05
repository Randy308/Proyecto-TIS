<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListaGrupos extends Component
{
    protected $paginationTheme = 'bootstrap';

    use WithPagination;

    public $evento_id;
    public function render()
    {
        $evento = Evento::find($this->evento_id);

        if ($evento) {
            $eventoId = $evento->id;
            $grupos = Grupo::where('evento_id',$this->evento_id)->paginate(20);
            // Ahora, $combinedData contendrá la información combinada de asistencias y usuarios
        }
        return view('livewire.lista-grupos',compact('evento','grupos'));
    }
}
