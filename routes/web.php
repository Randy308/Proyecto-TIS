<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;

Route::get('/', function () {
    return view('index');
});

// Ruta para mostrar el formulario
Route::get('/crear-evento', [EventoControlador::class, 'crearEventoForm']);

// Ruta para procesar el formulario
Route::post('/crear-evento', [EventoControlador::class, 'crearEvento']);

Route::get('/editar-evento', function () {
    return view('editar-evento');
});