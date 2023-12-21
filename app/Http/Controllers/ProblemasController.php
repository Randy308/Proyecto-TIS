<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemasController extends Controller
{
    public function verProblemas($id)
    {
        return view('crear-problema',compact('id'));
    }

}
