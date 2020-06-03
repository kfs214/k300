<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaDashHalf implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return preg_match('/^[\w\.\-]+$/', $value); //半角英数字_.-
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.alpha_dash_half');
    }
}
