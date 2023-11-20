<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    use WithPagination;

    public $search='';

    protected $paginationTheme = 'bootstrap';


    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $roles = Role::where('name','LIKE','%' . $this->search . '%')->paginate();

        return view('livewire.role-index', compact('roles'));
    }
}



