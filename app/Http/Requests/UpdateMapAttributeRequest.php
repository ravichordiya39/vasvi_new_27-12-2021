<?php

namespace App\Http\Requests;

use App\Models\Attribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMapAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('map_attribute_edit');
    }

    public function rules()
    {
        return [
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
