<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

use App\Rules\Discount;

class StoreProductRequest extends FormRequest {

    public function __construct(Request $request){
        $request->merge(['in_stock' => 1]);

    }
    public function authorize() {
        return Gate::allows('product_create');
    }

    public function rules() {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'max:250',
                'required',
            ],
            'sku_code' => [
                'string',
                'max:50',
                'required',
                'unique:products,sku_code'
            ],
            'hsn_code' => [
                'string',
                'max:100',
                'nullable',
            ],
            'primary' => [
                'required',
                'array',
                'min:1'
            ],
            // 'brand_id' => [
            //     'required',
            //     'integer',
            // ],
            // 'mrp_price' => [
            //     'required',
            // ],
            'description' => [
                'required',
            ],
            // 'front_image' => [
            //     'required',
            //     'image',
            //     'mimes:jpg,jpeg,png',
            // ],
            // 'back_image' => [
            //     'required',
            //     'image',
            //     'mimes:jpg,jpeg,png',
            // ],
            'tax_rate' => [
                'nullable',
                'numeric',
            ],
            'discount' => [
                'nullable',
                'numeric',
                new Discount
            ],
            'in_stock' => [
                'required',
                'integer',
            ],
            // 'has_varient' => [
            //     'required',
            //     'integer',
            // ],
            'gallery' => [
                'nullable',
                'array',
            ],
            'status' => [
                'required',
                'integer',
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
           'discount.numeric'  => 'Should be number',
           'in_stock.integer' => 'Should be integer',
           'in_stock.required' => 'In stock is required',
        //    'has_varient.integer' => 'Should be integer',
        //    'has_varient.required' => 'Has varient is required',
           'status.integer' => 'Status is required',
           'status.required' => 'Status is required',
           'gallary.array' => 'Require multiple images'
       ];
    }
}
