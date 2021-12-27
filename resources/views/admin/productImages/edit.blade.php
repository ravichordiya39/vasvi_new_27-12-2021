@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.productImage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-images.update", [$productImage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.productImage.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $productImage->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productImage.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.productImage.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ProductImage::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $productImage->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productImage.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="file_name">{{ trans('cruds.productImage.fields.file_name') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_name') ? 'is-invalid' : '' }}" id="file_name-dropzone">
                </div>
                @if($errors->has('file_name'))
                    <span class="text-danger">{{ $errors->first('file_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.productImage.fields.file_name_helper') }}</span>
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
    var uploadedFileNameMap = {}
Dropzone.options.fileNameDropzone = {
    url: '{{ route('admin.product-images.storeMedia') }}',
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file_name[]" value="' + response.name + '">')
      uploadedFileNameMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileNameMap[file.name]
      }
      $('form').find('input[name="file_name[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($productImage) && $productImage->file_name)
          var files =
            {!! json_encode($productImage->file_name) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file_name[]" value="' + file.file_name + '">')
            }
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