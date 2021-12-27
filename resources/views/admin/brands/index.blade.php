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
    {{-- @can('brand_create') --}}
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.brands.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.brand.title_singular') }}
                </a>
            </div>
        </div>
    {{-- @endcan --}}
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.brand.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Brand">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>
                            {{ trans('cruds.brand.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.brand.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.brand.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.brand.fields.status') }}
                        </th>
                        <th>
                            @lang('global.action')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $row)
                        <tr>
                            <td class="text-center">
                                {{ $row->id ?? '' }}
                            </td>
                            <td >
                                <span class="badge badge-primary p-2">{{ $row->name ?? '' }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ $row->image_url }}" target="_blank">
                                    <img src="{{ $row->thumb_url ?? '' }}" width="50px" height="50px" />
                                </a>
                            </td>
                            <td class="text-center">
                             <?php $status =  App\Models\Category::STATUS_SELECT[$row->status];

                                    $is_attribute = $status === 'Active' ? 'checked' : ''; ?>
                                <div class="text-center">
                                    <label class="switch">
                                        <input type="checkbox"  {{$is_attribute}}  id="is-attribute-chk" data-id="{{$row->id}}">
                                        <span class="slider round"></span>
                                    </label>
                                </div>


                            </td>
                            <td class="text-center">
                                {{-- @can('category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.brands.show', $row->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan --}}

                                @can('category_edit')
                                    <a class="btn btn-sm btn-warning" href="{{ route('admin.brands.edit', $row->id) }}" title="{{ trans('global.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan


                                {{-- @can('category_delete')
                                    <form action="{{ route('admin.brands.destroy', $row->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('global.delete') }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan --}}


                         </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="10">
                                No record found!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



@endsection
@section('scripts')
@parent
<script>
    $(function() {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('brand_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.brands.massDestroy') }}",
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

        $(document).on('click','#is-attribute-chk', function(){
            var id =  $(this).attr('data-id');
            var status = '';
            if ($(this).is(':checked')) {status = 1;}
            else{ status = 0;}

            $.ajax({
                type:'POST',
                url:"{{ route('admin.brand.status.update') }}",
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

        //   let dtOverrideGlobals = {
        //     buttons: dtButtons,
        //     processing: true,
        //     serverSide: true,
        //     retrieve: true,
        //     aaSorting: [],
        //     ajax: "{{ route('admin.brands.index') }}",
        //     columns: [
        //       { data: 'placeholder', name: 'placeholder' },
        // { data: 'id', name: 'id' },
        // { data: 'name', name: 'name' },
        // { data: 'logo', name: 'logo', sortable: false, searchable: false },
        // { data: 'status', name: 'status' },
        // { data: 'actions', name: '{{ trans('global.actions') }}' }
        //     ],
        //     orderCellsTop: true,
        //     order: [[ 1, 'desc' ]],
        //     pageLength: 25,
        //   };
        //   let table = $('.datatable-Brand').DataTable(dtOverrideGlobals);
        //   $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        //       $($.fn.dataTable.tables(true)).DataTable()
        //           .columns.adjust();
        //   });

    });
</script>
@endsection
