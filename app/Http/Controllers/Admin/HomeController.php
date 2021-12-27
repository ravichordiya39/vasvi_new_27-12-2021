<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\UserOrder;
use App\Models\Refund;
use Carbon\Carbon;
use Auth, DB;

class HomeController extends Controller {
    public function index() {
        if(Auth::check()){

           if(Auth::user()->is_admin != 1){
               Auth::logout();
               return redirect('backoffice/login');
           }
           else{
               return   $this->desk();
            }
        }
        else{
            return $this->desk();
        }
    }

    public function desk(){
       $date = Carbon::now()->subDays(7);
       $users = User::where('is_admin',0)->get();
       $users_chart = User::select('*', DB::raw('count(*) as total'))
                      ->where('created_at', '>=', $date)
                      ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                      ->get();






       $products = Product::where('status',1)->get();
       $categories = Category::where('status',1)->get();
       $orders = UserOrder::all();
       $refunds = Refund::all();
       $cancels = UserOrder::where('status',4)->get();
       $yes_user = User::select('*', DB::raw('count(*) as total'))
                   ->whereDate('created_at', Carbon::yesterday())
                   ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                   ->first();

       $yes_users = $yes_user !== null ? $yes_user->total : 0;
       $yes_one_per = $yes_users != 0 ? ($yes_users !== null ? $yes_user->total/0.01 : 0) : 0;

       $today_user = User::select('*', DB::raw('count(*) as total'))
                   ->whereDate('created_at', Carbon::now())
                   ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                   ->first();


       $today_one_per = $today_user !== null ? $today_user->total/0.01 : 0;
       $today_user = $today_user ? $today_user->total : 0;

       $ratio = $today_user - $yes_users;
       $final_ratio = 0;
       if($yes_one_per !== 0){
          $final_ratio = $ratio/$yes_one_per;
       }
       else {
         $final_ratio =  $today_user * 100;
       }

       // $sales = UserOrder::where('user_orders.status', 3)
       //          ->select('user_orders.created_at', DB::raw('count(*) as total'))
       //          ->where('created_at', '>=', $date)
       //          ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))->get();


      $sales = DB::table('user_orders')
              ->select('created_at', DB::raw('count(*) as total'))
              ->where('created_at', '>=', $date)
              ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))->get();



       $offline = User::where('live',0)->where('is_admin',0)->get();
       $online = User::where('live',1)->where('is_admin',0)->get();

       $revenues = UserOrder::where('status', 3)->sum('total_amount');
       $rproducts = Product::where('status',1)->orderBy('id','desc')->limit(6)->get();
       $rsales= UserOrder::where('status',3)->orderBy('id','desc')->limit(6)->get();
       $rrefunds = Product::orderBy('id','desc')->limit(6)->get();
       $rcancels = UserOrder::where('status',4)->orderBy('id','desc')->limit(6)->get();
       $rcategories = Category::where('status',1)->orderBy('id','desc')->limit(6)->get();
       $rusers = User::where('is_admin',0)->orderBy('id','desc')->limit(6)->get();



       return view('dashboard',compact('users','products','categories','orders','refunds','cancels','revenues','sales','users_chart','final_ratio','online','offline','rsales','rrefunds','rcancels','rusers','rcategories','rproducts'));
    }
}
