<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Coupon;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index(){
        $coupons = Coupon::where('valid_to','>=', Carbon::now())
                   ->where('status',1)
                   ->whereIn('coupon_type',[0,2])
                   ->whereIn('user_type',[0,1,2,4])
                   ->get();


        $products = Product::orderBy('view_count','desc')->limit(10)->get();
        \Session::forget('gift');
        \Session::forget('gift_type');
        \Session::forget('gift_cart_id');
        $carts = \Session::has('cart') ? session()->get('cart') : [];


        return view('store.cart.index', compact('carts','products','coupons'));
    }

    public function apply_coupon(Request $request)
    {
        $coupon = Coupon::where('valid_to','>=', Carbon::now())
                  ->where('status',1)
                  ->where('code',$request->coupon)
                  ->whereIn('coupon_type',[0,2])
                  ->whereIn('user_type',[0,1,2,4])
                  ->first();
        $discount_price = 0;
        if($coupon){
           if($request->amount > $coupon->min_cart_amount){
               $discount = 0;
               if($coupon->discount_type === 1){
                $discount = $coupon->max_discount;

               }
               else{
                $discount = $request->amount  * ($coupon->max_discount/100) ;
               }


               \Session::put('coupon', $request->coupon);
               \Session::put('coupon_discount', (int)$discount);


               return response()->json([
                    'success' => true,
                    'code' => 200,
                    'message' => 'Coupon Apply successfully',
                    'coupon_price' => (int)$discount
                ]);

           }
           else{
            \Session::put('coupon', 0);
            \Session::put('coupon_discount', 0);

                return response()->json([
                    'success' => true,
                    'code' => 403,
                    'message' => 'Order amount should be more then Rs'.$coupon->min_cart_amount,
                ]);
            }

        }
        else{
            return response()->json([
                'success' => true,
                'code' => 404,
                'message' => 'Invalid coupon',
            ]);
        }
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart',[]);
        $var = ProductVariation::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id',$request->size_id)->first();

        $product = Product::find($request->product_id);

        if(isset($cart[(int)$var->id.$request->color_id])) {
                $cart[(int)$var->id.$request->color_id]['qty'] = $cart[(int)$var->id.$request->color_id]['qty'] + $request->qty;
        } else {
            $cart[(int)$var->id.$request->color_id] = [
                'id' => (int)$var->id.$request->color_id,
                'name' => $product->name,
                'product_id' => $var->product_id,
                'color_id' => $var->color_id,
                'size_id' => $var->size_id,
                'primary_variation' => $var->primary_variation,
                'qty' => $request->qty,
                'single_price' => $request->mrp_price,
                'single_sales_price' => $request->sales_price,
                'single_price_quantity' => $request->qty,
                'wholesale_price' => $var->wholesale_price,
                'wholesale_sales_price' => $var->wholesale_sales_price,
                'wholesale_price_quantity' => $var->wholesale_price_quantity,
                'size_status' => $var->size_status,
                'status' => $var->status,
                'product_images' => $request->product_images,
                'created_at' => Carbon::now()
            ];


        }
        session()->put('cart', $cart);
        $rescart = [];
        foreach(session()->get('cart') as $c){
            array_push($rescart,$c);
        }

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Product add to cart successfully',
            'cart' => $rescart,
            'count' => count(session()->get('cart'))
        ]);

    }

    public function show($id){
        $cart = session()->get('cart',[]);
        if(isset($cart[(int)$id])) {
           $data = $cart[(int)$id];
           if(isset($data['gift'])){
               return response()->json([
                   'success' => true,
                   'code' => 200,
                   'message' => 'Gift found',
                   'data' => $data['gift']
               ]);
           }
           else{
                return response()->json([
                    'success' => true,
                    'code' => 404,
                    'message' => 'Gift not found',
                    'data' => []
                ]);
           }
        }
        else{
            return response()->json([
                'success' => false,
                'code' => 503,
                'message' => 'Cart not found',
                'data' => []
            ]);
        }

        return $data;

    }

    public function gift_store(request $request){
        $cart = session()->get('cart',[]);
        if(isset($cart[(int)$request->cart_id])) {
            $gift = [
                'type' => $request->gift_type,
                'sender' => $request->sender,
                'recipient' => $request->recipient,
                'message'=> $request->message,
            ];
            $cart[(int)$request->cart_id]['gift'] = $gift;
            session()->put('cart', $cart);
            $cart = session()->get('cart',[]);

            \Session::put('gift', true);
            \Session::put('gift_type', $request->gift_type);
            \Session::put('gift_cart_id', $request->cart_id);

            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Gift card saved successfully.'
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Cart not found'
            ]);

        }

    }


    public function msg_show($id){
        $cart = session()->get('cart',[]);
        if(isset($cart[(int)$id])) {
           $data = $cart[(int)$id];
           if(isset($data['message'])){
               return response()->json([
                   'success' => true,
                   'code' => 200,
                   'message' => 'Message found',
                   'data' => $data['gift']
               ]);
           }
           else{
                return response()->json([
                    'success' => true,
                    'code' => 404,
                    'message' => 'Message  not found',
                    'data' => []
                ]);
           }
        }
        else{
            return response()->json([
                'success' => false,
                'code' => 503,
                'message' => 'Cart not found',
                'data' => []
            ]);
        }

        return $data;

    }

    public function msg_store(request $request){
        $cart = session()->get('cart',[]);
        if(isset($cart[(int)$request->cart_id])) {
            $message = [
                'sender' => $request->sender,
                'recipient' => $request->recipient,
                'message'=> $request->message,
            ];
            $cart[(int)$request->cart_id]['message'] = $message;
            session()->put('cart', $cart);
            $cart = session()->get('cart',[]);
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Message saved successfully.'
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Cart not found'
            ]);

        }

    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->qty;
            session()->put('cart', $cart);
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Product quantity updated successfully.',
            ]);
        }
        else{
            return response()->json([
                'success' => true,
                'code' => 404,
                'message' => 'Not found.',
            ]);
        }
    }

    public function size_update(Request $request)
    {
        if($request->id && $request->size){
            $product = ProductVariation::where('product_id', $request->product_id)
                              ->where('size_id',$request->size)
                              ->where('color_id', $request->color_id)
                              ->first();

            $cart = session()->get('cart');
            $cart[$request->id]["size_id"] = $request->size;
            $cart[$request->id]["primary_variation"] = $product->primary_variation;
            $cart[$request->id]["single_price"] = $product->single_price;
            $cart[$request->id]["single_sales_price"] = $product->single_sales_price;
            $cart[$request->id]["single_price_quantity"] = $product->single_price_quantity;
            $cart[$request->id]["wholesale_price"] = $product->wholesale_price;
            $cart[$request->id]["wholesale_sales_price"] = $product->wholesale_sales_price;
            $cart[$request->id]["wholesale_price_quantity"] = $product->wholesale_price_quantity;
            $cart[$request->id]["size_status"] = $product->size_status;
            $cart[$request->id]["status"] = $product->status;
            $cart[$request->id]["qty"] = $request->qty;

            session()->put('cart', $cart);
            $data = $this->update_response(1);
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Product size updated successfully.',
                'carts' => $data,
                'count' => count(session()->get('cart'))
            ]);
        }
        else{
            return response()->json([
                'success' => true,
                'code' => 404,
                'message' => 'Not found.',
            ]);
        }
    }

    public function qty_update(Request $request)
    {
        if($request->id && $request->qty){
            $cart = session()->get('cart');
            $cart[$request->id]["qty"] = $request->qty;
            session()->put('cart', $cart);
            $data = $this->update_response();
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Product quantity updated successfully.',
                'carts' => $data,
                'count' => count(session()->get('cart'))
            ]);
        }
        else{
            return response()->json([
                'success' => true,
                'code' => 404,
                'message' => 'Not found.',
            ]);
        }
    }

    public function remove(Request $request)
    {

        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                session()->forget('cart.'.$request->id);
                // unset($cart[$request->id]);
                session()->put('cart', session()->get('cart'));
            }

            $data = $this->update_response(0);
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Product remove from cart successfully.',
                'carts' => $data
            ]);
        }
        else{
            return response()->json([
                'success' => true,
                'code' => 404,
                'message' => 'Not found.',
            ]);
        }
    }

    public function update_response($size = 0){
        $carts = session('cart');
        $rescart = [];
        $temp = [];
        $i = 0;

        foreach($carts as $cart){
            $temp['id'] = $cart['id'];
            $temp['name'] = $cart['name'];
            $temp['product_id'] = $cart['product_id'];
            $temp['color_id'] = $cart['color_id'];
            $temp['size_id'] = $cart['size_id'];
            $temp['primary_variation'] = $cart['primary_variation'];
            $temp['qty'] = $cart['qty'];
            $temp['single_price'] = $cart['single_price'];
            $temp['single_sales_price'] = $cart['single_sales_price'];
            $temp['single_price_quantity'] = $cart['single_price_quantity'];
            $temp['wholesale_price'] = $cart['wholesale_price'];
            $temp['wholesale_sales_price'] = $cart['wholesale_sales_price'];
            $temp['wholesale_price_quantity'] = $cart['wholesale_price_quantity'];
            $temp['size_status'] = $cart['size_status'];
            $temp['status'] = $cart['status'];
            $temp['product_images'] = $cart['product_images'];
            $temp['gift'] = array_key_exists("gift",$cart) ? $cart['gift'] : null;
            array_push($rescart, $temp);
        }

        return $rescart;
    }


    public function getting_cart(){
         $data = $this->update_response();
         return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Getting cart successfully.',
            'carts' => $data,
            'count' => count(session()->get('cart'))
        ]);
    }
}
