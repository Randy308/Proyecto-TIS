<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function ajax(Request $request){
        $users = DB::table('users')->select('name','email','id')->get();
        return json_encode($users);
    }
    public function prueba(Request $request){

        return "hola";
    }
}
