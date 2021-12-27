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
{{-- @can('cms_page_create') --}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.cms-pages.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.cmsPage.title_singular') }}
            </a>
        </div>
    </div>
{{-- @endcan --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cmsPage.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CmsPage">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>
                            {{ trans('cruds.cmsPage.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.cmsPage.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.cmsPage.fields.sub_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.cmsPage.fields.slug') }}
                        </th>
                        <th>
                            {{ trans('cruds.cmsPage.fields.url') }}
                        </th>
                        <th style="width : 100px !important;">
                            {{ trans('cruds.cmsPage.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.cmsPage.fields.meta_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.cmsPage.fields.meta_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.cmsPage.fields.tags') }}
                        </th>
                        <th>
                            {{ trans('cruds.cmsPage.fields.status') }}
                        </th>
                        <th>
                            Action
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
@can('cms_page_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cms-pages.massDestroy') }}",
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
    ajax: "{{ route('admin.cms-pages.index') }}",
    columns: [

{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'sub_title', name: 'sub_title' },
{ data: 'slug', name: 'slug' },
{ data: 'url', name: 'url' },
{ data: 'image', name: 'image' },
{ data: 'meta_title', name: 'meta_title' },
{ data: 'meta_description', name: 'meta_description' },
{ data: 'tags', name: 'tags' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  var table = $('.datatable-CmsPage').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

            $(document).on('click','#is-attribute-chk', function(){
                var id =  $(this).attr('data-id');
                var status = '';
                if ($(this).is(':checked')) {status = 1;}
                else{ status = 0;}

                $.ajax({
                    type:'POST',
                    url:"{{ route('admin.cms-pages.status.update') }}",
                    data:{id:id, status:status},
                    success:function(data){
                        if(data.success){
                            toastr.success('Success!', data.message,{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-success',
                            });
                        }
                        else{
                            toastr.warning('Warning!', data.message,{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-warning',
                            });
                            table.ajax.reload(null, false);
                        }
                    },
                    error : function(err){
                        toastr.error('Error!', data.message,{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-error',
                        });
                    }
                });
            });

});

</script>
@endsection
