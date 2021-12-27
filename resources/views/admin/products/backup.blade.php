{{-- <input class="form-control" type="hidden" name="category_id" id="category_id"
value="{{ old('category_id', $category_id) }}">
<input class="form-control" type="hidden" name="sub_category_id" id="sub_category_id"
value="{{ old('sub_category_id', $sub_category_id) }}"> --}}

<div class="row">
    <div class="form-group col-4">
        <label class="required" for="optCategory">
            {{ trans('cruds.product.fields.category') }}
        </label>
        <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id"
            id="optCategory" required>
            @foreach ($categories as $id => $entry)
                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                    {{ $entry }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('category'))
            <span class="text-danger">{{ $errors->first('category') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label class="required" for="optSubCategory">
            {{ trans('cruds.product.fields.sub_category') }}
        </label>
        <select class="form-control select2 {{ $errors->has('subcategory_id') ? 'is-invalid' : '' }}"
            name="sub_category_id" id="optSubCategory" required>
            <option value="">
                @lang('global.pleaseSelect')
            </option>
        </select>
        @if ($errors->has('subcategory_id'))
            <span class="text-danger">{{ $errors->first('sub_category_id') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.sub_category_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name"
            value="{{ old('name', '') }}" required>
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label class="required" for="sku_code">{{ trans('cruds.product.fields.sku_code') }}</label>
        <input class="form-control {{ $errors->has('sku_code') ? 'is-invalid' : '' }}" type="text" name="sku_code"
            id="sku_code" value="{{ old('sku_code', '') }}" required>
        @if ($errors->has('sku_code'))
            <span class="text-danger">{{ $errors->first('sku_code') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.sku_code_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label for="hsn_code">{{ trans('cruds.product.fields.hsn_code') }}</label>
        <input class="form-control {{ $errors->has('hsn_code') ? 'is-invalid' : '' }}" type="text" name="hsn_code"
            id="hsn_code" value="{{ old('hsn_code', '') }}">
        @if ($errors->has('hsn_code'))
            <span class="text-danger">{{ $errors->first('hsn_code') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.hsn_code_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label for="optBrand">
            {{ trans('cruds.product.fields.brand') }}
        </label>
        <select class="form-control select2 {{ $errors->has('brand') ? 'is-invalid' : '' }}" name="brand_id"
            id="optBrand">
            <option value="">
                @lang('global.pleaseSelect')
            </option>
        </select>
        @if ($errors->has('brand'))
            <span class="text-danger">{{ $errors->first('brand') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.brand_helper') }}</span>
    </div>

    {{-- @if ($attributes && is_array($attributes))
@foreach ($attributes as $att)
<div class="form-group col-4">
<label>{{ $att->name ?? '' }}</label>
<select class="form-control select2 {{ $errors->has('brand') ? 'is-invalid' : '' }}"
    name="attributes[{{ $att->id }}]" id="attributes{{ $att->id }}">
    @if (isset($att->attributeValues) && $att->attributeValues)
        <option value="">{{ trans('global.pleaseSelect') }}</option>
        @foreach ($att->attributeValues as $atval)
            <option value="{{ $atval->id }}"
                {{ old('attributes[$att->id]') == $atval->id ? 'selected' : '' }}>
                {{ $atval->name }}
            </option>
        @endforeach
    @endif
</select>
</div>
@endforeach
@endif --}}

    <div class="form-group col-4">
        <label class="required" for="optColor">
            {{ trans('cruds.product.fields.color') }}
        </label>
        <select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}" name="color_id"
            id="optColor" required>
            <option value="">
                @lang('global.pleaseSelect')
            </option>
        </select>
        @if ($errors->has('color_id'))
            <span class="text-danger">{{ $errors->first('color_id') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.color_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label class="required" for="optSize">
            {{ trans('cruds.product.fields.size') }}
        </label>
        <select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}" name="sizes[]"
            id="optSize" multiple required>
            <option value="">
                @lang('global.pleaseSelect')
            </option>
        </select>
        @if ($errors->has('color'))
            <span class="text-danger">{{ $errors->first('color') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.color_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label class="required" for="mrp_price">{{ trans('cruds.product.fields.mrp_price') }}</label>
        <input class="form-control {{ $errors->has('mrp_price') ? 'is-invalid' : '' }}" type="number"
            name="mrp_price" id="mrp_price" value="{{ old('mrp_price') }}" step="0.01" required>
        @if ($errors->has('mrp_price'))
            <span class="text-danger">{{ $errors->first('mrp_price') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.mrp_price_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label for="tax_rate">{{ trans('cruds.product.fields.tax_rate') }}</label>
        <input class="form-control {{ $errors->has('tax_rate') ? 'is-invalid' : '' }}" type="number" name="tax_rate"
            id="tax_rate" value="{{ old('tax_rate', '') }}" step="0.01">
        @if ($errors->has('tax_rate'))
            <span class="text-danger">{{ $errors->first('tax_rate') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.tax_rate_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label>{{ trans('cruds.product.fields.discount_type') }}</label>
        <select class="form-control {{ $errors->has('discount_type') ? 'is-invalid' : '' }}" name="discount_type"
            id="discount_type">
            <option value disabled {{ old('discount_type', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}
            </option>
            @foreach (App\Models\Product::DISCOUNT_TYPE_SELECT as $key => $label)
                <option value="{{ $key }}" {{ old('discount_type', '0') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('discount_type'))
            <span class="text-danger">{{ $errors->first('discount_type') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.discount_type_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label for="discount">{{ trans('cruds.product.fields.discount') }}</label>
        <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount"
            id="discount" value="{{ old('discount', '') }}" step="0.01">
        @if ($errors->has('discount'))
            <span class="text-danger">{{ $errors->first('discount') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.discount_helper') }}</span>
    </div>

    <div class="form-group col-2">
        <label class="required">{{ trans('cruds.product.fields.has_varient') }}</label>
        <select class="form-control {{ $errors->has('has_varient') ? 'is-invalid' : '' }}" name="has_varient"
            id="has_varient" required>
            <option value disabled {{ old('has_varient', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}
            </option>
            @foreach (App\Models\Product::HAS_VARIENT_SELECT as $key => $label)
                <option value="{{ $key }}" {{ old('has_varient', '0') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('has_varient'))
            <span class="text-danger">{{ $errors->first('has_varient') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.has_varient_helper') }}</span>
    </div>

    <div class="form-group col-2">
        <label class="required">{{ trans('cruds.product.fields.in_stock') }}</label>
        <select class="form-control {{ $errors->has('in_stock') ? 'is-invalid' : '' }}" name="in_stock" id="in_stock"
            required>
            <option value disabled {{ old('in_stock', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}
            </option>
            @foreach (App\Models\Product::IN_STOCK_SELECT as $key => $label)
                <option value="{{ $key }}" {{ old('in_stock', '1') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('in_stock'))
            <span class="text-danger">{{ $errors->first('in_stock') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.in_stock_helper') }}</span>
    </div>

    <div class="form-group col-2">
        <div class="form-check {{ $errors->has('is_bulk') ? 'is-invalid' : '' }}">
            <input type="hidden" name="is_bulk" value="0">
            <input class="form-check-input" type="checkbox" name="is_bulk" id="is_bulk" value="1"
                {{ old('is_bulk', 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="is_bulk">{{ trans('cruds.product.fields.is_bulk') }}</label>
        </div>
        @if ($errors->has('is_bulk'))
            <span class="text-danger">{{ $errors->first('is_bulk') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.is_bulk_helper') }}</span>
    </div>

    <div class="form-group col-2">
        <div class="form-check {{ $errors->has('is_exclusive') ? 'is-invalid' : '' }}">
            <input type="hidden" name="is_exclusive" value="0">
            <input class="form-check-input" type="checkbox" name="is_exclusive" id="is_exclusive" value="1"
                {{ old('is_exclusive', 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label"
                for="is_exclusive">{{ trans('cruds.product.fields.is_exclusive') }}</label>
        </div>
        @if ($errors->has('is_exclusive'))
            <span class="text-danger">{{ $errors->first('is_exclusive') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.is_exclusive_helper') }}</span>
    </div>

    <div class="form-group col-2">
        <div class="form-check {{ $errors->has('is_featured') ? 'is-invalid' : '' }}">
            <input type="hidden" name="is_featured" value="0">
            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1"
                {{ old('is_featured', 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">{{ trans('cruds.product.fields.is_featured') }}</label>
        </div>
        @if ($errors->has('is_featured'))
            <span class="text-danger">{{ $errors->first('is_featured') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.is_featured_helper') }}</span>
    </div>

    <div class="form-group col-2">
        <div class="form-check {{ $errors->has('is_new') ? 'is-invalid' : '' }}">
            <input type="hidden" name="is_new" value="0">
            <input class="form-check-input" type="checkbox" name="is_new" id="is_new" value="1"
                {{ old('is_new', 0) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="is_new">
                {{ trans('cruds.product.fields.is_new') }}
            </label>
        </div>
        @if ($errors->has('is_new'))
            <span class="text-danger">{{ $errors->first('is_new') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.is_new_helper') }}</span>
    </div>

    <div class="form-group col-2">
        @include('partials.single-image-upload', [
        'input_name' => 'front_image',
        'lable_name' => trans('cruds.product.fields.front_image'),
        'image_view_name' => 'front_image_view',
        'image_error_name' => 'front_image_error',
        'required' => 'required',
        'image_url' => ''
        ])
    </div>

    <div class="form-group col-2">
        @include('partials.single-image-upload', [
        'input_name' => 'back_image',
        'lable_name' => trans('cruds.product.fields.back_image'),
        'image_view_name' => 'back_image_view',
        'image_error_name' => 'back_image_error',
        'required' => 'required',
        'image_url' => ''
        ])
    </div>

    <div class="form-group col-4">
        <label for="description" class="required">{{ trans('cruds.product.fields.description') }}</label>
        <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}"
            name="description" id="description">{!! old('description') !!}</textarea>
        @if ($errors->has('description'))
            <span class="text-danger">{{ $errors->first('description') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label for="specification">{{ trans('cruds.product.fields.specification') }}</label>
        <textarea class="form-control ckeditor {{ $errors->has('specification') ? 'is-invalid' : '' }}"
            name="specification" id="specification">{!! old('specification') !!}</textarea>
        @if ($errors->has('specification'))
            <span class="text-danger">{{ $errors->first('specification') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.specification_helper') }}</span>
    </div>

    <div class="form-group col-4">
        <label class="required">{{ trans('cruds.product.fields.status') }}</label>
        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status"
            required>
            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}
            </option>
            @foreach (App\Models\Product::STATUS_SELECT as $key => $label)
                <option value="{{ $key }}" {{ old('status', '1') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('status'))
            <span class="text-danger">{{ $errors->first('status') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.status_helper') }}</span>
    </div>

    {{-- <div class="row has-varient">
<div class="form-group col-4">
<label class="required" for="color_id">{{ trans('cruds.product.fields.color') }}</label>
<select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}"
name="color_id" id="color_id" required>
<option value="">{{ trans('global.pleaseSelect') }}</option>
@foreach ($colors as $value)
    <option value="{{ $value->id }}">
        {{ $value->name }}
    </option>
@endforeach
</select>
@if ($errors->has('color_id'))
<span class="text-danger">{{ $errors->first('color_id') }}</span>
@endif
<span class="help-block">{{ trans('cruds.product.fields.color_helper') }}</span>
</div>
<div class="form-group col-4">
<label class="required" for="size_id">{{ trans('cruds.product.fields.size') }}</label>
<select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}"
name="size_id" id="size_id" required>
<option value="">{{ trans('global.pleaseSelect') }}</option>
@foreach ($sizes as $value)
    <option value="{{ $value->id }}">
        {{ $value->name ?? '' }} ({{ $value->value ?? '' }})
    </option>
@endforeach
</select>
@if ($errors->has('color'))
<span class="text-danger">{{ $errors->first('color') }}</span>
@endif
<span class="help-block">{{ trans('cruds.product.fields.color_helper') }}</span>
</div>
</div> --}}

    <div class="form-group col-12">
        <label class="required">
            @lang('cruds.product.fields.gallery')
        </label>
        <div class="input-field">
            <div class="input-images" style="padding-top: .5rem;"></div>
        </div>
        @if ($errors->has('status'))
            <span class="text-danger">{{ $errors->first('gallery') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.product.fields.status_helper') }}</span>
    </div>
</div>


<div class="form-group col-4">
    <label for="optBrand">
        {{ trans('cruds.product.fields.brand') }}
    </label>
    <select class="form-control select2 {{ $errors->has('brand') ? 'is-invalid' : '' }}" name="brand_id"
        id="optBrand">
        <option value="">
            @lang('global.pleaseSelect')
        </option>
    </select>
    @if ($errors->has('brand'))
        <span class="text-danger">{{ $errors->first('brand') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.product.fields.brand_helper') }}</span>
</div>

<div class="form-group col-4">
    <label class="required" for="optColor">
        {{ trans('cruds.product.fields.color') }}
    </label>
    <select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}" name="color_id"
        id="optColor" required>
        <option value="">
            @lang('global.pleaseSelect')
        </option>
    </select>
    @if ($errors->has('color_id'))
        <span class="text-danger">{{ $errors->first('color_id') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.product.fields.color_helper') }}</span>
</div>

<div class="form-group col-4">
    <label class="required" for="optSize">
        {{ trans('cruds.product.fields.size') }}
    </label>
    <select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}" name="sizes[]" id="optSize"
        multiple required>
        <option value="">
            @lang('global.pleaseSelect')
        </option>
    </select>
    @if ($errors->has('color'))
        <span class="text-danger">{{ $errors->first('color') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.product.fields.color_helper') }}</span>
</div>

<div class="form-group col-2">
    @include('partials.single-image-upload', [
    'input_name' => 'front_image',
    'lable_name' => trans('cruds.product.fields.front_image'),
    'image_view_name' => 'front_image_view',
    'image_error_name' => 'front_image_error',
    'required' => 'required',
    'image_url' => ''
    ])
</div>

<div class="form-group col-2">
    @include('partials.single-image-upload', [
    'input_name' => 'back_image',
    'lable_name' => trans('cruds.product.fields.back_image'),
    'image_view_name' => 'back_image_view',
    'image_error_name' => 'back_image_error',
    'required' => 'required',
    'image_url' => ''
    ])
</div>

<div class="form-group col-12">
    <label class="required">
        @lang('cruds.product.fields.gallery')
    </label>
    <div class="input-field">
        <div class="input-images" style="padding-top: .5rem;"></div>
    </div>
    @if ($errors->has('status'))
        <span class="text-danger">{{ $errors->first('gallery') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.product.fields.status_helper') }}</span>
</div>

<div class="form-group col-2">
    <label class="required">{{ trans('cruds.product.fields.has_varient') }}</label>
    <select class="form-control {{ $errors->has('has_varient') ? 'is-invalid' : '' }}" name="has_varient"
        id="has_varient" required>
        <option value disabled {{ old('has_varient', null) === null ? 'selected' : '' }}>
            {{ trans('global.pleaseSelect') }}
        </option>
        @foreach (App\Models\Product::HAS_VARIENT_SELECT as $key => $label)
            <option value="{{ $key }}" {{ old('has_varient', 1) == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('has_varient'))
        <span class="text-danger">{{ $errors->first('has_varient') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.product.fields.has_varient_helper') }}</span>
</div>


{{-- @elseif($isCatSelect)
                <div class="row">
                    @foreach ($subcategories as $scat)
                        @if ($scat->scatMapAttribute)
                            <a
                                href="{{ route('admin.products.create', ['category_id' => $scat->parent_id, 'sub_category_id' => $scat->id]) }}">
                                <div class="row">
                                    <h4 class="px-3 py-1 mr-2">
                                        <img src="{{ $scat->thumb_url }}" alt=""><br>
                                        {{ $scat->name }}
                                    </h4>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            @else --}}
{{-- <form method="GET" action="{{ route('admin.products.create') }}" enctype="multipart/form-data">
                    <div class="row"> --}}
{{-- @foreach ($categories as $cat)
                            @if ($cat->subcategories->count())
                                <a href="{{ route('admin.products.create', ['category_id' => $cat->id]) }}">
                                    <div class="row">
                                        <h4 class="px-3 py-1 mr-2">
                                            <img src="{{ $cat->thumb_url }}" alt=""><br>
                                            {{ $cat->name }}
                                        </h4>
                                    </div>
                                </a>
                            @endif
                        @endforeach --}}

{{-- <!-- <div class="form-group col-6">
                        <label class="required" for="category_id">{{ trans('cruds.product.fields.category') }}</label>
                        <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"
                            name="category_id" id="category_id" required>
                            @foreach ($categories as $id => $entry)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category'))
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                    </div>
                    <div class="form-group col-6">
                        <label class="required" for="sub_category_id">{{ trans('cruds.product.fields.sub_category') }}</label>
                        <select class="form-control select2 {{ $errors->has('subcategory_id') ? 'is-invalid' : '' }}" name="sub_category_id" id="sub_category_id" required>
                            @foreach ($subcategories as $id => $entry)
                                <option value="{{ $id }}" style="display:none;" {{ old('sub_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('subcategory_id'))
                            <span class="text-danger">{{ $errors->first('sub_category_id') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.sub_category_helper') }}</span>
                    </div>
                    <div class="row">
                    <div class="col-12 text-right">
                        <button class="btn btn-success" type="submit">
                            {{ trans('global.next') }}
                        </button>
                    </div>
                    </div>
                    --> --}}
{{-- </div>
                </form>
            @endif --}}


<div class="row">
    <div class="form-group col-4">
        <label class="required" for="optBrand">
            {{ trans('cruds.product.fields.brand') }}
        </label>

        <select class="form-control {{ $errors->has('brand') ? 'is-invalid' : '' }}" name="brand_id"
            id="optBrand">
            <option value="">
                @lang('global.pleaseSelect')
            </option>
        </select>

        @if ($errors->has('brand'))
            <span class="text-danger">
                {{ $errors->first('brand') }}
            </span>
        @endif

        <span class="help-block">
            {{ trans('cruds.product.fields.brand_helper') }}
        </span>
    </div>

    <div class="form-group col-4">
        <label class="required" for="optColor">
            {{ trans('cruds.product.fields.color') }}
        </label>

        <select class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" name="color_id"
            id="optColor" required>
            <option value="">
                @lang('global.pleaseSelect')
            </option>
        </select>

        @if ($errors->has('color_id'))
            <span class="text-danger">
                {{ $errors->first('color_id') }}
            </span>
        @endif

        <span class="help-block">
            {{ trans('cruds.product.fields.color_helper') }}
        </span>
    </div>

    <div class="form-group col-4">
        <label class="required" for="optSize">
            {{ trans('cruds.product.fields.size') }}
        </label>

        <select class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" name="sizes[]"
            id="optSize" multiple required>
            <option value="">
                @lang('global.pleaseSelect')
            </option>
        </select>

        @if ($errors->has('color'))
            <span class="text-danger">
                {{ $errors->first('color') }}
            </span>
        @endif

        <span class="help-block">
            {{ trans('cruds.product.fields.color_helper') }}
        </span>
    </div>
</div>
