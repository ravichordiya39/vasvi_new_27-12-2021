@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
           Best Seller Banners
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
                    @foreach ($bestsellers as $item)


                    <tr class="text-center">
                        <th width="10">

                        </th>
                        <td>
                            {{ $item->id ?? '' }}
                        </td>
                        <td>
                           <a class="btn btn-success" href="{{$item->link ?? ''}}">View</a>
                        </td>
                        <td>
                            <img src="{{asset('file').'/'.$item->image}}" width="200px" height="120px" alt="">
                        </td>

                        <td>
                        <a href="{{route('admin.home.banners.edit',$item->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


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

                    @foreach ($arrivals as $key=> $item)


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
                        <a href="{{route('admin.home.new.banners.edit',$item->id)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <div class="card">
        <div class="card-header">
           Exclusive Banner
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




                    <tr class="text-center">
                        <th width="10">

                        </th>
                        <td>
                           1
                        </td>
                        <td>
                           <a class="btn btn-success" href="{{$exc->link ?? ''}}">View</a>
                        </td>
                        <td>
                            <img src="{{asset('file').'/'.$exc->image}}" width="200px" height="120px" alt="">
                        </td>

                        <td>
                        <a href="{{route('admin.home.exclusive.banners.edit',$exc->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

@endsection
