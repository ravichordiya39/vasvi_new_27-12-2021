<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest {
    public function authorize() {
        return Gate::allows('category_edit');
    }

    public function rules() {
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
                'integer',
            ],
            // 'size_chart' => [
            //     'required_if:parent_id,>,0',
            // ],
            'status' => [
                'required',
                'integer',
            ],
        ];
    }
}
