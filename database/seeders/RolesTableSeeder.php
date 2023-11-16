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
        $organizador =Role::create(['name' => 'organizador']);
        $colaborador =Role::create(['name' => 'colaborador']);
        $usuario_comun =Role::create(['name' => 'usuario común']);
        Permission::create(['name' => 'usuario.ver-eventos'])->syncRoles([$administrador,$organizador,$colaborador,$usuario_comun]);
        Permission::create(['name' => 'organizador.crear-evento'])->syncRoles([$administrador,$organizador]);
        Permission::create(['name' => 'admin.crear-usuario'])->assignRole($administrador);
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'institucion_id'=>1,
            'estado'=>"Habilitado",
        ]);
        $admin->assignRole('administrador');

        $organizador = User::create([
            'name' => 'Organizador',
            'email' => 'organizador@example.com',
            'password' => bcrypt('contraseña'),
            'institucion_id'=>1,
            'estado'=>"Habilitado",
        ]);
        $organizador->assignRole('organizador');

        $colaborador = User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@example.com',
            'password' => bcrypt('contraseña'),
            'institucion_id'=>1,
            'estado'=>"Habilitado",
        ]);
        $colaborador->assignRole('colaborador');
    }
}
