@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.blog.title') }}
    </div>
    <div class="card-header">
        <a class="btn btn-secondary float-right" href="{{ route('admin.blogs.index') }}">
            {{ trans('global.back') }}
        </a>
       </div>

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.blogs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.id') }}
                        </th>
                        <td>
                            {{ $blog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.title') }}
                        </th>
                        <td>
                            {{ $blog->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.sub_title') }}
                        </th>
                        <td>
                            {{ $blog->sub_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.slug') }}
                        </th>
                        <td>
                            {{ $blog->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.image') }}
                        </th>
                        <td>
                            @if($blog->image)
                                <a href="{{ $blog->icon->url }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $blog->icon->thumb }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.description') }}
                        </th>
                        <td>
                            {!! $blog->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.meta_title') }}
                        </th>
                        <td>
                            {{ $blog->meta_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.meta_keyword') }}
                        </th>
                        <td>
                            {{ $blog->meta_keyword }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.meta_description') }}
                        </th>
                        <td>
                            {{ $blog->meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.tags') }}
                        </th>
                        <td>
                            {{ $blog->tags }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.published_on') }}
                        </th>
                        <td>
                            {{ $blog->published_on }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blog.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Blog::STATUS_SELECT[$blog->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection