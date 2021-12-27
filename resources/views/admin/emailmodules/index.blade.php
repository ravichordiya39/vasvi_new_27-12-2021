@extends('layouts.admin')
@section('content')


    <div class="card">
        <div class="card-header">
           Email Module
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Slider">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th width="10">
                           #
                        </th>
                        <th>
                            Email Name
                        </th>
                        <th>
                           Description
                        </th>
                        <th>
                            Created At
                        </th>
                        <th>
                            Updated At
                        </th>

                        <th>
                           Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                  @foreach($modules as $module)
                  <?php $i++; ?>
                    <tr class="text-center">
                        <td>{{$i}}</td>
                        <td>{{$module->title}}</td>
                        <td>{!! substr($module->body, 0, 170)!!}{{strlen($module->body) > 170 ? '...' : ''}}</td>
                        <td>{{date('d M Y H:i A', strtotime($module->created_at))}}</td>
                        <td>{{date('d M Y H:i A', strtotime($module->updated_at))}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{route('admin.emailmodule.edit',['id' => $module->id])}}">
                                <i class="fas fa-edit"></i>
                            </a>
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
