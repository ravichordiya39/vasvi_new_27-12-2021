<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_edit');
    }

    public function rules()
    {
        return [
            'coupon_type' => [
                'required',
            ],
            'user_type' => [
                'required',
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
                'unique:coupons,code,'.$this->coupon->id,
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
        ];
    }
}
