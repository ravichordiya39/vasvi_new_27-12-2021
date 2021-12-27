@extends('layouts.admin')
@section('content')
    {{-- @can('attribute_value_create') --}}
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.attribute-values.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.attributeValue.title_singular') }}
                </a>
            </div>
        </div>
    {{-- @endcan --}}
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.attributeValue.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-AttributeValue">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.attributeValue.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.attributeValue.fields.attribute') }}
                            </th>
                            <th>
                                {{ trans('cruds.attributeValue.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.attributeValue.fields.value') }}
                            </th>
                            <th>
                                {{ trans('cruds.attributeValue.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributeValues as $key => $attributeValue)
                            <tr data-entry-id="{{ $attributeValue->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $attributeValue->id ?? '' }}
                                </td>
                                <td>
                                    {{ $attributeValue->attribute->name ?? '' }}
                                </td>
                                <td>
                                    {{ $attributeValue->name ?? '' }}
                                </td>
                                <td>
                                    {{ $attributeValue->value ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\AttributeValue::STATUS_SELECT[$attributeValue->status] ?? '' }}
                                </td>
                                <td>
                                    @can('attribute_value_show')
                                        <a class="btn btn-info"
                                            href="{{ route('admin.attribute-values.show', $attributeValue->id) }}"
                                            title="{{ trans('global.view') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan

                                    @can('attribute_value_edit')
                                        <a class="btn btn-warning"
                                            href="{{ route('admin.attribute-values.edit', $attributeValue->id) }}"
                                            title="{{ trans('global.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan

                                    @can('attribute_value_delete')
                                        <form action="{{ route('admin.attribute-values.destroy', $attributeValue->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger"
                                                title="{{ trans('global.delete') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('attribute_value_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.attribute-values.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-AttributeValue:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
