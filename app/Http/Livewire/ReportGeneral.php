<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Livewire\Component;

class ReportGeneral extends Component
{
    public function render()
    {
        $eventos = Evento::all();
        return view('livewire.report-general',compact('eventos'));
    }
}
