<?php

namespace App\Http\Requests;

use App\Rules\AttributeValue;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attribute_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
                'unique:attributes,name,' . request()->route('attribute')->id,
            ],
            'values' => [
                'nullable',
                // new AttributeValue
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
