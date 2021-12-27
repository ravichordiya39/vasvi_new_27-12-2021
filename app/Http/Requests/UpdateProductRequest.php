<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Rules\Discount;

class UpdateProductRequest extends FormRequest
{
    public function __construct(Request $request){
        $request->merge(['in_stock' => 1]);

    }

    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            // 'sub_category_id' => [
            //     'required',
            //     'integer',
            // ],
            'name' => [
                'string',
                'max:250',
                'required',
            ],
            // 'slug' => [
            //     'string',
            //     'max:250',
            //     'required',
            //     'unique:products,slug,' . request()->route('product')->id,
            // ],
            'sku_code' => [
                'string',
                'max:50',
                'required',
            ],
            'hsn_code' => [
                'string',
                'max:100',
                'nullable',
            ],
            // 'brand_id' => [
            //     'required',
            //     'integer',
            // ],
            // 'mrp_price' => [
            //     'required',
            // ],
            'tax_rate' => [
                'nullable',
                'numeric'
            ],
            'discount' => [
                'nullable',
                'numeric',
                new Discount
            ],
            'in_stock' => [
                'required',
                'integer'
            ],
            // 'has_varient' => [
            //     'required',
            // ],
            'description' => [
                'required',
            ],
            'status' => [
                'required',
                'integer'
            ],
        ];
    }

    public function messages(){
        return [
            'sku_code.unique' => 'sku code should be unique',
            'category_id.required' => 'Category is required',
            'category_id.integer' => 'Category is required',
            'name.required' => 'Name is required',
            'name.max' => 'Maximum 250 allows character',
            'name.string' => 'Name should be string',
            'sku_code.required' => 'Sku code is required',
            'sku_code.max' => 'Maximum 50 allows character',
            'sku_code.string' => 'Sku code  should be string',
            'hsn_code.max' => 'Maximum 100 allows character',
            'hsn_code.string' => 'Hsn code  should be string',
            'description.required' => 'Description is required',
            'tax_rate.numeric' => 'Should be number',
            'tax_rate.max' => 'Maximum 8 digit long',
            'discount.numeric'  => 'Should be number',
            // 'discount.max'  => 'Maximum 8 digit long',
            'in_stock.integer' => 'Should be integer',
            'in_stock.required' => 'In stock is required',
         //    'has_varient.integer' => 'Should be integer',
         //    'has_varient.required' => 'Has varient is required',
            'status.integer' => 'Status is required',
            'status.required' => 'Status is required',
            // 'gallary.array' => 'Require multiple images'
        ];
     }
}
