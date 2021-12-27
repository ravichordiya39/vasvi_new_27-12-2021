@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.category.title') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.categories.index') }}">
            {{ trans('global.back_to_category') }}
        </a>
    </div>
   

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.id') }}
                        </th>
                        <td>
                            {{ $category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.name') }}
                        </th>
                        <td>
                            {{ $category->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.slug') }}
                        </th>
                        <td>
                            {{ $category->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.parent') }}
                        </th>
                        <td>
                            {{ $category->parent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.image') }}
                        </th>
                        <td>
                            @if($category->image)
                                <a href="{{ $category->image_url }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $category->thumb_url }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.size_chart') }}
                        </th>
                        <td>
                            @if($category->size_chart)
                                <a href="{{ $category->size_chart->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $category->size_chart->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.is_home') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $category->is_home ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.is_menu') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $category->is_menu ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.category.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Category::STATUS_SELECT[$category->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection