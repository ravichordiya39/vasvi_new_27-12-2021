@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.socialProfileType.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.social-profile-types.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" class="form-row" action="{{ route("admin.social-profile-types.update", [$socialProfileType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-6">
                <label class="required" for="name">{{ trans('cruds.socialProfileType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $socialProfileType->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.socialProfileType.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required">{{ trans('cruds.socialProfileType.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SocialProfileType::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $socialProfileType->status) == (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.socialProfileType.fields.status_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                {{-- @include('partials.single-image-upload', [
                'input_name' => 'logo',
                'lable_name' => trans('cruds.coupon.fields.image'),
                'image_view_name' => 'image_view',
                'image_error_name' => 'image_error',
                'required' => '',
                'image_url' => ''
                ]) --}}

                <label for="logo">Image</label><br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".take-image-modal" id="logo">Upload</button>
                <br>
                <span class="text-warning">&nbsp;* Image shoulg be maximum 50kb</span>
                @if ($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
              
                <div class="image-load">
                    {{-- load dynamic image --}}
                    <img src="{{asset("file/$socialProfileType->logo")}}" style="width : 120px;" class="my-2"/>
                    <input type="hidden" name="logo" value="${{$socialProfileType->logo}}"/>
                </div>
            </div>
            {{-- <div class="form-group col-6">
                <label class="required" for="logo">{{ trans('cruds.socialProfileType.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.socialProfileType.fields.logo_helper') }}</span>
            </div> --}}

            <div class="form-group text-right col-12">
                <button class="btn btn-warning" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>

@include('admin.upload.index');

@endsection

@section('scripts')
@include('admin.mediascript.single')
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.social-profile-types.storeMedia') }}',
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
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($socialProfileType) && $socialProfileType->logo)
      var file = {!! json_encode($socialProfileType->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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
