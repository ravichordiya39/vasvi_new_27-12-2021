@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.coupon.title_singular') }}
            <a class="btn btn-secondary float-right" href="{{ route('admin.coupons.index') }}">
                {{ trans('global.back') }}
            </a>
        </div>

        <div class="card-body">
            <div class="form-group">
                {{-- <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.coupons.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div> --}}
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.id') }}
                            </th>
                            <td>
                                {{ $coupon->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.customer') }}
                            </th>
                            <td>
                                {{ $coupon->customer->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.coupon_type') }}
                            </th>
                            <td>
                                {{ App\Models\Coupon::COUPON_TYPE_SELECT[$coupon->coupon_type] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.user_type') }}
                            </th>
                            <td>
                                {{ App\Models\Coupon::USER_TYPE_SELECT[$coupon->user_type] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.discount_type') }}
                            </th>
                            <td>
                                {{ App\Models\Coupon::DISCOUNT_TYPE_SELECT[$coupon->discount_type] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.value') }}
                            </th>
                            <td>
                                {{ $coupon->value }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.valid_from') }}
                            </th>
                            <td>
                                {{ $coupon->valid_from }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.valid_to') }}
                            </th>
                            <td>
                                {{ $coupon->valid_to }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.coupon_name') }}
                            </th>
                            <td>
                                {{ $coupon->coupon_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.min_cart_amt') }}
                            </th>
                            <td>
                                {{ $coupon->min_cart_amt }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.code') }}
                            </th>
                            <td>
                                {{ $coupon->code }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.max_discount') }}
                            </th>
                            <td>
                                {{ $coupon->max_discount }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.image') }}
                            </th>
                            <td>
                                @if ($coupon->image)
                                    <a href="{{ $coupon->photo->url }}" target="_blank"
                                        style="display: inline-block">
                                        <img src="{{ $coupon->photo->thumb }}">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.is_unlimited') }}
                            </th>
                            <td>
                                <input type="checkbox" disabled="disabled" {{ $coupon->is_unlimited ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.avlb_coupons') }}
                            </th>
                            <td>
                                {{ $coupon->avlb_coupons }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.status') }}
                            </th>
                            <td>
                                {{ App\Models\Coupon::STATUS_SELECT[$coupon->status] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.coupon.fields.term_conditions') }}
                            </th>
                            <td>
                                {!! $coupon->term_conditions !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>



@endsection
