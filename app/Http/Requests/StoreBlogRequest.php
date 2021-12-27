<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blog_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:200',
                'required',
            ],
            'sub_title' => [
                'string',
                'max:200',
                'required',
            ],
            'slug' => [
                'string',
                'max:100',
                'required',
            ],
            'image' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'meta_title' => [
                'string',
                'max:250',
                'nullable',
            ],
            'tags' => [
                'string',
                'max:300',
                'nullable',
            ],
            'published_on' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
