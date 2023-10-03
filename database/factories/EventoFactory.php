<?php

namespace Database\Factories;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{

    protected $model = Evento::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   $arrayValues = ['Activo', 'Finalizado', 'Cancelado'];
        return [
            'Titulo'=> $this->faker->name(),
            'DireccionImg' => $this->faker->text(25),
            'Descripcion'=> $this->faker->text(25),
            'Estado'=> $arrayValues[rand(0,2)],
            'FechaInicio'=> $this->faker->dateTime(),
            'FechaFin'=> $this->faker->dateTime(),
        ];
    }
}
