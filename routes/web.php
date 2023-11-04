<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;
use App\Http\Controllers\AsistenciaEventosController;
use App\Http\Controllers\ElementosBannerController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\RecuperarCuentaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RoleController;



Route::get('/', function () {return view('index');})->name('index');

//Route::post('/crear-evento', [EventoControlador::class, 'crearEvento']);

Route::post('/home' , [AjaxController::class, 'ajax'])->name('ajax');
Route::get('/pruebas' ,  [AjaxController::class, 'prueba'])->name('ajax-prueba');
Route::get('/crear-evento', [EventoControlador::class, 'crearEventoForm'])->middleware('checkRole:administrador,Organizador')->name('crear-evento');

Route::post('/crear-evento', [EventoControlador::class, 'crearEvento'])->name('crear-evento')->middleware('checkRole:administrador,Organizador');

Route::get('/editar-evento', function () {
    return view('editar-evento');
})->name('editar-evento')->middleware('checkRole:administrador,Organizador');


Route::post('/login',[AuthUser::class,'store'])->name('iniciar.sesion.store');


Route::post('/logout',[AuthUser::class,'destroy'])->name('logout');


Route::get('/evento/{id}', [EventoControlador::class, 'show'])->name('verEvento');

Route::get('/lista-eventos', [EventoControlador::class, 'listaEventos'])->name('listaEventos');
Route::put('/registroUsuario/{id}', [AsistenciaEventosController::class, 'create'])->name('registrar-evento-update');

Route::delete('/eliminar/{user}/{evento}', [AsistenciaEventosController::class, 'destroy'])->name('user.delete');


Route::get('/lista-usuarios', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios');
Route::delete('/eliminar-participante/{user_id}/{evento_id}', [AsistenciaEventosController::class, 'eliminarParticipante'])
    ->name('eliminar-participante');

Route::get('/registrarParticipante', [ParticipanteController::class, 'index'])->name('registrar-participante');

Route::post('/registrarParticipante', [ParticipanteController::class, 'store'])->name('registroParticipante.store');

Route::get('/misEventos', function () {return view('eventos-creados');})->name('misEventos');


Route::delete('/eliminarEvento/{user}/{evento}', [EventoControlador::class, 'destroy'])->name('evento.delete')->middleware('checkRole:administrador,Organizador');

Route::get('/editarEvento/{user}/{evento}', [EventoControlador::class, 'edit'])->name('evento.edit')->middleware('checkRole:administrador,Organizador');

Route::put('/editarEvento/{user}/{evento}', [EventoControlador::class, 'update'])->name('evento.update')->middleware('checkRole:administrador,Organizador');

Route::get('/usuario/lista', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios');
Route::get('/usuario/crear', [UsuarioController::class, 'createForm'])->name('crearUsuario');
Route::post('/usuario/crear', [UsuarioController::class, 'store'])->name('crearUsuario.store');
Route::get('/usuario/{id}', [UsuarioController::class, 'show'])->name('verUsuario');
Route::get('/usuario/{id}/editar', [UsuarioController::class, 'editForm'])->name('editarUsuario');
Route::put('/usuario/{id}/editar', [UsuarioController::class, 'edit'])->name('editarUsuario.edit');
Route::get('/lista-usuarios', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios');

Route::post('/guardar-elementos/{evento}', [ElementosBannerController::class, 'store'])->name('crear-elementos-banner');

Route::get('/recuperar-cuenta',[RecuperarCuentaController::class,'index'])->name('recuperar-cuenta');

Route::post('/recuperar-cuenta',[RecuperarCuentaController::class,'enviarEmail'])->name('enviar-email');

Route::post('/actualizar-cuenta', [UsuarioController::class, 'resetPassword'])->name('actualizar-password');

Route::get('/assign-roles', [RoleController::class, 'assignRolesView'])->name('assign-roles');

Route::post('/assign-role', [RoleController::class, 'assignRole'])->name('assign-role');

Route::put('/editarEstado/{user}/{evento}', [EventoControlador::class, 'updateEstado'])->name('evento.state.update')->middleware('checkRole:administrador,Organizador');

Route::get('/editarBanner/{user}/{evento}', [EventoControlador::class, 'editBanner'])->name('evento.banner.edit')->middleware('checkRole:administrador,Organizador');
Route::put('/editarBanner/{user}/{evento}', [EventoControlador::class, 'updateBanner'])->name('evento.banner.update')->middleware('checkRole:administrador,Organizador');
