@extends('layouts.front')

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
         <input type="text" class="form-control coupon-form-control" placeholder="enter coupon code here" /><button type="button" class="btn btn-pink f_size13" style="margin-top:-4px;">Apply</button>
        </div>
        </div>
        <div class="clear"></div>
        <div class="modal-footer" style="border-top:none; text-align:center !important; ">
         
          
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
<br><br>
<div class="container">
    <div class="col-md-12 col-sm-12 cart-page-heading"><h2>MY BAG <span>(1 item)</span></h2></div>
      <!--Cart Left section start here-->
       <div class="col-md-8 col-sm-12 cartpage-lft">
  
      <div class="col-md-12 col-sm-12 itembox padlr0">
        <div class="list-item">
            <div class="row">
                <div class="col-md-2 col-sm-12 thumbimg"><img src="{{ asset('front_assets/images/ARP3459.jpg')}}" class="img-responsive" alt=""></div>
                <div class="col-md-10 col-sm-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
                          <div class="heading-title">Kurty Dry Woven <br>
                          <p>Team Training</p></div>
                          <ul class="cart-product-detail">
                            <li><span>Size</span>
                            <select class="form-control select-wid100">
                              <option>S</option>
                              <option>M</option>
                               <option>L</option>
                          </select>
                        </li>
                            <li><span>Color</span> Pink</li>
                            <li> <span class="qty-txt">Qty</span> <button type="button" class="btn-circle"><i class="fas fa-plus"></i>
  </button><input type="text" value="4" class="form-control qty-input"><button type="button" class="btn-circle"><i class="fas fa-minus"></i></button></li>
                            <li><a href="#" class="btn btn-pink">View Detail</a> <button type="button" class="btn-remove"><i class="fas fa-trash-alt"></i>
   Remove</button> <button type="button" class="btn-wishlist"><i class="fas fa-heart"></i> Save to wishlist</button></li>
                          </ul>
                          
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right   padtop15">
                            <div class="pricetxt">Unit Price: <i class="fas fa-rupee-sign"></i>15200<br>
                              <div class="txtreview"><i class="far fa-calendar-alt"></i> 25 Dec 2018</div>
                            </div> 
                            
                        </div>
                       
                    </div>
                </div>
            </div>
           <div class="col-lg-12 item-bot-strip"><div class="addmessage-txt"><button type="button" data-toggle="modal" data-target="#address_message_Modal"><i class="fas fa-gift"></i> Gift Wrap</button> <button type="button" data-toggle="modal" data-target="#address_message_Modal">Add Message</button></div></div> 
        </div>
      </div>
  
  
        </div>  
        <!--Cart Left section end here-->
  
          <!--Cart Right Start here-->
          <div class="col-md-4 col-sm-12">
            <div class="cart-rgt-panel">
            <div class="coupon-text"><button type="button" class="btn" data-toggle="modal" data-target="#couponcodeModal"><i class="fas fa-tags"></i> Apply Coupon Code</button></div>
            <div class="cart-order-summary">
              <h4>Order Summary</h4>
              <ul>
                <li>Bag Total <span><i class="fas fa-rupee-sign"></i> 2000</span></li>
                <li>Discount <span><i class="fas fa-rupee-sign"></i> 50</span></li>
                <li>Subtotal <span><i class="fas fa-rupee-sign"></i> 2000</span></li>
                 <li>Coupon Discount <span class="txtorange boldtxt">Apply Coupon</span></li>
                  <li>Delivery Charges  <span class="txtorange">Free</span></li>
                   <li><strong class="boldtxt">Final Order Amount</strong>  <span class="boldtxt"><i class="fas fa-rupee-sign"></i> 2000</span></li>
                   <li><button class="btn pinkBtn btn-checkout">Place Order</button> <button class="btn btn-secondary btn-checkout">Continue Shopping</button></li>
                   <li><div style="display:inline-block; width:auto; margin-right:10px;">We Accept</div><div style="display:inline-block; width:auto;"><img src="{{ asset('front_assets/images/payment_method.png')}}" alt="" width="230"  /></div></li>
              </ul>
            </div>
          </div>
          </div> 
          <!--Cart Right end here-->
  
  </div>
  
  <!--Vasvi Exclusive Slider Start here-->
     <section class="colorfulbg">
      <div class="col-md-12 text-center heading-title">
                          <h2 class="title-txt">Recently Viewed</h2>
                          <img src="{{ asset('front_assets/images/headline.png')}}">
                </div>
          <div class="exclusive-bg"></div>
      
      <div style="padding-top:60px;">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="home-product vasvi_exclusive_slider">
                         
                          <div class="owl-carousel owl-theme home-product-slider">
                              <div class="item">
                                      <div class="product-card">
                                      <div>
                                          <div id="f1_container">
                                                  <div id="f1_card" class="shadow">
                                                      <div class="front face">
                                                          <img src="{{ asset('front_assets/images/ARP3459.jpg')}}" class="img-responsive" alt="">
                                                      </div>
                                                      <div class="back face center">
                                                          <img src="{{ asset('front_assets/images/ARP3454.jpg')}}" class="img-responsive" alt="">
  
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p>
                                      <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p> 
                                      </div>
                                       <div class="caption-hover">
                                            <span class="circle-size"  > 
                                              <p>Select Size <span  class="btn-close float-right">X</span></p>
                                              <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                            <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                            <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p></div>
                                            <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                      </div>
                                      <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                      
                                    </div>
                              </div>
  
                              <div class="item">
                                      <div class="product-card">
                                      <div>
                                          <div id="f1_container">
                                                  <div id="f1_card" class="shadow">
                                                      <div class="front face">
                                                          <img src="{{ asset('front_assets/images/ARP3512.jpg')}}" class="img-responsive" alt="">
                                                      </div>
                                                      <div class="back face center">
                                                          <img src="{{ asset('front_assets/images/ARP3511.jpg')}}" class="img-responsive" alt="">
  
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p>
                                      <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p> 
                                      </div>
                                       <div class="caption-hover">
                                            <span class="circle-size"  > 
                                              <p>Select Size <span  class="btn-close float-right">X</span></p>
                                              <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                            <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                            <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p></div>
                                            <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                      </div>
                                      <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                      
                                    </div>
                              </div>
  
                              <div class="item">
                                      <div class="product-card">
                                      <div>
                                          <div id="f1_container">
                                                  <div id="f1_card" class="shadow">
                                                      <div class="front face">
                                                          <img src="{{ asset('front_assets/images/ARP3552.jpg')}}" class="img-responsive" alt="">
                                                      </div>
                                                      <div class="back face center">
                                                          <img src="{{ asset('front_assets/images/ARP3551.jpg')}}" class="img-responsive" alt="">
  
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p>
                                      <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p> 
                                      </div>
                                       <div class="caption-hover">
                                            <span class="circle-size"  > 
                                              <p>Select Size <span  class="btn-close float-right">X</span></p>
                                              <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                            <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                            <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p></div>
                                            <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                      </div>
                                      <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                      
                                    </div>
                              </div>
  
  
                              <div class="item">
                                      <div class="product-card">
                                      <div>
                                          <div id="f1_container">
                                                  <div id="f1_card" class="shadow">
                                                      <div class="front face">
                                                          <img src="{{ asset('front_assets/images/ARP3566.jpg')}}" class="img-responsive" alt="">
                                                      </div>
                                                      <div class="back face center">
                                                          <img src="{{ asset('front_assets/images/ARP3563.jpg')}}" class="img-responsive" alt="">
  
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p>
                                      <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p> 
                                      </div>
                                       <div class="caption-hover">
                                            <span class="circle-size"  > 
                                              <p>Select Size <span  class="btn-close float-right">X</span></p>
                                              <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                            <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                            <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p></div>
                                            <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                      </div>
                                      <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                      
                                    </div>
                              </div>
  
                              <div class="item">
                                      <div class="product-card">
                                      <div>
                                          <div id="f1_container">
                                                  <div id="f1_card" class="shadow">
                                                      <div class="front face">
                                                          <img src="{{ asset('front_assets/images/ARP3605.jpg')}}" class="img-responsive" alt="">
                                                      </div>
                                                      <div class="back face center">
                                                          <img src="{{ asset('front_assets/images/ARP3604.jpg')}}" class="img-responsive" alt="">
  
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p>
                                      <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p> 
                                      </div>
                                       <div class="caption-hover">
                                            <span class="circle-size"  > 
                                              <p>Select Size <span  class="btn-close float-right">X</span></p>
                                              <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                            <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                            <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p></div>
                                            <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                      </div>
                                      <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                      
                                    </div>
                              </div>
  
                              <div class="item">
                                      <div class="product-card">
                                      <div>
                                          <div id="f1_container">
                                                  <div id="f1_card" class="shadow">
                                                      <div class="front face">
                                                          <img src="{{ asset('front_assets/images/ARP3625.jpg')}}" class="img-responsive" alt="">
                                                      </div>
                                                      <div class="back face center">
                                                          <img src="{{ asset('front_assets/images/ARP3624.jpg')}}" class="img-responsive" alt="">
  
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p>
                                      <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p> 
                                      </div>
                                       <div class="caption-hover">
                                            <span class="circle-size"  > 
                                              <p>Select Size <span  class="btn-close float-right">X</span></p>
                                              <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                            <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                            <div class="text-caption"><p><strong>Kurty</strong> Dry Woven Team Training</p></div>
                                            <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                      </div>
                                      <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                      
                                    </div>
                              </div>
  
                          </div>
  
                      </div>
                  </div>
  
              </div>
  
          </div>
  
      </div>
  
     </section>
   <!--Vasvi Exclusive Slider end here-->
@endsection