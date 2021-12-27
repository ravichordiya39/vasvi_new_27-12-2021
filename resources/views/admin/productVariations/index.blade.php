@extends('layouts.admin')
@section('content')
{{-- @can('product_variation_create') --}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.product-variations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productVariation.title_singular') }}
            </a>
        </div>
    </div>
{{-- @endcan --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.productVariation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProductVariation">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.color') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.size') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.mrp_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.sales_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.front_image') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.back_image') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.in_stock') }}
                    </th>
                    <th>
                        {{ trans('cruds.productVariation.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
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
@can('product_variation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-variations.massDestroy') }}",
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
    ajax: "{{ route('admin.product-variations.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'product_name', name: 'product.name' },
{ data: 'color_name', name: 'color.name' },
{ data: 'size_name', name: 'size.name' },
{ data: 'mrp_price', name: 'mrp_price' },
{ data: 'sales_price', name: 'sales_price' },
{ data: 'front_image', name: 'front_image', sortable: false, searchable: false },
{ data: 'back_image', name: 'back_image', sortable: false, searchable: false },
{ data: 'in_stock', name: 'in_stock' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-ProductVariation').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
