@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.color.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.colors.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.configs.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="referral_amount">Referral Amount</label>
                        <input type="number" class="form-control {{ $errors->has('referral_amount') ? 'is-invalid' : '' }}" type="text" name="referral_amount" id="referral_amount" value="{{ old('referral_amount', $config->referral_amount) }}" required>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('referral_amount') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.color.fields.name_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="form-group text-right">
                        <button class="btn btn-success" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>



@endsection
