<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
class FechaMayorQue implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $fechaMinima;

    public function __construct($fechaMinima)
    {
        $this->fechaMinima = Carbon::parse($fechaMinima);
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
        return 'La fecha de inicio debe ser menor a la fecha final, y mayor a la fecha actual';
    }
}
