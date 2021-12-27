@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }}
            {{ trans('cruds.attribute.title_singular') }}
            <a class="btn btn-secondary float-right" href="{{ route('admin.attributes.index') }}">
                {{ trans('global.back') }}
            </a>
        </div>
1111
        <div class="card-body">
            <form method="POST" class="form-row" action="{{ route('admin.attributes.update', [$attribute->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group col-6">
                    <label class="required" for="name">{{ trans('cruds.attribute.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $attribute->name) }}" required>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.attribute.fields.name_helper') }}</span>
                </div>

                <div class="form-group col-6">
                    <label class="required">{{ trans('cruds.attribute.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Attribute::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('status', $attribute->status) == $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.attribute.fields.status_helper') }}</span>
                </div>

                <div class="form-group col-6">
                    <label for="description">{{ trans('cruds.attribute.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        name="description" id="description">{!! old('description', $attribute->description) !!}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.attribute.fields.description_helper') }}</span>
                </div>

                {{-- <div class="form-group col-6">
                    <label class="required" for="values">
                        {{ trans('cruds.attributeValue.fields.value') . ' (' . trans('cruds.attributeValue.fields.value_helper') . ')' }}
                    </label>
                    <textarea class="form-control {{ $errors->has('values') ? 'is-invalid' : '' }}" name="values"
                        id="values" required>{!! old('values', $attribute_values) !!}</textarea>
                    @if ($errors->has('values'))
                        <span class="text-danger">{{ $errors->first('values') }}</span>
                    @endif
                </div> --}}

                <div class="form-group col-6" id="value-container">
                    <label class="required" for="values">
                        {{ trans('cruds.attributeValue.fields.value') }}
                    </label>
                    <?php $i = 0;?>
                    @foreach($attribute_values as $value)
                    <?php $i++; ?>
                    <div class="row mt-2" >
                       <div class="col-10">
                         <input type="text" class="form-control" name="{{$value->id}}" name="values[]" value="{{$value->value}}">
                       </div>
                       <div class="col-1">
                           @if($i !== 1)
                               <button class="btn btn-danger minus-btn" data-type="data" data-id="{{$value->id}}" type="button">
                                    <i class="fa fa-minus"></i>
                               </button>
                           @endif
                       </div>
                       <div class="col-1">
                        <button class="btn btn-primary add-btn"  data-id="{{$value->id}}" type="button">
                            <i class="fa fa-plus"></i>
                        </button>
                       </div>
                    </div>
                    @endforeach
                    @if ($errors->has('values'))
                        <span class="text-danger">{{ $errors->first('values') }}</span>
                    @endif
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function(){
            var value_html = `<div class="row mt-2" >
                       <div class="col-10">
                         <input type="text" class="form-control"  name="values[]" value="">
                       </div>
                       <div class="col-1">
                           <button class="btn btn-danger minus-btn" data-type="none" type="button">
                               <i class="fa fa-minus"></i>
                           </button>
                       </div>
                       <div class="col-1">
                        <button class="btn btn-primary add-btn" type="button">
                            <i class="fa fa-plus"></i>
                        </button>
                       </div>
                    </div>`;
            
                    $(document).on('click','.add-btn', function(e){
                e.preventDefault();
                $(this).remove();
                $(document).find('#value-container').append(value_html);
            })

            $(document).on('click','.minus-btn', function(e){
                e.preventDefault();
                var $this = $(this);
                var value_id = $(this).attr('data-id');
                var id_type = $(this).attr('data-type');
                if(id_type === 'data'){
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.attributes.can_delete')}}",
                        data: {value_id : value_id, attribute_id : "{{$attribute->id}}"},
                        success: function (response) {
                            console.log(response);
                            if(response.code !== 200){
                                toastr.warning('Warning!', response.message,{
                                    positionClass: 'toast-top-center',
                                    iconClass:'toast-warning',
                                });
                            }
                            else{
                                var count = 0;
                                var i = 0;
                                $('#value-container').find('.row').each(function(){
                                    count++;
                                })
                                count = count-1;
                                $('#value-container').find('.row').each(function(){
                                    i++;
                                    if(i === count){
                                        $this.children('.col-1').eq(1).html(`
                                        <button class="btn btn-primary add-btn">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        `);
                                    }
                                })
                                $this.closest('.row').remove();
                            }
                        },
                        error : function(err){
                            console.log(err);
                        }
                    });
                }
                else{
                    var count = 0;
                    var i = 0;
                    $('#value-container').find('.row').each(function(){
                        count++;
                    })
                    count = count-1;
                    $('#value-container').find('.row').each(function(){
                        i++;
                        if(i === count){
                            $(this).children('.col-1').eq(1).html(`
                            <button class="btn btn-primary add-btn">
                                <i class="fa fa-plus"></i>
                            </button>
                            `);
                        }
                    })
                    $(this).closest('.row').remove();
                }
            })
        })
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
                                            '{{ route('admin.attributes.storeCKEditorImages') }}',
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
                                        data.append('crud_id', '{{ $attribute->id ?? 0 }}');
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
