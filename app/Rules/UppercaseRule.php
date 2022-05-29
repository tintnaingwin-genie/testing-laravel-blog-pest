<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UppercaseRule implements Rule
{
    public function passes($attribute, $value)
    {
        return $value === strtoupper($value);
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
