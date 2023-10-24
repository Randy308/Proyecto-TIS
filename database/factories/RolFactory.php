<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Generator as Faker;



class RolFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
             'nombre_rol' => $this->faker->unique()->randomElement(['administrador', 'usuario_comun', 'organizador']),
             'descripcion_rol' => $this->faker->sentence,
        ];
        
    }
}
