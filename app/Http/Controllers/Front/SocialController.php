<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite, Auth;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Config;
use App\Models\Newsletter;
use Phpfastcache\Helper\Psr16Adapter;
use App\Models\Setting;


class SocialController extends Controller
{
  public function redirect($provider)
    {
       try{
           return Socialite::driver($provider)->redirect();
       }
      catch(\Exception $e){
         \Log::info($e);
      }
    }

    public function callback($provider)
    {
      try {

          $user = Socialite::driver($provider)->user();
          $isUser = User::where('email', $user->email)->first();
          $ramount = Config::find(1)->referral_amount;

          if($isUser){
              Auth::login($isUser);
              return redirect('/');
          }else{
              $createUser = User::create([
                  'name' => $user->name,
                  'email' => $user->email,
                  'provider_id' => $user->id,
                  'provider' => $provider,
                  'password' => encrypt('admin@123'),
                  'referral_code' => get_sku(12),
              ]);

              $wall = new Wallet;
              $wall->user_id = $createUser->id;
              $wall->amount = $ramount;
              $wall->save();

              $sub = new  Newsletter;
              $sub->email = $createUser->email;
              $sub->save();

              Auth::login($createUser);
              return redirect('/');
          }

      } catch (Exception $exception) {
          dd($exception->getMessage());
      }

        // $getInfo = Socialite::driver($provider)->user();
        // if($getInfo){
        //   $user = User::where('provider_id', $getInfo->id)->first();
        //
        //   if(!$user){
        //     $user = User::create([
        //       'name' => $getInfo->name,
        //       'email' => $getInfo->email,
        //       'provider' => $provider,
        //       'provider_id' => $getInfo->id
        //     ]);
        //
        //     Auth::login($user);
        //   }
        //   Auth::login($getInfo);
        // }
    }


    public function insta_feed()
    {
       try{
        $store = Setting::select('instagram_username','instagram_password')->first();
       
        $instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(), $store->instagram_username , $store->instagram_password, new Psr16Adapter('Files'));
        $instagram->login();
        $posts = $instagram->getFeed();

        $view = view('store.partials.instapost', compact('posts'))->render();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Post fetch successfully.',
            'html' => $view
        ]);
       }
       catch(Exception $ex){
        return response()->json([
            'success' => false,
            'code' => 503,
            'message' => 'Post fetch error.',
        ]);
       }
    }

}
