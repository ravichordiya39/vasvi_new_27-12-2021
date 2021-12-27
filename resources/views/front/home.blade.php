@extends('layouts.front')

@section('content')

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

                              <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li>
                              <?php $i++; ?>
                            @endforeach
                      @endif
                       {{--previous code
                         if(count($banners)>0){
                            $i = 0;
                            foreach($banners as $banner){
                            if($i==0){
                             <li data-target="#carousel-example-generic" data-slide-to="$i" class="active"></li>
                            }else{
                             <li data-target="#carousel-example-generic" data-slide-to="$i"></li>
                             }
                            $i++; }
                        }
                       --}}
                     </ol>
                     <!-- Wrapper for slides -->
                     <div class="carousel-inner" role="listbox">

                        <?php if(count($banners)>0){
                            $i = 1;
                            foreach($banners as $banner){

                                if($i==1){
                                 ?>
                                <div class="item active">
                                    <a href="{{$banner->url}}" target="_blank">
                                    <img style="max-width: 100%;" src="<?php echo asset('file/'.$banner->image.'');?>" alt="Slider">
                                    </a>
                                 </div>
                                <?php }else{ ?>
                                <div class="item">
                                    <a href="{{$banner->url}}" target="_blank">
                                    <img style="max-width: 100%;" src="<?php echo asset('file/'.$banner->image.'');?>" alt="Slider">
                                    </a>
                                 </div>
                               <?php  }
                            $i++; }


                        } ?>



                     </div>
                     <!-- Controls -->
                     <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                     <i class="fas fa-angle-left"></i>
                     </a>
                     <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                     <i class="fas fa-angle-right"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
    <!--Slider Section end here-->

   <!-- <div class="bulkorder">
    <img src="{{ asset('front_assets/images/carts.png') }} " class="float-pulseit">
    </div>--->

    <!-- New Arrivals Section start here -->

    <section class="top-banner top_trending">
        <div class="leaf1 leaf2"><img src="{{ asset('front_assets/images/leaf_img.jpg') }}"></div>
        <div class="leaf1"><img src="{{ asset('front_assets/images/leaf_img.jpg') }}"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 heading-title text-center">
                    <h2 class="title-txt">Trending </h2>
                    <img src="{{ asset('front_assets/images/headline.png') }}">
                </div>
                <?php $j= 0; ?>
                <div class="col-md-6">
                    <div class="row">
                        @foreach($newarrivals as $new)
                        <?php $j++ ; ?>
                        @if($j === 1 || $j === 2)
                        <div class="side-img col-md-12">
                            <a href="{{$new->link}}" target="_blank">
                            <img height="90%" class="img-fluid" src="{{ asset("file/$new->image") }}"
                                alt="{{$new->image}}" />
                            </a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 bigss">
                    <?php $k = 0; ?>
                    @foreach($newarrivals as $new)
                    <?php $k++; ?>
                       @if($k === 3)
                       <a href="{{$new->link}}" target="_blank">
                       <img class="img-fluid" src="{{ asset("file/$new->image") }}" alt="{{$new->image}}" />
                       </a>
                       @endif

                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- New Arrivals Section start here -->
    <!--Proudct item Slider Start here-->
<?php if(count($trending)>0){ ?>
    <div style="padding-top:60px;">
    <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <div class="home-product product-slider">
                     <div class="owl-carousel owl-theme home-product-slider">

                     <?php
                            foreach($trending as $trendin){
                                 ?>
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
                                                <img src="<?php echo asset("file/$img->file_name");?>" class="img-responsive" alt="">
                                            </div>
                                         @elseif($c === 2)
                                            <div class="back face center">
                                                <img src="{{asset("file")}}/{{$img->file_name}}" class="img-responsive" alt="">
                                            </div>
                                         @endif
                                        @endforeach
                                    </div>
                                 </div>
                              </div>
                              <div class="text-caption">
                                 <p> <?php echo $trendin['name'];?></p>
                            <p> <span class="price-txt">  Rs.<?php echo $trendin['single_sales_price'];?></span> 
                            <?php if(isset($trendin['discount_type']) &&  $trendin['discount_type'] != "") { ?>
                            <span class="price-oveline"> Rs.<?php echo $trendin['single_mrp_price'];?></span> 
                            <?php } ?>
                            <span class="discount-text">
                                <?php echo $trendin['discount']; ?>
                                <?php if($trendin['discount_type'] ==1) { echo "%"; }
                                elseif($trendin['discount_type'] ==2){ echo "Flat"; }else {} ?></span></p>
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
                                <a href="" class="prod-info" id="{{$trendin['id']}}" >QUICK VIEW</a>

                              <!---   <span class="circle-size"  >
                                    <p>Select Size </p>
                                    <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                 </span>
                                 <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                 <div class="text-caption">
                                 <p><strong> <?php echo $trendin['category'];?></strong>   <?php echo $trendin['name'];?></p>
                                 </div>
                                 <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                 --->
                              </div>
                              <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                           </div>
                        </div>

                            <?php }  ?>

                     </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

    <!--Proudct item Slider end here-->
    <!--View all deals Section start here-->


    <!--View all deals Section end here-->
    <!--Best Seller Section start here-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center heading-title">
                    <h2 class="title-txt">Hot Sales </h2>
                    <img src="{{ asset('front_assets/images/headline.png') }}">
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        @foreach($bestsellers as $best)
                        <div class="col-sm-6 col-xs-12">
                            <div class="catImg">
                                <a href="{{$best->link}}" target="_blank">
                                <img src="{{ asset("file/$best->image") }}" class="img-responsive" alt="{{$best->image}}">
                                </a>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="col-sm-6 col-xs-12">
                            <div class="catImg">
                                <img src="{{ asset('front_assets/images/bestsle1.jpg') }}" class="img-responsive">
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Best Seller Section start here-->
    <!--Proudct item Slider Start here-->
    <?php if(count($hotesale)>0){ ?>
    <div style="padding-top:60px;">
    <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <div class="home-product product-slider">
                     <div class="owl-carousel owl-theme home-product-slider">

                     <?php
                            foreach($hotesale as $hotesaledata){
                                 ?>
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
                                                <img src="<?php echo asset("file/$img->file_name");?>" class="img-responsive" alt="">
                                            </div>
                                         @elseif($h === 2)
                                            <div class="back face center">
                                                <img src="{{asset("file")}}/{{$img->file_name}}" class="img-responsive" alt="">
                                            </div>
                                         @endif
                                        @endforeach
                                    </div>
                                 </div>
                              </div>
                              <div class="text-caption">
                                 <p> <?php echo $hotesaledata['name'];?></p>
                            <p> <span class="price-txt">  Rs.<?php echo $hotesaledata['single_sales_price'];?></span> 
                            <?php if(isset($hotesaledata['discount_type']) &&  $hotesaledata['discount_type'] != "") { ?>
                            
                            <span class="price-oveline"> Rs.<?php echo $hotesaledata['single_mrp_price'];?></span> 
                            <?php } ?>
                            <span class="discount-text">
                                <?php echo $hotesaledata['discount']; ?>
                                <?php if($hotesaledata['discount_type'] ==1) { echo "%"; }
                                elseif($hotesaledata['discount_type'] ==2){ echo "Flat"; }else {} ?></span></p>
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

                                                          <a href="" class="prod-info" id="{{$hotesaledata['id']}}" >QUICK VIEW</a>
                                 <!---<span class="circle-size"  >
                                    <p>Select Size </p>
                                    <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                 </span>
                                 <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                 <div class="text-caption">
                                 <p><strong> <?php echo $hotesaledata['category'];?></strong>   <?php echo $hotesaledata['name'];?></p>
                                 </div>
                                 <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>--->
                              </div>
                              <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                           </div>
                        </div>

                            <?php }  ?>

                     </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!--Proudct item Slider end here-->
    <!--Vasvi Exclusive Slider Start here-->
    <?php if(count($latest)>0){ ?>
    <section>

        <div class="col-md-12 text-center heading-title">
            <h2 class="title-txt">Latest</h2>
            <img src="{{ asset('front_assets/images/headline.png') }}">
        </div>

        @if(count($banners)>0)
        @foreach($banners as $banner)
        @if($loop->iteration==1)
        <section class="vasvi-offer-banner">
            <div class="container">
                <a href="{{$banner->url}}" target="_blank">
                <img src="{{ asset("file/$banner->image")}}" alt="" />
                </a>
            </div>
        </section>
        @endif
        @endforeach
       @endif
        <div class="exclusive-bg"></div>
        <div style="padding-top:60px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <div class="home-product product-slider">
                     <div class="owl-carousel owl-theme home-product-slider">

                     <?php
                            foreach($latest as $latestdata){
                                 ?>
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
                                                <img src="<?php echo asset("file/$img->file_name");?>" class="img-responsive" alt="">
                                            </div>
                                         @elseif($l === 2)
                                            <div class="back face center">
                                                <img src="{{asset("file")}}/{{$img->file_name}}" class="img-responsive" alt="">
                                            </div>
                                         @endif
                                        @endforeach
                                    </div>
                                 </div>
                              </div>
                              <div class="text-caption">
                                 <p> <?php echo $latestdata['name'];?></p>
                            <p> <span class="price-txt">  Rs.<?php echo $latestdata['single_sales_price'];?></span>
                             <?php if(isset($latestdata['discount_type']) &&  $latestdata['discount_type'] != "") { ?>
                            <span class="price-oveline"> Rs.<?php echo $latestdata['single_mrp_price'];?></span> 
                            <?php } ?>
                            <span class="discount-text">
                                <?php echo $latestdata['discount']; ?>
                                <?php if($latestdata['discount_type'] ==1) { echo "%"; }
                                elseif($latestdata['discount_type'] ==2){ echo "Flat"; }else {} ?></span></p>
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

                                <!-- <a href="" data-toggle="modal" data-target="#quickviews"  class="prod-info">QUICK VIEW</a> -->
                                <a href=""  class="prod-info" id="{{$latestdata['id']}}">QUICK VIEW</a>
                                <!----<span class="circle-size"  >
                                    <p>Select Size </p>
                                    <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                 </span>
                                 <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                 <div class="text-caption">
                                 <p><strong> <?php echo $latestdata['category'];?></strong>   <?php echo $latestdata['name'];?></p>
                                 </div>
                                 <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>--->
                              </div>
                              <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                           </div>
                        </div>
                          <?php }  ?>
                     </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </section>
    <?php } ?>
    <!--Vasvi Exclusive Slider end here-->

    <!-- Customer Reviews Section start -->
    <section class="client-review">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center heading-title">
                    <h2 class="title-txt">What our customer says</h2>
                    <img src="{{ asset('front_assets/images/headline.png') }}">
                </div>
                <div class="owl-carousel owl-theme col-md-12">
                    <div class="item">
                        <div class="col-lg-3">
                        <img class="imground client-img" src="{{ asset('front_assets/images/user-icon1.png') }}"
                                width="60" alt="customer">
                            <h4 class="client-name">Dzone Gupta</h4>
                            <p class="client-location">Jaipur </p>
                        </div>
                        <div class="col-lg-9">
                            <div class="testimonial-text">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen
                                    book.printer took a galley of type and scrambled it to make a type specimen book</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-lg-3">
                            <img class="imground client-img" src="{{ asset('front_assets/images//user-icon2.png') }}"
                                width="60" alt="customer">
                            <h4 class="client-name">Manish Sharma</h4>
                            <p class="client-location">Jaipur </p>
                        </div>
                        <div class="col-lg-9">
                            <div class="testimonial-text">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen
                                    book.printer took a galley of type and scrambled it to make a type specimen book</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-lg-3">
                            <img class="imground client-img" src="{{ asset('front_assets/images/user-icon2.png') }}"
                                width="60" alt="customer">
                            <h4 class="client-name">Manish Sharma</h4>
                            <p class="client-location">Jaipur </p>
                        </div>
                        <div class="col-lg-9">
                            <div class="testimonial-text">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen
                                    book.printer took a galley of type and scrambled it to make a type specimen book</p>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-lg-3">
                            <img class="imground client-img" src="{{ asset('front_assets/images//user-icon2.png') }}"
                                width="60" alt="customer">
                            <h4 class="client-name">Manish Sharma</h4>
                            <p class="client-location">Jaipur </p>
                        </div>
                        <div class="col-lg-9">
                            <div class="testimonial-text">
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen
                                    book.printer took a galley of type and scrambled it to make a type specimen book</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<!-- The Modal -->

<!-- product info -->
<div class="modal products-details Quixck" id="quickviews">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
       </div>
       <div class="modal-body" id="product-box-modal">
       </div>

       <!-- Modal footer -->
       <div class="modal-footer">
       </div>
     </div>
   </div>
 </div>

@push('custom-scripts')
<script>
$(function(){
    var product = [];
   $(document).on('click','.prod-info', function(e){
     e.preventDefault();
     var id = $(this).attr('id');
     var url = "{{url('product')}}" + `/${id}`;
     $.ajax({
         url : url,
         type : 'get',
         success : function(data){
             $(document).find('#product-box-modal').html(data.html);
             $('#quickviews').modal('show');
         },
         error : function(err){
             alert('No response from server');
         }
         });
   });
});

</script>
<script>

                 $(document).ready(function(){
		         var html = '';
                 //Featured Section Script
		         var owl = $('#section_featured').owlCarousel({
		             loop:true,
		             smartSpeed: 100,
		             autoplay: true,
		             autoplaySpeed: 100,
		             mouseDrag: false,
		             margin:10,
		             animateIn: 'slideInUp',
		             animateOut: 'fadeOut',
		             nav:false,
		             responsive:{
		                 0:{
		                     items:1
		                 },
		                 600:{
		                     items:2
		                 },
		                 1000:{
		                     items:3
		                 }
	         	    }
	         	});
               $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $.each(data, function(k, v) {

                   var imgfirst="{{asset('front_assets/images/ARP3514.jpg')}}";
                   var imgsecond="{{asset('front_assets/images/ARP3514.jpg')}}";

                   if ((v.product_product_images).length > 1) {
                    imgfirst="{{asset('storage/product/')}}"+"/"+v.product_product_images[0].file_name;
                    imgsecond="{{asset('storage/product/')}}"+"/"+v.product_product_images[1].file_name;
                   }


			  	var random_num =  Math.floor(Math.random()*60);
                  let h=`<div class="item">
                                <div class="product-card">
                                    <div>
                                    <a id="featured-link-${v.id}" >
                                        <div id="f1_container">
                                            <div id="f1_card" class="shadow">
                                                <div class="front face">



                                       <img src="${imgfirst}" onerror="javascript:this.src='{{asset('front_assets/images/ARP3514.jpg')}}'" alt="">





                                      </div>
                                      <div class="back face center">


                                       <img src="${imgsecond}" onerror="javascript:this.src='{{asset('front_assets/images/ARP3514.jpg')}}'" alt="">


                                      </div>
                                            </div>
                                        </div>
                                     </a>
                                    </div>
                                    <div class="text-caption">
                                        <p><strong>${v.name}</strong> </p>
                                        <p> <span class="price-txt">Rs.${v.sales_price}</span> 
                                        
                                        <span class="price-oveline">Rs.${v.mrp_price}</span>
                                            <span class="discount-text">${v.discount}%</span></p>
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
                                        <span class="circle-size">
                                            <p>Select Size </p>
                                            <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a
                                                href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                            <p><strong>${v.name}</strong></p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a
                                                href="#">XXL</a></span>
                                    </div>
                                    <div class="icon-wishlist"><button type="button" data-toggle="tooltip"
                                            data-placement="left" title="Save for Later"><i
                                                class="fas fa-heart"></i></button> </div>
                                </div>
                            </div>`;
			    owl.trigger('add.owl.carousel', [jQuery(h)]);
                let id=v.id;
                $( "#featured-link-"+id ).attr( 'href', '{{url("products")}}'+'/'+ id );
			});
			owl.trigger('refresh.owl.carousel');
            });
	});
    </script>
<script>
                 $(document).ready(function(){
		         var html = '';
                 //Featured Section Script
		         var owlnew = $('#exclusive').owlCarousel({
		             loop:true,
		             smartSpeed: 100,
		             autoplay: true,
		             autoplaySpeed: 100,
		             mouseDrag: false,
		             margin:10,
		             animateIn: 'slideInUp',
		             animateOut: 'fadeOut',
		             nav:false,
		             responsive:{
		                 0:{
		                     items:1
		                 },
		                 600:{
		                     items:2
		                 },
		                 1000:{
		                     items:3
		                 }
	         	    }
	         	});
               $.post('{{ route('home.section.exclusive') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $.each(data, function(k, v) {


                   var imgfirst="{{asset('front_assets/images/ARP3514.jpg')}}";
                   var imgsecond="{{asset('front_assets/images/ARP3514.jpg')}}";

                   if ((v.product_product_images).length > 1) {
                    imgfirst="{{asset('storage/product/')}}"+"/"+v.product_product_images[0].file_name;
                    imgsecond="{{asset('storage/product/')}}"+"/"+v.product_product_images[1].file_name;
                   }
			  	var random_num =  Math.floor(Math.random()*60);
                  let h=`<div class="item">
                                <div class="product-card">
                                    <div>
                                    <a id="exclusive-link-${v.id}" >
                                        <div id="f1_container">
                                            <div id="f1_card" class="shadow">
                                                <div class="front face">



                                       <img src="${imgfirst}" onerror="javascript:this.src='{{asset('front_assets/images/ARP3514.jpg')}}'" alt="">





                                      </div>
                                      <div class="back face center">


                                       <img src="${imgsecond}" onerror="javascript:this.src='{{asset('front_assets/images/ARP3514.jpg')}}'" alt="">


                                      </div>
                                            </div>
                                        </div>
                                     </a>
                                    </div>
                                    <div class="text-caption">
                                        <p><strong>${v.name}</strong> </p>
                                        <p> <span class="price-txt">Rs.${v.sales_price}</span> 
                                      
                                        <span class="price-oveline">Rs.${v.mrp_price}</span>
                                        
                                            <span class="discount-text">${v.discount}%</span></p>
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
                                        <span class="circle-size">
                                            <p>Select Size </p>
                                            <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a
                                                href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                            <p><strong>${v.name}</strong></p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a
                                                href="#">XXL</a></span>
                                    </div>
                                    <div class="icon-wishlist"><button type="button" data-toggle="tooltip"
                                            data-placement="left" title="Save for Later"><i
                                                class="fas fa-heart"></i></button> </div>
                                </div>
                            </div>`;
                            owlnew.trigger('add.owl.carousel', [jQuery(h)]);
                            let id=v.id;
                $( "#exclusive-link-"+id ).attr( 'href', '{{url("products")}}'+'/'+ id );
			});
			owlnew.trigger('refresh.owl.carousel');
            });
	});
    </script>
<script>
        $(document).ready(function(){
		         var html = '';
		         var owlnewbest = $('#bestSeller').owlCarousel({
		             loop:true,
		             smartSpeed: 100,
		             autoplay: true,
		             autoplaySpeed: 100,
		             mouseDrag: false,
		             margin:10,
		             animateIn: 'slideInUp',
		             animateOut: 'fadeOut',
		             nav:false,
		             responsive:{
		                 0:{
		                     items:1
		                 },
		                 600:{
		                     items:2
		                 },
		                 1000:{
		                     items:3
		                 }
	         	    }
	         	});
               $.post('{{ route('home.section.bestseller') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $.each(data, function(k, v) {

                   var imgfirst="{{asset('front_assets/images/ARP3514.jpg')}}";
                   var imgsecond="{{asset('front_assets/images/ARP3514.jpg')}}";

                   if ((v.product_product_images).length > 0) {

                    imgfirst="{{asset('storage/product')}}"+"/"+v.product_product_images[0].file_name;
                    imgsecond="{{asset('storage/product')}}"+"/"+v.product_product_images[1].file_name;
                   }
                    let r="{{route('product.view',"+v.id+")}}"
			  	var random_num =  Math.floor(Math.random()*60);
                  let h=`<div class="item">
                                <div class="product-card">
                                    <div>
                                    <a id="bestSeller-link-${v.id}" >
                                        <div id="f1_container">
                                            <div id="f1_card" class="shadow">
                                                <div class="front face">



                                       <img src="${imgfirst}" onerror="javascript:this.src='{{asset('front_assets/images/ARP3514.jpg')}}'" alt="">





                                      </div>
                                      <div class="back face center">


                                       <img src="${imgsecond}" onerror="javascript:this.src='{{asset('front_assets/images/ARP3514.jpg')}}'" alt="">


                                      </div>
                                            </div>
                                        </div>
                                     </a>
                                    </div>
                                    <div class="text-caption">
                                        <p><strong>${v.name}</strong> </p>
                                        <p> <span class="price-txt">Rs.${v.sales_price}</span> 
                                        <span class="price-oveline">Rs.${v.mrp_price}</span>
                                            <span class="discount-text">${v.discount}%</span></p>
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
                                        <span class="circle-size">
                                            <p>Select Size </p>
                                            <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a
                                                href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                            <p><strong>${v.name}</strong></p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a
                                                href="#">XXL</a></span>
                                    </div>
                                    <div class="icon-wishlist"><button type="button" data-toggle="tooltip"
                                            data-placement="left" title="Save for Later"><i
                                                class="fas fa-heart"></i></button> </div>
                                </div>
                            </div>`;
                            owlnewbest.trigger('add.owl.carousel', [jQuery(h)]);
                            let id=v.id;
                $( "#bestSeller-link-"+id ).attr( 'href', '{{url("products")}}'+'/'+ id );
			});
			owlnewbest.trigger('refresh.owl.carousel');
            });
	});
    </script>
@endpush
