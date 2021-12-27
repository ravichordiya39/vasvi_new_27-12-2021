@extends('store.layouts.app')
@section('title', 'Vasvi ' .request()->segment(1))
@section('meta_keywords', 'Vasvi.in, Ecommerce, Shopping, Mens, Woman, Kids, Cloth')
@section('meta_description', 'Ecommerce website to buy a product in quantity or bulk with lots of discount')
@push('styles')
  <style>
    .delivery-address{
      position : relative !important;
    }

    #address-box{
        position: absolute !important;
        right : 0;
        top : 0;
    }
  </style>
@endpush


@section('content')
<!-- Coupon code Modal start  -->
<div class="modal fade" id="couponcodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog couponcode-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:none;">
         <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body coupon-code-model">
         <div class="col-md-12">
         <p>Apply Coupon</p>
         <input type="text" class="form-control coupon-form-control" placeholder="enter coupon code here" id="coupon-code"/>
         <button type="button" class="btn btn-pink f_size13" id="apply-coupon" style="margin-top:-4px;">Apply</button>
        </div>
        </div>
        <div class="clear"></div>
        <div class="modal-footer" style="border-top:none; text-align:center !important; ">

        </div>
      </div>
    </div>
  </div>
  <!-- Coupon code Modal start  -->
<div class="headertopspace"></div>
<div class="container">
    <div class="row">
  <div class="col-md-12 col-sm-12 cart-page-heading"><h2 class="font">Checkout</h2></div>
    <!-- Payment Left section start here-->
     <div class="col-md-8 col-sm-8 cartpage-lft">

        <div class="panel-group payment-panel" id="accordion" role="tablist" aria-multiselectable="true">
        @if(!Auth::check())
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                SIGNIN <span class="usermail"></span>
                </a>
            </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="col-md-6 login">

                    <p class="font text-left" style="font-size:17px; margin-bottom: 15px;">I have an Account</p>
                    <div class="col-md-12">
                <form>

                            <div class="formrow">
                            <label class="label-title">Mobile Number, Email ID</label>
                            <div class="icon"><i class="far fa-envelope"></i></div> <input type="text" name="username" id="chk-username" value="" class="form-control">

                            </div>
                            <p class="text-danger" id="chk-name-error"></p>


                            <div class="formrow">
                            <label class="label-title">Password</label>
                            <div class="icon"><i class="fa fa-lg fa-lock"></i></div> <input type="password" name="password"  id="chk-password" value="" class="form-control">

                            </div>
                            <p class="text-danger" id="chk-password-error"></p>


                        <div class="row martop10">
                            <div class="col-md-12" style="text-align:center;"><button name="submit" class="btn  btn-signup btn-pink " id="chk-login" type="submit">SIGN IN</button>
                        </div>


                        </div>

                </form>
                    </div>

                </div>

                <div class="col-md-6 login text-center panelrgt">
                <p class="font">Sign In with Social Account</p>
                    <a href="{{ url('/redirect/facebook') }}" class="btn btn-social btnfb"><i class="fab fa-facebook-f"></i> <span class="divider"></span> Facebook</a>
                    <a href="{{ url('/redirect/google') }}" class="btn btn-social btn-gmail"><i class="fab fa-google"></i> <span class="divider"></span> Google</a>
                    <p>Don't have an account?</p>
                    <p>Join Vasvi Shop today</p>
                    <a href="" class="btn btn-border font" id="signup-click">SIGNUP</a>
                </div>




            </div>
            </div>
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo" >
            <h4 class="panel-title">
                <a class="collapsed" role="button" @if(\Auth::check()) data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" @endif id="address-alert">
                Delivery Method
                </a>
            </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12 address-form padlr0">
                    <?php $jsaddress = 0; ?>
                    @if(count($addresses) > 0)
                    @foreach($addresses as $address)
                    <div class="col-md-6">
                        <div class="delivery-address">
                            <input type="radio" name="default-address" id="address-box" value="{{$address->id}}" class="float-right" @if($address->by_default === 1) checked @endif/>
                            <?php
                              if($address->by_default === 1){
                                $jsaddress = $address->id;
                              }
                            ?>
                            <h4 class="m-0 p-0 mb-2">@if($address->address_type === 1) Home @else Office @endif</h4>
                            <p>{{$address->name}} <span id="default">@if($address->by_default === 1) (default) @endif</span><br/>
                             {{$address->area}} {{$address->house}} {{$address->landmark}}
                             <?php
                                echo  \DB::table('countries')->where('id', $address->country_id)->first()->name;
                                echo '&nbsp;';
                                echo  \DB::table('states')->where('id', $address->state_id)->first()->name;
                             ?>
                             {{$address->city}} - {{$address->pincode}} <br>Mobile - {{$address->mobile}}</p>

                            <button type="button" class="btn btn-mod" id="modify-address" data-id="{{$address->id}}">Modify</button>
                        </div>
                    </div>
                    @endforeach
                    @endif


                <div class="col-md-12 text-center">
                <button type="button" class="btn  btn-signup btn-pink" style="width:100px;"  data-toggle="modal" data-target="#deliveryaddress_Modal">ADD NEW </button></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <?php
                $total = 0; $discount = 0; $gift = false; $gift_value = 0?>
               @if(session()->has('cart'))
                 @if(count(session()->get('cart')) > 0)
                    @foreach(session()->get('cart') as $cart)
                      <?php
                         if(array_key_exists('gift',$cart)){
                             $gift = true;
                             $gprice = $cart['gift']['type'] === 'basic' ? 30 : 50;
                             $gift_value += $gprice;
                         }
                         $total += $cart['single_price'] * $cart['qty'];
                         $discount += $cart['single_price'] - $cart['single_sales_price'] ;
                      ?>
                    @endforeach
                 @endif
               @endif

                <a class="collapsed" role="button" @if(\Auth::check()) data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" @endif id="payment-alert">
                Make A Payment <span class="txt-payable-ammount">Payable Amount : <i class="fas fa-rupee-sign"></i><span id="drag-total"> {{$total - $discount - (request()->has('coupon_val') ?request()->get('coupon_val') : 0  ) + $gift_value}}</span></span>
                </a>
            </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
              <div class="panel-body">
                  <div class="row">
                    <!-- Nav tabs -->
                    <div class="col-md-4 col-sm-12">
                      <ul class="nav nav-tabs payment-tab" role="tablist">
                          <li role="presentation" class="active"><a href="#wallet" aria-controls="messages" role="tab" data-toggle="tab"><i class="fas fa-wallet"></i>   Wallet</a></li>
                          <li role="presentation" ><a href="#creditcard" aria-controls="home" role="tab" data-toggle="tab">
                          <i class="fas fa-credit-card"></i> Credit Card</a></li>
                          <li role="presentation"><a href="#debitcard" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-credit-card"></i> Debit Card</a></li>

                          <li role="presentation"><a href="#netbanking" aria-controls="settings" role="tab" data-toggle="tab"><i class="fas fa-mouse-pointer"></i> Net Banking</a></li>
                      </ul>
                    </div>

                 <!-- Tab panes -->
                    <div class="col-md-8 col-sm-12 padlr0">
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="wallet">
                            <div class="text-center">
                                @if(\Auth::check())
                                  <?php $wallet = \App\Models\Wallet::where('user_id', \Auth::user()->id)->first(); ?>
                                  <h1>Rs {{\Auth::check() ? $wallet->amount : 0}}</h1>
                                  <button type="submit" class="btn btn-pink font  mt-5" style="margin-top : 150px;border-radius : 20px;padding: 10px 30px;" id="wallet-btn" data-amount="{{\Auth::check() ? $wallet->amount : 0}}">Processed Payment</button>
                                  <h3 class="wallet-alert text-primary font-weight-bold">
                                  </h3>
                                @else
                                  <h1>Rs 0.00</h1>
                                @endif
                            </div>
                        </div>
                      <div role="tabpanel" class="tab-pane" id="creditcard">
                          <div class="col-md-12 ">

                                  <form id="credit-form">
                                  <div class="form-group">
                                  <label>Card Number</label>
                                  <input type="text" class="form-control"  placeholder="xxxx-xxxx-xxxx" id="credit-card-number" >
                                  <p class="text-danger" id="credit-card-error"></p>
                                  <img src="{{asset('store/images/payment-mode-img.jpg')}}" alt="" class="payment-img" />

                                  </div>
                                  <div class="form-group">

                                  <div class="row">
                                  <div class="col-lg-4 col-md-6">
                                      <label style="width:100%;">Expiry Date</label>
                                      <select class="form-control credit-month"  id="inlineFormCustomSelect" >
                                      <option selected value="">Choose Month</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      </select>
                                      <p class="text-danger" id="credit-month-error"></p>
                                  </div>
                                  <div class="col-lg-4 col-md-6">
                                      <label style="width:100%;">&nbsp;</label>
                                      <select class="form-control credit-year"   id="inlineFormCustomSelect">
                                      <option selected value="">Choose Year</option>
                                      <?php
                                        $n = 10;
                                        $firstYear = (int)date('Y');
                                        $lastYear = $firstYear + 9;

                                        for($c = $firstYear; $c <=$lastYear; $c++){
                                              echo '<option value="'.$c.'">'.$c.'</option>';
                                        }
                                      ?>

                                      </select>
                                      <p class="text-danger" id="credit-year-error"></p>
                                      </div>

                                      <div class="col-lg-4 col-md-6 form-group" >
                                      <label style="width:100%;">CVV</label>
                                      <input type="number" class="form-control "  placeholder="***" id="credit-cvv">
                                      <p class="text-danger" id="credit-cvv-error"></p>
                                      </div>
                                      </div>
                                  </div>

                                  <div class="col-lg-12 col-md-12 text-center"><button type="submit" class="btn btn-pink font btn-payment-tab">Processed Payment</button></div>
                              </form>

                          </div>

                      </div>
                      <div role="tabpanel" class="tab-pane" id="debitcard">
                                  <div class="col-md-12">

                                  <form id="credit-submit" class="debit-form">
                                  <div class="form-group">
                                  <label>Card Number</label>
                                  <input type="text" class="form-control"  placeholder="xxxx-xxxx-xxxx" id="debit-card">
                                  <p class="text-danger" id="debit-card-error"></p>
                                  <img src="{{asset('store/images/payment-mode-img.jpg')}}" alt="" class="payment-img" />

                                  </div>
                                  <div class="form-group">

                                  <div class="row">
                                  <div class="col-lg-4 col-md-6">
                                      <label style="width:100%;">Expiry Date</label>
                                      <select class="form-control debit-month"  id="inlineFormCustomSelect" >
                                          <option selected value="">Choose Month</option>
                                          <option value="01">01</option>
                                          <option value="02">02</option>
                                          <option value="03">03</option>
                                          <option value="04">04</option>
                                          <option value="05">05</option>
                                          <option value="06">06</option>
                                          <option value="07">07</option>
                                          <option value="08">08</option>
                                          <option value="09">09</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          <option value="12">12</option>
                                      </select>
                                      <p class="text-danger" id="debit-month-error"></p>
                                  </div>
                                  <div class="col-lg-4 col-md-6">
                                      <label style="width:100%;">&nbsp;</label>
                                      <select class="form-control debit-year"  id="inlineFormCustomSelect" >
                                          <option selected value="">Choose Year</option>
                                          <?php
                                            $n = 10;
                                            $firstYear = (int)date('Y');
                                            $lastYear = $firstYear + 9;

                                            for($c = $firstYear; $c <=$lastYear; $c++){
                                                  echo '<option value="'.$c.'">'.$c.'</option>';
                                            }
                                          ?>

                                      </select>
                                      <p class="text-danger" id="debit-year-error"></p>
                                      </div>

                                      <div class="col-lg-4 col-md-6 form-group mob-mt-15">
                                      <label style="width:100%;">CVV</label>
                                      <input type="text" class="form-control "  placeholder="***"  id="debit-cvv">
                                      <p class="text-danger" id="debit-cvv-error"></p>
                                      </div>
                                      </div>
                                  </div>

                                  <div class="col-lg-12 col-md-12 text-center"><button type="submit" class="btn btn-pink font btn-payment-tab" id="credit-btn">Processed Payment</button></div>
                              </form>

                          </div>

                      </div>

                      <div role="tabpanel" class="tab-pane" id="netbanking">

                          <div class="col-lg-12 col-md-12">
                              <ul class="netbanking-list">
                              <li><a href="#"><img src="{{asset('store/images/bank-logo/axis-logo.jpg')}}" alt=""><br>Axis</a></li>
                              <li><a href="#"><img src="{{asset('store/images/bank-logo/hdfc-logo.jpg')}}" alt=""><br>HDFC</a></li>
                              <li><a href="#"><img src="{{asset('store/images/bank-logo/icci-logo.jpg')}}" alt=""><br>ICCI</a></li>
                              <li><a href="#"><img src="{{asset('store/images/bank-logo/sbi-logo.jpg')}}" alt=""><br>SBI</a></li>
                              <li><a href="#"><img src="{{asset('store/images/bank-logo/kotak-logo.jpg')}}" alt=""><br>Kotak</a></li>
                              <li><a href="#"><img src="{{asset('store/images/bank-logo/citi-bank-logo.jpg')}}" alt=""><br>Citi</a></li>
                              <li><a href="#"><img src="{{asset('store/images/bank-logo/rbl-bank-logo.jpg')}}" alt=""><br>RBL</a></li>
                              <li><a href="#"><img src="{{asset('store/images/bank-logo/bank-of-baroda-logo.jpg')}}" alt=""><br>Bank of Baroda</a></li>

                              </ul>
                              </div>
                              <div class="col-lg-12 col-md-12 text-center mx-auto">
                              <select class="form-control bank-name" id="inlineFormCustomSelect" style="width:100%;">
                                      <option selected="">Choose Other Bank</option>
                                      <option value="1">Bank of india</option>
                                      <option value="1">Punjab National Bank</option>
                                      <option value="3">IDBI Bank</option>
                                      <option value="3">IndusInd Bank</option>
                                      <option value="2">Dena Bank</option>
                                      <option value="3">Allahabad Bank</option>
                                      <option value="3">Canara Bank</option>
                                      <option value="3">Oriental Bank of Commerce</option>
                                      <option value="3">Syndicate Bank</option>
                                      <option value="3">Punjab &amp; Sind Bank</option>
                                      <option value="3">UCO Bank</option>
                                      <option value="3">Union Bank of India</option>
                                      <option value="3">Yes Bank Ltd</option>
                                      <option value="3">Yes Bank Ltd</option>
                                      </select>
                              </div>


                              <div class="col-lg-12 col-md-12  text-center" style="margin-top: 20px;"><button type="submit" class="btn btn-success font btn-payment-tab" id="netbanking">Processed Payment</button></div>

                              </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
        </div>


      </div>
      <!--Payment Left section end here-->

        <!--Cart Right Start here-->
       <div class="col-md-4 col-sm-4">

          <div class="cart-rgt-panel">
          <div class="coupon-text"><button type="button" class="btn" id="apply-acoupon"><i class="fas fa-tags"></i> Apply Coupon Code</button></div>
          <div class="cart-order-summary">
            <h4 class="font">Order Summary</h4>
            <?php
             $total = 0; $discount = 0; ?>
            @if(session()->has('cart'))
              @if(count(session()->get('cart')) > 0)
                 @foreach(session()->get('cart') as $cart)
                   <?php
                      $total += $cart['single_price'] * $cart['qty'];
                      $discount += $cart['single_price'] - $cart['single_sales_price'] ;
                   ?>
                 @endforeach
              @endif
            @endif
            <ul>
              <li>Bag Total <span><i class="fas fa-rupee-sign"></i> {{$total}}</span></li>
              <li>Discount <span><i class="fas fa-rupee-sign"></i> {{$discount}}</span></li>
              <li>Subtotal <span><i class="fas fa-rupee-sign"></i> <span class="sub-total">{{$total - $discount}}</span></span></li>
              <li>Gift Wrap <span class="txtorange boldtxt"  id="gift_value">
                {{$gift === false ? 'NA' : $gift_value}}
              </span></li>
               <li>Coupon Discount <span class="txtorange boldtxt"  id="coupon-discount">
                    {{$coupon_discount === 0 ? 'NA' : $coupon_discount}}
                </span></li>
                <li>Delivery Charges  <span class="txtorange">Free</span></li>
                 <li><strong class="boldtxt">Final Order Amount</strong>  <span class="boldtxt"><i class="fas fa-rupee-sign"></i><span id="grand-total" class="final-amount"> {{($total - $discount) - $coupon_discount + $gift_value}}</span></span></li>
                 <li class="text-center">
                     {{-- <button class="btn btn-success btn-checkout">Place Order</button> --}}
                  <button class="btn btn-secondary btn-checkout">Continue Shopping</button>
                </li>
                 <li><div style="display:inline-block; width:auto; margin-right:10px;">We Accept</div><div style="display:inline-block; width:auto;"><img src="{{asset('store/images/payment_method.png')}}" alt="" width="230"  /></div></li>
            </ul>
          </div>
        </div>
        </div>
        <!--Cart Right end here-->
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


@push('scripts')
   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
   <script>
       $(function(){
           var ddiscount = "{{request()->has('coupon_val') ?  request()->get('coupon_val') : 0}}";
           var dcoupon = "{{request()->has('coupon') ?  request()->get('coupon') : 0}}";
           var wamount = 0;
           var usewallet = false;
           var address_id = "{{$jsaddress}}";
            $(document).ready(function() {
                $('#add-country').select2();
                $('#add-state').select2();
                $('#edit-country').select2();
                $('#edit-state').select2();
            });
           var states = <?php echo json_encode($states) ; ?>;
           var counties =  <?php echo json_encode($countries); ?>;
           var edit_id = 0;


           $(document).on('change','input[type=radio]',function(){
                if($(this).is(':checked')){
                    address_id = $(this).val();
                }
            });

            $(document).on('click','#apply-acoupon', function(e){
                e.preventDefault();
                console.log("{{request()->get('coupon')}}");

                if("{{request()->get('coupon')}}" === ''){
                    $(document).find('#couponcodeModal').modal('show');
                }
                else{
                    alert('You already apply a coupon');
                }
            })


           $(document).on('click','#wallet-btn', function(e){
               e.preventDefault();
               wamount = $(this).attr('data-amount');
               usewallet = true;
               $(this).attr('disabled', true);
           })

           var final_amount = $(document).find('.final-amount').html();
           $(document).on('click','#apply-coupon', function(){
                var coupon = $(document).find('#coupon-code').val();
                var total = $(document).find('.sub-total').html();

                var sub_amount = $(document).find('.sub-amount').html();
                var error = false;
                if(coupon === ''){
                    toastr.warning('Warning', 'Please enter Coupon Code',{
                                    positionClass: 'toast-top-center',
                    });
                }
                else{
                    $.ajax({
                        url: '{{ route('apply.coupon') }}',
                        method: "post",
                        data : {coupon : coupon, amount : total, _token : '{{ csrf_token() }}' },
                        beforeSend : function(){
                            overlay.addClass('is-active');
                        },
                        success: function (response) {

                        overlay.removeClass('is-active');
                        if(response.code === 200){
                            coupon_value = response.coupon_price;
                            dcoupon = coupon;
                            ddiscount = coupon_value;
                            $(document).find('#coupon-discount').html(response.coupon_price);
                            $(document).find('.final-amount').html(parseInt(final_amount) - parseInt(response.coupon_price));
                            $(document).find('#drag-total').html(parseInt(final_amount) - parseInt(response.coupon_price));
                            $(document).find('#coupon-val').val(coupon_value);
                            $(document).find('#coupon-name').val(coupon);
                            $('#couponcodeModal').modal('hide');
                            toastr.success('Success', response.message,{
                                    positionClass: 'toast-top-center',
                            });
                        }
                        else{
                            toastr.warning('Warning', response.message,{
                                    positionClass: 'toast-top-center',
                            });
                        }
                        },
                        error : function(err){

                        }
                    });
                }
            });



           $(document).on('click','#signup-click, #signup-link', function(e){
              e.preventDefault();
              $('#registerModal').modal('show');
           });
           $(document).on('click', '#chk-login', function(e){
                e.preventDefault();
                var name = $(document).find('#chk-username').val();
                var password =  $(document).find('#chk-password').val();

                $(document).find('#chk-name-error').html('');
                $(document).find('#chk-password-error').html('');
                var error = false;
                if(name === ''){
                    $(document).find('#chk-name-error').html('Field is required!');
                    error =  true;
                }

                if(password === ''){
                    $(document).find('#chk-password-error').html('Field is required!');
                    error =  true;
                }
                var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
                if( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(name) ||  name.match(phoneno)){
                    $(document).find('#chk-name-error').html('');
                    error = false;
                }
                else{
                    $(document).find('#chk-name-error').html('Invalid email/mobile number');
                    error = true;
                }

                if(password.length < 6){
                    $(document).find('#chk-password-error').html('Should be atleast 6 character long.');
                    error = true;
                }


                var data = { email :  name, password : password};
                if(!error){
                    $.ajax({
                            type : 'POST',
                            url: '{{route('store.login')}}',
                            data : data,
                            beforeSend : function(){
                                overlay.removeClass('is-active');
                            },
                            success : function(response)
                            {
                                if(response.success)
                                {
                                    toastr.success('Success', response.message,{
                                            positionClass: 'toast-top-center',
                                    });
                                    location.reload();
                                }
                                else
                                {
                                    toastr.error('Error', response.message,{
                                            positionClass: 'toast-top-center',
                                    });
                                }
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

           $(document).on('click','#modify-address', function(e){
             e.preventDefault();
             var id = $(this).attr('data-id');
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
           });

           function payment(method = 'card',month = 0, year = 0, cvv =0, bankname = '', cardnumber = ''){
            var date = new Date();
            var components = [
                date.getYear(),
                date.getMonth(),
                date.getDate(),
                date.getHours(),
                date.getMinutes(),
                date.getSeconds(),
                date.getMilliseconds()
            ];

            var user_name = @if(\Auth::check()) "<?php echo \Auth::user()->name; ?>" @else  '' @endif;
            var user_email = @if(\Auth::check()) "<?php echo \Auth::user()->email; ?>" @else  '' @endif;
            var user_contact = @if(\Auth::check()) "<?php echo \Auth::user()->mobile; ?>"  @else  '' @endif;

            var orderid = components.join("");
            var options = {};
            var amount = $(document).find('#grand-total').html();
                amount = parseInt(amount);
                if(usewallet){
                    amount = amount - parseInt(wamount);
                }

            if(method === 'card'){
                var y = year.substring(2);
                var expiry = month.toString() + y.toString();
                options = {
                    key: "{{env('RAZORPAY_KEY')}}",
                    protocol: 'https',
                    hostname: 'api.razorpay.com',
                    amount: amount * 100,
                    name: 'Vasvi.in',
                    description: "Vasvi.in order payment",
                    image: "https://vasvi.in/store/images/vasvi_logo.jpg",
                    prefill: {
                        name: user_name,
                        email : user_email,
                        contact : user_contact,
                        method : "card",
                        types: ["debit","credit"],
                        "card[name]": user_name,
                        "card[number]" : cardnumber,
                        "card[expiry]" : expiry,
                        "card[cvv]": cvv
                    },
                    theme: {
                        color: '#F77877'
                    },
                    handler: function (response){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type:'POST',
                            url:"{{ route('payment.store') }}",
                            data:{razorpay_payment_id:response.razorpay_payment_id,amount:amount,orderid : orderid, discount : ddiscount, coupon : dcoupon,address_id: address_id,usewallet : usewallet, wamount : wamount},
                            beforeSend: function(){
                                overlay.addClass('is-active');
                            },
                            success:function(data){
                                overlay.removeClass('is-active');
                                response_alert('success',data);
                            },
                            error : function(err){
                                console.log(err);
                                response_alert('error',data);
                            }
                        });
                    },

                };
            }
            if(method === 'netbanking'){
                options = {
                    key: "{{env('RAZORPAY_KEY')}}",
                    protocol: 'https',
                    hostname: 'api.razorpay.com',
                    amount: amount * 100,
                    name: 'Vasvi.in',
                    description: "Vasvi.in order payment",
                    image: "https://vasvi.in/store/images/vasvi_logo.jpg",
                    prefill: {
                        name: user_name,
                        email : user_email,
                        contact : user_contact,
                        method :"netbanking",
                        banks : [
                            "ICIC"
                        ],
                        bank_name: "ICIC"
                    },
                    theme: {
                        color: '#F77877'
                    },
                    handler: function (response){
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type:'POST',
                            url:"{{ route('payment.store') }}",
                            data:{razorpay_payment_id:response.razorpay_payment_id,amount:amount,orderid : orderid, discount : ddiscount, coupon : dcoupon,address_id: address_id,usewallet : usewallet, wamount : wamount},
                            beforeSend : function(){
                                overlay.addClass('is-active');
                            },
                            success:function(data){
                                overlay.removeClass('is-active');
                                response_alert('success',data);
                            },
                            error:function(err){
                                response_alert('error',data);
                            }
                        });
                    },

                };
            }

            console.log(options);
                window.rzpay = new Razorpay(options);
                rzpay.open();
           }

           function response_alert(restype,data){
              if(restype === 'error'){
                toastr.error('Error', 'Internal server error',{
                        positionClass: 'toast-top-center',
                });
              }
              else if(restype === 'warning'){
                toastr.warning('Warning', data.message,{
                        positionClass: 'toast-top-center',
                });
              }
              else{
                toastr.success('Success', data.message,{
                        positionClass: 'toast-top-center',
                });
                window.location.href = "{{url('account/dashboard?type=orders')}}";

              }
           }

           $(document).on('click','#payment-alert',function(e){
            login_alert();
           });

           $(document).on('click','#address-alert',function(e){
            login_alert();
           });

           function login_alert(){
            @if(! \Auth::check())
               toastr.warning('Warning', 'Please login first!',{
                        positionClass: 'toast-top-center',
                });
            @endif
           }

           $(document).on('submit','#credit-form',function(e){
               e.preventDefault();
               var creditCard = $(document).find('#credit-card-number').val();
               var creditMonth = $(document).find('.credit-month').val();
               var creditYear = $(document).find('.credit-year').val();
               var creditCvv = $(document).find('#credit-cvv').val();

               $(document).find('#credit-card-error').html('');
               $(document).find('#credit-year-error').html('');
               $(document).find('#credit-month-error').html('');
               $(document).find('#credit-cvv-error').html('');
               var error = false;

               if(creditCard === ''){
                  $(document).find('#credit-card-error').html('Field is requred');
                  error = true;
               }
               else if(creditCard.length < 12){
                  $(document).find('#credit-card-error').html('Credit card should be aleast 12 digit long');
                  error = true;
               }

               if(creditYear === ''){
                  $(document).find('#credit-year-error').html('Field is requred');
                  error = true;
               }

               if(creditMonth === ''){
                  $(document).find('#credit-month-error').html('Field is requred');
                  error = true;
               }

               if(creditCvv === ''){
                  $(document).find('#credit-cvv-error').html('Field is requred');
                  error = true;
               }

               if(!error){
                payment('card',creditMonth, creditYear,creditCvv,'',creditCard);
               }


           });

           $(document).on('submit','.debit-form',function(e){
               e.preventDefault();
               var creditCard = $(document).find('#debit-card').val();
               var creditMonth = $(document).find('.debit-month').val();
               var creditYear = $(document).find('.debit-year').val();
               var creditCvv = $(document).find('#debit-cvv').val();


               $(document).find('#debit-card-error').html('');
               $(document).find('#debit-year-error').html('');
               $(document).find('#debit-month-error').html('');
               $(document).find('#debit-cvv-error').html('');
               var error = false;

               if(creditCard === ''){
                  $(document).find('#debit-card-error').html('Field is requred');
                  error = true;
               }
               else if(creditCard.length < 12){
                  $(document).find('#debit-card-error').html('Credit card should be aleast 12 digit long');
                  error = true;
               }

               if(creditYear === ''){
                  $(document).find('#debit-year-error').html('Field is requred');
                  error = true;
               }

               if(creditMonth === ''){
                  $(document).find('#debit-month-error').html('Field is requred');
                  error = true;
               }

               if(creditCvv === ''){
                  $(document).find('#debit-cvv-error').html('Field is requred');
                  error = true;
               }

               if(!error){
                payment('card',creditMonth, creditYear,creditCvv,'',creditCard);
               }
           });

           $(document).on('click','#netbanking',function(e){
              var bank = $(document).find('.bank-name').val();
              payment('netbanking','', '','',bank,'');
           });
       })
   </script>
@endpush
