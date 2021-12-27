@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Create Currier Company
        <a class="btn btn-primary float-right text-light" href="{{route('admin.currier-companies')}}">Back</a>
    </div>

    <div class="card-body">
      <form  action="{{route('admin.currier-companies.store')}}" method="post">
        @csrf
        <div class="row">
           <div class="col-4">
             <div class="form-group">
                <label for="name">Company Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Name" value="{{old('name','')}}">

              </div>
           </div>
           <div class="col-4">
             <div class="form-group">
                <label for="email">Company Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{old('email','')}}">
              </div>
           </div>
           <div class="col-4">
             <div class="form-group">
                <label for="website">Company Website</label>
                <input type="text" class="form-control" id="website" name="website" aria-describedby="emailHelp" placeholder="Enter website" value="{{old('website','')}}">
              </div>
           </div>

           <div class="col-4">
             <div class="form-group">
                <label for="contact">Company Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" aria-describedby="emailHelp" placeholder="Enter contact" value="{{old('contact','')}}">
              </div>
           </div>

           <div class="col-12">
             <button class="btn btn-success">Create</button>
           </div>
        </div>
      </form>
    </div>
</div>
@endsection
