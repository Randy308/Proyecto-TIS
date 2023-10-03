<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;

Route::get('/', function () {
    return view('index');
})->name('index');


Route::post('/home', [AjaxController::class, 'ajax'])->name('ajax');
Route::get('/pruebas', [AjaxController::class, 'prueba'])->name('ajax-prueba');


// Ruta para mostrar el formulario
Route::get('/crear-evento', [EventoControlador::class, 'crearEventoForm'])->name('crear-evento');

// Ruta para procesar el formulario
Route::post('/crear-evento', [EventoControlador::class, 'crearEvento'])->name('crearEventoForm-Post');

Route::get('/evento/{id}', [EventoControlador::class, 'show'])->name('verEvento');

Route::get('/lista-eventos', [EventoControlador::class, 'listaEventos']);

