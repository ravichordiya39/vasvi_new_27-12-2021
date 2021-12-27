@extends('layouts.admin')
@section('content')
{{-- @can('store_create') --}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.stores.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.store.title_singular') }}
            </a>
        </div>
    </div>
{{-- @endcan --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.store.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Store">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.store.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.contact_person_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.contact_person_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.store_pin_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.store_contact') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.open_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.store.fields.pin_codes') }}
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('store_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.stores.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.stores.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'contact_person_name', name: 'contact_person_name' },
{ data: 'contact_person_number', name: 'contact_person_number' },
{ data: 'address', name: 'address' },
{ data: 'store_pin_code', name: 'store_pin_code' },
{ data: 'store_contact', name: 'store_contact' },
{ data: 'open_time', name: 'open_time' },
{ data: 'pin_codes', name: 'pin_codes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Store').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
