@extends('store.layouts.app')
@section('title', 'Vasvi - ' .request()->segment(1))
@section('meta_keywords', 'Vasvi.in, Ecommerce, Shopping, Mens, Woman, Kids, Cloth')
@section('meta_description', 'Ecommerce website to buy a product in quantity or bulk with lots of discount')
@push('styles')
<style>
    .btn-shift-to-cart{
        background-color: #FB8071;
        color : white;
    }

    .btn-shift-to-cart:hover{
        background-color: #e17365 ;
        color : white;
    }
</style>
@endpush

@section('content')
   <div class="row my-5 py-5" >
       <div class="col-md-6 col-md-offset-3" style="margin-top : 70px;">
           <span style="font-size:24px;font-weight :bold;">Your Wishlist</span><br><br>
          @if($wishlists->count() > 0)
            @foreach($wishlists as $wish)
            <div class="row p-3" style="background-color: #f6f6f6">
                <div class="col-md-3">
                   <img src="{{asset('file')}}/{{$wish->image}}" style="width : 70%;"/>
                </div>
                <div class="col-md-8">
                    <br>
                  <span style="font-size:20px;font-weight :bold;">{{$wish->name}}</span><br>

                  <span style="font-size:16px;font-weight: normal;">
                    <i class="fas fa-rupee-sign" ></i>
                    {{$wish->sale_price}}
                  </span>&nbsp;&nbsp;
                  <span style="font-size:16px;font-weight: normal;"><s>
                    <i class="fas fa-rupee-sign" ></i>
                 {{number_format((float)$wish->mrp, 2, '.', '');}}</s></span>
                 <br><br>
                 <button class="btn btn-shift-to-cart" data-id="{{$wish->product_id}}" data-img={{$wish->image}} data-color="{{$wish->color_id}}" data-size="{{$wish->size_id}}" data-mrp="{{$wish->mrp}}" data-sale="{{$wish->sale_price}}">Add to cart</button>
               </div>
               <div class="col-md-1 text-right">
                 <button class="btn btn-danger" id="rm-wish" data-id="{{$wish->product_id}}" >
                   <i class="fa fa-lg fa-trash" ></i>
                 </button>
               </div>
            </div>
            @endforeach
          @else
            <div class="text-center">
                <h4 class="m-5">No record found</h4>
            </div>
          @endif
       </div>
   </div>
@endsection

@push('scripts')
<script>
    $(document).on('click','.btn-shift-to-cart', function(e){
         e.preventDefault();
         var variation = {};
         variation.product_images = [$(this).attr('data-img')];
         variation.qty = 1;
         variation.product_id = $(this).attr('data-id');
         variation.color_id = $(this).attr('data-color');
         variation.size_id = $(this).attr('data-size');
         variation.mrp_price = $(this).attr('data-mrp');
         variation.sales_price = $(this).attr('data-sale');
         variation._token = '{{ csrf_token() }}';



         $.ajax({
            url: '{{ route('cart.store') }}',
            method: "post",
            data: variation,
            success: function (response) {
                  var count = response.count;
                  $(document).find('.cart-no').html(count);

                  toastr.success('Success', response.message,{
                                 positionClass: 'toast-top-center',
                  });

                  var cart = response.cart;

                  var html = '';
                  var total = 0;



                  if(cart.length > 0)
                  {

                  html += '<div class="rm-sec">';
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
                        $(document).find('.cart-count').html(response.count);
                  }
               }
               else{
                  html += `
                  <div class="text-center">
                                 <h4>Cart is empty</h4>
                  /div>`;
               }
            }
         });
      });
</script>
@endpush
