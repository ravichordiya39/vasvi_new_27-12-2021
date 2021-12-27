<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="vasvi shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/png">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/bootstrap.min-3.3.7.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/style-new.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/front-new.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/front-new2.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front_assets/css/zoom-slider.css')}}">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('toast/toastr.css')}}">

    <style>
    #toast-container{
        margin-top : 20px;
    }

    #toast-container > .toast {
      width: 370px !important;
    }
    </style>
    @stack('custom-css')
</head>

<body>
    <!-- OTP Modal Star here -->
    <div class="modal fade" id="OTPModal" tabindex="-1" role="dialog" aria-labelledby="OTPModalLabel"
        aria-hidden="true">
        <div class="modal-dialog opt-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close opt-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <h4 class="modal-title mb-4 text-center ">Enter OTP</h4>
                            <p
                                style="font-size:13px; color:#333; margin-bottom:0px; line-height:25px; text-align:center;">
                                A Verification code has been send to your mobile
                            </p>
                            <div class="form-group mobilenumber-input">
                                <input type="text" class="form-control text-center boldtxt otp-number" id="otp-mobile"
                                    value="" disabled>
                                <button class="edit-icon edit-btn-new text-danger">
                                    <i class="fas fa-pencil-alt"></i></button>
                            </div>
                            <div class="form-group mobilenumber-input">
                                <input type="text" class="form-control text-center boldtxt otp-number"
                                    placeholder="Enter Verification code (OTP)" id="otp">
                                <p class="text-danger" id="otp-error"></p>
                            </div>
                            <div>
                                <button type="button" class="btn btn-danger btn-block  f_size13"
                                    id="verify" >VERIFY</button>
                            </div>
                            <a href="#" class="text-danger text-center mt-4" onclick="resend();">Resend?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- OTP Modal Star here -->
    <!-- Sign Up  Modal start here -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content col-md-12 pad-l0 pad-r0">
                <div class="modal-body login_modal register-modal">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="pad15">
                                <h2 class="modal_title">Create An Account</h2>



                                <ul id="myTabs" class="nav nav-pills nav-pills-signup  nav-justified" role="tablist"
                                    data-tabs="tabs">
                                    <li class="active"><a href="#Customer" data-toggle="tab">Customer Sign-Up</a></li>
                                    <li><a href="#Wholesaler" data-toggle="tab">Wholesaler / Retailer Sign-Up</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="Customer">
                                        <div class="formrow martop15 borbotnone">
                                            <div class="col-md-12 text-center">
                                                <a href="{{ url('/redirect/facebook') }}" class="btn btn-social btnfb"><i
                                                        class="fab fa-facebook-f"></i> <span class="divider"></span>
                                                    Login with Facebook</a>
                                                <a href="{{ url('/redirect/google') }}" class="btn btn-social btn-gmail"><i
                                                        class="fab fa-google"></i> <span class="divider"></span> Login
                                                    with Google</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <form class="col-md-12" id="signup-user">
                                                <div class="formrow" action="{{route('store.register')}}" method="POST">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                                                        <input type="text" name="username"
                                                            placeholder="First & Last Name" id="signup-user-name" class="form-control">
                                                    </div>
                                                    <p class="text-danger" id="signup-user-name-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg emailfield">
                                                        <input type="text" name="email"  id="signup-user-email" placeholder="Email Id"
                                                            class="form-control">
                                                    </div>
                                                    <p class="text-danger" id="signup-user-email-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg mobilefield">
                                                        <input type="text" name="mobile" placeholder="Mobile Number"
                                                            class="form-control" id="signup-user-mobile">
                                                    </div>
                                                    <p class="text-danger" id="signup-user-mobile-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfield">
                                                        <input type="Password" name="password" placeholder="Password"
                                                            class="form-control" id="signup-user-password">
                                                        <a href="#" class="iconviewpass"></a>
                                                    </div>
                                                    <p class="text-danger" id="signup-user-password-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg locfield">
                                                        <select class="form-control" id="signup-user-city">
                                                          <option value="" selected>Slect City</option>
                                                          <?php
                                                            $cities = \App\Models\City::orderBy('name','asc')->get();
                                                          ?>
                                                          @foreach($cities as $city)
                                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                    <p class="text-danger" id="signup-user-city-error"></p>
                                                </div>
                                                <div class="row martop10">
                                                    <div class="col-md-12" style="text-align:center;"><button
                                                            class="btn  btn-pink otp-modal " type="submit"

                                                            style="cursor: pointer;">Get OTP</button>
                                                    </div>
                                                    <div class="col-md-12 signuplink">Do you have an account? <a
                                                            href="JavaScript:void(0);" data-toggle="modal"
                                                            data-target="#loginModal" class="signin-btn">Sign In</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="Wholesaler">

                                        <div class="row">
                                            <form class="col-md-12" style="margin-top: 30px" id="signup-company" >
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                                                        <input type="text" name="username"
                                                            placeholder="First & Last Name" class="form-control" id="signup-company-name">
                                                    </div>
                                                    <p class="text-danger" id="signup-company-name-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                                                        <input type="text" name="company" placeholder="Company Name"
                                                            class="form-control" id="signup-company-company">
                                                    </div>
                                                     <p class="text-danger" id="signup-company-company-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg namefield">
                                                        <input type="text" name="person"
                                                            placeholder="Contact Person (Optional)"
                                                            class="form-control" id="signup-company-person">
                                                    </div>
                                                      <p class="text-danger" id="signup-company-name-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg emailfield">
                                                        <input type="text" name="email" placeholder="Email Id"
                                                            class="form-control" id="signup-compnay-email">
                                                    </div>
                                                      <p class="text-danger" id="signup-company-email-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg mobilefield">
                                                        <input type="text" name="mobile" placeholder="Mobile Number"
                                                            class="form-control" id="signup-company-mobile">

                                                    </div>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg locfield">
                                                        <select class="form-control" id="signup-company-city">
                                                            <option value="" selected>Select City</option>
                                                            <?php
                                                              $cities = \App\Models\City::orderBy('name','asc')->get();
                                                            ?>
                                                            @foreach($cities as $city)
                                                              <option value="{{$city->id}}">{{$city->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <p class="text-danger" id="signup-company-city-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg locfield">
                                                        <input type="text" name="address" placeholder="Address"
                                                            class="form-control" id="signup-company-address">
                                                    </div>
                                                     <p class="text-danger" id="signup-company-address-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfield">
                                                        <input type="Password" name="pincode" placeholder="Pin Code"
                                                            class="form-control" id="signup-company-pincode">
                                                    </div>
                                                    <p class="text-danger" id="signup-company-pincode-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfield">
                                                        <input type="text" name="gst_no"
                                                            placeholder="GST No (Optional)" class="form-control" id="signup-company-gst">

                                                    </div>
                                                    <p class="text-danger" id="signup-company-gst-error"></p>
                                                </div>
                                                <div class="formrow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 iconbg passfield">
                                                        <input type="Password" name="password" placeholder="Password"
                                                            class="form-control" id="signup-company-password">
                                                        <a href="#" class="iconviewpass"></a>
                                                    </div>
                                                    <p class="text-danger" id="signup-company-password-error"></p>
                                                </div>
                                                <div class="row martop10">
                                                    <div class="col-md-12" style="text-align:center;">
                                                      <button
                                                            class="btn  btn-pink otp-modal " type="button"
                                                            data-toggle="modal" data-target="#OTPModal"
                                                            style="cursor: pointer;">Get OTP
                                                      </button>
                                                    </div>
                                                    <div class="col-md-12 signuplink">Do you have an account? <a
                                                            href="JavaScript:void(0);" data-toggle="modal"
                                                            data-target="#loginModal" class="signin-btn">Sign In</a>
                                                    </div>
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
    </div>
    <!-- Sign Up Modal end here -->
    <!-- Login Modal start here -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  " role="document">
            <div class="modal-content">
                <div class="modal-body login_modal">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="pad15">
                                <h2 class="modal_title">Member Sign In</h2>
                                <div class="loginform-subtitle">Enter registered mobile number OR email id to login
                                </div>
                                <div class="formrow martop15 borbotnone">
                                    <div class="col-md-12 text-center">
                                        <a href="{{ url('/redirect/facebook') }}" class="btn btn-social btnfb"><i class="fab fa-facebook-f"></i> <span
                                                class="divider"></span> Login with Facebook</a>
                                        <a href="{{ url('/redirect/goolge') }}" class="btn btn-social btn-gmail"><i class="fab fa-google"></i> <span
                                                class="divider"></span> Login with Google</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <form action="{{route('store.login')}}" method="POST" id="login-form-submit">
                                        <div class="formrow">
                                            <label class="label-title">Mobile Number, Email ID</label>
                                            <div class="icon"><i class="far fa-envelope"></i></div>
                                            <input type="text" name="username" id="login-name" value="" class="form-control " required>
                                            <p class="text-danger" id="login-name-error"></p>
                                        </div>
                                        <div class="formrow">
                                            <label class="label-title">Password</label>
                                            <div class="icon" style="font-size:25px;">***</div>
                                            <input type="password" name="password" id="login-password" value="" class="form-control" required>
                                            <p class="text-danger" id="login-password-error"></p>
                                        </div>
                                        <div class="formrow borbotnone">
                                            <div class="row">
                                                <div class="col-md-8 text-left txt-terms">
                                                  <input type="checkbox" id="login-agree" onclick="javascript:void(0);">I
                                                    accept agreen <a href="#">New Customer Agreement</a>
                                                  </div>
                                                <div class="col-md-4 text-right txt-forgotpass"><a
                                                        href="JavaScript:Void(0);" data-toggle="modal"
                                                        data-target="#forgotpassModal">Forgot Password</a></div>
                                                <div class="col-md-12">
                                                   <p class="text-danger" id="login-agree-error"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row martop10">
                                            <div class="col-md-12" style="text-align:center;"><button name="submit"
                                                    class="btn  btn-signup btn-pink " type="submit">SIGN IN</button>
                                            </div>
                                            <div class="col-md-12 signuplink">Don't have an account? <a name="submit"
                                                    class="" type="button" href="#">Sign Up</a></div>
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
    <!-- Login Modal end here -->
    <!-- Header -->
    <header class="header">
        <section id="navbar">
            <div class="header_main ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-md-2 col-lg-2">
                                <div class="logo">
                                    <a href="{{ url('/') }}"><img class="img-fluid"
                                            src="{{ asset('front_assets/images/vasvi_logo.jpg') }}" alt="" width="150" /></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 " style="position: unset;">
                                <nav class="main_nav">
                                    <div class="menu-container">
                                        <div class="menu">
                                            {!! getNav() !!}
                                        </div>
                                    </div>
                                </nav>
                            </div>
                            <div class="col-md-4 col-lg-4 header-rgt-panel" style="position: relative;">
                                <div style="padding-right: 0">
                                    <div class="header-rgt-menu">
                                        <ul>
                                            <li class="wholseale"><a href="category.html">Wholesale</a></li>
                                            <li><a class="search-icon" href="javascript:void(0);" data-aos="fade-down" data-aos-delay="400">
                                                  <span class="shop-icon">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                  </span>
                                                </a>
                                                <div class="search-wrapper">
                                                  <div class="searchForm">
                                                    <form action="" method="get">
                                                      <input type="search" name="s" class="serach-input" placeholder="Search Products">
                                                      <button class="btn btn-primary searchicon" type="submit"><i class="fa fa-search"></i></button>
                                                    </form>
                                                  </div>
                                                </div>
                                              </li>
                                            <li>
                                                <a href="#"><i style="font-size: 18px; margin-top: 5px;"
                                                        class="far fa-user"></i></a>
                                                <div class="dropdown-content account-dropdown">
                                                    @if(\Auth::check())
                                                    <?php $user = \Auth::user(); ?>
                                                    <ul class="user-details">
                                                        <li>
                                                            <p class="text-left"><i
                                                                    class="fa fa-user-circle theme-color user-icon"
                                                                    aria-hidden="true"></i> Hi, {{$user->name}}</p>
                                                        </li>
                                                        <li>
                                                            <p class="text-left"><i
                                                                    class="fa fa-table theme-color user-icon"
                                                                    aria-hidden="true"></i> Dashboard</p>
                                                        </li>
                                                        <li>
                                                          <form method="POST" action="{{route('store.logout')}}">
                                                            @csrf
                                                          <button style="border : 0px;background-color : white" class="float-left">
                                                            <span class="text-left"><i
                                                                    class="fa fa-power-off theme-color user-icon"
                                                                    aria-hidden="true"></i> Logout</span></button>
                                                          </form>
                                                        </li>
                                                    </ul>
                                                    @else
                                                    <ul>
                                                        <li>
                                                            <a href="{{ url('/redirect/facebook') }}"><img
                                                                    src="{{ asset('front_assets/images/facebook-svg.svg') }}"
                                                                    alt="" width="220" /></a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('/redirect/google') }}"><img
                                                                    src="{{ asset('front_assets/images/google-svg.svg') }}"
                                                                    alt="" width="220" /></a>
                                                        </li>
                                                        <li><strong>OR</strong></li>
                                                        <li><button type="button" class="btn-grey" data-toggle="modal"
                                                                data-target="#loginModal">Sign In</button></li>
                                                        <li><button type="button" class="btn-grey" data-toggle="modal"
                                                                data-target="#registerModal">Sign Up</button></li>
                                                    </ul>
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#"><i style="font-size: 18px; margin-top: 5px;"
                                                        class="far fa-heart"></i></a>
                                                <div class="dropdown-content wishlist-content">
                                                    <p><i style="font-size: 18px; margin-top: 5px;"
                                                            class="far fa-heart"></i>
                                                        <br />Love Something ? Save it here
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                          <a class="bag" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                             <span>1</span>
                                          </a>
                                        <div class="collapse" id="collapseExample">
                                          <ul class=" user-details">
                                             <div class="">
                                                <li>
                                                  <div class="maindiv">
                                                <div class="img-boxs"><img src="front_assets/images/kurti1.webp"></div>
                                                <div class="cart-content">
                                                   <h2><a href="#">Women garments</a></h2>
                                                  <p> RS 2,229.97 <span>Quantity: 01</span></p>
                                                </div>
                                                <div class="cart-close">
                                                   <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                   </div>
                                                </div>
                                                </li>
                                                <li>
                                                   <div class="maindiv">
                                                 <div class="img-boxs"><img src="{{ asset('front_assets/images/1a.jpg') }}"></div>
                                                 <div class="cart-content">
                                                    <h2><a href="#">Women garments</a></h2>
                                                   <p> RS 2,229.97 <span>Quantity: 01</span></p>
                                                 </div>
                                                 <div class="cart-close">
                                                    <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                    </div>
                                                 </div>
                                                 </li>
                                                  <li class="total-cart">
                                                      <span class="aa-cartbox-total-title">Total</span>
                                                      <span class="aa-cartbox-total-price">₹1220.00</span>
                                                  </li>
                                                 <li class="lastlist">
                                                 <a href="cart.html" class="procedtopay"> Proceed To Pay</a>
                                                    </li>
                                               </div>
                                          </ul>
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
    <div class="headertopspace"></div>
    <!--Slider Section start here-->

    @yield('content')

    <!-- Newsletter -->
    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="newsletter_title text-left">We accept</div>
                    <ul class="we-accept-img">
                        <li>
                            <a href="#"><img class="img-fluid" src="{{ asset('front_assets/images/payment.png') }}"
                                    alt="payments"></a>
                        </li>
                    </ul>
                </div>
                <div class=" col-md-4">
                    {{-- <div class="footer_column">
                        <div class="newsletter_title text-left">Download our app</div>
                        <ul class="footer_list">
                            <li>
                                <a href="#"><img class="img-fluid" src="{{ asset('front_assets/images/ios.png') }}"
                                        alt="payments"></a>
                            </li>
                            <li>
                                <a href="#"><img class="img-fluid"
                                        src="{{ asset('front_assets/images/android.png') }}" alt="payments"></a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="col-md-4">
                    <div class="newsletter_title text-left">Subscribe for Latest Update</div>
                    <div class="newsletter_content clearfix">
                        <form action="#" class="newsletter_form">
                            <input type="email" class="newsletter_input" required
                                placeholder="Enter your email address">
                            <button class="newsletter_button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="characteristics">
        <div class="container">
            <div class="row">
                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">
                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><i class="fas fa-check-circle"></i></div>
                        <div class="char_content">
                            <div class="char_title">100% Authorised
                                <br> product
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">
                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><i class="fas fa-truck"></i></div>
                        <div class="char_content">
                            <div class="char_title">15 Days Return </div>
                        </div>
                    </div>
                </div>
                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">
                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><i class="fas fa-headphones"></i></div>
                        <div class="char_content">
                            <div class="char_title"> Quick support </div>
                        </div>
                    </div>
                </div>
                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">
                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><i class="fas fa-handshake"></i></div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="footer-top">
        <div class="container">
            <div class="row">
                <div class=" col-md-4">
                    <div class="footer_column">
                        <div class="footer_title">Secure Pay</div>
                        <ul class="Secure-pay">
                            <li>
                                <a href="#"><img class="img-responsive"
                                        src="{{ asset('front_assets/images/SSL_Secure.png') }}" alt="payments"></a>
                            </li>
                            <li>
                                <a href="#"><img class="img-responsive"
                                        src="{{ asset('front_assets/images/ssl-secure-shopping.png') }}" width="80px"
                                        alt="payments"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer_column footer-contact">
                        <div class="footer_title">Any questions</div>
                        <div style="padding-top: 20px" class="media">
                            <div class="icon-support">
                                <i class="fab fa-whatsapp"></i>
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="support-text">
                                +91 6376681424
                            </div>
                        </div>
                        <div class="media">
                            <div class="icon-support"><i class="fas fa-envelope"></i></div>
                            <div class="support-text">
                                care@vasvi.in
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-4">
                    <div class="footer_column">
                        <div class="footer_title">Follow us</div>
                        <div class="footer_social">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <button class="float">
        <i class="fa fa-comments my-float" id="chatbox" aria-hidden="true"></i>
    </button>
    <div id="myForm" class="hide">
        <form action="/echo/html/" id="popForm" method="get">
            <div class="">
                <label class="chat-label" for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control input-md">
                <label class="chat-label" for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control input-md">
                <label class="chat-label" for="phone">Phone:</label>
                <input type="phone" name="email" id="phone" class="form-control input-md">
                <label class="chat-label" for="about">Message:</label>
                <textarea rows="3" name="about" id="about" class="form-control input-md"></textarea>
                <button type="button" class="btn btn-submit-review btn-block mt-4"
                    data-loading-text="Sending info.."><em class="icon-ok"></em> SUBMIT</button>
            </div>
        </form>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer_column">
                        <div class="footer_title">Customer</div>
                        <ul class="footer_list">
                            <li><a href="#">Girl Dreess & Tablets</a></li>
                            <li><a href="#">TV & Audio</a></li>
                            <li>
                                <a href="#" onclick="document.getElementById('id03').style.display='block'"><i
                                        class="fas fa-headset"></i> Help / Support</a>
                            </li>
                        </ul>
                        <div class="footer_subtitle">Gadgets</div>
                        <ul class="footer_list">
                            <li><a href="#">Car Electronics</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer_column">
                        <div class="footer_title">Policies</div>
                        <ul class="footer_list">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order Tracking</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Customer Services</a></li>
                            <li><a href="#">Returns / Exchange</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Product Support</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer_column">
                        <div class="footer_title">Vasvi and store</div>
                        <ul class="footer_list">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order Tracking</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Customer Services</a></li>
                            <li><a href="#">Returns / Exchange</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Product Support</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 footer_col">
                    <div class="footer_column">
                        <div class="footer_title">Contact Info</div>
                        <ul class="contact-info">
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong><br>G/13, Lorem ipsum
                                    Industrial Area,<br> Jaipur, Rajasthan</p>
                            </li>
                            <li>
                                <p><i class="fas fa-mobile-alt"></i><strong>Phone:</strong> <a href="tel:+911414037596">
                                        (+91) 141 4037596</a> - <a href="tel:+911414029596">4029596</a></p>
                            </li>
                            <li> <a href="#" target="_blank"><img alt="whatsapp"
                                        src="{{ asset('front_assets/images/whatsapp-icon.png') }}"
                                        style="margin-right: 7px;" width="15"><strong>Whatsapp:</strong> (+91)
                                    9314966969</a></li>
                            <li>
                                <p><i class="fas fa-envelope"></i><strong>Email:</strong><a
                                        href="mailto:info@vasvi.com">info@vasvi.com</a></p>
                            </li>
                            <li>
                                <p><i class="far fa-clock"></i><strong>Working Days/Hours:</strong><br>Mon - Sat /
                                    10:00AM - 7:00PM</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="copyright_container d-flex flex-sm-row flex-column">
                        <div style="text-align: center;" class="copyright_content col-md-12">
                            <p>Copyright @ 2018 vasvi.in - All Right Reserved | <a
                                    style="color: #979797; border-bottom: 0" href="http://dzoneindia.org/"
                                    target="_blank">Powered By dzone India.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="whatsup">
       <a href="https://web.whatsapp.com/" target="_blank"> <img src="https://vasvi.in/front_assets/images/whatsapp-logo.png" alt="wsp" ></a>
    </div>
    <div class="wholesale "><a href="category.html" target="_blank"> Wholesale</a></div>


  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>



    </div>
  </div>

    <script src="{{ asset('front_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/slimscroll.js')}}"></script>
    <script src="{{ asset('front_assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('front_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front_assets/js/megamenu.js') }}"></script>
    <script src="{{ asset('front_assets/js/zoom-slider.js')}}"></script>
    <script src="{{ asset('front_assets/js/zoom-slider-main.js')}}"></script>
    <script src="{{ asset('toast/toastr.min.js')}}"></script>
    <script>
     var user_register_data;
     var check_otp;
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

      var data = { email :  name, password : password};
      if(!error){
        $.ajax({
                type : 'POST',
                url: '{{route('store.login')}}',
                data : data,
                success : function(response)
                {
                  console.log(response);
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

    $(document).on('click','#verify', function(e){
      e.preventDefault();
      var otp = $(document).find('#otp').val();
      $(document).find('#otp-error').html('');
      var error = false;
      if(otp === ''){
        $(document).find('#otp-error').html('Field is required!');
        console.log('Blank');
        error = true;
      }
      else if(otp.length < 6){
        $(document).find('#otp-error').html('Please enter 6 digit OTP!');
        console.log('less');
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
          console.log('invalid');
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

        $(document).find('#signup-user-name-error').html('');
        $(document).find('#signup-user-email-error').html('');
        $(document).find('#signup-user-mobile-error').html('');
        $(document).find('#signup-user-city-error').html('');
        $(document).find('#signup-user-password-error').html('');
        var error = false;
        if(name === ''){
          $(document).find('#signup-user-name-error').html('Field is required!');
          error =  true;
        }

        if(password === ''){
          $(document).find('#signup-user-password-error').html('Field is required!');
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

        if(!error){
          $(document).find('#otp-mobile').val(mobile);
          user_register_data = {name : name, email : email, mobile : mobile, city : city, password : password};
          $.ajax({
                  type : 'POST',
                  url: '{{route('store.sendotp')}}',
                  data : {mobile : mobile},
                  success : function(response)
                  {
                    console.log(response);
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
                  console.log(response);
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
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
            $('.search-icon').click(function(){
                $('.search-wrapper').toggleClass('open');
                 $('body').toggleClass('search-wrapper-open');
              });
               $('.search-cancel').click(function(){
                $('.search-wrapper').removeClass('open');
                $('body').removeClass('search-wrapper-open');
              });
         </script>
    <script>
        $(document).ready(function() {
            $('.product-slider .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
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
                autoplay: true,
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
                autoplay: true,
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
                autoplay: true,
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
                autoplay: true,
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
        $(document).ready(function() {
            $(".signin-btn").click(function() {
                $("#registerModal").hide();

            });

            $(".signup-btn").click(function() {
                $("#loginModal").hide();

            });



        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#chatbox').popover({

                placement: 'top',
                title: 'Write a Note',
                html: true,
                content: $('#myForm').html()
            }).on('click', function() {
                // had to put it within the on click action so it grabs the correct info on submit
                $('.btn-submit-review ').click(function() {
                    $('#result').after("form submitted by " + $('#email').val())
                    $.post('/echo/html/', {
                        email: $('#email').val(),
                        name: $('#name').val(),
                        phone: $('#phone').val(),
                    }, function(r) {
                        $('#pops').popover('hide')
                        $('#result').html('resonse from server could be here')
                    })
                })
            })
        })
    </script>
    @stack('custom-scripts')
</body>

</html>
