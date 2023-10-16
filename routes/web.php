<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;
use App\Http\Controllers\AsistenciaEventosController;
use App\Http\Controllers\UsuarioController;
Route::get('/', function () {
    return view('index');
})->name('index');;


//Route::post('/crear-evento', [EventoControlador::class, 'crearEvento']);
Route::post('/home' , [AjaxController::class, 'ajax'])->name('ajax');
Route::get('/pruebas' ,  [AjaxController::class, 'prueba'])->name('ajax-prueba');
Route::get('/crear-evento', [EventoControlador::class, 'crearEventoForm'])->name('crear-evento');

Route::post('/crear-evento', [EventoControlador::class, 'crearEvento'])->name('crear-evento');

Route::get('/editar-evento', function () {
    return view('editar-evento');
})->name('editar-evento');


Route::post('/login',[AuthUser::class,'store'])->name('iniciar.sesion.store');
Route::post('/logout',[AuthUser::class,'destroy'])->name('logout');


Route::get('/evento/{id}', [EventoControlador::class, 'show'])->name('verEvento');

Route::get('/lista-eventos', [EventoControlador::class, 'listaEventos'])->name('listaEventos');
Route::put('/registroUsuario/{id}', [AsistenciaEventosController::class, 'create'])->name('registrar-evento-update');

Route::delete('/eliminar/{user}/{evento}', [AsistenciaEventosController::class, 'destroy'])->name('user.delete');

Route::get('/lista-usuarios', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios');