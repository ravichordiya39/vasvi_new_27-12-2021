@extends('layouts.admin')

@push('stylesheet')
  <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
@endpush
@section('content')

<div class="card">
    <div class="card-header">
        Sales Report
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-2">

        </div>
        <div class="col-4">
            <td>Minimum date:</td>
            <td><input type="text" id="min" name="min" class=""></td>
        </div>
        <div class="col-4">
            <td>Maximum date:</td>
            <td><input type="text" id="max" name="max"></td>
        </div>
        <div class="col-2">

        </div>
    </div>

      </div>
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Role">
            <thead class="thead-dark">
                <tr>
                    <th>
                        Order ID
                    </th>
                    <th>
                        User
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        Product
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Date
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js" integrity="sha512-Y+0b10RbVUTf3Mi0EgJue0FoheNzentTMMIE2OreNbqnUPNbQj8zmjK3fs5D2WhQeGWIem2G2UkKjAL/bJ/UXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
@parent
<script>
  $(function () {
  var minDate, maxDate;
  minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
  });
  maxDate = new DateTime($('#max'), {
      format: 'MMMM Do YYYY'
  });

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    dom: 'Bfrtlp',
    buttons: ['copy','excel','csv','pdf','print'],
    ajax: "{{ route('admin.reports.sales') }}",
    columns: [
      { data: 'order_id', name: 'order_id' },
      { data: 'name', name: 'name' },
      { data: 'address', name: 'address' },
      { data: 'product', name: 'product' },
      { data: 'image', name: 'image' },
      { data: 'amount', name: 'amount' },
      { data: 'created', name: 'created' },
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Role').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  $('#min, #max').on('change', function () {
      table.draw();
  });


  $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[4] );

        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
  );

});

</script>
@endsection
