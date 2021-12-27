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
{{-- @can('map_attribute_create') --}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.map-attributes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mapattribute.title_singular') }}
            </a>
        </div>
    </div>
{{-- @endcan --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.mapattribute.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-mapattribute">
            <thead class="thead-dark">
                <tr class="text-center">

                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.subcategory') }}
                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.subchildcategory') }}
                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.is_size') }}
                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.is_color') }}
                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.is_brand') }}
                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.is_attribute') }}
                    </th>
                    <th>
                        {{ trans('cruds.mapattribute.fields.status') }}
                    </th>
                    <th>
                        @lang('global.action')
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
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.map-attributes.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'category', name: 'category' },
        { data: 'subcategory', name: 'subcategory' },
        { data: 'subcategorychilds', name: 'subcategorychilds' },
        { data: 'is_size', name: 'is_size' },
        { data: 'is_color', name: 'is_color' },
        { data: 'is_brand', name: 'is_brand' },
        { data: 'is_attribute', name: 'is_attribute' },
        { data: 'status', name: 'status' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-mapattribute').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  $(document).on('click','#is-size-chk', function(){
    var map_id =  $(this).attr('data-id');
    var size = '';
    if ($(this).is(':checked')) {
       size = 1;
    }
    else{
       size = 0;
    }

    $.ajax({
        type:'POST',
        url:"{{ route('admin.map-attributes.size.update') }}",
        data:{map_id:map_id, size:size},
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


  $(document).on('click','#is-color-chk', function(){
    var map_id =  $(this).attr('data-id');
    var color = '';
    if ($(this).is(':checked')) {
       color = 1;
    }
    else{
        color = 0;
    }

    $.ajax({
        type:'POST',
        url:"{{ route('admin.map-attributes.color.update') }}",
        data:{map_id:map_id, color:color},
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


  $(document).on('click','#is-brand-chk', function(){
    var map_id =  $(this).attr('data-id');
    var brand = '';
    if ($(this).is(':checked')) {
        brand = 1;
    }
    else{
        brand = 0;
    }

    $.ajax({
        type:'POST',
        url:"{{ route('admin.map-attributes.brand.update') }}",
        data:{map_id:map_id, brand:brand},
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



  $(document).on('click','#is-attribute-chk', function(){
    var map_id =  $(this).attr('data-id');
    var attribute = '';
    if ($(this).is(':checked')) {
        attribute = 1;
    }
    else{
        attribute = 0;
    }

    $.ajax({
        type:'POST',
        url:"{{ route('admin.map-attributes.attribute.update') }}",
        data:{map_id:map_id, attribute:attribute},
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


  $(document).on('click','#is-active-chk', function(){
    var map_id =  $(this).attr('data-id');
    var active = '';
    if ($(this).is(':checked')) {
        active = 1;
    }
    else{
        active = 0;
    }

    $.ajax({
        type:'POST',
        url:"{{ route('admin.map-attributes.active.update') }}",
        data:{map_id:map_id, active:active},
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
