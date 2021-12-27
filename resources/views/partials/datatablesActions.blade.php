<div class="text-center" style="width : 110px;">
@can($viewGate)
    <a class="btn btn-sm btn-info my-1" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}"
        title="{{ trans('global.view') }}">
        <i class="fas fa-eye"></i>
    </a>
@endcan

@can($editGate)
    <a class="btn btn-sm btn-warning my-1" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}"
        title="{{ trans('global.edit') }}">
        <i class="fas fa-edit"></i>
    </a>
@endcan

@can($deleteGate)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST"
        onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-sm btn-danger my-1" title="{{ trans('global.delete') }}">
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endcan
</div>
