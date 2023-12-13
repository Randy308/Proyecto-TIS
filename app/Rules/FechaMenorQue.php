<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
class FechaMenorQue implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $fechaMaxima;

    public function __construct($fechaMaxima)
    {
        $this->fechaMaxima = Carbon::parse($fechaMaxima);
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
        return Carbon::parse($value) <= $this->fechaMaxima;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La fecha de inicio debe ser menor a la fecha final';
    }
}
