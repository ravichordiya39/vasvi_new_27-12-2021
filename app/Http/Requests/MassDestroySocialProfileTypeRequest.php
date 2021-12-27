<?php

namespace App\Http\Requests;

use App\Models\SocialProfileType;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySocialProfileTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('social_profile_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:social_profile_types,id',
        ];
    }
}
