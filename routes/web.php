<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;
use App\Http\Controllers\AsistenciaEventosController;
use App\Http\Controllers\AuspiciadorController;
use App\Http\Controllers\ElementosBannerController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\RecuperarCuentaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImagenAuspiciadorController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('index');
})->name('index');

//Route::post('/crear-evento', [EventoControlador::class, 'crearEvento']);

Route::post('/home', [AjaxController::class, 'ajax'])->name('ajax');
Route::get('/pruebas', [AjaxController::class, 'prueba'])->name('ajax-prueba');
Route::get('/crear-evento', [EventoControlador::class, 'index'])->name('crear-evento')->middleware('checkRole:administrador,organizador');
;

Route::post('/crear-evento', [EventoControlador::class, 'crearEvento'])->name('crear-evento')->middleware('checkRole:administrador,organizador');

Route::get('/editar-evento', function () {
    return view('editar-evento');
})->name('editar-evento')->middleware('checkRole:administrador,organizador');


Route::post('/login', [AuthUser::class, 'store'])->name('iniciar.sesion.store');


Route::post('/logout', [AuthUser::class, 'destroy'])->name('logout');


Route::get('/evento/{id}', [EventoControlador::class, 'show'])->name('verEvento');

Route::get('/lista-eventos', [EventoControlador::class, 'listaEventos'])->name('listaEventos');
Route::put('/registroUsuario/{id}', [AsistenciaEventosController::class, 'create'])->name('registrar-evento-update');

Route::delete('/eliminar/{user}/{evento}', [AsistenciaEventosController::class, 'destroy'])->name('user.delete')->middleware('checkRole:administrador,organizador');


Route::get('/lista-usuarios', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios');
Route::delete('/eliminar-participante/{user_id}/{evento_id}', [AsistenciaEventosController::class, 'eliminarParticipante'])
    ->name('eliminar-participante');

Route::get('/registrarParticipante', [ParticipanteController::class, 'index'])->name('registrar-participante');

Route::post('/registrarParticipante', [ParticipanteController::class, 'store'])->name('registroParticipante.store');

Route::get('/misEventos', function () {
    return view('eventos-creados');
})->name('misEventos')->middleware('checkRole:administrador,organizador,colaborador');


Route::delete('/eliminarEvento/{user}/{evento}', [EventoControlador::class, 'destroy'])->name('evento.delete')->middleware('checkRole:administrador,organizador');

Route::get('/editarBanner/{user}/{evento}', [EventoControlador::class, 'editBanner'])->name('evento.banner.edit')->middleware('checkRole:administrador,organizador');
Route::get('/editarEvento/{user}/{evento}', [EventoControlador::class, 'edit'])->name('evento.edit')->middleware('checkRole:administrador,Organizador');

Route::put('/editarEvento/{user}/{evento}', [EventoControlador::class, 'update'])->name('evento.update')->middleware('checkRole:administrador,organizador');

Route::put('/editarBanner/{user}/{evento}', [EventoControlador::class, 'updateBanner'])->name('evento.banner.update')->middleware('checkRole:administrador,organizador');



Route::put('/evento/{id}', [EventoControlador::class, 'guardarMap'])->name('updateMap');

Route::post('/evento/{id}', [ImagenAuspiciadorController::class, 'store'])->name('guardarAus');
Route::delete('/evento/{id}', [ImagenAuspiciadorController::class, 'destroy'])->name('eliminarAus');

Route::get('/usuario/lista', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios')->middleware('checkRole:administrador');
Route::get('/usuario/crear', [UsuarioController::class, 'createForm'])->name('crearUsuario')->middleware('checkRole:administrador');
Route::post('/usuario/crear', [UsuarioController::class, 'store'])->name('crearUsuario.store');
Route::get('/usuario/{id}', [UsuarioController::class, 'show'])->name('verUsuario')->middleware('checkRole:administrador');
Route::get('/usuario/{id}/editar', [UsuarioController::class, 'editForm'])->name('editarUsuario')->middleware('checkRole:administrador');
Route::put('/usuario/{id}/editar', [UsuarioController::class, 'edit'])->name('editarUsuario.edit');
Route::get('/lista-usuarios', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios')->middleware('checkRole:administrador');

Route::post('/guardar-elementos/{evento}', [ElementosBannerController::class, 'store'])->name('crear-elementos-banner');

Route::get('/recuperar-cuenta', [RecuperarCuentaController::class, 'index'])->name('recuperar-cuenta');

Route::post('/recuperar-cuenta', [RecuperarCuentaController::class, 'enviarEmail'])->name('enviar-email');

Route::get('/actualizar-cuenta', function () {
    return view('confirmar-cuenta');
})->name('actualizar-password');

Route::post('/actualizar-cuenta', [UsuarioController::class, 'resetPassword'])->name('actualizar-password');

Route::get('/assign-roles', [RoleController::class, 'assignRolesView'])->name('assign-roles');

Route::post('/assign-role', [RoleController::class, 'assignRole'])->name('assign-role');
Route::get('/acceso-denegado', function () {
    return view('acceso-denegado');
})->name('acceso-denegado');

Route::put('/editarEstado/{user}/{evento}', [EventoControlador::class, 'updateEstado'])->name('evento.state.update')->middleware('checkRole:administrador,Organizador');

Route::get('/editarBanner/{user}/{evento}', [EventoControlador::class, 'editBanner'])->name('evento.banner.edit')->middleware('checkRole:administrador,Organizador');
Route::put('/editarBanner/{user}/{evento}', [EventoControlador::class, 'updateBanner'])->name('evento.banner.update')->middleware('checkRole:administrador,Organizador');

Route::get('/auspiciadores', [AuspiciadorController::class, 'index'])->name('auspiciadores-index');

Route::post('/auspiciadores', [AuspiciadorController::class, 'store'])->name('auspiciador.store');
Route::post('/auspiciadores', [AuspiciadorController::class, 'store'])->name('auspiciador.store');

Route::get('/editarPerfil', function () {
    return view('editar-perfil');
})->name('editarPerfil');

Route::put('/editarPerfil/{user}', [AuthUser::class, 'update'])
    ->name('user.update');

Route::get('/asignarRoles', function () {
    return view('roles');
})->name('asignarRoles');
Route::post('/asignarRoles', [RoleController::class, 'store'])
    ->name('asignarRoles.store');

Route::delete('//eliminarRol/{role}', [RoleController::class, 'destroy'])
    ->name('asignarRoles.delete');
Route::get('/asignarRoles/{user}', [RoleController::class, 'edit'])
    ->name('asignarRoles.edit');
Route::put('/asignarRoles/{user}', [RoleController::class, 'update'])
    ->name('asignarRoles.update');

Route::get('/asignarPermiso/{role}', [PermisoController::class, 'edit'])
    ->name('asignarPermiso.edit');
Route::put('/asignarPermiso/{role}', [PermisoController::class, 'update'])
    ->name('asignarPermiso.update');



Route::get('/perfil/{id}/editar', [UsuarioController::class, 'editUser'])->name('editUser')->middleware('checkRole:administrador');
Route::put('/perfil/{id}/editar', [UsuarioController::class, 'update'])->name('editUser.update');

Route::delete('/eliminar/{user}', [UsuarioController::class, 'destroy'])
    ->name('user.delete');
