<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use DateTime;


class UsuarioList extends Component
{
   protected $paginationTheme = 'bootstrap';
    
    use WithPagination;
    public $search ='';


    public function render()
    {


         $usuarios = User::where('name','LIKE',"%{$this->search}%");


        
         

         $usuarios = $usuarios->paginate(6);

         

        return view('livewire.usuario-list',  [
            'usuarios' => $usuarios]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }
}
