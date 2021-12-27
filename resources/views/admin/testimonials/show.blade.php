@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.testimonial.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.testimonials.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.testimonials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.id') }}
                        </th>
                        <td>
                            {{ $testimonial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.full_name') }}
                        </th>
                        <td>
                            {{ $testimonial->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.city') }}
                        </th>
                        <td>
                            {{ $testimonial->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.image') }}
                        </th>
                        <td>
                            @if($testimonial->image)
                                <a href="{{ $testimonial->icon->url }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $testimonial->icon->thumb }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.description') }}
                        </th>
                        <td>
                            {{ $testimonial->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Testimonial::STATUS_SELECT[$testimonial->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection