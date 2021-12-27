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
    <img src="{{asset('store/images/contact_banner3.jpg')}}" alt="">
      <div class="container">
       <div class="col-md-12 text-center heading-title pt-5">
                    <h2 class="title-txt">Get in Touch with <span>VASVI</span></h2>
                    <img src="{{asset('store/images/headline.png')}}">
                 </div>
        <div class="col-md-7 col-sm-7 contact-section">
          <h2 class="font-weight-bold">Contact Us</h2>
          <p class="heading-subtitle">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within a matter of hours to help you.</p>
            <div class="row">
              <form id="contact-form" action="#" method="post">
                <div class="col-md-6 col-sm-6 form-group">
                    <label for="name" class="">Your name</label>
                    <input type="text" id="name" name="name" class="form-control">
                    <p class="text-danger" id="name-error"></p>
                </div>
                <div class="col-md-6 col-sm-6 form-group">
                  <label for="email" class="">Your email</label>
                   <input type="text" id="email" name="email" class="form-control">
                   <p class="text-danger" id="email-error"></p>
                </div>
                 <div class="col-md-6 col-sm-6 form-group">
                   <label for="subject" class="">Phone Number</label>
                   <input type="number" id="phone" name="phone" class="form-control">
                   <p class="text-danger" id="phone-error"></p>
                </div>
                  <div class="col-md-6 col-sm-6 form-group">
                   <label for="subject" class="">Subject</label>
                   <input type="text" id="subject" name="subject" class="form-control">
                   <p class="text-danger" id="subject-error"></p>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                  <label for="message">Your message</label>
                  <textarea  id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                  <p class="text-danger" id="message-error"></p>
                </div>
                <div class="col-md-12 col-sm-12 form-group text-center">
                 <button type="submit" class="btn  btn-signup btn-pink" id="submit">Get In Touch</button>
                </div>
              </form>
            </div>
        </div>
        <div class="col-md-5 col-sm-5 contactlft-section">
            <ul class="list-unstyled mb-0">
                  <li><i class="fa fa-map-marker"></i>
                      <p><strong>Office Address</strong> B/211, Vaishali Marg, Shivraj Niketan Colony,<br/> Vaishali Nagar, Jaipur, Rajasthan 302021</p>
                  </li>
                  <li><i class="fa fa-phone"></i>
                      <p><strong>Phone Number</strong> +91 6376681424, +916375565058</p>
                  </li>
                  <li><i class="fa fa-envelope"></i>
                      <p><strong>Email Address</strong> <a href="mailto:info@vasvi.in">info@vasvi.in</a></p>
                  </li>
                  <li><i class="fa fa-globe"></i>
                      <p><strong>Website</strong> <a href="mailto:info@vasvi.in">vasvi.in</a></p>
                  </li>
              </ul>
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
