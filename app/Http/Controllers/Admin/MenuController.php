<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMenuRequest;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('menu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Menu::with(['category'])->select(sprintf('%s.*', (new Menu())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'menu_show';
                $editGate = 'menu_edit';
                $deleteGate = 'menu_delete';
                $crudRoutePart = 'menus';

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
            $table->addColumn('category_name', function ($row) {
                $category_name =  $row->category ? $row->category->name : '';
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$category_name.'</span></div>';
            });

            $table->editColumn('slug', function ($row) {
                $slug =  $row->slug ? $row->slug : '';
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$slug.'</span></div>';
            });
            $table->editColumn('type', function ($row) {
                $type =  $row->type ? Menu::TYPE_SELECT[$row->type] : '';
                return '<div class="text-center"><span class="badge p-2" style="background-color : #4c6f9c; color : white;">'.$type.'</span></div>';
            });
            $table->editColumn('status', function ($row) {
                $status =  $row->status ? Menu::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions', 'placeholder', 'category','id','name','category_name','slug','type','status']);

            return $table->make(true);
        }

        return view('admin.menus.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('menu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.menus.create', compact('categories'));
    }

    public function store(StoreMenuRequest $request)
    {
         Menu::create($request->all());

        return redirect()->route('admin.menus.index');
    }

    public function edit(Menu $menu)
    {
        // abort_if(Gate::denies('menu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu->load('category');

        return view('admin.menus.edit', compact('categories', 'menu'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu->update($request->all());

        return redirect()->route('admin.menus.index');
    }

    public function show(Menu $menu)
    {
        // abort_if(Gate::denies('menu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->load('category');

        return view('admin.menus.show', compact('menu'));
    }

    public function destroy(Menu $menu)
    {
        // abort_if(Gate::denies('menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuRequest $request)
    {
        Menu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $menu = Menu::find($id);
        $menu->status = $status;
        $menu->save();

        if($menu->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
