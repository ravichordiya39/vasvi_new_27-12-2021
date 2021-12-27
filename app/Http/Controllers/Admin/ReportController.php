<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\UserOrder;
use App\Models\Payment;


class ReportController extends Controller
{


    public function sales(Request $request)
    {
        // abort_if(Gate::denies('attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = UserOrder::where('status',3)->get();
            $table = Datatables::of($query);

            $table->editColumn('order_id', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->order_id.'</span></div>';
            });

            $table->editColumn('name', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->users->name.'</span></div>';
            });

            $table->editColumn('address', function ($row) {
                return '<div class="text-center">'.$row->address.'</div>';
            });

            $table->editColumn('product', function ($row) {
              $count = 0;
                foreach($row->orders as $order){
                  if($count === 0){
                    return '<div class="text-center"><span class="badge badge-dark p-2">'.$order->name.'</span></div>';
                  }
                  $count++;
                }
            });

            $table->editColumn('amount', function ($row) {
              return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->total_amount.'</span></div>';
            });

            $table->editColumn('created', function ($row) {
              return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H:i A',strtotime($row->created_at)).'</span></div>';
            });


            $table->editColumn('image', function ($row) {
              $count = 0;
                foreach($row->orders as $order){
                  if($count === 0){
                    return '<div class="text-center">
                    <img src="'.asset("file/$order->images").'" style="width : 70px;" />
                    </div>';
                  }
                  $count++;
                }
            });


            $table->rawColumns(['order_id','name','address','image','product','amount','created']);

            return $table->make(true);
        }

        return view('admin.reports.sales');
    }

    public function orders(Request $request)
    {
      // abort_if(Gate::denies('attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      if ($request->ajax()) {
          $query = UserOrder::all();
          $table = Datatables::of($query);

          $table->editColumn('order_id', function ($row) {
              return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->order_id.'</span></div>';
          });

          $table->editColumn('name', function ($row) {
              return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->users->name.'</span></div>';
          });

          $table->editColumn('address', function ($row) {
              return '<div class="text-center">'.$row->address.'</div>';
          });

          $table->editColumn('product', function ($row) {
            $count = 0;
              foreach($row->orders as $order){
                if($count === 0){
                  return '<div class="text-center"><span class="badge badge-dark p-2">'.$order->name.'</span></div>';
                }
                $count++;
              }
          });

          $table->editColumn('amount', function ($row) {
            return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->total_amount.'</span></div>';
          });

          $table->editColumn('created', function ($row) {
            return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H:i A',strtotime($row->created_at)).'</span></div>';
          });


          $table->editColumn('image', function ($row) {
            $count = 0;
              foreach($row->orders as $order){
                if($count === 0){
                  return '<div class="text-center">
                  <img src="'.asset("file/$order->images").'" style="width : 70px;" />
                  </div>';
                }
                $count++;
              }
          });

          $table->editColumn('status', function ($row) {
            $html = '<div class="text-center">';
            if($row->status === 0){
              $html .= '<span  class="badge badge-secondary p-2">Received</span>';
            }
            if($row->status === 1){
              $html .= '<span  class="badge badge-warning p-2">Processed</span>';
            }
            if($row->status === 2){
              $html .= '<span  class="badge badge-primary p-2">Received</span>';
            }
            if($row->status === 3){
              $html .= '<span  class="badge badge-success p-2">Received</span>';
            }
            if($row->status === 4){
              $html .= '<span  class="badge badge-danger p-2">Cancelled</span>';
            }

            $html .= '</div>';

            return $html;
          });


          $table->rawColumns(['order_id','name','address','image','product','amount','created','status']);

          return $table->make(true);
      }

      return view('admin.reports.orders');
    }

    public function payments(Request $request)
    {

      if ($request->ajax()) {
          $query = Payment::all();
          $table = Datatables::of($query);


          $table->editColumn('order_id', function ($row) {
              return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->orders->order_id.'</span></div>';
          });

          $table->editColumn('name', function ($row) {

              return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->users->name.'</span></div>';
          });

          $table->editColumn('product', function ($row) {
              $orders = UserOrder::find($row->order_id);
              $count = 0;
              $html = '<div class="text-center">';
              foreach($orders->orders as $order){
                if($count === 0){
                    $html .= '<span class="badge badge-primary p-2">'.$order->name.'</span>';
                }
                $count ++;

              }
              $html .= '</div>';
              return $html;
          });

          $table->editColumn('image', function ($row) {
              $orders = UserOrder::find($row->order_id);
              $count = 0;
              $html = '<div class="text-center">';
              foreach($orders->orders as $order){
                if($count === 0){
                    $html .= '<img style="width : 100px;" src="'.asset("file/$order->images").'">';
                }
                $count ++;
              }
              $html .= '</div>';
              return $html;
          });

          $table->editColumn('transaction_id', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->transaction_id.'</span></div>';
          });



          $table->editColumn('amount', function ($row) {
            return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->amount.'</span></div>';
          });

          $table->editColumn('created', function ($row) {
            return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H:i A',strtotime($row->created_at)).'</span></div>';
          });

          $table->rawColumns(['order_id','name','image','product','amount','created','status','transaction_id']);
         return $table->make(true);
    }


    return view('admin.reports.orders');

  }


}
