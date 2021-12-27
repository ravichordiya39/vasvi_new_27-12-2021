<div class="modal fade" id="sizePopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <?php $img = \App\Models\Category::find($info['subcategory_id']); ?>
            <img src="{{asset('file')}}/{{$img->size_chart}}"style="width : 30%;height : 30%;"/>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
           <div class="row">
              <div class="col-md-12">
                 <main class='main-wrapper'>
                       <article class='product-details-section' id="load-dyimg">
                          <!-- breadcrum with structured data parameters for ga -->
                          <section>
                             <div class="small-img">
                                <img src="{{asset('frontend/images/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
                                <div class="small-container">
                                   <div id="small-img-roll">
                                      <?php $pri_image = '' ;
                                            $count = 0;
                                            $iterate = 0;
                                            $sales_price = 0;
                                            $mrp_price = 0;
                                            $sizes = [];
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
                                               <img src="{{asset('file')}}/{{$image->file_name}}" class="show-small-img" alt="" id="iamsmall" >
                                            @endif

                                          @endforeach
                                        @endif
                                       @endforeach
                                      @endif
                                   </div>
                                </div>
                                <img src="{{asset('frontend/images/online_icon_right@2x1.png')}}" class="icon-right" alt="" id="next-img" >
                             </div>
                             <div class="show" href="{{asset('file')}}/{{$pri_image}}">
                                <img src="{{asset('file')}}/{{$pri_image}}" id="show-img" class="iambig" style="width : 100% !important">
                             </div>
                          </section>
                          <div class='clear'></div>
                       </article>
                 </main>
                 <div for='' id='sizeselected'></div>
              </div>

        </div>

        </div>

        <div class="col-lg-6 quick_right">
            <h2>{{$info['category']}}   {{$info['sub_category']}}  {{$info['child_category']}} - {{$info['name']}}</h2>
            <p>{!!substr($info['details'],0,270)!!}
                @if(strlen($info['details']) > 270)
                  ...
                @endif
            </p>
            <small>SKU: {{$info['sku']}}</small>
            <br>

            <div class="text-price-title">Offer Price</div>
            <div class="product-price"><span class="bold-price"><i class="fas fa-rupee-sign" style="font-size:18px;"></i> <span class="dsale-price">{{$sales_price}}</span></span> 
            <?php if(isset($info['discount_type']) &&$info['discount_type'] != "") { ?>
            <span class="cut-price"><i class="fas fa-rupee-sign" style="font-size:14px;"></i>
               <span class="dmrp-price"> {{$mrp_price}}</span></span>
                <?php } ?>
               <span class="text-success txt-discount">
                   @if($info['discount_type'] === 1)
                     {{$info['discount'] !== null ? $info['discount'] : 0}}%

                   @else
                   <i class="fas fa-rupee-sign" style="font-size:18px;"></i>{{$info['discount']}}Flat
                   @endif
               </span>
            </div>

            <div class="row">
              <div class="col-md-12">
                 <div class="product-size">
                    <ul>
                        <?php $variations = \App\Models\ProductVariation::where('product_id',$info['id'])->where('primary_variation', 1)->groupBy('size_id')->get();

                        ?>
                       @if($variations->count() > 0)
                       <li class="boldtxt">Size</li>
                       <?php $iterator = 0; $size_id = 0;?>
                       @foreach($variations as $var)
                       <?php

                            $dsize = \App\Models\Size::find($var['size_id']);
                           if($var['primary_variation'] === 1){
                              $iterator++;
                              if($iterator === 1){
                                 $size_id = $dsize->id;
                              }
                           }
                        ?>
                       <li data-product="{{$info['id']}}" data-id="{{$dsize->id}}" id="size-circle"><a href="#" id="size-id" data-product="{{$info['id']}}" data-id="{{$dsize->id}}" class="@if($var['size_status'] != 1) disabled @endif @if($iterator === 1) sizepop-active @else sizepop-inactive @endif" >{{$dsize->name}}</a></li>
                       @endforeach

                       <li>
                            <div style="width : 250px;margin-left : 100px;">
                                <i class="fas fa-lg fa-ruler" id="popup-ruler" style="color : grey;"></i>
                                <span style="display : inline-block;font-size:6px important!;" >Size Guide</span>
                            </div>
                        </li>
                      @endif
                    </ul>
                 </div>
                 @if(count($info['variations']) > 0)
                 <div class="product-color">
                    <ul>
                       <li class="boldtxt">Color</li>
                       <div class="color-scale">
                          <ul>
                            <?php $variations = \App\Models\ProductVariation::where('product_id',$info['id'])->groupBy('color_id')->get();
                             $i = 0;
                             $color_id = 0;
                            ?>
                              @foreach($variations as $var)
                              <?php
                                $i++;
                                $color = \App\Models\Color::find($var['color_id']);
                               ?>
                                 <li  class="@if($var['primary_variation'] === 1) <?php $color_id = $color->id; ?>colorpop-active @else colorpop-inactive @endif" data-id="{{$color->id}}"  data-product="{{$info['id']}}" id="color-id"><a href="#" style="background-color:{{$color->value}} !important"></a></li>
                              @endforeach

                          </ul>
                          </div>
                    </ul>
                 </div>
                 @endif
                 <div>
                    <div class="row quantity">
                       <div class="col-md-3" style="padding-right:0px;">
                          <div class="input-group display-flex" >
                             <span class="input-group-btn">
                             <button type="button" class="btn   btn-number" style="background:#ed6388;" id="dminus" data-type="minus" data-field="quant[2]">
                             <span class="glyphicon glyphicon-minus"></span>
                             </button>
                             </span>
                             <input type="text" name="quant[2]" id="dquantity-pro" class="form-control input-number" value="1" min="1" max="100">
                             <span class="input-group-btn">
                             <button type="button" class="btn   btn-number" style="background:#ed6388;" id="dplus" data-type="plus" data-field="quant[2]">
                             <span class="glyphicon glyphicon-plus"></span>
                             </button>
                             </span>
                          </div>
                       </div>
                       <div class="col-md-3">
                          <button type="button" class="btn-wishlist @if($like) pink" data-id="1" @else grey" data-id="0" @endif id="btn-pwishlist"
                          data-product={{$info['id']}}> <i class="fa fa-heart" aria-hidden="true"></i></button>
                           <button id="btn-share" class="btn-wishlist" type="button"> <i class="fas fa-share-alt"></i></button>

                           <div id="div3" class="btn-share" style="display: none; width: 0;">
                           <div class="share_icons">
                               <div class="card card-body">
                                 <div class="footer_social">
                                    <?php
                                        $set = \App\Models\Setting::first();
                                    ?>
                                     <ul>
                                        <li><a href="{{$set->fb_link}}{{url('/')}}/{{$info['slug']}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href={{$set->twitter_link}}{{url('/')}}/{{$info['slug']}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="{{$set->pinterest_link}}{{url('/')}}/{{$info['slug']}}&description={{$info['slug']}}" target="_blank"><i class="fab fa-pinterest"></i></a></li>

                                        <li><a href="{{$set->whatsapp_link}}{{url('/')}}/{{$info['slug']}}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>

                                     </ul>
                                  </div>
                               </div>
                             </div>
                           </div>

                       </div>
                    </div>
                 </div>



                 <div class="row authentic-product-row"  >
                    <div class="col-md-4 text-center" >
                    <i class="fas fa-cloud-meatball"></i>
                    <p> 100% Authentic Products</p>

                    </div>

                    <div class="col-sm-3 text-center" >
                        <i class="fas fa-shipping-fast"></i>
                        <p>Free Shipping*</p>
                      </div>

                      <div class="col-md-4 text-center" >
                           <i class="fab fa-usps"></i>
                           <p>Easy Return Policy</p>
                        </div>
                      </div>

                  <div>
                    <button type="button" class="btn-addcart" id="dbtn-addcart">Add to Cart</button>
                     <a href="{{url('/')}}/{{$info['slug']}}" class="btn btn-buynow" >More Details ></a>
                 </div>

              </div>
           </div>

        </div>
  </div>
