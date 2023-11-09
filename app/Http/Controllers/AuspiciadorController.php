<?php

namespace App\Http\Controllers;

use App\Models\Auspiciador;
use Illuminate\Http\Request;

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
        return $request;
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
