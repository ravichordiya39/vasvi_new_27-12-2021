<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slider_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:150',
                'required',
            ],
            'url' => [
                'string',
                'max:250',
                'nullable',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
