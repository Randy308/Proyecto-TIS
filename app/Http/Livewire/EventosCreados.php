<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EventosCreados extends Component
{
    public function render()
    {   $user = User::findOrFail(Auth::id());
        $eventos = $user->eventos()->where('fecha_fin', '>', Carbon::now())->get();
        //$eventos = $user->eventos()->where('fecha_fin', '>', Carbon::now())->where('estado', 'borrador')->get();
        return view('livewire.eventos-creados',['user'=> $user ,'eventos'=> $eventos]);
    }
}
