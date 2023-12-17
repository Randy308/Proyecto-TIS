<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Grupo;
use App\Models\Institucion;
use App\Models\PertenecenGrupo;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserSearch extends Component
{
    public $email;
    public $users;
    public $evento_id;
    public $evento;
    public $error;

    public $requiereCodSis;

    public $nombreEquipo;
    protected $rules = [
        'nombreEquipo' => 'required|unique:grupos,nombre',
    ];
    public function mount()
    {
        $newUsers = User::where('email', Auth::user()->email)->get();
        if (!$this->users) {
            $this->users = $newUsers;
        } else {

            $this->users = $this->users->merge($newUsers)->unique('id');
        }

        $this->evento = Evento::find($this->evento_id);
        if ($this->evento->privacidad == "con-restriccion") {
            $this->requiereCodSis = true;
        } else {
            $this->requiereCodSis = false;
        }
    }

    public function render()
    {
        return view('livewire.user-search');
    }

    public function search()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        if ($this->users->count() < 4) {
            if ($this->evento->privacidad == "con-restriccion" && $this->evento->nombre_institucion) {

                $universidad = Institucion::where('nombre_institucion', $this->evento->nombre_institucion)->firstOrFail();
                if ($universidad) {

                    $newUsers = $universidad->users()->where('email', $this->email)->first();



                    if ($newUsers && $newUsers->email && $newUsers->cod_estudiante && $newUsers->name && $newUsers->telefono && $newUsers->institucion->nombre_institucion) {
                        $grupoExists = Grupo::where('user_id', $newUsers->id)->where('evento_id', $this->evento_id)->exists();
                        $integranteExists = PertenecenGrupo::where('user_id', $newUsers->id)->where('evento_id', $this->evento_id)->exists();
                        if (!$grupoExists && !$integranteExists) {
                            if (!$this->users) {
                                $this->users = collect([$newUsers]);  // Convertir a una colección si aún no existe
                            } else {
                                $this->users = $this->users->merge([$newUsers])->unique('id');
                            }
                        } else {
                            $this->error = 'Estudiante ya se encuentra en un grupo.';
                        }

                        //$this->error = null;
                    } else {
                        $this->error = 'Estudiante no encontrado en la base de datos o datos incompletos.';
                    }
                }
            } else {

                $newUsers = User::where('email', $this->email)->first();



                if ($newUsers && $newUsers->email && $newUsers->name && $newUsers->telefono) {
                    $grupoExists = Grupo::where('user_id', $newUsers->id)->where('evento_id', $this->evento_id)->exists();
                    $integranteExists = PertenecenGrupo::where('user_id', $newUsers->id)->where('evento_id', $this->evento_id)->exists();
                    if (!$grupoExists && !$integranteExists) {
                        if (!$this->users) {
                            $this->users = collect([$newUsers]);  // Convertir a una colección si aún no existe
                        } else {
                            $this->users = $this->users->merge([$newUsers])->unique('id');
                        }
                    } else {
                        $this->error = 'Estudiante ya se encuentra en un grupo.';
                    }
                } else {
                    $this->error = 'Estudiante no encontrado en la base de datos o datos incompletos.';
                }
            }
        } else {
            $this->error = 'Usuario superan el limite de cantidad.';
        }
    }



    public function updateUser($index)
    {
        $user = $this->users[$index];
        $this->validate([
            "users.$index.telefono" => 'required|numeric',
            // Agrega otras reglas de validación según tus necesidades
        ], [], [
            "users.$index.telefono" => 'Teléfono',
            "users.$index.numeric" => 'el Teléfono debe ser numerico.',
        ]);
        try {

            $user->update(['telefono' => $user['telefono']]);
            $this->emit('updateSuccess', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            // Si ocurre un error, puedes agregar el error a la propiedad errors de Livewire
            $this->addError('general', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }
    public function save()
    {
        $this->validate([
            'nombreEquipo' => [
                'required',
                Rule::unique('grupos', 'nombre')->where(function ($query) {
                    return $query->where('evento_id', $this->evento_id);
                }),
                'regex:/^[a-zA-Z0-9\s\.\-]+$/',
            ],
        ]);
        $evento = Evento::find($this->evento_id);


        if ($this->users->count() == 4) {

            if ($evento->privacidad == 'libre') {
                $nuevoGrupo = Grupo::create([
                    'nombre' => $this->nombreEquipo,
                    'user_id' => auth()->user()->id,
                    'evento_id' => $this->evento_id,
                    'estado' => "Habilitado"
                ]);
            } else {

                $nuevoGrupo = Grupo::create([
                    'nombre' => $this->nombreEquipo,
                    'user_id' => auth()->user()->id,
                    'evento_id' => $this->evento_id,
                    'estado' => "Pendiente"
                ]);
            }

            foreach ($this->users as $user) {
                PertenecenGrupo::create([
                    'user_id' => $user->id,
                    'grupo_id' => $nuevoGrupo->id,
                    'evento_id' => $this->evento_id,
                ]);
            }
            //$this->error = 'Los datos del evento se han actualizado con éxito.';
            return redirect()->route('verEvento', ['id' => $this->evento_id])->with('status', 'Se ha registrado el grupo al evento con éxito.');
        } else {
            $this->error = 'Cantidad de participantes incorrecta.';
        }
    }

    public function removeUser($index)
    {

        if (isset($this->users[$index])) {
            $this->users->forget($index);
        }
    }
}
