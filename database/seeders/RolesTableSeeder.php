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
        Permission::create(['name' => 'admin.editar-banner'])->assignRole($administrador);
        Permission::create(['name' => 'admin.editar-evento'])->assignRole($administrador);
        Permission::create(['name' => 'admin.eliminar-evento'])->assignRole($administrador);
        Permission::create(['name' => 'admin.publicar-evento'])->assignRole($administrador);
        Permission::create(['name' => 'admin.cancelar-evento'])->assignRole($administrador);
        Permission::create(['name' => 'admin.ver-perfil'])->assignRole($administrador);
        Permission::create(['name' => 'admin.editar-perfil'])->assignRole($administrador);
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $admin->assignRole('administrador');

        $organizador = User::create([
            'name' => 'Organizador',
            'email' => 'organizador@example.com',
            'password' => bcrypt('contraseña'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $organizador->assignRole('organizador');

        $colaborador = User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@example.com',
            'password' => bcrypt('contraseña'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $colaborador->assignRole('colaborador');
    }
}
