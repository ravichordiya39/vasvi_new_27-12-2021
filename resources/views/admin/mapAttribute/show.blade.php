@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.mapattribute.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.mapattribute.fields.id') }}
                            </th>
                            <td>
                                {{ $mapAttribute->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.mapattribute.fields.category') }}
                            </th>
                            <td>
                                {{ $mapAttribute->category->name ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.mapattribute.fields.subcategory') }}
                            </th>
                            <td>
                                {{ $mapAttribute->subcategory->name ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.mapattribute.fields.subchildcategory') }}
                            </th>
                            <td>
                                {{ $mapAttribute->subchildcategory->name ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.mapattribute.fields.size') }}
                            </th>
                            <td>
                                @forelse ($sizes as $size)
                                    <div class="d-inline px-3 py-1 mr-2 rounded shadow-sm bg-secondary">
                                        {{ $size->name . ' (' . $size->value . ')' }}
                                    </div>
                                @empty
                                -
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.mapattribute.fields.color') }}
                            </th>
                            <td>
                            @forelse ($colors as $color)
                                    <div class="d-inline px-3 py-1 mr-2 rounded shadow-sm bg-secondary">
                                        {{ $color->name }} <input type="color" value="{{$color->value}}" readonly disabled>
                                    </div>
                            @empty
                            -
                            @endforelse
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.mapattribute.fields.brand') }}
                            </th>
                            <td>
                            @forelse ($brands as $brand)
                                    <div class="d-inline px-3 py-1 mr-2 rounded shadow-sm bg-secondary">
                                        {{ $brand->name}}
                                    </div>
                                @empty
                                -
                                @endforelse
                            </td>
                        </tr>
                        @if ($attributes && is_array($attributes))
                            @foreach ($attributes as $att)
                                <tr>
                                    <th>
                                        {{ $att->name ?? '-' }}
                                    </th>
                                    <td>
                                        @if (isset($att->attributeValues) && $att->attributeValues)
                                            @foreach ($att->attributeValues as $atval)
                                            <div class="d-inline px-3 py-1 mr-2 rounded shadow-sm bg-secondary">
                                                {{ $atval->name}}
                                            </div>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <th>
                                {{ trans('cruds.mapattribute.fields.status') }}
                            </th>
                            <td>
                                <span class="py-1 px-2 rounded {{ ($mapAttribute->status) ? 'bg-success' : 'bg-danger' }}">
                                    {{ App\Models\mapattribute::STATUS_SELECT[$mapAttribute->status] }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group text-right">
                    <a class="btn btn-secondary" href="{{ route('admin.map-attributes.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
