<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperarCuentaController extends Controller
{

    public function index()
    {   $email = null;
        $currentTab = null;
        return view('recuperar-cuenta' ,compact('email','currentTab'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
