<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Http\Requests\MassDestroyCouponRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Events\PrivateCouponEvent;

use App\Models\User;
use App\Models\Coupon;

class CouponController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Coupon::with(['customer'])->select(sprintf('%s.*', (new Coupon())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'coupon_show';
                $editGate = 'coupon_edit';
                $deleteGate = 'coupon_delete';
                $crudRoutePart = 'coupons';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return '<div class="text-center"><span class="text-dark">'.$row->id.'</span></div>';
            });
            $table->addColumn('customer_name', function ($row) {
                $name =  $row->customer ? $row->customer->name : 'NA';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });

            $table->editColumn('coupon_type', function ($row) {
                $type =  Coupon::COUPON_TYPE_SELECT[$row->coupon_type];
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$type.'</span></div>';
            });
            $table->editColumn('user_type', function ($row) {
                $type =  Coupon::USER_TYPE_SELECT[$row->user_type];
                return '<div class="text-center"><span class="badge badge-primary p-2">'.$type.'</span></div>';
            });
            $table->editColumn('discount_type', function ($row) {
                $discount =  Coupon::DISCOUNT_TYPE_SELECT[$row->discount_type];
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$discount.'</span></div>';
            });
            $table->editColumn('value', function ($row) {
                $value =  $row->value ? $row->value : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$value.'</span></div>';
            });
            $table->editColumn('code', function ($row) {
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$row->code.'</span></div>';
            });
            $table->editColumn('avlb_coupons', function ($row) {
                $coupon =  $row->avlb_coupons;
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$coupon.'</span></div>';
            });
            $table->editColumn('status', function ($row) {
                $status =  Coupon::STATUS_SELECT[$row->status];
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions', 'placeholder', 'customer','status','id','avlb_coupons','code','value','discount_type','user_type','coupon_type','customer_name']);

            return $table->make(true);
        }

        return view('admin.coupons.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('coupon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = User::where('is_admin',0)->get();

        return view('admin.coupons.create', compact('customers'));
    }

    public function store(StoreCouponRequest $request)
    {
        $request = $this->imageUpload($request, 'coupon');
        $coupon = Coupon::create($request->all());



        $result = \DB::table('coupons')
                  ->where('id',$coupon->id)
                  ->update([
                    "coupon_type" => $request->coupon_type,
                    "customer_id" => $request->coupon_type === 0 ? $request->customer_id : null,
                    "user_type" => $request->coupon_type  === 0 ? $request->user_type : 4,
                    "discount_type" => $request->discount_type,
                    "value" => $request->value,
                    "max_discount" => $request->max_discount,
                    "valid_from" => date('Y-m-d H:i:s', strtotime($request->valid_from)),
                    "valid_to" => date('Y-m-d H:i:s', strtotime($request->valid_to)),
                    "min_cart_amt" => $request->min_cart_amt,
                    "coupon_name" => $request->coupon_name,
                    // "code" => $request->code,
                    "is_unlimited" => $request->is_unlimited,
                    "avlb_coupons" => $request->avlb_coupons,
                    "status" => $request->status,
                    "term_conditions" => $request->term_conditions,
                  ]);

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $coupon->id]);
        // }

        return redirect()->route('admin.coupons.index');
    }

    public function edit(Coupon $coupon)
    {
        // abort_if(Gate::denies('coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $customers = User::where('is_admin',0)->get();

        $coupon->load('customer');
        return view('admin.coupons.edit', compact('customers', 'coupon'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {

        $request = $this->imageUpload($request, 'coupon');
        $coupon->update($request->all());

        $result = \DB::table('coupons')
                  ->where('id',$request->id)
                  ->update([
                    "coupon_type" => $request->coupon_type,
                    "customer_id" => $request->coupon_type === 0 ? $request->customer_id : null,
                    "user_type" => $request->coupon_type  === 0 ? $request->user_type : 4,
                    "discount_type" => $request->discount_type,
                    "value" => $request->value,
                    "max_discount" => $request->max_discount,
                    "valid_from" => date('Y-m-d H:i:s', strtotime($request->valid_from)),
                    "valid_to" => date('Y-m-d H:i:s', strtotime($request->valid_to)),
                    "min_cart_amt" => $request->min_cart_amt,
                    "coupon_name" => $request->coupon_name,
                    "code" => $request->code,
                    "is_unlimited" => $request->is_unlimited,
                    "avlb_coupons" => $request->avlb_coupons,
                    "status" => $request->status,
                    "term_conditions" => $request->term_conditions,
                  ]);

                  if($request->has('customer_id')){
                      $user = User::find($request->customer_id);

                      event(new PrivateCouponEvent($user,$request->code));

                  }

        // dd($coupon);
        // exit();

        // if ($request->input('image', false)) {
        //     if (!$coupon->image || $request->input('image') !== $coupon->image->file_name) {
        //         if ($coupon->image) {
        //             $coupon->image->delete();
        //         }
        //         $coupon->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        //     }
        // } elseif ($coupon->image) {
        //     $coupon->image->delete();
        // }

        return redirect()->route('admin.coupons.index');
    }

    public function show(Coupon $coupon)
    {
        // abort_if(Gate::denies('coupon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coupon->load('customer');

        return view('admin.coupons.show', compact('coupon'));
    }

    public function destroy(Coupon $coupon)
    {
        // abort_if(Gate::denies('coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coupon->delete();

        return back();
    }

    public function massDestroy(MassDestroyCouponRequest $request)
    {
        Coupon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('coupon_create') && Gate::denies('coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Coupon();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $coupon = Coupon::find($id);
        $coupon->status = $status;
        $coupon->save();

        if($coupon->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
