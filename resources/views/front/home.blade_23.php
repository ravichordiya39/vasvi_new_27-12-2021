@extends('layouts.front')

@section('content')

<section class="top-banner">
         <div  class="container-fluid padlr0">
            <div class="row">
               <div class="col-lg-12">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                     <!-- Indicators -->
                     <ol class="carousel-indicators">
                     <?php if(count($banners)>0){
                            $i = 0;
                            foreach($banners as $banner){
                            if($i==0){
                      ?>  
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" class="active"></li>
                        <?php }else{ ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>"></li>
                        <?php  }
                        $i++; }
                        } ?>
                      
                     </ol> 
                     <!-- Wrapper for slides -->
                     <div class="carousel-inner" role="listbox">
                        
                        <?php if(count($banners)>0){
                            $i = 1;
                            foreach($banners as $banner){

                                if($i==1){
                                 ?>  
                                <div class="item active">
                                    <img style="max-width: 100%;" src="<?php echo asset('storage/slider/'.$banner->image.'');?>" alt="Slider">
                                 </div>
                                <?php }else{ ?>
                                <div class="item">
                                    <img style="max-width: 100%;" src="<?php echo asset('storage/slider/'.$banner->image.'');?>" alt="Slider">
                                 </div>
                               <?php  }
                            $i++; }
                           

                        } ?>
                        


                     </div>
                     <!-- Controls -->
                     <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                     <i class="fas fa-arrow-left"></i>
                     </a>
                     <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                     <i class="fas fa-arrow-right"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
    <!--Slider Section end here-->
    <!-- New Arrivals Section start here -->
    <section class="top-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 heading-title text-center">
                    <h2 class="title-txt">New Arrivals</h2>
                    <img src="{{ asset('front_assets/images/headline.png') }}">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="side-img col-md-12">
                            <img height="90%" class="img-fluid" src="{{ asset('front_assets/images/fmix.jpg') }}"
                                alt="women" />
                        </div>
                        <div class="side-img col-md-12">
                            <img height="90%" class="img-fluid" src="{{ asset('front_assets/images/easy.jpg') }}"
                                alt="women" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img style="height: 504px;" class="img-fluid" src="{{ asset('front_assets/images/fsuit.jpg') }}"
                        alt="women" />
                </div>
            </div>
        </div>
    </section>
    <!-- New Arrivals Section start here -->>
    <!--Proudct item Slider Start here-->
    <div style="padding-top:60px;">
    <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home-product product-slider">
                        <div class="owl-carousel owl-theme home-product-slider" id="section_featured">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Proudct item Slider end here-->
    <!--View all deals Section start here-->
   

    <!--View all deals Section end here-->
    <!--Best Seller Section start here-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center heading-title">
                    <h2 class="title-txt">Best Seller</h2>
                    <img src="{{ asset('front_assets/images/headline.png') }}">
                </div>
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="catImg">
                                <img src="{{ asset('front_assets/images/bestsle0.jpg') }}" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="catImg">
                                <img src="{{ asset('front_assets/images/bestsle1.jpg') }}" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Best Seller Section start here-->
    <!--Proudct item Slider Start here-->
    <section class="colorfulbg">
        <div style="padding-top:60px;" >
            <div class="container" >
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-product best_seller">
                            <div class="owl-carousel owl-theme  home-product-slider" id="bestSeller">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Proudct item Slider end here-->
    <!--Vasvi Exclusive Slider Start here-->
  
    <section>
       
        <div class="col-md-12 text-center heading-title">
            <h2 class="title-txt">Vasvi Exclusive</h2>
            <img src="{{ asset('front_assets/images/headline.png') }}">
        </div>
        @if(count($banners)>0)
        @foreach($banners as $banner)
        @if($loop->iteration==1)
        <section class="vasvi-offer-banner"><img src="{{ $banner->photo->url}}" alt="" /> </section>
        @endif
        @endforeach
       @endif
        <div class="exclusive-bg"></div>
        <div style="padding-top:60px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-product vasvi_exclusive_slider">
                            <div class="owl-carousel owl-theme home-product-slider" id="exclusive">
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <!-- Customer Reviews Section end -->
    <!-- Blog Section start here -->
    <!-- <div class="container">
        <div class="row  ">
            <div class="col-md-12 text-center heading-title">
                <h2 class="title-txt">Latest Blog</h2>
                <img src="{{ asset('front_assets/images/headline.png') }}">
            </div>
        </div>
        <div class="row justify-content-center ">
            <div class="col-lg-3 col-md-3">
                <div class="home-blog d-block">
                    <img class="img-fluid" src="{{ asset('front_assets/images/blog1.jpg') }}" alt="blog" />
                    <div class="home-blog-content">
                        <div class="home-blog-title"><a href="#">Trends 2018</a></div>
                        <div class="home-blog-text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="home-blog d-block">
                    <img class="img-fluid" src="{{ asset('front_assets/images/blog1.jpg') }}" alt="blog" />
                    <div class="home-blog-content">
                        <div class="home-blog-title"><a href="#">Trends 2018</a></div>
                        <div class="home-blog-text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="home-blog d-block">
                    <img class="img-fluid" src="{{ asset('front_assets/images/blog2.jpg') }}" alt="blog" />
                    <div class="home-blog-content">
                        <div class="home-blog-title"><a href="#">Trends 2018</a></div>
                        <div class="home-blog-text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="home-blog d-block">
                    <img class="img-fluid" src="{{ asset('front_assets/images/blog2.jpg') }}" alt="blog" />
                    <div class="home-blog-content">
                        <div class="home-blog-title"><a href="#">Trends 2018</a></div>
                        <div class="home-blog-text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Blog Section end here -->

@endsection
@push('custom-scripts')
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
                   console.log((v.product_product_images).length > 0);
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
                                        <p> <span class="price-txt">Rs.${v.sales_price}</span> <span class="price-oveline">Rs.${v.mrp_price}</span>
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
                    console.log((v.product_product_images).length > 0);
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
                                        <p> <span class="price-txt">Rs.${v.sales_price}</span> <span class="price-oveline">Rs.${v.mrp_price}</span>
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
                 //Featured Section Script
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
                    console.log((v.product_product_images).length > 0);
                   var imgfirst="{{asset('front_assets/images/ARP3514.jpg')}}";
                   var imgsecond="{{asset('front_assets/images/ARP3514.jpg')}}";

                   if ((v.product_product_images).length > 0) {
                    //    console.log(v.product_product_images[0].file_name,v.product_product_images[1].file_name)
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
                                        <p> <span class="price-txt">Rs.${v.sales_price}</span> <span class="price-oveline">Rs.${v.mrp_price}</span>
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
