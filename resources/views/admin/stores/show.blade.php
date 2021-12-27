@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.store.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.stores.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.id') }}
                        </th>
                        <td>
                            {{ $store->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.name') }}
                        </th>
                        <td>
                            {{ $store->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.contact_person_name') }}
                        </th>
                        <td>
                            {{ $store->contact_person_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.contact_person_number') }}
                        </th>
                        <td>
                            {{ $store->contact_person_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.contact_person_designation') }}
                        </th>
                        <td>
                            {{ $store->contact_person_designation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.address') }}
                        </th>
                        <td>
                            {{ $store->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.store_pin_code') }}
                        </th>
                        <td>
                            {{ $store->store_pin_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.store_contact') }}
                        </th>
                        <td>
                            {{ $store->store_contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.open_time') }}
                        </th>
                        <td>
                            {{ $store->open_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.close_time') }}
                        </th>
                        <td>
                            {{ $store->close_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.pin_codes') }}
                        </th>
                        <td>
                            {{ $store->pin_codes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.store.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Store::STATUS_SELECT[$store->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection