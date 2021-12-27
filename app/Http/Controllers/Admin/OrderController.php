<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserOrder;
use App\Models\Refund;
use App\Models\OrderDiscount;
use App\Models\Payment;
use App\Models\RefundReason;
use App\Models\Setting;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = UserOrder::latest()->get();

            $table = Datatables::of($data);

            $table->addIndexColumn();

            $table->editColumn('id', function ($row) {
                $id =  $row->id ? $row->id : '';
                return '<div class="text-center"><span class="text-dark">'.$id.'</span></div>';
            });
            $table->editColumn('order_id', function ($row) {
                return '<div class="text-center"><span class="badge badge-info p-2">'.$row->order_id.'</span></div>';
            });
            $table->editColumn('product', function ($row) {
                $name =  $row->orders ? $row->orders[0]->name : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });

            $table->editColumn('image', function ($row) {
                return '<div class="text-center">
                            <a href="#" target="_blank">
                            <img src="'.asset("file").'/'.$row->orders[0]->images.'" width="50px" height="50px">
                            </a>
                        </div>';
            });

            $table->editColumn('created', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H:i A', strtotime($row->created_at)).'</span></div>';
            });

            $table->editColumn('name', function ($row) {
                $html = "";
                foreach($row->orders as $order)
                {
                    $html .= '<span class="badge badge-secondary p-2 my-2">'.$order->name.'</span> &nbsp;';
                }
                return '<div class="text-center">'.$html.'</div>';
            });

            $table->editColumn('customer', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->users->name.'</span></div>';
            });

            $table->editColumn('payment', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">Card</span></div>';
            });



            $table->editColumn('total', function ($row) {
                return '<div class="text-center"><span class="badge p-2" style="background-color : #4c6f9c; color : white;">₹'.$row->order_discount->sub_total.'</span></div>';
            });


            $table->editColumn('discount', function ($row) {
                return '<div class="text-center"><span class="badge p-2" style="background-color : #4c6f9c; color : white;">₹'.$row->order_discount->discount.'</span></div>';
            });



            $table->editColumn('action', function ($row) {
                return '<div class="text-center">
                   <a href="'.url("backoffice/orders/invoice/$row->order_id").'" class="btn btn-sm btn-secondary" target="_blank" ><i class="fa fa-newspaper"></i></a>
                   <a href="'.url('backoffice/orders/view').'/'.$row->id.'" class="btn btn-sm btn-secondary" data-id="'.$row->id.'" id="order-view"><i class="fa fa-eye"></i></a>
                   <button class="btn btn-sm btn-danger" data-id="'.$row->id.'" id="order-trash"><i class="fa fa-trash"></i></button>
                </div>';
            });


            $table->editColumn('status', function ($row) {
                $select0 = $row->status == 0 ? 'selected' : '';
                $select1 = $row->status == 1 ? 'selected' : '';
                $select2 = $row->status == 2 ? 'selected' : '';
                $select3 = $row->status == 3 ? 'selected' : '';
                $select4 = $row->status == 4 ? 'selected' : '';
                return '<div class="text-center">
                   <select name="order-status" value="'.(int)$row->status.'" id="order-status" data-id="'.$row->id.'"  class="form-control">
                     <option value="0" '.$select0.'>Confirmed</option>
                     <option value="1" '.$select1.'>Proccessed</option>
                     <option value="2" '.$select2.'>Shipped</option>
                     <option value="3" '.$select3.'>Completed</option>
                     <option value="4" '.$select4.'>Refunded</option>
                   </select>
                </div>';
            });

            $table->rawColumns([ 'id', 'product','customer','image','total','discount','status','name','payment','action','order_id','created']);

            return $table->make(true);

        }
        return view('admin.orders.index');
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        return true;
    }


    public function update_status(Request $request)
    {
        $user = UserOrder::find($request->order_id);
        if($user->status == 4){
            return response()->json([
                'success' => true,
                'code' => 403,
                'message' => "Can't changed status of already refunded order.",
            ]);
        }
        $user->status = (int)$request->status_id;
        $user->save();


        if($request->status_id == 4){
           return $this->cancel_order($request->order_id);
        }
        else{
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Order status changed successfully.',
            ]);
        }

    }


    public function cancel_order($order_id){
        try{
            $uorder = UserOrder::find($order_id);
            $payment =Payment::where('order_id', $order_id)->first();
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
                    $re->refund_reason_id = 'Order cancel by admin';
                    $re->payment_id = $output->payment_id;
                    $re->notes =  null;
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Request $request)
    {
        // \Log::info($request->all());
    }

    public function delete($id,Request $request)
    {
        $user = UserOrder::find($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Order deleted successfully.',
        ]);
    }

    public function view($id){
        $userord = UserOrder::find($id);
        return view('admin.orders.show', compact('userord'));
    }


    public function bulkOrders(Request $request)
    {
        return view('admin.orders.bulkindex');

    }


    public function bulkStore(Request $request)
    {

    }

    public function bulkEdit(Request $request, $id)
    {

    }


    public function bulkUpdate(Request $request)
    {

    }

    public function bulkDestroy(Request $request)
    {

    }

    public function download($orderid){
        $order = UserOrder::where('order_id', $orderid)->first();

        if(!$order){
            return view('errors.404');
        }

        $store = Setting::first();
        view()->share(['order'=> $order, 'store' => $store]);
        // return view('store.invoice.index', compact('order'));
        $pdf = PDF::loadView('store.invoice.index', $order);
        return $pdf->download('invoice.pdf');
    }
}
