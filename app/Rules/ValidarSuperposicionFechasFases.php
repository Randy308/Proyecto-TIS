<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\FaseEvento;

class ValidarSuperposicionFechasFases implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $eventoId;

    public function __construct($eventoId)
    {
        $this->eventoId = $eventoId;
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
        $fasesEvento = FaseEvento::where('evento_id', $this->eventoId)->get();

        foreach ($fasesEvento as $fase) {

            if( $fase->fechaInicio == $fase->fechaFin){
                if($value['fechaInicio'] < $fase->fechaInicio && $value['fechaFin'] > $fase->fechaFin ){
                    return false;
                }
            }else if($value['fechaInicio'] == $value['fechaFin']){
                if($fase->fechaInicio < $value['fechaInicio']  && $fase->fechaFin  > $value['fechaFin'] ){
                    return false;
                }
            }else{
                if($value['fechaInicio'] <= $fase->fechaInicio && $value['fechaFin'] > $fase->fechaInicio){//
                    return false;
                }else if($value['fechaInicio'] > $fase->fechaInicio && $value['fechaInicio'] < $fase->fechaFin ){
                    return false;
                }    
            }
            
        }

        return true; 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El rango de fechas no puede superponerce entre si.';
    }
}
