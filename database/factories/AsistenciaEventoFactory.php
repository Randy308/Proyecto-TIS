<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AsistenciaEventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   $arrayValues = ['Activo', 'Finalizado', 'Cancelado'];

        return [
            'user_id'=> $this->faker->unique()->numberBetween(2,30),
            'evento_id'=> 1,
            'rol' => $this->faker->word(),
            'fechaInscripcion'=> now(),
            'estado'=> $arrayValues[rand(0,2)],

        ];
    }
}
