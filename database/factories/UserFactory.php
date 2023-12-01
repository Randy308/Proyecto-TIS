<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $estados = ['Habilitado','Deshabilitado'];
        $arrayValues = ['Bolivia','Argentina', 'Colombia', 'Brazil'];
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'telefono' => $this->faker->phoneNumber, 
            'direccion' => $this->faker->address, 
            'foto_perfil' => '/storage/image/default_user_image.png', 
            'fecha_nac' => $this->faker->date,
            'estado'=> $estados[rand(0,1)],
            'institucion_id' =>  rand(1,5),
            'pais'=>$arrayValues[rand(0,3)],
            'cod_estudiante'=>$this->faker->randomNumber(9),
            'historial_academico' => $this->faker->text(),
            'remember_token' => Str::random(10),
            
        ];
    }

    
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
