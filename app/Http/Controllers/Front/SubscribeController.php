<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsLetter;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
       $subscribe = NewsLetter::where('email', $request->email)->first();

       if($subscribe){
           return response()->json([
               'success' => false,
               'code' => 503,
               'message' => 'Already subscribed'
           ]);
       }
       else{
           $sub = new NewsLetter;
           $sub->email = $request->email;
           $sub->save();
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Subscribed successfully'
            ]);
       }
    }
}
