<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use DateTime;

class ListaColaboradores extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    use WithPagination;
    public function render()
    {
        $usuarios = User::where('name', 'LIKE', "%{$this->search}%")->role('Colaborador');
        $usuarios = $usuarios->paginate(10);
        return view('livewire.lista-colaboradores', ['usuarios' => $usuarios]);
    }
}
