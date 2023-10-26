<?php

namespace App\Http\Controllers;

use App\Models\ElementoImagenBanner;
use App\Models\ElementosBanner;
use Illuminate\Http\Request;

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
        $n = 1; // Empieza con el primer índice

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
            $elemento = new ElementosBanner();
            $elemento->evento_id = $id;
            $elemento->text = $elementoBanners['text'];
            $elemento->left = $elementoBanners['left'];
            $elemento->top = $elementoBanners['top'];
            $elemento->text_decoration = $elementoBanners['text-decoration'];
            $elemento->font_style = $elementoBanners['font-style'];
            $elemento->background = $elementoBanners['background'];
            $elemento->color = $elementoBanners['color'];
            $elemento->font_family = $elementoBanners['font-family'];
            $elemento->font_size = $elementoBanners['font-size'];
            $elemento->save();
            // Itera a través de los elementos de $elementoBanners

        }

        foreach ($imagenes as $elementoImagen) {
            $imagen = new ElementoImagenBanner();
            $imagen->evento_id = $id;
            $imagen->left = $elementoImagen['left'];
            $imagen->top = $elementoImagen['top'];
            $imagen->width = $elementoImagen['width'];
            $imagen->height = $elementoImagen['height'];
            $imagen->href = $elementoImagen['href'];
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
