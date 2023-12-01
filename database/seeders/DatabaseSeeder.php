<?php

namespace Database\Seeders;

use App\Models\AsistenciaEvento;
use App\Models\EstudiantesUmss;
use App\Models\Evento;
use App\Models\Institucion;
use App\Models\User;
use App\Models\FaseEvento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $insti = new Institucion();
        $insti->nombre_institucion = 'UMSS';
        $insti->save();
        $insti = new Institucion();
        $insti->nombre_institucion = 'UCB';
        $insti->save();
        $insti = new Institucion();
        $insti->nombre_institucion = 'UPDS';
        $insti->save();
        $insti = new Institucion();
        $insti->nombre_institucion = 'Univalle';
        $insti->save();
        $insti = new Institucion();
        $insti->nombre_institucion = 'EMI';
        $insti->save();
        $inst = DB::table('institucions')->where('nombre_institucion','UMSS')->first();


        $this->call(RolesTableSeeder::class);

        $usuario = new User();
        $usuario->name = 'admin';
        $usuario->email = 'admin@gmail.com';
        $usuario->email_verified_at = now();
        $usuario->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $usuario->telefono = '77777777';
        $usuario->direccion= 'Av. Sucre';
        $usuario->foto_perfil = "/storage/image/default_user_image.png";
        $usuario->historial_Academico = 'Usuario administrador del sistema';
        $usuario->fecha_nac = now();
        $usuario->estado = "Habilitado";
        $usuario->remember_token =  Str::random(10);
        $usuario->institucion_id = $inst->id;
        $usuario->remember_token = Str::random(10);
        $usuario->assignRole('administrador');
        $usuario->save();


        $ev = Evento::factory(10)->create();
        foreach($ev as $e){

            $faseInscripcion = new FaseEvento([
                'evento_id' => $e->id,
                'nombre_fase'=> 'Fase de Inscripción',
                'descripcion_fase' => 'Mientras la fase de inscripción este activa podras incribirte al eveto',
                'fechaInicio' => $e->fecha_inicio->format('Y-m-d').' 00:00:00',
                'fechaFin' => $e->fecha_inicio->format('Y-m-d').' 00:00:00',
                'tipo' => 'Inscripcion',
                'actual'=> true,
                'secuencia'=> 1,
            ]);

            $faseInscripcion->save();
            $faseFinalizacion = new FaseEvento([
                'evento_id' => $e->id,
                'nombre_fase'=> 'Fase de  Cierre',
                'descripcion_fase' => 'El evento ya finalizo, pero aun puedes ver la información del evento',
                'fechaInicio' => $e->fecha_fin->format('Y-m-d').' 00:00:00',
                'fechaFin' => $e->fecha_fin->format('Y-m-d').' 00:00:00',
                'tipo' => 'Finalizacion',
                'actual'=> false,
                'secuencia'=> 1000,
            ]);

            $faseFinalizacion->save();
        }
        $us = User::factory(15)->create();

        $arrayValues = ['Pendiente', 'Habilitado', 'Denegado'];
        foreach($us as $u){

                $u->assignRole('usuario común');
                $asistencia = new AsistenciaEvento();
                $asistencia->user_id = $u->id;
                $asistencia->evento_id = 1;
                $asistencia->rol = "participante";
                $asistencia->fechaInscripcion = now();
                $asistencia->estado = $arrayValues[rand(0,2)];
                $asistencia->save();
        }

        $this->call(FaseSeeder::class);
        $this->call(EstudiantesUmssSeeder::class);

        //usuarios para probar con mis tabla umss
        $usuario2 = new User();
        $usuario2->name = 'n2';
        $usuario2->email = 'n2@gmail.com';
        $usuario2->email_verified_at = now();
        $usuario2->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $usuario2->telefono = '77777777';
        $usuario2->direccion= 'Av. Sucre';
        $usuario2->foto_perfil = "/storage/image/default_user_image.png";
        $usuario2->historial_Academico = '';
        $usuario2->fecha_nac = now();
        $usuario2->estado = "Habilitado";
        $usuario2->remember_token =  Str::random(10);
        $usuario2->institucion_id = $inst->id;
        $usuario2->remember_token = Str::random(10);
        $usuario2->assignRole('usuario común');
        $usuario2->save();

        $usuario3 = new User();
        $usuario3->name = 'n3';
        $usuario3->email = 'n3@gmail.com';
        $usuario3->email_verified_at = now();
        $usuario3->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $usuario3->telefono = '77777777';
        $usuario3->direccion= 'Av. Sucre';
        $usuario3->foto_perfil = "/storage/image/default_user_image.png";
        $usuario3->historial_Academico = '';
        $usuario3->fecha_nac = now();
        $usuario3->estado = "Habilitado";
        $usuario3->remember_token =  Str::random(10);
        $usuario3->institucion_id = $inst->id;
        $usuario3->remember_token = Str::random(10);
        $usuario3->assignRole('usuario común');
        $usuario3->save();

        $usuario4 = new User();
        $usuario4->name = 'n4';
        $usuario4->email = 'n4@gmail.com';
        $usuario4->email_verified_at = now();
        $usuario4->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $usuario4->telefono = '77777777';
        $usuario4->direccion= 'Av. Sucre';
        $usuario4->foto_perfil = "/storage/image/default_user_image.png";
        $usuario4->historial_Academico = '';
        $usuario4->fecha_nac = now();
        $usuario4->estado = "Habilitado";
        $usuario4->remember_token =  Str::random(10);
        $usuario4->institucion_id = $inst->id;
        $usuario4->remember_token = Str::random(10);
        $usuario4->assignRole('usuario común');
        $usuario4->save();
    }
}
