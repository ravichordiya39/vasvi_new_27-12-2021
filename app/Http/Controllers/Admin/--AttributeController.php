<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\MassDestroyAttributeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\MapAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Attribute::with('attribute_values')->select(sprintf('%s.*', (new Attribute())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'attribute_show';
                $editGate = 'attribute_edit';
                $deleteGate = 'attribute_delete';
                $crudRoutePart = 'attributes';

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
                return '<div class="text-center">'.$id.'</div>';
            });

            $table->editColumn('name', function ($row) {
                $name =  $row->name ? $row->name : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });

            $table->editColumn('status', function ($row) {
                $status =  $row->status ? Attribute::STATUS_SELECT[$row->status] : '';

                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->editColumn('values', function ($row) {
                if ($row->attribute_values) {
                    $values = '';

                    foreach ($row->attribute_values as $item) {
                        // $values .=  "<div class='d-inline px-3 py-1 mr-2 rounded shadow-sm bg-secondary'>$item->value</div>";
                        $values .= '<span class="badge badge-warning p-2 mx-1 mb-1">'.$item->value.'</span>';
                    }

                    return $values;
                }

                return '';
            });

            $table->rawColumns(['values', 'actions', 'placeholder','id','name','values','status']);

            return $table->make(true);
        }

        return view('admin.attributes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.attributes.create');
    }

    public function store(StoreAttributeRequest $request)
    {
        $attribute = Attribute::create($request->all());

        $values = explode(',', $request->values);

        foreach ($values as $value) {
            if ($value) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'value' => trim($value),
                ]);
            }
        }

        return redirect()->route('admin.attributes.index')->with('success', trans('global.create_success'));
    }

    public function edit(Attribute $attribute)
    {
        abort_if(Gate::denies('attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attribute_values = AttributeValue::where('attribute_id', $attribute->id)
            ->select(DB::raw('group_concat(value) as value'))
            ->value('value');

        return view('admin.attributes.edit', compact('attribute', 'attribute_values'));
    }

    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $values = explode(',', $request->values);
        $idvalues = [];
        $idvaluesID = [];
        $datas = \DB::table('attribute_values')->where('attribute_id',$attribute->id)->get();
        foreach($datas as $data){
            $pros = ProductAttribute::where('attribute_value_id', $data->id)->where('attribute_id', $attribute->id)->get();
            foreach($pros as $pro){
                $attr = \DB::table('attribute_values')->where('attribute_id',$attribute->id)->where('id', $data->id)->first();
                array_push($idvalues, $attr->value);
                array_push($idvaluesID, $attr->id);
            }
        }
        $thirdarray= array_unique(array_merge($values,$idvalues));
        $newvalues = [];
        if(count($idvalues) > 0){
            foreach($datas as $data){

                foreach($idvaluesID as $val){

                    if(Str::lower($val) !== Str::lower($data->id)){

                    // echo Str::lower($val);
                    // echo Str::lower($data->id);
                    // prd(Str::lower($data->value));
                    if(!in_array($data->id,$idvaluesID)){
                        \DB::table('attribute_values')->where('id', $data->id)->where('attribute_id',$data->attribute_id)->delete();
                    }

                    }
                    else{
                        $values = array_diff($values,$idvalues);
                        array_push($idvalues);
                    }
                }
            }
        }
        else{

            \DB::table('attribute_values')->where('attribute_id', $attribute->id)->delete();
        }

        foreach($values as $value){
            AttributeValue::create([
                'attribute_id' => $attribute->id,
                'value' => trim($value),
            ]);
        }

        $a = Attribute::find($attribute->id);
        $a->name = $request->name;
        $a->status = $request->status;
        $a->description = $request->description;
        $a->save();

        return redirect()->route('admin.attributes.index')->with('success', trans('global.update_success'));

    }

    public function show(Attribute $attribute)
    {
        abort_if(Gate::denies('attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attribute->load('attribute_values');

        return view('admin.attributes.show', compact('attribute'));
    }

    public function destroy(Attribute $attribute)
    {
        // $id = $attribute->id;
        // MapAttribute::where('')
        abort_if(Gate::denies('attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $error = false;
        $maps =  MapAttribute::where('is_attribute',1)->get();
        foreach($maps as $map){
          foreach($map->attributes as $key => $value){
            if($key === $attribute->id){
              $error = true;
            }
          }
        }
        if(!$error){
          $attribute->delete();
          return back();
        }
        else{
          return back()->with('warning','Attribute can not be deleted because attribute is already mapped!');
        }

    }

    public function massDestroy(MassDestroyAttributeRequest $request)
    {
        Attribute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('attribute_create') && Gate::denies('attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Attribute();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $pattr = ProductAttribute::where('attribute_id', $id)->first();

        if($pattr)
            return response()->json(['code' => 304, 'success' => false, 'message' => "Can't delete this bcause use in one of the live product"]);

        $attribute = Attribute::find($id);
        $attribute->status = $status;
        $attribute->save();

        if($attribute->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
