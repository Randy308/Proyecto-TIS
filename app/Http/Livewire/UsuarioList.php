<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use DateTime;


class UsuarioList extends Component
{
   protected $paginationTheme = 'bootstrap';

    use WithPagination;
    public $search ='';
    public $orderb = 0;
    public $filtroRol = '';
    public $filtroEstado= '';
    public function render()
    {


        $usuarios = User::where('name','LIKE',"%{$this->search}%");

        if($this->filtroEstado){
            $usuarios->where('estado',$this->filtroEstado);

        }

        if($this->filtroRol){
            $usuarios->when($this->filtroRol, function ($query) {
                return $query->role($this->filtroRol);
            })->get();
        }

         switch($this->orderb){
            case 0:
                $usuarios->orderBy('created_at', 'desc');
                break;
            case 1:
                $usuarios->orderBy('created_at', 'asc');
                break;
            case 2:
                $usuarios->orderBy('name', 'asc');
                break;
            case 3:
                $usuarios->orderBy('name', 'desc');
                break;

         }

         $usuarios = $usuarios->paginate(6);
         $roles = Role::all();


        return view('livewire.usuario-list',  [
            'usuarios' => $usuarios, 'roles' => $roles]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function getProfileImage($usuario)
    {
        if (file_exists(public_path($usuario->foto_perfil)) && $usuario->foto_perfil != '') {
            return $usuario->foto_perfil;
        } else {
            return '/storage/image/default_user_image.png';
        }
    }

}
