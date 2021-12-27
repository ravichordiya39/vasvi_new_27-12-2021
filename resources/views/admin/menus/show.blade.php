@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        
        <a class="btn btn-secondary float-right" href="{{ route('admin.menus.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>
    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.id') }}
                        </th>
                        <td>
                            {{ $menu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.name') }}
                        </th>
                        <td>
                            {{ $menu->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.category') }}
                        </th>
                        <td>
                            {{ $menu->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.slug') }}
                        </th>
                        <td>
                            {{ $menu->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Menu::TYPE_SELECT[$menu->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menu.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Menu::STATUS_SELECT[$menu->status] ?? '' }}
                        </td>
                    </tr>
                   
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection