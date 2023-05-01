<?php

namespace App\Rules;

use App\Model\Bcourier\BcoDeliveryBoy;
use Illuminate\Contracts\Validation\Rule;

class ValidDeliveryBoy implements Rule
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
        $delivery_boy = BcoDeliveryBoy::where('id', $value);
        if($delivery_boy->count() === 1 && $delivery_boy->first()->status === 'active') return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid delivery boy';
    }
}
