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
        EstudiantesUmss::create([
            'nombrecompleto'=>'n1',
            'institucion'=>'UMSS',
            'carrera'=>'Informatica',
            'correo'=>'n1@est.umss.edu',
            'fechaNacimiento'=>'2000-11-10',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n2',
            'institucion'=>'UMSS',
            'carrera'=>'Informatica',
            'correo'=>'n2@est.umss.edu',
            'fechaNacimiento'=>'2000-08-01',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n3',
            'institucion'=>'UMSS',
            'carrera'=>'Sistemas',
            'correo'=>'n3@est.umss.edu',
            'fechaNacimiento'=>'2000-03-11',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n4',
            'institucion'=>'UMSS',
            'carrera'=>'Sistemas',
            'correo'=>'n4@est.umss.edu',
            'fechaNacimiento'=>'2000-07-21',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n5',
            'institucion'=>'UMSS',
            'carrera'=>'Informatica',
            'correo'=>'n5@est.umss.edu',
            'fechaNacimiento'=>'2000-01-18',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n6',
            'institucion'=>'UMSS',
            'carrera'=>'Informatica',
            'correo'=>'n6@est.umss.edu',
            'fechaNacimiento'=>'2000-03-18',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n7',
            'institucion'=>'UMSS',
            'carrera'=>'Informatica',
            'correo'=>'n7@est.umss.edu',
            'fechaNacimiento'=>'2000-04-18',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n8',
            'institucion'=>'UMSS',
            'carrera'=>'Informatica',
            'correo'=>'n8@est.umss.edu',
            'fechaNacimiento'=>'2000-04-18',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n9',
            'institucion'=>'UMSS',
            'carrera'=>'Sistemas',
            'correo'=>'n9@est.umss.edu',
            'fechaNacimiento'=>'2000-07-18',
        ]);
        EstudiantesUmss::create([
            'nombrecompleto'=>'n10',
            'institucion'=>'UMSS',
            'carrera'=>'Sistemas',
            'correo'=>'n10@est.umss.edu',
            'fechaNacimiento'=>'2000-08-18',
        ]);


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
            'password' => bcrypt('contraseña'),
            'institucion_id' => 1,
            'estado' => "Habilitado",
            'cod_estudiante' => rand ( 201010000 , 202312012 ),
            'foto_perfil' => "/storage/image/default_user_image.png",
        ]);
        $organizador->assignRole('organizador');

        $colaborador = User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@example.com',
            'password' => bcrypt('contraseña'),
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
    }
}
