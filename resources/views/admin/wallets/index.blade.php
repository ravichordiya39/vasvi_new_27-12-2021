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
                        Amount
                    </th>
                    <th>
                        Created At
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function load_data(from_date = '', to_date = ''){
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.wallets.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'amount', name: 'amount' },
                    { data: 'created', name: 'created' },
                    { data: 'action', name: 'action' },
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

    });

</script>
@endsection
