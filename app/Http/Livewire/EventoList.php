<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;
use Livewire\WithPagination;
use DateTime;
class EventoList extends Component
{
    use WithPagination;
 

    public function render()
    {
        $eventos = Evento::paginate(9);
        foreach ($eventos as $evento) {
            $evento->FechaInicio = new DateTime($evento->FechaInicio);
            $evento->FechaFin = new DateTime($evento->FechaFin);
        }
        return view('livewire.evento-list',  ['eventos' => $eventos]);
    }
}
