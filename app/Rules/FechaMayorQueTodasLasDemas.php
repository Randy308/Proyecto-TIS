<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\FaseEvento;
class FechaMayorQueTodasLasDemas implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $fases;
    protected $fechaIni;
    public function __construct($eventoId, $fechaIni)
    {
        $this->fases = FaseEvento::where('evento_id', $eventoId)->where('tipo','!=','Finalizacion')->get();
        $this->fechaIni = $fechaIni;
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
        $esMayor = true;
        foreach($this->fases as $fase){
            if(!($this->fechaIni >= $fase->fechaFin) ){
                $esMayor = false;
            }
        }
        return $esMayor;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La fecha de inicio perteneciente a la fase de finalizacion debe ser mayor a todas las demas';
    }
}
