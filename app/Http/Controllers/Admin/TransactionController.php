<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\UserOrder;
use App\Models\Refund;
use App\Models\OrderDiscount;
use App\Models\Payment;
use App\Models\RefundReason;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Payment::latest()->get();

            $table = Datatables::of($data);

            $table->addIndexColumn();

            $table->editColumn('id', function ($row) {
                $id =  $row->id ? $row->id : '';
                return '<div class="text-center"><span class="text-dark">'.$id.'</span></div>';
            });
            $table->editColumn('order', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->order_id.'</span></div>';
            });

            $table->editColumn('user', function ($row) {
                $user = \App\Models\User::find($row->user_id);
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$user->name.'</span></div>';
            });

            $table->editColumn('transaction', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->transaction_id.'</span></div>';
            });

            $table->editColumn('payment', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->type.'</span></div>';
            });

            $table->editColumn('amount', function ($row) {
                return '<div class="text-center"><span class="badge p-2" style="background-color : #4c6f9c; color : white;">₹'.$row->amount.'</span></div>';
            });

            $table->editColumn('action', function ($row) {
                return '<div class="text-center">
                   <a href="'.url('backoffice/orders/view').'/'.$row->order_id.'" class="btn btn-secondary" data-id="'.$row->order_id.'" id="order-view"><i class="fa fa-eye"></i></a>
                </div>';
            });


            $table->rawColumns([ 'id', 'order','user','amount','transaction','payment','action']);

            return $table->make(true);

        }
        return view('admin.transaction.index');
    }

    public function refunds(Request $request)
    {
        if($request->ajax()){
            $data = Refund::latest()->get();
            $table = Datatables::of($data);
            $table->addIndexColumn();
            $table->editColumn('id', function ($row) {
                $id =  $row->id ? $row->id : '';
                return '<div class="text-center"><span class="text-dark">'.$id.'</span></div>';
            });
            $table->editColumn('refund', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->refund_id.'</span></div>';
            });

            $table->editColumn('reason', function ($row) {
                $user = RefundReason::find($row->refund_reason_id);
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$user->description.'</span></div>';
            });

            $table->editColumn('payment_id', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->payment_id.'</span></div>';
            });

            $table->editColumn('amount', function ($row) {
                $pay = Payment::where('transaction_id', $row->payment_id)->first();
                return '<div class="text-center"><span class="badge badge-warning p-2">₹'.$pay->amount.'</span></div>';
            });

            $table->editColumn('note', function ($row) {
                return '<div class="text-center">'.$row->note.'</div>';
            });

            $table->editColumn('status', function ($row) {
                return '<div class="text-center"><span class="badge p-2" style="background-color : #4c6f9c; color : white;">'.$row->status.'</span></div>';
            });


            $table->editColumn('action', function ($row) {
                return '<div class="text-center">
                  <a href="'.url("/backoffice/transactions?id=$row->payment_id").'" class="btn  btn-secondary"><i class="fa fa-eye"></i></a>
                </div>';
            });

            $table->rawColumns([ 'id', 'refund','reason','note','amount','payment_id','action','status']);

            return $table->make(true);

        }
        return view('admin.transaction.refund');
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
