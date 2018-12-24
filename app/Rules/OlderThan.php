<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class OlderThan implements Rule
{
    public $minYear;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($minYear)
    {
        $this->$minYear = $minYear;
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
        $inputtedDate = Carbon::parse($value);
        $yearDifference =  Carbon::now()->diffInYears($inputtedDate);

        if($yearDifference < $this->minYear) return false;

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Must older than ' . $this->minYear;
    }
}
