<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use App\Models\ProductVariation;
use DB,Auth;
use Session;
use App\Models\Coupon;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
       $coupon = $request->has('coupon') ? $request->get('coupon') : 'no';
       $coupon = $coupon === null ? 0 : $request->get('coupon');
       $coupon_discount = $request->has('coupon_val') ? $request->get('coupon_val') : 'no';
       $coupon_discount = $coupon_discount === null ? 0 : $request->get('coupon_val');
       $carts = Session::has('cart') ? Session::has('cart') : [];
       $countries = DB::table('countries')->select('id','name')->get();
       $addresses = [];
       if(Auth::check()){
        $addresses =  DB::table('user_addresses')->where('user_id',Auth::user()->id)->get();
       }
       $states = DB::table('states')->get();

       return view('store.checkout.index', compact('addresses','coupon','coupon_discount','countries','states'));
    }

    public function buynow(Request $request)
    {
        $product_id = $request->product_id;
        $size_id = $request->size_id;
        $color_id = $request->color_id;

        $addresses = [];
        $auth = false;
        if(Auth::check()){
            $auth = true;
            $addresses =  DB::table('user_addresses')->where('user_id',Auth::user()->id)->get();
        }
        $coupon = 0;
        $coupon_discount = 0;
        $allCoupons = Coupon::where('status',1)->where('valid_from','<=',date('Y-m-d H:i:s'))->where('valid_to','>=',date('Y-m-d H:i:s'))->get();
        $countries = DB::table('countries')->select('id','name')->get();
        $states = DB::table('states')->get();
        $product = Product::whereHas('productProductVariations',
                    function (Builder $query)  use ($size_id, $color_id) {
                        $query->where('size_id', $size_id)->where('color_id', $color_id);
                    })
                    ->where('id', $product_id)
                   ->first();

        $productVariation = ProductVariation::where('product_id', $product_id)->where('size_id', $size_id)->where('color_id', $color_id)->first();

        return view('store.checkout.buynow', compact('addresses','coupon','coupon_discount','product','allCoupons','productVariation','countries','states'));
    }
}
