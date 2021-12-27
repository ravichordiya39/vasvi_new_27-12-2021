<?php

namespace App\Http\Requests;

use App\Models\Size;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSizeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('size_create');
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
                'unique:sizes',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
