<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Referral;
use App\Models\Wallet;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::select(sprintf('%s.*', (new User())->table))->where('is_admin','!=',1);
            $table = Datatables::of($query);
            $table->addIndexColumn();


            $table->editColumn('name', function ($row) {
                return '<div class="text-center">'.$row->name.'</div>';
            });
            $table->editColumn('referral', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$row->referral_code.'</span></div>';
            });
            $table->editColumn('created', function ($row) {
                return '<div class="text-center"><span class="badge badge-dark p-2">'.date('d M Y H: A', strtotime($row->created_at)).'</span></div>';
            });

            $table->editColumn('status', function ($row) {
                $status = $row->ref_status ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$status.' id="is-status-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['status', 'referral', 'created','name']);

            return $table->make(true);
        }

        return view('admin.referral.index');
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
        $user = User::find($request->user_id);
        $user->ref_status = $request->status;
        $user->save();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Status changed successfully.'
        ]);
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


    public function reference(Request $request)
    {
        if ($request->ajax()) {

            $query =  '';
            if(!empty($request->from_date))
            {
                $query = Referral::whereBetween('created_at', array($request->from_date, $request->to_date))
                ->latest()->get();
            }
            else
            {
                $query = Referral::latest()->get();;
            }

            $table = Datatables::of($query);
            $table->addIndexColumn();


            $table->editColumn('name', function ($row) {
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$row->targetUser->name.'</span></div>';
            });
            $table->editColumn('referral', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->referralUser->referral_code.'</span></div>';
            });
            $table->editColumn('refer', function ($row) {
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$row->referralUser->name.'</span></div>';
            });
            $table->editColumn('created', function ($row) {
                return '<div class="text-center"><span class="badge badge-primary p-2">'.date('d M Y H: A', strtotime($row->created_at)).'</span></div>';
            });


            $table->rawColumns(['refer', 'referral', 'created','name']);

            return $table->make(true);
        }

        return view('admin.references.index');
    }

    public function wallets(Request $request)
    {
        if ($request->ajax()) {
            $query = Wallet::latest()->get();
            $table = Datatables::of($query);
            $table->addIndexColumn();

            $table->editColumn('name', function ($row) {
                return '<div class="text-center">'.$row->users->name.'</div>';
            });
            $table->editColumn('amount', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->amount.'</span></div>';
            });
            $table->editColumn('created', function ($row) {
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.date('d M Y H:i A', strtotime($row->created_at)).'</span></div>';
            });

            $table->editColumn('action', function ($row) {
                return '<div class="text-center">
                 <a class="btn btn-warning" href="'.url('backoffice/wallet').'/'.$row->id.'"><i class="fas fa-edit"></i>
                 </a>
                </div>';
            });

            $table->rawColumns(['amount', 'created','name','action']);

            return $table->make(true);
        }

        return view('admin.wallets.index');
    }

    public function edit_wallet($id){
        $wallet = Wallet::find($id);
        if(!$wallet){
            return view('errors.404');
        }
        else{
            return view('admin.wallets.edit', compact('wallet'));
        }
    }

    public function update_wallet(Request $request){

        $wallet = Wallet::find($request->wallet_id);
        $wallet->amount = $request->amount;
        $wallet->save();

        return redirect(route('admin.wallets.index'))->with('success','Wallet updated successfully.');
    }

}
