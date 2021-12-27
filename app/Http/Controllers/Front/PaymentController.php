<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductImage;
use App\Models\Refund;
use App\Models\UserOrder;
use App\Models\OrderProductMessage;
use App\Models\OrderProductGift;
use App\Models\UserAddress;
use App\Models\Wallet;
use Session;
use Exception;
use Validator;
use URL;
use Auth;
use Redirect;
use Input;
use Config;
use DB;

class PaymentController extends Controller
{
    public function index(){
        return view('frontend.payment');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                if($response->status === 'captured'){

                    $amount = floatval($response->amount / 100);
                    $amount = $amount + $request->wamount;
                    $user = Auth::user();

                    $address = UserAddress::find($request->address_id);
                    $user_address = $address->name . ' ' . $address->area . ' ' .$address->house . ' ' .$address->landmark.'  '.$address->city.','.$address->state->name.','.$address->country->name.','.$address->pincode.',mobile:'.$address->mobile;

                    $order_id = $request->orderid;
                    $carts = session('cart');
                    $total = 0;
                    $disc = 0;
                    $sub_total = 0;
                    $coupon = $request->has('coupon') ? $request->coupon : 0;
                    $coupon_discount = $request->has('discount') ? $request->discount : 0;

                    $uorder =  new UserOrder;
                    $uorder->user_id = $user->id;
                    $uorder->order_id = $order_id;
                    $uorder->amount = $amount;
                    $uorder->address = $user_address;
                    $uorder->address_type = $address->address_type;
                    $uorder->use_wallet = $request->usewallet == true ? 1 : 0;
                    $uorder->wallet_amount = $request->wamount;
                    $uorder->status = 0;
                    $uorder->save();

                    $wall = Wallet::where('user_id',$user->id)->first();
                    $wfamount = $wall->amount - $request->wamount;

                    DB::table('wallets')->where('user_id',$user->id)->update([
                        'amount' => $wfamount
                    ]);

                    foreach($carts as $cart){
                        $product = Product::find($cart['product_id']);
                        $order = new Order;
                        $order->order_id = $uorder->id;
                        $order->user_id = $user->id;
                        $order->product_id = $cart['product_id'];
                        $order->name = $cart['name'];
                        $order->size_id = $cart['size_id'];
                        $order->color_id = $cart['color_id'];
                        $order->qty = $cart['qty'];
                        $order->mrp_price = $cart['single_price'];
                        $order->sale_price = $cart['single_sales_price'];
                        $order->discount = $product->discount;
                        $order->discount_type = $product->discount_type;
                        $order->status = 0;
                        $order->images = $cart['product_images'][0];
                        $order->save();

                        if(isset($cart['gift'])){
                           $gift =  new OrderProductGift;
                           $gift->order_product_id = $order->id;
                           $gift->sender = $cart['gift']['sender'];
                           $gift->recipient = $cart['gift']['recipient'];
                           $gift->message = $cart['gift']['message'];
                           $gift->gift_type = $cart['gift']['type'];
                           $gift->save();
                        }

                        if(isset($cart['message'])){
                            $msg =  new OrderProductMessage;
                            $msg->order_product_id = $order->id;
                            $msg->sender = $cart['message']['sender'];
                            $msg->recipient = $cart['message']['recipient'];
                            $msg->message = $cart['message']['message'];
                            $msg->save();
                        }
                        $total += $cart['single_price'];
                        $disc += $cart['single_price'] - $cart['single_sales_price'];
                    }

                    $dis = new OrderDiscount;
                    $dis->order_id = $uorder->id ;
                    $dis->total = $total;
                    $dis->discount = $disc;
                    $dis->sub_total = $total - $disc - $coupon_discount;
                    $dis->coupon = $request->coupon;
                    $dis->coupon_discount = $coupon_discount;
                    $dis->save();

                    $pay = new Payment;
                    $pay->user_id = $user->id;
                    $pay->order_id = $uorder->id ;
                    $pay->transaction_id = $input['razorpay_payment_id'];
                    $pay->type = 'Online';
                    $pay->amount = $amount;
                    $pay->save();

                    session()->forget('cart');
                    return response()->json([
                        'success' => true,
                        'code' => 200,
                        'message' => 'Order placed'
                    ]);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'code' => 403,
                        'message' => 'Payment failed, please try again!'
                    ]);
                }
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'code' => 503,
                    'message' => $e->getMessage()
                ]);
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->back();
    }


    public function buynow(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));


                if($response->status === 'captured'){
                    $amount = floatval($response->amount / 100);
                    $amount = $amount + $request->wamount;
                    $user = Auth::user();


                    $address = UserAddress::find($request->address_id);

                    $user_address = $address->name . ' ' . $address->area . ' ' .$address->house . ' ' .$address->landmark.'  '.$address->city.','.$address->state->name.','.$address->country->name.','.$address->pincode.',mobile:'.$address->mobile;

                    $order_id = $request->orderid;

                    $coupon = $request->has('coupon') ? $request->coupon : 0;
                    $coupon_discount = $request->has('discount') ? $request->discount : 0;

                    $uorder =  new UserOrder;
                    $uorder->user_id = $user->id;
                    $uorder->amount = $amount;
                    $uorder->order_id = $request->orderid;
                    $uorder->address = $user_address;
                    $uorder->address_type = $address->address_type;
                    $uorder->use_wallet = $request->usewallet == true ? 1 : 0;
                    $uorder->wallet_amount = $request->wamount;
                    $uorder->status = 0;
                    $uorder->save();

                    $wall = Wallet::where('user_id',$user->id)->first();
                    $wfamount = $wall->amount - $request->wamount;

                    DB::table('wallets')->where('user_id',$user->id)->update([
                        'amount' => $wfamount
                    ]);


                    $product_id = $request->product_id;
                    $color_id = $request->color_id;
                    $size_id = $request->size_id;
                    $qty = $request->qty;
                    $product = ProductVariation::where('size_id',$size_id)
                               ->where('color_id', $color_id)
                               ->where('product_id', $product_id)
                               ->first();


                    $opro = Product::where ('id', $product_id)->first();

                        $order = new Order;
                        $order->order_id = $uorder->id;
                        $order->user_id = $user->id;
                        $order->product_id = $product->product_id;
                        $order->name = $opro->name;
                        $order->size_id = $size_id;
                        $order->color_id = $color_id;
                        $order->qty = $qty;
                        $order->mrp_price = $product->single_price * $qty;
                        $order->sale_price = $product->single_sales_price * $qty;
                        $order->discount = $opro->discount;
                        $order->discount_type = $opro->discount_type;
                        $order->status = 0;

                        $image = ProductImage::where('product_color_id', $color_id)->where('product_id', $product_id)->first();
                        $order->images = $image->file_name;
                        $order->save();


                    $dis = new OrderDiscount;
                    $dis->order_id = $uorder->id ;
                    $dis->total = $product->single_price * $qty;
                    $dis->discount = $product->single_price * $qty - $product->single_sales_price * $qty;
                    $dis->sub_total = ($product->single_price * $qty) - ($product->single_sales_price * $qty) - $coupon_discount;
                    $dis->coupon = $request->coupon;
                    $dis->coupon_discount = $coupon_discount;
                    $dis->save();

                    $pay = new Payment;
                    $pay->user_id = $user->id;
                    $pay->order_id = $uorder->id ;
                    $pay->transaction_id = $input['razorpay_payment_id'];
                    $pay->type = 'Online';
                    $pay->amount = $amount;
                    $pay->save();

                    // session()->forget('cart');

                    return response()->json([
                        'success' => true,
                        'code' => 200,
                        'message' => 'Order placed'
                    ]);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'code' => 403,
                        'message' => 'Payment failed, please try again!'
                    ]);
                }

            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'code' => 503,
                    'message' => $e->getMessage()
                ]);
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->back();
    }

    public function refund(Request $request)
    {
        try{
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payId = $request->payment_id;
            $data = $api->payment->fetch($payId);

            if($data){
                if($data->status !== 'refunded'){
                    $contact = $data->contact;
                    $email = $data->email;
                    $desc = $data->description;
                    $card_id = $data->card_id;
                    $currency = $data->currency;
                    $amount = $data->amount;

                    $pay = Payment::where('transaction_id', $payId)->first();

                    $receipt = "$pay->id"."$pay->user_id";

                    $output = $api->payment->fetch($payId)->refund(array("amount"=> $amount,"speed"=>"optimum","receipt"=>$receipt));
                    dd($output);

                    $re = new Refund;
                    $re->refund_id = $output->id;
                    $re->payment_id = $output->payment_id;
                    $re->note = $request->note ? $request->note : null;
                    $re->status = $output->status;
                    $re->speed_requested = $output->speed_requested;
                    $re->updated_at = Carbon::now();
                    $re->save();


                    return response()->json([
                        'success' => true,
                        'code' => 200,
                        'message' => 'You request for refund is process. You getting refund within 24 hour. Thank you!',
                        'data' => $output
                    ]);
                }
                else{
                    return response()->json([
                        'success' => true,
                        'code' => 200,
                        'message' => 'You request for refund is already refunded.',
                    ]);
                }
            }


        }
        catch(Exception $ex){

           return response()->json([
               'success' => false,
               'code' => 503,
               'message' => $ex->getMessage(),
           ]);
        }
    }

}
