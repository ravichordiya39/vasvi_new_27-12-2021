@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.store.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.stores.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" class="form-row"  action="{{ route("admin.stores.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-4">
                <label class="required" for="name">Store {{ trans('cruds.store.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.name_helper') }}</span>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label class="required" for="city_id">City</label>

                    <select type="text" class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" name="city_id" id="city_id" value="{{ old('city_id') }}" required style="width : 100%;">
                        <?php $cities = \App\Models\City::all(); ?>
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                          <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('city_id'))
                        <span class="text-danger">{{ $errors->first('city_id') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.store.fields.address_helper') }}</span>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label class="required" for="location">Location</label>
                    <input type="text" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location" value="{{ old('location') }}" required>
                    @if($errors->has('location'))
                        <span class="text-danger">{{ $errors->first('location') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.store.fields.address_helper') }}</span>
                </div>
            </div>
            <div class="form-group col-4">
                <label class="required" for="contact_person_name">{{ trans('cruds.store.fields.contact_person_name') }}</label>
                <input class="form-control {{ $errors->has('contact_person_name') ? 'is-invalid' : '' }}" type="text" name="contact_person_name" id="contact_person_name" value="{{ old('contact_person_name', '') }}" required>
                @if($errors->has('contact_person_name'))
                    <span class="text-danger">{{ $errors->first('contact_person_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.contact_person_name_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label class="required" for="contact_person_number">{{ trans('cruds.store.fields.contact_person_number') }}</label>
                <input class="form-control {{ $errors->has('contact_person_number') ? 'is-invalid' : '' }}" type="text" name="contact_person_number" id="contact_person_number" value="{{ old('contact_person_number', '') }}" required>
                @if($errors->has('contact_person_number'))
                    <span class="text-danger">{{ $errors->first('contact_person_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.contact_person_number_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label for="contact_person_designation">{{ trans('cruds.store.fields.contact_person_designation') }}</label>
                <input class="form-control {{ $errors->has('contact_person_designation') ? 'is-invalid' : '' }}" type="text" name="contact_person_designation" id="contact_person_designation" value="{{ old('contact_person_designation', '') }}">
                @if($errors->has('contact_person_designation'))
                    <span class="text-danger">{{ $errors->first('contact_person_designation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.contact_person_designation_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label class="required" for="store_pin_code">{{ trans('cruds.store.fields.store_pin_code') }}</label>
                <input class="form-control {{ $errors->has('store_pin_code') ? 'is-invalid' : '' }}" type="text" name="store_pin_code" id="store_pin_code" value="{{ old('store_pin_code', '') }}" required>
                @if($errors->has('store_pin_code'))
                    <span class="text-danger">{{ $errors->first('store_pin_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.store_pin_code_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label class="required" for="store_contact">{{ trans('cruds.store.fields.store_contact') }}</label>
                <input class="form-control {{ $errors->has('store_contact') ? 'is-invalid' : '' }}" type="text" name="store_contact" id="store_contact" value="{{ old('store_contact', '') }}" required>
                @if($errors->has('store_contact'))
                    <span class="text-danger">{{ $errors->first('store_contact') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.store_contact_helper') }}</span>
            </div>
            <div class="form-group col-2">
                <label class="required" for="open_time">{{ trans('cruds.store.fields.open_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('open_time') ? 'is-invalid' : '' }}" type="text" name="open_time" id="open_time" value="{{ old('open_time') }}" required>
                @if($errors->has('open_time'))
                    <span class="text-danger">{{ $errors->first('open_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.open_time_helper') }}</span>
            </div>
            <div class="form-group col-2">
                <label class="required" for="close_time">{{ trans('cruds.store.fields.close_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('close_time') ? 'is-invalid' : '' }}" type="text" name="close_time" id="close_time" value="{{ old('close_time') }}" required>
                @if($errors->has('close_time'))
                    <span class="text-danger">{{ $errors->first('close_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.close_time_helper') }}</span>
            </div>


            <div class="col-2">
                <div class="form-group">
                    <label class="required" for="latitude">Latitude</label>
                    <input type="text" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" name="latitude" id="latitude" value="{{ old('latitude') }}" required>
                    @if($errors->has('latitude'))
                        <span class="text-danger">{{ $errors->first('latitude') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.store.fields.address_helper') }}</span>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label class="required" for="longitude">Longitude</label>
                    <input type="text" class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" name="longitude" id="longitude" value="{{ old('longitude') }}" required>
                    @if($errors->has('longitude'))
                        <span class="text-danger">{{ $errors->first('longitude') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.store.fields.address_helper') }}</span>
                </div>
            </div>
            <div class="form-group col-4">
                <label class="required">{{ trans('cruds.store.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Store::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.status_helper') }}</span>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label class="required" for="image">Store Image</label>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".take-image-modal" id="image">Upload</button>
                    <span class="text-warning">&nbsp;* Image should be maximum 150kb</span>
                    @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                    <div class="image-load" >
                        {{-- load dynamic image --}}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <label class="required" for="iframe">Iframe</label>
                <textarea class="form-control {{ $errors->has('iframe') ? 'is-invalid' : '' }}" name="iframe" id="iframe" styles="rows : 1 !important" required>{{ old('iframe') }}</textarea>
                @if($errors->has('iframe'))
                    <span class="text-danger">{{ $errors->first('iframe') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.address_helper') }}</span>
            </div>

            <div class="form-group col-4">
                <label class="required" for="address">{{ trans('cruds.store.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address') }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.address_helper') }}</span>
            </div>
            <div class="form-group col-4">
                <label class="required" for="pin_codes">{{ trans('cruds.store.fields.pin_codes') }}</label>
                <textarea class="form-control {{ $errors->has('pin_codes') ? 'is-invalid' : '' }}"  name="pin_codes" id="pin_codes" required> {{ old('pin_codes', '') }} </textarea>
                @if($errors->has('pin_codes'))
                    <span class="text-danger">{{ $errors->first('pin_codes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.pin_codes_helper') }}</span>
            </div>
            <div class="form-group text-right col-12">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@include('admin.upload.index');
@endsection

@section('scripts')
  @include('admin.mediascript.singlecategory')
<script>
    $(function(){
        $('#city_id').select2();
    })
</script>
@endsection
