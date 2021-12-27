<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
            ],
            'image' => [
                'nullable',
                // 'image',
                // 'mimes:jpg,jpeg,png',
            ],
            'parent_id' => [
                'nullable',
                'integer'
            ],
            'status' => [
                'required',
                'integer'
            ],
        ];
    }
}
