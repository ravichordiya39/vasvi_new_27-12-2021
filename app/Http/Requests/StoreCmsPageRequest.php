<?php

namespace App\Http\Requests;

use App\Models\CmsPage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCmsPageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cms_page_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:150',
                'required',
            ],
            'slug' => [
                'string',
                'max:150',
                'nullable',
            ],
            'url' => [
                'string',
                'max:250',
                'nullable',
            ],
            'image' => [
                'string',
                'max:100',
                'nullable',
            ],
            'meta_title' => [
                'string',
                'max:250',
                'nullable',
            ],
            'tags' => [
                'string',
                'max:500',
                'nullable',
            ],
            'description' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
