<?php

namespace Database\Seeders;

use App\Models\EstudiantesUmss;
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
    }
}
