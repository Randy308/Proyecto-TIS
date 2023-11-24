<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;

class EventosDropdown extends Component
{
    public $eventos;
    public $selectedEvento;

    public function mount()
    {
        $this->eventos = Evento::where('tipo_evento', 'reclutamiento')->pluck('nombre', 'id');
    }

    public function render()
    {
        return view('livewire.eventos-dropdown');
    }
}
