<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AttributeValue implements Rule
{
    private $error = '';

    public function passes($attribute, $value)
    {
        if (count(explode(',', $value)) !== count(array_unique(explode(',', $value)))) {
            $this->error = 'Please enter unique values';
        } else {
            return true;
        }

        return false;
    }

    public function message()
    {
        return $this->error;
    }
}
