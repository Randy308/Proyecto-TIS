<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\FaseEvento;
class FechaMaximaFase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $fechaMaxima;

    public function __construct($eventoId)
    {
        $faseInsc = FaseEvento::where('evento_id', $eventoId)->where('tipo','Finalizacion')->first();
        $this->fechaMaxima = $faseInsc->fechaInicio;
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
        return $value <= $this->fechaMaxima;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No puede haber una fecha mayor que la fecha de finalizacion del evento';
    }
}
