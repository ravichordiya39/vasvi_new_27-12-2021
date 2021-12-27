<?php

namespace App\Http\Requests;

use App\Rules\AttributeValue;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attribute_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
                'unique:attributes',
            ],
            'description' => [
                'nullable',
            ],
            'values' => [
                'required',
                // new AttributeValue
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
