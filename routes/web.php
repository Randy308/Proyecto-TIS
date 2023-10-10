<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;

Route::get('/', function () {
    return view('index');
});

//Ruta de lista de eventos
Route::get('/lista-eventos', [EventoControlador::class, 'listaEventos'])->name('lista-eventos');
Route::post('/home' , [AjaxController::class, 'ajax'])->name('ajax');
Route::get('/pruebas' ,  [AjaxController::class, 'prueba'])->name('ajax-prueba');
Route::get('/crear-evento', [EventoControlador::class, 'crearEventoForm'])->name('crear-evento');
Route::post('/crear-evento', [EventoControlador::class, 'crearEvento'])->name('crear-evento');

