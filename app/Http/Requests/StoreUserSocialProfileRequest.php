<?php

namespace App\Http\Requests;

use App\Models\UserSocialProfile;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserSocialProfileRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_social_profile_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'social_profile_type_id' => [
                'required',
                'integer',
            ],
            'url' => [
                'string',
                'max:250',
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
