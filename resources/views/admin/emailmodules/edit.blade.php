@extends('layouts.admin')
@section('content')


    <div class="card">
        <div class="card-header">
           Email Module
        </div>

        <div class="card-body">
            <form action="{{route('admin.emailmodule.update', ['id' => $module->id])}}" method="post">
                @csrf
                <div class="form-group col-4">
                    <label for="tax_rate">
                        Title
                    </label>

                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                         name="title" id="title" value="{{ old('title', $module->title) }}"
                        disabled>

                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif

                    <span class="help-block">
                        {{ trans('cruds.product.fields.tax_rate_helper') }}
                    </span>
                </div>
                <div class="form-group col-12">
                    <label for="care_and_disclaimer" >
                        Mail Body
                    </label>

                    <textarea
                        class="form-control editor {{ $errors->has('body') ? 'is-invalid' : '' }}"
                        name="body" id="editor">{{$module->body}}</textarea>

                    @if ($errors->has('body'))
                        <span class="text-danger">
                            {{ $errors->first('body') }}
                        </span>
                    @endif

                    <span class="help-block">
                        {{ trans('cruds.product.fields.description_helper') }}
                    </span>
                </div>
                <div class="col-12">
                    <button class="btn btn-warning" type="submit">update</button>
                </div>
            </form>
        </div>
    </div>




@endsection
@section('scripts')
<script src="{{ asset('assets/editor/ckeditor.js') }}"></script>
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
                                        '{{ route('admin.emailmodule.storeCKEditorImages') }}',
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

        var allEditors = document.querySelectorAll('.editor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(
                allEditors[i], {
                    extraPlugins: [SimpleUploadAdapter]
                }
            );
        }


      CKEDITOR.replace( 'editor' );
      CKEDITOR.add
    });

</script>


@endsection
