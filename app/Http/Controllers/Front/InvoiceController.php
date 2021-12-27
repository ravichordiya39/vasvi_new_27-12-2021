<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOrder;
use App\Models\Order;
Use App\Models\OrderDiscount;
use App\Models\Payment;
use App\Models\Refund;
use App\Models\RefundMessage;
use App\Models\Setting;

use PDF;

class InvoiceController extends Controller
{
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
        // return $pdf->stream();
    }
}
