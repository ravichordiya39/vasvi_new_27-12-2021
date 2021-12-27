<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySizeRequest;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\ProductVariation;
use App\Models\Size;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('size_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Size::query()->select(sprintf('%s.*', (new Size())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'size_show';
                $editGate = 'size_edit';
                $deleteGate = 'size_delete';
                $crudRoutePart = 'sizes';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                $name =  $row->name ? $row->name : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });
            $table->editColumn('value', function ($row) {
                $value =  $row->value ? $row->value : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$value.'</span></div>';
            });
            $table->editColumn('status', function ($row) {
                $status = $row->status ? Size::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions', 'placeholder','status','name','value','status']);

            return $table->make(true);
        }

        return view('admin.sizes.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('size_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sizes.create');
    }

    public function store(StoreSizeRequest $request)
    {
        $size = Size::create($request->all());

        return redirect()->route('admin.sizes.index')->with('success',trans('global.create_success'));
    }

    public function edit(Size $size)
    {
        // abort_if(Gate::denies('size_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sizes.edit', compact('size'));
    }

    public function update(UpdateSizeRequest $request, Size $size)
    {
        $size->update($request->all());

        return redirect()->route('admin.sizes.index')->with('success',trans('global.update_success'));
    }

    public function show(Size $size)
    {
        // abort_if(Gate::denies('size_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sizes.show', compact('size'));
    }

    public function destroy(Size $size)
    {
        // abort_if(Gate::denies('size_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $size->delete();

        return back();
    }

    public function massDestroy(MassDestroySizeRequest $request)
    {
        Size::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $pattr = ProductVariation::where('size_id', $id)->first();

        if($pattr)
            return response()->json(['code' => 304, 'success' => false, 'message' => "Can't delete this because use in one of the live product"]);

        $size = Size::find($id);
        $size->status = $status;
        $size->save();

        if($size->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
