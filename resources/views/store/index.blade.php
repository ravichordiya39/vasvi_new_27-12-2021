@extends('store.layouts.app')

@section('title', 'Vasvi - Ecommerce shopping Platform')
@section('meta_keywords', 'Vasvi.in, Ecommerce, Shopping, Mens, Woman, Kids, Cloth')
@section('meta_description', 'Ecommerce website to buy a product in quantity or bulk with lots of discount')


@push('styles')
<style>
     .mp-0{
            margin : 0;
            padding: 0px;
        }
        .insta-box{
            position: relative;
        }
        #feed-box{
            position: absolute;
            bottom : 5px;
            text-align: center;
            left : 30%;
        }

        .insta-box:hover{
            background-color:#000;
            opacity:0.5;
        }
</style>
@endpush

@section('content')
<div class="headertopspace"></div>
<!--Slider Section start here-->
<section class="top-banner">
   <div  class="container-fluid padlr0">
      <div class="row">
         <div class="col-lg-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
               <!-- Indicators -->
               <ol class="carousel-indicators">
                @if(count($banners)>0)
                <?php $i = 0; ?>
                    @foreach($banners as $banner)
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="@if($i === 0) active @endif" data-slide-to="{{$i}}"></li>
                    <?php $i++; ?>
                    @endforeach
                @endif

               </ol>
               <!-- Wrapper for slides -->
               <div class="carousel-inner" role="listbox">
                @if(count($banners)>0)
                    <?php $i = 0;?>
                    @foreach($banners as $banner)
                       <?php $i++;?>

                        <div class="item @if($i ===1) active @endif">
                            <a href="{{$banner->url}}" target="_blank">
                            <img style="max-width: 100%;" src="<?php echo asset('file/'.$banner->image.'');?>" alt="Slider">
                            </a>
                        </div>

                    @endforeach
                @endif
               </div>
               <!-- Controls -->
               <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
               <i class="fas  fa-angle-left"></i>
               </a>
               <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
               <i class="fas  fa-angle-right"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
</section>
<!--Slider Section end here-->
<!-- New Arrivals Section start here -->
@if(count($newarrivals) > 0)
<section class="top-banner">
    <div class="leaf1 leaf2"><img src="{{asset('front_assets/images/leaf_img.jpg')}}"></div>
    <div class="leaf1"><img src="{{asset('front_assets/images/leaf_img.jpg')}}"></div>
   <div class="container">
      <div class="row">
         <div class="col-md-12 heading-title text-center">
            <h2 class="title-txt">New Arrivals</h2>
            <img src="{{asset('store/images/headline.png')}}">
         </div>
         <?php $j= 0; ?>
         <div class="col-md-6">
            <div class="row">
                @foreach($newarrivals as $new)
                    <?php $j++ ; ?>
                    @if($j === 1 || $j === 2)
                    <div class="root-img-box">
                        <div class="side-img col-md-12">
                            <a href="{{$new->link}}" target="_blank">
                            <img height="90%" class="img-fluid" src="{{ asset("file/$new->image") }}" alt="{{$new->image}}" />
                            </a>
                        </div>
                    </div>
                    @endif
                @endforeach
         </div>
         </div>
         <?php $k = 0; ?>
            @foreach($newarrivals as $new)
            <?php $k++; ?>
                @if($k === 3)
                <div class="col-md-6 bigss">
                    <div class="root-img-box">
                        <a href="{{$new->link}}" target="_blank">
                         <img class="img-fluid" src="{{ asset("file/$new->image") }}" alt="{{$new->image}}" />
                        </a>
                    </div>
                </div>
                @endif
            @endforeach

      </div>
   </div>
</section>
@endif
<!-- New Arrivals Section start here -->
<!--Proudct item Slider Start here-->
@if(count($trending)>0)
<div>
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="home-product product-slider">
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
                                    <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                    </a>
                                 </div>
                                @elseif($c === 2)
                                 <div class="back face center" data-id="{{$trendin['id']}}">
                                    <a href="{{url('/')}}/{{$trendin['slug']}}">
                                    <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                    </a>
                                 </div>
                                @endif

                                @endforeach
                              </div>
                           </div>
                        </div>
                        <div class="text-caption">
                           <p> <!-- <strong>{{$trendin['category']}}</strong>  --> {{$trendin['name']}}</p>
                           <p> <span class="price-txt">Rs.{{$trendin['single_sales_price']}}</span>
                            <?php if(isset($trendin['discount_type']) && $trendin['discount_type'] != "") { ?>
                           <span class="price-oveline">Rs.{{$trendin['single_mrp_price']}}</span>
                           <?php } ?>
                              <span class="discount-text">
                                {{$trendin['discount']}}
                                <?php
                                if($trendin['discount_type'] ==1)
                                   { echo "%"; }
                                elseif($trendin['discount_type'] ==2)
                                { echo "Flat"; }
                                else {}
                                ?>
                              </span>
                            </p>
                           <p class="pro-rating">
                            @if(count($trendin['reviews']) > 0)
                                @if($trendin['rating'] >= 1)
                                <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                @else
                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                @endif

                                @if($trendin['rating'] >= 2)
                                <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                @else
                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                @endif

                                @if($trendin['rating'] >= 3)
                                <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                @else
                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                @endif

                                @if($trendin['rating'] >= 4)
                                <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                @else
                                    <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                @endif

                                @if($trendin['rating'] >= 5)
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
@endif

@if(count($bestsellers)>0)
<section>
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center heading-title">
            <h2 class="title-txt">Best Seller</h2>
            <img src="{{asset('store/images/headline.png')}}">
         </div>
         <div class="col-xs-12">
            <div class="row">
                @foreach($bestsellers as $best)
                <div class="col-sm-6 col-xs-12">
                    <div class="catImg">
                      <a href="{{$best->link}}" target="_blank">
                        <img src="{{ asset("file/$best->image") }}" alt="{{$best->image}}" class="img-responsive">
                      </a>
                    </div>
                </div>
                @endforeach
            </div>
         </div>
      </div>
   </div>
</section>
@endif
@if(count($hotesale) > 0)
<section class="colorfulbg">
   <div style="padding-top:60px;">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="home-product best_seller">
                  <div class="owl-carousel owl-theme  home-product-slider">
                    @foreach($hotesale as $hotesaledata)
                     <div class="item">
                        <div class="product-card">
                           <div>
                              <div id="f1_container">
                                 <div id="f1_card" class="shadow">
                                    <?php $h = 0; ?>
                                    @foreach($hotesaledata['images'] as $img)
                                     <?php $h++; ?>
                                     @if($h === 1)
                                    <div class="front face">
                                        <a href="{{url('/')}}/{{$hotesaledata['slug']}}">
                                       <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                        </a>
                                    </div>
                                    @elseif($h === 2)
                                    <div class="back face center" data-id="{{$trendin['id']}}">
                                        <a href="{{url('/')}}/{{$hotesaledata['slug']}}">
                                       <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                           <div class="text-caption">
                              <p><!--<strong>{{$hotesaledata['category']}}</strong> --> {{$hotesaledata['name']}}</p>
                              <p> <span class="price-txt">Rs.{{$hotesaledata['single_sales_price']}}</span> 
                               <?php if(isset($hotesaledata['discount_type']) && $hotesaledata['discount_type'] != "") { ?>
                              <span class="price-oveline">Rs.{{$hotesaledata['single_mrp_price']}}</span>
                              <?php } ?>
                                <span class="discount-text">
                                    {{$hotesaledata['discount']}}
                                   @if($hotesaledata['discount_type'] ==1)
                                       %
                                   @elseif($hotesaledata['discount_type'] ==2)
                                       Flat
                                   @else

                                   @endif
                                </span>
                              </p>
                              <p class="pro-rating">
                                @if(count($hotesaledata['reviews']) > 0)
                                    @if($hotesaledata['rating'] >= 1)
                                    <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                    @else
                                        <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                    @endif

                                    @if($hotesaledata['rating'] >= 2)
                                    <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                    @else
                                        <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                    @endif

                                    @if($hotesaledata['rating'] >= 3)
                                    <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                    @else
                                        <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                    @endif

                                    @if($hotesaledata['rating'] >= 4)
                                    <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                    @else
                                        <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                    @endif

                                    @if($hotesaledata['rating'] >= 5)
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


                            ({{count($hotesaledata['reviews'])}})
                              </p>
                           </div>
                           <div class="caption-hover">
                               <a href="" class="prod-info" id="{{$hotesaledata['id']}}">QUICK VIEW</a>
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
@if(count($latest)>0)
<section>
    <div class="col-md-12 text-center heading-title">
          <h2 class="title-txt">Latest</h2>
          <img src="{{asset('store/images/headline.png')}}">
      </div>
    <section class="vasvi-offer-banner">
       <div class="container">
        @if($latestbanner)

                  <a href="{{$latestbanner->url}}" target="_blank"><img src="{{ asset("file/$latestbanner->image")}}" alt="" /></a>

        @endif
        </div>
     </section>
     <div style="padding-top:60px;">
          <div class="container">
             <div class="row">
                <div class="col-lg-12">
                   <div class="home-product vasvi_exclusive_slider">
                      <div class="owl-carousel owl-theme home-product-slider">
                        @foreach($latest as $latestdata)
                         <div class="item">
                            <div class="product-card">
                               <div>
                                  <div id="f1_container">

                                     <div id="f1_card" class="shadow">
                                        <?php $l = 0; ?>
                                        @foreach($latestdata['images'] as $img)
                                         <?php $l++; ?>
                                         @if($l === 1)

                                            <div class="front face">
                                                <a href="{{url('/')}}/{{$latestdata['slug']}}">
                                            <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                                </a>
                                            </div>
                                         @elseif($l === 2)
                                            <div class="back face center" data-id="{{$trendin['id']}}">
                                                <a href="{{url('/')}}/{{$latestdata['slug']}}">
                                            <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                                </a>
                                            </div>
                                         @endif
                                        @endforeach
                                     </div>

                                  </div>
                               </div>
                               <div class="text-caption">
                                  <p><!--<strong>{{$latestdata['category']}}</strong> --> {{$latestdata['name']}}</p>
                                  <p> <span class="price-txt">Rs.{{$latestdata['single_sales_price']}}</span> 
                                   <?php if(isset($latestdata['discount_type']) && $latestdata['discount_type'] != "") { ?>
                                  <span class="price-oveline">Rs.{{$latestdata['single_mrp_price']}}</span>
                                  <?php } ?>
                                    <span class="discount-text">
                                       {{$latestdata['discount']}}
                                       @if($latestdata['discount_type'] ==1)
                                         %
                                       @elseif($latestdata['discount_type'] ==2)
                                         Flat
                                       @else

                                       @endif
                                    </span>
                                  </p>
                                  <p class="pro-rating">
                                    @if(count($latestdata['reviews']) > 0)
                                        @if($latestdata['rating'] >= 1)
                                        <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                        @else
                                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                        @endif

                                        @if($latestdata['rating'] >= 2)
                                        <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                        @else
                                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                        @endif

                                        @if($latestdata['rating'] >= 3)
                                        <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                        @else
                                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                        @endif

                                        @if($latestdata['rating'] >= 4)
                                        <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                        @else
                                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                        @endif

                                        @if($latestdata['rating'] >= 5)
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


                                ({{count($latestdata['reviews'])}})
                                  </p>
                               </div>
                               <div class="caption-hover">
                                  <a href="" class="prod-info" id="{{$latestdata['id']}}">QUICK VIEW</a>
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

<section class="insta-title">
    <div class="container">
      <h2>FIND US ON INSTAGRAM <br> <a href="https://www.instagram.com/vasvi_jaipur/" target="_new">@vasvi</a></h2>
      <div class="instaload-posts">
          <div class="text-center">
                <img src="{{asset('store/images/loading.gif')}}" />
          </div>
      </div>
         {{-- <div class="row">
                <div class="col-lg-12">
                   <div class="home-product vasvi_exclusive_slider">
                      <div class="owl-carousel owl-theme home-product-slider">
                        @foreach($trending as $trend)
                         <div class="item">
                            <div class="product-card">
                               <div>
                                  <div id="f1_container">
                                     <div id="f1_card" class="shadow">
                                        <?php $l = 0; ?>
                                        @foreach($trend['images'] as $img)
                                         <?php $l++; ?>
                                         @if($l === 1)
                                        <div class="front face">
                                            <a href="{{url('/')}}/{{$trend['slug']}}">
                                           <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                            </a>
                                        </div>
                                        @elseif($l === 2)
                                        <div class="back face center" data-id="{{$trendin['id']}}">
                                            <a href="{{url('/')}}/{{$trend['slug']}}">
                                           <img src="<?php echo asset("file/$img");?>" class="img-responsive" alt="" style="height : 100%;">
                                            </a>
                                        </div>
                                        @endif
                                        @endforeach
                                     </div>
                                  </div>
                               </div>
                               <div class="text-caption">
                                  <p><strong>{{$trend['category']}}</strong> {{$trend['name']}}</p>
                                  <p> <span class="price-txt">Rs.{{$trend['single_sales_price']}}</span> 
                                   <?php if(isset($trend['discount_type']) && $trend['discount_type'] != "") { ?>
                                  <span class="price-oveline">Rs.{{$trend['single_mrp_price']}}</span>
                                  <?php } ?>
                                    <span class="discount-text">
                                        {{$trend['discount']}}
                                        @if($trend['discount_type'] ==1)
                                        %
                                        @elseif($trend['discount_type'] ==2)
                                            Flat
                                        @else

                                        @endif
                                    </span>
                                  </p>
                                  <p class="pro-rating">
                                    @if(count($trend['reviews']) > 0)
                                        @if($trend['rating'] >= 1)
                                        <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                        @else
                                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                        @endif

                                        @if($trend['rating'] >= 2)
                                        <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                        @else
                                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                        @endif

                                        @if($trend['rating'] >= 3)
                                        <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                        @else
                                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                        @endif

                                        @if($trend['rating'] >= 4)
                                        <i class="fa fa-star"  aria-hidden="true" style="color: #FB8071"></i>
                                        @else
                                            <i class="fa fa-star"  aria-hidden="true" style="color: grey"></i>
                                        @endif

                                        @if($trend['rating'] >= 5)
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


                                ({{count($trend['reviews'])}})
                                  </p>
                               </div>
                               <div class="caption-hover">
                                  <a href="" class="prod-info" id="{{$trend['id']}}">QUICK VIEW</a>
                               </div>
                               <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                            </div>
                         </div>
                         @endforeach

                      </div>
                   </div>
                </div>
         </div> --}}
    </div>
</section>


<!-- Customer Reviews Section start -->
<section class="client-review">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center heading-title">
            <h2 class="title-txt">What our customer says</h2>
            <img src="{{asset('store/images/headline.png')}}">
         </div>
         <div class="owl-carousel owl-theme col-md-12">
            <?php $tests = \App\Models\Testimonial::get(); ?>
            @if(count($tests) > 0)
               @foreach($tests as $test)
                <div class="item">
                    <div class="col-lg-3 text-center">
                    <img class="imground client-img mx-auto"  src="{{asset('file')}}/{{$test->image}}" width="60" alt="customer">
                    <h4 class="client-name">{{$test->full_name}}</h4>
                    <p class="client-location ml-4" style="font-weight : bold;">{{$test->city}} </p>
                    </div>
                    <div class="col-lg-9">
                    <div class="testimonial-text">
                        <p>{{substr($test->description, 0, 210)}}</p>
                    </div>
                    </div>
                </div>
               @endforeach
            @endif
         </div>
      </div>
   </div>
</section>
<!-- Customer Reviews Section end -->
@endsection

@push('scripts')
<script>
    var html = null;
    $(function(){
        $.ajax({
            type: "GET",
            url: "{{route('instagram.posts')}}",
            data: {},
            success: function (response) {
                console.log(response);
                $(document).find('.instaload-posts').html('');
                $(document).find('.instaload-posts').html(response.html);
            }
        });
    })
</script>
@endpush
