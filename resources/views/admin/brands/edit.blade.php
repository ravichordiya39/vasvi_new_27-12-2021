@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.brand.title_singular') }}
            <a class="btn btn-secondary float-right" href="{{ route('admin.brands.index') }}">
                {{ trans('global.back') }}
            </a>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.brands.update', [$brand->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required" for="name">{{ trans('cruds.brand.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', $brand->name) }}" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.brand.fields.name_helper') }}</span>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="required">{{ trans('cruds.brand.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                            id="status" required>
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Brand::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('status', $brand->status) == (string) $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.brand.fields.status_helper') }}</span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="description">{{ trans('cruds.brand.fields.description') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            name="description" id="description">{!! old('description', $brand->description) !!}</textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.brand.fields.description_helper') }}</span>
                    </div>

                    <div class="form-group col-md-6">
                        {{-- @include('partials.single-image-upload', [
                        'input_name' => 'logo',
                        'lable_name' => trans('cruds.brand.fields.logo'),
                        'image_view_name' => 'logo_view',
                        'image_error_name' => 'logo_error',
                        'required' => '',
                        'image_url' => $brand->thumb_url
                        ]) --}}

                        <label for="logo">Logo</label>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".take-image-modal" id="logo">Upload</button>&nbsp;<span class="text-warning">* Image size should be maximum 50px.</span>
                        @if ($errors->has('logo'))
                            <span class="text-danger">{{ $errors->first('logo') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.brand.fields.logo_helper') }}</span>
                        <div class="image-load">
                            {{-- load dynamic image --}}
                            <img src="{{$brand->thumb_url}}" style="width : 120px;" class="my-2"/>
                            <input type="hidden" name="logo" value="${{$brand->logo}}"/>
                        </div>
                    </div>



                    <div class="form-group col-md-12 text-right">
                        <button class="btn btn-warning" type="submit">
                            {{ trans('global.update') }}
                        </button>
                    </div>
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
            url: '{{ route('admin.brands.storeMedia') }}',
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
                height: 4096,
                folder: 'brand'
            },
            success: function(file, response) {
                $('form').find('input[name="logo"]').remove()
                $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($brand) && $brand->logo)
                    var file = {!! json_encode($brand->logo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
                                            '{{ route('admin.brands.storeCKEditorImages') }}',
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
                                        data.append('crud_id', '{{ $brand->id ?? 0 }}');
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
