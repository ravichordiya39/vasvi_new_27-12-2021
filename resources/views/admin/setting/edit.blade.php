@extends('layouts.admin')

@push('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .bs-setting{
    	margin: 20px;
    }
</style>
@endpush

@section('content')
@if(\Session::has('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Success!</strong> {{\Session::get('success')}}
  </div>
@endif
<form action="{{route('admin.setting.store')}}" method="post" enctype="multipart/form-data">
    @csrf
  <div class="card" style="display : block;" id="normal-products">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.setting.title') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="bs-setting">
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a href="#home" class="nav-link active font-weight-bold" data-toggle="tab">Website Information</a>
                </li>
                <li class="nav-item">
                    <a href="#profile" class="nav-link font-weight-bold" data-toggle="tab">Api Config</a>
                </li>
                <li class="nav-item">
                    <a href="#messages" class="nav-link font-weight-bold" data-toggle="tab">Social Link Config</a>
                </li>
                <li class="nav-item">
                    <a href="#auth" class="nav-link font-weight-bold" data-toggle="tab">Auth Config</a>
                </li>
                <li class="nav-item">
                    <a href="#invoice" class="nav-link font-weight-bold" data-toggle="tab">Invoice Config</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="home">
                    <div class="row mt-5">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter company name" name="company_name"
                                value="{{$setting->company_name}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Company email" name="company_email" value="{{$setting->company_email}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contact Us Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter contact us email" name="contact_us_email" value="{{$setting->contact_us_email}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputAddress">Company Address</label>
                                <textarea class="form-control" id="exampleInputAddress" aria-describedby="emailHelp" placeholder="Enter address" name="address">{{$setting->address}}</textarea>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Info</label>
                                <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="description">{{$setting->description}}</textarea>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Working Days/Hours text</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter working days text" name="working_day" value="{{$setting->working_day}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputWhatsapp">Whatsapp Number</label>
                                <input type="text" class="form-control" id="exampleInputWhatsapp" aria-describedby="emailHelp" placeholder="Enter country" name="whatsapp" value="{{$setting->whatsapp}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Country</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter country" name="country" value="{{$setting->country}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">State</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter state" name="state" value="{{$setting->state}}">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter city" name="city" value="{{$setting->city}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Zip</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter zip" name="zip" value="{{$setting->zip}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone number</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone number" name="phone" value="{{$setting->phone}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">favicon</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="select favicon" name="favicon" >
                                  <small id="emailHelp" class="form-text text-warning">Should be maximum 40kb & having .ico extension</small>
                                <img src="{{asset("file/$setting->favicon")}}" style="width : 50px;margin-top : 20px;"/>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Logo</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="select logo" name="logo">
                                <small id="emailHelp" class="form-text text-warning">Logo Should be maximum 150kb</small>
                                <img src="{{asset("file/$setting->logo")}}" style="width : 100px;margin-top : 20px;"/>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Transparent Logo</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="select logo" name="trans_logo">
                                <small id="emailHelp" class="form-text text-warning">Should be maximum 150kb & trasparent(.png)</small>
                                <img src="{{asset("file/$setting->trans_logo")}}" style="width : 100px;margin-top : 20px;"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div class="row mt-5">
                        <div class="col-2">
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Facebook Login</label><br>
                                <input type="checkbox" id="exampleInputEmail1"  name="facebook_login"  @if($setting->fb_login) checked @endif>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div> --}}
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook App Id</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter facebook app id" name="facebook_app_id" value="{{$setting->fb_app_id}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook Secret Id</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter facebook secret id" name="facebook_secret_id" value="{{$setting->fb_secret_id}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-2">
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Google Login</label><br>
                                <input type="checkbox"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter google login" name="google_login" @if($setting->google_login) checked @endif>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div> --}}
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Google App Id</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter google app id" name="google_app_id" value="{{$setting->google_app_id}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Google Secret Id</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter google secret id" name="google_secret_id" value="{{$setting->google_secret_id}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-2">

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Firebase notification api</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter firebase notification api" name="firebase_api" value="{{$setting->firebase_api}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="messages">
                    <div class="row mt-5">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Facebook Link</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter facebook link" name="fb_link" value="{{$setting->fb_link}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Google  Link</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter google link" name="google_link" value="{{$setting->google_link}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Twitter Link</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter twitter link" name="twitter_link" value="{{$setting->twitter_link}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Instagram Link</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter instagram link" name="instagram_link" value="{{$setting->instagram_link}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pinterest Link</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter pinterest link" name="pinterest_link" value="{{$setting->pinterest_link}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Whatsapp Link</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter whatsapp link" name="whatsapp_link" value="{{$setting->whatsapp_link}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="invoice">
                    <div class="row mt-5">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter company name" name="invoice_company_name"
                                value="{{$setting->invoice_company_name}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter city name" name="invoice_city"
                                value="{{$setting->invoice_city}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pincode</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter pincode" name="invoice_pincode" value="{{$setting->invoice_pincode}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">GST Number</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter GST number" name="invoice_gstno" value="{{$setting->invoice_gstno}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">PAN Number</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter PAN number" name="invoice_panno" value="{{$setting->invoice_panno}}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputAddress">Address</label>
                                <textarea class="form-control" id="exampleInputAddress" aria-describedby="emailHelp" placeholder="Enter address" name="invoice_address">{{$setting->invoice_address}}</textarea>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputAddress">Contact Us</label>
                                <textarea class="form-control" id="exampleInputAddress" aria-describedby="emailHelp" placeholder="Enter address" name="invoice_contactus">{{$setting->invoice_contactus}}</textarea>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="auth">
                    <div class="row mt-5">
                        <div class="col-2">
                            <h5 class="py-4">Instagram Credentials</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="insta-username">Username</label>
                                <input type="text" class="form-control" id="insta-username" aria-describedby="instaHelp" placeholder="Enter username" name="instagram_username" value="{{$setting->instagram_username}}">
                                <small id="instaHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="insta-password">Password</label>
                                <input type="text" class="form-control" id="insta-password" aria-describedby="emailpHelp" placeholder="Enter password" name="instagram_password" value="{{$setting->instagram_password}}">
                                <small id="emailpHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card-footer text-muted w-100 ">
        <button class="btn btn-warning float-right" type="submit">save</button>
    </div>
  </div>
</form>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#invoice-city').select2();
        // $(".nav-tabs a").click(function(){
        //     $(this).tab('show');
        // });
    });
</script>
@endsection
