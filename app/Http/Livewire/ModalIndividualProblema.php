<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalIndividualProblema extends Component
{
    public $eventoId;


    public function openModal()
    {
        $this->emit('openModalCrearProblem');
    }
    public function render()
    {
        return view('livewire.modal-individual-problema');
    }
}
