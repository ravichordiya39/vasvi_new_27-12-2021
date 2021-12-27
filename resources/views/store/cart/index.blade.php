@extends('store.layouts.app')
@section('title', 'Vasvi ' .request()->segment(1))
@section('meta_keywords', 'Vasvi.in, Ecommerce, Shopping, Mens, Woman, Kids, Cloth')
@section('meta_description', 'Ecommerce website to buy a product in quantity or bulk with lots of discount')

@push('styles')
<style>
    /* .wrapper{
  display: inline-flex;
  background: #fff;
  height: 100px;
  width: auto;
  align-items: center;
  justify-content: space-evenly;
  border-radius: 5px;
  padding: 20px 15px;

}
.wrapper .option{
  background: #fff;
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  margin: 0 10px;
  border-radius: 5px;
  cursor: pointer;
  padding: 0 10px;
  border: 2px solid lightgrey;
  transition: all 0.3s ease;
}
.wrapper .option .dot{
  height: 20px;
  width: 20px;
  background: #d9d9d9;
  border-radius: 50%;
  position: relative;
}
.wrapper .option .dot::before{
  position: absolute;
  content: "";
  top: 4px;
  left: 4px;
  width: 12px;
  height: 12px;
  background: #0069d9;
  border-radius: 50%;
  opacity: 0;
  transform: scale(1.5);
  transition: all 0.3s ease;
}
input[type="radio"]{
  display: none;
}
#option-1:checked:checked ~ .option-1,
#option-2:checked:checked ~ .option-2{
  border-color: #0069d9;
  background: #0069d9;
}
#option-1:checked:checked ~ .option-1 .dot,
#option-2:checked:checked ~ .option-2 .dot{
  background: #fff;
}
#option-1:checked:checked ~ .option-1 .dot::before,
#option-2:checked:checked ~ .option-2 .dot::before{
  opacity: 1;
  transform: scale(1);
}
.wrapper .option span{
  font-size: 20px;
  color: #808080;
}
#option-1:checked:checked ~ .option-1 span,
#option-2:checked:checked ~ .option-2 span{
  color: #fff;
} */
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
<!-- Add Message Modal start  -->
<div class="modal fade" id="gift_message_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:none;">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
         <h4 class="modal-title text-center my-4" id="exampleModalLabel">Add Gift Wrap Info </h4>

        </div>
        <div class="modal-body coupon-code-model">
          <div class="col-lg-12 col-md-12 mx-auto address-form form-message ">
            <ul>
               <li>
                    <div class="row">
                        <div class="col-md-4">
                            <div >
                                <label>Gift Wrap</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <input type="radio" name="select" id="option-1" value="basic" checked>&nbsp;30
                        </div>
                        <div class="col-md-4">
                            <input type="radio" name="select" id="option-2" value="premium">&nbsp;50
                        </div>
                    </div>
               </li>
               <li>
                   <label>Recipient Name</label>
                   <input type="text" placeholder="Dear" class="form-control" id="gift-recipient" >
                   <p class="text-danger" id="gift-recipient-error"></p>
                </li>
               <li>
                   <label>Message(Wishes)</label>
                   <textarea class="form-control" rows="3" cols="10" id="gift-message" style="resize: none;"></textarea>
                   <p class="text-danger" id="gift-message-error"></p>
                </li>
               <li>
                   <label>Sender Name</label>
                   <input type="text" placeholder="Dear" class="form-control" id="gift-sender">
                   <p class="text-danger" id="gift-sender-error"></p>
                </li>

            </ul>
        </div>
        </div>
        <div class="modal-footer" style="border-top:none;">
          <button type="button" class="btn btn-secondary f_size13" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success f_size13" id="gift-submit">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add Message end  -->
<!-- Add Message Modal start  -->
<div class="modal fade" id="address_message_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:none;">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
         <h4 class="modal-title text-center my-3" id="exampleModalLabel">Add a Peronalized message </h4>

        </div>
        <div class="modal-body coupon-code-model">
         <div class="col-lg-12 col-md-12 mx-auto address-form form-message ">
         <ul>

         <li>
             <label>Recipient Name</label>
             <input type="text" placeholder="Dear" class="form-control" id="msg-recipient">
             <p class="text-danger" id="msg-recipient-error"></p>
        </li>
        <li>
            <label>Message</label>
            <textarea class="form-control" rows="3" cols="10" style="resize: none;" id="msg-message"></textarea>
            <p class="text-danger" id="msg-message-error"></p>
        </li>
        <li>
            <label>Sender Name</label>
            <input type="text" placeholder="Dear" class="form-control" id="msg-sender">
            <p class="text-danger" id="msg-sender-error"></p>
        </li>

    </ul>
        </div>
        </div>
        <div class="modal-footer" style="border-top:none;">
          <button type="button" class="btn btn-secondary f_size13" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success f_size13" id="msg-submit">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add Message end  -->
<div class="headertopspace"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
  <div class="cart-page-heading"><h2>MY BAG <span>( <span class="cart-count">{{count($carts)}}</span> item)</span></h2></div>
        <!--Cart Left section start here-->
        <div class="row">
     <div class="col-md-8 col-sm-8 cartpage-lft">
        <?php $total = 0; $discount = 0;?>
    <div class="col-md-12 col-sm-12 padlr0 itembox">
      @if(\Session::has('cart'))
        @foreach(session()->get('cart') as $cart)
            <?php
                $total += $total + ($cart['qty'] * $cart['single_price']);
                $discount +=  $discount + ($cart['single_price'] -$cart['single_sales_price']);
                ?>
        <div class="list-item">
                <div class="col-md-3 col-sm-3 thumbimg"><img src="{{asset('file')}}/{{$cart['product_images'][0]}}" class="img-responsive" alt="">
            </div>
                <div class="col-md-9 col-sm-9">
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="heading-title" href="#"><?php $product = \App\Models\Product::where('id', $cart['product_id'])->first(); ?>
                                {{$product->category->name}}    {{$cart['name']}}</a>
                            <button type="button" class="btn-remove" id="cart-remove" data-id="{{$cart['id']}}"><i class="fas fa-trash-alt"></i></button>
                            <ul class="cart-product-detail">
                            <li><span>Size</span>
                            <select class="form-control select-wid100" id="cart-size" data-id="{{$cart['id']}}" data-product="pro-{{$cart['product_id']}}" data-color="{{$cart['color_id']}}">
                                <?php
                                            $dsizes = [];
                                            $sizes = \App\Models\Size::all();
                                        ?>
                                        @foreach($product->productProductVariations as $variation)
                                        <?php
                                            array_push($dsizes, $variation->size_id);
                                        ?>
                                        @endforeach
                                        <?php $fsizes = array_unique($dsizes); ?>
                                        @foreach($sizes as $size)
                                        @foreach($fsizes as $fsize)
                                        @if($size->id === $fsize)
                                            <option value="{{$size->id}}"
                                                @if($size->id == $cart['size_id'])
                                                selected
                                                @endif>{{$size->name}}
                                            </option>
                                    @endif
                                    @endforeach
                                    @endforeach
                            </select>
                        </li>

                            <li> <span class="qty-txt">Qty</span>
                                <button type="button" class="btn-circle" id="cart-substract" data-id="{{$cart['id']}}" data-product="pro-{{$cart['product_id']}}" data-color="{{$cart['color_id']}}"><i class="fas fa-minus"></i>
                                </button>
                                <input type="text"  class="form-control qty-input" value="{{$cart['qty']}}" id="cart-qty">
                                <button type="button" class="btn-circle" id="cart-add" data-id="{{$cart['id']}}" data-product="pro-{{$cart['product_id']}}" data-color="{{$cart['color_id']}}"><i class="fas fa-plus"></i></button>
                            </li>
                                <br>
                                <li>
                                    <span>Price</span>
                                    <div class="pricetxt"><i class="fas fa-rupee-sign"></i><span class="cart-price" id="price-{{$cart['product_id']}}" data-product="pro-{{$cart['product_id']}}">{{$cart['single_price'] * $cart['qty']}}</span></div>
                                </li>
                                <br>
                                <?php $pro = \App\Models\Product::where('id',$cart['product_id'])->first(); ?>
                            <li><a href="{{url('product')}}/{{$pro->slug}}" class="btn btn-pink">View Detail</a>
                                <button type="button" class="btn-wishlist" id="cart-wishlist" data-id="{{$pro->id}}" data-size="{{$cart['size_id']}}" data-color="{{$cart['color_id']}}" data-mrp="{{$cart['single_price']}}" data-sale="{{$cart['single_sales_price']}}" data-image="{{$cart['product_images'][0]}}" data-name="{{$cart['name']}}"><i class="fas fa-heart"></i> Save to wishlist</button>
                            </li>

                            </ul>
                            <h5 class="mb-4">Available Coupons</h5>
                            <ul>
                                <li>
                                   @if($coupons->count() > 0)
                                     @foreach($coupons as $coupon)
                                     <span style="padding : 5px; border : 2px dotted red;color : red;border-radius : 3px;font-size : 14px;Important;margin-top : 5px;margin-bottom : 5px;; margin-right : 5px;">{{$coupon->code}}</span>
                                     @endforeach
                                   @endif
                               </li>
                            </ul>

                        </div>

                    </div>
                </div>
            <div class="col-lg-12 item-bot-strip">
                <div class="addmessage-txt" style="float: right;">
                    <button type="button" class="gift-btn"  data-id="{{$cart['id']}}"><i class="fas fa-gift"></i> Gift Wrap</button>
                    {{-- <button type="button" class="msg-btn" data-id="{{$cart['id']}}"><i class="fas fa-envelope"></i> Add Message</button> --}}
                  </div>
            </div>
        </div>
        @endforeach
      @endif
    </div>

    {{-- <div class="text-center mt-5 pt-5">
        <img src="{{asset('store/images/empty-cart.png')}}" style="height : 150px;">
    </div> --}}

      </div>
      <!--Cart Left section end here-->
        <!--Cart Right Start here-->
        <div class="col-md-4 col-sm-4">
          <div class="cart-rgt-panel">
          <div class="coupon-text"><button type="button" class="btn" data-toggle="modal" data-target="#couponcodeModal"><i class="fas fa-tags"></i> Apply Coupon Code</button></div>
          <div class="cart-order-summary">
            <h4>Order Summary</h4>
            <ul>
              <li>Bag Total <span><i class="fas fa-rupee-sign"></i><span class="bag-total"> {{$total}}</span></span></li>
              <li>Discount <span><i class="fas fa-rupee-sign"></i><span class="bag-discount"> {{$discount}}</span></span></li>
              <li>Subtotal <span><i class="fas fa-rupee-sign"></i> <span class="sub-total">{{$total - $discount}}</span></span></li>
              <li>Gift Wrap <span> <span class="gift_price">NA</span></span></li>
               <li>Coupon Discount <span class="txtorange boldtxt" id="coupon-discount">NA</span></li>
                <li>Delivery Charges  <span class="txtorange">Free</span></li>
                 <li><strong class="boldtxt">Final Order Amount</strong>  <span class="boldtxt"><i class="fas fa-rupee-sign"></i> <span id="final-amount">
                    {{$total - $discount}}
                    </span></span></li>
                 <li>
                      <form method="get" action={{route('checkout')}}>
                        @csrf
                        <input type="hidden" name="coupon_val" id="coupon-val" value="" />
                        <input type="hidden" name="coupon" id="coupon-name" value="" />
                        <button class="btn pinkBtn btn-checkout" type="submit">Place Order</button>
                        <a href="{{url('/')}}" class="btn btn-secondary btn-checkout" >Continue Shopping</a>
                      </form>
                      </li>
                 <li><div style="display:inline-block; width:auto; margin-right:10px;">We Accept</div><div style="display:inline-block; width:auto;"><img src="{{asset('store/images/payment_method.png')}}" alt="" width="230"  /></div></li>
            </ul>
          </div>
        </div>
        </div>
        <!--Cart Right end here-->
    </div>
    </div>
</div>



</div>

{{-- <!--Vasvi Exclusive Slider Start here-->
   <section class="colorfulbg">
         <div style="padding-top:60px;">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="home-product best_seller">
                        <div class="owl-carousel owl-theme  home-product-slider">
                           <div class="item">
                              <div class="product-card">
                                 <div>
                                    <div id="f1_container">
                                       <div id="f1_card" class="shadow">
                                          <div class="front face">
                                             <img src="images/ARP3514.jpg" class="img-responsive" alt="">
                                          </div>
                                          <div class="back face center">
                                             <img src="images/ARP3514.jpg" class="img-responsive" alt="">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="text-caption">
                                    <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                    <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p>
                                    <p class="pro-rating">
                                       <i class="fa fa-star" aria-hidden="true"></i>
                                       <i class="fa fa-star" aria-hidden="true"></i>
                                       <i class="fa fa-star" aria-hidden="true"></i>
                                       <i class="fa fa-star" aria-hidden="true"></i>
                                       <i class="fa fa-star" aria-hidden="true"></i>
                                       (1)
                                    </p>
                                 </div>
                                 <div class="caption-hover">
                                    <a href="" data-toggle="modal" data-target="#quickviews">QUICK VIEW</a>
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
 <!--Vasvi Exclusive Slider end here--> --}}
@endsection

@push('scripts')
<script>
     var total = 0 ;
     var discount = 0;
     var sub_total = 0;
     var final_amount = $(document).find('#final-amount').html();
     var coupon_value = 0;
     var disc = 0;
     var edit_cart = 0;
     var gift = false;
     var gtype = null;
     var gift_value = 0;
    //  $(function(){
    //     $(document).find('#gift_message_Modal').modal('show');
    //  });


    $(document).on('click','.gift-btn', function(e){
        e.preventDefault();
        var cart_id = $(this).attr('data-id');
        edit_cart = cart_id;

        $.ajax({
            type: "GET",
            url:  "{{url('cart')}}"+`/${cart_id}`,
            data: {},
            success: function (response) {
               $(document).find('#gift-message').val('');
               $(document).find('#gift-recipient').val('');
               $(document).find('#gift-sender').val('');
               if(response.code !== 200){
                   $(document).find('#gift_message_Modal').modal('show');
               }
               else{
                $(document).find('#gift-message').val(response.data['message']);
                $(document).find('#gift-recipient').val(response.data['recipient']);
                $(document).find('#gift-sender').val(response.data['sender']);
                var gift_type = response.data['type'];
                if(gift_type === 'basic'){
                    $(document).find('#option-1').attr('checked', true);
                    $(document).find('#option-2').removeAttr('checked');
                }
                else{
                    $(document).find('#option-1').removeAttr('checked');
                    $(document).find('#option-2').attr('checked', true);
                }
                $(document).find('#gift_message_Modal').modal('show');
               }
            },
            error : function(err){
                console.log(err);
                toastr.error('Error', 'Internal server error',{
                            positionClass: 'toast-top-center',
                });
            }
        });
        // address_message_Modal
    });

    $(document).on('click','#gift-submit', function(){
        $(document).find('#gift-sender-error').html('');
        $(document).find('#gift-message-error').html('');
        $(document).find('#gift-recipient-error').html('');

        var gift_type = '';

        $(document).find('[name="select"]').each(function(){
           if($(this).is(':checked')){
             gift_type = $(this).val();
           }
        });

        var message = $(document).find('#gift-message').val();
        var recipient = $(document).find('#gift-recipient').val();
        var sender = $(document).find('#gift-sender').val();

        var error = false;

        if(message === '' || message.length <  10 ){
            $(document).find('#gift-message-error').html('* Required & should at least 10 character long.');
            error = true;
        }

        if(recipient === '' || recipient.length <  5 ){
            $(document).find('#gift-recipient-error').html('* Required & should at least 5 character long.');
            error = true;
        }

        if(sender === '' || sender.length <  5 ){
            $(document).find('#gift-sender-error').html('* Required & should at least 5 character long.');
            error = true;
        }

        if(!error){

            $.ajax({
                type: "POST",
                url: "{{route('gift.store')}}",
                data: {
                    cart_id : edit_cart,
                    message : message,
                    recipient : recipient,
                    sender : sender,
                    gift_type : gift_type
                },
                success: function (response) {
                  if(response.code === 200){
                      gift = true;
                      gtype = gift_type === 'basic' ? 30 :  50;
                      update_cart_price();
                      toastr.success('Success', response.message,{
                            positionClass: 'toast-top-center',
                      });
                  }
                  else{
                    toastr.warning('Warning', response.message,{
                            positionClass: 'toast-top-center',
                    });
                  }
                  $(document).find('#gift_message_Modal').modal('hide');
                },
                error : function(err){
                  console.log(err);
                  toastr.error('Error', 'Internal server error',{
                            positionClass: 'toast-top-center',
                    });
                }
            });
        }


    });


    $(document).on('click','.msg-btn', function(e){
        e.preventDefault();
        var cart_id = $(this).attr('data-id');
        edit_cart = cart_id;

        $.ajax({
            type: "GET",
            url:  "{{url('cart/message')}}"+`/${cart_id}`,
            data: {},
            success: function (response) {
               $(document).find('#msg-message').val('');
               $(document).find('#msg-recipient').val('');
               $(document).find('#msg-sender').val('');
               if(response.code !== 200){
                  $('#address_message_Modal').modal('show');
               }
               else{
                $(document).find('#msg-message').val(response.data['message']);
                $(document).find('#msg-recipient').val(response.data['recipient']);
                $(document).find('#msg-sender').val(response.data['sender']);

                $('#address_message_Modal').modal('show');
               }
            },
            error : function(err){
                console.log(err);
                toastr.error('Error', 'Internal server error',{
                            positionClass: 'toast-top-center',
                });
            }
        });
        // address_message_Modal
    });

    $(document).on('click','#msg-submit', function(){
        $(document).find('#msg-sender-error').html('');
        $(document).find('#msg-message-error').html('');
        $(document).find('#msg-recipient-error').html('');

        var message = $(document).find('#msg-message').val();
        var recipient = $(document).find('#msg-recipient').val();
        var sender = $(document).find('#msg-sender').val();

        var error = false;

        if(message === '' || message.length <  10 ){
            $(document).find('#msg-message-error').html('* Required & should at least 10 character long.');
            error = true;
        }

        if(recipient === '' || recipient.length <  5 ){
            $(document).find('#msg-recipient-error').html('* Required & should at least 5 character long.');
            error = true;
        }

        if(sender === '' || sender.length <  5 ){
            $(document).find('#msg-sender-error').html('* Required & should at least 5 character long.');
            error = true;
        }

        if(!error){
            $.ajax({
                type: "POST",
                url: "{{route('message.store')}}",
                data: {
                    cart_id : edit_cart,
                    message : message,
                    recipient : recipient,
                    sender : sender,
                },
                success: function (response) {
                  if(response.code === 200){
                    toastr.success('Success', response.message,{
                            positionClass: 'toast-top-center',
                    });
                  }
                  else{
                    toastr.warning('Warning', response.message,{
                            positionClass: 'toast-top-center',
                    });
                  }
                  $(document).find('#address_message_Modal').modal('hide');
                },
                error : function(err){
                  console.log(err);
                  toastr.error('Error', 'Internal server error',{
                            positionClass: 'toast-top-center',
                    });
                }
            });
        }
    });

    $(document).on('click','#cart-wishlist', function(e){
        e.preventDefault();
        var product_id = $(this).attr('data-id');
        var size_id = $(this).attr('data-size');
        var color_id = $(this).attr('data-color');
        var mrp = $(this).attr('data-mrp');
        var sale = $(this).attr('data-sale');
        var image = $(this).attr('data-image');
        var name = $(this).attr('data-name');

        @if(\Auth::check())
        var wishlist = {};
                wishlist.product_id = product_id;
                wishlist.size_id = size_id;
                wishlist.color_id = color_id;
                wishlist.mrp = mrp;
                wishlist.sale_price = sale;
                wishlist.name = name;
                wishlist.image = image;

                wishlist._token = '{{ csrf_token() }}';

                $.ajax({
                    type: "post",
                    url: "{{route('add.wishlist')}}",
                    data: wishlist,
                    success: function (response) {
                        var wishlists = response.data;
                        toastr.success('Success', response.message,{
                                positionClass: 'toast-top-center',
                        });
                        $(document).find('#btn-wishlist').removeClass('grey').addClass('pink');
                        var wish = response.data;
                    var html = "";
                    html +=  `<div class="px-3">`;
                        for(var i = 0 ; i < wish.length ; i++){
                          html += ` <div class="row py-1" style="background-color:white;">
                                        <div class="col-md-4">
                                            <div style="margin : 3px;">`;
                            var assetpath = "{{asset('file')}}";
                            html +=          `<img src="${assetpath}/${wish[i].image}"                   style="width : 100%;"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="text-align : left;margin-top : 4px;">
                                                ${wish[i].name}<br>
                                            <b>Rs - ${wish[i].sale_price}</b>
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <i class="fa fa-lg fa-trash m-1 mt-3" id="rm-wish" data-id="${wish[i].product_id}"></i>
                                        </div>
                                    </div>`;
                        }
                        if(wish.length > 0){
                            html += `<div class="text-center">
                                        <a href="{{url('/wishlists')}}" class="">View More</a>
                                    </div>`;
                        }

                        if(wish.length === 0){
                           html += `<p>
                                        <i style="font-size: 18px; margin-top: 5px;"               class="far fa-heart">
                                        </i>
                                        <br/>Love Something ? Save it here
                                    </p>`;
                        }
                    html += ' </div>';
                      $(document).find('#wishlist-container').html('');
                      $(document).find('#wishlist-container').html(html);
                    },
                    error : function(err){
                        console.log(err);
                        toastr.error('Error', 'Internal server error',{
                                positionClass: 'toast-top-center',
                        });

                    }
           });
        @else
           $(document).find('#loginModal').modal('show');
        @endif
    });


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

                    $(document).find('#coupon-discount').html(response.coupon_price);
                    $(document).find('#final-amount').html(parseInt(final_amount) - parseInt(response.coupon_price));
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

    $(document).on('click','#cart-remove', function(e){
        e.preventDefault();
        var cart_id = $(this).attr('data-id');
        var id = $(this).attr('id');
        $.ajax({
                url: '{{ route('cart.delete') }}',
                method: "DELETE",
                data: {id : cart_id, _token : '{{ csrf_token() }}'},
                beforeSend : function(){
                    overlay.addClass('is-active');
                },
                success: function (response) {
                    update_cart_price();
                    overlay.addClass('is-active');
                    toastr.success('Success', 'Product deleted from the cart.',{
                            positionClass: 'toast-top-center',
                    });
                },
                error : function(err){
                    console.log(err)  ;
                    toastr.error('Error', 'Intenal server error.',{
                            positionClass: 'toast-top-center',
                    });
                }
        });
    });

    $(document).on('click','#cart-add', function(){
       var id = $(this).attr('data-id');
       var count = $(document).find('#cart-qty').val();
       var data_pro = $(this).attr('data-product');
       var product_id = data_pro.split('pro-')[1];
       var color_id = $(this).attr('data-color');
       count = parseInt(count) + 1;
       cart_update(id, 0 , count,product_id, color_id,'qty');
       $(document).find('#cart-qty').val(count++);
       update_cart_price();

    });

    $(document).on('click','#cart-substract', function(){
       var id = $(this).attr('data-id');
       var count = $(document).find('#cart-qty').val();
       var data_pro = $(this).attr('data-product');
       var product_id = data_pro.split('pro-')[1];
       var color_id = $(this).attr('data-color');

       count = parseInt(count) > 1   ? parseInt(count) - 1 : 1;
       cart_update(id, 0 , count,product_id, color_id, 'qty');
       $(document).find('#cart-qty').val(count);
       update_cart_price();
    });

    $(document).on('change','#cart-size', function(){
        var id = $(this).attr('data-id');
        var size = $(this).val();
        var data_pro = $(this).attr('data-product');
        var product_id = data_pro.split('pro-')[1];
        var count = $(document).find('#cart-qty').val();
        var color_id = $(this).attr('data-color');
        cart_update(id, size ,count,product_id, color_id, 'size');
        update_cart_price();
    });

    function update_cart_price()
    {
        $.ajax({
            type: "GET",
            url: "{{url('cart/all')}}",
            data: {},
            success: function (response) {

                var carts = response.carts;
                    var html = '';
                    total = 0;
                    discount = 0;
                    final_amount = 0;
                    gift_value = 0;
                    if(carts.length > 0){
                        for(var i = 0 ; i < carts.length ; i++){

                            if(carts[i]['gift'] !== null){
                                gift = true;
                                let pri = carts[i]['gift']['type'] === 'basic' ? 30 : 50;
                                gift_value +=  parseInt(pri);
                            }

                            var price = parseInt(carts[i]['single_sales_price']) * parseInt(carts[i]['qty']);
                            $(document).find(`#price-${carts[i]['product_id']}`).html(price);
                            var myimages = carts[i]['product_images'];
                            html += ` <li>
                                            <div class="maindiv">
                                                <div class="img-boxs">
                                                <img src="{{asset('file')}}/${myimages[0]}">
                                                </div>
                                                <div class="cart-content">
                                                    <h2><a href="#">${carts[i]['name']}</a></h2>
                                                    <p> RS ${carts[i]['single_sales_price']}     <span>Quantity: ${carts[i]['qty']}</span></p>
                                                </div>
                                                <div class="cart-close">
                                                    <a href="#" id="rm-cart" data-id="${carts[i]['id']}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>`;
                            total += total + (parseInt(carts[i]['single_price']) * parseInt(carts[i]['qty']));
                            discount += carts[i]['qty'] * ( (parseInt(carts[i]['single_price'])  - parseInt(carts[i]['single_sales_price'])));
                        }

                        html += `<li class="total-cart">
                               <span class="aa-cartbox-total-title">Total</span>
                               <span class="aa-cartbox-total-price">₹${total}</span>
                           </li>`;
                        html += `<li class="lastlist">
                                    <a href="{{url('/cart')}}" class="procedtopay"> Proceed To Pay</a>
                                </li>`;
                        html += '</div>';

                        if(carts.length > 0){
                                $(document).find('.cart-items').html(html);
                                $(document).find('.cart-count').html(response.count);
                        }

                        $(document).find('.bag-total').html(total);
                        $(document).find('.bag-discount').html(discount);
                        sub_total = total - discount;
                        final_amount = sub_total;
                        if(gift){
                            $(document).find('.gift_price').html(gift_value);
                            final_amount = final_amount + parseInt(gift_value);
                        }

                        $(document).find('.sub-total').html(total - discount);
                        final_amount = parseInt(final_amount) - parseInt(coupon_value);
                        $(document).find('#final-amount').html(final_amount) ;
                    }
                    else{

                        html += `
                        <div class="text-center">
                            <h4>Cart is empty</h4>
                        /div>`;

                    }
            }
        });
    }

    function cart_update(id,size, qty, product_id, color_id , durl){
        var url = durl === 'size' ? '{{ route('cart.size') }}' : '{{ route('cart.qty') }}';
        $.ajax({
                url: url,
                method: "post",
                data : {id : id, size : size,qty : qty,product_id : product_id,color_id : color_id, _token : '{{ csrf_token() }}' },
                beforeSend : function(){
                    overlay.addClass('is-active');
                },
                success: function (response) {
                    overlay.removeClass('is-active');
                    var carts = response.carts;
                    var html = '';
                    total = 0;
                    discount = 0;
                    final_amount = 0;
                    if(carts.length > 0){
                        for(var i = 0 ; i < carts.length ; i++){
                            var price = parseInt(carts[i]['single_sales_price']) * parseInt(carts[i]['qty']);
                            $(document).find(`#price-${carts[i]['product_id']}`).html(price);
                            var myimages = carts[i]['product_images'];
                            html += ` <li>
                                            <div class="maindiv">
                                                <div class="img-boxs">
                                                <img src="{{asset('file')}}/${myimages[0]}">
                                                </div>
                                                <div class="cart-content">
                                                    <h2><a href="#">${carts[i]['name']}</a></h2>
                                                    <p> RS ${carts[i]['single_sales_price']}     <span>Quantity: ${carts[i]['qty']}</span></p>
                                                </div>
                                                <div class="cart-close">
                                                    <a href="#" id="rm-cart" data-id="${carts[i]['id']}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>`;
                            total += total + (parseInt(carts[i]['single_price']) * parseInt(carts[i]['qty']));
                            discount += carts[i]['qty'] * ( (parseInt(carts[i]['single_price'])  - parseInt(carts[i]['single_sales_price'])));
                        }

                        html += `<li class="total-cart">
                               <span class="aa-cartbox-total-title">Total</span>
                               <span class="aa-cartbox-total-price">₹${total}</span>
                           </li>`;
                        html += `<li class="lastlist">
                                    <a href="{{url('/cart')}}" class="procedtopay"> Proceed To Pay</a>
                                </li>`;
                        html += '</div>';

                        if(carts.length > 0){
                                $(document).find('.cart-items').html(html);
                                $(document).find('.cart-count').html(response.count);
                        }

                        $(document).find('.bag-total').html(total);
                        $(document).find('.bag-discount').html(discount);
                        sub_total = total - discount;
                        final_amount = sub_total;
                        $(document).find('.sub-total').html(total - discount);
                        final_amount = parseInt(final_amount) - parseInt(coupon_value);
                        $(document).find('#final-amount').html(final_amount) ;
                    }
                    else{

                        html += `
                        <div class="text-center">
                            <h4>Cart is empty</h4>
                        /div>`;

                    }

                    toastr.success('Success', response.message,{
                            positionClass: 'toast-top-center',
                    });
                },
                error : function(err){
                    toastr.error('Error', 'Internal server error',{
                            positionClass: 'toast-top-center',
                    });
                }
        });
    }
</script>
@endpush
