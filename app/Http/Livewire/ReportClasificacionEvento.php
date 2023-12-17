<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReportClasificacionEvento extends Component
{
    public $eventoId;
    
    public function render()
    {
        return view('livewire.report-clasificacion-evento');
    }
}
