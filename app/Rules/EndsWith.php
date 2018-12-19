<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class EndsWith implements Rule
{
    public $endText;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($endText)
    {
        $this->endText =  $endText;
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
        return Str::endsWith($value,$this->endText);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Must End With ' . $this->endText;
    }
}
