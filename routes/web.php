<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;

Route::get('/', function () {
    return view('index');
});

//Ruta de lista de eventos
Route::get('/lista-eventos', [EventoControlador::class, 'listaEventos']);


// Ruta para mostrar el formulario
Route::get('/crear-evento', [EventoControlador::class, 'crearEventoForm']);

// Ruta para procesar el formulario
Route::post('/crear-evento', [EventoControlador::class, 'crearEvento']);


Route::post('/home' , [AjaxController::class, 'ajax'])->name('ajax');
Route::get('/pruebas' ,  [AjaxController::class, 'prueba'])->name('ajax-prueba');
