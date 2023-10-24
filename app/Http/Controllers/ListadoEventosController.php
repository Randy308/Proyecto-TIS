<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Evento;
//esto no se usa se puede borrar creo
class ListadoEventosController extends Controller
{
    public function index()
    {
        $eventos = Evento::paginate(10); // Pagina los resultados en grupos de 10 elementos por página
        return view('eventos.index', compact('eventos'));
    }
}
