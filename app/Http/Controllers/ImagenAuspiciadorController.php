<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Intervention\Image\Facades\Image;
use App\Models\ImagenAuspiciador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use illuminate\Support\Str;

class ImagenAuspiciadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
         $request->validate([
             'url'=>'required|image'
         ]);
         $nombre = Str::random(10) . $request->file('url')->getClientOriginalName();
         $ruta=storage_path() . '\app\public\imgAuspiciadores/' . $nombre;
         Image::make($request->file('url'))
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($ruta);
         ImagenAuspiciador::create([
            'evento_id' =>$id,
            'url'=>'/storage/imgAuspiciadores/' . $nombre
         ]);           
        return redirect()->route('verEvento', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $imgAus = ImagenAuspiciador::where('id',$id)->first(); 
        $url = str_replace('storage', 'public', $imgAus->url);
        Storage::delete($url); 
        $imgAus->delete();
        return redirect()->route('verEvento', ['id' => $imgAus->evento_id]);
    }
}
