@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.product.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th>
                        <td>
                            {{ $product->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.sub_category') }}
                        </th>
                        <td>
                            {{ $product->sub_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.user') }}
                        </th>
                        <td>
                            {{ $product->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.slug') }}
                        </th>
                        <td>
                            {{ $product->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.sku_code') }}
                        </th>
                        <td>
                            {{ $product->sku_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.hsn_code') }}
                        </th>
                        <td>
                            {{ $product->hsn_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.brand') }}
                        </th>
                        <td>
                            {{ $product->brand->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.mrp_price') }}
                        </th>
                        <td>
                            {{ $product->mrp_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.tax_rate') }}
                        </th>
                        <td>
                            {{ $product->tax_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.discount_type') }}
                        </th>
                        <td>
                            {{ App\Models\Product::DISCOUNT_TYPE_SELECT[$product->discount_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.discount') }}
                        </th>
                        <td>
                            {{ $product->discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.sales_price') }}
                        </th>
                        <td>
                            {{ $product->sales_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.in_stock') }}
                        </th>
                        <td>
                            {{ App\Models\Product::IN_STOCK_SELECT[$product->in_stock] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.is_bulk') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->is_bulk ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.is_exclusive') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->is_exclusive ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.is_featured') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->is_featured ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.is_new') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $product->is_new ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.has_varient') }}
                        </th>
                        <td>
                            {{ App\Models\Product::HAS_VARIENT_SELECT[$product->has_varient] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.front_image') }}
                        </th>
                        <td>
                            @if($product->front_image)
                                <a href="{{ $product->front_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $product->front_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.back_image') }}
                        </th>
                        <td>
                            @if($product->back_image)
                                <a href="{{ $product->back_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $product->back_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.description') }}
                        </th>
                        <td>
                            {!! $product->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.specification') }}
                        </th>
                        <td>
                            {!! $product->specification !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.view_count') }}
                        </th>
                        <td>
                            {{ $product->view_count }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.product.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Product::STATUS_SELECT[$product->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection