@extends('layouts.admin')
@section('content')


    <div class="card">
        <div class="card-header">
           New Arrival Banners
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Slider">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <th>
                           Link
                        </th>
                        <th>
                            {{ trans('cruds.slider.fields.image') }}
                        </th>

                        <th>
                           Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($banners as $key=> $item)


                    <tr class="text-center">
                        <th width="10">

                        </th>
                        <td>
                            {{ $key+1 ?? '' }}
                        </td>
                        <td>
                           <a class="btn btn-success" href="{{$item->link ?? ''}}">View</a>
                        </td>
                        <td>
                            <img src="{{asset('file').'/'.$item->image}}" width="100px" height="100px" alt="">
                        </td>

                        <td>
                        <a href="{{route('admin.latestbanners.edit',$item->id)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




@endsection
@section('scripts')
@parent

@endsection
