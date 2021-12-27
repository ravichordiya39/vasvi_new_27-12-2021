@extends('store.layouts.app')
@section('title', 'Vasvi - User ' .request()->segment(2) .' '. (request()->has('type') ? request()->get('type') : ''))
@section('meta_keywords', 'Vasvi.in, Ecommerce, Shopping, Mens, Woman, Kids, Cloth')
@section('meta_description', 'Ecommerce website to buy a product in quantity or bulk with lots of discount')
@push('styles')
<style>

</style>
@endpush

@section('content')
  <div class="headertopspace"></div>
  <div class="contact_area">
  <img src="{{asset('store/images/B1.jpg')}}" alt="">
    <div class="loctor_area">
        <div class="leaf1 leaf2"><img src="{{asset('store/images/leaf_img.jpg')}}"></div>
        <div class="leaf1"><img src="{{asset('store/images/leaf_img.jpg')}}"></div>
        <div class="container">
    @if($stores->count() > 0)
      @foreach($stores as $store)
        <div class="row">
            <div class="col-md-12 text-center heading-title pt-5">
                  <h2 class="title-txt"><span>Vasvi</span> Store Loctor at {{$store->city->name}}</h2>
                  <img src="{{asset('store/images/headline.png')}}">
               </div>
        <?php $shops = \App\Models\Store::where('city_id', $store->city_id)->get(); ?>
      @if($shops->count() > 0)
        @foreach($shops as $shop)
        <div class="col-md-6 col-sm-6">
          <div class="store-col">
              <h3>{{$shop->name}}</h3>
              <img src="{{asset("file/$shop->image")}}" alt="">
               {!!$shop->iframe!!}
              <div class="shop-address px-2 pb-2">
                  <span style="font-weight : bold;">Address :</span> {!! $shop->address !!}, <span style="font-weight : bold;">City :</span> {!! $shop->location !!}, <span style="font-weight : bold;">Pincodes :</span>{!! $shop->pin_codes !!},
                  <span style="font-weight : bold;">Contact</span> : {!! $shop->store_contact !!}, <span style="font-weight : bold;">Timing :</span> {{$shop->open_time}} - {{$shop->close_time}}
              </div>
          </div>
        </div>
       @endforeach
      @endif
    </div>
   @endforeach
  @endif

</div>
    </div>

</div>
@endsection

@push('scripts')
   <script>
      $(function(){
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });
         function IsEmail(email) {
           var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
           if(!regex.test(email)) {
             return false;
           }else{
             return true;
           }
         }


         function phone_validate(phno)
        {
          var regexPattern=new RegExp(/^[0-9-+]+$/);    // regular expression pattern
          return regexPattern.test(phno);
        }


         $(document).on('submit','#contact-form', function(e){
           e.preventDefault();
           $('#name-error').html('');
           $('#email-error').html('');
           $('#phone-error').html('');
           $('#subject-error').html('');
           $('#message-error').html('');



           var name = $('#name').val();
           var email = $('#email').val();
           var phone = $('#phone').val();
           var subject = $('#subject').val();
           var message = $('#message').val();
           var error = false;

           if(name === '' && name.length < 3){
             $('#name-error').html('* Field is required and >= 3 character.');
             error = true;
           }
           if(email === ''){
             $('#email-error').html('* Field is required!');
             error = true;
           }
           else if(IsEmail(email)==false){
             $('#email-error').html('* Invalid email!');
             error = true;
           }

           if(phone === ''){
             $('#phone-error').html('* Field is required!');
             error = true;
           }
           else if (!phone_validate(phone)) {
             $('#phone-error').html('* Invalid phone number!');
             error = true;
           }
           if(subject === '' && subject.length < 5){
             $('#subject-error').html('* Field is required and >= 5 character.');
             error = true;
           }
           if(message.trim() === '' && message.trim().length < 20){
             $('#message-error').html('* Field is required and >= 20 character.');
             error = true;
           }

           if(!error){
             var form = $(this);
             $.ajax({
               type:'POST',
               url:"{{ route('contact-us') }}",
               data:form.serialize(),
               success:function(data){
                 $('#contact-form').trigger("reset");
                 toastr.success('Success', data.message,{
                                positionClass: 'toast-top-center',
                 });
               },
               error : function(err){
                   console.log(err);
               }
            });
           }
         })
      })
   </script>
@endpush
