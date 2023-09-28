<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/lista-eventos', [EventoControlador::class, 'crearEventoForm']);//verificar

/*
// Ruta para mostrar el formulario
Route::get('/crear-evento', [EventoControlador::class, 'crearEventoForm']);

// Ruta para procesar el formulario
Route::post('/crear-evento', [EventoControlador::class, 'crearEvento']);
*/

Route::post('/home' , [AjaxController::class, 'ajax'])->name('ajax');
Route::get('/pruebas' ,  [AjaxController::class, 'prueba'])->name('ajax-prueba');
