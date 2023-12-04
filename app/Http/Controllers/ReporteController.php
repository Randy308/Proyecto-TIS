<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function verReportesGenerales() {
        return view('reportes-generales');
    }
    public function verReportesEspecificos() {
        return view('reportes-especificos');
    }
}
