<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Livewire\Component;

class CrearProblem extends Component
{
    public $eventoId;
    public $isModalOpen=false;

    protected $listeners = ['openModalCrearProblem' => 'openModal'];

    public function openModal(){
        if($this->isModalOpen == false){
            $this->isModalOpen = true;
        }else{
            $this->isModalOpen = false;
        }
    }
    public function render()
    {
        $evento=Evento::find($this->eventoId);
        return view('livewire.crear-problem',compact('evento'));
    }
}
