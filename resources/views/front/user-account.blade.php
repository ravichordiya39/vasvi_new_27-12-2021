@extends('layouts.front')

@section('content')

<br>
 <!-- Success Payment model start here  -->
 <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog rating-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Payment Successfully  </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center successmodal" >
           <div class="icon icon--order-success svg">
           <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
            <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
            <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
          </svg>
            <p class="txt-success">Your Order Successfully Processed</p>
            <p>Transaction id: AG56HJL568NBH4</p>
  
          </div>
        </div>
     
      </div>
    </div>
  </div>
  
  <!-- Success Payment model model end here  -->
  
      <!-- UnSuccess Payment model start here  -->
  <div class="modal fade" id="unsuccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog rating-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Payment Failed </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center successmodal" >
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
    <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
    <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
    <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
  </svg>
            <p class="txt-unsuccess">Your Payment Failed. Try Again</p>
           
  
          </div>
        </div>
     
      </div>
    </div>
  </div>
  
  <!-- UnSuccess Payment model model end here  -->
  
  
    <!-- Rating & Review model start here  -->
  <div class="modal fade" id="ratingreviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog rating-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Rating & Review </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-left" >
            <ul class="write-review">
                <li class="star-rating"><span style="margin-right:10px; ">Please rate your experience</span> <fieldset class="rating">
      <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
      <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
      <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
      <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
      <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
      <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
      <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
      <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
      <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
      <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
  </fieldset></li>
                <li><span style="font-weight:600;">Add Review</span>
                    <br>
                    <textarea class="form-control" row="20" col="20" style="margin-top:10px;"></textarea>
                </li>
                
            </ul>
        </div>
        <div class="modal-footer text-center" style="text-align: center; border-top: none; padding-top: 0px; display: inline-block;">
          <button type="button" class="btn btn-danger f_size12" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success f_size12">SUBMIT</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Rating & Review model end here  -->
  
  
  <!-- View Detail Modal start here  -->
  <div class="modal fade" id="order-detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog order-detail-model-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Booking Summary</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="col-lg-12 col-md-12 col-sm-12" style="padding-left: 0px;">
            <table class="table table-hover theme-menu-list booking-detail-list mt-2">
              <tr>
                    <td class="thumb-img" width="80"><img src="{{ asset('front_assets/images/ARP3454.jpg')}}" alt="" /></td>
                    <td>
                      <div class="heading-title">Elegant kurti plazo dupatta set xl<br>
                        <p>North Indian Vegetarian friendly</p>
                      </div>
                      </td>
                      
                      <td><div class="txtreview"><strong>Order Date</strong><br/>25 June 2019</div></td>
                       <td><div class="txtreview"><strong>Order Receive</strong><br/>28 June 2019</div></td>
                      <td width="200"><strong>Address</strong><br/>C - 314 Siddharth Nager Jagatpura Road</td>
  
                    <td>
                         <div class="pricetxt"><i class="fas fa-rupee-sign"></i>Total: 15200<br>
                          <span class="cutprice"><i class="fas fa-rupee-sign"></i>Discount: 200</span>
                         
                    </td>         
                   
                  </tr> 
            </table> 
  
  
        <table class="table table-hover theme-menu-list mt-2">
            <thead>
              <tr>
                <th colspan="5" class="textcolor-orange" style="border-top: none;">Other Addon</th>
              </tr>
              <tr>
                <th></th>
                 <th>Item</th>
                 <th class="text-center">Per Unit Price</th>
                <th>Unit</th>
                <th>Total Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Ballons</td>
                <td class="text-center"><i class="fas fa-rupee-sign f_size11 mr-1"></i>10</td>
                <td>1000</td>
                <td><i class="fas fa-rupee-sign f_size11 mr-1"></i>200</td>
               
              </tr>
             
            </tbody>
          </table>          
      </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary f_size12" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success f_size12">Print</button>
        </div>
      </div>
    </div>
  </div>
  <!-- View Detail Modal start here  -->
      
<!--My Account Page start here-->
<div class="container-fluid my-account-fluid">
    <div class="container my-accountpage">
    <div class="row">
    
     <!--Tab Left Section start here---> 
    <div class="col-md-3 col-sm-12">
      <div class="profile-box clearfix">
          <div class="profileImg-container">
                <a href="#myLabel"><img alt="Profile Picture" src="{{ asset('front_assets/images/profile-img.jpg')}}"></a>
              </div>
              <div class="userDetails-container">
                <h2>rajkumar &nbsp;singh</h2>
                <p>8955540569</p>
                <a href="/my-account/update-profile#my-acc-section">Edit</a>
              </div>
            </div>
      <ul class="nav nav-tabs my-account-tab" role="tablist">
        <li role="presentation" class="active">
          <a href="#order" aria-controls="home" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/tag.svg')}}" alt="Booking" width="30" /> Order</a>
        </li>
        <li role="presentation"><a href="#wallet" aria-controls="wallet" role="tab" data-toggle="tab">
          <img src="{{ asset('front_assets/images/wallet.svg')}}" alt="Wallet" width="30" /> Wallet</a></a></li>
        <li role="presentation"><a href="#wishlist" aria-controls="wishlist" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/wishlist.svg')}}" alt="Wishlist" width="30" /> Wishlist</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/profile.svg')}}" alt="Profile" width="30" /> Profile</a></li>
         <li role="presentation"><a href="#changepassword" aria-controls="changepassword" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/profile.svg')}}" alt="Profile" width="30" /> Change Password</a></li>
         <li role="presentation"><a href="#vouchers" aria-controls="vouchers" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/discount.svg')}}" alt="Profile" width="30" /> Vouchers</a></li>
       
         <li role="presentation"><a href="#referral" aria-controls="referral" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/referral-icon.svg')}}" alt="Profile" width="30" /> Referral</a></li>
          <li role="presentation"><a href="#rating" aria-controls="rating" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/review.svg')}}" alt="Profile" width="30" /> Rating & Review</a></li>
           <li role="presentation"><a href="#newsletter" aria-controls="newsletter" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/review.svg')}}" alt="Profile" width="30" /> Newsletter Subcription</a></li>
           <li role="presentation"><a href="#feedback" aria-controls="feedback" role="tab" data-toggle="tab"><img src="{{ asset('front_assets/images/review.svg')}}" alt="Profile" width="30" /> Feedback</a></li>
      </ul>
    </div>
    
    <!--Tab Left End here-->
    
    <!--Tab Right Section Start here-->
    <div class="col-md-9 col-sm-12">
      <!-- Tab panes -->
      <div class="tab-content">
        <!--Order-->
        <div role="tabpanel" class="tab-pane active" id="order">
         <h2 class="tab-heading">Total Order</h2>
                  <div class="table-responsive">
                    <table class="table">
                      
                      <tbody>
                        <tr>
                          <td class="thumb-img"><img src="{{ asset('front_assets/images/ARP3454.jpg')}}"></td>
                          <td><span class="boldtxt f-size16 mt-4">VARANGA</span><br/><br/>
                            <span>Rs.5000</span> &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#order-recieptModal" class="boldtxt">View Receipt</a>
                          </td>
                          <td align="right"><span class="f-size11 boldtxt btn btn-warning">Successfully Ordered</span> <br/><br/> <button  type="button" data-toggle="modal" data-target="#order-detailModal" class="btn btn-success f_size13">View Detail</button> </td>
                        </tr>
                        <tr>
                          <td class="thumb-img"><img src="{{ asset('front_assets/images/ARP3454.jpg')}}"></td>
                          <td><span class="boldtxt f-size16 mt-4">Indigo Women's Straight Kurta</span><br/><br/>
                            <span>Rs.5000</span> &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#order-recieptModal" class="boldtxt">View Receipt</a>
                          </td>
                          <td align="right"><span class="f-size11 boldtxt btn btn-danger"> Ordered Cancelled</span> <br/><br/> <button  type="button" data-toggle="modal" data-target="#order-detailModal" class="btn btn-success f_size13">View Detail</button> </td>
                        </tr>
    
                        <tr>
                          <td class="thumb-img"><img src="{{ asset('front_assets/images/ARP3454.jpg')}}"></td>
                          <td><span class="boldtxt f-size16 mt-4">Front-Open Embroidered Longline Jacket</span><br/><br/>
                            <span>Rs.5000</span> &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#order-recieptModal" class="boldtxt">View Receipt</a>
                          </td>
                          <td align="right"><span class="f-size11 boldtxt btn btn-warning">Successfully Ordered</span> <br/><br/> <button  type="button" data-toggle="modal" data-target="#order-detailModal" class="btn btn-success f_size13">View Detail</button> </td>
                        </tr>
                        
                      </tbody>
                    </table>
    
                  </div>
    
        </div>
         <!--Order-->
        <!--Wallet-->
        <div role="tabpanel" class="tab-pane" id="wallet">
          
               <h2 class="tab-heading">Wallet Balance</h2>
                <div class="row">
                      <div class="col-md-5 col-sm-6 walletsection" style="background:#f9fafa; padding-top:20px;">
                        <div class="row">
                          <div class="col-md-4 col-sm-12 text-center">
                            <img src="{{ asset('front_assets/images/wallet.svg')}}" alt="Wallet" width="50">
                          </div>
                            <div class="col-md-8 col-sm-12 walletcol"><span style="color:#333; font-size:16px;">Rs.</span> <span class="walletnumbertxt">0.00</span><br><span class="walletbaltxt">Wallet Balance</span></div>
    
                            <div class="col-md-12 col-sm-12 text-center" style="margin-top: 15px;"><a href="#" class="btn btn-success f_size13 boldtxt"><i class="fas fa-plus"></i> Add Money</a></div>
                            </div>
    
                             <div class="col-md-12 col-sm-12 text-center mt-4 wallet-card active">
                              <div class="row">
                                <div class="col-md-6 col-sm-12 text-left"><img src="{{ asset('front_assets/images/visa.png')}}" width="50" alt="" /> </div>
                                <div class="col-md-6 col-sm-12 text-right">Debit </div>
                                <div class="col-md-12 col-sm-12 card-number-text">**** **** 5258</div>
                              </div>
                             </div>
    
                              <div class="col-md-12 col-sm-12 text-center mt-4 wallet-card active">
                              <div class="row">
                                <div class=" col-md-6 col-sm-12 text-left"><img src="{{ asset('front_assets/images/visa.png')}}" width="50" alt="" /> </div>
                                <div class="col-md-6 col-sm-12 text-right">Credit </div>
                                <div class="col-md-12 col-sm-12 card-number-text">**** **** 5258</div>
                              </div>
                             </div>
                            </div>
    
                       <div class="col-md-7 col-sm-6 borderrgt"> 
                      <div class="table-responsive">
                        <table class="table wallet-content">
                            <thead>
                                <tr>
                                    <th colspan="3">Transations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><div class="icon-add-green"><i class="fas fa-plus"></i></div></td>
                                    <td><span class="boldtxt">Money Trasfer Ritesh</span><br/><span>12/10/2018 2.40pm</span></td>
                                    <td><span class="txtgreen boldtxt">Rs.1000</span><br/>Transfer</td>  
                                </tr>
    
                                 <tr>
                                    <td><div class="icon-minus-red"><i class="fas fa-minus"></i></div></td>
                                    <td><span class="boldtxt">Money Trasfer John</span><br/><span>12/10/2018 2.40pm</span></td>
                                    <td><span class="txtgreen boldtxt">Rs.1000</span><br/>Transfer</td>   
                                </tr>
                                 <tr>
                                    <td><div class="icon-add-green"><i class="fas fa-plus"></i></div></td>
                                    <td><span class="boldtxt">Money Trasfer Ravnish</span><br/><span>12/10/2018 2.40pm</span></td>
                                    <td><span class="txtgreen boldtxt">Rs.1000</span><br/>Transfer</td>  
                                </tr>
    
                                 <tr>
                                    <td><div class="icon-minus-red"><i class="fas fa-minus"></i></div></td>
                                    <td><span class="boldtxt">Money Trasfer Kelyon</span><br/><span>12/10/2018 2.40pm</span></td>
                                    <td><span class="txtgreen boldtxt">Rs.1000</span><br/>Transfer</td>   
                                </tr>
    
                                 <tr>
                                    <td><div class="icon-add-green"><i class="fas fa-plus"></i></div></td>
                                    <td><span class="boldtxt">Money Trasfer Root</span><br/><span>12/10/2018 2.40pm</span></td>
                                    <td><span class="txtgreen boldtxt">Rs.1000</span><br/>Transfer</td>  
                                </tr>
    
                                 <tr>
                                    <td><div class="icon-minus-red"><i class="fas fa-minus"></i></div></td>
                                    <td><span class="boldtxt">Money Trasfer Ritesh</span><br/><span>12/10/2018 2.40pm</span></td>
                                    <td><span class="txtgreen boldtxt">Rs.1000</span><br/>Transfer</td>   
                                </tr>
                         
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
    
    
        </div>
        <!--Wallet End-->
         <!--Wishlist-->
        <div role="tabpanel" class="tab-pane" id="wishlist">
            
                 <h2 class="tab-heading">Wishlist</h2>
                 <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 itembox">
                      <div class="list-item">
                          <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 imagebox"><img src="{{ asset('front_assets/images/category-img/birthday-celebration.jpg')}}"></div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                  <div class="row">
                                      <div class="heading-title">Baluchi<br/>
                                        <p>North Indian • Vegetarian friendly</p>
                                      </div>
                                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padlr0">
                                          <div class="pricetxt"><i class="fas fa-rupee-sign"></i>2000<br/>
                                            <div class="txtreview">4 Persons</div>
                                          </div>
                                          
                                          <div class="scoretxt"><span class="greencolorbg"><i class="fa fa-star"></i> 4.7</span><br>500 votes</div>
                                      </div>
                                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  text-right padlr0">
                                        <a href="#" class="btn btn-order">Order Now</a>
                                      </div>
    
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center txt-offers"><img src="{{ asset('front_assets/images/offer.svg')}}" alt="" width="18" />20% off 10 Persons Booking</div>
                                     
                                  </div>
                              </div>
                          </div>
    
                      </div>
                  </div>
    
                        <div class="col-lg-4 col-md-6 col-sm-12 itembox">
                      <div class="list-item">
                          <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 imagebox"><img src="{{ asset('front_assets/images/category-img/birthday-celebration.jpg')}}"></div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                  <div class="row">
                                      <div class="heading-title">Baluchi<br/>
                                        <p>North Indian • Vegetarian friendly</p>
                                      </div>
                                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padlr0">
                                          <div class="pricetxt"><i class="fas fa-rupee-sign"></i>2000<br/>
                                            <div class="txtreview">4 Persons</div>
                                          </div>
                                          
                                          <div class="scoretxt"><span class="greencolorbg"><i class="fa fa-star"></i> 4.7</span><br>500 votes</div>
                                      </div>
                                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  text-right padlr0">
                                        <a href="#" class="btn btn-order">Order Now</a>
                                      </div>
    
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center txt-offers"><img src="{{ asset('front_assets/images/offer.svg')}}" alt="" width="18" />20% off 10 Persons Booking</div>
                                     
                                  </div>
                              </div>
                          </div>
    
                      </div>
                  </div>
    
    
                    <div class="col-lg-4 col-md-6 col-sm-12 itembox">
                      <div class="list-item">
                          <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 imagebox"><img src="{{ asset('front_assets/images/category-img/birthday-celebration.jpg')}}"></div>
                              <div class="col-lg-12 col-md-12 col-sm-12">
                                  <div class="row">
                                      <div class="heading-title">Baluchi<br/>
                                        <p>North Indian • Vegetarian friendly</p>
                                      </div>
                                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padlr0">
                                          <div class="pricetxt"><i class="fas fa-rupee-sign"></i>2000<br/>
                                            <div class="txtreview">4 Persons</div>
                                          </div>
                                          
                                          <div class="scoretxt"><span class="greencolorbg"><i class="fa fa-star"></i> 4.7</span><br>500 votes</div>
                                      </div>
                                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6  text-right padlr0">
                                        <a href="#" class="btn btn-order">Order Now</a>
                                      </div>
    
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center txt-offers"><img src="{{ asset('front_assets/images/offer.svg')}}" alt="" width="18" />20% off 10 Persons Booking</div>
                                     
                                  </div>
                              </div>
                          </div>
    
                      </div>
                  </div>
    
    
                 </div>
    
    
    
        </div>
         <!--Wishlist End-->
          <!--Profile-->
        <div role="tabpanel" class="tab-pane profile-tab-content" id="profile">
               <form>
                  <div class="row">
                   <div class="col-lg-12 col-md-12 col-sm-12"><div class="sub-title"> <i class="fas fa-user"></i> Edit Profile</div> <a href="#" class="btn btn-success float-right" style="font-size:12px;">Update</a></div>
                    <div class="divder-border"></div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>First name</label>
                      <input type="text" class="form-control"  placeholder="Enter First Name">
                    </div>
                   <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>Last name</label>
                      <input type="text" class="form-control"  placeholder="Enter Last Name">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>Email id</label>
                      <input type="text" class="form-control"  placeholder="Enter Email id">
                    </div>
                   <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>Phone Number</label>
                      <input type="text" class="form-control"  placeholder="9022557788">
                    </div>
                     <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>Gender</label>
                      <select class="form-control wid100">
                        <option>Male</option>
                        <option>Female</option>
                         <option>Transgender</option>
                      </select>
                    </div>
    
                    <div class="col-lg-12 col-md-12 col-sm-12"><div class="sub-title"> <i class="fas fa-user"></i> Edit Address</div> <a href="#" class="btn btn-success float-right" style="font-size:12px;">Update</a></div>
                    <div class="divder-border"></div>
    
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>Address Line1</label>
                      <input type="text" class="form-control"  placeholder="">
                    </div>
                   <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>Address Line2</label>
                      <input type="text" class="form-control"  placeholder="">
                    </div>
    
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>State</label>
                      <select class="form-control wid100">
                        <option>Rajasthan</option>
                      </select>
                    </div>
                     <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>City</label>
                      <select class="form-control wid100">
                        <option>Jaipur</option>>
                      </select>
                    </div>
    
                      <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>Pin Code</label>
                      <input type="text" class="form-control"  placeholder="">
                    </div>
    
             
               
                  </div>
                  </form>
    
    
    
        </div>
        <!--Profile End-->
    
         <!--Change Password-->
        <div role="tabpanel" class="tab-pane profile-tab-content" id="changepassword">
               <form>
                  <div class="row">
               
                     <div class="col-lg-12 col-md-12 col-sm-12"><div class="sub-title"> <i class="fas fa-user"></i> Edit Password</div> <a href="#" class="btn btn-success float-right" style="font-size:12px;">Update</a></div>
                    <div class="divder-border"></div>
    
                      <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>New Password</label>
                      <input type="password" class="form-control"  placeholder="">
                    </div>
    
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                      <label>Confirm new password</label>
                      <input type="password" class="form-control"  placeholder="">
                    </div>
    
                     <div class="col-lg-12 col-md-12 col-sm-12 text-center"><button type="button" class="btn btn-pink" style="margin-top:20px;">Save Profile</button></div>
               
                  </div>
                  </form>
    
    
    
        </div>
        <!--Change Password End-->
        
        <!--Vouchers-->
         <div role="tabpanel" class="tab-pane" id="vouchers">
           
            <div class="row">
    
                  <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class=" gradient-perple vouchers-col">
                    <div class=" vouch-coupon ">
                        <div class="percenttxt">15%OFF</div>
                        <p>First Booking through 26 jan2019</p>
                      </div>
                      <div class=" coupon-code">
                        Use By:<br/>
                        <span>26 January 2019</span>
                        <p>Lorem Ipsum is simply dummy text of the </p>
                        <a href="#" class="btn btn-danger" style="font-size:13px;">REEDEM</a>
                      </div>
                     </div>
                  </div>
    
                   <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class=" gradient-green vouchers-col">
                    <div class=" vouch-coupon ">
                        <div class="percenttxt">15%OFF</div>
                        <p>First Booking through 26 jan2019</p>
                      </div>
                      <div class=" coupon-code">
                        Use By:<br/>
                        <span>26 January 2019</span>
                        <p>Lorem Ipsum is simply dummy text of the </p>
                        <a href="#" class="btn btn-danger" style="font-size:13px;">REEDEM</a>
                      </div>
                     </div>
                  </div>
    
                  <div class="col-lg-6 col-md-6 col-sm-12 martop30">
                  <div class=" gradient-yellow vouchers-col">
                    <div class=" vouch-coupon ">
                        <div class="percenttxt">15%OFF</div>
                        <p>First Booking through 26 jan2019</p>
                      </div>
                      <div class=" coupon-code">
                        Use By:<br/>
                        <span>26 January 2019</span>
                        <p>Lorem Ipsum is simply dummy text of the </p>
                        <a href="#" class="btn btn-danger" style="font-size:13px;">REEDEM</a>
                      </div>
                     </div>
                  </div>
    
                  <div class="col-lg-6 col-md-6 col-sm-12 martop30">
                  <div class=" gradient-pink vouchers-col">
                    <div class=" vouch-coupon ">
                        <div class="percenttxt">15%OFF</div>
                        <p>First Booking through 26 jan2019</p>
                      </div>
                      <div class=" coupon-code">
                        Use By:<br/>
                        <span>26 January 2019</span>
                        <p>Lorem Ipsum is simply dummy text of the </p>
                        <a href="#" class="btn btn-danger" style="font-size:13px;">REEDEM</a>
                      </div>
                     </div>
                  </div>
    
                   <div class="col-lg-6 col-md-6 col-sm-12 martop30">
                  <div class=" gradient-blue vouchers-col">
                    <div class=" vouch-coupon ">
                        <div class="percenttxt">15%OFF</div>
                        <p>First Booking through 26 jan2019</p>
                      </div>
                      <div class=" coupon-code">
                        Use By:<br/>
                        <span>26 January 2019</span>
                        <p>Lorem Ipsum is simply dummy text of the </p>
                        <a href="#" class="btn btn-danger" style="font-size:13px;">REEDEM</a>
                      </div>
                     </div>
                  </div>
                </div>
    
         </div>
          <!--Vouchers End-->
    
         <!--Referral-->
         <div role="tabpanel" class="tab-pane" id="referral">
                <div class="col-lg-12 col-md-12 col-sm-12 referral-tab-content text-center">
                     <h3>Vasvi the joy of giving! </h3>
                    <p>Your friends get awesome vouchers when they register your referral code and when they complete a booking you get Rs 200 as wallet cash</p>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                   
                    <div class="referral-code"><span>Your Referral Code:</span> IC1M7CH3</div>
                    <ul class="social-media">
                       <a href="#" class="iconfacebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><img src="{{ asset('front_assets/images/gmail.svg')}}" width="30" alt="" /></a>
                        <a href="#" class="icon-whatsapp"><img src="{{ asset('front_assets/images/whatsapp.svg')}}" width="30" alt="" /> </a>
                        <a href="#" class="icontwitter"><i class="fab fa-twitter"></i></a>
                    </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                      <img src="{{ asset('front_assets/images/referral-img.svg')}}" width="350" alt="" />
                    </div>
                  </div>
                 </div>
    
    
         </div>
          <!--Referral End-->
            <!--Rating & Review-->
         <div role="tabpanel" class="tab-pane" id="rating">
                
         <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <ul class="write-review">
                  <li class="star-rating"><span style="margin-right:10px; ">Please rate your experience</span> <fieldset class="rating">
        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
        <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
    </fieldset></li>
                  <li><span style="font-weight:600;">Add Review</span>
                      <br>
                      <textarea class="form-control" row="20" col="20" style="margin-top:10px;"></textarea>
                  </li>
                  <li>
                      <button class="btn btn-success">SUBMIT</button>
                  </li>
              </ul>
            </div>
    
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 text-center"><h3 style="padding-bottom:40px;">Your Past Rate & Reviews</h3></div>
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                  <div class="review-col">
                      <div class="row">
                        <div class="client-img col-md-2 col-sm-2"><img src="{{ asset('front_assets/images/user-icon1.png')}}" alt=""></div>
                        <div class="col-md-9 col-sm-12 text-left ">
                            <h4>Rakesh Sharma</h4>
                            <div class="rating-star float-left"><i class="fas fa-star stargreen"></i> <i class="fas fa-star stargreen"></i> <i class="fas fa-star stargreen"></i> <i class="fas fa-star stargrey"></i> <i class="fas fa-star"></i></div>
                            <div class="float-right"><strong>1 Jan 2019</strong></div>
                            <div class="clearfix"></div>
                            <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                           </div>
                       </div>
                  </div>
                </div>
    
    
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                  <div class="review-col">
                      <div class="row">
                        <div class="client-img  col-md-2 col-sm-2"><img src="{{ asset('front_assets/images/user-icon2.png')}}" alt=""></div>
                        <div class=" col-md-9 col-sm-12 text-left ">
                            <h4>Rakesh Sharma</h4>
                            <div class="rating-star float-left"><i class="fas fa-star stargreen"></i> <i class="fas fa-star stargreen"></i> <i class="fas fa-star stargreen"></i> <i class="fas fa-star stargrey"></i> <i class="fas fa-star"></i></div>
                            <div class="float-right"><strong>1 Jan 2019</strong></div>
                            <div class="clearfix"></div>
                            <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                           </div>
                       </div>
                  </div>
                </div>
          </div>
    
    
         </div>
          <!--Rating & Review-->
           <!--Newsletter Subscription-->
         <div role="tabpanel" class="tab-pane" id="newsletter">
           <h2 class="tab-heading">Newsletter Subcription</h2>
           <div class="col-md-8">
           <h5>Which of these services would you like to receive from us?</h5>
           <ul class="newsletter-form">
             <li> 
              <label class="control control--checkbox"> &nbsp;&nbsp;New Offer
              <input type="checkbox" checked="checked"/>
              <div class="control__indicator"></div>
            </label>
          </li>
    
           <li> 
              <label class="control control--checkbox">&nbsp;&nbsp;New Arrivals
              <input type="checkbox" />
              <div class="control__indicator"></div>
            </label>
          </li>
    
           <li> 
              <label class="control control--checkbox">&nbsp;&nbsp;Women
              <input type="checkbox" />
              <div class="control__indicator"></div>
            </label>
          </li>
    
           <li> 
              <label class="control control--checkbox">&nbsp;&nbsp;Fashion news
              <input type="checkbox" />
              <div class="control__indicator"></div>
            </label>
          </li>
           <li> 
              <label class="control control--checkbox">&nbsp;&nbsp;Exclusives
              <input type="checkbox" />
              <div class="control__indicator"></div>
            </label>
          </li>
    
           </ul><br/><br/>
    
         </div>
         <div class="col-md-12">
            <h5>Which of these services would you like to receive from us?</h5>
    
            <ul class="newsletter-week-list">
             <li> 
              <label class="control control--radio"> &nbsp;&nbsp;Daily
              <input type="radio" />
              <div class="control__indicator"></div>
            </label>
          </li>
    
           <li> 
              <label class="control control--radio">&nbsp;&nbsp;Weekly
              <input type="radio" />
              <div class="control__indicator"></div>
            </label>
          </li>
    
           <li> 
              <label class="control control--radio">&nbsp;&nbsp;Every 2 Week
              <input type="radio" />
              <div class="control__indicator"></div>
            </label>
          </li>
    
           <li> 
              <label class="control control--radio">&nbsp;&nbsp;Monthly
              <input type="radio" />
              <div class="control__indicator"></div>
            </label>
          </li>
          
    
           </ul>
         </div>
    
          <div class="col-md-8 text-center"><button type="button" class="btn btn-pink">Update</button> </div>
    
         </div>
          <!--Newsletter Subscription-->
    
          <!--Feedback Subscription-->
         <div role="tabpanel" class="tab-pane" id="feedback">
           <h2 class="tab-heading">Feedback</h2>
           <div class="col-md-12 text-center feedbackcaption">
            <span>We'd love to hear your thoughts</span><br/><p>Please take a moment to let us know your feedback and suggestions</p>
           </div>
           <div class="col-md-10">
          <form>
           <div class="col-md-12"> 
           <label>What is the purpose of you visit</label>
           <select class="form-control">
             <option value="">option</option>
           </select>
         </div>
         
    
           <table cellpadding="0" cellspacing="0" class="feedbacktable">
             
             <thead>
               <tr>
                 <th>&nbsp;</th>
                 <th>Excellent</th>
                 <th>Good</th>
                 <th>Fair</th>
                 <th>Weak</th>
                 <th>Poor</th>
               </tr>
             </thead>
             <tbody>
               <tr>
                <td>Ease of finding information</td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
               </tr>
               <tr>
                <td>Product availablity</td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
               </tr>
    
               <tr>
                <td>Variety of products</td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
               </tr>
                <tr>
                <td>Others</td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
                 <td><input type="radio" /></td>
               </tr>
    
             </tbody>
           </table>
    
            <div class="col-md-12"> 
           <label>What is the purpose of you visit</label>
           <textarea name="" class="form-control">Any Message</textarea>
         </div>
    
    
         </form>
    
         </div>
    
          <div class="col-md-8 text-center" style="margin-top: 15px;"><button type="button" class="btn btn-pink">Submit</button> </div>
         
          
    
         </div>
          <!--Feedback Subscription-->
    
    
      </div>
     </div>
    
     <!--Tab Right Section end here-->
    
    </div>
    
    </div>
    </div>
    <!--My Account Page end here-->
    

  @endsection