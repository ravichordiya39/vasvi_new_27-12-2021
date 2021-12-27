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
                            <div class="row">
@if (isset($attributes) && $attributes->count()>0)
@foreach ($attributes as $akey => $attribute)
    @php
        $attributeVal = App\Models\Attribute::where('id', $attribute->attribute_id)
                ->where('status', 1)
                ->select(['id', 'name'])
                ->first();
                $checknew=$attributeVal->attribute_values()->pluck('id')->toArray();
                $attributeVal->toArray();
        $attributeValues = [];
        if(isset($checknew)){

          $attributeValues = App\Models\AttributeValue::whereIn('id', $checknew)
                  ->where('status', 1)
                  ->select(['id', 'value'])
                  ->get()
                  ->toArray();
        }
    @endphp
    @if(count($attributeValues) > 0)
    <div class="form-group col-3">
      <label for="attributeLabel_{{$akey}}">
          {{ $attributeVal['name'] }}
      </label>
      <select
          class="form-control"
          name="attributes[{{ $attribute->attribute_id}}]" id="attributeLabel_{{ $attribute->attribute_id}}">
            <option value="">
                  Select {{ $attributeVal['name'] }}
              </option>
          @foreach ($attributeValues as $id => $entry)
              <option value="{{ $entry['id'] }}" @if ($entry['id'] == $attribute->attribute_value_id)
                  selected
              @endif>
                  {{ $entry['value'] }}
              </option>
          @endforeach
      </select>
    </div>
  @endif
@endforeach
@endif


</div>


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
                                @if(isset($colors) && $colors->count() > 0)
                                
                            @foreach ($colors as $ckey => $color)
@php

@endphp
    <div class="accordion" id="accordionVariation">
        <div class="card">
            <div class="card-header" id="colorHeading{{ $loop->iteration }}">
                <div class="row">
                <div class="col-2">
                        <div class="icheck-primary {{ $errors->has('same_price') ? 'is-invalid' : '' }}" style="display : inline-block";>
                            <input type="checkbox" name="same_price[]" id="same_price{{ $color->id }}"
                                class="same-price" data-number="{{ $color->id }}"
                                value="{{ $loop->iteration }}"  @if (isset($product->productProductVariations()->where('color_id',$color->id)->first()->color_id) && $product->productProductVariations()->where('color_id',$color->id)->first()->color_id == $color->id)
                                checked
                                @endif  style="display: inline-block;">
                            <label for="same_price{{ $color->id }}">
                            </label>
                            <span >For all sizes</span>
                        </div>

                         {{-- <div class="icheck-primary {{ $errors->has('same_price') ? 'is-invalid' : '' }}">
                            <input type="checkbox" name="same_price[]" id="same_price{{ $color->id }}"
                                class="same-price" data-number="{{ $color->id }}"
                                value="{{ $loop->iteration }}" {{ old('same_price', 0) == 1 ? 'checked' : '' }}>
                            <label for="same_price{{ $color->id }}">
                                {{ trans('cruds.product.fields.same_price') }}
                            </label>
                        </div> --}}

                        <button class="btn btn-link  text-dark font-weight-bold text-left text-uppercase"
                            type="button" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}"
                            aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}" style="width : 80% !important;">
                            <span class="mr-2"
                                style="height: 20px; background: {{ $color->value }}; color: {{ $color->value }};">
                                {{ $color->value }}
                            </span>
                            {{ $color->name }}
                        </button>
                    </div>
                    <div class="form-group col-2">
                        <input class="form-control"
                            type="text" name="single_price_{{ $color->id }}" id="txtSinglePrice_{{ $color->id }}"
                          value="{{ old('price',$product->productProductVariations->where('color_id',$color->id)->first()->single_price??'') }}" onblur="txtSinglePrice('{{ $color->id }}')" onkeypress="return isFloat(event)"
                            maxlength="10" placeholder="Retail Price" disabled>
                    </div>
                    <div class="form-group col-2">
                        <input class="form-control"
                            type="text" name="single_price_quantity_{{ $color->id }}" id="txtSinglePrice_quantity_{{ $color->id }}"
                            value="{{ old('single_price_quantity',$product->productProductVariations->where('color_id',$color->id)->first()->single_price_quantity ?? '') }}" onblur="txtSinglePriceQuantity('{{ $color->id }}')" onkeypress="return isFloat(event)"
                            maxlength="10" placeholder="Retail Quantity" disabled>
                    </div>
                    <div class="form-group col-2">
                        <input class="form-control txtWholesalePrice"
                            type="text" name="wholesale_price_{{ $color->id }}" id="txtWholesalePrice_{{ $color->id }}"
                            value=""  onblur="txtWholesalePrice('{{ $color->id }}')" onkeypress="return isFloat(event)"
                            maxlength="10" placeholder="{{ trans('cruds.product.fields.wholesale_price') }}" disabled>
                    </div>
                    <div class="form-group col-2">
                        <input class="form-control"
                            type="text" name="wholesale_price_quantity_{{ $color->id }}" id="txtWholesalePrice_quantity_{{ $color->id }}"
                            value="" onblur="txtWholesalePriceQuantity('{{ $color->id }}')" onkeypress="return isFloat(event)"
                            maxlength="10" placeholder="Wholesale Price Qty" disabled>
                    </div>
                    <div class="col-1">
                        {{-- <div class="icheck-primary {{ $errors->has('same_price') ? 'is-invalid' : '' }}">
                            <input type="checkbox" name="same_price[]" id="same_price{{ $color->id }}"
                                class="same-price" data-number="{{ $color->id }}"
                                value="{{ $loop->iteration }}" {{ old('same_price', 0) == 1 ? 'checked' : '' }}>
                            <label for="same_price{{ $color->id }}">
                                {{ trans('cruds.product.fields.same_price') }}
                            </label>
                        </div> --}}

                        <div class="icheck-primary m-5 {{ $errors->has('same_price') ? 'is-invalid' : '' }}"">
                            <input type="checkbox" name="sameforall[]" id="sameforall_{{ $color->id }}"
                                class="same_for_all" data-number="{{ $color->id }}"
                                value="{{ $loop->iteration }}" disabled>
                            <label for="sameforall_{{ $color->id }}"></label>
                            <span >Same qty for all</span>
                        </div>
                    </div>
                    <div class="col-1">
                        {{-- <div class="">
                            <input type="checkbox" name="primary[{{$color->id}}]" value="1" class="foo" @if (isset($product->productProductVariations()->where('color_id',$color->id)->first()->primary_variation) && $product->productProductVariations()->where('color_id',$color->id)->first()->primary_variation == 1)
                            checked
                            @endif required>
                            <label >

                            </label>
                        </div> --}}

                        <div class="icheck-primary">
                            <input type="checkbox" name="primary[{{ $color->id }}]" id="primarydata{{$color->id}}" data-member="{{$color->id}}"
                                 value="1" data-toggle='tooltip' data-placement='right' data-original-title="tooltip here" class='checkbox'
                                 @if (isset($product->productProductVariations()->where('color_id',$color->id)->first()->primary_variation) && $product->productProductVariations()->where('color_id',$color->id)->first()->primary_variation == 1)
                            checked
                            @endif >

                                 <label for="primarydata{{$color->id}}"></label>
                                 <span >Primary Variation</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="collapse{{ $loop->iteration }}" class="collapse {{ $ckey ? '' : 'show' }}"
                aria-labelledby="colorHeading{{ $loop->iteration }}" data-parent="#accordionVariation">
                <div class="card-body">
                    <div class="row">
                      {{-- <div class="form-group col-12">
                        <input type="hidden" name="color_id[]" value="{{ $color->id }}">
                        <div class="input-field">
                            <div custom1="{{ $color->id }}" class="input-images-{{$ckey}} input-new" style="padding-top: .5rem;"></div>
                        </div>
                      </div> --}}
                      <?php
                    //   dd($color->id);
                      $proimages = DB::table('product_images')
                                ->where('product_id' ,$product->id)
                                ->where('product_color_id', $color->id)
                                ->select('file_name')
                                ->get();
                      $myloop = $loop->iteration;
                      ?>
                      @foreach($proimages as $img)
                      <div class="col-2" id="{{strtok($img->file_name, '.')}}">
                        <div class="border p-2" id="add-image">
                            <i class="fa fa-times" style="" id="img-cross"> </i>
                            <img src="{{asset("file/$img->file_name")}}" class="w-100" style="height : 150px;">
                            <input type="hidden" name="gallery[{{$color->id}}][]" value="{{$img->file_name}}">
                        </div>
                      </div>
                      @endforeach

                      <div class="col-2" id="before-btn-{{$color->id}}">
                        <div class="w-100" style="height : 170px;">
                            <button type="button" class="btn btn-primary btn-circle btn-sm center-block" style="margin-top : 40%; margin-left : 30px;" id="img-add-btn" data-id="color-{{$loop->iteration}}" onclick="load_media({{$color->id}})">
                                <i class="fa fa-lg fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                      </div>

                        <?php /* ?>
                        <div class="form-group col-4">
                            @include('partials.single-image-upload', [
                            'input_name' => 'front_image[]',
                            'lable_name' => trans('cruds.product.fields.front_image'),
                            'image_view_name' => 'front_image_view',
                            'image_error_name' => 'front_image_error',
                            'required' => '',
                            'image_url' => ''
                            ])
                        </div>

                        <div class="form-group col-4">
                            @include('partials.single-image-upload', [
                            'input_name' => 'back_image[]',
                            'lable_name' => trans('cruds.product.fields.back_image'),
                            'image_view_name' => 'back_image_view',
                            'image_error_name' => 'back_image_error',
                            'required' => '',
                            'image_url' => ''
                            ])
                        </div>
                        <?php */ ?>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <label>
                            Size
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label>
                            Retail Price
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label>
                            Retail Quantity
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label>
                            Wholesale Price
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label>
                            Wholesale Price Qty
                                    </label>
                                </div>
                                <div class="col-2">
                                    <label>
                            Stock
                                    </label>
                                </div>
                            </div>
                            @foreach ($sizes as $key => $size)
                            <div class="row">
                                    <div class="col-2">
                                        <div class="icheck-primary {{ $errors->has('sizes') ? 'is-invalid' : '' }}">
                                            <input type="checkbox" name="variation[{{ $color->id }}][sizes][]"
                                                id="cbSize{{$loop->iteration}}{{ $ckey }}-{{ $color->id }}" value="{{ $size->id.','.$key }}"
                                                class="cbSize_{{$loop->iteration}}_{{ $size->id }}"
                                                {{ old('sizes', $product->productProductVariations->where('color_id',$color->id)->where('size_id',$size->id)->first()->status??'') == 1 ? 'checked' : '' }}>
                                            <label for="cbSize{{$loop->iteration}}{{ $ckey }}-{{ $color->id }}">
                                                {{ $size->name . ' (' . $size->value . ')' }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-2">
                                        <input class="form-control single_price_{{ $color->id }} {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            type="text" name="variation[{{ $color->id }}][single_price][]" id="txtSinglePrice_{{ $loop->iteration }}_{{$size->id}}"
                                            value="{{ old('price',$product->productProductVariations->where('color_id',$color->id)->where('size_id',$size->id)->first()->single_price??'') }}" onkeypress="return isFloat(event)"
                                            maxlength="10" placeholder="Retail Price">
                                    </div>


                                    <div class="form-group col-2">
                                        <input class="form-control single_price_quantity_{{ $color->id }} {{ $errors->has('single_price_quantity') ? 'is-invalid' : '' }}"
                                            type="text" name="variation[{{ $color->id }}][single_price_quantity][]" value="{{ old('single_price_quantity',$product->productProductVariations->where('color_id',$color->id)->where('size_id',$size->id)->first()->single_price_quantity ?? '') }}"
                                            placeholder="Retail Quantity"
                                            onkeypress="return isFloat(event)" maxlength="8"
                                            id="singleQty_{{$loop->iteration }}_{{$size->id}}"
                                            >
                                    </div>

                                    <div class="form-group col-2">
                                        <input class="form-control wholesale_price_{{ $color->id }} {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            type="text" name="variation[{{ $color->id }}][wholesale_price][]" id="wholesalePrice_{{$loop->iteration }}_{{$size->id}}"
                                            value="{{ old('price',$product->productProductVariations->where('color_id',$color->id)->where('size_id',$size->id)->first()->wholesale_price??'') }}" onkeypress="return isFloat(event)"
                                            maxlength="10" placeholder="{{ trans('cruds.product.fields.wholesale_price') }}">
                                    </div>
                                    <div class="form-group col-2">
                                        <input class="form-control wholesale_price_quantity_{{ $color->id }} {{ $errors->has('wholesale_price_quantity') ? 'is-invalid' : '' }}"
                                            type="text" name="variation[{{ $color->id }}][wholesale_price_quantity][]" value="{{ old('wholesale_price_quantity',$product->productProductVariations->where('color_id',$color->id)->where('size_id',$size->id)->first()->wholesale_price_quantity ?? '') }}"
                                            placeholder="Wholesale Price Quantity"
                                            onkeypress="return isFloat(event)" maxlength="8"
                                            id="wholesaleQty_{{$loop->iteration }}_{{$size->id}}"
                                            >
                                    </div>


                                    <div class="form-group col-2">
                                        <select
                                            class="form-control {{ $errors->has('size_status') ? 'is-invalid' : '' }}"
                                            name="variation[{{ $color->id }}][size_status][]" id="size_status" required>
                                            <option value disabled
                                                {{ old('size_status', $product->productProductVariations->where('color_id',$color->id)->where('size_id',$size->id)->first()->size_status??'') === null ? 'selected' : '' }}>
                                                {{ trans('global.pleaseSelect') }}
                                            </option>

                                            @foreach (App\Models\Product::IN_STOCK_SELECT as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ old('size_status', 1) == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('size_status'))
                                            <span class="text-danger">
                                                {{ $errors->first('size_status') }}
                                            </span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.status_helper') }}
                                        </span>
                                    </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endif
                            </div>
                        </div>
                    </div>