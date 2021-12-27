<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMapAttributeRequest;
use App\Http\Requests\UpdateMapAttributeRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Size;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\MapAttribute;
use App\Models\AttributeValue;

class MapAttributeController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('map_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Mapattribute::query()->select(sprintf('%s.*', (new Mapattribute())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'map_attribute_show';
                $editGate = 'map_attribute_edit';
                $deleteGate = 'map_attribute_delete';
                $crudRoutePart = 'map-attributes';

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
            $table->editColumn('category', function ($row) {
                $category = $row->category->name ?? '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$category.'</span></div>';
            });
            $table->editColumn('subcategory', function ($row) {
                $subcategory =  $row->subcategory->name ?? '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$subcategory.'</span></div>';
            });
            $table->editColumn('subcategorychilds', function ($row) {
                $subchildcategory =  $row->subchildcategory->name ?? '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$subchildcategory.'</span></div>';
            });
            $table->editColumn('is_color', function ($row) {
                $is_color = $row->is_color ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_color.' id="is-color-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });
            $table->editColumn('is_size', function ($row) {
                $is_size = $row->is_size ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_size.' id="is-size-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });
            $table->editColumn('is_brand', function ($row) {
                $is_brand = $row->is_brand ? 'checked' : '';
                 return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_brand.' id="is-brand-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });
            $table->editColumn('is_attribute', function ($row) {
                $is_attribute = $row->is_attribute ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });
            $table->editColumn('status', function ($row) {
                $status = $row->status ? mapattribute::STATUS_SELECT[$row->status] : '';
                $current = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$current.' id="is-active-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions', 'placeholder','is_color','is_size','is_brand','category','subcategory','subcategorychilds','is_attribute','status','id']);

            return $table->make(true);
        }

        return view('admin.mapAttribute.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('map_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $colors = Color::where(['status' => 1])->get()->pluck('name', 'id');
        $sizes = Size::where(['status' => 1])->get()->pluck('name', 'id');
        $brands = Brand::where(['status' => 1])->get()->pluck('name', 'id');
        $attributes = Attribute::where(['status' => 1])->get();
        //dd($attributes);
        $categories = category::where(['status' => 1, 'parent_id' => 0])->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $maped_sub_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_id) as ids')->value('ids');
        $subcategories = category::where(['status' => 1])->where('parent_id', '!=', 0)->whereNotIn('id', explode(',', $maped_sub_category_ids))->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.mapAttribute.create', compact('colors', 'brands', 'sizes', 'attributes', 'categories', 'subcategories'));
    }

    public function store(StoreMapAttributeRequest $request)
    {
        $mapAttribute = MapAttribute::create($request->all());
        return redirect()->route('admin.map-attributes.index')->with('success', trans('global.create_success'));
    }

    public function edit(MapAttribute $mapAttribute)
    {
        // abort_if(Gate::denies('map_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colors = Color::where(['status' => 1])->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $sizes = Size::where(['status' => 1])->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $brands = Brand::where(['status' => 1])->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $attributes = Attribute::where(['status' => 1])->get();

        $categories = category::where(['status' => 1, 'parent_id' => 0])
            ->get()
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $subcategories = category::where(['status' => 1])
            ->where('parent_id', $mapAttribute->category_id)
            ->get()
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $subchildcategories = category::where(['status' => 1])
            ->where('id', $mapAttribute->sub_category_child_id)
            ->get()
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mapAttribute.edit', compact('mapAttribute','subchildcategories', 'colors', 'categories', 'sizes', 'brands', 'subcategories', 'attributes'));
    }

    public function update(UpdateMapattributeRequest $request, MapAttribute $mapAttribute)
    {

        $mapAttribute->update($request->all());

        return redirect()->route('admin.map-attributes.index')->with('success', trans('global.update_success'));
    }

    public function show(MapAttribute $mapAttribute)
    {
        // abort_if(Gate::denies('map_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $brands = $colors = $attributes = $sizes = [];

        if ($mapAttribute->is_attribute && $mapAttribute->attributes && is_array($mapAttribute->attributes)) {
            foreach ($mapAttribute->attributes as $id => $val) {
                $attributes[$id] = Attribute::find($id);
                $attributes[$id]['attributeValues'] = AttributeValue::whereIn('id', $val['attributevalues'] ?? array())->get();
            }
        }
        if ($mapAttribute->is_size && is_array($mapAttribute->sizes)) {
            $sizes = Size::whereIn('id', $mapAttribute->sizes)->get();
        }
        if ($mapAttribute->is_color && is_array($mapAttribute->colors)) {
            $colors = Color::whereIn('id', $mapAttribute->colors)->get();
        }
        if ($mapAttribute->is_brand && is_array($mapAttribute->brands)) {
            $brands = Brand::whereIn('id', $mapAttribute->brands)->get();
        }

        return view('admin.mapAttribute.show', compact('mapAttribute', 'sizes', 'colors', 'brands', 'attributes'));
    }

    public function destroy(Mapattribute $mapAttribute)
    {
        // abort_if(Gate::denies('map_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $mapAttribute->delete();
        return back();
    }

    public function massDestroy(MassDestroyMapattributeRequest $request)
    {
        MapAttribute::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function get_subcategory($id)
    {
        $categories = DB::table('categories')
                      ->leftJoin('map_attributes','map_attributes.category_id','categories.id')
                      ->where('map_attributes.subcategory_id','!=','categories.id')
                      ->where('categories.id',$id)
                      ->select('categories.*')
                      ->get();

        dd($categories);
        // if($categories->count() > 0){
        //     foreach($categories as $cat){

        //     }
        // }

    }


    public function update_size(Request $request)
    {
        $map_id = $request->map_id;
        $size = $request->size;

        $mapAttribute = Mapattribute::find($map_id);
        $mapAttribute->is_size = $size;
        $mapAttribute->save();

        if($mapAttribute->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Size status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Size status updated successfully.']);
    }


    public function update_color(Request $request)
    {
        $map_id = $request->map_id;
        $color = $request->color;

        $mapAttribute = Mapattribute::find($map_id);
        $mapAttribute->is_color = $color;
        $mapAttribute->save();

        if($mapAttribute->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Color status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Color status updated successfully.']);
    }

    public function update_brand(Request $request)
    {
        $map_id = $request->map_id;
        $brand = $request->brand;

        $mapAttribute = Mapattribute::find($map_id);
        $mapAttribute->is_brand = $brand;
        $mapAttribute->save();

        if($mapAttribute->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Brand status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Brand status updated successfully.']);
    }

    public function update_attribute(Request $request)
    {
        $map_id = $request->map_id;
        $attribute = $request->attribute;

        $mapAttribute = Mapattribute::find($map_id);
        $mapAttribute->is_attribute = $attribute;
        $mapAttribute->save();

        if($mapAttribute->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Attribute status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Attribute status updated successfully.']);
    }

    public function update_active(Request $request)
    {
        $map_id = $request->map_id;
        $active = $request->active;

        $mapAttribute = Mapattribute::find($map_id);
        $mapAttribute->status = $active;
        $mapAttribute->save();

        if($mapAttribute->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updated successfully.']);
    }
}
