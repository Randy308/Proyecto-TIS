<?php

namespace Database\Seeders;

use App\Models\AsistenciaEvento;
use App\Models\Evento;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        //'administrador', 'usuario_comun', 'organizador'
        $rol1 = new Rol();
        $rol1->nombre_rol = 'administrador';
        $rol1->descripcion_rol = 'Todas las funcionalidades';
        $rol1->save();
        
        $rol1 = new Rol();
        $rol1->nombre_rol = 'usuario_comun';
        $rol1->descripcion_rol = 'solo participacion y vizualizacion de eventos';
        $rol1->save();

        $rol1 = new Rol();
        $rol1->nombre_rol = 'organizador';
        $rol1->descripcion_rol = 'Puede crear eventos y modificar eventos creados por el mismo';
        $rol1->save();

        $adminrol = DB::table('rols')->where('nombre_rol', 'administrador')->first();

        $usuario = new User();
        $usuario->name = 'admin';
        $usuario->email = 'admin@gmail.com';
        $usuario->email_verified_at = now();
        $usuario->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $usuario->telefono = '77777777';
        $usuario->direccion= 'Av. Sucre';
        $usuario->direccion_foto = "/storage/image/default_user_image.png";
        $usuario->instituto = "Universidad Mayor de San Simon";
        $usuario->historial_Academico = 'Usuario administrador del sistema';
        $usuario->fecha_nac = now();
        $usuario->estado = "Habilitado";
        $usuario->rol_id = $adminrol->id;
        $usuario->remember_token =  Str::random(10);
        $usuario->save();


        

        User::factory(40)->create();
        Evento::factory(40)->create();
        AsistenciaEvento::factory(20)->create();

    }
}
