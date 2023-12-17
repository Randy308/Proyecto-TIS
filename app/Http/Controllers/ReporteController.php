<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function verReportesGenerales() {
        return view('reportes-generales');
    }
    public function verReportesGeneralesMas($eventoId) {
        return view('reportes-generales-mas', ['eventoId' => $eventoId]);
    }
    public function verReportesEspecificos() {
        return view('reportes-especificos');
    }
    public function pdf(){
        $eventos=Evento::all();
        $pdf = Pdf::loadView('pdf',compact('eventos'));
        // return view('pdf');  
        return $pdf->stream();  
    }
}
