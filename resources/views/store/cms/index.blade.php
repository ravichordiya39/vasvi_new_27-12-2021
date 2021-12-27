@extends('store.layouts.app')
@section('title', $cms->meta_title)
@section('meta_keywords', $cms->meta_keyword)
@section('meta_description', $cms->meta_description)
@push('styles')

@endpush

@section('content')
<div class="headertopspace"></div>
   <div class="container">

    <ol class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a></li>
        <li><a href="{{url()->full()}}">{{$cms->title}}</a></li>
    </ol>

    <div class="page-header text-center">
        <h1 class="page-title">{{$cms->title}}</h1>
    </div>

       <div class="row">
           <div class="col-md-12">
               <img src="{{$cms->image}}"  style="height : 400px;width : 100%;padding-bottom : 10px;"/>
           </div>
           <div class="col-md-12">
               <div class="p-2">
                {!! $cms->description !!}
               </div>

           </div>
       </div>
   </div>
@endsection


@push('scripts')
@endpush
