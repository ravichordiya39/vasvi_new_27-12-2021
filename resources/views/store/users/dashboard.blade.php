@extends('store.layouts.app')
@section('title', 'Vasvi - User ' .request()->segment(2) .' '. (request()->has('type') ? request()->get('type') : ''))
@section('meta_keywords', 'Vasvi.in, Ecommerce, Shopping, Mens, Woman, Kids, Cloth')
@section('meta_description', 'Ecommerce website to buy a product in quantity or bulk with lots of discount')
@push('styles')
<style>
    .myaccount-tab-menu {
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column;
}

.myaccount-tab-menu a {
  border: 1px solid #ccc;
  border-bottom: none;
  font-weight: 600;
  font-size: 13px;
  display: block;
  padding: 10px 15px;
  text-transform: uppercase;
}

.myaccount-tab-menu a:last-child {
  border-bottom: 1px solid #ccc;
}

.myaccount-tab-menu a:hover, .myaccount-tab-menu a.active {
  background-color: #F6757A;
  border-color: #F6757A;
  color: #ffffff;
}

.myaccount-tab-menu a i.fa {
  font-size: 14px;
  text-align: center;
  width: 25px;
}

@media only screen and (max-width: 767px) {
  #myaccountContent {
    margin-top: 30px;
  }
}

.myaccount-content {
  border: 1px solid #eeeeee;
  padding: 30px;
}

@media only screen and (max-width: 767px) {
  .myaccount-content {
    padding: 20px 15px;
  }
}

.myaccount-content form {
  margin-top: -20px;
}

.myaccount-content h3 {
  font-size: 20px;
  border-bottom: 1px dashed #ccc;
  padding-bottom: 10px;
  margin-bottom: 25px;
  font-weight: 600;
}

.myaccount-content .welcome a:hover {
  color: #F6757A;
}

.myaccount-content .welcome strong {
  font-weight: 600;
  color: #F6757A;
}

.myaccount-content fieldset {
  margin-top: 20px;
}

.myaccount-content fieldset legend {
  font-size: 16px;
  margin-bottom: 20px;
  font-weight: 600;
  padding-bottom: 10px;
  border-bottom: 1px solid #ccc;
}

.myaccount-content .account-details-form {
  margin-top: 50px;
}

.myaccount-content .account-details-form .single-input-item {
  margin-bottom: 20px;
}

.myaccount-content .account-details-form .single-input-item label {
  font-size: 14px;
  text-transform: capitalize;
  display: block;
  margin: 0 0 5px;
}

.myaccount-content .account-details-form .single-input-item input {
  border: 1px solid #e8e8e8;
  height: 50px;
  background-color: transparent;
  padding: 2px 20px;
  color: #1f2226;
  font-size: 13px;
}

.myaccount-content .account-details-form .single-input-item input:focus {
  border: 1px solid #343538;
}

.myaccount-content .account-details-form .single-input-item button {
  border: none;
  background-color: #F6757A;
  text-transform: uppercase;
  font-weight: 600;
  padding: 9px 25px;
  color: #fff;
  font-size: 13px;
}

.myaccount-content .account-details-form .single-input-item button:hover {
  background-color: #1f2226;
}

.myaccount-table {
  white-space: nowrap;
  font-size: 14px;
}

.myaccount-table table th,
.myaccount-table .table th {
  padding: 10px;
  font-weight: 600;
  background-color: #f8f8f8;
  border-color: #ccc;
  border-bottom: 0;
  color: #1f2226;
}

.myaccount-table table td,
.myaccount-table .table td {
  padding: 10px;
  vertical-align: middle;
  border-color: #ccc;
}

.saved-message {
  background-color: #fff;
  border-top: 3px solid #F6757A;
  font-size: 14px;
  padding: 20px 0;
  color: #333;
}

a{
    text-decoration: none !important;
}

.deactive{
    background-color: #fff;
}

.btn-account {
    background-color: #F6757A;
    color : white
}

.btn-account:hover {
    background-color: #F4717D;
    color : white;
}

.error{
    color : red;
}

#address-box{
    position : relative;
}
#add-delete{
    position :absolute;
    right : 10px;
    top : 10px;
    cursor: pointer;
}

#address-box:hover{
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
}

.add-btn{
    font-size : 16px;
    padding : 6px 10px;;
    background-color: #F6757A;
    border : 0px;
    color : white
}


.add-btn:hover{
    background-color: black;
}


.cancel-btn{
    font-size : 18px;
    padding : 2px 10px;;
    background-color: #F6757A;
    border : 0px;
    color : white
}


.cancel-btn:hover{
    background-color: black;
}

.order-list{
    border : 1px solid lightgrey;
    position: relative;
    margin-top: 25px;
    color : black !important;;
}
a{
    color : black !important;;
}
.order-label{
   position: absolute;
   left : 15px;
   top : -15px;
   background-color: grey;
   color : white;
   padding : 5px;
   padding-left :10px;
   padding-right : 10px;
}

.price-strike{
    text-decoration-line: line-through;
}

#color-show{
    display : inline-block;
    width : 30px;
    height : 10px;
}



.track {
    position: relative;
    background-color: #ddd;
    height: 5px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 60px;
    margin-top: 50px
}

.track .step {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative
}

.track .step.active:before {
    background: #FF5722
}

.track .step::before {
    height: 5px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px
}

.track .step.active .icon {
    background: #ee5435;
    color: #fff
}

.track .icon {
    display: inline-block;
    width: 30px;
    height: 30px;
    line-height: 30px;
    position: relative;
    border-radius: 100%;
    background: #ddd;
    margin-top :5px;
}

.track .step.active .text {
    font-weight: 400;
    color: #000
}

.track .text {
    display: block;
    margin-top: 7px
}

#refund-btn{
    position: absolute;
    right : 20px;
    top : -15px;
}

</style>
@endpush

@section('content')
<?php $type = request()->has('type') ? request()->get('type') : 'dashboard'; ?>
<div class="container my-5 py-5">
    <div style="margin-top: 100px;">

    </div>
    <h4 class="text-center mt-5 h3">Manage your account</h4>
    <div class="row my-5 py-5">
        <div class="col-lg-12">
            <!-- My Account Page Start -->
            <div class="myaccount-page-wrapper">
                <!-- My Account Tab Menu Start -->
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="myaccount-tab-menu nav" role="tablist">
                            <a href="#dashboad" data-toggle="tab" id="account-nav" @if($type === 'dashboard')class="active" @endif data-name="dashboard"><i class="fa fa-dashboard" ></i>
                                Dashboard</a>
                            <a href="#orders" data-toggle="tab"  id="account-nav" data-name="orders" @if($type === 'orders')class="active" @endif><i class="fa fa-cart-arrow-down"></i> Orders</a>
                            <a href="#wallet" data-toggle="tab" id="account-nav" data-name="wallet" @if($type === 'wallet')class="active" @endif><i class="fa fa-lock"></i> Wallet</a>

                            <a href="#address-edit" data-toggle="tab"  id="account-nav" data-name="address" @if($type === 'address')class="active" @endif><i class="fa fa-map-marker"></i> address</a>

                            <a href="#account-info" data-toggle="tab"  id="account-nav" data-name="detail" @if($type === 'detail')class="active" @endif><i class="fa fa-user"></i> Account Details</a>
                            <a href="#referral" data-toggle="tab" id="account-nav" data-name="referral" @if($type === 'referral')class="active" @endif><i class="fa fa-link"></i> Referral</a>
                            <a href="#passwordinfo" data-toggle="tab" id="account-nav" data-name="cp" @if($type === 'cp')class="active" @endif><i class="fa fa-lock"></i> Changes Password</a>
                            <a href="{{route('user.logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </div>
                    <!-- My Account Tab Menu End -->
                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade
                              @if($type === 'dashboard')
                               active in
                              @endif
                              " id="dashboad" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Dashboard</h3>
                                    <div class="welcome">
                                        <p>Hello, <strong>{{$auth->name}}</strong> (If Not <strong>{{$auth->name}} !</strong><a href="#" class="logout"> Logout</a>)</p>
                                    </div>

                                    <p class="mb-0">From your account dashboard. you can easily check &amp; view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade
                              @if($type === 'referral')
                               active in
                              @endif
                              " id="referral" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Referral</h3>
                                    <h5 class="text-primary" style="font-size : 18px;!important">This referral code use for refer your friends to join Vasvi Shop and earn wallet money</h5>
                                    <table class="table table-bordered text-center">
                                        <tr class="text-center">
                                            <th class="text-center">
                                                Referral Code
                                            </th>
                                            <th class="text-center">
                                                Status
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3>{{$auth->referral_code}}</h3>
                                            </td>
                                            <td class="text-center">
                                                <h3><span class="label label-{{$auth->ref_status === 1 ? 'success' : 'danger'}} p-3">{{$auth->ref_status === 1 ? 'Active' : 'Deactive'}}</span></h3>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade
                                @if($type === 'orders')
                                active in
                                @endif
                                " id="orders" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Orders</h3>
                                    <div class="myaccount-table ">
                                        @foreach($orders as $order)

                                            <div class="order-list">
                                            <span class="order-label">ORDERID-{{$order->order_id}}</span>
                                            @if($order->status === 0 || $order->status === 1 || $order->status === 2 )
                                            <button class="cancel-btn float-right" id="refund-btn" data-id="{{$order->id}}" data-toggle="modal" data-target="#deleteModal">
                                                Cancel & Refund
                                            </button>
                                            <div style="float:right; font-weight : bold;font-size : 18px;" class="my-5 mx-3">Date - {{date('d M Y H:i A', strtotime($order->created_at))}}</div>
                                            @endif
                                            @foreach($order->orders as $ord)
                                            <div class="row my-5 mx-3">

                                                <div class="col-md-2">
                                                    <img src="{{asset('file/')}}/{{$ord->images}}" style="width : 100%;; border: 1px solid lightgrey;"/>
                                                </div>
                                                <div class="col-md-6" style="overflow-wrap: break-word;">
                                                    <h5 style="font-size:20px;">{{$ord->name}}</h5>
                                                    <?php
                                                        $size = \App\Models\Size::where('id',$ord->size_id)->first();
                                                        $color = \App\Models\Color::where('id',$ord->color_id)->first()
                                                    ?>
                                                    <div>Color : <div id="color-show" style="background-color :{{$color->value}}"></div><br>
                                                        Size : <b>{{$size->name}}</b><br>
                                                        Mrp price :
                                                        <span class="price-strike"><b>₹{{$ord->mrp_price}}</b></span><br>
                                                        <span class="">Discount Price :<b>₹{{$ord->sale_price}}</b></span><br>
                                                        <span class="">Qty :<b>₹{{$ord->qty}}</b></span><br>
                                                        <span class="">SKU CODE :<b>
                                                            <?php $product = \App\Models\Product::find($ord->product_id); ?>
                                                            {{$product->sku_code}}
                                                            </b></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 py-5 text-center">
                                                    Status<br>
                                                    @if($order->status === 0)
                                                    <span class="badge badge-primary">Order Confirm</span>
                                                    @elseif($order->status === 1)
                                                    <span class="badge badge-primary">Order Proccess</span>
                                                    @elseif($order->status === 2)
                                                    <span class="badge badge-primary">Order Shipped</span>
                                                    @elseif($order->status === 3)
                                                    <span class="badge badge-success">Order Completed</span>
                                                    @elseif($order->status === 4)
                                                    <span class="badge badge-danger">Order Canceled</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-2">

                                                </div>
                                                <div class="col-md-5">
                                                   <?php
                                                     $gift = \App\Models\OrderProductGift::where('order_product_id',$ord->id)->first();
                                                   ?>
                                                   @if($gift)
                                                      <h4>Gift Wrap</h4>
                                                      <h6>
                                                          Gift Type : <span>{{$gift->gift_type}}</span><br>
                                                          Sender : <span>{{$gift->sender}}</span><br>
                                                          Recipient : <span>{{$gift->recipient}}</span><br>
                                                          Message : <span style="width : 100%;">{{$gift->message}}</span><br>
                                                      </h6>
                                                   @endif
                                                </div>
                                                <div class="col-md-5">
                                                    <?php
                                                      $msg = \App\Models\OrderProductMessage::where('order_product_id',$ord->id)->first();
                                                    ?>
                                                    @if($gift)
                                                       <h4>Message box</h4>
                                                       <h6>
                                                           Sender : <span>{{$msg->sender}}</span><br>
                                                           Recipient : <span>{{$msg->recipient}}</span><br>
                                                           Message : <span style="width : 100%;">{{$msg->message}}</span><br>
                                                       </h6>
                                                    @endif
                                                 </div>

                                            </div>
                                            @endforeach
                                            <div class="row px-3">
                                                <div class="col-md-12">
                                                    <h4 class="text-right">Discount : {{$order->order_discount->discount}}</h4>
                                                    <h4 class="text-right">Coupon Discount : {{$order->order_discount->coupon_discount !== null ? $order->order_discount->coupon_discount : 0}}</h4>
                                                    <h4 class="text-right">Final Price : {{$order->amount}}</h4>
                                                    <a class="btn btn-warning float-right" href="{{url("invoice/$order->order_id")}}" target="_blank">invoice download</a>
                                                 </div>

                                                 <div class="col-md-12">
                                                     <p>Delivery Address : {{$order->address}}</p>
                                                 </div>

                                            </div>
                                            <div class="row">
                                                @if($order->status !== 4)
                                                <div class="col-md-12">
                                                    <div class="track">
                                                        <div class="step @if($order->status >= 0)active @endif"> <span class="icon"> <i class="fa fa-check mt-3"></i> </span> <span class="text">Order confirmed</span> </div>
                                                        <div class="step @if($order->status >= 1)active @endif"> <span class="icon"> <i class="fa fa-user mt-3"></i> </span> <span class="text"> Proccesed</span> </div>
                                                        <div class="step @if($order->status >= 2)active @endif"> <span class="icon"> <i class="fa fa-truck mt-3"></i> </span> <span class="text"> Shipped </span> </div>
                                                        <div class="step @if($order->status === 3)active @endif"> <span class="icon"> <i class="fa fa-archive mt-3"></i> </span> <span class="text">Completed</span> </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            </div>

                                        @endforeach
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                 {{$orders->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade @if($type === 'wallet') active in @endif" id="wallet" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Wallet</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <img src="{{asset('store/images/wallet.png')}}" style="height : 200px;"/>
                                        <h3>Rs {{$walletamount}}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade @if($type === 'cp') active in @endif"   id="passwordinfo" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Change Password</h3>
                                    <div class="">
                                        <form action="{{route('user.changepass')}}" method="post">
                                            @csrf
                                          <div class="form-group">
                                            <label for="password" STYLE="color : black !important;">Password:</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                            @error('password')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                          </div>
                                          <div class="form-group">
                                            <label for="confirm_password">Confirm Password:</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                            @error('confirm_password')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                          </div>
                                          <button class="btn float-right btn-account" >save</button>
                                          <div class="p-3"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade
                                @if($type === 'address')
                                active in
                                @endif
                                " id="address-edit" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Your Billing Address

                                            <button class="add-btn float-right" type="button"  data-toggle="modal" data-target="#deliveryaddress_Modal">Add Address</button>

                                    </h3>
                                    <div class="row">
                                        @foreach($addresses as $address)
                                        <div class="col-md-6" >
                                            <div class=" p-2 px-3" id="address-box" style="border : 1px solid lightgrey; border-radius : 10px;">

                                                    <i id="add-delete" class="fa fa-2x fa-trash" style="color : red;" data-id="{{$address->id}}"></i>

                                                <address>
                                                    <h4>
                                                        @if($address->address_type === 1)
                                                            <i class="fa fa-lg fa-home"></i>&nbsp;Home
                                                        @else
                                                        <i class="fa fa-lg fa-briefcase"></i>&nbsp;Office
                                                        @endif

                                                        @if($address->by_default === 1)
                                                        (Default)
                                                        @endif

                                                    </h4>

                                                    <p>
                                                        <strong style="font-weight : bold;">{{$address->name}}</strong><br>
                                                        {{$address->area}} <br>
                                                {{$address->house}}<br>

                                                <?php
                                                 $state = \DB::table('states')->where('id', $address->state_id)->first()->name;
                                                 $country = \DB::table('countries')->where('id', $address->country_id)->first()->name;
                                                ?>
                                                {{$state}}&nbsp;{{$country}}<br>
                                                {{$address->landmark}}<br>
                                                Mobile: {{$address->mobile}}

                                                </p>

                                                </address>
                                                <a href="#" class="check-btn sqr-btn " id="address-edit" data-id="{{$address->id}}"><i class="fa fa-edit"  data-id="{{$address->id}}""></i> Edit Address</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade
                                @if($type === 'detail')
                                active in
                                @endif
                                " id="account-info" role="tabpanel">
                                <div class="myaccount-content">
                                    <h3>Account Details</h3>
                                    <div class="account-details-form">
                                        <form action="{{route('user.detail')}}" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-4  col-lg-offset-4 text-center">
                                                   @if($auth->avatar !== null)
                                                     <img src="{{asset('file')}}/{{$auth->avatar}}" style="width : 100px;"/><br>
                                                   @else
                                                     <img src="{{asset('store/images/avatar.png')}}" style="width : 100px;"/><br>
                                                   @endif
                                                   <div class="input-group">
                                                        <input type="file" name="avatar" class="form-control" >
                                                    </div>
                                                    @error('avatar')
                                                        <div class="error">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="name">Full Name:</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{$auth->name}}">
                                                        @error('name')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="email">Email Address:</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{$auth->email}}">
                                                        @error('email')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="mobile">Mobile Number:</label>
                                                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{$auth->mobile}}">
                                                        @error('mobile')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="city">Your City:</label>

                                                        <select name="city" class="form-control " id="city" value="{{$auth->city_id}}">
                                                            @foreach($cities as $city)
                                                              <option value="{{$city->id}}">
                                                                {{$city->name}}
                                                              </option>
                                                            @endforeach
                                                        </select>

                                                        @error('city')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-input-item">
                                                <button class="check-btn sqr-btn " type="submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- Single Tab Content End -->
                        </div>
                    </div> <!-- My Account Tab Content End -->
                </div>
            </div> <!-- My Account Page End -->
        </div>
    </div>
</div>

<div class="modal fade" id="deliveryaddress_Modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-center my-3" id="exampleModalLabel">Add a new address</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
            <div class="row  px-5">
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control" name="address_type" id="add-type">
                          <option value="" selected>Select Address Type</option>
                          <option value="1">Home (7 am - 9 pm delivery)</option>
                          <option value="2">Office/Commercial (10 am - 6 pm delivery)</option>
                        </select>
                        <p class="text-danger" id="add-type-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control" name="address_country" id="add-country" style="width : 100%;">
                          <option value="" selected>Country</option>
                          @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                          @endforeach
                        </select>
                        <p class="text-danger" id="add-country-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="add-name" placeholder="Full name">
                        <p class="text-danger" id="add-name-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="number" class="form-control" id="add-mobile" placeholder="10 digit mobile number without prefixes">
                        <p class="text-danger" id="add-mobile-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="add-pincode" placeholder="6 digits [0-9] PIN code">
                        <p class="text-danger" id="add-pincode-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="add-house" placeholder="Flat, House no., Building, Company, Apartment">
                        <p class="text-danger" id="add-house-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="add-area" placeholder="Area, Street, Sector, Village">
                        <p class="text-danger" id="add-area-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="add-landmark" placeholder="Eg. near apollo hospital">
                        <p class="text-danger" id="add-landmark-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="add-city" placeholder="Town/City">
                        <p class="text-danger" id="add-city-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control" name="address_state" id="add-state" style="width : 100%;">
                          <option value="" selected>State</option>

                        </select>
                        <p class="text-danger" id="add-state-error"></p>
                    </div>
                </div>

                <div class="col-6">
                    <input type="checkbox" id="add-default" /> <span>Make this my default address</span>
                    <p class="text-danger" id="add-default-error"></p>
                </div>
                <div class="col-6">
                   <h3>Add delivery instructions</h3>
                   <p>Preferences are used to plan your delivery. However, shipment cam sometimes arrive early or later than planned
                   </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save-address">Save</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="deliveryaddressedit_Modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title text-center my-3" id="exampleModalLabel">Add Address</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-5">
              <div class="row  px-5">
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control" name="edit_type" id="edit-type">
                          <option value="" selected>Select Address Type</option>
                          <option value="1">Home (7 am - 9 pm delivery)</option>
                          <option value="2">Office/Commercial (10 am - 6 pm delivery)</option>
                        </select>
                        <p class="text-danger" id="edit-type-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control" name="address_country" id="edit-country" style="width : 100%;">
                          <option value="" selected>Country</option>
                          @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                          @endforeach
                        </select>
                        <p class="text-danger" id="edit-country-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit-name" placeholder="Full name">
                        <p class="text-danger" id="edit-name-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="number" class="form-control" id="edit-mobile" placeholder="10 digit mobile number without prefixes">
                        <p class="text-danger" id="edit-mobile-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit-pincode" placeholder="6 digits [0-9] PIN code">
                        <p class="text-danger" id="edit-pincode-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit-house" placeholder="Flat, House no., Building, Company, Apartment">
                        <p class="text-danger" id="edit-house-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit-area" placeholder="Area, Street, Sector, Village">
                        <p class="text-danger" id="edit-area-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit-landmark" placeholder="Eg. near apollo hospital">
                        <p class="text-danger" id="edit-landmark-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="edit-city" placeholder="Town/City">
                        <p class="text-danger" id="edit-city-error"></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <select class="form-control" name="address_state" id="edit-state" style="width : 100%;">
                          <option value="" selected>State</option>

                        </select>
                        <p class="text-danger" id="edit-state-error"></p>
                    </div>
                </div>

                <div class="col-6">
                    <input type="checkbox" id="edit-default" /> <span>Make this my default address</span>
                    <p class="text-danger" id="edit-default-error"></p>
                </div>
                <div class="col-6">
                   <h3>Add delivery instructions</h3>
                   <p>Preferences are used to plan your delivery. However, shipment cam sometimes arrive early or later than planned
                   </p>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update-address">Save</button>
          </div>
        </div>
      </div>
    </div>
@endsection


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document" style="width : 30%;">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h5 class="modal-title text-center" id="exampleModalLabel">Modal title</h5> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="text-danger text-center"><i class="fa fa-trash fa-lg"></i>&nbsp;Do you want to cancel this order</h4>
          <input type="hidden" name="refund-input" id="refund-id" value="" />
          <select class="form-control" id="reason">
            <option selected value="">Select reason
            </option>
              @foreach($reasons as $reason)
              <option value="{{$reason->id}}">
                {{$reason->description}}
              </option>
              @endforeach
          </select>
          <p class="text-danger" id="reason-error"></p>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" id="cancel-order">Cancel Order</button>
        </div>
      </div>
    </div>
  </div>
@push('scripts')
   <script>

        $(document).on('click','#account-nav', function(){
            var $this = $(this);

            $(document).find("[id^='account-nav']").each(function(){
                var view = $(this).attr('data-name');
                $(`#${view}`).removeClass('active');
                $(`#${view}`).removeClass('in');
                $(this).removeClass("active").addClass('deactive');
            })
            $this.removeClass('deactive').addClass('active');
            $this.css('color', 'white !important');
            history.pushState({}, null, '?type='+$this.attr('data-name'));
        });

        $(function(){
            var states = <?php echo json_encode($states) ; ?>;
            var counties =  <?php echo json_encode($countries); ?>;
            var edit_id = 0;

            $(document).find('.page-link').each(function(){
                    var href = $(this).attr('href');
                    if(href !== undefined)
                    {
                        href = href.replace('?',`?type=orders&`);
                       $(this).attr('href',href);

                    }
            });

            @if(\Session::has('cp_success'))
            toastr.success('Success', "{{\Session::get('cp_success')}}",{
                        positionClass: 'toast-top-center',
                    });
            @endif

            @if(\Session::has('detail_success'))
            toastr.success('Success', "{{\Session::get('detail_success')}}",{
                        positionClass: 'toast-top-center',
                    });
            @endif
            var delete_id = 0;
            $(document).on('click','#refund-btn', function(e){
              delete_id = $(this).attr('data-id');
            });

            $(document).on('click','#cancel-order', function(e){
                e.preventDefault();
                var error = false;
                var reason_id = $(document).find('#reason').val();
                if(reason_id === ''){
                    error = true;
                    $(document).find('#reason-error').html('* Reason is required!');
                }

                if(!error){
                    $.ajax({
                        type: "post",
                        url: "{{route('user.order.cancel')}}",
                        data: {
                            order_id : delete_id,
                            reason_id : reason_id
                        },
                        beforeSend: function(){
                            overlay.addClass('is-active');
                        },
                        success: function (response) {
                            overlay.removeClass('is-active');
                            toastr.success('Success',response.message ,{
                                positionClass: 'toast-top-center',
                            });
                            location.reload();
                        },
                        error : function(err){
                            console.log(err);
                            toastr.error('Error','Internal server error!' ,{
                                positionClass: 'toast-top-center',
                            });
                        }
                    });
                }
            });

            $(document).find('#city').select2();
            $('#add-country').select2();
            $('#add-state').select2();
            $('#edit-country').select2();
            $('#edit-state').select2();

            $(document).on("click","#address-edit", function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                if(id !== undefined){
                    edit_id = id;
                    $.ajax({
                        type: "get",
                        url: "{{url('address/show')}}"+`/${id}`,
                        data: {},
                        beforeSend : function(){
                        overlay.addClass('is-active');
                        },
                        success: function (response) {
                        overlay.removeClass('is-active');
                        var address = response.data;
                        let address_type = address.address_type;
                        let area = address.area;
                        let by_default = address.by_default;
                        let country_id = address.country_id;
                        let state_id = address.state_id;
                        let city =  address.city;
                        let house = address.house;
                        let landmark = address.landmark;
                        let mobile = address.mobile;
                        let name = address.name;
                        let pincode = address.pincode;

                        $(document).find('#edit-name').val(name);
                        $(document).find('#edit-area').val(area);
                        $(document).find('#edit-type').val(address_type);
                        $(document).find('#edit-city').val(city);
                        $(document).find('#edit-house').val(house);
                        $(document).find('#edit-landmark').val(landmark);
                        $(document).find('#edit-mobile').val(mobile);
                        $(document).find('#edit-pincode').val(pincode);
                        $(document).find('#edit-country').val(country_id);

                        if(by_default){
                            $(document).find('#edit-default').prop('checked', true);
                        }
                        $(document).find('#edit-state').empty();
                        for(var i = 0; i < states.length; i++){

                            if(states[i].country_id == country_id){
                            var select = (state_id == states[i].id) ? 'selected' : '';
                            $(document).find('#edit-state').append(`<option value="${states[i].id}"  ${select}>${states[i].name}</option>`);
                            }
                        }
                        $(document).find('#edit-state').val(state_id);
                        $(document).find('#deliveryaddressedit_Modal').modal('show');
                        },
                        error : function(err){
                        toastr.error('Error', 'Internal server error',{
                            positionClass: 'toast-top-center',
                        });
                        }
                    });
                }

            });


            $(document).on('change','#add-country', function(e){
             e.preventDefault();
             var id = $(this).val();
             if(id !== ''){
               $.ajax({
                  type: "get",
                  url: "{{url('country/state')}}"+`/${id}`,
                  data: {},
                  beforeSend : function(){
                    overlay.addClass('is-active');
                  },
                  success: function (response) {
                    overlay.removeClass('is-active');
                    var states = response.data;
                    $(document).find('#add-state').empty().append('<option value="">State</option>');
                    for(var i = 0 ; i < states.length ; i++){
                        $(document).find('#add-state').append(`<option value="${states[i].id}">${states[i].name}</option>`);
                    }

                  },
                  error : function(err){
                    toastr.error('Error', 'No state found',{
                        positionClass: 'toast-top-center',
                    });
                  }
              });
             }
             else{
               return;
             }
           });

           $(document).on('click','#save-address', function(e){
               e.preventDefault();
               $(document).find('#add-type-error').html('');
               $(document).find('#add-name-error').html('');
               $(document).find('#add-country-error').html('');
               $(document).find('#add-state-error').html('');
               $(document).find('#add-mobile-error').html('');
               $(document).find('#add-house-error').html('');
               $(document).find('#add-area-error').html('');
               $(document).find('#add-city-error').html('');
               $(document).find('#add-pincode-error').html('');
               $(document).find('#add-landmark-error').html('');
               $(document).find('#add-default-error').html('');

               var addtype = $(document).find('#add-type').val();
               var name = $(document).find('#add-name').val();
               var pincode = $(document).find('#add-pincode').val();
               var house = $(document).find('#add-house').val();
               var area = $(document).find('#add-area').val();
               var landmark = $(document).find('#add-landmark').val();
               var mobile = $(document).find('#add-mobile').val();
               var country = $(document).find('#add-country').val();
               var state = $(document).find('#add-state').val();
               var city = $(document).find('#add-city').val();
               var by_default = $(document).find('#add-default').is(':checked') ? true : false;

               var error = false;
               if(name === ''){
                  $(document).find('#add-name-error').html('*Field is required!');
                  error = true;
               }

               if(pincode === ''){
                  $(document).find('#add-pincode-error').html('*Field is required!');
                  error = true;
               }
               else if(pincode.length !== 6){
                $(document).find('#add-pincode-error').html('*Pincode Invalid!');
                  error = true;
               }

               if(house === ''){
                  $(document).find('#add-house-error').html('*Field is required!');
                  error = true;
               }
               else if(house.length < 5){
                $(document).find('#add-house-error').html('*should be at least 5 char long!');
                  error = true;
               }

               if(mobile === ''){
                  $(document).find('#add-mobile-error').html('*Field is required!');
                  error = true;
               }
               else if(mobile.length != 10){
                $(document).find('#add-mobile-error').html('*must be 10 digit long!');
                  error = true;
               }

               if(area === ''){
                  $(document).find('#add-area-error').html('*Field is required!');
                  error = true;
               }
               else if(area.length < 5){
                $(document).find('#add-area-error').html('*should be at least 5 char long!');
                  error = true;
               }

               if(landmark === ''){
                  $(document).find('#add-landmark-error').html('*Field is required!');
                  error = true;
               }
               else if(landmark.length < 3){
                $(document).find('#add-landmark-error').html('*should be at least 3 char long!');
                  error = true;
               }

               if(country === ''){
                  $(document).find('#add-country-error').html('*Field is required!');
                  error = true;
               }

               if(state === ''){
                  $(document).find('#add-state-error').html('*Field is required!');
                  error = true;
               }

               if(city === ''){
                  $(document).find('#add-city-error').html('*Field is required!');
                  error = true;
               }
               else if(city.length < 3){
                $(document).find('#add-city-error').html('*should be at least 3 char long!');
                  error = true;
               }

               if(addtype === ''){
                 $(document).find('#add-type-error').html('*Field is required!');
                 error = true;
               }




               if(error){
                  return;
               }
               else{
                   $.ajax({
                      type: "post",
                      url: "{{route('add.address')}}",
                      data: {
                        name : name,
                        pincode : pincode,
                        landmark : landmark,
                        city : city,
                        country: country,
                        mobile : mobile,
                        house : house,
                        addtype : addtype,
                        state : state,
                        area : area,
                        by_default : by_default
                      },
                      beforeSend : function(){
                        overlay.addClass('is-active');
                      },
                      success: function (response) {
                        overlay.removeClass('is-active');
                        toastr.success('Success', response.message,{
                                            positionClass: 'toast-top-center',
                        });
                        $(document).find('#deliveryaddress_Modal').modal('hide');
                        location.reload();
                      },
                      error : function(err){
                        toastr.error('Error', 'Internal server error',{
                                        positionClass: 'toast-top-center',
                                });
                      }
                  });
               }

           });

           $(document).on('click','#add-delete', function(e){
               e.preventDefault();
               var id = $(this).attr('data-id');
               $.ajax({
                   type: "delete",
                   url: "{{url('address')}}"+`/${id}`,
                   data: {
                       id : id,
                       _token : "{{csrf_token()}}"
                   },
                   beforeSend : function(){
                     overlay.addClass('is-active');
                   },
                   success: function (response) {
                    overlay.removeClass('is-active');
                    toastr.success('Success', response.message,{
                        positionClass: 'toast-top-center',
                     });
                     location.reload();
                   },
                   error:function(err){
                     toastr.error('Error', 'Internal server error',{
                        positionClass: 'toast-top-center',
                     });
                   }
               });
           })

           $(document).on('click','#update-address', function(e){
               e.preventDefault();
               $(document).find('#edit-type-error').html('');
               $(document).find('#edit-name-error').html('');
               $(document).find('#edit-country-error').html('');
               $(document).find('#edit-state-error').html('');
               $(document).find('#edit-mobile-error').html('');
               $(document).find('#edit-house-error').html('');
               $(document).find('#edit-area-error').html('');
               $(document).find('#edit-city-error').html('');
               $(document).find('#edit-pincode-error').html('');
               $(document).find('#edit-landmark-error').html('');
               $(document).find('#edit-default-error').html('');

               var addtype = $(document).find('#edit-type').val();
               var name = $(document).find('#edit-name').val();
               var pincode = $(document).find('#edit-pincode').val();
               var house = $(document).find('#edit-house').val();
               var area = $(document).find('#edit-area').val();
               var landmark = $(document).find('#edit-landmark').val();
               var mobile = $(document).find('#edit-mobile').val();
               var country = $(document).find('#edit-country').val();
               var state = $(document).find('#edit-state').val();
               var city = $(document).find('#edit-city').val();
               var by_default = $(document).find('#edit-default').is(':checked') ? true : false;

               var error = false;
               if(name === ''){
                  $(document).find('#edit-name-error').html('*Field is required!');
                  error = true;
               }

               if(pincode === ''){
                  $(document).find('#edit-pincode-error').html('*Field is required!');
                  error = true;
               }
               else if(pincode.length !== 6){
                $(document).find('#edit-pincode-error').html('*Pincode Invalid!');
                  error = true;
               }

               if(house === ''){
                  $(document).find('#edit-house-error').html('*Field is required!');
                  error = true;
               }
               else if(house.length < 5){
                $(document).find('#edit-house-error').html('*should be at least 5 char long!');
                  error = true;
               }

               if(mobile === ''){
                  $(document).find('#edit-mobile-error').html('*Field is required!');
                  error = true;
               }
               else if(mobile.length != 10){
                $(document).find('#edit-mobile-error').html('*must be 10 digit long!');
                  error = true;
               }

               if(area === ''){
                  $(document).find('#edit-area-error').html('*Field is required!');
                  error = true;
               }
               else if(area.length < 5){
                $(document).find('#edit-area-error').html('*should be at least 5 char long!');
                  error = true;
               }

               if(landmark === ''){
                  $(document).find('#edit-landmark-error').html('*Field is required!');
                  error = true;
               }
               else if(landmark.length < 3){
                $(document).find('#edit-landmark-error').html('*should be at least 3 char long!');
                  error = true;
               }

               if(country === ''){
                  $(document).find('#edit-country-error').html('*Field is required!');
                  error = true;
               }

               if(state === ''){
                  $(document).find('#edit-state-error').html('*Field is required!');
                  error = true;
               }

               if(city === ''){
                  $(document).find('#edit-city-error').html('*Field is required!');
                  error = true;
               }
               else if(city.length < 3){
                $(document).find('#edit-city-error').html('*should be at least 3 char long!');
                  error = true;
               }

               if(addtype === ''){
                 $(document).find('#edit-type-error').html('*Field is required!');
                 error = true;
               }

               if(error){
                  return;
               }
               else{
                   $.ajax({
                      type: "patch",
                      url: "{{route('update.address')}}",
                      data: {
                        address_id : edit_id,
                        name : name,
                        pincode : pincode,
                        landmark : landmark,
                        city : city,
                        country: country,
                        mobile : mobile,
                        house : house,
                        addtype : addtype,
                        state : state,
                        area : area,
                        by_default : by_default
                      },
                      beforeSend : function(){
                        overlay.addClass('is-active');
                      },
                      success: function (response) {
                        overlay.removeClass('is-active');
                        toastr.success('Success', response.message,{
                                            positionClass: 'toast-top-center',
                        });
                        $(document).find('#deliveryaddressedit_Modal').modal('hide');
                        location.reload();
                      },
                      error : function(err){
                        toastr.error('Error', 'Internal server error',{
                                        positionClass: 'toast-top-center',
                                });
                      }
                  });
               }

           });

        })
   </script>
@endpush
