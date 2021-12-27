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
    {{-- @can('social_profile_type_create') --}}
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.social-profile-types.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.socialProfileType.title_singular') }}
                </a>
            </div>
        </div>
    {{-- @endcan --}}
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.socialProfileType.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-SocialProfileType">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.socialProfileType.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.socialProfileType.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.socialProfileType.fields.logo') }}
                            </th>
                            <th>
                                {{ trans('cruds.socialProfileType.fields.status') }}
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socialProfileTypes as $key => $socialProfileType)
                            <tr data-entry-id="{{ $socialProfileType->id }}" class="text-center">
                                <td>

                                </td>
                                <td>
                                    {{ $socialProfileType->id ?? '' }}
                                </td>
                                <td>
                                    <span class="text-primary">{{ $socialProfileType->name ?? '' }}</span>
                                </td>
                                <td>
                                    @if ($socialProfileType->icon)
                                        <a href="{{ $socialProfileType->icon->url }}" target="_blank"
                                            style="display: inline-block">
                                            <img src="{{ $socialProfileType->icon->thumb }}" style="height : 50px;">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <?php
                                       $status = App\Models\SocialProfileType::STATUS_SELECT[$socialProfileType->status] ?? '';
                                       $is_attribute = $status === 'Active' ? 'checked' : ''; ?>
                                        <div class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" {{$is_attribute}} id="is-attribute-chk" data-id="{{$socialProfileType->id}}">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                </td>
                                <td>
                                    @can('social_profile_type_show')
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('admin.social-profile-types.show', $socialProfileType->id) }}">
                                            {{ trans('global.view') }}
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                    @can('social_profile_type_edit')
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('admin.social-profile-types.edit', $socialProfileType->id) }}">
                                            {{ trans('global.edit') }}
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('social_profile_type_delete')
                                        <form
                                            action="{{ route('admin.social-profile-types.destroy', $socialProfileType->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                title="{{ trans('global.delete') }}">
                                                <i class="fas fa-trash"></i>
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
        $(function() {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('social_profile_type_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.social-profile-types.massDestroy') }}",
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
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            var table = $('.datatable-SocialProfileType:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
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
                    url:"{{ route('admin.social.status.update') }}",
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
