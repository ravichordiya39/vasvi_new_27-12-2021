<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest {
    public function authorize() {
        return Gate::allows('brand_create');
    }

    public function rules() {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
                'unique:brands',
            ],
            'logo' => [
                'required',
                // 'image',
                // 'mimes:jpg,jpeg,png',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
