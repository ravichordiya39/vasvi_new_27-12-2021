@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.attributeValue.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.attribute-values.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attribute-values.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="attribute_id">{{ trans('cruds.attributeValue.fields.attribute') }}</label>
                <select class="form-control select2 {{ $errors->has('attribute') ? 'is-invalid' : '' }}" name="attribute_id" id="attribute_id" required>
                    @foreach($attributes as $id => $entry)
                        <option value="{{ $id }}" {{ old('attribute_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('attribute'))
                    <span class="text-danger">{{ $errors->first('attribute') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attributeValue.fields.attribute_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.attributeValue.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attributeValue.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.attributeValue.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', '') }}" required>
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attributeValue.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.attributeValue.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AttributeValue::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.attributeValue.fields.status_helper') }}</span>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection