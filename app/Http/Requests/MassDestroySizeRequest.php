<?php

namespace App\Http\Requests;

use App\Models\Size;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySizeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sizes,id',
        ];
    }
}
