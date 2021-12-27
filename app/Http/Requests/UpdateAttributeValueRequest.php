<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeValueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attribute_value_edit');
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
                'required',
            ],
        ];
    }
}
