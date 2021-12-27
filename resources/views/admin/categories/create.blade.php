@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            @empty($category)
                {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
                <a class="btn btn-secondary float-right" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_category') }}
                </a>
            @else
                {{ trans('global.create') }} {{ trans('cruds.subcategory.title_singular') }}
                (
                <strong>
                    {{ $category->name }}
                </strong>
                )
                <a class="btn btn-secondary float-right"
                    href="{{ route('admin.subcategories.index', ['id' => $category->id]) }}">
                    {{ trans('global.back_to_sub_category') }}
                </a>
            @endempty
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="parent_id" value="{{ $category->id ?? 0 }}">

                    <div class="form-group col-md-6">
                        <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', '') }}" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                    </div>

                    <div class="form-group col-md-3">
                        <label>{{ trans('cruds.category.fields.is_home_msg') }}</label>
                        <div class="form-check {{ $errors->has('is_home') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="is_home" value="0">
                            <input class="form-check-input" type="checkbox" name="is_home" id="is_home" value="1"
                                {{ old('is_home', 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="is_home">{{ trans('cruds.category.fields.is_home') }}</label>
                        </div>
                        @if ($errors->has('is_home'))
                            <span class="text-danger">{{ $errors->first('is_home') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.category.fields.is_home_helper') }}</span>
                    </div>

                    <div class="form-group col-md-3">
                        <label>{{ trans('cruds.category.fields.is_menu_msg') }}</label>
                        <div class="form-check {{ $errors->has('is_menu') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="is_menu" value="0">
                            <input class="form-check-input" type="checkbox" name="is_menu" id="is_menu" value="1"
                                {{ old('is_menu', 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="is_menu">{{ trans('cruds.category.fields.is_menu') }}</label>
                        </div>
                        @if ($errors->has('is_menu'))
                            <span class="text-danger">{{ $errors->first('is_menu') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.category.fields.is_menu_helper') }}</span>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="required">{{ trans('cruds.category.fields.status') }}</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                            id="status" required>
                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Category::STATUS_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.category.fields.status_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        {{-- @include('partials.single-image-upload', [
                        'input_name' => 'image',
                        'lable_name' => trans('cruds.category.fields.image'),
                        'image_view_name' => 'image_view',
                        'image_error_name' => 'image_error',
                        'required' => '',
                        'image_url' => ''
                        ]) --}}

                        <label for="image">Banner</label>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".take-image-modal" id="image">Upload</button>
                        &nbsp;
                        <span class="text-warning">* Banner size should be maximum 100px.</span>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                        <div class="image-load" >
                            {{-- load dynamic image --}}
                        </div>
                    </div>

                    @if (isset($category->id))
                        <div class="form-group col-md-3">
                            @include('partials.single-image-upload', [
                            'input_name' => 'size_chart',
                            'lable_name' => trans('cruds.category.fields.size_chart'),
                            'image_view_name' => 'size_chart_view',
                            'image_error_name' => 'size_chart_error',
                            'required' => '',
                            'image_url' => ''
                            ])
                        </div>
                    @endif
                    <div class="form-group col-md-12  text-right">
                        <button class="btn btn-success " type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@include('admin.upload.index');
@endsection
@section('scripts')
@include('admin.mediascript.singlecategory')
@endsection
