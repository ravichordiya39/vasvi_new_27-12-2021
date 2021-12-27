@extends('layouts.admin')
@section('content')

<div class="card">
  <div class="card-header">
    {{ trans('global.create') }} {{ trans('cruds.cmsPage.title_singular') }}
    <a class="btn btn-secondary float-right" href="{{ route('admin.cms-pages.index') }}">
        {{ trans('global.back') }}
    </a>
</div>

    <div class="card-body">
        <form method="POST" class="form-row" action="{{ route("admin.cms-pages.update", [$cmsPage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-3">
                <label class="required" for="title">{{ trans('cruds.cmsPage.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $cmsPage->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.title_helper') }}</span>
            </div>
            <div class="form-group col-3">
              <label class="required" for="sub_title">{{ trans('cruds.cmsPage.fields.sub_title') }}</label>
              <input class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" type="text" name="sub_title" id="sub_title" value="{{ old('sub_title', $cmsPage->title) }}" required>
              @if($errors->has('sub_title'))
                  <span class="text-danger">{{ $errors->first('sub_title') }}</span>
              @endif
              <span class="help-block">{{ trans('cruds.cmsPage.fields.sub_title_helper') }}</span>
          </div>
            <div class="form-group col-3">
                <label for="slug">{{ trans('cruds.cmsPage.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $cmsPage->slug) }}">
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.slug_helper') }}</span>
            </div>
            <div class="form-group col-3">
                <label for="url">{{ trans('cruds.cmsPage.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $cmsPage->url) }}">
                @if($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.url_helper') }}</span>
            </div>
            <div class="form-group col-3">
                <label for="image">{{ trans('cruds.cmsPage.fields.image') }}</label>
                <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="text" name="image" id="image" value="{{ old('image', $cmsPage->image) }}">
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.image_helper') }}</span>
            </div>
            <div class="form-group col-3">
                <label for="meta_title">{{ trans('cruds.cmsPage.fields.meta_title') }}</label>
                <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $cmsPage->meta_title) }}">
                @if($errors->has('meta_title'))
                    <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.meta_title_helper') }}</span>
            </div>
            <div class="form-group col-3">
              <label for="tags">{{ trans('cruds.cmsPage.fields.tags') }}</label>
              <input class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="text" name="tags" id="tags" value="{{ old('tags', $cmsPage->tags) }}">
              @if($errors->has('tags'))
                  <span class="text-danger">{{ $errors->first('tags') }}</span>
              @endif
              <span class="help-block">{{ trans('cruds.cmsPage.fields.tags_helper') }}</span>
            </div>
            <div class="form-group col-3">
                <label class="required">{{ trans('cruds.cmsPage.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CmsPage::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $cmsPage->status) == (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.status_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label for="meta_keyword">{{ trans('cruds.cmsPage.fields.meta_keyword') }}</label>
                <textarea class="form-control {{ $errors->has('meta_keyword') ? 'is-invalid' : '' }}" name="meta_keyword" id="meta_keyword">{{ old('meta_keyword', $cmsPage->meta_keyword) }}</textarea>
                @if($errors->has('meta_keyword'))
                    <span class="text-danger">{{ $errors->first('meta_keyword') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.meta_keyword_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label for="meta_description">{{ trans('cruds.cmsPage.fields.meta_description') }}</label>
                <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" id="meta_description">{{ old('meta_description', $cmsPage->meta_description) }}</textarea>
                @if($errors->has('meta_description'))
                    <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.meta_description_helper') }}</span>
            </div>

            <div class="form-group col-12">
                <label for="cms-desc">{{ trans('cruds.cmsPage.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="ckeditor">{!! old('description', $cmsPage->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cmsPage.fields.description_helper') }}</span>
            </div>



            <div class="form-group text-right col-12">
                <button class="btn btn-warning" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>

        </form>
    </div>
</div>



@endsection

@section('scripts')

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
                xhr.open('POST', '{{ route('admin.cms-pages.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $cmsPage->id ?? 0 }}');
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
        extraPlugins: [SimpleUploadAdapter],
      }
    );
  }
});
</script>

@endsection
