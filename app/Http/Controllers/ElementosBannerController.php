<?php

namespace App\Http\Controllers;

use App\Models\ElementoImagenBanner;
use App\Models\ElementosBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElementosBannerController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request, $id)
    {
        //
        $elementos = [];
        $imagenes = [];
        $n = 1; // Empieza con el primer índice elementos_banners elemento_imagen_banners
        $deleted = DB::table('elementos_banners')->where('evento_id', '=', $id)->delete();
        $deleted = DB::table('elemento_imagen_banners')->where('evento_id', '=', $id)->delete();
        while ($request->has("elemento$n")) {
            $elemento = urldecode($request->input("elemento$n"));
            $elementos[] = json_decode($elemento, true); // Añade true para convertirlo a un array asociativo
            $n++; // Incrementa el índice
        }
        $n = 1; // Empieza con el primer índice

        while ($request->has("imagen$n")) {
            $imagen = urldecode($request->input("imagen$n"));
            $imagenes[] = json_decode($imagen, true); // Añade true para convertirlo a un array asociativo
            $n++; // Incrementa el índice
        }
        foreach ($elementos as $elementoBanners) {
            $miElemento = new ElementosBanner();
            $miElemento->evento_id = $id;
            $miElemento->text = $elementoBanners['text'];
            $miElemento->left = $elementoBanners['left'];
            $miElemento->top = $elementoBanners['top'];
            $miElemento->text_decoration = $elementoBanners['text-decoration'];
            $miElemento->font_style = $elementoBanners['font-style'];
            $miElemento->background = $elementoBanners['background'];
            $miElemento->color = $elementoBanners['color'];
            $miElemento->width = $elementoBanners['width'];
            $miElemento->height = $elementoBanners['height'];
            $miElemento->font_family = $elementoBanners['font-family'];
            $miElemento->font_size = $elementoBanners['font-size'];
            $miElemento->save();
            // Itera a través de los elementos de $elementoBanners

        }

        foreach ($imagenes as $elementoImagen) {
            $imagen = new ElementoImagenBanner();
            $imagen->evento_id = $id;
            $imagen->left = $elementoImagen['left'];
            $imagen->top = $elementoImagen['top'];
            $imagen->width = $elementoImagen['width'];
            $imagen->height = $elementoImagen['height'];
            $imagen->src = $elementoImagen['src'];
            $imagen->save();
            // Itera a través de los elementos de $elementoBanners
        }

        return $elementos;




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
