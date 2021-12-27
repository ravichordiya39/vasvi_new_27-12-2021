@extends('layouts.admin')

@section('styles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/image-uploader.css') }}"> --}}
    <script src="{{ asset('assets/editor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/editor/sample.js') }}"></script>
    <script src="{{ asset('assets/editor/sample2.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/editor/toolbarconfigurator/lib/codemirror/neo.css') }}">
    <style>

    #img-cross{
        position:absolute;
        right : -7px;
        top : -7px;
        color : white;
        background-color : grey;
        padding-left: 8px;
        padding-right: 8px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius : 25px;
        cursor:pointer;
    }

    #add-image{
        position:relative;
        min-height : 170px;
    }

    #add-image #img-cross{
        visibility: hidden;
    }

    #add-image:hover #img-cross{
        visibility: visible;
    }

    .btn-circle.btn-sm {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 15px;
        font-size: 8px;
        text-align: center;
    }
    .btn-circle.btn-md {
        width: 50px;
        height: 50px;
        padding: 7px 10px;
        border-radius: 25px;
        font-size: 10px;
        text-align: center;
    }
    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 12px;
        text-align: center;
    }
        .icheck-primary > span{
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
        bottom: 100%;
        right: 50%;
        margin-left: -60px;
        /* padding : 3px; */
        }

        .icheck-primary:hover span{
            visibility: visible;
        }

        .box-danger{
            border : 2px solid red;
        }

    </style>
@endsection

@section('content')
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{dd($errors)}}
    {{exit()}} --}}

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
            <a class="btn btn-secondary float-right" href="{{ route('admin.products.index') }}">
                {{ trans('global.back') }}
            </a>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="product-form">
                @csrf

                <div class="accordion" id="accordionProduct">
                    <div class="card">
                        <div class="card-header" id="productDetails">
                            <button class="btn btn-link text-dark font-weight-bold btn-block text-left text-uppercase"
                                type="button" data-toggle="collapse" data-target="#productDetail" aria-expanded="true"
                                aria-controls="productDetail">
                                @lang('cruds.product.product_details')
                            </button>
                        </div>

                        <div id="productDetail" class="collapse show" aria-labelledby="productDetails"
                            data-parent="#accordionProduct">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label class="required" for="name">
                                            {{ trans('cruds.product.fields.name') }}
                                        </label>

                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            type="text" name="name" id="name" value="{{ old('name', '') }}" required>

                                        @if ($errors->has('name'))
                                            <span class="text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.name_helper') }}
                                        </span>
                                    </div>

                                    <div class="form-group col-3">
                                        <label class="required" for="optCategory">
                                            {{ trans('cruds.product.fields.category') }}
                                        </label>
                                        <select
                                            class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                            name="category_id" id="optCategory" required>
                                            @foreach ($categories as $id => $entry)
                                                <option value="{{ $id }}"
                                                    {{ old('category_id') == $id ? 'selected' : '' }}>
                                                    {{ $entry }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('category'))
                                            <span class="text-danger">{{ $errors->first('category') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.category_helper') }}
                                        </span>
                                    </div>

                                    <div class="form-group col-3">
                                        <label class="required" for="optSubCategory">
                                            {{ trans('cruds.product.fields.sub_category') }}
                                        </label>

                                        <select
                                            class="form-control select2 {{ $errors->has('subcategory_id') ? 'is-invalid' : '' }}"
                                            name="sub_category_id" id="optSubCategory" required>
                                            <option value="">
                                                @lang('global.pleaseSelect')
                                            </option>
                                        </select>

                                        @if ($errors->has('subcategory_id'))
                                            <span class="text-danger">{{ $errors->first('sub_category_id') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.sub_category_helper') }}
                                        </span>
                                    </div>

                                    <div class="form-group col-3" id="child-category">
                                        <label class="required" for="optSubCategoryChild">
                                            {{ trans('cruds.product.fields.sub_child_category') }}
                                        </label>

                                        <select
                                            class="form-control select2 {{ $errors->has('sub_category_child_id') ? 'is-invalid' : '' }}"
                                            name="sub_category_child_id" id="optSubCategoryChild" required>
                                            <option value="">
                                                @lang('global.pleaseSelect')
                                            </option>
                                        </select>

                                        @if ($errors->has('subcategory_id'))
                                            <span class="text-danger">{{ $errors->first('sub_category_child_id') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.sub_category_helper') }}
                                        </span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="required"
                                            for="sku_code">{{ trans('cruds.product.fields.sku_code') }}</label>
                                        <input class="form-control {{ $errors->has('sku_code') ? 'is-invalid' : '' }}"
                                            type="text" name="sku_code" id="sku_code" value="{{ old('sku_code', '') }}"
                                            required style='text-transform:uppercase'>
                                            <!-- get_sku(12) -->
                                        @if ($errors->has('sku_code'))
                                            <span class="text-danger">{{ $errors->first('sku_code') }}</span>
                                        @endif
                                        <span
                                            class="help-block" >{{ trans('cruds.product.fields.sku_code_helper') }}
                                            <span id="sku_help"></span>
                                        </span>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="hsn_code">{{ trans('cruds.product.fields.hsn_code') }}</label>
                                        <input class="form-control {{ $errors->has('hsn_code') ? 'is-invalid' : '' }}"
                                            type="text" name="hsn_code" id="hsn_code" value="{{ old('hsn_code', '') }}">

                                        @if ($errors->has('hsn_code'))
                                            <span class="text-danger">{{ $errors->first('hsn_code') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.hsn_code_helper') }}
                                        </span>
                                    </div>

                                    {{-- <div class="form-group col-4">
                                        <label class="required" for="mrp_price">
                                            {{ trans('cruds.product.fields.mrp_price') }}
                                        </label>

                                        <input class="form-control {{ $errors->has('mrp_price') ? 'is-invalid' : '' }}"
                                            type="text" name="mrp_price" id="txtMRPPrice" value="{{ old('mrp_price') }}"
                                            onkeypress="return isFloat(event)" maxlength="10" required>

                                        @if ($errors->has('mrp_price'))
                                            <span class="text-danger">{{ $errors->first('mrp_price') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.mrp_price_helper') }}
                                        </span>
                                    </div> --}}

                                    <div class="form-group col-4">
                                        <label for="tax_rate">{{ trans('cruds.product.fields.tax_rate') }}</label>

                                        <input class="form-control {{ $errors->has('tax_rate') ? 'is-invalid' : '' }}"
                                            type="number" name="tax_rate" id="tax_rate" value="{{ old('tax_rate', '') }}"
                                            step="0.01">

                                        @if ($errors->has('tax_rate'))
                                            <span class="text-danger">{{ $errors->first('tax_rate') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.tax_rate_helper') }}
                                        </span>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>{{ trans('cruds.product.fields.discount_type') }}</label>
                                        <select
                                            class="form-control {{ $errors->has('discount_type') ? 'is-invalid' : '' }}"
                                            name="discount_type" id="discount_type">
                                            <option value="" disabled
                                                {{ old('discount_type', null) === null ? 'selected' : '' }}>
                                                {{ trans('global.pleaseSelect') }}
                                            </option>

                                            @foreach (App\Models\Product::DISCOUNT_TYPE_SELECT as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ old('discount_type', '0') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('discount_type'))
                                            <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.discount_type_helper') }}
                                        </span>
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="discount">{{ trans('cruds.product.fields.discount') }}</label>
                                        <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                            type="number" name="discount" id="discount" value="{{ old('discount', '') }}"
                                            step="0.01">

                                        @if ($errors->has('discount'))
                                            <span class="text-danger">
                                                {{ $errors->first('discount') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.discount_helper') }}
                                        </span>
                                    </div>

                                    {{-- <div class="col-2">
                                        <div class="icheck-primary {{ $errors->has('is_bulk') ? 'is-invalid' : '' }}">
                                            <input type="checkbox" name="is_bulk" id="is_bulk" value="1"
                                                {{ old('is_bulk', 0) == 1 ? 'checked' : '' }}>
                                            <label for="is_bulk">
                                                @lang('cruds.product.fields.is_bulk')
                                            </label>
                                        </div>

                                        @if ($errors->has('is_bulk'))
                                            <span class="text-danger">{{ $errors->first('is_bulk') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.is_bulk_helper') }}
                                        </span>
                                    </div> --}}

                                    <div class="col-3">
                                        <div
                                            class="icheck-primary {{ $errors->has('is_exclusive') ? 'is-invalid' : '' }}">
                                            <input type="checkbox" name="is_exclusive" id="is_exclusive" value="1"
                                                {{ old('is_exclusive', 0) == 1 ? 'checked' : '' }}>
                                            <label for="is_exclusive">
                                                {{ trans('cruds.product.fields.is_exclusive') }}
                                            </label>
                                        </div>

                                        @if ($errors->has('is_exclusive'))
                                            <span class="text-danger">
                                                {{ $errors->first('is_exclusive') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.is_exclusive_helper') }}
                                        </span>
                                    </div>

                                    <div class="col-3">
                                        <div
                                            class="icheck-primary {{ $errors->has('is_featured') ? 'is-invalid' : '' }}">
                                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                                {{ old('is_featured', 0) == 1 ? 'checked' : '' }}>
                                            <label for="is_featured">
                                                {{ trans('cruds.product.fields.is_featured') }}
                                            </label>
                                        </div>

                                        @if ($errors->has('is_featured'))
                                            <span class="text-danger">
                                                {{ $errors->first('is_featured') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.is_featured_helper') }}
                                        </span>
                                    </div>

                                    <div class="col-3">
                                        <div class="icheck-primary {{ $errors->has('is_new') ? 'is-invalid' : '' }}">
                                            <input type="checkbox" name="is_new" id="is_new" value="1"
                                                {{ old('is_new', 0) == 1 ? 'checked' : '' }}>
                                            <label for="is_new">
                                                {{ trans('cruds.product.fields.is_new') }}
                                            </label>
                                        </div>

                                        @if ($errors->has('is_new'))
                                            <span class="text-danger">
                                                {{ $errors->first('is_new') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.is_new_helper') }}
                                        </span>
                                    </div>

                                    {{-- <div class="form-group col-3">
                                        <label class="required">
                                            {{ trans('cruds.product.fields.in_stock') }}
                                        </label>

                                        <select class="form-control {{ $errors->has('in_stock') ? 'is-invalid' : '' }}"
                                            name="in_stock" id="in_stock" required>
                                            <option value disabled
                                                {{ old('in_stock', null) === null ? 'selected' : '' }}>
                                                {{ trans('global.pleaseSelect') }}
                                            </option>

                                            @foreach (App\Models\Product::IN_STOCK_SELECT as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ old('in_stock', 1) == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('in_stock'))
                                            <span class="text-danger">
                                                {{ $errors->first('in_stock') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.in_stock_helper') }}
                                        </span>
                                    </div> --}}

                                    <div class="form-group col-3">
                                        <label class="required">
                                            {{ trans('cruds.product.fields.status') }}
                                        </label>

                                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                            name="status" id="status" required>
                                            <option value="" disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                                {{ trans('global.pleaseSelect') }}
                                            </option>

                                            @foreach (App\Models\Product::STATUS_SELECT as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ old('status', 1) == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('status'))
                                            <span class="text-danger">
                                                {{ $errors->first('status') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.status_helper') }}
                                        </span>
                                    </div>
                                    <?php /* ?>
                                    <div class="form-group col-6">
                                        <label class="required">
                                            @lang('cruds.product.fields.gallery')
                                        </label>

                                        <div class="input-field">
                                            <div class="input-images" style="padding-top: .5rem;"></div>
                                        </div>

                                        @if ($errors->has('gallery'))
                                            <span class="text-danger">
                                                {{ $errors->first('gallery') }}
                                            </span>
                                        @endif
                                    </div>
                                    <?php */ ?>
                                    <div class="form-group col-6">
                                        <label for="care_and_disclaimer" >
                                            Care & Disclaimer
                                        </label>

                                        <textarea
                                            class="form-control desc {{ $errors->has('care_and_disclaimer') ? 'is-invalid' : '' }}"
                                            name="care" id="editor">{!!old('care_and_disclaimer')!!}</textarea>

                                        @if ($errors->has('care_and_disclaimer'))
                                            <span class="text-danger">
                                                {{ $errors->first('care_and_disclaimer') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.description_helper') }}
                                        </span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="description" class="required">
                                            {{ trans('cruds.product.fields.detail') }}
                                        </label>

                                        <textarea
                                            class="form-control detail editor-details {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                            name="details" id="detail" required>{!!old('description')!!}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="text-danger">
                                                {{ $errors->first('description') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.description_helper') }}
                                        </span>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="description" class="required">
                                            {{ trans('cruds.product.fields.description') }}
                                        </label>

                                        <textarea
                                            class="form-control desc {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                            name="description" id="editor" required>{!!old('description')!!}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="text-danger">
                                                {{ $errors->first('description') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.description_helper') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="productAttributes">
                            <button class="btn btn-block btn-link text-dark font-weight-bold text-left text-uppercase collapsed"
                                type="button" data-toggle="collapse" data-target="#productAttribute" aria-expanded="false"
                                aria-controls="productAttribute">
                                @lang('cruds.product.product_attributes')
                            </button>
                        </div>
                        <div id="productAttribute" class="collapse" aria-labelledby="productAttributes"
                            data-parent="#accordionProduct">
                            <div class="card-body" id="attributeBLock">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="productVariants">
                            <button class="btn btn-block btn-link text-dark font-weight-bold text-left text-uppercase collapsed"
                                type="button" data-toggle="collapse" data-target="#productVariant" aria-expanded="false"
                                aria-controls="productVariant">
                                @lang('cruds.product.product_variants')
                            </button>
                            {{-- <button class="btn btn-info btn-add-more float-right" title="{{ trans('global.add_more') }}">
                                <i class="fas fa-plus-circle"></i>
                            </button> --}}
                        </div>

                        <div id="productVariant" class="collapse" aria-labelledby="productVariants"
                            data-parent="#accordionProduct">
                            <div class="card-body" id="variationBLock">
                                {{-- @include('admin.products.variation') --}}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card">
                        <div class="card-header" id="headingThree">
                            <button
                                class="btn btn-link text-dark font-weight-bold btn-block text-left text-uppercase collapsed"
                                type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                @lang('cruds.product.bulk_product')
                            </button>
                        </div>

                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionProduct">
                            <div class="card-body">
                                Comming Soon
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-12 text-right">
                        <button class="btn btn-success" id="submit-btn" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@include('admin.upload.multiple')
@endsection

@section('scripts')

@include('admin.mediascript.multiple')

<script>
    // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    var sku_code_error = true;
    var row_error = false;

    

    function txtSinglePriceQuantity(id){
        $(".single_price_quantity_"+id).each(function() {
          $(this).val($('#txtSinglePrice_quantity_'+id).val());
        });

        $(".single_price_quantity_"+id).each(function() {
          var id = $(this).attr('id');
          input_error(id,$(this));
        });

    }
    function txtSinglePrice(id){
        $(".single_price_"+id).each(function() {
          $(this).val($('#txtSinglePrice_'+id).val());
        });
        $(".single_price_"+id).each(function() {
          var id = $(this).attr('id');
          input_error(id,$(this));
        });
    }

    

    function txtWholesalePrice(id){
        $(".wholesale_price_"+id).each(function() {
          $(this).val($('#txtwholesalePrice_'+id).val());
        });

        $(".wholesale_price_"+id).each(function() {
          var id = $(this).attr('id');
          input_error(id,$(this));
        });
    }
    function txtWholesalePriceQuantity(id){
        $(".wholesale_price_quantity_"+id).each(function() {
          $(this).val($('#txtwholesalePrice_quantity_'+id).val());
        });

        $(".wholesale_price_quantity_"+id).each(function() {
          var id = $(this).attr('id');
          input_error(id,$(this));
        });
    }

    function input_error(id,event){
            var row_column = id.split('_');
            var row =row_column[1];
            var col = row_column[2];
            row_error = false;
            var this_obj = event;
            var row_obj = event.parent('.row');

            var single_price = event.closest('.row').find(`#txtSinglePrice_${row}_${col}`).val();
            var single_qty = event.closest('.row').find(`#singleQty_${row}_${col}`).val();
            var wholesale_price = event.closest('.row').find(`#txtwholesalePrice_${row}_${col}`).val();
            var wholesale_qty = event.closest('.row').find(`#wholesaleQty_${row}_${col}`).val();

            event.closest('.row').find(`#txtSinglePrice_${row}_${col}`).removeClass('box-danger');
            event.closest('.row').find(`#singleQty_${row}_${col}`).removeClass('box-danger');
            event.closest('.row').find(`#txtwholesalePrice_${row}_${col}`).removeClass('box-danger');
            event.closest('.row').find(`#wholesaleQty_${row}_${col}`).removeClass('box-danger');
            var par = event.closest('.row');

            //if(single_price === '' || single_qty === '' || wholesale_price === '' || wholesale_qty === ''){
            if(single_price === '' || single_qty === '' ){
                if(par.find('input[type=checkbox]').is(':checked')){
                    if(single_price === ''){
                    par.find(`#txtSinglePrice_${row}_${col}`).addClass('box-danger');
                        row_error = true;
                    }

                    if(single_qty === ''){
                        par.find(`#singleQty_${row}_${col}`).addClass('box-danger');
                        row_error = true;
                    }
                }
            }

            if(wholesale_price === '' || wholesale_qty === ''){
                if(par.find('input[type=checkbox]').is(':checked')){
                   
                     if(wholesale_price === ''){
                         //par.find(`#txtwholesalePrice_${row}_${col}`).addClass('box-danger');
                         row_error = false;
                     }
                    
                     if(wholesale_qty === ''){
                         //par.find(`#wholesaleQty_${row}_${col}`).addClass('box-danger');
                         row_error = false;
                     }
                }

            }
    }

    $(document).ready(function(){
         $(document).on('keyup','[id^=txtSinglePrice_],[id^=singleQty_],[id^=txtwholesalePrice_],[id^=wholesaleQty_]', function(){
        //$(document).on('keyup','[id^=txtSinglePrice_],[id^=singleQty_]', function(){

            var id = $(this).attr('id');
            var row_column = id.split('_');
            var cl = $(this).attr('class').replace('form-control ','').trim().split('_');
            cl = cl.slice(-1);
            var row =row_column[1];
            var col = row_column[2];
            row_error = false;
            var this_obj = $(this);
            var row_obj = $(this).parent('.row');
            // console.log($(this).closest('.row').find(`#txtSinglePrice_${row}_${col}`).val());


            var single_price = $(this).closest('.row').find(`#txtSinglePrice_${row}_${col}`).val();
            var single_qty = $(this).closest('.row').find(`#singleQty_${row}_${col}`).val();
             var wholesale_price = $(this).closest('.row').find(`#txtwholesalePrice_${row}_${col}`).val();
             var wholesale_qty = $(this).closest('.row').find(`#wholesaleQty_${row}_${col}`).val();


            $(this).closest('.row').find(`#txtSinglePrice_${row}_${col}`).removeClass('box-danger');
            $(this).closest('.row').find(`#singleQty_${row}_${col}`).removeClass('box-danger');
             $(this).closest('.row').find(`#txtwholesalePrice_${row}_${col}`).removeClass('box-danger');
             $(this).closest('.row').find(`#wholesaleQty_${row}_${col}`).removeClass('box-danger');
            var par = $(this).closest('.row');

            // if(single_price === '' || single_qty === '' || wholesale_price === '' || wholesale_qty === ''){
            if(single_price === '' || single_qty === '' ){
                if(par.find('input[type=checkbox]').is(':checked')){
                    if(single_price === ''){
                    par.find(`#txtSinglePrice_${row}_${col}`).addClass('box-danger');
                        row_error = true;
                    }

                    if(single_qty === ''){
                        par.find(`#singleQty_${row}_${col}`).addClass('box-danger');
                        row_error = true;
                    }
                }

            }

            if( wholesale_price === '' || wholesale_qty === ''){
                if(par.find('input[type=checkbox]').is(':checked')){
                   
                     if(wholesale_price === ''){
                         //par.find(`#txtwholesalePrice_${row}_${col}`).addClass('box-danger');
                         row_error = false;
                     }
                    
                     if(wholesale_qty === ''){
                         //par.find(`#wholesaleQty_${row}_${col}`).addClass('box-danger');
                         row_error = false;
                     }
                }

            }
        })

        $(document).on('click','#submit-btn', function(e){
            e.preventDefault();
            var error = true;
            var primaryId = 0;
            var formError = false;

            var name = $(document).find('#name').val();
            var category = $(document).find('#optCategory').val();
            var sku = $(document).find('#sku_code').val();
            var status = $(document).find('#status').val();
            var tax_rate = $(document).find('#tax_rate').val();
           
            //var description = CKEDITOR.instances['editor'].getData();
            var editor = $(document).find('#editor').val();


            if(name == ''){
               toast_alert('Name');
               formError = true;
               return;
            }
            if(category == ''){
               toast_alert('Category');
               formError = true;
               return;
            }
            if(sku == ''){
               toast_alert('SKU CODE');
               formError = true;
               return;
            }
            // if(description == ''){
            //    toast_alert('Description');
            //    formError = true;
            //    return;
            // }
            if(status == ''){
               toast_alert('Status');
               formError = true;
               return;
            }
            if(tax_rate == ''){
               toast_alert('Tax rate');
               formError = true;
               return;
            }
            if(sku_code_error){
                toastr.warning('Warning!', 'Sku code is not valid(Atleast 4 char long/Unique)',{
                    positionClass: 'toast-top-center',
                    iconClass:'toast-warning',
                });
               formError = true;
               return;
            }

            var checkImageVal = 1;
            $('.same-price').each(function() {
                if ($(this).is(':checked')){
                    let id = $(this).attr( "data-number" );
                    if($('#collapse'+id).length){
                        checkImage = $('#collapse'+id+' img').length;
                        if(checkImage == 0){
                            checkImageVal = checkImage;
                        }
                    }
                }
            });

            //if(checkImageVal == 0){
           //     toast_alert('Product Images');
            //    formError = true;
            //    return;
            //}
            

            $(document).find('[id^="primarydata"]').each(function() {
                if($(this).is(':checked')){
                    error = false;
                    primaryId = $(this).attr('id');
                }
            });

            if(error){
                formError = true;
                toastr.warning('Warning!', 'Please make one of the variation primary.',{
                    positionClass: 'toast-top-center',
                    iconClass:'toast-warning',
                });
                return;
            }

            var sizeError = true;
            $(document).find('[id^="cbSize"]').each(function(){
                if($(this).is(':checked')){
                    sizeError = false
                }
            });

            if(sizeError){
                formError = true;
                toastr.warning('Warning!', 'Please select one of the varient size.',{
                    positionClass: 'toast-top-center',
                    iconClass:'toast-warning',
                });
                return;
            }

            if(primaryId !== 0){
                var str = primaryId.replace(/[^0-9]/gi, '');
                var priChk = true;
                $(`[id ^=cbSize][id $=-${str}]`).each(function() {
                    if ($(this).is(':checked')){
                        priChk = false;
                    }
                });

                if(priChk){
                    formError = true;
                    toastr.warning('Warning!', 'Please select one of the size which select as a primary varient.',{
                    positionClass: 'toast-top-center',
                    iconClass:'toast-warning',
                    });
                    return;
                }
            }



            $(document).find('[class^=cbSize_]').each(function(){
                if($(this).is(':checked')){
                    var id = $(this).attr('class');
                    var event = $(this);
                    input_error(id,event);
                }

            })

            if(row_error){
                toastr.warning('Warning!', 'Please input all value of product_variation which size is selected.',{
                    positionClass: 'toast-top-center',
                    iconClass:'toast-warning',
                });

                formError = true;
                return;
            }


            if(!formError){
                document.getElementById("product-form").submit();
            }
        });

        function toast_alert(name = ''){
            toastr.warning('Warning!', `${name} field are required!`,{
                    positionClass: 'toast-top-center',
                    iconClass:'toast-warning',
                    });
            return;
        }

        $(document).on('change', '[id^="same_price"]', function(){
            var id = $(this).attr('data-number');
            if($(this).is(':checked')){
                $(document).find(`[id ^=cbSize][id $=-${id}]`).each(function(){
                    $(this).attr('checked', true);
                });
            }
            else{
                $(document).find(`[id ^=cbSize][id $=-${id}]`).each(function(){
                    $(this).attr('checked', false);
                });
            }
        })


        $(document).on('click','[id^="cbSize"]', function(){
            var id = $(this).attr('id');
            var str = id.split('-')[1];
            var data = $(this).attr('data-id');
            var cl = $(this).attr('data-id');
            var $this = $(this);
            //console.log(id);

            if ($(this).is(':checked')) {
                $(document).find(`[id^="primarydata"]`).attr('checked', false);
                $(document).find(`#primarydata${str}`).attr('checked', true);
                $(document).find(`#txtSinglePrice_${data}`).attr('required', true);
                $(document).find(`#singleQty_${data}`).attr('required', true);
                //$(document).find(`#txtwholesalePrice_${data}`).attr('required', true);
                //$(document).find(`#wholesaleQty_${data}`).attr('required', true);
            }
            else{
                var mycheck = false;
                $(`[id ^=cbSize][id $=-${str}]`).each(function() {
                    if ($(this).is(':checked')){
                       mycheck = true;
                    }
                });

                if(!mycheck){
                    $(document).find(`#primarydata${str}`).removeAttr('checked');
                }
                $(document).find(`#txtSinglePrice_${data}`).removeAttr('required');
                $(document).find(`#singleQty_${data}`).removeAttr('required');
                $(document).find(`#txtSinglePrice_${data}`).val('');
                $(document).find(`#singleQty_${data}`).val('');
                $(document).find(`#wholesalePrice_${data}`).val('');
                $(document).find(`#wholesaleQty_${data}`).val('');
                //$(document).find(`#wholesalePrice_${data}`).removeAttr('required');
                //$(document).find(`#wholesaleQty_${data}`).removeAttr('required');
            }


            input_error(cl,$this);
        });
// hide child category
    $(document).ready(function(){
            $('#child-category').hide();
        }); 


// for sky option
        $(document).on('keyup','#sku_code', function(){
            var sku_code = $(this).val();
            $(document).find('#sku_help').html('');
            $.ajax({
                type:'GET',
                url:"{{ url('backoffice/products/checksku') }}/"+sku_code,
                data:{},
                success:function(data){
                    if(data.success){
                        if(data.code === 200){
                            var html = `
                              <span class="text-success font-weight-bold">${data.message}</span>
                            `;
                            $(document).find('#sku_help').html(html);
                            sku_code_error = false;
                        }
                        else{
                            var html = `
                              <span class="text-warning font-weight-bold">${data.message}</span>
                            `;
                            $(document).find('#sku_help').html(html);
                            sku_code_error = true;
                        }
                    }
                },
                error :function(){

                }
            });
        });

        var all_id = 0;
        var global_color = [];

        $(document).on('click','input:checkbox[id^="primarydata"]', function(){
          var id = $(this).attr('id');
          $this = $(this);

          $(document).find('[id^="primarydata"]').each(function(){
            this.checked = false;
          });
          document.getElementById(id).checked = true;
        });

        $(document).on('input',`input[type="text"]`,function(){
            var i;
            var j = 0;
            var visible = false;
            for (i = 0; i < global_color.length; ++i) {
                j++;

                var single_price = $(document).find(`#txtSinglePrice_${j}`).val();
                var single_qty = $(document).find(`#txtSinglePrice_quantity_${j}`).val();
                var wholesale_price = $(document).find(`#txtWholesalePrice_${j}`).val();
                var wholesale_qty = $(document).find(`#txtWholesalePrice_quantity_${j}`).val();


                if(single_price !== '' && single_qty !== '' && wholesale_price !== '' && wholesale_qty  !== ''){
                    visible = true;
                }
            }

            if(visible){
                $(document).find('[id^="sameforall_"]').removeAttr('disabled');
            }
            else{
                $(document).find('[id^="sameforall_"]').attr('disabled',true);
            }

            

        });

        $(document).on('click','[id^="sameforall_"]', function(){
            var id = $(this).attr('data-number');

            all_id = id;


            if($(this).is(':checked')){
                $(document).find('[id^="sameforall_"]').attr('checked',true) ;
                var single_price = $(document).find(`#txtSinglePrice_${id}`).val();
                var single_qty = $(document).find(`#txtSinglePrice_quantity_${id}`).val();
                var wholesale_price = $(document).find(`#txtWholesalePrice_${id}`).val();
                var wholesale_qty = $(document).find(`#txtWholesalePrice_quantity_${id}`).val();

                var i;
                var j = 0;
                for (i = 0; i < global_color.length; ++i) {
                    j++;
                    if(all_id !== j)
                    {
                        $(document).find(`#txtSinglePrice_${j}`).val(single_price);
                        $(document).find(`#txtSinglePrice_quantity_${j}`).val(single_qty);
                        $(document).find(`#txtWholesalePrice_${j}`).val(wholesale_price);
                        $(document).find(`#txtWholesalePrice_quantity_${j}`).val(wholesale_qty);

                        $(document).find(`input[name="variation[${global_color[i].id}][single_price][]"]`).val(single_price);
                        $(document).find(`input[name="variation[${global_color[i].id}][single_price_quantity][]"]`).val(single_qty);
                        $(document).find(`input[name="variation[${global_color[i].id}][wholesale_price][]"]`).val(wholesale_price);
                        $(document).find(`input[name="variation[${global_color[i].id}][wholesale_price_quantity][]"]`).val(wholesale_qty);

                        $(document).find(`[id^="cbSize"]`).attr('checked', true);
                    }
                }
            }
            else{

                $(document).find('[id^="sameforall_"]').attr('checked',false) ;
                $(document).find(`#txtSinglePrice_${id}`).val('');
                $(document).find(`#txtSinglePrice_quantity_${id}`).val('');
                $(document).find(`#txtWholesalePrice_${id}`).val('');
                $(document).find(`#txtWholesalePrice_quantity_${id}`).val('');

                var i;
                var j = 0;
                for (i = 0; i < global_color.length; ++i) {
                    j++;
                    if(id !== j)
                    {
                        $(document).find(`#txtSinglePrice_${j}`).val('');
                        $(document).find(`#txtSinglePrice_quantity_${j}`).val('');
                        $(document).find(`#txtWholesalePrice_${j}`).val('');
                        $(document).find(`#txtWholesalePrice_quantity_${j}`).val('');

                        $(document).find(`input[name="variation[${j}][single_price][]"]`).val('');
                        $(document).find(`input[name="variation[${j}][single_price_quantity][]"]`).val('');
                        $(document).find(`input[name="variation[${j}][wholesale_price][]"]`).val('');
                        $(document).find(`input[name="variation[${j}][wholesale_price_quantity][]"]`).val('');

                        $(document).find(`[id^="cbSize"]`).attr('checked', false);
                    }
                }

                $(document).find('[id^="sameforall_"]').attr('checked',false);
                $(document).find('[id^="sameforall_"]').attr('disabled',true);
            }
        });

        let imagesInputName = 'gallery[]';
        let token = "{{ csrf_token() }}";
        let pleaseSelect = "{{ trans('global.pleaseSelect') }}";
        // let subCategoryURL = "{{ route('admin.category.subCategories') }}";
        let subCategoryURL = "{{ route('admin.product.map.subcategories') }}";
        let attributeURL = "{{ route('admin.product.attributes') }}";
        let sizes = brands = colors = [];

        
        let overlay = $(document).find('.loading-overlay');
        $('.attributes').click(function() {
            $('#is_attribute').val("1");
        });

        $(document).on('change', '#has_varient', function() {
            let varient = $(this).val();

            if (varient == 1) {
                $('.no-varient').hide();
                $('.').show()
            } else {
                $('.no-varient').show();
                $('.has-varient').hide()
            }
        });
        

        $('.same-price').on('click', function() {
            //let number = $(this).data('number');
            let id = $(this).attr( "data-number" );
                           
            if($(this).prop('checked') == true) {
                var strid = $(this).attr('data-number');
                var checkImageVal = 1;
                $('.same-price').each(function() {
                    if ($(this).is(':checked')){
                        let id = $(this).attr( "data-number" );                   
                        if(strid != id) {
                            if($('#collapse'+id).length){
                                checkImage = $('#collapse'+id+' img').length;
                                if(checkImage == 0){
                                    checkImageVal = checkImage;
                                }
                            }
                        }
                    }
                });

                if(checkImageVal == 0){
                    $(this).prop('checked', false);
                    toast_alert('Product Images');
                    formError = true;
                    return;
                }
                $('#txtSinglePrice_'+id).attr('disabled', false);
                $('#txtSinglePrice_quantity_'+id).attr('disabled', false);
                $('#txtwholesalePrice_'+id).attr('disabled', false);
                $('#txtwholesalePrice_quantity_'+id).attr('disabled', false);
            }else{
                $('#txtSinglePrice_'+id).attr( "disabled",'disabled');
                $('#txtSinglePrice_quantity_'+id).attr( "disabled",'disabled');
                $('#txtwholesalePrice_'+id).attr( "disabled",'disabled' );
                $('#txtwholesalePrice_quantity_'+id).attr( "disabled",'disabled' );
                $('#txtSinglePrice_'+id).val('');
                $('#txtSinglePrice_quantity_'+id).val('');
                $('#txtWholesalePrice_'+id).val('');
                $('#txtWholesalePrice_quantity_'+id).val('');
                $(".single_price_"+id).each(function() {
                    $(this).val('');
                });

                $(".single_price_quantity_"+id).each(function() {
                    $(this).val('');
                });

                $(".wholesale_price_"+id).each(function() {
                    $(this).val('');
                });

                $(".wholesale_price_quantity_"+id).each(function() {
                    $(this).val('');
                });
            }
            

            // if ($(this).prop('checked') == true) {
            //     $('#txtPrice' + number).val($('#txtMRPPrice').val())
            //         .prop('readonly', true)
            //         .attr("disabled", true);
            // } else {
            //     $('#txtPrice' + number).val('')
            //         .prop('readonly', false)
            //         .attr("disabled", false);
            // }
        });

        $('#optCategory').change(function() {
            let parent_id = $(this).val();
          $('#child-category').hide();
            $('#variationBLock').html('<div class="text-center">Please select sub category first!!</div>');

            if (parent_id) {
                $.ajax({
                    url: subCategoryURL,
                    data: {
                        _token: token,
                        parent_id: parent_id
                    },
                    method: 'POST',
                    beforeSend : function(){
                        overlay.addClass('is-active');
                    },
                    success: function(res) {
                        $('#optSubCategory').empty().append(new Option(pleaseSelect));
                        overlay.removeClass('is-active');
                        if (res.success) {
                            res.subCategories.map((item) => {
                                $('#optSubCategory').append(new Option(item.name,
                                    item.id));
                            });
                        } else {
                            swal({
                                title: "Warning",
                                text: res.message,
                                type: "warning",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    failure: function(status) {
                        console.log(status);
                    }
                });
            } else {
                $('#optSubCategory').empty().append(new Option(pleaseSelect));
            }
        });

        $('#optSubCategory').change(function() {
            let sub_category_id = $(this).val();
            let category_id = $('#optCategory').val();

            $('#variationBLock').html('<div class="text-center">Please select sub category first!!</div>');
            $('#attributeBLock').html('<div class="text-center">Please select sub category first!!</div>');
            if (sub_category_id > 0 && category_id > 0) {
                $.ajax({
                    url: attributeURL,
                    data: {
                        _token: token,
                        category_id: category_id,
                        sub_category_id: sub_category_id,
                    },
                    method: 'POST',
                    beforeSend : function(){
                        overlay.addClass('is-active');
                    },
                    success: function(res) {
                        if (!res.success) {
                            swal({
                                title: "error",
                                text: res.message,
                                type: "error",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                         var child = res.child_category;
                if(child && child.length > 0){
                            
                            $('#optSubCategoryChild').empty().append(new Option(pleaseSelect));
                               
                                for(var i=0 ; i < child.length ; i++){
                                    var childname = child[i].name;
                                    var childid = child[i].id;

                                    $('#optSubCategoryChild').append(
                                        `<option value="${childid}">${childname}</option>`
                                    );
                                }

                            $('#cover').fadeOut(4000);
                            $('#child-category').delay(4000).show();

                        }
                        else{
                       $('#child-category').hide();
                        } 

                        overlay.delay(4000).removeClass('is-active');

                        $('#variationBLock').html(res.html);
                        
                        global_color = res.colors;

                        $('#attributeBLock').html(res.attribute_html);

                        $('.same-price').on('click', function() {

                            let id = $(this).attr( "data-number" );
                           
                            if($(this).prop('checked') == true) {
                                var strid = $(this).attr('data-number');
                                var checkImageVal = 1;
                                $('.same-price').each(function() {
                                    if ($(this).is(':checked')){
                                        let id = $(this).attr( "data-number" );                   
                                        if(strid != id) {
                                            if($('#collapse'+id).length){
                                                checkImage = $('#collapse'+id+' img').length;
                                                if(checkImage == 0){
                                                    checkImageVal = checkImage;
                                                }
                                            }
                                        }
                                    }
                                });

                                if(checkImageVal == 0){
                                    $(this).prop('checked', false);
                                    toast_alert('Product Images');
                                    formError = true;
                                    return;
                                }
                                $('#txtSinglePrice_'+id).attr('disabled', false);
                                $('#txtSinglePrice_quantity_'+id).attr('disabled', false);
                                $('#txtwholesalePrice_'+id).attr('disabled', false);
                                $('#txtwholesalePrice_quantity_'+id).attr('disabled', false);
                            }else{
                                $('#txtSinglePrice_'+id).attr( "disabled",'disabled');
                                $('#txtSinglePrice_quantity_'+id).attr( "disabled",'disabled');
                                $('#txtwholesalePrice_'+id).attr( "disabled",'disabled' );
                                $('#txtwholesalePrice_quantity_'+id).attr( "disabled",'disabled' );
                                $('#txtSinglePrice_'+id).val('');
                                $('#txtSinglePrice_quantity_'+id).val('');
                                $('#txtwholesalePrice_'+id).val('');
                                $('#txtwholesalePrice_quantity_'+id).val('');
                                $(".single_price_"+id).each(function() {
                                    $(this).val('');
                                });

                                $(".single_price_quantity_"+id).each(function() {
                                    $(this).val('');
                                });

                                $(".wholesale_price_"+id).each(function() {
                                    $(this).val('');
                                });

                                $(".wholesale_price_quantity_"+id).each(function() {
                                    $(this).val('');
                                });
                            }
                        });
                        res.colors.forEach(element => {
                        //   $('#clr'+element.id).imageUploader();
                        });
                    },
                    failure: function(status) {
                        console.log(status);
                    }
                });
            }

            let parent_id = $(this).val();
            if (parent_id == "Please select") {
                $('#optSubCategoryChild').empty().append(new Option(pleaseSelect))
            }
            else{
                if (parent_id) {
                $.ajax({
                    url: subCategoryURL,
                    data: {
                        _token: token,
                        parent_id: parent_id
                    },
                    method: 'POST',
                    success: function(res) {
                        $('#optSubCategoryChild').empty().append(new Option(pleaseSelect));

                        if (res.success) {
                            res.subCategories.map((item) => {
                                $('#optSubCategoryChild').append(new Option(item.name,
                                    item.id));
                            });
                        } else {
                            // swal({
                            //     title: "Warning",
                            //     text: "Sub Child Category not Exists in selected sub category",
                            //     type: "warning",
                            //     timer: 3000,
                            //     showConfirmButton: false
                            // });


                        }
                    },
                    failure: function(status) {
                        console.log(status);
                    }
                });
                } 
                 $('#optSubCategoryChild').empty().append(new Option(pleaseSelect))
            }

            // set time out
            setTimeout(() => {
                for (let index = 0; index < $(".input-images").children().length; index++) {
                    const element = $(".input-images").children()[index];
                    const id=$(".input-images")[index].getAttribute('custom1');
                    element.children[0].setAttribute('name','gallery['+id+'][]');
                }
                $('.foo').click(function(){
                    if($(this).prop("checked") == true){
                        $('.foo').attr('disabled', 'disabled');
                        $(this).attr('disabled', false);
                    }
                    else{
                        $('.foo').attr('disabled', false);
                    }
                })
            }, 1000);
        });

        $('#optSubCategoryChild').change(function() {
            let sub_category_id = $('#optSubCategory').val();
            let category_id = $('#optCategory').val();
            let child_id = $(this).val();

            $('#variationBLock').html('<div class="text-center">Please select sub category first!!</div>');
            $('#attributeBLock').html('<div class="text-center">Please select sub category first!!</div>');
            if (sub_category_id > 0 && category_id > 0 ) {
                $.ajax({
                    url: "{{url('backoffice/product/child_attributes')}}",
                    data: {
                        _token: token,
                        category_id: category_id,
                        sub_category_id: sub_category_id,
                        child_id : child_id
                    },
                    method: 'POST',
                    beforeSend : function(){
                        overlay.addClass('is-active');
                    },
                    success: function(res) {
                        if (!res.success) {
                            swal({
                                title: "error",
                                text: res.message,
                                type: "error",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }

                        

                        overlay.delay(4000).removeClass('is-active');

                        $('#variationBLock').html(res.html);
                        global_color = res.colors;

                        $('#attributeBLock').html(res.attribute_html);

                        $('.same-price').on('click', function() {

                            let id = $(this).attr( "data-number" );
                           
                            if($(this).prop('checked') == true) {
                                var strid = $(this).attr('data-number');
                                var checkImageVal = 1;
                                $('.same-price').each(function() {
                                    if ($(this).is(':checked')){
                                        let id = $(this).attr( "data-number" );                   
                                        if(strid != id) {
                                            if($('#collapse'+id).length){
                                                checkImage = $('#collapse'+id+' img').length;
                                                if(checkImage == 0){
                                                    checkImageVal = checkImage;
                                                }
                                            }
                                        }
                                    }
                                });

                                if(checkImageVal == 0){
                                    $(this).prop('checked', false);
                                    toast_alert('Product Images');
                                    formError = true;
                                    return;
                                }
                                $('#txtSinglePrice_'+id).attr('disabled', false);
                                $('#txtSinglePrice_quantity_'+id).attr('disabled', false);
                                $('#txtwholesalePrice_'+id).attr('disabled', false);
                                $('#txtwholesalePrice_quantity_'+id).attr('disabled', false);
                            }else{
                                $('#txtSinglePrice_'+id).attr( "disabled",'disabled');
                                $('#txtSinglePrice_quantity_'+id).attr( "disabled",'disabled');
                                $('#txtwholesalePrice_'+id).attr( "disabled",'disabled' );
                                $('#txtwholesalePrice_quantity_'+id).attr( "disabled",'disabled' );
                                $('#txtSinglePrice_'+id).val('');
                                $('#txtSinglePrice_quantity_'+id).val('');
                                $('#txtWholesalePrice_'+id).val('');
                                $('#txtWholesalePrice_quantity_'+id).val('');
                                $(".single_price_"+id).each(function() {
                                    $(this).val('');
                                });

                                $(".single_price_quantity_"+id).each(function() {
                                    $(this).val('');
                                });

                                $(".wholesale_price_"+id).each(function() {
                                    $(this).val('');
                                });

                                $(".wholesale_price_quantity_"+id).each(function() {
                                    $(this).val('');
                                });
                            }
                        });
                        res.colors.forEach(element => {
                        //   $('#clr'+element.id).imageUploader();
                        });
                    },
                    failure: function(status) {
                        console.log(status);
                    }
                });
              
              
            }
            

            
        });

    })
</script>

{{-- ck uploader --}}
<script>
    $(document).ready(function() {
        function SimpleUploadAdapter(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: function() {
                        return loader.file
                            .then(function(file) {
                                return new Promise(function(resolve, reject) {
                                    // Init request
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST',
                                        '{{ route('admin.products.storeCKEditorImages') }}',
                                        true);
                                    xhr.setRequestHeader('x-csrf-token', window._token);
                                    xhr.setRequestHeader('Accept', 'application/json');
                                    xhr.responseType = 'json';

                                    // Init listeners
                                    var genericErrorText =
                                        `Couldn't upload file: ${ file.name }.`;
                                    xhr.addEventListener('error', function() {
                                        reject(genericErrorText)
                                    });
                                    xhr.addEventListener('abort', function() {
                                        reject()
                                    });
                                    xhr.addEventListener('load', function() {
                                        var response = xhr.response;

                                        if (!response || xhr.status !== 201) {
                                            return reject(response && response
                                                .message ?
                                                `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                            );
                                        }

                                        $('form').append(
                                            '<input type="hidden" name="ck-media[]" value="' +
                                            response.id + '">');

                                        resolve({
                                            default: response.url
                                        });
                                    });

                                    if (xhr.upload) {
                                        xhr.upload.addEventListener('progress', function(
                                            e) {
                                            if (e.lengthComputable) {
                                                loader.uploadTotal = e.total;
                                                loader.uploaded = e.loaded;
                                            }
                                        });
                                    }

                                    // Send request
                                    var data = new FormData();
                                    data.append('upload', file);
                                    data.append('crud_id', '{{ $product->id ?? 0 }}');
                                    xhr.send(data);
                                });
                            })
                    }
                };
            }
        }

        var allEditors = document.querySelectorAll('.ckeditor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(
                allEditors[i], {
                    extraPlugins: [SimpleUploadAdapter]
                }
            );
        }
    });
</script>
{{-- init sample --}}
<script>
	initSample();
</script>
{{-- ckeditor --}}
<script type="text/javascript">
      CKEDITOR.replace( 'details' );
      CKEDITOR.add

      CKEDITOR.replace( 'description' );
      CKEDITOR.add
</script>
<script>
            $('.foo').click(function(){

     if($(this).prop("checked") == true){
         $('.foo').attr('disabled', 'disabled');
     $(this).attr('disabled', false);
                 }
                 else{
                     $('.foo').attr('disabled', false);
                 }
     })

</script>
@endsection
