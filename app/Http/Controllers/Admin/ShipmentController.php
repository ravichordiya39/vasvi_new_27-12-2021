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
use App\Models\CurrierCompany;
use App\Models\Shipment;

class ShipmentController extends Controller
{


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

            $table->editColumn('currier_company', function ($row) {
                $company_id = $row->shipment !== null ? $row->shipment->currier_company_id : '';
                $company = '';
                if($company_id !== ''){
                  $company = CurrierCompany::find($company_id)->name;
                }
                else{
                  $company = 'Not Available';
                }
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$company.'</span></div>';
            });

            $table->editColumn('track', function ($row) {
                $track = $row->shipment !== null ? $row->shipment->track_url : 'NA';
                $html = "";
                if($track !== 'NA'){
                  $html = '<a href="'.$track.'" target="_blank" class="btn btn-dark btn-sm text-white">Track</a>';
                }
                else{
                  $html = '<span class="badge badge-dark">'.$track.'</span>';
                }
                return '<div class="text-center">
                    '.$html.'
                </div>';
            });

            $table->editColumn('image', function ($row) {
                return '<div class="text-center">
                            <a href="#" target="_blank">
                            <img src="'.asset("file").'/'.$row->orders[0]->images.'" width="50px" height="50px">
                            </a>
                        </div>';
            });

            $table->editColumn('created', function ($row) {
                return '<div class="text-center">'.date('d M Y', strtotime($row->created_at)).'</div>';
            });

            $table->editColumn('name', function ($row) {
                $html = "";
                foreach($row->orders as $order)
                {
                    $html .= $order->name.',';
                }
                return '<div class="text-center">'.$html.'</div>';
            });

            $table->editColumn('customer', function ($row) {
                return '<div class="text-center">'.$row->users->name.'</div>';
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
                $html = "";
                if($row->status != 4 )
                {
                   $html .= '<a href="'.route('admin.shipments.edit',['id' => $row->id]).'" class="btn btn-sm btn-primary" data-id="'.$row->id.'" id="order-view"><i class="fa fa-pencil"></i></a>';
                }
                else{
                  $html = "";
                }
                return '<div class="text-center">

                   '.$html.'
                </div>';
            });

            $table->editColumn('status', function ($row) {
                $select0 = $row->status == 0 ? 'selected' : '';
                $select1 = $row->status == 1 ? 'selected' : '';
                $select2 = $row->status == 2 ? 'selected' : '';
                $select3 = $row->status == 3 ? 'selected' : '';
                $select4 = $row->status == 4 ? 'selected' : '';
                $enable = $row->status == 4 ? 'disabled' : '';
                return '<div class="text-center" style="width : 120px; !important;">
                   <select name="order-status" value="'.(int)$row->status.'" id="order-status" data-id="'.$row->id.'"  class="form-control" '.$enable.'>
                     <option value="0" '.$select0.'>Confirmed</option>
                     <option value="1" '.$select1.'>Proccessed</option>
                     <option value="2" '.$select2.'>Shipped</option>
                     <option value="3" '.$select3.'>Completed</option>
                     <option value="4" '.$select4.'>Refunded</option>
                   </select>
                </div>';
            });
            $table->rawColumns([ 'id', 'product','customer','image','total','discount','status','name','payment','action','order_id','created','currier_company','track']);
            return $table->make(true);
        }
        return view('admin.shipment.index');
    }


    public function edit($id)
    {

      $userord = UserOrder::find($id);

      $curriers = CurrierCompany::all();
      return view('admin.shipment.show', compact('userord','curriers'));
    }

    public function update(Request $request){
      $ship = Shipment::find($request->order_id);
      if($ship){
        $ship->currier_company_id = $request->currier_company;
        $ship->track_url = $request->url;
        $ship->save();
      }
      else{
        $ships = new Shipment;
        $ships->order_id = $request->order_id;
        $ships->currier_company_id = $request->currier_company;
        $ships->track_url = $request->url;
        $ships->save();
      }

      return redirect()->route('admin.shipments')->with('success','Shipment info attached to order successfully.');
    }
}
