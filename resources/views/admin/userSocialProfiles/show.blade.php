@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userSocialProfile.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.user-social-profiles.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-social-profiles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userSocialProfile.fields.id') }}
                        </th>
                        <td>
                            {{ $userSocialProfile->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userSocialProfile.fields.user') }}
                        </th>
                        <td>
                            {{ $userSocialProfile->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userSocialProfile.fields.social_profile_type') }}
                        </th>
                        <td>
                            {{ $userSocialProfile->social_profile_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userSocialProfile.fields.url') }}
                        </th>
                        <td>
                            {{ $userSocialProfile->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userSocialProfile.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\UserSocialProfile::STATUS_SELECT[$userSocialProfile->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-social-profiles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div> --}}
        </div>
    </div>
</div>



@endsection