@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productAttribute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-attributes.update", [$productAttribute->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.productAttribute.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $productAttribute->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productAttribute.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="attribute_value_id">{{ trans('cruds.productAttribute.fields.attribute_value') }}</label>
                <select class="form-control select2 {{ $errors->has('attribute_value') ? 'is-invalid' : '' }}" name="attribute_value_id" id="attribute_value_id" required>
                    @foreach($attribute_values as $id => $entry)
                        <option value="{{ $id }}" {{ (old('attribute_value_id') ? old('attribute_value_id') : $productAttribute->attribute_value->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('attribute_value'))
                    <span class="text-danger">{{ $errors->first('attribute_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productAttribute.fields.attribute_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.productAttribute.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductAttribute::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $productAttribute->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productAttribute.fields.status_helper') }}</span>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection