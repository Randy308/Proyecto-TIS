<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\FaseEvento;
use Carbon\Carbon;
class ValidarSuperposicionFechasFases implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $eventoId;
    protected $faseId;
    public function __construct($eventoId,$faseId)
    {
        $this->eventoId = $eventoId;
        $this->faseId = $faseId;
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
            if($fase->id != $this->faseId){
                if( $fase->fechaInicio == $fase->fechaFin){
                    if(Carbon::parse($value['fechaInicio']) < Carbon::parse($fase->fechaInicio) && Carbon::parse($value['fechaFin']) > Carbon::parse($fase->fechaFin) ){
                        return false;
                    }
                }else if(Carbon::parse($value['fechaInicio']) == Carbon::parse($value['fechaFin'])){
                    if(Carbon::parse($fase->fechaInicio) < Carbon::parse($value['fechaInicio'])  && Carbon::parse($fase->fechaFin)  > Carbon::parse($value['fechaFin']) ){
                        return false;
                    }
                }else{
                    if(Carbon::parse($value['fechaInicio']) <= Carbon::parse($fase->fechaInicio) && Carbon::parse($value['fechaFin']) > Carbon::parse($fase->fechaInicio)){//
                        return false;
                    }else if(Carbon::parse($value['fechaInicio']) > Carbon::parse($fase->fechaInicio) && Carbon::parse($value['fechaInicio']) < Carbon::parse($fase->fechaFin) ){
                        return false;
                    }    
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
