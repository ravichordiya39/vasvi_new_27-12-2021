<?php

namespace App\Http\Requests;

use App\Models\ProductVariation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductVariationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_variation_create');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'color_id' => [
                'required',
                'integer',
            ],
            'size_id' => [
                'required',
                'integer',
            ],
            'mrp_price' => [
                'required',
            ],
            'front_image' => [
                'required',
            ],
            'in_stock' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
