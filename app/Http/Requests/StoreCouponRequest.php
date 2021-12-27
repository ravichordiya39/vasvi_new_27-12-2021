<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_create');
    }

    public function rules()
    {
        return [
            'coupon_type' => [
                'required',
            ],
            'user_type' => [
                'required_if:coupon_type,==,0',
            ],
            'customer_id' => [
                'required_if:coupon_type,==,0',
            ],
            'discount_type' => [
                'required',
            ],
            'value' => [
                'numeric',
                'required',
            ],
            'valid_from' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'valid_to' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'coupon_name' => [
                'string',
                'max:100',
                'required',
            ],
            'min_cart_amt' => [
                'numeric',
            ],
            'code' => [
                'string',
                'max:20',
                'required',
                'unique:coupons',
            ],
            'max_discount' => [
                'numeric',
            ],
            'avlb_coupons' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status' => [
                'required',
            ],
            'image' => [
                'required',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048'
            ]
        ];
    }

    public function messages(){
        return[
            'coupon_type.required'=>'Field is required',
            'user_type.required_if'=> 'Field is required',
            'customer_id.required_if' => 'Field is required',
            'discount_type.required'=> 'Field is required',
            'value.numeric' => 'Must be numeric',
            'value.required' => 'Field is required',
            'valid_from.date_format' => 'Invalid date format',
            'valid_to.date_format' => 'Invalid date format',
            'coupon_name.string' => 'Must be string',
            'coupon_name.max' => 'Maximum 100 character long',
            'coupon_name.required' => 'Field is required',
            'min_cart_amt.numeric' => 'Must be numeric',
            'code.string' => 'Must be string',
            'code.max' => 'Maximum 20 character long',
            'code.required' => 'Field is required',
            'code.unique' => 'Must be unique',
            'max_discount.numeric' => 'Must be numeric',
            'avlb_coupons.required' => 'Field is required',
            'avlb_coupons.integer' => 'Must be numeric',
            'avlb_coupons.min' => 'Minimum 0 coupon',
            'avlb_coupons.max' => 'Maximum 100 coupon',
            'status.required' => 'Field is required',
            'image.required' => 'Field is required',
            'image.mimes' => 'File should be image with .jpeg,.png,.jpg,.gif,.svg',
            'image.max' => 'Maximum image size should be 2mb'
        ];
    }
}
