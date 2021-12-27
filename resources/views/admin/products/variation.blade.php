
<?php $z = 0; ?>

@foreach ($colors as $ckey => $color)

    <div class="accordion" id="accordionVariation">
        <div class="card">
            <div class="card-header" id="colorHeading{{ $loop->iteration }}">
                <div class="row">
                    <div class="col-2">
                        <div class="icheck-primary {{ $errors->has('same_price') ? 'is-invalid' : '' }}" style="display : inline-block";>
                            <input type="checkbox" name="same_price[]" id="same_price{{ $color->id }}"
                                class="same-price" data-number="{{ $color->id }}"
                                value="{{ $loop->iteration }}" {{ old('same_price', 0) == 1 ? 'checked' : '' }}>
                            <label for="same_price{{ $color->id }}">
                            </label>
                            <span >For all sizes</span>
                        </div>

                        <button class="btn btn-link  text-dark font-weight-bold text-left text-uppercase"
                            type="button" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}"
                            aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}" style="width : 80%;">
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
                            value="" onblur="txtSinglePrice('{{ $color->id }}')" onkeypress="return isFloat(event)"
                            maxlength="10" placeholder="Retail Price" disabled>
                    </div>
                    <div class="form-group col-2">
                        <input class="form-control"
                            type="text" name="single_price_quantity_{{ $color->id }}" id="txtSinglePrice_quantity_{{ $color->id }}"
                            value="" onblur="txtSinglePriceQuantity('{{ $color->id }}')" onkeypress="return isFloat(event)"
                            maxlength="10" placeholder="Retail Quantity" disabled>
                    </div>
                    <div class="form-group col-2">
                        <input class="form-control"
                            type="text" name="wholesale_price_{{ $color->id }}" id="txtwholesalePrice_{{ $color->id }}"
                            value="" onblur="txtWholesalePrice('{{ $color->id }}')" onkeypress="return isFloat(event)"
                            maxlength="10" placeholder="Wholesale Price" disabled>
                    </div>
                    <div class="form-group col-2">
                        <input class="form-control"
                            type="text" name="wholesale_price_quantity_{{ $color->id }}" id="txtwholesalePrice_quantity_{{ $color->id }}"
                            value="" onblur="txtWholesalePriceQuantity('{{ $color->id }}')" onkeypress="return isFloat(event)"
                            maxlength="10" placeholder="Wholesale Price Qty" disabled>
                    </div>

                    <div class="col-1">
                        <div class="icheck-primary m-5">
                            <input type="checkbox" name="sameforall[]" id="sameforall_{{ $color->id }}"
                                class="same_for_all" data-number="{{ $color->id }}"
                                value="{{ $loop->iteration }}" disabled>
                            <label for="sameforall_{{ $color->id }}"></label>
                            <span >Same qty for all</span>
                        </div>
                    </div>
                    <div class="col-1">
                        {{-- <div class="">
                            <input type="checkbox" name="primary[{{ $color->id }}]" value="1" class="foo" required>
                            <label >
                                Primary Variation
                            </label>
                        </div> --}}
                        <div class="icheck-primary">
                            <input type="checkbox" name="primary[{{ $color->id }}]" id="primarydata{{$color->id}}" data-member="{{$color->id}}"
                                 value="1" data-toggle='tooltip' data-placement='right' data-original-title="tooltip here" class='checkbox' >
                                 <label for="primarydata{{$color->id}}"></label>
                                 <span >Primary Variation</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="collapse{{ $loop->iteration }}" class="collapse {{ $ckey ? '' : 'show' }}"
                aria-labelledby="colorHeading{{ $loop->iteration }}" data-parent="#accordionVariation">
                <div class="card-body">
                    <div class="row mb-0 py-0">
                      <div class="form-group col-12">
                        <input type="hidden" name="color_id[]" value="{{ $color->id }}">
                        <div class="input-field">
                            <div id="clr{{ $color->id }}" custom1="{{ $color->id }}" class="input-images" style="padding-top: .5rem;">

                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row" id="merge-image-{{$loop->iteration}}">
                                {{-- <div class="col-2">
                                    <div class="border p-2"  id="add-image">
                                        <i class="fa fa-times" style="" id="img-cross"> </i>
                                        <img src="{{asset('front_assets/images/ARP3514.jpg')}}" class="w-100" style="height : 150px;">
                                        <input type="hidden" name="gallery[{{$loop->iteration}}][]" value="">
                                    </div>
                                </div> --}}
                                <div class="col-2" id="before-btn-{{$color->id}}">
                                    <div class="w-100" style="height : 170px;">
                                        <button type="button" class="btn btn-primary btn-circle btn-sm center-block" style="margin-top : 40%; margin-left : 30px;" id="img-add-btn" data-id="color-{{$loop->iteration}}" onclick="load_media({{$color->id}})">
                                            <i class="fa fa-lg fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center">
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
                            <div class="row">
                                @foreach ($sizes as $key => $size)
                                    <div class="col-2">
                                        <div class="icheck-primary {{ $errors->has('sizes') ? 'is-invalid' : '' }}">
                                            <input type="checkbox" name="variation[{{ $color->id }}][sizes][]"
                                                id="cbSize{{$loop->iteration}}{{ $ckey }}-{{ $color->id }}"  value="{{ $size->id.','.$key }}"
                                                data-id="{{$loop->iteration }}_{{$color->id}}"
                                                {{ old('sizes', 0) == 1 ? 'checked' : '' }}>
                                            <label for="cbSize{{$loop->iteration}}{{ $ckey }}-{{ $color->id }}">
                                                {{ $size->name . ' (' . $size->value . ')' }}
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group col-2">
                                        <input class="form-control single_price_{{ $color->id }} {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            type="text" name="variation[{{ $color->id }}][single_price][]" id="txtSinglePrice_{{ $loop->iteration }}_{{$color->id}}"
                                            value="{{ old('price') }}" onkeypress="return isFloat(event)"
                                            maxlength="10" placeholder="Retail Price">
                                    </div>

                                    <div class="form-group col-2">
                                        <input class="form-control single_price_quantity_{{ $color->id }} {{ $errors->has('single_price_quantity') ? 'is-invalid' : '' }}"
                                            type="text" name="variation[{{ $color->id }}][single_price_quantity][]" value="{{ old('single_price_quantity') }}"
                                            placeholder="Retail Quantity"
                                            onkeypress="return isFloat(event)"
                                            maxlength="8"
                                            id="singleQty_{{$loop->iteration }}_{{$color->id}}"
                                            >
                                    </div>

                                    <div class="form-group col-2">
                                        <input class="form-control wholesale_price_{{ $color->id }} {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            type="text" name="variation[{{ $color->id }}][wholesale_price][]" id="wholesalePrice_{{$loop->iteration }}_{{$color->id}}"
                                            value="{{ old('wholesale_price') }}" onkeypress="return isFloat(event)"
                                            maxlength="10" placeholder="Wholesale Price">
                                    </div>
                                    <div class="form-group col-2">
                                        <input class="form-control wholesale_price_quantity_{{ $color->id }} {{ $errors->has('wholesale_price_quantity') ? 'is-invalid' : '' }}"
                                            type="text" name="variation[{{ $color->id }}][wholesale_price_quantity][]" value="{{ old('wholesale_price_quantity') }}"
                                            placeholder="Wholesale Price Quantity"
                                            onkeypress="return isFloat(event)" maxlength="8"
                                            id="wholesaleQty_{{$loop->iteration }}_{{$color->id}}"
                                            >
                                    </div>

                                    <div class="form-group col-2">
                                        <select
                                            class="form-control {{ $errors->has('size_status') ? 'is-invalid' : '' }}"
                                            name="variation[{{ $color->id }}][size_status][]" id="size_status" required>
                                            <option value disabled
                                                {{ old('size_status', null) === null ? 'selected' : '' }}>
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
