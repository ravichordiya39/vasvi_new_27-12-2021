<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function get_stores(Request $request)
    {
        $stores = Store::where('pin_codes', 'like', '%'.$request->pincode.'%')->get();
        $code = 200;
        $message = '';
        $success = false;
        $data = '';

        if($stores->count() > 0){
            $code = 200;
            $message = 'Stores retrieve successfully';
            $success = true;
            $data = $stores;
        }
        else{
            $code = 404;
            $message = 'Stores not available';
            $success = false;
            $data = [];
        }

        return response()->json([
            'success' => $success,
            'code' => $code,
            'data' => $data,
            'message' => $message
        ]);
    }

    public function show_stores(request $request)
    {
        $stores = Store::where('pin_codes', 'like', '%'.$request->pincode.'%')->get();
        $code = 200;
        $message = '';
        $success = false;
        $data = '';

        if($stores->count() > 0){
            $code = 200;
            $message = 'Stores retrieve successfully';
            $success = true;
        }
        else{
            $code = 404;
            $message = 'Stores not available';
            $success = false;
        }

        return response()->json([
            'success' => $success,
            'code' => $code,
            'message' => $message
        ]);
    }
}
