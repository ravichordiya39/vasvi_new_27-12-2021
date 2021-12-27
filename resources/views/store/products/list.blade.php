<div class="row products-list columns-4">
@if(count($searchproducts) > 0)
  @foreach($searchproducts as $product)
    <div class="col-md-4 col-sm-4 ">
        <div class="item">
                   <div class="product-card">
                      <i class="fa fa-lg fa-heart-o" id="fa-heart" data-id="{{$product['id']}}" data-product="{{}}"></i>
                      <div>
                         <div id="f1_container">
                            <div id="f1_card" class="shadow">
                                <?php $l = 0; ?>
                                @foreach($product['simage'] as $img)

                                        <?php $l++; ?>
                                        @if($l === 1)
                                            <div class="front face">
                                              <a href="{{url('/')}}/{{$product['slug']}}">
                                                <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                              </a>
                                            </div>
                                        @elseif($l === 2)
                                            <div class="back face center">
                                               <a href="{{url('/')}}/{{$product['slug']}}">
                                                <img src="{{asset("file")}}/{{$img}}" class="img-responsive" alt="" style="height : 100%;">
                                               </a>
                                            </div>
                                        @endif
                                @endforeach
                            </div>
                         </div>
                      </div>
                      <div class="text-caption">
                         <p><strong>{{$product['category']}}</strong> {{$product['name']}}</p>
                         <p> <span class="price-txt">Rs.<?php echo $product['single_sales_price']; ?></span> 
                         <?php if(isset($product['discount_type']) && $product['discount_type'] != "") { ?>
                         <span class="price-oveline">Rs.{{$product['single_mrp_price']}}</span>
                         <?php } ?>
                         <span class="discount-text">
                            <?php echo $product['discount']; ?>
                            <?php if($product['discount_type'] ==1) { echo "%"; }
                            elseif($product['discount_type'] ==2){ echo "Flat"; }else {} ?>
                         </span></p>
                         <p class="pro-rating">
                            @if(count($product['reviews']) > 0)
                                @if($product['rating'] >= 1)
                                    <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                @else
                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                @endif

                                @if($product['rating'] >= 2)
                                    <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                @else
                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                @endif

                                @if($product['rating'] >= 3)
                                    <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                @else
                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                @endif

                                @if($product['rating'] >= 4)
                                    <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                @else
                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                @endif

                                @if($product['rating'] >= 5)
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


                            ({{count($product['reviews'])}})
                         </p>
                      </div>
                      <div class="caption-hover">
                        <a href="" class="prod-info" id="{{$product['id']}}">QUICK VIEW</a>
                      </div>
                      <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                   </div>
        </div>
    </div>
    @endforeach
 @endif
  </div>
