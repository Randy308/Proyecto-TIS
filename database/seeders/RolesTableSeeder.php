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
        $organizador = Role::create(['name' => 'organizador']);
        $colaborador = Role::create(['name' => 'colaborador']);
        $usuario_comun = Role::create(['name' => 'usuario común']);
        Permission::create(['name' => 'usuario.ver-eventos'])->syncRoles([$administrador, $organizador, $colaborador, $usuario_comun]);
        Permission::create(['name' => 'organizador.crear-evento'])->syncRoles([$administrador, $organizador]);
        Permission::create(['name' => 'admin.crear-usuario'])->assignRole($administrador);
        // Permission::create(['name' => 'organizador.crear-evento'])->syncRoles([$administrador,$organizador]);
        // Permission::create(['name' => 'admin.crear-usuario'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.eliminar-usuarios'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.editar-usuarios'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.ver-detalle-usuarios'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.crear-auspiciador'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.listar-todos-eventos'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.listar-todos-usuarios'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.crear-roles'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.ver-roles'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.ver-permisos'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.modificar-permisos-rol'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.eliminar-rol'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.editar-rol'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.vincular-rol-usuario'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.editar-banner'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.editar-evento'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.eliminar-evento'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.publicar-evento'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.cancelar-evento'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.ver-perfil'])->assignRole($administrador);
        // Permission::create(['name' => 'admin.editar-perfil'])->assignRole($administrador);
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
        ]);
        $admin->assignRole('administrador');

        $organizador = User::create([
            'name' => 'Organizador',
            'email' => 'organizador@example.com',
            'password' => bcrypt('contraseña'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
        ]);
        $organizador->assignRole('organizador');

        $colaborador = User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@example.com',
            'password' => bcrypt('contraseña'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
        ]);
        $colaborador->assignRole('colaborador');
    }
}
