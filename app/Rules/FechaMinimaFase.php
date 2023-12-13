<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\FaseEvento;
use Carbon\Carbon;
class FechaMinimaFase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $fechaMinima;

    public function __construct($eventoId)
    {
        $faseInsc = FaseEvento::where('evento_id', $eventoId)->where('tipo','Inscripcion')->first();
        $this->fechaMinima = Carbon::parse($faseInsc->fechaFin);
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
        
        return Carbon::parse($value) >= $this->fechaMinima;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No puede haber una fecha menor a la fecha de inicio de evento';
    }
}
