<?php

namespace App\Http\Livewire;

use App\Models\EstudiantesUmss;
use Livewire\Component;
use App\Models\Grupo;
use App\Models\PertenecenGrupo;
use App\Models\User;

class RegistrarGrupo extends Component
{
    public $nombreEquipo;
    public $nombre1,$nombre2,$nombre3,$nombre4;
    public $email1,$email2,$email3,$email4;
    public $telefono1,$telefono2,$telefono3,$telefono4;
    public $institucion1,$institucion2,$institucion3,$institucion4;
    public $carrera1,$carrera2,$carrera3,$carrera4;
    public $fechaNacimiento1,$fechaNacimiento2,$fechaNacimiento3,$fechaNacimiento4;
    
    public $evento_id;
    public $error2 = '';
    public $error3 = '';
    public $error4 = '';

    protected $rules=[
        'nombreEquipo'=>'required|unique:grupos,nombre',
        'nombre2' => 'required',
        'nombre3' => 'required',
        'nombre4' => 'required',
        'email2' => 'required|exists:users,email',
        'email3' => 'required|exists:users,email',
        'email4' => 'required|exists:users,email',
        'telefono2' => 'required',
        'telefono3' => 'required',
        'telefono4' => 'required',
        'institucion2' => 'required',
        'institucion3' => 'required',
        'institucion4' => 'required',
        'carrera2' => 'required',
        'carrera3' => 'required',
        'carrera4' => 'required',
        'fechaNacimiento2' => 'required',
        'fechaNacimiento3' => 'required',
        'fechaNacimiento4' => 'required',

    ];
    protected $messages = [
        'nombreEquipo.required' => 'El nombre de equipo es obligatorio',
        'nombreEquipo.unique' => 'El nombre de equipo ya existe',
        'email2.exists' => 'Sin cuenta en el sistema',
        'email3.exists' => 'Sin cuenta en el sistema',
        'email4.exists' => 'Sin cuenta en el sistema',
    ];

    // protected $listeners=['evento'=>'ejecutarfuncion'];

    //se activa cada vez que una propiedad se modifica
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function mount(){
        if(auth()->check()) {
            $user = auth()->user();
            $this->nombre1 = $user->name;
            $this->email1 = $user->email;
            $this->telefono1 = $user->telefono ?? null;
            $this->fechaNacimiento1 = $user->fecha_nac ?? null; 
        }
    }

    public function save(){
        $this->validate();
        // 
        $existe2=EstudiantesUmss::where('nombrecompleto',$this->nombre2)
                                ->where('institucion',$this->institucion2)
                                ->where('carrera',$this->carrera2)->exists();
        $existe3=EstudiantesUmss::where('nombrecompleto',$this->nombre3)
                                ->where('institucion',$this->institucion3)
                                ->where('carrera',$this->carrera3)->exists();
        $existe4=EstudiantesUmss::where('nombrecompleto',$this->nombre4)
                                ->where('institucion',$this->institucion4)
                                ->where('carrera',$this->carrera4)->exists();
        //
        $user2=User::where('email',$this->email2)->first();
        $user3=User::where('email',$this->email3)->first();
        $user4=User::where('email',$this->email4)->first();
        // 
        $this->error2='';
        $this->error3='';
        $this->error4='';
        //
        if(!$existe2){
            $this->error2 = 'Estudiante no encontrado en la base de datos.';    
        }
        if(!$existe3){
            $this->error3 = 'Estudiante no encontrado en la base de datos.';    
        }
        if(!$existe4){
            $this->error4 = 'Estudiante no encontrado en la base de datos.';    
        }
        if($existe2 && $existe3 && $existe4){
            $nuevoGrupo = Grupo::create([
            'nombre'=>$this->nombreEquipo,
            'user_id'=>auth()->user()->id,
            'evento_id'=>$this->evento_id,
            ]);

            PertenecenGrupo::create([
            'user_id'=>auth()->user()->id,
            'grupo_id'=>$nuevoGrupo->id,
            'evento_id'=>$this->evento_id,
            ]);
            PertenecenGrupo::create([
                'user_id'=>$user2->id,
                'grupo_id'=>$nuevoGrupo->id,
                'evento_id'=>$this->evento_id,
            ]);
            PertenecenGrupo::create([
                'user_id'=>$user3->id,
                'grupo_id'=>$nuevoGrupo->id,
                'evento_id'=>$this->evento_id,
            ]);
            PertenecenGrupo::create([
                'user_id'=>$user4->id,
                'grupo_id'=>$nuevoGrupo->id,
                'evento_id'=>$this->evento_id,
            ]);

            $this->reset(['nombreEquipo',
                        'nombre1','nombre2','nombre3','nombre4',
                        'email1','email2','email3','email4',
                        'telefono1','telefono2','telefono3','telefono4',
                        'fechaNacimiento1','fechaNacimiento2','fechaNacimiento3','fechaNacimiento4']);

            return redirect()->route('index');
        }
        // $this->emit('evento');
        // $this->emitTo('nombre-componente','evento');
    }
    public function render()
    {
        return view('livewire.registrar-grupo');
    }
}
