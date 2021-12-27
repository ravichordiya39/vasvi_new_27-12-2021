@extends('layouts.admin')
@push('stylesheet')
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }

    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }

    #toast-container{
        margin-top : 20px;
    }

    #toast-container > .toast {
    width: 370px !important;
    }
</style>
@endpush
@section('content')

<div class="card">
    <div class="card-header">
        Track Orders
    </div>

    <div class="card-body">
      <div class="table-responsive">


        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-orders">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>
                        #
                    </th>
                    <th>
                        Order ID
                    </th>
                    <th>
                        Products
                    </th>

                    <th>
                        Image
                    </th>
                    <th>
                        Customer
                    </th>
                    <th>
                        Total
                    </th>
                    <th>
                        Currier Provider
                    </th>
                    <th>
                       Track
                    </th>
                    </th>

                    <th>
                        Status
                    </th>
                    <th>
                        Created
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
        </table>
          </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.shipments') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'order_id', name: 'order_id' },
                { data: 'name', name: 'name' },
                { data: 'image', name: 'image', sortable: false, searchable: false },
                { data: 'customer', name: 'customer' },

                { data: 'total', name: 'total' },
                { data: 'currier_company', name: 'currier_company' },
                { data: 'track', name: 'track' },
                { data: 'status', name: 'status' },
                { data: 'created', name: 'created' },
                { data: 'action', name: 'action' },
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 25,
            };
            var table = $('.datatable-orders').DataTable(dtOverrideGlobals);


            $(document).on('change','#order-status', function(){
               var status_id = $(this).val();
               var order_id = $(this).attr('data-id');

               $.ajax({
                   type: "PATCH",
                   url: `{{url('backoffice/orders/status')}}/${order_id}`,
                   data: {
                       status_id : status_id,
                       order_id : order_id,
                       _token:'{{ csrf_token() }}',
                   },
                   cache: false,
                   success: function (response) {
                       if(response.code === 200){
                        toastr.success('Success!', response.message,{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-success',
                        });
                       }
                       else{
                        toastr.warning('Warning!', response.message,{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-warning',
                        });
                       }

                    table.ajax.reload(null, false);
                   },
                   error : function(err){
                       toastr.error('Error!', 'Internal server error!',{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-error',
                        });
                   }
               });
            });



            $(document).on('click','#order-trash', function(){
               var order_id = $(this).attr('data-id');

               $.ajax({
                   type: "delete",
                   url: `{{url('backoffice/orders/delete')}}/${order_id}`,
                   data: {
                       order_id : order_id,
                       _token:'{{ csrf_token() }}',
                   },
                   cache: false,
                   success: function (response) {
                    console.log(response);
                    toastr.success('Success!', response.message,{
                        positionClass: 'toast-top-center',
                        iconClass:'toast-success',
                    });
                    table.ajax.reload(null, false);
                   },
                   error : function(err){
                       toastr.error('Error!', 'Internal server error!',{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-success',
                        });
                   }
               });
            });
});

</script>
@endsection
