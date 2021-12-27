<?php

namespace App\Http\Requests;

use App\Models\Store;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:200',
                'required',
            ],
            'contact_person_name' => [
                'string',
                'max:150',
                'required',
            ],
            'contact_person_number' => [
                'string',
                'max:20',
                'required',
            ],
            'contact_person_designation' => [
                'string',
                'max:100',
                'nullable',
            ],
            'address' => [
                'required',
            ],
            'latitude' => [
                'required',
            ],
            'longitude' => [
                'required',
            ],
            'location' => [
                'required',
            ],
            'city_id' => [
                'required',
            ],
            'image' =>[
              'required',
            ],
            'store_pin_code' => [
                'string',
                'max:10',
                'required',
            ],
            'store_contact' => [
                'string',
                'max:20',
                'required',
            ],
            'open_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'close_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'pin_codes' => [
                'string',
                'max:250',
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
