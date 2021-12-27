<?php

namespace App\Http\Requests;

use App\Models\Color;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateColorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('color_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
            ],
            'value' => [
                'string',
                'max:100',
                'required',
                'unique:colors,value,' . request()->route('color')->id,
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
