@extends('layouts.admin')
@section('content')
raviCH
<div class="card ">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cmsPage.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.cms-pages.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cms-pages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.id') }}
                        </th>
                        <td>
                            {{ $cmsPage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.title') }}
                        </th>
                        <td>
                            {{ $cmsPage->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.sub_title') }}
                        </th>
                        <td>
                            {{ $cmsPage->sub_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.slug') }}
                        </th>
                        <td>
                            {{ $cmsPage->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.url') }}
                        </th>
                        <td>
                            {{ $cmsPage->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.image') }}
                        </th>
                        <td>
                            {{ $cmsPage->image }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.meta_title') }}
                        </th>
                        <td>
                            {{ $cmsPage->meta_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.meta_keyword') }}
                        </th>
                        <td>
                            {{ $cmsPage->meta_keyword }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.meta_description') }}
                        </th>
                        <td>
                            {{ $cmsPage->meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.tags') }}
                        </th>
                        <td>
                            {{ $cmsPage->tags }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.description') }}
                        </th>
                        <td>
                            {!! $cmsPage->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cmsPage.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\CmsPage::STATUS_SELECT[$cmsPage->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection