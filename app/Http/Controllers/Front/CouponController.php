<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index()
    {

         $coupon = Coupon::where('valid_to','>=', date('Y-m-d H:i:s'))
                  ->where('status',1)
                  ->where('code','JHAIOKF98457HJS')
                  ->first();

                  dd($coupon);
    }
}
