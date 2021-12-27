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
use App\Http\Requests\StoreCurrierCompanyRequest;

class CurrierCompanyController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = CurrierCompany::latest()->get();
            $table = Datatables::of($data);
            $table->addIndexColumn();
            $table->editColumn('email', function ($row) {
                return '<div class="text-center"><span class="badge badge-info p-2">'.$row->email.'</span></div>';
            });
            $table->editColumn('contact', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->contact.'</span></div>';
            });
            $table->editColumn('website', function ($row) {
                return '<div class="text-center"><a class="btn  btn-warning btn-sm">'.$row->website.'</a></div>';
            });
            $table->editColumn('created', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y', strtotime($row->created_at)).'</span></div>';
            });
            $table->editColumn('name', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->name.'</span></div>';
            });
            $table->editColumn('action', function ($row) {
                return '<div class="text-center">

                   <a href="'.url('backoffice/currier-companies/view').'/'.$row->id.'" class="btn btn-sm btn-secondary" data-id="'.$row->id.'" id="order-view"><i class="fa fa-eye"></i></a>
                   <a href="'.url("backoffice/currier-companies/edit/$row->id").'" class="btn btn-sm btn-primary"  ><i class="fa fa-pencil"></i></a>
                   <button class="btn btn-sm btn-danger" data-id="'.$row->id.'" id="company-trash"><i class="fa fa-trash"></i></button>
                </div>';
            });
            $table->rawColumns([ 'name','email','action','website','created','contact']);
            return $table->make(true);
        }
        return view('admin.curriercompany.index');
    }

    public function create(Request $request)
    {
      return view('admin.curriercompany.create');
    }

    public function store(Request $request)
    {
      // dd($request->all());
        //  $this->validate($request, [
        //   'name' => 'required',
        //   'email' => 'required|email',
        //   'website' => 'required|url',
        //   'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        // ]);

        $company = new CurrierCompany;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->contact = $request->contact;
        $company->save();

      return redirect()->route('admin.currier-companies')->with('success','Currier company info saved successfully.');
       // @if($errors->has('name'))
       //      <p class="text-danger">
       //        {{$errors->first('name')}}
       //      </p>
       //  @endif
    }

    public function edit($id)
    {
        $company = CurrierCompany::find($id);
        return view('admin.curriercompany.edit', compact('company'));
    }

    public function update(Request $request)
    {
      $company = CurrierCompany::find($request->id);
      $company->name = $request->name;
      $company->email = $request->email;
      $company->website = $request->website;
      $company->contact = $request->contact;
      $company->save();

      return redirect()->route('admin.currier-companies')->with('success','Currier company info updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
       $id = $request->id;
         $order = Shipment::where('currier_company_id', $id)->first();
         if($order){
           return response()->json([
             'success' => true,
             'code' => 403,
             'message' => 'Currier company already linked to one of the product'
           ]);
         }
         else{
           CurrierCompany::find($request->id)->delete();
           return response()->json([
             'success' => true,
             'code' => 200,
             'message' => 'Currier company deleted successfully'
           ]);
         }

    }

}
