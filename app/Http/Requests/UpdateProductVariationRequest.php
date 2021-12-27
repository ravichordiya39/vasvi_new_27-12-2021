<?php

namespace App\Http\Requests;

use App\Models\ProductVariation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductVariationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_variation_edit');
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
            'in_stock' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
