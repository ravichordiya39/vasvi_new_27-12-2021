<?php

namespace App\Http\Requests;

use App\Models\SocialProfileType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSocialProfileTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('social_profile_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
