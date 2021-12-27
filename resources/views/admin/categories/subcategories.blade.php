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

    @can('category_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.subcategories.create', ['id' => $category->id ?? 0]) }}">
                    {{ trans('global.add') }} {{ $category->parent_id == 0 ? trans('cruds.subcategory.title_singular'):trans('cruds.subcategory.title_singular_second') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.subcategory.title_singular') }}
            {{ trans('global.list') }}
            (
                <strong>
                    {{ $category->name ?? '' }}
                </strong>
            )
            <a class="btn btn-secondary float-right mr-2" href="{{ route('admin.categories.index') }}">
                {{ trans('global.back_to_category') }}
            </a>
        </div>
        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Category">
                <thead>
                    <tr class="text-center">
                        <th>
                            {{ trans('cruds.subcategory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.subcategory.fields.name') }}
                        </th>

                        @if($category->parent_id == 0)
                        <th>
                            {{ trans('cruds.category.fields.childs') }}
                        </th>
                        @endif
                        <th>
                            {{ trans('cruds.subcategory.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.subcategory.fields.size_chart') }}
                        </th>
                        <th>
                            {{ trans('cruds.subcategory.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $row)
                        <tr class="text-center">
                            <td>
                                {{ $row->id ?? '' }}
                            </td>
                            <td>
                                {{ $row->name ?? '' }}
                            </td>
                            @if($category->parent_id == 0)
                            <td>
                                <a href="{{ route('admin.subcategories.index', ['id' => $row->id]) }}" class="btn btn-outline-info">
                                    {{ trans('cruds.category.fields.childs') }}
                                    ({{ $row->subcategories->count() }})
                                </a>
                            </td>
                            @endif
                            <td>
                                <a href="{{ $row->image_url }}" target="_blank">
                                    <img src="{{ $row->thumb_url ?? '' }}" width="50px" height="50px" />
                                </a>
                            </td>
                            <td>
                                <a href="{{ $row->size_chart_url }}" target="_blank">
                                    <img src="{{ $row->size_chart_url ?? '' }}" width="50px" height="50px" />
                                </a>
                            </td>
                            <td>
                                <?php $status =  App\Models\Category::STATUS_SELECT[$row->status] ;

                                $is_attribute = $status == 'Active' ? 'checked' : '';

                                ?>
                                        <div class="text-center">
                                            <label class="switch">
                                                <input type="checkbox"  <?php echo $is_attribute; ?> id="is-attribute-chk" data-id="{{$row->id}}">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                            </td>
                            <td>
                                {{-- @can('category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.categories.show', $row->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan --}}
                                @can('category_edit')
                                    <a class="btn btn-m btn-info" href="{{ route('admin.categories.edit', $row->id) }}">
                                        <i class="fas fa-sm fa-edit"></i>
                                    </a>
                                @endcan
                                @can('category_delete')
                                    <form action="{{ route('admin.categories.destroy', $row->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn  btn-danger"
                                            ><i class="fa fa-trash"></i></button>
                                    </form>
                                @endcan
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
            @if(\Session::has('success'))
                toastr.success('Success!', "{{\Session::get('success')}}",{
                    positionClass: 'toast-top-center',
                    iconClass:'toast-success',
                });
            @endif

            @if(\Session::has('warning'))
                toastr.warning('Warning!', "{{\Session::get('warning')}}",{
                    positionClass: 'toast-top-center',
                    iconClass:'toast-warning',
                });
            @endif
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('category_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.categories.massDestroy') }}",
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
                $this = $(this);
                var status = '';
                if ($(this).is(':checked')) {status = 1;}
                else{ status = 0;}

                $.ajax({
                    type:'POST',
                    url:"{{ route('admin.categories.status.update') }}",
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

                            $this.prop('checked', true);
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
