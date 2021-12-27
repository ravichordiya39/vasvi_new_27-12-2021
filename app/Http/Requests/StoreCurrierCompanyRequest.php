<?php

namespace App\Http\Requests;

use App\Models\Size;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCurrierCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          'name' => 'required',
          'email' => 'required|email',
          'website' => 'required|url',
          'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ];
    }
}
