<?php

namespace Database\Factories;

use App\Models\Evento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class EventoFactory extends Factory
{

    protected $model = Evento::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   $arrayValues = ['Borrador','Activo', 'Finalizado', 'Cancelado'];
        $eventTypes = [
            'Diseño',
            'QA',
            'Desarrollo',
            'Ciencia de datos'
        ];
        $user = DB::table('users')->where('id', 1)->first();
        return [
            'user_id'=> $user->id,
            'nombre_evento'=> $this->faker->word(),
            'direccion_banner' => '/storage/image/img-default.jpeg',
            'descripcion_evento'=> $this->faker->text($this->faker->numberBetween(55, 85)),
            'categoria'=>$eventTypes[rand(0,3)],
            'estado'=> $arrayValues[rand(0,3)],
            'fecha_inicio'=> $this->faker->dateTime(),
            'fecha_fin'=> $this->faker->dateTime(),
        ];
    }
}
