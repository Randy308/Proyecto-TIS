<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = Role::create(['name' => 'administrador']);
        $administrador->save();
        $organizador = Role::create(['name' => 'organizador']);
        $organizador->save();
        $colaborador = Role::create(['name' => 'colaborador']);
        $colaborador->save();
        $usuario_comun = Role::create(['name' => 'usuario común']);
        $usuario_comun->save();
        $coach = Role::create(['name' => 'coach']);
        $coach->save();
        Permission::create(['name' => 'organizador.ver-mis-eventos'])->syncRoles([$administrador, $organizador, $colaborador]);
        Permission::create(['name' => 'organizador.crear-evento'])->syncRoles([$administrador, $organizador]);
        Permission::create(['name' => 'admin.crear-usuario'])->assignRole($administrador);
        Permission::create(['name' => 'admin.eliminar-participante'])->assignRole($administrador);
        Permission::create(['name' => 'admin.eliminar-usuarios'])->assignRole($administrador);
        Permission::create(['name' => 'admin.editar-usuarios'])->assignRole($administrador);
        Permission::create(['name' => 'admin.ver-detalle-usuarios'])->assignRole($administrador);
        Permission::create(['name' => 'admin.crear-auspiciador'])->assignRole($administrador);
        Permission::create(['name' => 'admin.listar-todos-eventos'])->assignRole($administrador);
        Permission::create(['name' => 'admin.listar-todos-usuarios'])->assignRole($administrador);
        Permission::create(['name' => 'admin.crear-roles'])->assignRole($administrador);
        Permission::create(['name' => 'admin.ver-roles'])->assignRole($administrador);
        Permission::create(['name' => 'admin.ver-permisos'])->assignRole($administrador);
        Permission::create(['name' => 'admin.modificar-permisos-rol'])->assignRole($administrador);
        Permission::create(['name' => 'admin.eliminar-rol'])->assignRole($administrador);
        Permission::create(['name' => 'admin.editar-rol'])->assignRole($administrador);
        Permission::create(['name' => 'admin.vincular-rol-usuario'])->assignRole($administrador);
        //eventos
        Permission::create(['name' => 'admin.editar-banner'])->syncRoles([$administrador, $organizador]);
        Permission::create(['name' => 'admin.editar-evento'])->syncRoles([$administrador, $organizador]);
        Permission::create(['name' => 'admin.eliminar-evento'])->syncRoles([$administrador, $organizador]);
        Permission::create(['name' => 'admin.publicar-evento'])->syncRoles([$administrador, $organizador]);
        Permission::create(['name' => 'admin.cancelar-evento'])->syncRoles([$administrador, $organizador]);
        //perfil
        Permission::create(['name' => 'admin.ver-perfil'])->assignRole($administrador);
        Permission::create(['name' => 'admin.editar-perfil'])->assignRole($administrador);
        Permission::create(['name' => 'coach.registrar-equipo'])->assignRole($coach);
        Permission::create(['name' => 'colaborador.ver-mis-eventos'])->assignRole([$colaborador]);
    }
}
