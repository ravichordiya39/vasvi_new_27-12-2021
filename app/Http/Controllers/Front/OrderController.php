<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\Payment;
use App\Models\Refund;
use App\Models\RefundReason;
use App\Models\UserOrder;
use Razorpay\Api\Api;
use Carbon\Carbon;
use DB,Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
                  ->join('order_discounts','order_discounts.order_id', 'orders.order_id')
                  ->join('payments', 'payments.order_id', 'orders.order_id')
                  ->select('orders.*','order_discounts.total as final_total','order_discounts.discount as product_discount','order_discounts.coupon_discount as coupon_discount','order_discounts.sub_total as sub_total','order_discounts.coupon as coupon','payments.transaction_id as trans_id','payments.type as payment_type','payments.amount as payable_amount')
                  ->where('orders.user_id', Auth::user()->id)
                  ->get();



        return view('store.orders.index', compact('orders'));
    }


    public function cancel_order(Request $request){
        try{

            $uorder = UserOrder::find($request->order_id);
            $payment =Payment::where('order_id', $request->order_id)->first();
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payId = $payment->transaction_id;
            $data = $api->payment->fetch($payId);

            if($data){
                if($data->status !== 'refunded'){
                    $contact = $data->contact;
                    $email = $data->email;
                    $desc = $data->description;
                    $card_id = $data->card_id;
                    $currency = $data->currency;
                    $amount = $data->amount;



                    $receipt = "$payment->id"."$payment->user_id";

                    $output = $api->payment->fetch($payId)->refund(array("amount"=> $amount,"speed"=>"optimum","receipt"=>$receipt));


                    $re = new Refund;
                    $re->refund_id = $output->id;
                    $re->refund_reason_id = $request->reason_id;
                    $re->payment_id = $output->payment_id;
                    $re->notes = $request->has('note') ? $request->note : null;
                    $re->status = $output->status;
                    $re->speed_requested = $output->speed_requested;
                    $re->updated_at = Carbon::now();
                    $re->save();

                    $uorder->status = 4;
                    $uorder->save();


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
