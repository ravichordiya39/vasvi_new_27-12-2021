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
        <form method="POST" class="form-row" action="{{ route("admin.user-social-profiles.update", [$userSocialProfile->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-6">
                <label class="required" for="user_id">{{ trans('cruds.userSocialProfile.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userSocialProfile->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userSocialProfile.fields.user_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required" for="social_profile_type_id">{{ trans('cruds.userSocialProfile.fields.social_profile_type') }}</label>
                <select class="form-control select2 {{ $errors->has('social_profile_type') ? 'is-invalid' : '' }}" name="social_profile_type_id" id="social_profile_type_id" required>
                    @foreach($social_profile_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('social_profile_type_id') ? old('social_profile_type_id') : $userSocialProfile->social_profile_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('social_profile_type'))
                    <span class="text-danger">{{ $errors->first('social_profile_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userSocialProfile.fields.social_profile_type_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required" for="url">{{ trans('cruds.userSocialProfile.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $userSocialProfile->url) }}" required>
                @if($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userSocialProfile.fields.url_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required">{{ trans('cruds.userSocialProfile.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\UserSocialProfile::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $userSocialProfile->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userSocialProfile.fields.status_helper') }}</span>
            </div>
            <div class="form-group text-right col-12">
                <button class="btn btn-warning" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection