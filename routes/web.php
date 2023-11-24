<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoControlador;
use App\Http\Controllers\AsistenciaEventosController;
use App\Http\Controllers\AuspiciadorController;
use App\Http\Controllers\ElementosBannerController;
use App\Http\Controllers\FaseController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\RecuperarCuentaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImagenAuspiciadorController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;


// Route::post('/home', [AjaxController::class, 'ajax'])->name('ajax');
// Route::get('/pruebas', [AjaxController::class, 'prueba'])->name('ajax-prueba');

Route::get('/', function () {
    return view('index');
})->name('index');
Route::get('/login', [AuthUser::class, 'index'])->name('login');
Route::post('/login', [AuthUser::class, 'store'])->name('iniciar.sesion.store');


Route::post('/logout', [AuthUser::class, 'destroy'])->name('logout');


Route::get('/evento/{id}', [EventoControlador::class, 'show'])->name('verEvento');
=======
Route::post('/crear-evento', [EventoControlador::class, 'crearEvento'])->name('crear-evento');
Route::get('/eventos-reclutamiento', [EventoControlador::class, 'obtenerEventosReclutamiento']);



Route::get('/lista-eventos', [EventoControlador::class, 'listaEventos'])->name('listaEventos');

Route::get('/registrarParticipante', [ParticipanteController::class, 'index'])->name('registrar-participante');

Route::post('/registrarParticipante', [ParticipanteController::class, 'store'])->name('registroParticipante.store');


Route::get('/recuperar-cuenta', [RecuperarCuentaController::class, 'index'])->name('recuperar-cuenta');

Route::post('/recuperar-cuenta', [RecuperarCuentaController::class, 'enviarEmail'])->name('enviar-email');


Route::get('/actualizar-cuenta', function () {
    return view('confirmar-cuenta');
})->name('actualizar-password');

Route::get('/evento/{id}', [EventoControlador::class, 'show'])->name('verEvento');
Route::get('/api/eventos', [EventoControlador::class, 'obtenerEventos']);


Route::post('/actualizar-cuenta', [UsuarioController::class, 'resetPassword'])->name('actualizar-password');

//crear evento

Route::group(['middleware' => ['can:organizador.crear-evento']], function () {
    Route::get('/crear-evento', [EventoControlador::class, 'index'])->name('crear-evento');
    Route::post('/crear-evento', [EventoControlador::class, 'crearEvento'])->name('crear-evento');
});



Route::group(['middleware' => ['can:organizador.ver-mis-eventos']], function () {
    Route::get('/misEventos', function () {
        return view('eventos-creados');
    })->name('misEventos');
});



Route::group(['middleware' => ['can:admin.eliminar-participante']], function () {
    Route::delete('/eliminar-participante/{user_id}/{evento_id}', [AsistenciaEventosController::class, 'eliminarParticipante'])
        ->name('eliminar-participante');
});




Route::group(['middleware' => ['can:admin.editar-banner']], function () {
    Route::get('/editarBanner/{user}/{evento}', [EventoControlador::class, 'editBanner'])->name('evento.banner.edit');
    Route::put('/editarBanner/{user}/{evento}', [EventoControlador::class, 'updateBanner'])->name('evento.banner.update');
    Route::post('/guardar-elementos/{evento}', [ElementosBannerController::class, 'store'])->name('crear-elementos-banner');
});



Route::group(['middleware' => ['can:admin.editar-evento']], function () {
    Route::get('/editarEvento/{user}/{evento}', [EventoControlador::class, 'edit'])->name('evento.edit');
    Route::put('/editarEvento/{user}/{evento}', [EventoControlador::class, 'update'])->name('evento.update');
    Route::put('/editarEstado/{user}/{evento}', [EventoControlador::class, 'updateEstado'])->name('evento.state.update');

});


Route::group(['middleware' => ['can:admin.eliminar-evento']], function () {
    Route::delete('/eliminarEvento/{user}/{evento}', [EventoControlador::class, 'destroy'])->name('evento.delete');
});



Route::group(['middleware' => ['can:admin.listar-todos-usuarios']], function () {
    Route::get('/lista-usuarios', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios');
    // Route::get('/usuario/lista', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios');
    // Route::get('/lista-usuarios', [UsuarioController::class, 'listaUsuarios'])->name('listaUsuarios');
});


Route::group(['middleware' => ['can:admin.crear-usuario']], function () {
    Route::get('/usuario/crear', [UsuarioController::class, 'createForm'])->name('crearUsuario');
    Route::post('/usuario/crear', [UsuarioController::class, 'store'])->name('crearUsuario.store');
});


Route::put('/fases/editar{faseId}', [FaseController::class, 'edit'])->name('faseEdit')->middleware('checkRole:administrador,organizador');
Route::post('/fases/{eventoId}/crear', [FaseController::class, 'store'])->name('faseStore')->middleware('checkRole:administrador,organizador');
Route::put('/editarEstado/{user}/{evento}', [EventoControlador::class, 'updateEstado'])->name('evento.state.update');

Route::get('/fases/{evento}',[FaseController::class,'fasesdeEvento'])->name('fases.fasesdeEvento');
Route::get('/editarBanner/{user}/{evento}', [EventoControlador::class, 'editBanner'])->name('evento.banner.edit');
Route::put('/editarBanner/{user}/{evento}', [EventoControlador::class, 'updateBanner'])->name('evento.banner.update');



Route::group(['middleware' => ['can:admin.ver-detalle-usuarios']], function () {
    Route::get('/usuario/{id}', [UsuarioController::class, 'show'])->name('verUsuario');
});


Route::group(['middleware' => ['can:admin.editar-usuarios']], function () {
    Route::get('/usuario/{id}/editar', [UsuarioController::class, 'editForm'])->name('editarUsuario');
    Route::put('/usuario/{id}/editar', [UsuarioController::class, 'edit'])->name('editarUsuario.edit');
});


Route::group(['middleware' => ['can:admin.modificar-permisos-rol']], function () {
    Route::put('/asignarPermiso/{role}', [PermisoController::class, 'update'])
        ->name('asignarPermiso.update');
});
Route::group(['middleware' => ['can:admin.ver-permisos']], function () {
    Route::get('/asignarPermiso/{role}', [PermisoController::class, 'edit'])
        ->name('asignarPermiso.edit');
});

// Route::delete('/eliminar/{user}/{evento}', [AsistenciaEventosController::class, 'destroy'])->name('user.delete');
Route::delete('/eliminar/{user}', [UsuarioController::class, 'destroy'])
->name('user.delete');
Route::group(['middleware' => ['can:admin.eliminar-usuarios']], function () {


});


Route::group(['middleware' => ['can:admin.crear-auspiciador']], function () {

    Route::get('/auspiciadores', [AuspiciadorController::class, 'index'])->name('auspiciadores-index');

    Route::post('/auspiciadores', [AuspiciadorController::class, 'store'])->name('auspiciador.store');
    Route::post('/auspiciadores', [AuspiciadorController::class, 'store'])->name('auspiciador.store');
});

Route::group(['middleware' => ['can:admin.ver-roles']], function () {

    Route::get('/asignarRoles', function () {
        return view('roles');
    })->name('asignarRoles');
    Route::delete('/eliminarRol/{role}', [RoleController::class, 'destroy'])
        ->name('asignarRoles.delete');
    Route::get('/asignarRoles/{user}', [RoleController::class, 'edit'])
        ->name('asignarRoles.edit');
    Route::put('/asignarRoles/{user}', [RoleController::class, 'update'])
        ->name('asignarRoles.update');
});


Route::group(['middleware' => ['can:admin.crear-roles']], function () {
    Route::post('/asignarRoles', [RoleController::class, 'store'])
        ->name('asignarRoles.store');
});
Route::get('/acceso-denegado', function () {
    return view('acceso-denegado');
})->name('acceso-denegado');

// Rutas para usuario authentificado

Route::middleware(['auth'])->group(function () {
    Route::get('/editarPerfil', function () {
        return view('editar-perfil');
    })->name('editarPerfil');
    Route::put('/editarPerfil/{user}', [AuthUser::class, 'update'])->name('user.update');
    Route::get('/perfil/{id}/editar', [UsuarioController::class, 'editUser'])->name('editUser');
    Route::put('/perfil/{id}/editar', [UsuarioController::class, 'update'])->name('editUser.update');
    Route::put('/registroUsuario/{id}', [AsistenciaEventosController::class, 'create'])->name('registrar-evento-update');
    Route::delete('/eliminar/{user}/{evento}', [AsistenciaEventosController::class, 'destroy'])->name('user.abandonar');

});
