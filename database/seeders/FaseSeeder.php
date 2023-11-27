<?php

namespace Database\Seeders;

use App\Models\Fase;
use Illuminate\Database\Seeder;

class FaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fase::create([
            'evento_id' => 1,
            'nombre' => 'Suma de números pares',
            'Descripcion' => 'Escribe una función que reciba como entrada un número entero positivo n 
                                y devuelva la suma de todos los números pares desde 0 hasta n, incluyendo n si este es par.
                                Si n es impar, la función debería considerar la suma hasta el número inmediatamente anterior que sea par a n.
                                Input (Entrada):
                                    Un número entero positivo n.
                                Output (Salida):
                                    La suma de todos los números pares desde 0 hasta n, o hasta el número inmediatamente anterior a n si n es impar.
                                Ejemplos:
                                    Input: n = 6
                                    Output: 12 (ya que la suma de 2 + 4 + 6 = 12)
                                    
                                    Input: n = 11
                                    Output: 30 (ya que la suma de 2 + 4 + 6 + 8 + 10 = 30)',
            'FechaIni' => '2023-11-23',
            'FechaFin' => '2023-11-23',    
        ]);

        Fase::create([
            'evento_id' => 1,
            'nombre' => 'Multiplicacion de números pares',
            'descripcion' => 'Escribe una función que reciba como entrada un número entero positivo n 
                                y devuelva la Multiplicacion de todos los números pares desde 2 hasta n, incluyendo n si este es par.
                                Si n es impar, la función debería considerar la Multiplicacion hasta el número inmediatamente anterior que sea par a n.
                                Input (Entrada):
                                    Un número entero positivo n.
                                Output (Salida):
                                    La Multiplicacion de todos los números pares desde 2 hasta n, o hasta el número inmediatamente anterior a n si n es impar.
                                Ejemplos:
                                    Input: n = 6
                                    Output: 12 (ya que la Multiplicacion de 2 * 4 * 6 = 48)
                                    
                                    Input: n = 11
                                    Output: 30 (ya que la Multiplicacion de 2 * 4 * 6 * 8 * 10 = 3840)',
            'fechaIni' => '2023-11-23',
            'fechaFin' => '2023-11-23',      
        ]);
    }
}
