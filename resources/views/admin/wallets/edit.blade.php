@extends('layouts.admin')
@push('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<style>

    #toast-container{
        margin-top : 20px;
    }

    #toast-container > .toast {
      width: 370px !important;
    }

    </style>
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
     <form action="{{route('admin.wallets.update')}}" method="post">
        <input type="hidden" name="wallet_id" value="{{$wallet->id}}" />
        @csrf
       <div class="row">
           <div class="col-6">
              <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" value="{{$wallet->users->name}}" disabled>
              </div>
           </div>
           <div class="col-6">
            <div class="form-group">
                <label for="email">User Name</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{$wallet->users->email}}" disabled>
            </div>
         </div>
         <div class="col-6">
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" aria-describedby="emailHelp" value="{{$wallet->users->mobile}}" disabled>
            </div>
         </div>
         <div class="col-6">
            <div class="form-group">
              <label for="amount">Wallet Amount</label>
              <input type="number" class="form-control" id="amount"  name="amount" aria-describedby="emailHelp" placeholder="Enter amount" value="{{$wallet->amount}}">

            </div>
         </div>
         <div class="col-12">
           <button class="btn btn-warning float-right" type="submit">Update</button>
         </div>
       </div>
    </form>
    </div>
</div>



@endsection
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script>
    $(function () {


    });

</script>
@endsection
