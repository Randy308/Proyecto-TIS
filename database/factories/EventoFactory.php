<?php

namespace Database\Factories;
use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventoFactory extends Factory
{
    protected $model = Evento::class;

    public function definition()
    {
        $arrayValues = ['Borrador', 'Activo', 'Finalizado', 'Cancelado'];
        $eventTypes = ['Diseño', 'QA', 'Desarrollo', 'Ciencia de datos'];

        $user = DB::table('users')->where('id', 1)->first();

        $nombreEvento = $this->faker->unique()->sentence(3);
        $descripcionEvento = $this->faker->text($this->faker->numberBetween(55, 85));
        $categoria = $eventTypes[rand(0, 3)];
        $fechaInicio = $this->faker->dateTimeBetween('now', '+30 days');
        $fechaFin = $this->faker->dateTimeBetween($fechaInicio, '+60 days');
        $estado = $arrayValues[rand(0, 3)];

        // Define los atributos del evento según las restricciones de validación
        return [
            'user_id' => $user->id,
            'direccion_banner' => '/storage/image/img-default.jpeg',
            'nombre_evento' => $nombreEvento,
            'descripcion_evento' => $descripcionEvento,
            'categoria' => $categoria,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'estado' => $estado,
            'background_color' => '#FFFF'
        ];
    }
}


