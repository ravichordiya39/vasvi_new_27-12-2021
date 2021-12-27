@extends('layouts.admin')
@push('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<style>

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
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="row input-daterange">
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
            </div>
            <div class="col-md-3">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
            </div>
            <div class="col-md-4">
                <button type="button" name="filter" id="filter" class="btn btn-primary"><i class="fa fa-filter"></i>&nbsp;Filter</button>&nbsp;
                <button type="button" name="refresh" id="refresh" class="btn btn-default"><i class="fa fa-lg fa-retweet"></i>&nbsp;Refresh</button>
            </div>
        </div><br>
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th width="10">
                       #
                    </th>
                    <th>
                        User Name
                    </th>
                    <th>
                        Refer To
                    </th>
                    <th>
                        Referral Key
                    </th>
                    <th>
                        Created At
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });



        function load_data(from_date = '', to_date = ''){
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url : "{{ route('admin.references.index') }}",
                    data:function(d){
                        d.from_date = from_date;
                        d.to_date = to_date;
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'refer', name: 'refer' },
                    { data: 'referral', name: 'referral' },
                    { data: 'created', name: 'created' },
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 25,
            };
            let table = $('.datatable-User').DataTable(dtOverrideGlobals);
            $(document).find('input[type=search]').removeClass('form-control-sm');
            $(document).find('.custom-select').removeClass('form-control-sm');
        }

        load_data();

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
            $('.datatable-User').DataTable().clear().destroy();
              load_data(from_date, to_date);
            }
            else
            {
            alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('.datatable-User').DataTable().clear().destroy();
            load_data();
        });

    });

</script>
@endsection
