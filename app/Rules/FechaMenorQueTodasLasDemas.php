<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\FaseEvento;
class FechaMenorQueTodasLasDemas implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $fases;
    protected $fechaFin;
    public function __construct($eventoId, $fechaFin)
    {
        $this->fases = FaseEvento::where('evento_id', $eventoId)->where('tipo','!=','Inscripcion')->get();
        $this->fechaFin = $fechaFin;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $esMenor = true;
        foreach($this->fases as $fase){
            if(!($this->fechaFin <= $fase->fechaInicio) ){
                $esMenor = false;
            }
        }
        return $esMenor;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La fecha de fin perteneciente a la fase de inscripcion debe ser menor a todas las demas';
    }
}
