<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreMapAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('map_attribute_create');
    }

    public function rules()
    {
        return [
            'sub_category_id' => [
                'integer',
                'required',
            ],
            'category_id' => [
                'integer',
                'required'
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
