<?php

namespace App\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;

class ArrayInt implements Rule
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


    public function parse_int($x)
    {
        $t = (int) $x;
        if (strval($t) == strval($x)) {
            return $t;
        } else {
            throw new \Exception("Not an integer", 1);
        }
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
        try {
            collect($value)->map(fn ($x) => $this->parse_int($x));
            return true;
        } catch (\Exception $err) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Must be an array of integers';
    }
}
