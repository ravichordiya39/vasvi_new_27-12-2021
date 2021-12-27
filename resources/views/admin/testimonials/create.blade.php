@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.testimonial.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.testimonials.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" class="form-row" action="{{ route("admin.testimonials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-2">
                <label class="required" for="gender">Gender</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}"  name="gender" id="gender" value="{{ old('gender', '') }}" required>
                    <option value="">Select one</option>
                    <option value="Mr">Mr</option>
                    <option value="Miss">Miss</option>
                </select>
                @if($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.city_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label class="required" for="full_name">{{ trans('cruds.testimonial.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <span class="text-danger">{{ $errors->first('full_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group col-2">
                <label class="required" for="city">{{ trans('cruds.testimonial.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.city_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                {{-- @include('partials.single-image-upload', [
                'input_name' => 'image',
                'lable_name' => trans('cruds.coupon.fields.image'),
                'image_view_name' => 'image_view',
                'image_error_name' => 'image_error',
                'required' => '',
                'image_url' => ''
                ]) --}}
                <label for="image">Image</label>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".take-image-modal" id="image">Upload</button>
                <span class="text-warning">&nbsp;* Image should be maximum 50kb</span>
                <span class="mx-2 text-secondary" id="img-name"></span>
                @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.image_helper') }}</span>
                <div class="image-load">
                    {{-- load dynamic image --}}
                </div>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.testimonial.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.image_helper') }}</span>
            </div> --}}
            <div class="form-group col-6">
                <label class="required" for="description">{{ trans('cruds.testimonial.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.description_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required">{{ trans('cruds.testimonial.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Testimonial::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.status_helper') }}</span>
            </div>
            <div class="form-group text-right col-12">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@include('admin.upload.index');

@endsection

@section('scripts')
@include('admin.mediascript.singlecategory')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.testimonials.storeMedia') }}',
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
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($testimonial) && $testimonial->image)
      var file = {!! json_encode($testimonial->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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
