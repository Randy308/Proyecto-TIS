<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstitucionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $instTypes = [
            'UMSS',
            'Univalle',
            'UCB',
            'UPDS'
        ];
        return [
            'nombre_institucion'=>$instTypes[rand(0,3)],
        ];
    }
}
