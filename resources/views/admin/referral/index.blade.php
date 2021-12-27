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
{{-- @can('user_create') --}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
{{-- @endcan --}}
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
                        Referral Key
                    </th>
                    <th>
                        Created At
                    </th>
                    <th>
                        Status
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('admin.referrals.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'referral', name: 'referral' },
                { data: 'created', name: 'created' },
                { data: 'status', name: 'status' },
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 25,
        };
        let table = $('.datatable-User').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        $(document).on('click','#is-status-chk', function(){
            var user_id =  $(this).attr('data-id');
            var status = '';
            if ($(this).is(':checked')) {
                status = 1;
            }
            else{
                status = 0;
            }

            $.ajax({
                type:'PATCH',
                url:`{{ url('backoffice/referrals')}}/${user_id}`,
                data:{user_id:user_id, status:status},
                success:function(data){
                    if(data.success){
                        toastr.success('Success', data.message,{
                        positionClass: 'toast-top-center',
                        });
                    }
                },
                error : function(err){
                    console.log(err);
                    toastr.error('Error', data.message,{
                        positionClass: 'toast-top-center',
                    });
                }
            });
        });

    });

</script>
@endsection
