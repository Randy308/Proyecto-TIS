<?php

namespace App\Http\Controllers;

use App\Models\Auspiciador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuspiciadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auspiciadores');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [

            'nombre' => ['required','string','regex:/^[a-zA-Z\s]*$/','unique:auspiciadors,nombre'],
            'url' => 'image|max:2048',

        ]);
        $auspiciador = new Auspiciador();
        $auspiciador->nombre = $request->input('nombre');
        $imagen = $request->file('url')->store('public/fotos_usuarios');
        $url = Storage::url($imagen);
        $auspiciador->url = $url;
        $auspiciador->save();
        return redirect()->route('index')->with('status', 'Se agrego un auspiciador exitosamente!.');
        //return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auspiciador  $auspiciador
     * @return \Illuminate\Http\Response
     */
    public function show(Auspiciador $auspiciador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auspiciador  $auspiciador
     * @return \Illuminate\Http\Response
     */
    public function edit(Auspiciador $auspiciador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auspiciador  $auspiciador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auspiciador $auspiciador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auspiciador  $auspiciador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auspiciador $auspiciador)
    {
        //
    }
}
