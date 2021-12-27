@extends('layouts.admin')
@section('content')

<div class="card">

    <div class="card-header">
      {{ trans('global.create') }} {{ trans('cruds.blog.title_singular') }}
      <a class="btn btn-secondary float-right" href="{{ route('admin.blogs.index') }}">
          {{ trans('global.back') }}
      </a>
     </div>

    <div class="card-body">
        <form method="POST" class="form-row" action="{{ route("admin.blogs.update", [$blog->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-4">
                <label class="required" for="title">{{ trans('cruds.blog.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.title_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label class="required" for="sub_title">{{ trans('cruds.blog.fields.sub_title') }}</label>
                <input class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" type="text" name="sub_title" id="sub_title" value="{{ old('sub_title', $blog->sub_title) }}" required>
                @if($errors->has('sub_title'))
                    <span class="text-danger">{{ $errors->first('sub_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.sub_title_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label class="required" for="slug">{{ trans('cruds.blog.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $blog->slug) }}" required>
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.slug_helper') }}</span>
            </div>
            <div class="form-group col-4">
              <label for="meta_title">{{ trans('cruds.blog.fields.meta_title') }}</label>
              <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $blog->meta_title) }}">
              @if($errors->has('meta_title'))
                  <span class="text-danger">{{ $errors->first('meta_title') }}</span>
              @endif
              <span class="help-block">{{ trans('cruds.blog.fields.meta_title_helper') }}</span>
          </div>
          <div class="form-group col-4">
            <label for="tags">{{ trans('cruds.blog.fields.tags') }}</label>
            <input class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="text" name="tags" id="tags" value="{{ old('tags', $blog->tags) }}">
            @if($errors->has('tags'))
                <span class="text-danger">{{ $errors->first('tags') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.blog.fields.tags_helper') }}</span>
        </div>
        <div class="form-group col-4">
            <label class="required" for="published_on">{{ trans('cruds.blog.fields.published_on') }}</label>
            <input class="form-control datetime {{ $errors->has('published_on') ? 'is-invalid' : '' }}" type="text" name="published_on" id="published_on" value="{{ old('published_on', $blog->published_on) }}" required>
            @if($errors->has('published_on'))
                <span class="text-danger">{{ $errors->first('published_on') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.blog.fields.published_on_helper') }}</span>
        </div>
        <div class="form-group col-4">
                <label for="meta_keyword">{{ trans('cruds.blog.fields.meta_keyword') }}</label>
                <textarea class="form-control {{ $errors->has('meta_keyword') ? 'is-invalid' : '' }}" name="meta_keyword" id="meta_keyword">{{ old('meta_keyword', $blog->meta_keyword) }}</textarea>
                @if($errors->has('meta_keyword'))
                    <span class="text-danger">{{ $errors->first('meta_keyword') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.meta_keyword_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label for="meta_description">{{ trans('cruds.blog.fields.meta_description') }}</label>
                <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" id="meta_description">{{ old('meta_description', $blog->meta_description) }}</textarea>
                @if($errors->has('meta_description'))
                    <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.meta_description_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
              {{-- @include('partials.single-image-upload', [
              'input_name' => 'image',
              'lable_name' => trans('cruds.blog.fields.image'),
              'image_view_name' => 'image_view',
              'image_error_name' => 'image_error',
              'required' => '',
              'image_url' => ''
              ]) --}}

              <label for="image">Image</label><br/>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".take-image-modal" id="image">Upload</button>
              <br>
              <span class="text-warning">&nbsp;* Image should be maximum 200kb</span>
              @if ($errors->has('image'))
                  <span class="text-danger">{{ $errors->first('image') }}</span>
              @endif
              <span class="help-block">{{ trans('cruds.blog.fields.image_helper') }}</span>
              <div class="image-load">
                  {{-- load dynamic image --}}
                  <img src="{{asset("file/$blog->image")}}" style="width : 120px;" class="my-2"/>
                  <input type="hidden" name="image" value="${{$blog->image}}"/>
              </div>
          </div>
            {{-- <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.blog.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.image_helper') }}</span>
            </div> --}}
            <div class="form-group col-8">
                <label for="description">{{ trans('cruds.blog.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $blog->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.description_helper') }}</span>
            </div>

            <div class="form-group col-4">
                <label class="required">{{ trans('cruds.blog.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Blog::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $blog->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.status_helper') }}</span>
            </div>
            <div class="form-group text-right col-12">
                <button class="btn btn-warning" type="submit">
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
    url: '{{ route('admin.blogs.storeMedia') }}',
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
@if(isset($blog) && $blog->image)
      var file = {!! json_encode($blog->image) !!}
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
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.blogs.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $blog->id ?? 0 }}');
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

@endsection
