<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use function explode;
use function implode;

class checkPostBodyAndMediaIsEmpty implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $fields;
    public function __construct(array $fields)
    {
        $this->fields = $fields;
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
        // false = error happend
        // true = everything is okk
        $empty = true;


        if($value === "" || $value === null) {
            foreach ($this->fields as $field) {
                if($field === "" || $field === null) {
                    $empty = false;
                } else {
                    $empty = true;
                    break;
                }
            }
            return $empty;
        } else {
            return $empty;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return  'minimum one field require';
    }
}
