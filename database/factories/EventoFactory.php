<?php

namespace Database\Factories;

use App\Models\Evento;
use App\Models\Institucion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class EventoFactory extends Factory
{
    protected $model = Evento::class;

    public function definition()
    {
        $arrayValues = ['Borrador', 'Activo'];
        $eventTypes = ['Reclutamiento', 'Competencia',  'Taller'];
        $modalidadTypes = ['Individual', 'Grupal'];
        $privacyOptions = ['libre', 'con-restriccion'];
        $instituciones = Institucion::pluck('nombre_institucion')->toArray();
        $nombreInstitucion = $this->faker->randomElement($instituciones);
        $user = DB::table('users')->where('id', 1)->first();

        $nombreEvento = $this->faker->unique()->sentence(3);
        $descripcionEvento = $this->faker->text($this->faker->numberBetween(55, 85));
        $fechaInicio = $this->faker->dateTimeBetween('now', '+30 days');
        $fechaFin = $this->faker->dateTimeBetween($fechaInicio, '+60 days');
        $estado = $arrayValues[rand(0, 1)];
        $privacidad = $privacyOptions[rand(0, 1)];
        $inscritosMinimos = $this->faker->numberBetween(1, 50);
        $inscritosMaximos = $this->faker->numberBetween($inscritosMinimos, 100);
        $tipoEvento = $eventTypes[rand(0,2)];

        return [
            'user_id' => $user->id,
            'nombre_evento' => $nombreEvento,
            'descripcion_evento' => $descripcionEvento,
            'estado' => $estado,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'direccion_banner' => '/storage/image/img-default.jpeg', // Ajusta la ruta de la imagen
            'latitud' => -17.39359989348116,
            'longitud' => -66.14596353915297,
            'background_color' => '#FFFF',
            'modalidad' => $modalidadTypes[rand(0, 1)],
            'tipo_evento' => $tipoEvento,
            'privacidad' => $privacidad,
            'cantidad_minima' => $inscritosMinimos,
            'cantidad_maxima' => $inscritosMaximos,
            'tiempo_inicio' => $this->faker->time('H:i:s'),
            'tiempo_fin' => $this->faker->time('H:i:s'),
            'nombre_institucion' => $nombreInstitucion,
        ];
    }
}

