<div class="m-3">
    @can('product_image_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.product-images.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.productImage.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.productImage.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-productProductImages">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.productImage.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.productImage.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.productImage.fields.type') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productImages as $key => $productImage)
                            <tr data-entry-id="{{ $productImage->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $productImage->id ?? '' }}
                                </td>
                                <td>
                                    {{ $productImage->product->name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\ProductImage::TYPE_SELECT[$productImage->type] ?? '' }}
                                </td>
                                <td>
                                    @can('product_image_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.product-images.show', $productImage->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('product_image_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.product-images.edit', $productImage->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('product_image_delete')
                                        <form action="{{ route('admin.product-images.destroy', $productImage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_image_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-images.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-productProductImages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection