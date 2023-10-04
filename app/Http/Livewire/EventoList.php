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
            $evento->fecha_inicioaInicio = new DateTime($evento->fecha_inicio);
            $evento->fecha_fin = new DateTime($evento->fecha_fin);
        }
        return view('livewire.evento-list',  ['eventos' => $eventos]);
    }
}
