<?php

namespace App\Http\Requests;

use App\Models\ProductAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_attribute_create');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'attribute_value_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
