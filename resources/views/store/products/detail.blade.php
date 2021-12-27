@extends('store.layouts.app')
@section('title', 'Vasvi ' .request()->segment(2))
@section('meta_keywords', 'Vasvi.in, Ecommerce, Shopping, Mens, Woman, Kids, Cloth')
@section('meta_description', 'Ecommerce website to buy a product in quantity or bulk with lots of discount')
@push('styles')
<style>
    .sized-active{
        background-color: #FB8071;
        color : white !important;
    }
    .sized-deactive{
        background-color: white;
        color : black !important;
    }


    .sizepop-active{
        background-color: #FB8071;
        color : white !important;
    }
    .sizepop-inactive{
        background-color: white;
        color : black !important;
    }

    .colord-active{
        outline : 4px solid  grey;
    }
    .colord-deactive{
        outline : 0px solid grey;
    }

    .btn-buynow:hover{
        text-decoration: none;
    }

    .pink{
        color : #FB8071 !important;
    }

    .grey{
        color : lightgrey !important;
    }

    .mstar:hover{
       color : #FB8071 !important;
    }
    #rec-box{
      position: relative;
    }


    #review-trash{
       position: absolute;
       right : 5px;
       bottom : 5px;
    }

    .fa-ruler:hover{
        cursor: pointer;
    }

    #write-review{
        cursor: pointer;
    }

</style>
@endpush

@section('content')
<div class="headertopspace"></div>

    <div class="modal fade" id="store" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12 pad-l0 pad-r0">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body login_modal">
                    <div class="row">
                        <div class="col-md-12" id="store-data">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>

      <?php
        $bproduct_id = $info['id'];
        $bcolor_id = 0;
        $bsize_id = 0;
      ?>


      <div class="modal fade" id="sizeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php $img = \App\Models\Category::find($info['subcategory_id']); ?>
                <img src="{{asset('file')}}/{{$img->size_chart}}"style="width : 100%;"/>
            </div>
          </div>
        </div>
      </div>

      <div class="container" >
          <ol class="breadcrumb">
              <li><a href="index.html">{{$info['category']}}</a></li>
              <li><a href="category.html">{{$info['sub_category']}}</a></li>
              @if($info['child_category'] !== '')
                <li><a href="category.html">{{$info['child_category']}}</a></li>
              @endif
              <li class="active">{{$info['name']}}</li>
          </ol>
         <div class="product-detail">
            <div class="row">
               <!--  =================   Product Slider start Left side =========================  -->
               <div class="col-md-6 col-sm-6">
                  <div class="row">
                     <div class="col-md-12  ps-silder">
                        <main class='main-wrapper'>
                              <article class='product-details-section' id="detail-images">
                                 <!-- breadcrum with structured data parameters for ga -->
                                 <section>
                                    <div class="small-img">
                                       <img src="{{asset('store/images/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
                                       <div class="small-container">
                                          <div id="small-img-roll">
                                            <?php $pri_image = '' ;
                                            $count = 0;
                                            $iterate = 0;
                                            $sales_price = 0;
                                            $mrp_price = 0;
                                            $sizes = [];
                                            $varcount = count($info['variations']);
                                       ?>
                                      @if(count($info['variations']) > 0)
                                       @foreach($info['variations'] as $var)
                                        <?php
                                         $dsize = \App\Models\Size::find($var['size_id']);
                                         $sizes[$dsize->id] = $dsize->name;
                                        ?>
                                        @if($var->primary_variation === 1)
                                          <?php $iterate++;
                                           $images = \App\Models\ProductImage::where(['product_id'=> $info['id'], 'product_color_id' => $var['color_id']])->get(); ?>
                                          @foreach($images as $image)
                                            @if($image->product_color_id === $var['color_id'] && $iterate === 1)
                                               <?php $count++;
                                                  if($count === 1){
                                                    $pri_image = $image->file_name;
                                                    $sales_price = $var['single_sales_price'];
                                                    $mrp_price = $var['single_price'];
                                                  }
                                               ?>
                                             <img src="{{asset('file')}}/{{$image->file_name}}" class="show-small-img" alt="" id="show-small-img">
                                             @endif
                                          @endforeach
                                        @endif
                                       @endforeach
                                      @endif
                                          </div>
                                       </div>
                                       <img src="{{asset('store/images/online_icon_right@2x1.png')}}" class="icon-right" alt="" id="next-img">
                                    </div>
                                    <div class="show" href="{{asset('file')}}/{{$pri_image}}">
                                       <img src="{{asset('file')}}/{{$pri_image}}" id="show-img" class="show-img" alt="{{asset('file')}}/{{$pri_image}}">
                                    </div>
                                 </section>
                                 <div class='clear'></div>
                              </article>
                        </main>
                        <div for='' id='sizeselected'></div>
                     </div>
                  </div>
               </div>

               <?php
               $sizes = array_unique($sizes);

              ?>
               <div class="col-md-6 col-sm-6">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="title-product">
                           <h1><span class="my-pro-name">{{$info['name']}}</span></h1>
                        </div>
                        <div class="rating_star">
                           @if(count($info['reviews']) > 0)
                             @if(round($info['rating']) >= 1)
                             <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                             @else
                             <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                             @endif

                             @if(round($info['rating']) >= 2)
                             <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                             @else
                             <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                             @endif

                             @if(round($info['rating']) >= 3)
                             <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                             @else
                             <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                             @endif

                             @if(round($info['rating']) >= 4)
                             <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                             @else
                             <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                             @endif

                             @if(round($info['rating']) === 5)
                             <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                             @else
                             <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                             @endif
                           @else
                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                           @endif
                            <span class="ml-3"><a data-toggle="modal" id="write-review" >Write a Review</a></span>
                        </div>

                            {{-- <span class="view_detail ml-3" style="position: relative;" >
                                <a class="theme-color" href="javascript:void(0);" tabindex="0" data-placement="bottom" data-trigger="hover" data-toggle="popover" data-popover-content="#a2"><b>View Details</b></a>
                                <div id="a2" class="hidden">
                                    <div class="popover-body">
                                       <p><b>Set Description:</b>
                                        1 set = Total
                                       {{count($info['variations'])}}
                                       Pieces; 1 each of
                                            @foreach($sizes as $key => $value)
                                                 {{$value}},
                                            @endforeach
                                       </p>
                                       @foreach($info['attributes'] as $attr)
                                            <?php $at = \App\Models\Attribute::find($attr->attribute_id); ?>
                                            <?php $atv = \App\Models\AttributeValue::find($attr->attribute_value_id); ?>
                                            <p>
                                                <b>@if($at) {{$at->name}} @endif</b>
                                                : @if($atv) {{$atv->value}} @endif
                                            </p>
                                        @endforeach

                                       <p><b>Minimum Order:</b> 1 SET </p>
                                       <p><b>MRP:</b> {{$sales_price}} Per Piece </p>
                                       <p><b>Product code:</b> {{$info['sku']}} </p>
                                       <p><b>HSN code:</b> {{$info['hsn']}} </p>
                                       <p><b>GST:</b> @5%</p>
                                    </div>
                                </div>

                            </span> --}}

                        <p class="my-2"> {!! substr($info['details'] , 0, 270) !!}
                            @if(strlen($info['details']) > 270 )
                              ...
                            @endif</p>
                        <div class="text-price-title">Offer Price</div>
                        <div class="product-price"><span class="bold-price"><i class="fas fa-rupee-sign" style="font-size:18px;"></i>
                            <span class="dsale-price">{{$sales_price}}</span>
                        </span> 
                        <?php if(isset($info['discount_type']) && $info['discount_type'] != "") { ?>
                        <span class="cut-price"><i class="fas fa-rupee-sign" style="font-size:14px;"></i>
                            <span class="dmrp-price">{{$mrp_price}}</span>
                        </span> 
                        <?php } ?>
                        <span class="text-success txt-discount">
                            @if($info['discount_type'] === 1)
                                {{$info['discount'] !== null ? $info['discount'] : 0}}%
                            @else
                                {{$info['discount']}} &nbsp; Flat
                            @endif
                        </span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="product-size">
                           <ul>
                              <li class="boldtxt">Size</li>
                              <?php
                                $variations = \App\Models\ProductVariation::where('product_id', $info['id'])->groupBy('color_id')->get();
                                
                              ?>

                                @foreach($sizes as $key => $value)
                                <?php if(in_array($key,$psizes)){ ?>
                                <li ><a href="#" id="sized-circle"
                                    @foreach($variations as $var)
                                      @if($var->size_id === $key)

                                       <?php
                                       if($var->size_status !== 1)
                                       {
                                        echo 'class="disabled"';
                                       }
                                       if ($var->primary_variation == 1) {
                                        $bsize_id = $var->size_id;
                                        echo 'class="sized-active"';
                                       }

                                       ?>

                                      @endif
                                    
                                    @endforeach
                                    data-id="{{$key}}"
                                    data-product="{{$info['id']}}"
                                    >{{$value}}</a></li>
                                    <?php } ?>
                                @endforeach
                                <li>
                                    <div style="width : 250px;margin-left : 100px;">
                                        <i class="fas fa-2x fa-ruler" id="fa-ruler" style="color : grey;"></i>
                                        <span style="display : inline-block">Size Guide</span>
                                    </div>
                                </li>
                           </ul>
                        </div>
                        <div class="product-color">
                           <ul>
                              <li class="boldtxt">Color</li>
                              <div class="color-scale">
                                 <ul>
                                    <?php //$variations = \App\Models\ProductVariation::where('product_id',$info['id'])->groupBy('color_id')->get();
                                    $i = 0;
                                    $color_id = 0;
                                    $qty = 0;
                                   ?>
                                     @foreach($variations as $var)
                                     <?php
                                       $i++;
                                       $color = \App\Models\Color::find($var['color_id']);
                                      ?>
                                     <li  class="
                                     @if($var->primary_variation === 1)
                                     <?php
                                     $color_id = $color->id;
                                     $bcolor_id = $color->id;
                                     $qty = $var['single_price_quantity'] ?>
                                     colord-active
                                     @else
                                     colord-inactive
                                     @endif
                                     @if($var->size_status !== 1)
                                        disabled
                                    @endif" data-id="{{$color->id}}"  data-product="{{$info['id']}}" id="colord-id"><a href="#" style="background-color:{{$color->value}} !important"></a></li>
                                @endforeach
                                 </ul>
                                 </div>
                           </ul>
                        </div>
                        <div>
                           <div class="row quantity">
                              <div class="col-md-3" style="padding-right:0px;">
                                 <div class="input-group display-flex" >
                                    <span class="input-group-btn">
                                    <button type="button" class="btn   btn-number" style="background:#ed6388;" id="minus" data-type="minus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                    </span>
                                    <input type="text" name="quant[2]" id="dquantity-pro" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn   btn-number" style="background:#ed6388;" id="plus" data-type="plus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <button type="button" class="btn-wishlist @if($like) pink" data-id="1" @else grey" data-id="0" @endif id="btn-wishlist"
                                  data-product={{$info['id']}}> <i class="fa fa-heart" aria-hidden="true"></i></button>
                                  <button id="share_icons" class="btn-wishlist" type="button"> <i class="fas fa-share-alt"></i></button>
                                  <?php
                                    $set = \App\Models\Setting::first();
                                  ?>
                                  <div id="div3" style="display: none; width: 0;">
                                  <div class="share_icons">
                                      <div class="card card-body">
                                        <div class="footer_social">
                                            <ul>
                                               <li><a href="{{$set->fb_link}}{{url()->full()}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                               <li><a href="{{$set->twitter_link}}{{url()->full()}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                               <li><a href="{{$set->pinterest_link}}{{url()->full()}}&description={{request()->segment(2)}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                                               <li><a href="{{$set->whatsapp_link}}{{url()->full()}}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>

                                            </ul>
                                         </div>
                                      </div>
                                    </div>
                                  </div>

                              </div>

                           </div>
                        </div>
                        <div class="mb-5">
                            <span class="delivery-address ">
                                <h5>Check Delivery Service Availability</h5>
                              <span class="boldtxt"><i class="fas fa-map-marker-alt theme-color mr-2"></i> Delivery</span>
                              <input class="form-control-1" type="text" placeholder="Check your area availability" id="pincode-input"/>
                              <button class="btn-check text-success" id="pincode-check">Check</button>
                           </span>
                           <span class="delivery-address ">
                               <h5>Connect To A Store</h5>
                              <span class="boldtxt"><i class="fas fa-map-marker-alt theme-color mr-2"></i> Store</span>
                              <input class="form-control-1" type="text" id="store-pincode" placeholder="Enter a pincode store name" />

                              <button class="btn-check text-success" id="store-check">Check</button>

                           </span>
                          <div class="mt-4">
                              <div style="color: red;" class="box-border" id="pincode-error"> <i class="fa fa-times mr-3" aria-hidden="true"></i> Service Not available in your area Pin-code.</div>
                              <div style="color: green;" class="box-border" id="pincode-success"><i class="fa fa-map-marker mr-3" aria-hidden="true"></i> Delivery possible in your area</div>
                              <div  class="box-border" id="pincode-day"><i class="fa fa-cart-arrow-down mr-3" aria-hidden="true"></i> Delivered Within 4-7 Working Days</div>
                              <div  class="box-border" id="pincode-shipping"><i class="fa fa-shopping-bag mr-3" aria-hidden="true"></i>Free Shipping Above Rs.999/- In India Only</div>
                          </div>
                        </div>
                        <div>
                           <button type="button" class="btn-addcart" data-id="{{$info['id']}}">Add to Cart</button>
                           <a href="{{url('checkout/buynow')}}?product_id={{$bproduct_id}}&color_id={{$bcolor_id}}&size_id={{$bsize_id}}&qty=1" class="btn-buynow text-center" id="buy-now">Buy Now</a>
                        </div>

                        <div class="row authentic-product-row clearfix pt-3 mt-3"  >
                           <div class="col-md-4 col-sm-4 text-center" >
                           <i class="fas fa-cloud-meatball"></i>
                           <p> 100% Authentic Products</p>

                           </div>

                           <div class="col-sm-3  text-center" >
                               <i class="fas fa-shipping-fast"></i>
                               <p>Free Shipping*</p>
                             </div>

                             <div class="col-md-4 col-sm-4 text-center" >
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
                  <div class="col-md-6 col-sm-12">
                     <strong>Product Description</strong>
                     <p>{!!$info['description']!!}</p>

                  </div>
                  <div class="col-md-4 col-sm-12">
                     <table width="100%" cellspacing="0" cellpadding="0" border="0" class="table-product-des" >
                        <tbody>
                            <tr>
                                <th>Product SKU</th>
                                <td>{{$info['sku']}}</td>
                            </tr>
                            @foreach($info['attributes'] as $attr)
                              <?php $at = \App\Models\Attribute::find($attr->attribute_id); ?>
                              <?php $atv = \App\Models\AttributeValue::find($attr->attribute_value_id); ?>
                              <tr>
                                    <th>@if($at) {{$at->name}} @endif</th>
                                    <td>@if($atv) {{$atv->value}} @endif</td>
                              </tr>
                            @endforeach
                        </tbody>
                     </table>
                  </div>
                  {{-- <div class="col-md-4 col-sm-12">
                     <p><strong>Care Instructions</strong> <br/>Hand wash </p>
                     <p><strong>DISCLAIMER:</strong> <br/>Colors of the product might appear slightly different on digital devices. </p>
                  </div> --}}
               </div>
               <div class="col-md-12">
                  <div class="container">
                     <ul class="nav nav-tabs product-detail-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#product-detail" aria-controls="product-detail" role="tab" data-toggle="tab">BRAND INFO</a></li>
                        <li role="presentation"><a href="#rating" aria-controls="rating" role="tab" data-toggle="tab">Rating & Review</a></li>
                        <li role="presentation"><a href="#return" aria-controls="return" role="tab" data-toggle="tab">Return</a></li>
                        <li role="presentation"><a href="#care" aria-controls="delivery" role="tab" data-toggle="tab">Care & Disclaimer</a></li>
                     </ul>
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="product-detail">
                           <p>{!!$info['brand']->description!!}</p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="rating">
                           <div class="product_detail rating-panel">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="ratingleft">
                                       <p> <span class="five-review">{{$info['five']}}/</span><span style="font-size: 25px">5</span> <i class="fa fa-star" id="overall-star" aria-hidden="true"></i></p>
                                       <p class="rate_title">Overall rating 1</p>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <ul class="rating-recommend">
                                       <li>Do you recommend this product?</li>
                                       <li><button type="button" class="btn btn-pink" id="write-review" >  Write a review</button>
                                        </li>
                                    </ul>
                                 </div>

                              </div>
                              <div class="row">
                                 <div class="col-md-8" id="place-review">

                                 </div>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="return">
                           <div class="col-md-12 col-sm-12 mb-5 pt-4" style="font-size : 16px;">
                               <?php
                               $policy = \App\Models\CmsPage::where('title','like','%Return Policy%')->first();
                               ?>
                               {!!$policy !== null ? $policy->description : '' !!}
                           </div>
                           {{-- <div class="col-md-4 col-sm-12 text-center returns-col">
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
                           </div> --}}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="care">
                            <p class="mt-5" style="font-size : 18px;">{!! $info['care']!!}</p>
                         </div>
                        <!--  ================ Tab Section end ======================== -->
                     </div>
                  </div>



               </div>
            </div>
         </div>
      </div>
      @if(count($trending)>0)
       <section>
          <div class="col-md-12 text-center heading-title">
                <h2 class="title-txt">You may also like </h2>
                <img src="{{asset('store/images/headline.png')}}">
            </div>
           <div style="padding-top:60px;">
                <div class="container">
                   <div class="row">
                      <div class="col-lg-12">
                         <div class="home-product vasvi_exclusive_slider">
                            <div class="owl-carousel owl-theme home-product-slider">
                              @foreach($trending as $trendin)
                               <div class="item">
                                  <div class="product-card">
                                     <div>
                                        <div id="f1_container">
                                           <div id="f1_card" class="shadow">
                                            <?php $c = 0; ?>
                                            @foreach($trendin['images'] as $img)
                                             <?php $c++; ?>
                                             @if($c === 1)
                                                <div class="front face">
                                                    <a href="{{url('/')}}/{{$trendin['slug']}}">
                                                    <img src="<?php echo asset("file/$img");?>" class="img-responsive" style="height: 100%;" alt="">
                                                    </a>
                                                </div>
                                             @elseif($c === 2)
                                                <div class="back face center" data-id="{{$trendin['id'] }}">
                                                    <a href="{{url('/')}}/{{$trendin['slug']}}">
                                                    <img src="{{asset("file")}}/{{$img}}" class="img-responsive" style="height: 100%;" alt="">
                                                    </a>
                                                </div>
                                             @endif
                                            @endforeach
                                           </div>
                                        </div>
                                     </div>
                                     <div class="text-caption">
                                        <p><strong>{{$trendin['category']}}</strong> {{$trendin['name']}}</p>
                                        <p> <span class="price-txt">Rs.{{$trendin['single_sales_price']}}</span> 
                                        <?php if(isset($trendin['discount_type']) && $trendin['discount_type'] != "") { ?>
                                        <span class="price-oveline">Rs.{{$trendin['single_mrp_price']}}</span>
                                         <?php } ?>
                                        <span class="discount-text">
                                            {{$trendin['discount']}}
                                            @if($trendin['discount_type'] ==1)
                                            %
                                            @elseif($trendin['discount_type'] ==2)
                                            Flat
                                            @else
                                            @endif
                                            </span></p>
                                        <p class="pro-rating">
                                            @if(count($trendin['reviews']) > 0)
                                                @if($info['rating'] >= 1)
                                                  <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                                @else
                                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                                @endif

                                                @if($info['rating'] >= 2)
                                                  <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                                @else
                                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                                @endif

                                                @if($info['rating'] >= 3)
                                                  <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                                @else
                                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                                @endif

                                                @if($info['rating'] >= 4)
                                                  <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                                @else
                                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                                @endif

                                                @if($info['rating'] >= 5)
                                                  <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                                @else
                                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                                @endif
                                            @else
                                            <i class="fa fa-star"   aria-hidden="true"></i>
                                            <i class="fa fa-star"   aria-hidden="true"></i>
                                            <i class="fa fa-star"   aria-hidden="true"></i>
                                            <i class="fa fa-star"   aria-hidden="true"></i>
                                            <i class="fa fa-star"   aria-hidden="true"></i>
                                            @endif


                                           ({{count($trendin['reviews'])}})
                                        </p>
                                     </div>
                                     <div class="caption-hover">
                                        <a href="" class="prod-info" id="{{$trendin['id']}}">QUICK VIEW</a>

                                     </div>
                                     <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                  </div>
                               </div>
                               @endforeach
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
       </section>
       @endif

        <!-- Modal -->
       <div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="modal-header modal-header-black">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title text-white text-center my-2" id="myModalLabel">Write A Review</h4>
                </div>
                <div class="modal-body">
                  <form action="#" method="post" id="review-from">
                   <div class="review-box review-box-border">
                      <p>Rate the product :<span class="small"> Select the number of stars.</span></p>
                      <i class="fa fa-star mstar" data-id="1" id="mstar" aria-hidden="true"></i>
                      <i class="fa fa-star mstar" data-id="2" id="mstar" aria-hidden="true"></i>
                      <i class="fa fa-star mstar" data-id="3" id="mstar" aria-hidden="true"></i>
                      <i class="fa fa-star mstar" data-id="4" id="mstar" aria-hidden="true"></i>
                      <i class="fa fa-star mstar" data-id="5" id="mstar" aria-hidden="true"></i>
                      <p class="text-danger py-1" id="rate-error"></p>
                   </div>
                   <input type="hidden" value="0" name="rating" id="rating-input"/>

                   <div class="review-box">
                      <p>Review Title</p>
                      <input id="reviewHeadline_id" name="headline" class=" form-control" placeholder="E.g. Nice Product | Max 50 characters" maxlength="50" type="text" value="" autocomplete="on">
                      <p class="text-danger py-1" id="title-error"></p>
                   </div>
                   <div class="review-box">
                      <p>Your review</p>
                       <textarea id="reviewComment_id" name="comment" class="form-control"   placeholder="Write your review here" maxlength="300"></textarea>
                      <p class="text-danger py-1" id="comment-error"></p>
                   </div>
                   <div class="review-box">
                       <input type="checkbox" id="recommended" name="isRecommended" checked=""> <label for="checkbox">Yes, I recommend this product</label>
                   </div>
                   <div class="review-box row">
                        <div class="col-xs-6">
                           <input type="reset" name="button" id="reset" value="cancel" class="cancel_button btn-review-cancel btn-block">
                        </div>
                        <div class="col-xs-6">
                            <input type="submit" name="button" id="submit-review" value="Submit" class="sbt-button btn-submit-review btn-block">
                        </div>
                   </div>
                 </div>
                </div>
            </div>
          </div>
       </div>
@endsection

@push('scripts')
<script>
$(function(){
    var dproduct =  <?php echo json_encode($info); ?> ;
    var dvariation = {};
    var dvariations = dproduct['variations'];
    var dpimages = dproduct['images'];
    var dqty = 1;
    var proid = "{{$info['id']}}";
    var dproduct_id = 0;
    var dsize_id =  $(document).find('.sized-active').attr('data-id');
    var dcolor_id = $(document).find('.colord-active').attr('data-id');
    var dproductData = {};
    var dimages = {};
    var dcurrentImages = [];
    var ddvariation = {};
    var dmrp_price = "{{$mrp_price}}";
    var dsales_price = "{{$sales_price}}";
    var pincode_error = true;



    $(document).on('click','#fa-ruler', function(e){
        $(document).find('#sizeModal').modal('show');
    });

    var product_id = "{{$info['id']}}";

    $(document).find('#pincode-error').hide();
    $(document).find('#pincode-success').hide();
    $(document).find('#pincode-day').hide();
    $(document).find('#pincode-shipping').hide();

    $(document).on('click','#pincode-check', function(e){
        e.preventDefault();
        var pincode = $(document).find('#pincode-input').val();
        $(document).find('#pincode-input').css('border','0px solid grey');
        if(pincode === '' || pincode.length < 6){
            $(document).find('#pincode-input').css('border','1px solid red');
            return;
        }
        else{
            $.ajax({
                type: "POST",
                url: "{{route('product.stores.available')}}",
                data: {pincode : pincode},
                success: function (response) {
                  if(response.code === 200){
                      pincode_error = false;
                      $(document).find('#pincode-error').hide();
                      $(document).find('#pincode-success').show();
                      $(document).find('#pincode-day').show();
                      $(document).find('#pincode-shipping').show();
                  }
                  else{
                      pincode_error = true;
                      $(document).find('#pincode-success').hide();
                      $(document).find('#pincode-error').show();
                      $(document).find('#pincode-day').hide();
                      $(document).find('#pincode-shipping').hide();
                  }
                },
                error : function(err){
                    console.log(err);
                }
            });
        }
    });

    $(document).on('click','#store-check', function(e){
        e.preventDefault();
        var pincode = $(document).find('#store-pincode').val();
        $(document).find('#store-pincode').css('border', '0px solid red');
        $(document).find('#store-data').html('');
        if(pincode === '' || pincode.length < 6){
            $(document).find('#store-pincode').css('border', '1px solid red');
        }
        else{
            $.ajax({
                type: "POST",
                url: "{{route('product.stores')}}",
                data: {pincode : pincode},
                success: function (response) {
                   if(response.code === 200){
                       var html = '';
                       if(response.data.length > 0){
                        html += `<div class="pad15">
                                  <h2 class="modal_title">Hurray! We're now open.</h2>
                                    <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade active in" id="Wholesaler">
                                                <ul class="nav nav-tabs">`;
                                    for(var i=0; i < response.data.length ; i++){
                                            html += `<li class="active">
                                                      <a data-toggle="tab" href="#home${i}">${response.data[i].name}</a>
                                                    </li>`
                                    }
                                        html +=`</ul>
                                                <div class="tab-content">`;
                                    for(var j=0; j < response.data.length; j++){
                                        let active = j === 0 ? 'active' : '';
                                        html += `<div id="home${j}" class="tab-pane fade in ${active}">
                                                        <div class="contact-details">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <h3>Store Manager</h3>
                                                                    <p>${response.data[j].contact_person_name}.</p>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <h3>Location</h3>
                                                                    <p>${response.data[j].location}.</p>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <h3>Contact Number</h3>
                                                                    <p>${response.data[j].store_contact}</p>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <h3>Store Name</h3>
                                                                    <p>${response.data[j].name}</p>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <h3>Open Timings</h3>
                                                                    <p>${response.data[j].open_time}</p>
                                                                </div>
                                                                <div class="col-md-10 col-sm-10">
                                                                    <h3>Store Address</h3>
                                                                    <p>${response.data[j].address}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`;
                                    }

                                    html +=    `</div>
                                            </div>
                                    </div>
                            </div>`;
                       }
                       else{
                        html += `<div class="pad15">
                                  <h2 class="modal_title">Sorry!No shop found.</h2>
                                    <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane text-center fade active in" id="Wholesaler">
                                               <img src="{{asset('store/images/no-store.png')}}" />
                                            </div>
                                    </div>
                            </div>`;
                       }

                       $(document).find('#store-data').html(html);
                       $(document).find('#store').modal('show');
                   }
                },
                error : function(err){
                    console.log();
                    toastr.error('Error', 'Internal server error',{
                            positionClass: 'toast-top-center',
                    });
                }
            });
        }
    });

    $(document).on('click','#write-review',function(e){
        e.preventDefault();
        if("{{Auth::check()}}"){
             $(document).find('#myReview').modal('show');
        }
        else{
            $(document).find('#loginModal').modal('show');
        }
    });

    $(document).find('.less').hide();
    $(document).on('click','.more',function(e){
      $(this).hide();
      $(this).siblings(".less").show();
    });

    $(document).on('click','.less',function(e){
      $(this).hide();
      $(this).siblings(".more").show();
    });

    function load_review(page){
        $.ajax({
            type: "get",
            url: "{{url('product/reviews')}}"+`/${product_id}?page=${page}`,
            data: {},
            success: function (response) {
               $(document).find('#place-review').html('').html(response.html);
               $(document).find('.less').hide();

               var html = '';
               var avg = Math.round(response.avg);
               if(avg >= 1){
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>`;
               }
               else{
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>`;
               }
               if(avg >= 2){
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>`;
               }
               else{
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>`;
               }
               if(avg >= 3){
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>`;
               }
               else{
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>`;
               }
               if(avg >= 4){
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>`;
               }
               else{
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>`;
               }
               if(avg >= 5){
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>`;
               }
               else{
                   html += `<i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>`;
               }

               html += `<span class="ml-3"><a data-toggle="modal" id="write-review" >Write a Review</a></span>`;
               $(document).find('.rating_star').html('').html(html);
               $(document).find('.five-review').html('').html(response.rating + '/');
               $(document).find('[id=review-trash]').hide();
            },
            error: function(err){
               console.log(err);
               toastr.error('Error', 'Internal server error',{
                        positionClass: 'toast-top-center',
                });
            }
        });
    }

    $(window).on('hashchange',function(){
            if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else{
                load_review(page);
            }
        }
    });


    $(document).ready(function(){
        $(document).on('click','.pagination a',function(event){
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];
            load_review(page);
        });
    });

    load_review(1);

    $(document).on('click','#submit-review', function(e){
       e.preventDefault();

       $(document).find('#rate-error').html('');
       $(document).find('#title-error').html('');
       $(document).find('#comment-error').html('');

       var rate = $(document).find('#rating-input').val();
       var title = $(document).find('#reviewHeadline_id').val();
       var comment = $(document).find('#reviewComment_id').val();
       var recommend = $(document).find('#recommended').is(':checked') ? 1 : 0;
       var error = false;


       if(rate == 0){
           error = true;
           $(document).find('#rate-error').html('* field is required!');
       }

       if(title === ''){
           error = true;
           $(document).find('#title-error').html('* field is required!');
       }

       if(comment === ''){
           error = true;
           $(document).find('#comment-error').html('* field is required!');
       }

       if(!error){
          $.ajax({
              type: "post",
              url: "{{route('review.store')}}",
              data: {
                  product_id : product_id,
                  comment : comment,
                  title : title,
                  rating : rate,
                  recommend : recommend
              },
              success: function (response) {
                $(document).find('#rating-input').val('');
                $(document).find('#reviewHeadline_id').val('');
                $(document).find('#reviewComment_id').val('');
                toastr.success('Success', response.message,{
                        positionClass: 'toast-top-center',
                });
                load_review(1);
                $(document).find('#myReview').modal('hide');
              },
              error : function (err){
                console.log(err);
                toastr.error('Error', 'Internal server error',{
                        positionClass: 'toast-top-center',
                });
              }
          });
       }

    });


    $(document).on('mouseover','#rec-box', function(e){
      $(this).children('#review-trash').show();
    });

    $(document).on('mouseleave','#rec-box', function(e){
        $(this).children('#review-trash').hide();
    });


    $(document).on('click', '#review-trash', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
            type: "delete",
            url:  "{{url('product/review')}}"+`/${id}`,
            data: {},
            success: function (response) {
                toastr.success('Success', response.message,{
                        positionClass: 'toast-top-center',
                });
                load_review(1);
            },
            error : function(err){
                toastr.error('Error', 'Internal server error!',{
                        positionClass: 'toast-top-center',
                });
            }
        });
    });

    $(document).on('click','.mstar', function(e){
        e.preventDefault();
        var count = $(this).attr('data-id');
        $(document).find('#rating-input').val(count);
        $('.mstar').each(function(){
            if($(this).attr('data-id') <= count){
                $(this).css('color', '#FB8071');
            }
            else{
                $(this).css('color', '#333333');
            }
        })
    });

    $(document).on('click','#show-small-img', function(){
       var src = $(this).attr('src');
       $(document).find('.show-img').attr('src',src);
    });

    $(document).on('click', '#btn-wishlist', function(e){
        e.preventDefault();
        var data = $(this).attr('class');
        if(data.includes("grey")){
            @if(\Auth::check())
                var wishlist = {};
                wishlist.product_id = dproduct['id'];
                wishlist.size_id = dsize_id;
                wishlist.color_id = dcolor_id;
                wishlist.mrp = dmrp_price;
                wishlist.sale_price = dsales_price;
                wishlist.name = dproduct['name'];
                wishlist.image = dpimages[0];
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
                      $(document).find('.wish-count').html(wish.length);
                    },
                    error : function(err){
                        console.log(err);
                        toastr.error('Error', 'Internal server error',{
                                positionClass: 'toast-top-center',
                        });

                    }
                });

            @else
                $('#loginModal').modal('show');
            @endif
        }
        else{
            var product_id = dproduct['id'];
            $.ajax({
                type: "delete",
                url: "{{url('wishlist')}}"+`/${product_id}`,
                data: {
                    id : product_id,
                    _token : '{{ csrf_token() }}'
                },
                success: function (response) {
                    toastr.success('Success', response.message,{
                        positionClass: 'toast-top-center',
                    });
                    $(document).find('#btn-wishlist').removeClass('pink').addClass('grey');

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
                      $(document).find('.wish-count').html(wish.length);
                }
            });
        }

    });

    for(var i = 0 ; i < dvariations.length; i++){
        var final_images = [];
        if(dvariations[i]['color_id'] == dcolor_id && dvariations[i]['size_id'] == dsize_id){
            var images = dproduct['images'];
                for(var j = 0 ; j < images.length; j++){
                if(images[j]['product_color_id'] == dcolor_id){
                    final_images.push(images[j]['file_name']);
                }
                }

            dvariation = dvariations[i];
            dpimages = final_images;
        }
    }

    $(document).on('click','#sized-circle', function(e){
        e.preventDefault();
        var $this = $(this);
        dsize_id = $(this).attr('data-id');
        dproduct_id = $(this).attr('data-product');
        $(document).find("[id^='sized-circle']").removeClass('sized-active').addClass('sized-deactive');
        // $(document).find('#sized-circle').removeClass('sized-active').addClass('sized-deactive');
        $this.removeClass('sized-deactive').addClass('sized-active');
        load_price();
    });

    $(document).on('click','#colord-id', function(e){
        e.preventDefault();
        var $this = $(this);
        dcolor_id = $(this).attr('data-id');
        dproduct_id = $(this).attr('data-product');
        $(document).find("[id^='colord-id']").attr('class',"colord-deactive");
        // $(document).find('#colord-id').attr('class',"colord-deactive");
        $this.removeAttr('class');
        $this.attr('class',"colord-active");
        load_price();
    });

    function load_price(){
        var variations = dproduct.variations;

        var proid = "{{$info['id']}}";
        var src = `{{url('checkout/buynow')}}?product_id=${proid}&color_id=${dcolor_id}&size_id=${dsize_id}&qty=${dqty}`;

        $(document).find('#buy-now').attr('href', src);
          for(var i = 0 ; i < variations.length; i++){
            var final_images = [];
            // console.log('Color -'+dcolor_id+' '+'Size -'+dsize_id);

            if(variations[i]['color_id'] == dcolor_id && variations[i]['size_id'] == dsize_id){

                var mrp = parseInt(variations[i]['single_price'])  * dqty;
                var sale_mrp = parseInt(variations[i]['single_sales_price']) * dqty;
                dmrp_price = mrp;
                dsales_price = sale_mrp;
                $(document).find('#dquantity-pro').val(dqty);
                $(document).find('.dmrp-price').html(mrp);
                $(document).find('.dsale-price').html(sale_mrp);
                var images = dproduct.images;

                for(var j = 0 ; j < images.length; j++){
                    if(images[j]['product_color_id'] == dcolor_id){
                        final_images.push(images[j]['file_name']);
                    }
                }

                dpimages = final_images;
                dvariation = variations[i];

            }
        }

        var detailHtml = `
                           <section>
                                <div class="small-img">
                                   <img src="{{asset('frontend/images/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
                                   <div class="small-container">
                                      <div id="small-img-roll" >`;
        var dpriimg = '';
        for(var n= 0 ; n < dpimages.length; n++){
            if(n === 0){
                dpriimg = dpimages[n];
            }
            detailHtml += ` <img src="{{asset('file')}}/${dpimages[n]}" class="show-small-img" alt="" id="show-small-img">`;
        }



        detailHtml +=                 `</div>
                                   </div>
                                   <img src="{{asset('frontend/images/online_icon_right@2x1.png')}}" class="icon-right" alt="" id="next-img">
                                </div>
                                <div class="show" href="{{asset('file')}}/${dpriimg}">
                                   <img src="{{asset('file')}}/${dpriimg}" id="show-img" class="show-img" style="width: 100%;height: 100%;">
                                </div>

                             </section>
                             <div class='clear'></div>
                         `;
        $(document).find('#detail-images').html('');
        $(document).find('#detail-images').html(detailHtml);
        $('.show').zoomImage();
    }

    $(document).on('click','.btn-addcart', function(e){
        e.preventDefault();
        if(pincode_error === true){
            toastr.warning('Warning', 'Product delivery not available in your area. Please try another pincode.',{
                        positionClass: 'toast-top-center',
            });
            return;
        }
        var dyvariation = dvariation;
        dyvariation.mrp_price = dvariation.single_price;
        dyvariation.sales_price = dvariation.single_sales_price;
        dyvariation.product_images = dpimages;
        var qty = $(document).find('#quantity-pro').val();
        dyvariation.qty = dqty;
        dyvariation.name = $(document).find('.my-pro-name').html();
        dyvariation._token = '{{ csrf_token() }}';


        $.ajax({
            url: '{{ route('cart.store') }}',
            method: "post",
            data: dyvariation,
            beforeSend : function(){
                overlay.addClass('is-active');
            },
            success: function (response) {
            overlay.removeClass('is-active');
            var count = response.count;
            $(document).find('.cart-no').html(count);
            toastr.success('Success', response.message,{
                            positionClass: 'toast-top-center',
            });

            var cart = response.cart;
            var html = '<div class="rm-sec">';
            var total = 0;


                for(var i = 0 ; i < cart.length ; i++)
                {
                var myimages = cart[i].product_images;
                html += ` <li>
                                <div class="maindiv">
                                    <div class="img-boxs">
                                    <img src="{{asset('file')}}/${myimages[0]}">
                                    </div>
                                    <div class="cart-content">
                                        <h2><a href="#">${cart[i].name}</a></h2>
                                        <p> RS ${cart[i].single_sales_price}     <span>Quantity: ${cart[i].qty}</span></p>
                                    </div>
                                    <div class="cart-close">
                                        <a href="#" id="rm-cart" data-id="${cart[i].id}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </li>`;
                total += total + (parseInt(cart[i].single_sales_price) * parseInt(cart[i].qty));
                }



                html += `<li class="total-cart">
                            <span class="aa-cartbox-total-title">Total</span>
                            <span class="aa-cartbox-total-price">₹${total}</span>
                        </li>`;
                html += `<li class="lastlist">
                            <a href="{{url('/cart')}}" class="procedtopay"> Proceed To Pay</a>
                        </li>`;
                html += '</div>';
                if(cart.length > 0){
                    $(document).find('.cart-items').html(html);
                    $(document).find('.cart-count').html(cart.length);
                }


            //    window.open("{{url('/cart')}}","_self");
            }
        });
    });


    $(document).on('click','#plus', function(){
        var count = $(document).find('#dquantity-pro').val();
        count = parseInt(count) + 1;
        count = count++;
        $(document).find('#dquantity-pro').val(count);
        dqty = count;

        var src = `{{url('checkout/buynow')}}?product_id=${proid}&color_id=${dcolor_id}&size_id=${dsize_id}&qty=${count}`;

        $(document).find('#buy-now').attr('href', src);

        var d_price = parseInt(dsales_price) * parseInt(count - 1);
        var dm_price = parseInt(dmrp_price) * parseInt(count - 1);


        $(document).find('.dsale-price').html(d_price);
        $(document).find('.dmrp-price').html(dm_price);
        load_price();

    });


    $(document).on('click','#minus', function(){
        var count = $(document).find('#dquantity-pro').val();
        count = parseInt(count) > 1   ? parseInt(count) - 1 : 1;
        $(document).find('#dquantity-pro').val(count);
        dqty = count;
        var src = `{{url('checkout/buynow')}}?product_id=${proid}&color_id=${dcolor_id}&size_id=${dsize_id}&qty=${count}`;

        $(document).find('#buy-now').attr('href', src);
        var d_price = parseInt(dsales_price) * parseInt(count);
        var dm_price = parseInt(dmrp_price) * parseInt(count);


        $(document).find('.dsale-price').html(d_price);
        $(document).find('.dmrp-price').html(dm_price);
        load_price();
    });

});
$(document).ready(function(){
    $("#share_icons").click(function(){
       $("#div3").fadeToggle(500);
    });


});

$(".btn-wishlist").click(function () {
$(".account-dropdown").show();
});

$(document).click(function (e) {
if (!$(e.target).hasClass("btn-wishlist")
&& $(e.target).parents(".account-dropdown").length === 0)
{
$(".account-dropdown").hide();
}
});

$(document).find('.search-icon').click(function(){
$(document).find('.search-wrapper').toggleClass('open');
    $('body').toggleClass('search-wrapper-open');
});
$(document).find('.search-cancel').click(function(){
$(document).find('.search-wrapper').removeClass('open');
$('body').removeClass('search-wrapper-open');
});

$(function(){
        $(document).find("[data-toggle=popover]").popover({html : true,content: function() {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        },
        title: function() {
            var title = $(this).attr("data-popover-content");
            return $(title).children(".popover-heading").html();
        }
    });
});
</script>
@endpush
