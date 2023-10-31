<?php

namespace Database\Seeders;

use App\Models\AsistenciaEvento;
use App\Models\Evento;
use App\Models\Institucion;
use App\Models\User;
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

        $usuario = new User();
        $usuario->name = 'admin';
        $usuario->email = 'admin@gmail.com';
        $usuario->email_verified_at = now();
        $usuario->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $usuario->institucion_id = $inst->id;
        $usuario->remember_token = Str::random(10);
        $usuario->save();

        User::factory(40)->create();
        Evento::factory(40)->create();
        AsistenciaEvento::factory(20)->create();
        $this->call(RolesTableSeeder::class);
    }
}
