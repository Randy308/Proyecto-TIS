<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'administrador']);
        Role::create(['name' => 'organizador']);
        Role::create(['name' => 'colaborador']);
        Role::create(['name' => 'usuario común']);

        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'institucion_id'=>1,
        ]);
        $admin->assignRole('administrador');

        $organizador = User::create([
            'name' => 'Organizador',
            'email' => 'organizador@example.com',
            'password' => bcrypt('contraseña'),
            'institucion_id'=>1,
        ]);
        $organizador->assignRole('organizador');

        $colaborador = User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@example.com',
            'password' => bcrypt('contraseña'),
            'institucion_id'=>1,
        ]);
        $colaborador->assignRole('colaborador');
    }
}