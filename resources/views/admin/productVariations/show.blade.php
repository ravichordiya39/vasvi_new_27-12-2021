@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productVariation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-variations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.id') }}
                        </th>
                        <td>
                            {{ $productVariation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.product') }}
                        </th>
                        <td>
                            {{ $productVariation->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.color') }}
                        </th>
                        <td>
                            {{ $productVariation->color->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.size') }}
                        </th>
                        <td>
                            {{ $productVariation->size->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.mrp_price') }}
                        </th>
                        <td>
                            {{ $productVariation->mrp_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.sales_price') }}
                        </th>
                        <td>
                            {{ $productVariation->sales_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.front_image') }}
                        </th>
                        <td>
                            @if($productVariation->front_image)
                                <a href="{{ $productVariation->front_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $productVariation->front_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.back_image') }}
                        </th>
                        <td>
                            @if($productVariation->back_image)
                                <a href="{{ $productVariation->back_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $productVariation->back_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.in_stock') }}
                        </th>
                        <td>
                            {{ App\Models\ProductVariation::IN_STOCK_SELECT[$productVariation->in_stock] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productVariation.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\ProductVariation::STATUS_SELECT[$productVariation->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-variations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection