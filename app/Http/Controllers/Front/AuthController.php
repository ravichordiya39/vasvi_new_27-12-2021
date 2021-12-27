<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referral;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Config;
use App\Models\Newsletter;
use Auth, Hash ;

class AuthController extends Controller
{
    public function login(){
       Auth::logout();
        return view('front.auth.login');
    }

    public function logged_in(Request $request){

        // exstra addititon
      $user = User::where('email', $request->email)->where('is_admin', 1)->first();
      if($user){
        return response()->json([
            'success' => false,
            'code' => 400,
            'message' => 'Please again your credentials and try.'
          ]);
      }

      //   end
      if(auth()->attempt(array('email' => $request->email ,'password' => $request->password))){
          return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'You are logged in'
          ]);
      }
      else if(auth()->attempt(array('mobile' => $request->email, 'password' => $request->password))){
        return response()->json([
          'success' => true,
          'code' => 200,
          'message' => 'You are logged in'
        ]);
      }
      else{

        return response()->json([
          'success' => false,
          'code' => 400,
          'message' => 'Please again your credentials and try.'
        ]);
      }

    }

    public function register(){
          return view('front.auth.register');
    }

    public function registered(Request $request){
      $data = $request->all();
      $check = $this->create($data);
      $ramount = Config::find(1)->referral_amount;

      if($request->has('referral')){
          $re = User::where('referral_code', trim($request->referral))->where('ref_status', 1)->first();
          if($re){
              $ref = new Referral;
              $ref->ref_id = $re->id;
              $ref->user_id = $check->id;
              $ref->save();

                $add = Wallet::where('user_id', $re->id)->first()->amount;

                $wall = new Wallet;
                $wall->user_id = $re->id;
                $wall->amount = $add + $ramount;
                $wall->save();
          }
      }

      $wall = new Wallet;
      $wall->user_id = $check->id;
      $wall->amount = $ramount;
      $wall->save();

      $sub = new  Newsletter;
      $sub->email = $check->email;
      $sub->status = 1;
      $sub->save();

      if(auth()->attempt(array('email' => $request->email ,'password' => $request->password))){
        return response()->json([
          'success' => true,
          'message' => 'Register successfully',
          'code' => 200
        ]);
      }
      else{
        return response()->json([
          'success' => true,
          'message' => 'Register successfully',
          'code' => 200
        ]);
      }
    }


    public function create(array $data)
   {
     return User::create([
       'name' => $data['name'],
       'email' => $data['email'],
       'password' => Hash::make($data['password']),
       'mobile' => $data['mobile'],
       'city_id' => $data['city'],
       'referral_code' => get_sku(12),
     ]);
   }

    public function logout(){
      Auth::logout();
     return redirect('/');
    }


    public function sendotp(Request $request)
    {
      try{
        $mobile = $request->mobile;
        $user = User::where('mobile', $mobile)->orWhere('email', $mobile)->first();
        if($user){
          return response()->json([
            'success' => false,
            'code' =>  220,
            'message' => 'Unique mobile number/email is required! this email or mobile which is already exists in out records.',
          ]);
        }
        $client = new \GuzzleHttp\Client();
        $key = env('SMS_AUTH_KEY');
        $otp = generateNumericOTP(6);
        $message = 'Your VASVI verification OTP - ' . $otp;
        $response = $client->request('GET', "http://www.dakshinfosoft.com/api/sendhttp.php?authkey=9293ATiWinrHpi9615ff325&mobiles=$mobile&message=Thanks%20shopping%20with%20VASVI.%20Your%20invoice%20no.%20%7B%23$otp%23%7D%20dated%20%7B%23var%23%7D%20amt.%7B%23var%23%7D.%20We%20will%20be%20honored%20to%20serve%20you%20in%20future.&sender=VASVII&route=4&country=91");

        if($response->getBody()){
          return response()->json([
            'success' => true,
            'code' =>  200,
            'otp' => $otp,
            'mobile' =>  $mobile,
            'message' => 'Otp send it to user successfully.'
          ]);
        }
      }
      catch(Exception $ex){
        return response()->json([
            'success' => false,
            'code' =>  503,
            'message' => $ex->getMessage()
          ]);
      }
    }
}
