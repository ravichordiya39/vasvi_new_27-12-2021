<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreSocialProfileTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('social_profile_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
            ],
            'logo' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
