<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Wallet;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\UserOrder;
use App\Models\Payment;
use App\Models\RefundReason;
use DB, Auth;

class UserAccountController extends Controller
{
    public function index(){
        $auth = Auth::user();
        $cities = City::all();
        $countries = Country::all();
        $states = State::all();
        $addresses = UserAddress::where('user_id', $auth->id)->get();
        $wallet = Wallet::where('user_id', $auth->id)->first();
        $orders = UserOrder::where('user_id',$auth->id)->orderBy('id','desc')->paginate(5);
        $reasons = RefundReason::all();

        $walletamount = 0;
        if(!$wallet){
           $wallet = new Wallet;
           $wallet->user_id = $auth->id;
           $wallet->amount = 0;
           $wallet->save();
           $walletamount = 0;
        }
        else{
           $walletamount = $wallet->amount;
        }
        return view('store.users.dashboard', compact('auth','cities','addresses','countries', 'states','walletamount','orders','reasons'));
    }

    public function changepass(Request $request)
    {
        $this->validate($request, [
            'password' => 'min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->with('cp_success','Password changed successfully.');
    }

    public function detail(Request $request)
    {
        $this->validate($request, [
            'city' => 'required',
            'name' => 'required|min:3',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find(Auth::user()->id);
        

        if($request->has('avatar')){
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('file'), $imageName);
            $user->avatar = $imageName;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->city_id = $request->city;
        $user->save();

        return redirect()->back()->with('detail_success','Detail updated successfully.');
    }
}
