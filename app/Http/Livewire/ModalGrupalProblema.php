<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalGrupalProblema extends Component
{
    public $eventoId;

    public function render()
    {
        return view('livewire.modal-grupal-problema');
    }
}
