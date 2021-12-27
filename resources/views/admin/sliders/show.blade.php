@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.slider.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.sliders.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sliders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <td>
                            {{ $slider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.title') }}
                        </th>
                        <td>
                            {{ $slider->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.description') }}
                        </th>
                        <td>
                            {{ $slider->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.url') }}
                        </th>
                        <td>
                            {{ $slider->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.image') }}
                        </th>
                        <td>
                            @if($slider->image)
                                <a href="{{ $slider->photo->url }}" target="_blank" style="display: inline-block">
                                    <img src="{{$slider->photo->thumb}}">
                                    
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Slider::STATUS_SELECT[$slider->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection