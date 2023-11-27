<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Grupo;
use App\Models\PertenecenGrupo;
use App\Models\User;

class RegistrarGrupo extends Component
{
    public $showModal = false;
    public $nombre;
    public $nombre1,$nombre2,$nombre3,$nombre4;
    public $email1,$email2,$email3,$email4;
    public $telefono1,$telefono2,$telefono3,$telefono4;
    public $fechaNacimiento1,$fechaNacimiento2,$fechaNacimiento3,$fechaNacimiento4;
    public $user_id;
    public $evento_id;

    protected $rules=[
        'nombre'=>'required|unique:grupos,nombre'
    ];
    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'nombre.unique' => 'El nombre ya está en uso',
    ];

    // protected $listeners=['evento'=>'ejecutarfuncion'];

    public function mount(){
        if(auth()->check()) {
            $user = auth()->user();
            $this->nombre1 = $user->name;
            $this->email1 = $user->email;
            $this->telefono1 = $user->telefono ?? null; // Asegúrate de que el campo exista en tu modelo de usuario
            $this->fechaNacimiento1 = $user->fecha_nac ?? null; // Asegúrate de que el campo exista en tu modelo de usuario
            // Asigna los valores a otras propiedades si es necesario
        }
    }

    public function save(){
        $this->validate();
        $nuevoGrupo = Grupo::create([
            'nombre'=>$this->nombre,
            'user_id'=>auth()->user()->id,
            'evento_id'=>$this->evento_id,
        ]);
        $user_id1=User::where('name',$this->nombre1)
                ->where('email',$this->email1)
                ->where('telefono',$this->telefono1)
                ->where('fecha_nac',$this->fechaNacimiento1)
                ->first()->id;
        $user_id2=User::where('name',$this->nombre2)
                ->where('email',$this->email2)
                ->where('telefono',$this->telefono2)
                ->where('fecha_nac',$this->fechaNacimiento2)
                ->first()->id;
        $user_id3=User::where('name',$this->nombre3)
                ->where('email',$this->email3)
                ->where('telefono',$this->telefono3)
                ->where('fecha_nac',$this->fechaNacimiento3)
                ->first()->id;
        $user_id4=User::where('name',$this->nombre4)
                ->where('email',$this->email4)
                ->where('telefono',$this->telefono4)
                ->where('fecha_nac',$this->fechaNacimiento4)
                ->first()->id;
        PertenecenGrupo::create([
            'user_id'=>$user_id1,
            'grupo_id'=>$nuevoGrupo->id,
        ]);
        PertenecenGrupo::create([
            'user_id'=>$user_id2,
            'grupo_id'=>$nuevoGrupo->id,
        ]);
        PertenecenGrupo::create([
            'user_id'=>$user_id3,
            'grupo_id'=>$nuevoGrupo->id,
        ]);
        PertenecenGrupo::create([
            'user_id'=>$user_id4,
            'grupo_id'=>$nuevoGrupo->id,
        ]);
        
        $this->reset(['nombre','showModal',
                        'nombre1','nombre2','nombre3','nombre4',
                        'email1','email2','email3','email4',
                        'telefono1','telefono2','telefono3','telefono4',
                        'fechaNacimiento1','fechaNacimiento2','fechaNacimiento3','fechaNacimiento4']);
        
        // $this->emit('evento');
        // $this->emitTo('nombre-componente','evento');
        
    }
    public function render()
    {
        return view('livewire.registrar-grupo');
    }
}
