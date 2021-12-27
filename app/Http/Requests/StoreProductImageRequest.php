<?php

namespace App\Http\Requests;

use App\Models\ProductImage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductImageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_image_create');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'type' => [
                'required',
            ],
            'file_name.*' => [
                'required',
            ],
        ];
    }
}
