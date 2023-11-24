<?php

namespace App\Http\Livewire;

use App\Models\Institucion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserAuth extends Component
{
    public function render()
    {   
        $user = User::findOrFail(Auth::id());
        return view('livewire.user-auth',['user'=> $user]);
       
    }
}
