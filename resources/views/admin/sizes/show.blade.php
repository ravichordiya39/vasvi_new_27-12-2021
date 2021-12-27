@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.size.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.sizes.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sizes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.size.fields.id') }}
                        </th>
                        <td>
                            {{ $size->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.size.fields.name') }}
                        </th>
                        <td>
                            {{ $size->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.size.fields.value') }}
                        </th>
                        <td>
                            {{ $size->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.size.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Size::STATUS_SELECT[$size->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sizes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
        </div>
    </div>
</div>



@endsection