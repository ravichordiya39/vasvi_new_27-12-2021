<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title></title>
      <!-- Common  Css start here -->
      <link rel="stylesheet" type="text/css" href="{{asset('assets/auth/css/bootstrap.min-3.3.7.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/auth/css/style-new.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('assets/auth/css/front-new.css')}}">
      <!-- <link rel="stylesheet" type="text/css" href="{{asset('assets/auth/css/fontawesome-all.min.css')}}"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://fonts.googleapis.com/css?family=Sacramento&display=swap" rel="stylesheet">
      <!-- Common  Css start here -->
      <!-- Common  js start here -->
      <script type="text/javascript" src="{{asset('assets/auth/js/jquery-3.3.1.min.js')}}"></script>
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
      <!-- Common  js end here -->
   </head>
   <!-- Forgot Pass Modal Star here -->
   <div class="modal fade" id="forgotpassModal" tabindex="-1" role="dialog" aria-labelledby="forgotpassModalLabel" aria-hidden="true">
      <div class="modal-dialog opt-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Forgot Password</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">
                  <p style="font-size:13px; color:#333; margin-bottom:15px; line-height:25px; text-align:center;">Enter Your Email Address</p>
                  <input type="text" class="form-control text-center"  placeholder="Enter Verified Email Address" style="font-size:13px; height:40px; ">
               </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 mx-auto text-center" style="padding-bottom:20px;">
               <button type="button" class="btn btn-success f_size13" style="width:90%; padding-top:7px; padding-bottom:7px;" data-toggle="modal" data-target="#exampleModal">Reset My Password</button>
            </div>
         </div>
      </div>
   </div>
   <!-- Forgot Pass end here -->
   <!-- OTP Modal Star here -->
   <div class="modal" id="exampleModal">
      <div class="modal-dialog opt-dialog" role="document">
         <div class="modal-content otp-info-model">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">
                  <p style="font-size:13px; color:#333; margin-bottom:0px; line-height:25px; text-align:center;">A Verification code has been send to your mobile <br/>
                  </p>
                  <div class="form-group mobilenumber-input">
                     <input type="text" class="form-control text-center boldtxt" id="mobile11" style="font-size:16px; height:40px; ">
                     <button class="edit-icon text-danger">
                     <i class="fas fa-pencil-alt"></i></button>
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control otp-input text-center" placeholder="Enter Verification code (OTP)" id='code' style="font-size:13px; height:40px; ">
                  </div>
               </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12 mx-auto text-center" style="padding-bottom:20px;">
               <button type="button" class="btn btn-danger f_size13" style="width:90%; padding-top:7px; padding-bottom:7px;" id='submit'>VERIFY</button>
               <div class="clear" style="margin-top:15px;"></div>
               <a href="#" class="text-danger" onClick="resend();">Resend?</a>
            </div>
         </div>
      </div>
   </div>
   <!-- OTP Modal Star here -->
   <body class="login-body">
      <div class="container" style="position: relative;">
         <div class="logincontainer">
            <div class="row">
               <div class="col-md-12">
                  <div class="pad15">
                     <h2 class="modal_title">Member Sign In</h2>
                     <div class="loginform-subtitle">Enter registered mobile number OR email id to login</div>
                     <div class="formrow martop15 borbotnone">
                        <div class="col-md-12 text-center">
                           <a href="{{ url('/redirect/facebook') }}" class="btn btn-social btnfb"><i class="fa fa-facebook-f"></i> <span class="divider"></span> Login with Facebook</a>
                           <a href="{{ url('/redirect/google') }}" class="btn btn-social btn-gmail"><i class="fa fa-google"></i> <span class="divider"></span> Login with Google</a>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <form action="{{route('login')}}" method="post">
                          @csrf
                           <div class="formrow">
                              <label class="label-title">Mobile Number, Email ID</label>
                              <div class="icon"><i class="fa fa-envelope"></i></div>
                              <input type="text" name="username" value="" class="form-control">
                           </div>
                           <div class="formrow">
                              <label class="label-title">Password</label>
                              <div class="icon" style="font-size:25px;">***</div>
                              <input type="password" name="password" value="" class="form-control">
                           </div>
                           <div class="formrow borbotnone">
                              <div class="row">
                                 <div class="col-md-8 text-left txt-terms" ><input type="checkbox">I accept agreen <a href="#">New Customer Agreement</a></div>
                                 <div class="col-md-4 text-right txt-forgotpass" ><a href="JavaScript:Void(0);" data-toggle="modal" data-target="#forgotpassModal" >Forgot Password</a></div>
                              </div>
                           </div>
                           <div class="row martop10">
                              <div class="col-md-12" style="text-align:center;">
                                <button name="submit" class="btn  btn-signup btn-pink " type="submit">SIGN IN</button>
                              </div>
                              <div class="col-md-12 signuplink">Don't have an account? <a name="submit" class="" type="button" href="{{route('register')}}">Sign Up</a></div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
   </body>
</html>
