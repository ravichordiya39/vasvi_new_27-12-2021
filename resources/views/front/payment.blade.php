@extends('layouts.front')

@section('content')
<head>
    <style type="text/css">
        .cart-order-summary h4 {font-weight: normal; color: #000;}
  
      </style>
</head>
<!-- Coupon code Modal start  -->
<div class="modal fade" id="couponcodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog couponcode-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:none; padding-bottom: 0px;">
         <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body coupon-code-model" style="padding-top: 0px;">
         <div class="col-md-12"> 
          <h5>Apply Coupon</h5>
         <input type="text" class="form-control coupon-form-control" placeholder="enter coupon code here" />
        </div>
        <div class="col-md-12" style="padding-top: 15px;"> <strong>Active Coupons</strong><br/>no coupons Found</div>
        </div>
        <div class="clear"></div>
        <div class="modal-footer" style="border-top:none; text-align:center !important; ">
         <button type="button" class="btn btn-black f_size13"">Apply Coupon</button>
         <button type="button" class="btn btn-grey-light f_size13"">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Coupon code Modal start  -->
  
  <!-- Add Message Modal start  -->
  <div class="modal fade" id="address_message_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:none;">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
         <h4 class="modal-title" id="exampleModalLabel">Add a Peronalized message </h4>
         
        </div>
        <div class="modal-body coupon-code-model">
         <div class="col-lg-12 col-md-12 mx-auto address-form form-message "> 
         <ul>
     
      <li><label>Recipient Name</label><input type="text" placeholder="Dear" class="form-control" ></li>
       <li><label>Message</label><textarea class="form-control" rows="3" cols="10" style="resize: none;"></textarea></li>
        <li><label>Sender Name</label><input type="text" placeholder="Dear" class="form-control" ></li>
  
    </ul>
        </div>
        </div>
        <div class="modal-footer" style="border-top:none;">
          <button type="button" class="btn btn-secondary f_size13" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success f_size13">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add Message end  -->
  
  <!-- Delivery Address  Modal start  -->
  <div class="modal fade" id="deliveryaddress_Modal" tabindex="-1" role="dialog" aria-labelledby="deliveryaddressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:none;">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
         <h4 class="modal-title" id="exampleModalLabel">Add New delivery details </h4>
         
        </div>
        <div class="modal-body">
          <div class="col-md-12 address-form">
            <ul>
              <li class="form-title">Personal Info </li>
              <li><input type="text" placeholder="First Name" class="form-control" ></li>
               <li><input type="text" placeholder="Last Name" class="form-control" ></li>
                <li class="form-title">Address</li>
                 <li><input type="text" placeholder="Flat No. Building Name" class="form-control" ></li>
                  <li><input type="text" placeholder="Street,Locality,Area" class="form-control" ></li>
                   <li><input type="text" placeholder="Landmark" class="form-control" ></li>
                    <li class="pincode-txt">302022</li>
                     <li><div class="form-control input-50 marrgt10" >Jaipur</div> <div class="form-control input-50" >Rajasthan</div></li>
                     <li><input type="checkbox"  style="margin-right: 10px;"> Save this as my default delivery address</li>
          <li class="text-center"><button type="submit" class="btn btn-pink font btn-payment-tab">Save delivery Address</button></li>
  
            </ul>
          </div>
        </div>
        <div class="modal-footer" style="border-top:none;">
         
        </div>
      </div>
    </div>
  </div>
  <!-- Delivery Address end  -->    
  
<br><br>
<div class="container">
    <div class="col-md-12 col-sm-12 cart-page-heading"><h2 class="font">Checkout</h2></div>
      <!-- Payment Left section start here-->
       <div class="col-md-8 col-sm-12 cartpage-lft">
  
  <div class="panel-group payment-panel" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           SIGNIN <span class="usermail">webdesigner.riteshchhipa@gmail.com</span>
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
                        <div class="icon"><i class="far fa-envelope"></i></div> <input type="text" name="username" value="" class="form-control">                     
                      </div>
             
                       
                      <div class="formrow">
                        <label class="label-title">Password</label>
                         <div class="icon" style="font-size:25px;">***</div> <input type="password" name="password" value="" class="form-control">    
                      </div>
               
               
                  <div class="row martop10">      
                      <div class="col-md-12" style="text-align:center;"><button name="submit" class="btn  btn-signup btn-pink " type="submit">SIGN IN</button>
                    </div>
                    
                      <div class="col-md-12 signuplink">Don't have an account? <a name="submit" class="" type="button" href="#">Sign Up</a></div>
                  </div>
               
             </form> 
                </div>
  
          </div>
  
          <div class="col-md-6 login text-center panelrgt">
            <p class="font">Sign In with Social Account</p>
              <a href="#" class="btn btn-social btnfb"><i class="fab fa-facebook-f"></i> <span class="divider"></span> Facebook</a> 
              <a href="#" class="btn btn-social btn-gmail"><i class="fab fa-google"></i> <span class="divider"></span> Google</a>
              <p>Don't have an account?</p>
               <p>Join Vasvi Stop today</p>
               <a href="" class="btn btn-border font">SIGNUP</a>
            </div>
  
          <div class="col-md-12" style="margin-top: 50px;">
              <p>You are already signed in as webdesigner.riteshchhipa@gmail.com, please click here to sign out </p>
              <a href="#" class="btn btn-pink font">Continue</a>
         </div> 
  
  
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Delivery Method
          </a>
        </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
           <div class="col-md-12 address-form padlr0">
    <div class="delivery-address">
        <p>Rajkumar Singh (Default)<br/>
       manoharpura pratapnagar, kumbha, Jaipur, Rajasthan - 302033</p>
      <button type="button" class="btn btn-mod" data-toggle="modal" data-target="#deliveryaddress_Modal">Modify</button>
    </div>
    
    <div class="col-md-12 text-center">
    <button type="button" class="btn  btn-signup btn-pink" style="width:100px;"  data-toggle="modal" data-target="#deliveryaddress_Modal">ADD NEW </button></div>
  
  </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingThree">
        <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
           Make A Payment <span class="txt-payable-ammount">Payable Amount : <i class="fas fa-rupee-sign"></i> 2000</span>
          </a>
        </h4>
      </div>
      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
        <div class="panel-body">
             <!-- Nav tabs -->
             <div class="col-md-4 col-sm-12">
            <ul class="nav nav-tabs payment-tab" role="tablist">
              <li role="presentation" class="active"><a href="#creditcard" aria-controls="home" role="tab" data-toggle="tab">
                <i class="fas fa-credit-card"></i> Credit Card</a></li>
              <li role="presentation"><a href="#debitcard" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-credit-card"></i> Debit Card</a></li>
              <li role="presentation"><a href="#wallet" aria-controls="messages" role="tab" data-toggle="tab"><i class="fas fa-wallet"></i>   Wallet</a></li>
              <li role="presentation"><a href="#netbanking" aria-controls="settings" role="tab" data-toggle="tab"><i class="fas fa-mouse-pointer"></i> Net Banking</a></li>
            </ul>
          </div>
  
    <!-- Tab panes -->
     <div class="col-md-8 col-sm-12 padlr0">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="creditcard">
              <div class="col-md-12 ">
                
                      <form>
                      <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" class="form-control"  placeholder="xxxx-xxxx-xxxx">
                        <img src="{{ asset('front_assets/images/payment-mode-img.jpg')}}" alt="" class="payment-img" />
                       
                      </div>
                      <div class="form-group">
                       
                       <div class="row">
                        <div class="col-lg-6 col-md-6">
                           <label style="width:100%;">Expiry Date</label>
                          <select class="form-control"  id="inlineFormCustomSelect">
                            <option selected>Choose Month</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="1">07</option>
                            <option value="2">08</option>
                            <option value="3">09</option>
                            <option value="4">10</option>
                            <option value="5">11</option>
                            <option value="6">12</option>
                          </select>
                      </div>
                        <div class="col-lg-6 col-md-6">
                           <label style="width:100%;">&nbsp;</label>
                          <select class="form-control"  id="inlineFormCustomSelect">
                            <option selected>Choose Year</option>
                            <option value="1">2024</option>
                            <option value="2">2021</option>
                            <option value="3">2020</option>
                            <option value="3">2019</option>
                          </select>
                          </div>
  
                            <div class="col-lg-4 col-md-6 form-group" style="margin-top: 15px;">
                            <label style="width:100%;">CVV</label>
                            <input type="password" class="form-control "  placeholder="***" >
                            </div>
                           </div>
                      </div>
                  
                      <div class="col-lg-12 col-md-12 text-center"><button type="submit" class="btn btn-pink font btn-payment-tab">Processed Payment</button></div>
                    </form>
  
              </div> 
            
            </div>
  
  
            <div role="tabpanel" class="tab-pane" id="debitcard">
                      <div class="col-md-12">
                
                      <form>
                      <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" class="form-control"  placeholder="xxxx-xxxx-xxxx">
                        <img src="{{ asset('front_assets/images/payment-mode-img.jpg')}}" alt="" class="payment-img" />
                       
                      </div>
                      <div class="form-group">
                       
                       <div class="row">
                        <div class="col-lg-4 col-md-6">
                           <label style="width:100%;">Expiry Date</label>
                          <select class="form-control"  id="inlineFormCustomSelect">
                            <option selected>Choose Month</option>
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                            <option value="4">04</option>
                            <option value="5">05</option>
                            <option value="6">06</option>
                            <option value="1">07</option>
                            <option value="2">08</option>
                            <option value="3">09</option>
                            <option value="4">10</option>
                            <option value="5">11</option>
                            <option value="6">12</option>
                          </select>
                      </div>
                        <div class="col-lg-4 col-md-6">
                           <label style="width:100%;">&nbsp;</label>
                          <select class="form-control"  id="inlineFormCustomSelect">
                            <option selected>Choose Year</option>
                            <option value="1">2024</option>
                            <option value="2">2021</option>
                            <option value="3">2020</option>
                            <option value="3">2019</option>
                          </select>
                          </div>
  
                            <div class="col-lg-4 col-md-6 form-group mob-mt-15">
                            <label style="width:100%;">CVV</label>
                            <input type="password" class="form-control "  placeholder="***" >
                            </div>
                           </div>
                      </div>
                  
                      <div class="col-lg-12 col-md-12 text-center"><button type="submit" class="btn btn-pink font btn-payment-tab">Processed Payment</button></div>
                    </form>
  
              </div>
  
            </div>
            <div role="tabpanel" class="tab-pane" id="wallet">...</div>
            <div role="tabpanel" class="tab-pane" id="netbanking">
              
              <div class="col-lg-12 col-md-12">
                  <ul class="netbanking-list">
                    <li><a href="#"><img src="{{ asset('front_assets/images/bank-logo/axis-logo.jpg')}}" alt=""><br>Axis</a></li>
                    <li><a href="#"><img src="{{ asset('front_assets/images/bank-logo/hdfc-logo.jpg" alt=""><br>HDFC</a></li>
                    <li><a href="#"><img src="images/bank-logo/icci-logo.jpg')}}" alt=""><br>ICCI</a></li>
                    <li><a href="#"><img src="{{ asset('front_assets/images/bank-logo/sbi-logo.jpg')}}" alt=""><br>SBI</a></li>
                    <li><a href="#"><img src="{{ asset('front_assets/images/bank-logo/kotak-logo.jpg')}}" alt=""><br>Kotak</a></li>
                    <li><a href="#"><img src="{{ asset('front_assets/images/bank-logo/citi-bank-logo.jpg')}}" alt=""><br>Citi</a></li>
                    <li><a href="#"><img src="{{ asset('front_assets/images/bank-logo/rbl-bank-logo.jpg')}}" alt=""><br>RBL</a></li>
                    <li><a href="#"><img src="{{ asset('front_assets/images/bank-logo/bank-of-baroda-logo.jpg')}}" alt=""><br>Bank of Baroda</a></li>  
                    
                  </ul>
                  </div>
                  <div class="col-lg-12 col-md-12 text-center mx-auto"> 
                    <select class="form-control" id="inlineFormCustomSelect" style="width:100%;">
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
  
                  <div class="col-lg-12 col-md-12  text-center" style="margin-top: 20px;"><button type="submit" class="btn btn-success font btn-payment-tab">Processed Payment</button></div>
  
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
         <div class="col-md-4 col-sm-12">
  
            <div class="cart-rgt-panel">
            <div class="coupon-text"><button type="button" class="btn" data-toggle="modal" data-target="#couponcodeModal"><i class="fas fa-tags"></i> Apply Coupon Code</button></div>
            <div class="cart-order-summary">
              <h4 class="font">Order Summary</h4>
              <ul>
                <li>Bag Total <span><i class="fas fa-rupee-sign"></i> 2000</span></li>
                <li>Discount <span><i class="fas fa-rupee-sign"></i> 50</span></li>
                <li>Subtotal <span><i class="fas fa-rupee-sign"></i> 2000</span></li>
                 <li>Coupon Discount <span class="txtorange boldtxt">Apply Coupon</span></li>
                  <li>Delivery Charges  <span class="txtorange">Free</span></li>
                   <li><strong class="boldtxt">Final Order Amount</strong>  <span class="boldtxt"><i class="fas fa-rupee-sign"></i> 2000</span></li>
                   <li><button class="btn btn-success btn-checkout">Place Order</button>
                    <button class="btn btn-secondary btn-checkout">Continue Shopping</button>
                  </li>
                   <li><div style="display:inline-block; width:auto; margin-right:10px;">We Accept</div><div style="display:inline-block; width:auto;"><img src="{{ asset('front_assets/images/payment_method.png')}}" alt="" width="230"  /></div></li>
              </ul>
            </div>
          </div>
          </div> 
          <!--Cart Right end here-->
  
  </div>
  @endsection