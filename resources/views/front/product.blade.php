  @extends('layouts.front')

   @section('content')
      
     
      <!--  =================   Body Element start ======================================= -->
      <div class="breadcrum">
         <div class="container">
            <p>Home > Shop > {{$product->name ?? ''}}</p>
         </div>
      </div>
      <div class="container">
         <div class="product-detail">
            <div class="row">
               <!--  =================   Product Slider start Left side =========================  -->
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-12 ps-silder">
                            
                               <div class="owl-carousel mobileproducts owl-theme mt-5">
                             <div class="item"> <img src="https://vasvi.in/storage/product/1631088580images.png" class="show-small-img" alt="now" style="border: 1px solid rgb(149, 27, 37); padding: 2px;"></div>
                            <div class="item"><img src="https://vasvi.in/storage/product/1631088580images.jpg" class="show-small-img"></div>
                            <div class="item"> <img src="https://vasvi.in/storage/product/1631088580download (1).jpg" class="show-small-img"></div>
                         

                                       </div>
                                       
                        <main class='main-wrapper'>
                           <div class='container'>
                               
                            
                              <article class='product-details-section'>
                                  
                                 
                                 <!-- breadcrum with structured data parameters for ga -->
                                 <section>
                                     
                                    <div class="small-img">
                                       <img src="images/online_icon_right@2x.png" class="icon-left" alt="" id="prev-img">
                                       <div class="small-container">
                                          <div id="small-img-roll">
                                              @foreach ($images as $img)
                                             <img src="{{asset('storage/product').'/'.$img->file_name}}" class="show-small-img" alt="">
                                             @endforeach
                                          </div>
                                       </div>
                                       <img src="images/online_icon_right@2x1.png" class="icon-right" alt="" id="next-img">
                                    </div>
                                    <div class="show" id="myfirstshow" href="{{asset('storage/product').'/'.$firstimage->file_name}}">
                                       <img src="{{asset('storage/product').'/'.$firstimage->file_name}}" id="show-img">
                                    </div>
                                 </section>
                                 <div class='clear'></div> 
                              </article>
                           </div>
                        </main>
                        <div for='' id='sizeselected'></div>
                     </div>
                  </div>
               </div>
               <!--  =================   Product Slider END LEFT side =========================  --> 
               <!--  =================   Add to cart start Right side =========================  -->
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="title-product">
                           <h1> {{$product->name ?? ''}}</h1>
                        </div>
                        <div>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <span class="ml-3" > <a data-toggle="modal" data-target="#myModal" href="#" >Write a Review</a></span> 

                        </div>
                        <p class="my-2"> {!! $product->description ?? '' !!}</p>
                        <div class="text-price-title">Offer Price</div>
                        <div class="product-price">
                            <span class="bold-price"><i class="fas fa-rupee-sign" style="font-size:18px;"></i> {{$primaryvariation->single_sales_price ?? ''}}</span> 
                            <?php if(isset($product->discount_type) && $product->discount_type != "") { ?>
                            <span class="cut-price"><i class="fas fa-rupee-sign" style="font-size:14px;"></i>
                           {{$primaryvariation->single_price ?? ''}}</span> <span class="text-success txt-discount">{{$product->discount ?? ''}}%</span>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="product-size">
                           <ul>
                              <li class="boldtxt">Size</li>
                              @if(isset($sizes) && $sizes->count() > 0)
                              @foreach($sizes as $size)
                              <li><a href="#" @if(!in_array($size->id,$product->productProductVariations()->pluck('size_id')->toArray()))class="disabled" @endif>{{$size->name}}</a></li>
                              @endforeach
                              @endif
                           </ul>
                        </div>
                        <div class="product-color">
                           <ul>
                              <li class="boldtxt">Color</li>
                              @if(isset($colors) && $colors->count() > 0)
                              @foreach($colors as $color)
                              @if(in_array($color->id,$product->productProductVariations()->pluck('color_id')->toArray()))
                              <li class="prod-color-img image-change-new"  data-toggle="tooltip" custom1="{{$color->id}}" data-placement="bottom" style="background: {{$color->value}};" title="{{$color->name ?? ''}}">
                              </li>
                              @endif
                              @endforeach
                              @endif
                           </ul>
                        </div>
                        <div>
                           <div class="row quantity">
                              <div class="col-md-1 "> <span class="quantity boldtxt">Qty. </span> </div>
                              <div class="col-md-4" style="padding-right:0px;">
                                 <div class="input-group display-flex" >
                                    <span class="input-group-btn">
                                    <button type="button" class="btn   btn-number" style="background:#ed6388;" data-type="minus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                    </span>
                                    <input type="text" name="quant[2]" id="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn   btn-number" style="background:#ed6388;" data-type="plus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <button type="button" class="btn-wishlist"> <i class="fa fa-heart" aria-hidden="true"></i></button> <button type="button" class="btn-wishlist"> <i class="fas fa-share-alt"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="mb-5">
                           <span class="delivery-address ">
                              <span class="boldtxt"><i class="fas fa-map-marker-alt theme-color mr-2"></i> Delivery</span> 
                              <input class="form-control-1" type="text" placeholder="Check your area availability" />
                              <button class="btn-check text-success">Check</button>
                           </span>
                       

                     
                        </div>
                        
                           <div class="mb-5">
                           <span class="delivery-address ">
                              <span class="boldtxt"><i class="fas fa-map-marker-alt theme-color mr-2"></i> Connect To A Store</span> 
                              <input class="form-control-1" type="text" placeholder="Enter a Pincode or Store Name" />
                              <button class="btn-check text-success" data-toggle="modal" data-target="#myModal2">Connect To A Store</button>
                           </span>
                          <div class="mt-4">
                              <div style="color: red;" class="box-border"> <i class="fa fa-times mr-3" aria-hidden="true"></i> Service Not available in youe area Pin-code.</div>
                              <div style="color: green;" class="box-border"><i class="fa fa-map-marker mr-3" aria-hidden="true"></i> Delivery possible in your area</div>
                              <div  class="box-border"><i class="fa fa-cart-arrow-down mr-3" aria-hidden="true"></i> Delivered Within 4-6 Working Days</div>
                              <div  class="box-border"><i class="fa fa-shopping-bag mr-3" aria-hidden="true"></i>Free Shipping Above Rs.999/- In India Only</div>
                          </div>

                     
                        </div>
                        
                        
                        <div>
                           <button type="button" class="btn-addcart">Add to Cart</button>  
                           <button type="button" class="btn-buynow">Buy Now</button>
                        </div>

                        <div class="row authentic-product-row clearfix pt-3 mt-3"  >
                           <div class="col-sm-4 col-lg-4 text-center" >
                           <i class="fas fa-cloud-meatball"></i>
                           <p> 100% Authentic Products</p>
                     
                           </div>
                           
                           <div class="col-sm-4 col-lg-3 text-center" >
                               <i class="fas fa-shipping-fast"></i> 
                               <p>Free Shipping*</p>
                             </div>
                            
                             <div class="col-sm-4  col-lg-4 text-center" >
                                  <i class="fab fa-usps"></i> 
                                  <p>Easy Return Policy</p>
                               </div>
                             </div>

                     </div>
                  </div>
               </div>
               <!--  ================ Tab Section Start ======================== -->
               <div class="clear"></div>
               <div class="container product-description">
                  <h3>Product Detail</h3>
                  <div class="col-md-4 col-sm-12">
                     <strong>Product Description</strong>
                     <p>{{$product->description ?? ''}}</p>
                     <p>Product code: 205476926_9463<br/>Need help? <a href="#">Contact us</a></p>
                  </div>
                  <div class="col-md-4 col-sm-12">
                     <table width="100%" cellspacing="0" cellpadding="0" border="0" class="table-product-des" >
                        <tbody>
                           <tr>
                              <th>Product Type</th>
                              <td>Kurta</td>
                           </tr>
                           <tr>
                              <th>Fabric</th>
                              <td>Cotton</td>
                           </tr>
                           <tr>
                              <th>Knit/Woven</th>
                              <td>Woven</td>
                           </tr>
                           <tr>
                              <th>Back Style</th>
                              <td>Round Back</td>
                           </tr>
                           <tr>
                              <th>Type of work</th>
                              <td>Printed</td>
                           </tr>
                           <tr>
                              <th>Neckline</th>
                              <td>Tie Up</td>
                           </tr>
                           <tr>
                              <th>Occasion</th>
                              <td>Casual</td>
                           </tr>
                           <tr>
                              <th>Sleeves</th>
                              <td>Bell Sleeves</td>
                           </tr>
                           <tr>
                              <th>Length</th>
                              <td>Calf Length</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-4 col-sm-12">
                     <p><strong>Care Instructions</strong> <br/>Hand wash </p>
                     <p><strong>DISCLAIMER:</strong> <br/>Colors of the product might appear slightly different on digital devices. </p>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="container">
                     <ul class="nav nav-tabs product-detail-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#product-detail" aria-controls="product-detail" role="tab" data-toggle="tab">BRAND INFO</a></li>
                        <li role="presentation"><a href="#rating" aria-controls="rating" role="tab" data-toggle="tab">Rating & Review</a></li>
                        <li role="presentation"><a href="#return" aria-controls="return" role="tab" data-toggle="tab">Return</a></li>
                        <li role="presentation"><a href="#delivery" aria-controls="delivery" role="tab" data-toggle="tab">Care</a></li>
                     </ul>
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="product-detail">
                          
                        </div>
                        <div role="tabpanel" class="tab-pane" id="rating">
                           <div class="product_detail rating-panel">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="ratingleft">
                                       <p> <span>400/</span><span style="font-size: 25px">5</span> <i class="fa fa-star" aria-hidden="true"></i></p>
                                       <p class="rate_title">Overall rating 1</p>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <ul class="rating-recommend">
                                       <li>Do you recommend this product?</li>
                                       <li><button type="button" class="btn btn-pink" data-toggle="modal" data-target="#myModal">  Write a review</button>
                                        </li>


                                       
                                          <!-- Modal -->
                                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header modal-header-black">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <h4 class="modal-title text-white" id="myModalLabel">Write A Review</h4>
                                                </div>
                                                <div class="modal-body">
                                                   <DIV class="review-box review-box-border">
                                                      <p>Rate the product :<span class="small"> Select the number of stars.</span></p>
                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                      <i class="fa fa-star" aria-hidden="true"></i>

                                                   </DIV>

                                                   <div class="review-box">
                                                      <p>Review Title</p>
                                                      <input id="reviewHeadline_id" name="headline" class=" form-control" placeholder="E.g. Nice Product | Max 50 characters" maxlength="50" type="text" value="" autocomplete="on">
                                                   </div>
                                                   <div class="review-box">
                                                      <p>Your review</p>
                                                       <textarea id="reviewComment_id" name="comment" class="form-contr"   placeholder="Write your review here" maxlength="300"></textarea>
                                                   </div>
                                                   <div class="review-box">
                                                       <input type="checkbox" id="checkbox" name="isRecommended" checked=""> <label for="checkbox">Yes, I recommend this product</label>
                                                   </div>


                                                   <div class="review-box row">
                                                        <div class="col-xs-6">
                                                           <input type="reset" name="button" id="reset" value="cancel" class="cancel_button btn-review-cancel btn-block">  
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <input type="submit" name="button" id="button" value="Submit" class="sbt-button btn-submit-review btn-block">
                                                        </div>
                                                   </div>
                                                 
                                                </div>
                                            </div>
                                          </div>
                                       </div>


                                    </ul>
                                 </div> 
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="return">
                           <div class="col-md-4 col-sm-12 text-center returns-col">
                              <i class="far fa-calendar-alt"></i>
                              <p>
                                 <Strong>Easy Returns</Strong><br/><br/>
                                 If you are not completely satisfied with your purchase, you can return most items to us within 14 days of delivery to get a 100% refund. We offer free and easy returns through courier pickup, or you can exchange most items bought online at any of our stores across India.<br/>
                                 <a href="#">For More details read our Return Policy</a>
                              </p>
                           </div>
                           <div class="col-md-4 col-sm-12 text-center returns-col">
                              <i class="far fa-calendar-alt"></i>
                              <p>
                                 <Strong>Easy Exchange</Strong><br/><br/>
                                 If you are not completely satisfied with your purchase, you can return most items to us within 14 days of delivery to get a 100% refund. We offer free and easy returns through courier pickup, or you can exchange most items bought online at any of our stores across India.<br/>
                                 <a href="#">For More details read our Return Policy</a>
                              </p>
                           </div>
                           <div class="col-md-4 col-sm-12 text-center returns-col">
                              <i class="fas fa-shopping-bag"></i>
                              <p>
                                 <Strong>Delivery</Strong><br/><br/>
                                 Typically Delivered in 5-7 days.<br/>
                                 <a href="#">For More details read our Exchange Policy *T & C Apply</a>
                              </p>
                           </div>
                        </div>
                        <!--  ================ Tab Section end ======================== --> 
                     </div>
                  </div>



               </div>
            </div>
         </div>
      </div> 
 
      </div>
      
      
      
      <!-- The Modal -->
  <div class="modal" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
         
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            
             <h4 class="modal-title text-center">Hurray! We're now open.</h4>
                
    <div id="accordion" class="accordion">
        <div class="card mb-0">
            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                <a class="card-title">
                    Om Rathore(store manager)
                </a>
            </div>
            
            <div id="collapseOne" class="card-body collapse in" data-parent="#accordion " >
                           
                            
         
<strong>contact no.<strong>:8385874990

<h3>Store Name</h3>
<div class="border-gray"></div>
<p>Jaipur, EC</p>



<h3>Open Timings</h3>
<div class="border-gray"></div>
<p>Starting 31st May, we're open on all days.</p>

<p>Customer entry on All days - 11 am to 9.30 pm</p>

            </div>
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                <a class="card-title">
                  Shakti (store manager)
                </a>
            </div>
            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion" >
                 
<strong>contact no.<strong>:8385874990

<h3>Store Name</h3>
<div class="border-gray"></div>
<p>Jaipur, EC</p>



<h3>Open Timings</h3>
<div class="border-gray"></div>
<p>Starting 31st May, we're open on all days.</p>

<p>Customer entry on All days - 11 am to 9.30 pm</p>
            </div>
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                <a class="card-title">
                  Shayam (store manager)
                </a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion" >
                <div class="card-body"> 
<strong>contact no.<strong>:8385874990

<h3>Store Name</h3>
<div class="border-gray"></div>
<p>Jaipur, EC</p>



<h3>Open Timings</h3>
<div class="border-gray"></div>
<p>Starting 31st May, we're open on all days.</p>

<p>Customer entry on All days - 11 am to 9.30 pm</p>

</div>
            </div>
        </div>
    
</div>
            
        </div>
        
    
        
      </div>
    </div>
  </div>
      
      
      
     
@endsection
@push('custom-scripts')
<script >

$( ".image-change-new" ).click(function() {
   let productId="{{$product->id}}";
   let colorId=$(this).attr('custom1');
   var imgPrime;
   $.post('{{ route('product.images.get') }}', {_token:'{{ csrf_token() }}',productId,colorId}, function(data){
      var firsthtml=data[0].file_name;
      var imglink=
       imgPrime="{{asset('storage/product/')}}"+"/"+firsthtml;
         var img=`<img src="${imgPrime}"  alt="" id="show-img">`;
      console.log(firsthtml);
      html='';
      $.each(data, function( index, value ) {
         
         var imgfirst="{{asset('storage/product/')}}"+"/"+value.file_name;
         html+=`<img src="${imgfirst}" class="show-small-img" alt="">`;
});
   // console.log(data);
$('#small-img-roll').html(html);
$('#myfirstshow').html(img);
$('#myfirstshow').attr('href',imgPrime);
$('.show').zoomImage();
$('.show-small-img:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})
$('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
$('.show-small-img').click(function () {
  $('#show-img').attr('src', $(this).attr('src'))
  $('#big-img').attr('src', $(this).attr('src'))
  $(this).attr('alt', 'now').siblings().removeAttr('alt')
  $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  if ($('#small-img-roll').children().length > 4) {
    if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(this).index() - 2) * 76 + 'px')
    } else if ($(this).index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})
// 点击 '>' 下一张
$('#next-img').click(function (){
  $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
  $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
  $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
  if ($('#small-img-roll').children().length > 4) {
    if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
    } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})
// 点击 '<' 上一张
$('#prev-img').click(function (){
  $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
  $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
  $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
  if ($('#small-img-roll').children().length > 4) {
    if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
    } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})

})
});


</script>



<script>

$('.mobileproducts').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})






</script>

@endpush