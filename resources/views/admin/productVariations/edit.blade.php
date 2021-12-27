@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productVariation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-variations.update", [$productVariation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.productVariation.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $productVariation->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="color_id">{{ trans('cruds.productVariation.fields.color') }}</label>
                <select class="form-control select2 {{ $errors->has('color') ? 'is-invalid' : '' }}" name="color_id" id="color_id" required>
                    @foreach($colors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('color_id') ? old('color_id') : $productVariation->color->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('color'))
                    <span class="text-danger">{{ $errors->first('color') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.color_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="size_id">{{ trans('cruds.productVariation.fields.size') }}</label>
                <select class="form-control select2 {{ $errors->has('size') ? 'is-invalid' : '' }}" name="size_id" id="size_id" required>
                    @foreach($sizes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('size_id') ? old('size_id') : $productVariation->size->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('size'))
                    <span class="text-danger">{{ $errors->first('size') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.size_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mrp_price">{{ trans('cruds.productVariation.fields.mrp_price') }}</label>
                <input class="form-control {{ $errors->has('mrp_price') ? 'is-invalid' : '' }}" type="number" name="mrp_price" id="mrp_price" value="{{ old('mrp_price', $productVariation->mrp_price) }}" step="0.01" required>
                @if($errors->has('mrp_price'))
                    <span class="text-danger">{{ $errors->first('mrp_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.mrp_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sales_price">{{ trans('cruds.productVariation.fields.sales_price') }}</label>
                <input class="form-control {{ $errors->has('sales_price') ? 'is-invalid' : '' }}" type="number" name="sales_price" id="sales_price" value="{{ old('sales_price', $productVariation->sales_price) }}" step="0.01">
                @if($errors->has('sales_price'))
                    <span class="text-danger">{{ $errors->first('sales_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.sales_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="front_image">{{ trans('cruds.productVariation.fields.front_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('front_image') ? 'is-invalid' : '' }}" id="front_image-dropzone">
                </div>
                @if($errors->has('front_image'))
                    <span class="text-danger">{{ $errors->first('front_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.front_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="back_image">{{ trans('cruds.productVariation.fields.back_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('back_image') ? 'is-invalid' : '' }}" id="back_image-dropzone">
                </div>
                @if($errors->has('back_image'))
                    <span class="text-danger">{{ $errors->first('back_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.back_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.productVariation.fields.in_stock') }}</label>
                <select class="form-control {{ $errors->has('in_stock') ? 'is-invalid' : '' }}" name="in_stock" id="in_stock" required>
                    <option value disabled {{ old('in_stock', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductVariation::IN_STOCK_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('in_stock', $productVariation->in_stock) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('in_stock'))
                    <span class="text-danger">{{ $errors->first('in_stock') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.in_stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.productVariation.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductVariation::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $productVariation->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productVariation.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.frontImageDropzone = {
    url: '{{ route('admin.product-variations.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="front_image"]').remove()
      $('form').append('<input type="hidden" name="front_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="front_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($productVariation) && $productVariation->front_image)
      var file = {!! json_encode($productVariation->front_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="front_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    Dropzone.options.backImageDropzone = {
    url: '{{ route('admin.product-variations.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="back_image"]').remove()
      $('form').append('<input type="hidden" name="back_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="back_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($productVariation) && $productVariation->back_image)
      var file = {!! json_encode($productVariation->back_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="back_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection