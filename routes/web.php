<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;

Route::get('/', function () {
    return view('index');
})->name('index');


Route::post('/home', [AjaxController::class, 'ajax'])->name('ajax');
Route::get('/pruebas', [AjaxController::class, 'prueba'])->name('ajax-prueba');

Route::post('/login',[AuthUser::class,'store'])->name('iniciar.sesion.store');
Route::post('/logout',[AuthUser::class,'destroy'])->name('logout');

Route::get('/crear-evento', [EventoControlador::class, 'crearEventoForm'])->name('crear-evento');

Route::post('/agregar-evento', [EventoControlador::class, 'crearEvento'])->name('crear-evento-form');

Route::get('/evento/{id}', [EventoControlador::class, 'show'])->name('verEvento');

Route::get('/lista-eventos', [EventoControlador::class, 'listaEventos'])->name('listaEventos');

Route::put('/registroUsuario/{id}', [EventoControlador::class, 'update'])->name('registrar-evento-update');
