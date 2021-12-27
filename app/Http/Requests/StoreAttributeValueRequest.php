<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeValueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attribute_value_create');
    }

    public function rules()
    {
        return [
            'attribute_id' => [
                'required',
                'integer',
            ],
            'value' => [
                'string',
                'max:100',
                'required',
                'unique:attribute_values',
            ],
        ];
    }
}
