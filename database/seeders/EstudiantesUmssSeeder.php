<?php

namespace Database\Seeders;

use App\Models\EstudiantesUmss;
use App\Models\User;
use Illuminate\Database\Seeder;

class EstudiantesUmssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'institucion_id' => 1,
            'cod_estudiante' => rand ( 201010000 , 202312012 ),
            'estado' => "Habilitado",
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $admin->assignRole('administrador');

        $organizador = User::create([
            'name' => 'Organizador',
            'email' => 'organizador@example.com',
            'password' => bcrypt('password'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
            'cod_estudiante' => rand ( 201010000 , 202312012 ),
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $organizador->assignRole('organizador');

        $colaborador = User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@example.com',
            'password' => bcrypt('password'),
            'institucion_id' => 1,
            'cod_estudiante' => rand ( 201010000 , 202312012 ),
            'estado' => "Habilitado",
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $colaborador->assignRole('colaborador');
        $coach = User::create([
            'name' => 'coach',
            'email' => 'coach@gmail.com',
            'password' => bcrypt('password'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
            'cod_estudiante' => rand ( 201010000 , 202312012 ),
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $coach->assignRole('coach');
        $coach1 = User::create([
            'name' => 'coach1',
            'email' => 'coach1@gmail.com',
            'password' => bcrypt('password'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
            'cod_estudiante' => rand ( 201010000 , 202312012 ),
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $coach1->assignRole('coach');
        $coach2 = User::create([
            'name' => 'coach2',
            'email' => 'coach2@gmail.com',
            'password' => bcrypt('password'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
            'cod_estudiante' => rand ( 201010000 , 202312012 ),
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $coach2->assignRole('coach');
    }
}
