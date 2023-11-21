<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Livewire\Component;

class EventoProximo extends Component
{
    public function render()
    {   
        $todayDate = now('GMT-4')->format('Y-m-d');
        $evento = Evento::where('fecha_inicio', '>=', "$todayDate")->where('Estado','=','Activo')->orderBy('fecha_inicio', 'desc')->first();
        return view('livewire.evento-proximo',compact('evento'));
    }
}
