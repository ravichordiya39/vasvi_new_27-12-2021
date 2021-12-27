<?php

namespace App\Http\Requests;

use App\Models\UserSocialProfile;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserSocialProfileRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_social_profile_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_social_profiles,id',
        ];
    }
}
