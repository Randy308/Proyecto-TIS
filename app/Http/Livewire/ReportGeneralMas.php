<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Livewire\Component;

class ReportGeneralMas extends Component
{
    public $eventoId;


    public function render()
    {
        $evento=Evento::Find($this->eventoId);
        return view('livewire.report-general-mas',compact('evento'));
    }
}
