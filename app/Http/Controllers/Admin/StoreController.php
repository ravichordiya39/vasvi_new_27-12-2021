<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStoreRequest;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Store;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    use FileUploadTrait;
    public function index(Request $request)
    {
        // abort_if(Gate::denies('store_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Store::query()->select(sprintf('%s.*', (new Store())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'store_show';
                $editGate = 'store_edit';
                $deleteGate = 'store_delete';
                $crudRoutePart = 'stores';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                $id =  $row->id ? $row->id : '';
                return '<div class="text-center"><span class="text-dark">'.$id.'</span></div>';
            });
            $table->editColumn('name', function ($row) {
                $name =  $row->name ? $row->name : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });
            $table->editColumn('contact_person_name', function ($row) {
                $name =  $row->contact_person_name ? $row->contact_person_name : '';
                return '<div class="text-center"><span class="badge badge-primary p-2">'.$name.'</span></div>';
            });
            $table->editColumn('contact_person_number', function ($row) {
                $number =  $row->contact_person_number ? $row->contact_person_number : '';
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$number.'</span></div>';
            });
            $table->editColumn('address', function ($row) {
                $address =  $row->address ? $row->address : '';
                return '<div class="text-center"><span class="font-weight-bold text-secondary">'.$address.'</span></div>';
            });
            $table->editColumn('store_pin_code', function ($row) {
                $pincode = $row->store_pin_code ? $row->store_pin_code : '';
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$pincode.'</span></div>';
            });
            $table->editColumn('store_contact', function ($row) {
                $contact =  $row->store_contact ? $row->store_contact : '';
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$contact.'</span></div>';
            });
            $table->editColumn('open_time', function ($row) {
                $open =  $row->open_time ? $row->open_time : '';
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$open.'</span></div>';
            });
            $table->editColumn('pin_codes', function ($row) {
                $close =  $row->pin_codes ? $row->pin_codes : '';
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$close.'</span></div>';
            });

            $table->rawColumns(['actions', 'placeholder','pin_codes','open_time','store_contact','store_pin_code','address','contact_person_number','contact_person_name','name','id']);

            return $table->make(true);
        }

        return view('admin.stores.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('store_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stores.create');
    }

    public function store(Request  $request)
    {
         Store::create($request->all());

        return redirect()->route('admin.stores.index');
    }

    public function edit(Store $store)
    {
        // abort_if(Gate::denies('store_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stores.edit', compact('store'));
    }

    public function update(UpdateStoreRequest $request, Store $store)
    {
        $store->update($request->all());

        return redirect()->route('admin.stores.index');
    }

    public function show(Store $store)
    {
        // abort_if(Gate::denies('store_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stores.show', compact('store'));
    }

    public function destroy(Store $store)
    {
        // abort_if(Gate::denies('store_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $store->delete();
        return back();
    }

    public function massDestroy(MassDestroyStoreRequest $request)
    {
        Store::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
