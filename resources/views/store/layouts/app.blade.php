<?php
$store = \App\Models\Setting::first();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('title','A default title')</title>
      <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
      <meta name="description" content="@yield('meta_description','default description')">
      <link rel="canonical" href="{{url()->current()}}"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="{{asset('file')}}/{{$store->favicon}}" type="image/png">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/bootstrap.min-3.3.7.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/menu.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/style-new.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/fontawesome-all.min.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/front-new.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/front-new2.css')}}">
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/zoom-slider.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('store/css/vasvi.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('toast/toastr.css')}}">
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> --}}
      <style>
        #toast-container{
        margin-top : 20px;
        }

        #toast-container > .toast {
        width: 370px !important;
        }

        .front:hover{
            cursor :pointer ;
        }

        .back:hover{
            cursor :pointer ;
        }


        #cover {
            background: url("{{asset('frontend/images/loading.gif')}}") no-repeat scroll center center #FFF;
            position: absolute;
            height: 100%;
            width: 100%;
        }


        .loading-overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        }

        .loading-overlay.is-active {
        display: flex;
        }

        .pink{
        color : #FB8071 !important;
        }

        .grey{
            color : lightgrey !important;
        }

        a:hover{
            text-decoration: none;
        }

        .wish-div{
            position: relative;
        }

        .wish-count{
            position: absolute;
            background-color: #e5cc76;
            top : -15px;
            right : -15px;
            width : 22px; height : 22px;
            border-radius: 15px;
            line-height : 15px;
            padding : 4px;
        }

        .wholesale{
            display: none;
        }

        @media screen and (max-width: 768px) {

          .wholesale {display: block;}
          .nav-row {
              height : 80px !important;
          }

          #seeme{
            display : block;
          }

        }

        #inclwholesale{
          padding: 6px 20px 6px 20px;
          border-radius: 10px;
          font-size: 16px;
          font-weight: bold;
          color: #ffffff;
          transition: all ease-in-out 0.5s;
          background: linear-gradient(-45deg, #ffa63d, #ff3d77, #338aff, #3cf0c5);
          background-size: 600%;
          -webkit-animation: anime 16s linear infinite;
          animation: anime 6s linear infinite;
          margin: 0 20px 0 0;
          cursor: pointer;
          display : inline-block;
          border : 0px solid white;
        }

        #seeme{
          display : none;
        }



         /* Smartphone Portrait and Landscape */
         @media only screen
         and (min-device-width : 320px)
         and (max-device-width : 480px){ #seeme { display: block;}}


      </style>
      @stack('styles')
   </head>
   <body>
    @if(!session()->has('cart'))
        <?php session()->put('cart',[]);?>
    @endif


    <div class="loading-overlay">
        <span class="fas fa-spinner fa-3x fa-spin"></span>
    </div>
      <!-- OTP Modal Star here -->
      <div class="modal fade" id="OTPModal" tabindex="-1" role="dialog" aria-labelledby="OTPModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             {{-- opt-dialog --}}
            <div class="modal-content">
               <div class="modal-body">
                  <button type="button" class="close opt-close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="row">
                     <div class="col-sm-2"></div>
                     <div class="col-sm-8">
                        <h4 class="modal-title mb-4 text-center ">Enter OTP</h4>
                        <p style="font-size:13px; color:#333; margin-bottom:0px; line-height:25px; text-align:center;">A Verification code has been send to your mobile
                        </p>
                        <div class="form-group mobilenumber-input">
                           <input type="text" class="form-control text-center boldtxt otp-number" value=""  id="otp-mobile" disabled>
                           <button class="edit-icon edit-btn-new text-danger">
                           <i class="fas fa-pencil-alt"></i></button>
                        </div>
                        <div class="form-group mobilenumber-input">
                           <input type="text" class="form-control text-center boldtxt otp-number" placeholder="Enter Verification code (OTP)"   id="otp">
                           <p class="text-danger" id="otp-error"></p>
                        </div>
                        <div>
                           <button type="button" class="btn btn-danger btn-block  f_size13" id="verify">VERIFY</button>
                        </div>
                        <a href="#" class="text-danger text-center mt-4" onclick="resend();">Resend?</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Login Modal start here -->
      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
         <div class="modal-dialog  " role="document">
            <div class="modal-content">
                <div class="modal-header">

         <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
       </div>
               <div class="modal-body login_modal">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="pad15">
                           <h2 class="modal_title">Member Sign In</h2>
                           <div class="loginform-subtitle">Enter registered mobile number OR email id to login</div>
                           <div class="formrow martop15 borbotnone">
                              <div class="col-md-12 text-center">
                                 <a href="{{ url('/redirect/facebook') }}" class="btn btn-social btnfb"><i class="fab fa-facebook-f"></i> <span class="divider"></span> Login with Facebook</a>
                                 <a href="{{ url('/redirect/google') }}" class="btn btn-social btn-gmail"><i class="fab fa-google"></i> <span class="divider"></span> Login with Google</a>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <form action="{{route('store.login')}}" method="POST" id="login-form-submit">
                                 <div class="formrow">
                                    <label class="label-title">Mobile Number, Email ID</label>
                                    <div class="icon"><i class="far fa-envelope"></i></div>
                                    <input type="text" name="username" value="" class="form-control" id="login-name">
                                    <p class="text-danger" id="login-name-error"></p>
                                 </div>
                                 <div class="formrow">
                                    <label class="label-title">Password</label>
                                    <div class="icon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                                    <input type="password" name="password" value="" class="form-control" id="login-password">
                                    <p class="text-danger" id="login-password-error"></p>
                                 </div>
                                 <div class="formrow borbotnone">
                                    <div class="row">
                                       <div class="col-md-8 text-left txt-terms" ><input type="checkbox" id="login-agree">I accept agreement

                                         <a href="#">&nbsp;New Customer Agreement</a></div>

                                       <div class="col-md-4 text-right txt-forgotpass" ><a href="JavaScript:Void(0);" data-toggle="modal" data-target="#forgotpassModal" >Forgot Password</a></div>
                                       <p class="text-danger ml-5" id="login-agree-error"></p>
                                       <div class="col-md-8 text-left txt-remember" style="color:grey;font-size: 12px;"><input type="checkbox" id="login-remember">&nbsp;&nbsp;Remember Me</div>
                                    </div>

                                 </div>

                                 <div class="row martop10">
                                    <div class="col-md-12" style="text-align:center;"><button name="submit" class="btn  btn-signup btn-pink " type="submit">SIGN IN</button>
                                    </div>
                                    <div class="col-md-12 signuplink">Don't have an account? <a href="JavaScript:void(0);" data-toggle="modal" data-target="#registerModal">Sign Up</a></div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

       <!-- Sign Up  Modal start here -->
      <div class="modal fade" id="registerModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12 pad-l0 pad-r0">
                <div class="modal-header">

         <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
       </div>
               <div class="modal-body login_modal register-modal">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="pad15">
                           <h2 class="modal_title">Create An Account</h2>



  <ul id="myTabs" class="nav nav-pills nav-pills-signup  nav-justified" role="tablist" data-tabs="tabs">
    <li class="active"><a href="#Customer" data-toggle="tab">Customer</a></li>
    <li><a href="#Wholesaler" data-toggle="tab">Wholesaler</a></li>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="Customer">
         <div class="formrow martop15 borbotnone">
            <div class="col-md-12 text-center">
               <a href="{{ url('/redirect/facebook') }}" class="btn btn-social btnfb"><i class="fab fa-facebook-f"></i> <span class="divider"></span> Login with Facebook</a>
               <a href="{{ url('/redirect/google') }}" class="btn btn-social btn-gmail"><i class="fab fa-google"></i> <span class="divider"></span> Login with Google</a>
            </div>
         </div>
         <div class="row">
            <form class="col-md-12" id="signup-user">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                       <div class="formrow">
                          <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                             <input type="text" name="username" placeholder="First & Last Name" class="form-control" id="signup-user-name">

                          </div>
                          <p class="text-danger" id="signup-user-name-error"></p>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                       <div class="formrow">
                          <div class="col-lg-12 col-md-12 col-sm-12 iconbg emailfield">
                             <input type="text" name="username" placeholder="Email Id" class="form-control" id="signup-user-email">

                          </div>
                          <p class="text-danger" id="signup-user-email-error"></p>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                       <div class="formrow">
                          <div class="col-lg-12 col-md-12 col-sm-12 iconbg mobilefield">
                             <input type="text" name="username" placeholder="Mobile Number" class="form-control" id="signup-user-mobile">

                          </div>
                          <p class="text-danger" id="signup-user-mobile-error"></p>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="formrow">
                           <div class="col-lg-12 col-md-12 col-sm-12 iconbg referralfield">
                              <input type="text" name="referral" placeholder="Referral Code" class="form-control" id="signup-user-referral">

                           </div>
                           <p class="text-danger" id="signup-user-referral-error"></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                       <div class="formrow">
                          <div class="col-lg-12 col-md-12 col-sm-12 iconbg locfield">
                             <select   id="signup-user-city" style="width : 100%;">
                                <?php
                                $cities = \App\Models\City::orderBy('name','asc')->get();
                                ?>
                                <option value="" selected>Select City</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                             </select>
                             <p class="text-danger" id="signup-user-city-error"></p>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                       <div class="formrow">
                          <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfieldpass">
                             <input type="password" name="username" placeholder="Password" class="form-control" id="signup-user-password">
                             <a href="#" class="iconviewpass" id="iconuserpass"></a>
                          </div>
                          <p class="text-danger" id="signup-user-password-error"></p>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                       <div class="formrow">
                          <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfieldpass">
                             <input type="password" name="username" placeholder="Confirm Password" class="form-control" id="signup-user-cpassword">
                             <a href="#" class="iconviewpass" id="iconcuserpass"></a>
                          </div>
                          <p class="text-danger" id="signup-user-cpassword-error"></p>
                       </div>
                    </div>

                </div>
               <div class="row martop10">
                  <div class="col-md-12" style="text-align:center;"><button  class="btn  btn-signup btn-pink " type="submit"style="cursor: pointer;">Get OTP</button>
                  </div>
                  <div class="col-md-12 signuplink">
                    By creating an account, you agree to Vasvi's <a href="#" class="text-danger">terms of use</a> and <a href="#">privacy policy</a>.
                  </div>
                  <div class="col-md-12 signuplink">Do you have an account? <a href="JavaScript:void(0);" data-toggle="modal" data-target="#loginModal" class="signin-btn">Sign In</a></div>
               </div>
            </form>
         </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="Wholesaler">

         <div class="row">
            <form class="col-md-12" style="margin-top: 30px">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                       <div class="formrow">
                          <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                             <input type="text" name="username" placeholder="First & Last Name" class="form-control">
                          </div>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                     <input type="text" name="username" placeholder="Company Name" class="form-control">
                  </div>
               </div>
                        </div>
                     <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg emailfield">
                     <input type="text" name="username" placeholder="Email Id" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg mobilefield">
                     <input type="text" name="username" placeholder="Mobile Number" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
              <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg locfield">
                     <select class="form-control">
                        <option value="">City</option>
                        <option>Jaipur</option>
                     </select>
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg locfield">
                     <input type="text" name="username" placeholder="Address" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfield">
                     <input type="text" name="username" placeholder="Pin Code" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfield">
                     <input type="text" name="username" placeholder="GST No (Optional)" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfieldpass">
                     <input type="Password" name="username" placeholder="Password" class="form-control">
                     <a href="#" class="iconviewpass"></a>
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
                <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfieldpass">
                     <input type="Password" name="username" placeholder="Confirm Password" class="form-control">
                     <a href="#" class="iconviewpass"></a>
                  </div>
               </div>
                        </div>
                    </div>



               <div class="row martop10">
                  <div class="col-md-12" style="text-align:center;"><button  class="btn  btn-signup btn-pink  " type="button" data-toggle="modal" data-target="#OTPModal" style="cursor: pointer;">Get OTP</button>
                  </div>
                  <div class="col-md-12 signuplink">Do you have an account? <a href="JavaScript:void(0);" data-toggle="modal" data-target="#loginModal" class="signin-btn">Sign In</a></div>
               </div>
            </form>
         </div>

    </div>
  </div>





                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

       <!-- Sign Up  Modal start here -->
      <div class="modal fade" id="wholesale" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
         <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12 pad-l0 pad-r0">
                <div class="modal-header">

         <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
       </div>
               <div class="modal-body login_modal register-modal">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="pad15">
                           <h2 class="modal_title">Create An Account</h2>

  <div class="tab-content">

    <div role="tabpanel" class="tab-pane fade active in" id="Wholesaler">

         <div class="row">
            <form class="col-md-12" style="margin-top: 30px">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                       <div class="formrow">
                          <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                             <input type="text" name="username" placeholder="First & Last Name" class="form-control">
                          </div>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                     <input type="text" name="username" placeholder="Company Name" class="form-control">
                  </div>
               </div>
                        </div>
                     <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg emailfield">
                     <input type="text" name="username" placeholder="Email Id" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg mobilefield">
                     <input type="text" name="username" placeholder="Mobile Number" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
              <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg locfield">
                     <select class="form-control">
                        <option value="">City</option>
                        <option>Jaipur</option>
                     </select>
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg locfield">
                     <input type="text" name="username" placeholder="Address" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfield">
                     <input type="text" name="username" placeholder="Pin Code" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfield">
                     <input type="text" name="username" placeholder="GST No (Optional)" class="form-control">
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
               <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfieldpass">
                     <input type="Password" name="username" placeholder="Password" class="form-control">
                     <a href="#" class="iconviewpass"></a>
                  </div>
               </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
                <div class="formrow">
                  <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfieldpass">
                     <input type="Password" name="username" placeholder="Confirm Password" class="form-control">
                     <a href="#" class="iconviewpass"></a>
                  </div>
               </div>
                        </div>
                    </div>



               <div class="row martop10">
                  <div class="col-md-12" style="text-align:center;"><button  class="btn  btn-signup btn-pink  " type="button" data-toggle="modal" data-target="#OTPModal" style="cursor: pointer;">Get OTP</button>
                  </div>
                  <div class="col-md-12 signuplink">Do you have an account? <a href="JavaScript:void(0);" data-toggle="modal" data-target="#loginModal" class="signin-btn">Sign In</a></div>
               </div>
            </form>
         </div>

    </div>
  </div>





                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


       <!-- Header -->
      <header class="header">
         <section id="navbar">
            <div class="header_main ">
               <div class="container">
                  <div class="row">
                     <div style="" class="col-lg-12 nav-row" style="position: unset;">
                        <div class="col-lg-2 col-md-2">
                           <div class="logo">
                              <a href="{{url('/')}}"><img class="img-fluid nav-row" src="{{asset('file')}}/{{$store->logo}}" alt="" /></a>
                           </div>
                        </div>
                        <div class="col-lg-6 col-md-6 main_menu">
                           <nav class="main_nav">
                               @include('store.partials.header')
                           </nav>
                        </div>
                        <div class="col-md-4 col-md-4  header-rgt-panel">
                           <div>
                              <div class="header-rgt-menu">
                                 <ul>
                                    <li class="wholseale"><a data-toggle="modal" data-target="#wholesale">Wholesale</a></li>

                                    <li>
                                        <a class="search-icon" href="javascript:void(0);" data-aos="fade-down" data-aos-delay="400">
                                            <span class="shop-icon">
                                              <i class="fa fa-search" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                        <div class="search-wrapper" >
                                            <div class="searchForm">
                                                <form action="" method="get" id="search-form">
                                                    <input type="search" name="s" class="serach-input" id="search-input" placeholder="Search Products">
                                                    <button class="btn btn-primary searchicon" type="submit"><i class="fa fa-search"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                       <a href="#" id="nav-user"><i style="font-size: 18px; margin-top: 5px;" class="far fa-user"></i></a>
                                       <div class="dropdown-content account-dropdown">
                                        @if(\Auth::check())
                                        <?php $user = \Auth::user(); ?>
                                          <ul class="user-details">
                                             <li>
                                                <p class="text-left"><i class="fa fa-user-circle theme-color user-icon" aria-hidden="true"></i> Hi, {{$user->name}}</p>
                                             </li>
                                             <li>
                                                <p class="text-left"><i class="fa fa-table theme-color user-icon" aria-hidden="true"></i> <a href="{{url('account/dashboard')}}" style="font-size : 14px;">My Profile</a></p>
                                             </li>
                                             <li>
                                                 <?php

                                                   $wallet = \App\Models\Wallet::where('user_id',$user->id)->first();
                                                 ?>
                                                <p class="text-left"><i class="fa fa-credit-card theme-color user-icon" aria-hidden="true"></i> <a href="{{url('account/dashboard?type=wallet')}}" style="font-size : 14px;">Wallet&nbsp;<span style="float:right">Rs.{{$wallet ? $wallet->amount : 0.00}}</span></a></p>
                                             </li>
                                             <li>
                                                <form method="POST" action="{{route('store.logout')}}">
                                                    @csrf

                                                   <button style="border : 0px;background-color : white" class="float-left">
                                                    <span class="text-left"><i class="fa fa-power-off theme-color user-icon" aria-hidden="true"></i> Logout</span>
                                                   </button>
                                                </form>
                                             </li>
                                          </ul>
                                          @else
                                          <ul>
                                             <li>
                                                <a href="{{ url('/redirect/facebook') }}"><img src="{{asset('store/images/facebook-svg.svg')}}" alt="" width="220" /></a>
                                             </li>
                                             <li>
                                                <a href="{{ url('/redirect/google') }}"><img src="{{asset('store/images/google-svg.svg')}}" alt="" width="220" /></a>
                                             </li>
                                             <li><strong>OR</strong></li>
                                             <li><button type="button" class="btn-grey" data-toggle="modal" data-target="#loginModal">Sign In</button></li>
                                             <li><button type="button" class="btn-grey" data-toggle="modal" data-target="#registerModal">Sign Up</button></li>
                                          </ul>
                                          @endif
                                       </div>
                                    </li>
                                    <li>

                                       <a href="#" class="wish-div">
                                           @if(\Auth::check())
                                           <span class="wish-count">
                                               <?php
                                               echo \App\Models\Wishlist::where('user_id',\Auth::user()->id)->get()->count();
                                               ?>
                                           </span>
                                           @endif
                                           <i style="font-size: 18px; margin-top: 5px;" class="far fa-heart"></i></a>


                                       <div class="dropdown-content wishlist-content" style="width : 270px;background-color: #FFDCDD;" id="wishlist-container">
                                          @if(\Auth::check())
                                           <?php  $wishes = \DB::table('wishlists')->where('user_id', \Auth::user()->id)->limit(3)->get();
                                           ?>
                                          <div class="px-3">
                                            @if($wishes->count() > 0)
                                              @foreach($wishes as $wish)
                                                <div class="row py-1" style="background-color:white;" >
                                                    <div class="col-md-4">
                                                        <div style="margin : 3px;">
                                                        <img src="{{asset('file')}}/{{$wish->image}}" style="width : 100%;"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="text-align : left;margin-top : 4px;">{{$wish->name}}<br>
                                                        <b>Rs - {{$wish->sale_price}}</b>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <i class="fa fa-lg fa-trash m-1 mt-3" id="rm-wish" data-id="{{$wish->product_id}}"></i>
                                                    </div>
                                                </div>
                                              @endforeach
                                                <div class="text-center">
                                                    <a href="{{url('/wishlists')}}" class="">View More</a>
                                                </div>
                                            @else
                                             <p><i style="font-size: 18px; margin-top: 5px;" class="far fa-heart"></i>
                                                <br/>Love Something ? Save it here
                                             </p>
                                            @endif
                                          </div>
                                          @else
                                          <p><i style="font-size: 18px; margin-top: 5px;" class="far fa-heart"></i>
                                             <br/>Love Something ? Save it here
                                          </p>
                                          @endif
                                       </div>
                                    </li>


                                    <li>
                                          <a class="bag" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                             <span class="cart-count">
                                                @if(\Session::has('cart'))
                                                   @if(count(session('cart')) > 0)
                                                     {{count(session('cart'))}}
                                                   @else
                                                      0
                                                   @endif
                                                @endif
                                             </span>
                                          </a>
                                        <div class="cart-toggle">
                                        <div class="collapse cart-div" id="collapseExample">
                                          <ul class=" user-details">
                                             <div class="cart-items">
                                                <?php $total = 0; ?>
                                                @if(\Session::has('cart'))
                                                @if(count(session('cart')) > 0)
                                                @foreach(session('cart') as $cart)

                                                <li>
                                                  <div class="maindiv">
                                                <div class="img-boxs"><img src="{{asset('file')}}/{{$cart['product_images'][0]}}"></div>
                                                <div class="cart-content">
                                                   <h2><a href="#">{{$cart['name']}}</a></h2>
                                                  <p> RS {{$cart['single_sales_price']}} <span>Quantity: {{$cart['qty']}}</span></p>
                                                </div>
                                                <div class="cart-close">
                                                   <a href="#" id="rm-cart" data-id="{{$cart['id']}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                   </div>
                                                </div>
                                                </li>
                                                <?php $total += $total + ($cart['single_sales_price'] * $cart['qty']); ?>
                                                @endforeach
                                                  <li class="total-cart">
                                                      <span class="aa-cartbox-total-title">Total</span>
                                                      <span class="aa-cartbox-total-price">₹{{$total}}</span>
                                                  </li>
                                                 <li class="lastlist">
                                                 <a href="{{url('/cart')}}" class="procedtopay"> Proceed To Pay</a>
                                                 </li>
                                                 @else
                                                  <div class="text-center">
                                                      <h4> Cart is empty</h4>
                                                  </div>
                                                 @endif
                                                 @endif
                                               </div>
                                          </ul>
                                        </div>
                                        </div>
                                    </li>

                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </header>

      @yield('content')
      @include('store.partials.footer')

      <div class="modal products-details Quixck" id="quickviews">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="product-box-modal">
            </div>
          </div>
        </div>
      </div>

      {{-- @include('store.popup.product') --}}

   <script src="{{asset('store/js/jquery.min.js')}}"></script>
   <script src="{{asset('store/js/bootstrap.min.js')}}"></script>
   <script src="{{asset('store/js/owl.carousel.min.js')}}"></script>
   <script src="{{asset('store/js/megamenu.js')}}"></script>
   <script src="{{asset('store/js/zoom-slider.js')}}"></script>
   <script src="{{asset('store/js/zoom-slider-main.js')}}"></script>
   <script src="{{asset('store/js/vasvi.js')}}"></script>
   <script src="{{asset('toast/toastr.min.js')}}"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
   <script>
        var botmanWidget = {
            aboutText: 'Vasvi.in 🥳 ',
            introMessage: "✋ Hi! I'm from Vasvi.in",
            title : 'Vasvi Chatbot 🥳'
        };
        function myFunctionworks(did) {
          /* Get the text field */
          var copyText = document.getElementById(did);
        
          /* Select the text field */
          copyText.select();
          //copyText.setSelectionRange(0, 99999); /* For mobile devices */
        
           /* Copy the text inside the text field */
          navigator.clipboard.writeText(copyText.value);
          $("#myElem").show().delay(5000).fadeOut();  
        } 
    </script>
   <script>
       $(function(){
           
           $(document).find('#signup-user-city').select2();

           $(document).on('submit','#search-form', function(e){
               e.preventDefault();
               var search = $(document).find('#search-input').val();
               if(search !== ''){
                   location.href = `{{url('/clothing/all?q=${search}')}}`;
               }

           })

           $(document).on('click','#rm-wish', function(e){
               e.preventDefault();
               var id = $(this).attr('data-id');
               $.ajax({
                   type: "delete",
                   url: "{{url('wishlist')}}"+`/${id}`,
                   data: {
                       id : id,
                       _token : "{{csrf_token()}}"
                   },
                   success: function (response) {
                    toastr.success('Success', response.message,{
                        positionClass: 'toast-top-center',
                    });
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

                    var proid = $(document).find('#btn-wishlist').attr('data-product');
                    if(proid === id){
                        $(document).find('#btn-wishlist').removeClass('pink').addClass('grey');
                    }
                    if(window.location.href.indexOf("wishlists") > -1){
                        location.reload();
                    }
                   }
               });
           })

           $(document).on('click','.iconviewpass', function(e){
               e.preventDefault();
               var id = $(this).attr('id');
               if(id == 'iconuserpass'){
                 var x = document.getElementById("signup-user-password");
                   if(x.type == 'password'){
                       x.type = 'text';
                   }
                   else{
                       x.type = 'password';
                   }
               }
               if(id == 'iconcuserpass'){
                   var y = document.getElementById("signup-user-cpassword");
                   if(y.type == 'password'){
                       y.type = 'text';
                   }
                   else{
                       y.type = 'password';
                   }
               }
           })
       })
   </script>
   <script>

      let overlay = $(document).find('.loading-overlay');
      document.onreadystatechange = function() {
         if (document.readyState !== "complete") {
               overlay.addClass('is-active');
         } else {
               setTimeout(function() {
                  overlay.removeClass('is-active');
               }, 500);

         }
      };
      var product_id = 0;
      var size_id =  0;
      var color_id = 0;
      var productData = {};
      var images = {};
      var currentImages = [];
      var dvariation = {};
      var mrp_price = 0;
      var sales_price = 0;

      $(document).on('click','#iamsmall', function(){
         var src = $(this).attr('src');
         $(document).find('.iambig').attr('src',src);
      });

      function dload_price(){
         var variations = productData.variations;

         for(var i = 0 ; i < variations.length; i++){
            var final_images = [];
            if(variations[i]['color_id'] == color_id && variations[i]['size_id'] == size_id){
                  var mrp = variations[i]['single_price'];
                  var sale_mrp = variations[i]['single_sales_price'];
                  mrp_price = mrp;
                  sales_price = sale_mrp;
                  $(document).find('.dmrp-price').html(mrp);
                  $(document).find('.dsale-price').html(sale_mrp);

                  for(var j = 0 ; j < images.length; j++){
                  if(images[j]['product_color_id'] == color_id){
                     final_images.push(images[j]['file_name']);
                  }
                  }

                  currentImages = final_images;
                  dvariation = variations[i];

            }

            $(document).find('#dquantity-pro').val(1);

            var priimg = '';
            var imgHtml = `
                           <section>
                              <div class="small-img">
                                 <img src="{{asset('frontend/images//online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">
                                 <div class="small-container">
                                 <div id="small-img-roll">`;
                  for(var x = 0 ; x < currentImages.length ; x++){


                     if(x === 0){
                        priimg = currentImages[x];
                     }
                     imgHtml += `<img src="{{asset('file')}}/${currentImages[x]}" class="show-small-img" alt="" id="iamsmall"> `
                  }

                     imgHtml +=  `
                                 </div>
                                 </div>
                                 <img src="{{asset('frontend/images/online_icon_right@2x1.png')}}" class="icon-right" alt="" id="next-img">
                              </div>`
                              for(var c = 0 ; c < currentImages.length ; c++){

                                 if(c === 0){
                                    imgHtml += `<div class="show" href="{{asset('file')}}/${currentImages[c]}">
                                 <img src="{{asset('file')}}/${currentImages[c]}" id="show-img" class="iambig">
                              </div>`
                                 }
                              }

                     imgHtml += `</section>
                           <div class='clear'></div>
                           `;


            $(document).find('#load-dyimg').html('');
            $(document).find('#load-dyimg').html(imgHtml);



         }
      }

      $(document).on('click','#dplus', function(){
         var count = $(document).find('#dquantity-pro').val();
         count = parseInt(count) + 1;
         $(document).find('#dquantity-pro').val(count++);

         var mrp = parseInt(mrp_price) * parseInt(count - 1);
         var sales = parseInt(sales_price) * parseInt(count - 1);


         $(document).find('.dsale-price').html(sales);
         $(document).find('.dmrp-price').html(mrp);
      });

      $(document).on('click','#dminus', function(){
         var count = $(document).find('#dquantity-pro').val();
         count = parseInt(count) > 1   ? parseInt(count) - 1 : 1;
         $(document).find('#dquantity-pro').val(count);

         var mrp = parseInt(mrp_price) * parseInt(count);
         var sales = parseInt(sales_price) * parseInt(count);


         $(document).find('.dsale-price').html(sales);
         $(document).find('.dmrp-price').html(mrp);
      });


        $(window).on('load', function(){
                $('#cover').fadeOut(1000);
        })

        var product_id = 0;
        var size_id = 0;
        var $color_id = 0;
        var like_id = 0;

        $(document).on('click','#size-id', function(e){
            e.preventDefault();
            var $this = $(this);

            $(document).find("[id^='size-id']").removeClass('sizepop-active').addClass('sizepop-inactive');
            // $(document).find('#size-id').removeClass('sizepop-active').addClass('sizepop-inactive');
            $this.removeClass('sizepop-inactive').addClass('sizepop-active');
            product_id = $this.attr('data-product');
            size_id = $this.attr('data-id');
            dload_price();
        });


        $(document).on('click','#color-id', function(e){
            e.preventDefault();
            var $this = $(this);
            $(document).find("[id^='color-id']").removeClass('colorpop-active').addClass('colorpop-inactive');
            // $(document).find('#color-id').removeClass('colorpop-active').addClass('colorpop-inactive');
            $this.removeClass('colorpop-inactive').addClass('colorpop-active');
            product_id = $this.attr('data-product');
            color_id = $this.attr('data-id');
            dload_price();
        });


      $(document).on('click','#rm-cart', function(e){
        e.preventDefault();
        var $this = $(this);
        var id = $(this).attr('data-id');

        $.ajax({
            url: '{{ route('cart.delete') }}',
            method: "DELETE",
            data: {id : id, _token : '{{ csrf_token() }}'},
            success: function (response) {
                var carts = response.carts;
                var html = "";
                var total = 0;
                if(carts.length > 0)
                {

                    html += '<div class="rm-sec">';
                    for(var i = 0 ; i < carts.length ; i++)
                    {
                        var myimages = carts[i].product_images;
                        html += ` <li>
                                        <div class="maindiv">
                                            <div class="img-boxs">
                                            <img src="{{asset('file')}}/${myimages[0]}">
                                            </div>
                                            <div class="cart-content">
                                                <h2><a href="#">${carts[i].name}</a></h2>
                                                <p> RS ${carts[i].single_sales_price}     <span>Quantity: ${carts[i].qty}</span></p>
                                            </div>
                                            <div class="cart-close">
                                                <a href="#" id="rm-cart" data-id="${carts[i].id}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </li>`;
                        total += total + (parseInt(carts[i].single_sales_price) * parseInt(carts[i].qty));
                    }

                    html += `<li class="total-cart">
                                <span class="aa-cartbox-total-title">Total</span>
                                <span class="aa-cartbox-total-price">₹${total}</span>
                            </li>`;
                    html += `<li class="lastlist">
                                <a href="{{url('/cart')}}" class="procedtopay"> Proceed To Pay</a>
                            </li>`;
                    html += '</div>';

                    if(carts.length > 0){
                            $(document).find('.cart-items').html(html);
                            $(document).find('.cart-count').html(response.count);
                    }
                }
                else{
                    var dyhtml = `<div class="text-center">
                                    <h4>Cart is empty</h4>
                                </div>`;
                    $(document).find('.cart-items').html(dyhtml);
                    $(document).find('.cart-count').html(0);

                }

                toastr.success('Success', response.message,{
                        positionClass: 'toast-top-center',
                });
            },
            error : function(err){

            }
        });
        })


      $(document).on('click','.prod-info', function(e){
        e.preventDefault();
        var id = $(this).attr('id');

        var url = "{{url('product/info')}}" + `/${id}`;
        $.ajax({
            url : url,
            type : 'get',
            success : function(data){

                currentImages = [];

                product_id = data.product.id;
                like_id = data.product.id;
                color_id = data.color.id,
                size_id = data.size.id
                productData = data.product;
                images = data.images;
                mrp_price = data.price.single_price;
                sales_price = data.price.single_sales_price;


                for(var r= 0; r < productData.variations.length; r++){

                    if(productData.variations[r].primary_variation === 1){

                        for(var x = 0; x < data.images.length; x++){

                            if(data.images[x].product_color_id === productData.variations[r].color_id){
                                currentImages.push(data.images[x].file_name)
                            }
                        }
                    }
                }

                currentImages = [...new Set(currentImages)];


                $(document).find('#product-box-modal').html(data.html);
                $('#quickviews').modal('show');
            },
            error : function(err){
                alert('No response from server');
            }
            });
    });

    $(document).on('click', '#btn-pwishlist', function(e){
        e.preventDefault();
        var data = $(this).attr('class');
        if(data.includes("grey")){
            @if(\Auth::check())
                var wishlist = {};
                wishlist.product_id = like_id;
                wishlist.size_id = size_id;
                wishlist.color_id = color_id;
                wishlist.mrp = $(document).find('.dmrp-price').html();;
                wishlist.sale_price = $(document).find('.dsale-price').html();
                wishlist.name = productData.name;
                wishlist.image = currentImages[0];
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
                        $(document).find('#btn-pwishlist').removeClass('grey').addClass('pink');
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
                $('#quickviews').modal('hide');
                $('#loginModal').modal('show');
            @endif
        }
        else{
            var product_id = like_id;
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
                    $(document).find('#btn-pwishlist').removeClass('pink').addClass('grey');

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

    $(document).on('click','#dbtn-addcart', function(e){
         e.preventDefault();
         var dyvariation = {};
         dyvariation.product_images = currentImages;
         var qty = $(document).find('#dquantity-pro').val();
         dyvariation.qty = qty;
         dyvariation.product_id = product_id;
         dyvariation.color_id = color_id;
         dyvariation.size_id = size_id;
         dyvariation.mrp_price = $(document).find('.dmrp-price').html();
         dyvariation.sales_price = $(document).find('.dsale-price').html();
         dyvariation._token = '{{ csrf_token() }}';

         $.ajax({
            url: '{{ route('cart.store') }}',
            method: "post",
            data: dyvariation,
            success: function (response) {
                  var count = response.count;
                  $(document).find('.cart-no').html(count);

                  toastr.success('Success', response.message,{
                                 positionClass: 'toast-top-center',
                  });

                  var cart = response.cart;

                  var html = '';
                  var total = 0;

                  $(document).find('#dquantity-pro').val(1);

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
  <script>

   var user_register_data;

   var check_otp;
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

   $(document).on('click', '.newsletter_button', function(e){
       e.preventDefault();
       var email = $(document).find('.newsletter_input').val();
       $(document).find('.newsletter_input').css('border','0px solid red');

       if(email === ''){
         $(document).find('.newsletter_input').css('border','1px solid red');
       }
       else if(!isEmail(email)){
        $(document).find('.newsletter_input').css('border','1px solid red');
       }
       else{
           $.ajax({
               type: "POST",
               url: "{{route('subscribes.store')}}",
               data: {email : email},
               success: function (response) {
                   if(response.code === 200){
                        toastr.success('Success', response.message,{
                                positionClass: 'toast-top-center',
                        });
                   }
                   else{
                    toastr.warning('Warning', response.message,{
                            positionClass: 'toast-top-center',
                    });
                   }
               },
               error : function(err){
                toastr.error('Error', 'Internal server error',{
                            positionClass: 'toast-top-center',
                    });
               }
           });
       }

   })
   function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }

   $(function(){
    var remember = $.cookie('remember');
    console.log($.cookie('username'));
    if ( remember == 'true' ) {
        var username = $.cookie('username');
        var password = $.cookie('password');
        $(document).find('#login-name').attr("value", username);
        $(document).find('#login-password').attr("value", password);
        $(document).find('#login-remember').attr('checked', true);
    }
   });
   $(document).on('submit','#login-form-submit',function(e){
           e.preventDefault()
           var name = $(document).find('#login-name').val();
           var password = $(document).find('#login-password').val();
           var agree = $(document).find('#login-agree');
           var formValues = $(this).serialize();
           $(document).find('#login-name-error').html('');
           $(document).find('#login-password-error').html('');
           var error = false;
           if(name === ''){
               $(document).find('#login-name-error').html('Field is required!');
               error =  true;
           }

           if(password === ''){
               $(document).find('#login-password-error').html('Field is required!');
               error =  true;
           }
           var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
           if( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(name) ||  name.match(phoneno)){
               $(document).find('#login-name-error').html('');
               error = false;
           }
           else{
               $(document).find('#login-name-error').html('Invalid email/mobile number');
               error = true;
           }

           if(password.length < 6){
               $(document).find('#login-password-error').html('Should be atleast 6 character long.');
               error = true;
           }

           if(! agree.is(':checked')){
               $(document).find('#login-agree-error').html('Please accept term and condition.');
               error = true;
           }

           if($(document).find('#login-remember').is(':checked')){
            $.cookie('username', name, { expires: 14 });
            $.cookie('password', password, { expires: 14 });
            $.cookie('remember', true, { expires: 14 });
           }
           else{
            $.cookie('username', null);
            $.cookie('password', null);
            $.cookie('remember', null);
           }

           var data = { email :  name, password : password};
           if(!error){
               $.ajax({
                       type : 'POST',
                       url: '{{route('store.login')}}',
                       data : data,
                       success : function(response)
                       {
                           if(response.success)
                           {
                               toastr.success('Success', response.message,{
                                       positionClass: 'toast-top-center',
                               });
                               window.location.replace('{{url('/')}}');
                           }
                           else
                           {
                               toastr.error('Error', response.message,{
                                       positionClass: 'toast-top-center',
                               });
                           }
                       },
                       error : function(err){
                           toastr.error('Error', 'Internal server error',{
                                   positionClass: 'toast-top-center',
                           });
                       }
               });
           }

   });

   function resend()
   {
    $.ajax({
               type : 'POST',
               url: '{{route('store.sendotp')}}',
               data : user_register_data,
               success : function(response)
               {
                   if(response.success)
                   {

                       check_otp = response.otp;
                       $('#OTPModal').modal('show');
                   }
                   else
                   {
                       toastr.error('Error', response.message,{
                           positionClass: 'toast-top-center',
                       });
                   }
               },
               error : function(err){
                   toastr.error('Error', 'Internal server error',{
                       positionClass: 'toast-top-center',
                   });
               }
       });
   }

   $(document).on('click','#popup-ruler', function(e){
       e.preventDefault();
    //    $(document).find('#sizePopModal').modal('show');
   })

   $(document).on('click','#verify', function(e){
       e.preventDefault();
       var otp = $(document).find('#otp').val();
       $(document).find('#otp-error').html('');
       var error = false;
       if(otp === ''){
           $(document).find('#otp-error').html('Field is required!');
           error = true;
       }
       else if(otp.length < 6){
           $(document).find('#otp-error').html('Please enter 6 digit OTP!');
           error = true;
       }
       else{
           if(otp === check_otp){
           $.ajax({
                   type : 'POST',
                   url: '{{route('store.register')}}',
                   data : user_register_data,
                   success : function(response)
                   {
                       $(document).find('#OTPModal').modal('hide');
                       if(response.success)
                       {
                           toastr.success('Success', response.message,{
                                   positionClass: 'toast-top-center',
                           });
                           location.reload();
                       }
                       else
                       {
                           toastr.error('Error', response.message,{
                                   positionClass: 'toast-top-center',
                           });
                       }
                   },
                   error : function(err){
                       toastr.error('Error', 'Internal server error',{
                               positionClass: 'toast-top-center',
                       });
                   }
           });
           }
           else{
           $(document).find('#otp-error').html('Invalid OTP!');
              error = true;
           }
       }
   })

   $(document).on('submit','#signup-user',function(e){
       e.preventDefault()
       var name = $(document).find('#signup-user-name').val();
       var email = $(document).find('#signup-user-email').val();
       var mobile = $(document).find('#signup-user-mobile').val();
       var city = $(document).find('#signup-user-city').val();
       var password = $(document).find('#signup-user-password').val();
       var cpassword = $(document).find('#signup-user-cpassword').val();
       var referral = $(document).find('#signup-user-referral').val();

       $(document).find('#signup-user-name-error').html('');
       $(document).find('#signup-user-email-error').html('');
       $(document).find('#signup-user-mobile-error').html('');
       $(document).find('#signup-user-city-error').html('');
       $(document).find('#signup-user-password-error').html('');
       $(document).find('#signup-user-cpassword-error').html('');
       $(document).find('#signup-user-referral-error').html('');
       var error = false;
       if(name === ''){
       $(document).find('#signup-user-name-error').html('Field is required!');
         error =  true;
       }

       if(referral !== '' && referral.length < 8){
       $(document).find('#signup-user-referral-error').html('Should be greter than 7 character long!');
         error =  true;
       }

       if(cpassword === ''){
        $(document).find('#signup-user-password-error').html('Field is required!');
        error =  true;
       }

       if(password === ''){
        $(document).find('#signup-user-cpassword-error').html('Field is required!');
        error =  true;
       }

       if(email === ''){
           $(document).find('#signup-user-email-error').html('Field is required!');
           error =  true;
       }

       if(mobile === ''){
           $(document).find('#signup-user-mobile-error').html('Field is required!');
           error =  true;
       }


       var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
       if(!mobile.match(phoneno)){
       $(document).find('#signup-user-password-error').html('Invalid mobile number!');
           error =  true;
       }
       if( ! /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)   ){
       $(document).find('#signup-user-email-error').html('Invalid email address');
         error = true;
       }

       if(city === ''){
       $(document).find('#signup-user-city-error').html('Field is required!');
       error =  true;
       }
       if(password.length < 6){
           $(document).find('#signup-user-password-error').html('Should be atleast 6 character long.');
           error = true;
       }

       if(cpassword !== password){
           $(document).find('#signup-user-cpassword-error').html('Must match with password');
           error = true;
       }

       if(!error){
       $(document).find('#otp-mobile').val(mobile);
       user_register_data = {name : name, email : email, mobile : mobile, city : city, password : password, referral : referral};
       $.ajax({
               type : 'POST',
               url: '{{route('store.sendotp')}}',
               data : {mobile : mobile, email : email},
               success : function(response)
               {

                   if(response.success)
                   {
                       $('#registerModal').modal('hide');
                       check_otp = response.otp;
                       $('#OTPModal').modal('show');
                   }
                   else
                   {
                       toastr.error('Error', response.message,{
                           positionClass: 'toast-top-center',
                       });
                   }
               },
               error : function(err){
                   toastr.error('Error', 'Internal server error',{
                       positionClass: 'toast-top-center',
                   });
               }
       });

       }
       else{
       $('#OTPModal').modal('hide');
       }

       return;

    var data = { email :  name, password : password};
    if(!error){
        $.ajax({
                type : 'POST',
                url: '{{route('store.login')}}',
                data : data,
                success : function(response)
                {

                    if(response.success)
                    {
                    toastr.success('Success', response.message,{
                            positionClass: 'toast-top-center',
                    });
                    window.location.replace('{{url('/')}}');
                    }
                    else
                    {
                    toastr.error('Error', response.message,{
                            positionClass: 'toast-top-center',
                    });
                    }
                },
                error : function(err){
                toastr.error('Error', 'Internal server error',{
                        positionClass: 'toast-top-center',
                });
                }
        });
    }

   });
 </script>
  <script>
   $(document).ready(function(){
       $(document).find("#share_icons").click(function(){
          $(document).find("#div3").fadeToggle(500);
       });


       $(document).on('click','#btn-share',function(){
          $(document).find(".btn-share").fadeToggle(500);
       });

   });
 </script>
 <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
 </script>
 <script>
    var open = false;
    $('.search-icon').click(function(){
        if(!open){
            $(document).find('.search-wrapper').addClass('open');
            $('body').addClass('search-wrapper-open');
            open = true;
            $(document).find('.account-dropdown').hide();
            $(document).find('.wishlist-content').hide();
            $(document).find('.cart-toggle').hide();
        }
        else{
            $(document).find('.search-wrapper').removeClass('open');
            $('body').removeClass('search-wrapper-open');
            open = false;
        }
    });
    $('.search-cancel').click(function(){
        $('.search-wrapper').removeClass('open');
        $('body').removeClass('search-wrapper-open');
    });

    $(document).on('click','#nav-user,.fa-user', function(e){
        e.preventDefault();
        $('body').removeClass('search-wrapper-open');
        $('.search-wrapper').removeClass('open');
        $(document).find('.account-dropdown').show();
        $(document).find('.wishlist-content').hide();
        $(document).find('.cart-toggle').hide();
    })

    $(document).on('hover','#nav-user,.fa-user', function(e){
        e.preventDefault();

    })

    $(document).on('click','.wish-div', function(e){
        e.preventDefault();
        $('body').removeClass('search-wrapper-open');
        $('.search-wrapper').removeClass('open');
        $(document).find('.account-dropdown').hide();
        $(document).find('.wishlist-content').show();
        $(document).find('.cart-toggle').hide();
    })

    $(document).on('click','.bag', function(e){
        e.preventDefault();
        $('body').removeClass('search-wrapper-open');
        $('.search-wrapper').removeClass('open');
        $(document).find('.account-dropdown').hide();
        $(document).find('.wishlist-content').hide();
        $(document).find('.cart-toggle').delay(200).show();
    })
 </script>
 <script>
    $(document).ready(function() {
      $('.product-slider .owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay:true,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 2,
            nav: false
          },
          1000: {
            items: 4,
            nav: true,
            loop: false,
            margin: 20
          }
        }
      })
    })
 </script>
 <script>
    $(document).ready(function() {
      $('#featuredCat .owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay:true,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 2,
            nav: false
          },
          1000: {
            items: 4,
            nav: true,
            loop: false,
            margin: 20
          }
        }
      })
    })
 </script>
 <script>
    $(document).ready(function() {
      $('.best_seller .owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay:true,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 2,
            nav: false
          },
          1000: {
            items: 4,
            nav: true,
            loop: false,
            margin: 20
          }
        }
      })
    })
 </script>
 <script>
    $(document).ready(function() {
      $('.vasvi_exclusive_slider .owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay:true,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 2,
            nav: false
          },
          1000: {
            items: 4,
            nav: true,
            loop: false,
            margin: 20
          }
        }
      })
    })
 </script>
 <script>
    $(document).ready(function() {
      $('.client-review .owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay:true,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true
          },
          600: {
            items: 2,
            nav: false
          },
          1000: {
            items: 2,
            nav: true,
            loop: false,
            margin: 20
          }
        }
      })
    })
 </script>
 <script>
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200); // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200); // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() { // When arrow is clicked
        $('body,html').animate({
            scrollTop: 0 // Scroll to top of body
        }, 500);
    });
 </script>
 <script>
    window.onscroll = function() {
        myFunction()
    };

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
 </script>
 <script>
    $(document).ready(function(){
      $(".signin-btn").click(function(){
       $("#registerModal").hide();
      });

      $(".signup-btn").click(function(){
       $("#loginModal").hide();

      });
    });

    $(function(){
    $('#chatbox').popover({
      placement: 'top',
      title: 'Write a Note'+
      '<button type="button" id="chatbox" class="close2"  aria-hidden="true">&times;</button>',

      html:true,
      content:  $('#myForm').html()
    }).on('click', function(){
        $('.btn-submit-review ').click(function(){
        $('#result').after("form submitted by " + $('#email').val())
        $.post('/echo/html/',  {
            email: $('#email').val(),
            name: $('#name').val(),
            phone: $('#phone').val(),
        }, function(r){
        $('#pops').popover('hide')
        $('#result').html('resonse from server could be here' )
        })
        })
     })
    })
     </script>
      @stack('scripts')
   </body>
</html>
