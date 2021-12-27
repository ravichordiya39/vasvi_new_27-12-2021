<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth, DB;

class WishlistController extends Controller
{

    public function index(Request $request)
    {
       $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
    //    dd($wishlists);
       return view('store.wishlist.index', compact('wishlists'));
    }

    public function store(Request $request){
         $wishlist = Wishlist::where('product_id',$request->product_id)
                             ->where('user_id', Auth::user()->id)
                             ->first();
         if($wishlist){
            $wishlists = Wishlist::where('user_id', Auth::user()->id)
                                 ->get();

             return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Product already present in wishlist.',
                'data' => $wishlists
             ]);
         }
         else{
            $wish =  new Wishlist;
            $wish->user_id = Auth::user()->id;
            $wish->product_id = $request->product_id;
            $wish->name = $request->name;
            $wish->color_id = $request->color_id;
            $wish->size_id = $request->size_id;
            $wish->image = $request->image;
            $wish->mrp = $request->mrp;
            $wish->sale_price = $request->sale_price;
            $wish->save();

            $wishlists = Wishlist::where('user_id', Auth::user()->id)
                                 ->get();

            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Product added wishlist.',
                'data' => $wishlists
             ]);
         }
    }


    public function destroy($id)
    {
        $product_id = $id;
        $user_id = Auth::user()->id;

        Wishlist::where('product_id',$product_id)
                    ->where('user_id', $user_id)
                    ->delete();


        $wishlists = Wishlist::where('user_id', $user_id)->get();

        return response()->json([
        'success' => true,
        'code' => 200,
        'message' => 'Product remove from wishlist successfully.',
        'data' => $wishlists
        ]);
    }
}
