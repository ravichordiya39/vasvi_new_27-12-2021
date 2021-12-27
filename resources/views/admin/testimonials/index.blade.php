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
{{-- @can('testimonial_create') --}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.testimonials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.testimonial.title_singular') }}
            </a>
        </div>
    </div>
{{-- @endcan --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.testimonial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Testimonial">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.full_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.image') }}
                        </th>
                        <th style="width : 35%;">
                            {{ trans('cruds.testimonial.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.status') }}
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $key => $testimonial)
                        <tr data-entry-id="{{ $testimonial->id }}" class="text-center">
                            <td>

                            </td>
                            <td>
                                {{ $testimonial->id ?? '' }}
                            </td>
                            <td>
                                <span class="badge badge-secondary p-2">{{ $testimonial->full_name ?? '' }}</span>
                            </td>

                            <td>
                                <span class="badge badge-secondary p-2">{{ $testimonial->city ?? '' }}</span>
                            </td>
                            <td>
                                @if($testimonial->icon)
                                    <a href="{{ asset("file/$testimonial->image") }}" target="_blank" style="display: inline-block">
                                        <img src="{{ asset("file/$testimonial->image") }}" style="width : 70px;border : 2px solid lightgray; border-radius : 10px;">
                                    </a>
                                @endif
                            </td>
                            <td class="text-left">
                                <p class="text-secondary">{{ $testimonial->description ?? '' }}</p>
                            </td>
                            <td>
                                <?php
                                    $status = App\Models\Testimonial::STATUS_SELECT[$testimonial->status] ;
                                    $is_attribute = $status === 'Active' ? 'checked' : ''; ?>
                                    <div class="text-center">
                                        <label class="switch">
                                            <input type="checkbox"  {{$is_attribute}} id="is-attribute-chk" data-id="{{$testimonial->id}}">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                            </td>
                            <td>
                                @can('testimonial_show')
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.testimonials.show', $testimonial->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan

                                @can('testimonial_edit')
                                    <a class="btn btn-sm btn-info" href="{{ route('admin.testimonials.edit', $testimonial->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan

                                @can('testimonial_delete')
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-danger" >
                                            <i class="fas fa-trash"></i>
                                        </button>
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('testimonial_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.testimonials.massDestroy') }}",
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
  let table = $('.datatable-Testimonial:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
                    url:"{{ route('admin.testimonials.status.update') }}",
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

})

</script>
@endsection
