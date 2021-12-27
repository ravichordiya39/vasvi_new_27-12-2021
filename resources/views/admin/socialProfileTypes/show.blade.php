@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.socialProfileType.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.social-profile-types.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.social-profile-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.socialProfileType.fields.id') }}
                        </th>
                        <td>
                            {{ $socialProfileType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialProfileType.fields.name') }}
                        </th>
                        <td>
                            {{ $socialProfileType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialProfileType.fields.logo') }}
                        </th>
                        <td>
                            @if($socialProfileType->logo)
                                <a href="{{ $socialProfileType->url }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $socialProfileType->thumb }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialProfileType.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\SocialProfileType::STATUS_SELECT[$socialProfileType->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection