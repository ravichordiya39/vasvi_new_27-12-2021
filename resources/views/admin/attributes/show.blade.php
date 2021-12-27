@extends('layouts.admin')
@section('content')

<div class="card">
   
    <div class="card-header">
        {{ trans('cruds.attribute.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.attributes.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.attribute.fields.id') }}
                        </th>
                        <td>
                            {{ $attribute->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attribute.fields.name') }}
                        </th>
                        <td>
                            {{ $attribute->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attribute.fields.description') }}
                        </th>
                        <td>
                            {!! $attribute->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.attribute.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Attribute::STATUS_SELECT[$attribute->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
        </div>
    </div>
</div>

<div class="card">
    {{-- <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#attribute_attribute_values" role="tab" data-toggle="tab">
                {{ trans('cruds.attributeValue.title') }}
            </a>
        </li>
    </ul> --}}
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="attribute_attribute_values">
            @includeIf('admin.attributes.relationships.attribute_values', ['attributeValues' => $attribute->attribute_values])
        </div>
    </div>
</div>

@endsection