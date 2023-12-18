<?php

namespace App\Http\Livewire;

use App\Models\FaseEvento;
use Livewire\Component;

class ReportFaseEvento extends Component
{
    public $eventoId;


    public function render()
    {
        $fases=FaseEvento::where('evento_id',$this->eventoId)
                            ->orderBy('fechaInicio')
                            ->get();
        return view('livewire.report-fase-evento',compact('fases'));
    }
}
