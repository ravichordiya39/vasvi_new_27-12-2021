<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Discount implements Rule
{
    private $error = '';

    public function passes($attribute, $value)
    {
        if (request()->get('discount_type') == 1 && $value > 100) {
            $this->error = 'should be less than or equal to 100';
        } else if (request()->get('discount_type') == 2 && $value > request()->get('mrp_price')) {
            $this->error = 'should be less than to MRP';
        } else {
            return true;
        }

        return false;
    }

    public function message()
    {
        return ":attribute {$this->error}";
    }
}
