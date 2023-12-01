<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Institucion;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserSearch extends Component
{
    public $email;
    public $users;
    public $evento_id;
    public $evento;
    public $error;
    public $requiereCodSis;
    protected $rules = [
        'users.*.telefono' => 'required|numeric',
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
                    if ($newUsers && $newUsers->email && $newUsers->cod_estudiante  && $newUsers->name && $newUsers->telefono && $newUsers->institucion->nombre_institucion) {
                        if (!$this->users) {
                            $this->users = collect([$newUsers]);  // Convertir a una colección si aún no existe
                        } else {
                            $this->users = $this->users->merge([$newUsers])->unique('id');
                        }
                    } else {
                        $this->error = 'Estudiante no encontrado en la base de datos o datos incompletos.';
                    }
                }

            } else {

                $newUsers = User::where('email', $this->email)->first();
                if ($newUsers && $newUsers->email && $newUsers->name && $newUsers->telefono) {
                    if (!$this->users) {
                        $this->users = collect([$newUsers]);  // Convertir a una colección si aún no existe

                    } else {
                        $this->users = $this->users->merge([$newUsers])->unique('id');
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

    public function removeUser($index)
    {

        if (isset($this->users[$index])) {
            $this->users->forget($index);
        }
    }

}
