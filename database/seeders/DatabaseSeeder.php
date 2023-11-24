<?php

namespace Database\Seeders;

use App\Models\AsistenciaEvento;
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


        

        $us = User::factory(40)->create();

        foreach($us as $u){
                
                $u->assignRole('usuario común');
        }

        $ev = Evento::factory(40)->create();
        foreach($ev as $e){
                
            $faseInscripcion = new FaseEvento([
                'evento_id' => $e->id,
                'nombre_fase'=> 'Fase de Inscripción',
                'descripcion_fase' => 'Mientras la fase de inscripción este activa podras incribirte al eveto',
                'fechaInicio' => $e->fecha_inicio->format('Y-m-d').' 00:00:00',
                'fechaFin' => $e->fecha_inicio->format('Y-m-d').' 00:00:00',
                'tipo' => 'Inscripcion',
                'actual'=> true,  
            ]);
    
            $faseInscripcion->save();
            $faseFinalizacion = new FaseEvento([
                'evento_id' => $e->id,
                'nombre_fase'=> 'Evento Finalizado',
                'descripcion_fase' => 'El evento ya finalizo, pero aun puedes ver la información del evento',
                'fechaInicio' => $e->fecha_fin->format('Y-m-d').' 00:00:00',
                'fechaFin' => $e->fecha_fin->format('Y-m-d').' 00:00:00',
                'tipo' => 'Finalizacion',
                'actual'=> false,  
            ]);
    
            $faseFinalizacion->save();
        }

        AsistenciaEvento::factory(20)->create();
        
    }
}
