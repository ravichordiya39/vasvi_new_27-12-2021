<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Controllers\Traits\CommonFunctionTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Models\Size;
use App\Models\Images;
use App\Models\User;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\MapAttribute;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariation;
use Carbon\Carbon;

class ProductController extends Controller
{
    use FileUploadTrait, CommonFunctionTrait;

    public function index(Request $request)
    {
        
        //phpinfo();
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {

            $query = Product::with(['category', 'sub_category', 'user', 'brand'])
            ->whereNull('products.deleted_at')
            ->select(sprintf('%s.*', (new Product())->table));

            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $crudRoutePart = 'products';
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
            
            $table->addColumn('category_name', function ($row) {
              $name =  $row->sub_category ? $row->sub_category->name : '';
              
              $categoryname =  Category::where('id',$row->category_id)->select('name', 'id')->first();
              if($categoryname){
                $categoryname = $categoryname['name'];
              }else{
                $categoryname = '';
              }
              
              $subcategoryname =  Category::where('id',$row->sub_category_id)->select('name', 'id')->first();
              if($subcategoryname){
                $subcategoryname = $subcategoryname['name'];
              }else{
                $subcategoryname = '';
              }
              
              $childcategoryname =  Category::where('id',$row->sub_category_child_id)->select('name', 'id')->first();
              if($childcategoryname){
                $childcategoryname = $childcategoryname['name'];
              }else{
                $childcategoryname = '';
              }
              
              $less = "";
              $name = "";
              
              if(isset($categoryname) && $categoryname != "") {
                  $name .= $categoryname;
                  $less = " > ";
              }
              
              if(isset($subcategoryname) && $subcategoryname != "") {
                  $name .= $less . $subcategoryname;
                  $less = " > ";
              }
              
              if(isset($childcategoryname) && $childcategoryname != "") {
                  $name .= $less . $childcategoryname;
              }
              
              return '<div class="text-center">'.$name.'</div>';

            });

            /*$table->addColumn('category_name', function ($row) {
                $name =  $row->sub_category ? $row->sub_category->name : '';
                return '<div class="text-center"><span class="badge badge-primary p-2">'.$name.'</span></div>';
            });*/

            $table->editColumn('name', function ($row) {
                $name =  $row->name ? $row->name : '';
                return '<div class=""><span class="badge badge-secondary p-2">'.$name.'</span></div>';
            });

            $table->editColumn('sku_code', function ($row) {
                $sku =  $row->sku_code ? $row->sku_code : '';
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$sku.'</span></div>';
            });

            $table->addColumn('brand_name', function ($row) {
                $brand =  $row->brand ? $row->brand->name : '';
                return '<div class="text-center"><span class="badge badge-primary p-2">'.$brand.'</span></div>';
            });

            // $table->editColumn('mrp_price', function ($row) {
            //     $mrp = DB::table('product_variations')->where('product_id', $row->id)->first();
            //     $mrp =  $mrp->single_price ? $mrp->single_price : '';
            //     return '<div class="text-center"><span class="badge badge-warning p-2">'.$mrp.'</span></div>';
            // });

            // $table->editColumn('sales_price', function ($row) {
            //     $mrp = DB::table('product_variations')->where('product_id', $row->id)->first();
            //     return '<div class="text-center"><span class="badge badge-warning p-2">'.$mrp->single_sales_price.'</span></div>';
            // });

            $table->editColumn('in_stock', function ($row) {
                $stock =  $row->in_stock === 1 ? Product::IN_STOCK_SELECT[$row->in_stock] : '';
                if($stock === 'In Stack')
                     return '<div class="text-center"><span class="badge badge-success p-2">'.$stock.'</span></div>';
                else
                     return '<div class="text-center"><span class="badge badge-danger p-2">'.$stock.'</span></div>';

            });

            $table->editColumn('has_varient', function ($row) {
                $varients = DB::table('product_variations')->where('product_id', $row->id)->groupBy('color_id')->get();
                $count = !empty($varients) ? $varients->count() : 0;
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$count.'</span></div>';
            });

            $table->editColumn('front_image', function ($row) {
                $image = DB::table('product_images')->where('product_id', $row->id)->first();
                $count = !empty($varients) ? $varients->count() : 0;
                if(isset($image->file_name)) {
                    return '<div class="text-center"><img style="width : 50px; height : 50px;border : 1px solid lightgrey;" src="'.asset("file/$image->file_name").'"></div>';
                }
                

            });

            $table->editColumn('view_count', function ($row) {
                $count =  $row->view_count;
                return '<div class="text-center"><span class="badge badge-secondary p-2">'.$count.'</span></div>';
            });

            $table->editColumn('status', function ($row) {
                $status =  $row->status ? Product::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['placeholder', 'category', 'sub_category', 'brand', 'front_image']);
            $table->rawColumns(['actions', 'placeholder', 'category', 'sub_category', 'brand', 'front_image','category_name','name','brand_name','sku_code','mrp_price','sales_price','in_stock','has_varient','view_count','status','id']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isSubCatSelect = $category_id = $sub_category_id = $isCatSelect = 0;
        $categories = $subcategories = $brands = $colors = $sizes = $attributes = [];

        if ($request->category_id && $request->sub_category_id) {
            $isSubCatSelect = $isCatSelect = 1;
            $category_id = $request->category_id;
            $sub_category_id = $request->sub_category_id;

            $mapAttributes = MapAttribute::where([
                'category_id' => $category_id,
                'sub_category_id' => $sub_category_id,
                'status' => 1
            ])
            ->first();

            if (!$mapAttributes) {
                return redirect(route('admin.products.index'))->with('warning', trans('product.map_attribute_not_exists'));
            }

            if ($mapAttributes->is_attribute && $mapAttributes->attributes && is_array($mapAttributes->attributes)) {
                foreach ($mapAttributes->attributes as $id => $val) {
                    $attributes[$id] = Attribute::find($id);
                    $attributes[$id]['attributeValues'] = AttributeValue::whereIn('id', $val['attributevalues'] ?? array())->get();
                }
            }

            if ($mapAttributes->is_size) {
                if ($mapAttributes->sizes && is_array($mapAttributes->sizes)) {
                    $sizes = Size::whereIn('id', $mapAttributes->sizes)->where('status', 1)->get();
                } else {
                    $sizes = Size::where('status', 1)->get();
                }
            }

            if ($mapAttributes->is_color) {
                if ($mapAttributes->colors && is_array($mapAttributes->colors)) {
                    $colors = Color::whereIn('id', $mapAttributes->sizes)->where('status', 1)->get();
                } else {
                    $colors = Color::where('status', 1)->get();
                }
            }

            if ($mapAttributes->is_brand) {
                if ($mapAttributes->brands && is_array($mapAttributes->brands)) {
                    $brands = Brand::whereIn('id', $mapAttributes->sizes)
                        ->where('status', 1)
                        ->get()
                        ->pluck('name', 'id')
                        ->prepend(trans('global.pleaseSelect'), '');
                } else {
                    $brands = Brand::where('status', 1)->get()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
                }
            }
        } elseif ($request->category_id) {
            $isCatSelect = 1;
            $subcategories = Category::where(['status' => 1])->where('parent_id', '=', $request->category_id)->get();
        }

        $maped_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(category_id) as ids')->value('ids');

        $categories = Category::whereIn('id', explode(',', $maped_category_ids))
            ->where(['status' => 1, 'parent_id' => '0'])
            ->get()
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $data = compact('categories');
        //die("sdfsdfdsf");
        // $data = compact('categories', 'brands', 'sizes', 'colors', 'attributes');

        return view('admin.products.create', $data);
    }

    public function store(Request $request)
    {

        $product_data = $request->except('gallery', 'attributes', 'color_id', 'size_id');
        $product_data['user_id'] = auth()->id();
        $product_data['slug'] = $this->getSlug($product_data['name'], 'products');

        if ($request->discount_type == 1) {
            $discount = ($request->mrp_price * $request->discount) / 100;
            $product_data['sales_price'] = $request->mrp_price - $discount;
        } else if ($request->discount_type == 2) {
            $product_data['sales_price'] = $request->mrp_price - $request->discount;
        }
        $product = Product::create($product_data);

        if ($request->has('variation')) {
            $z = 0;
            foreach ($request->input('variation') as $key => $value) {

                if ($key && isset($value['sizes'])) {
                    foreach($value['sizes'] as $k=> $v){
                        $record = explode(",",$v);
                        if ($product->discount_type == '1') {
                            $sales_single_price=$value['single_price'][$record[1]]-($product->discount/100)*$value['single_price'][$record[1]];
                            if (isset($request->primary[$key]) && $request->primary[$key]==1) {
                                $product->update([
                                    'sales_price'=>$sales_single_price,
                                    'mrp_price'=>$value['single_price'][$record[1]]
                                  ]);
                            }
                            // $sales_wholesale_price=$value['wholesale_price'][$record[1]]-($product->discount/100)*$value['wholesale_price'][$record[1]];
                        }
                        else{
                            $sales_single_price=$value['single_price'][$record[1]]-$product->discount;
                            if (isset($request->primary[$key]) && $request->primary[$key]==1) {
                                $product->update([
                                    'sales_price'=>$sales_single_price,
                                    'mrp_price'=>$value['single_price'][$record[1]]
                                  ]);
                            }
                            // $sales_wholesale_price=$value['wholesale_price'][$record[1]]-$product->discount;
                        }


                        ProductVariation::create([
                           'color_id' => $key,
                           'size_id' => $record[0],
                           'single_price' => $value['single_price'][$record[1]],
                           'single_sales_price' => $sales_single_price,
                        //    'wholesale_price' => $value['wholesale_price'][$record[1]],
                        //    'wholesale_sales_price' => $sales_wholesale_price,
                           'single_price_quantity' => $value['single_price_quantity'][$record[1]],
                        //    'wholesale_price_quantity' => $value['wholesale_price_quantity'][$record[1]],
                           'size_status' => isset($value['size_status'][$record[1]]) ? $value['size_status'][$record[1]] : "",
                           'product_id' => $product->id,
                           'status' => 1,
                        //    'primary_variation' => $request->primary[$z] ??  0
                           'primary_variation'=> array_key_exists($key,$request->primary) ? 1 : 0
                       ]);
                    }
                }

                $z++;
            }

        }

        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $key => $value) {
                if ($key && $value) {
                     ProductAttribute::create([
                         'attribute_id' => $key,
                         'attribute_value_id' => $value,
                         'product_id' => $product->id,
                         'status' => 1,
                     ]);
                }
            }
        }


        if ($request->has('gallery')) {
            foreach ($request->gallery as $key => $value) {
                 foreach($value as $newkey => $newvalue){
                    $imagepath            = $newvalue;
                    $path               = 'file/';
                    $upload             = 'file/';
                    ProductImage::create([
                        'type' => 1,
                        'file_name' => $imagepath,
                        'product_id' =>$product->id,
                        'product_color_id'=>$key
                    ]);
                 }


            }
        }

        return redirect()->route('admin.products.index')->with('success', trans('product.created'));
    }
    
    function getpartials(Request $request){
        $productid = $request->input('id');
        $product = Product::where('id',$productid)->first();
        $sizes = $brands = $colors = $attributes = [];

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $product->load('category', 'sub_category', 'user', 'brand','child_category','productProductVariations');
        
        $attributes=ProductAttribute::where('product_id',$product->id)->get();


        $arttvalue=AttributeValue::all();

        $mapAttributes = MapAttribute::where([
            'status' => 1,
            'category_id' => $product->category_id,
            'sub_category_id' => $product->sub_category_id
        ])->first();
        if (isset($mapAttributes->sizes) && $mapAttributes->sizes) {
            $sizes = Size::whereIn('id', $mapAttributes->sizes)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if (isset($mapAttributes->colors) && $mapAttributes->colors) {
            $colors = Color::whereIn('id', $mapAttributes->colors)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }
        // dd($colors);
        $productimages=ProductImage::where('product_id',$product->id)->get();
        $images=[];
        foreach($productimages as $key=>$img){
        $images[$key]=['file_name'=>$img->file_name,
                       'product_color_id'=>$img->product_color_id,
                       'id'=>$img->id
        ];
        }
        $html = view('admin.products.partial', compact('users', 'brands', 'product','colors', 'sizes','images','attributes'))->render();
        return $html;
    }

    public function edit(Product $product)
    {

        $sizes = $brands = $colors = $attributes = [];
        $images=[];
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $maped_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(category_id) as ids')->value('ids');
        $categories = Category::whereIn('id', explode(',', $maped_category_ids))
            ->where(['status' => 1, 'parent_id' => '0'])
            ->get()
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');
        $maped_subcategory_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_id) as ids')->value('ids');
        $sub_categories = Category::where('parent_id',$product->category_id)->whereIn('id', explode(',', $maped_subcategory_ids))->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $child_categories=Category::where('parent_id',$product->sub_category_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $product->load('category', 'sub_category', 'user', 'brand','child_category','productProductVariations');
        $mapAttributes = MapAttribute::where([
            'status' => 1,
            'category_id' => $product->category_id,
            'sub_category_id' => $product->sub_category_id
        ])->first();
        
        if (isset($mapAttributes->colors) && $mapAttributes->colors) {
            $colors = Color::whereIn('id', $mapAttributes->colors)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }
        return view('admin.products.edit', compact('product','categories','sub_categories','child_categories','colors','images'));
    }

    function sendimg(){
        $images = Images::orderBy('id','desc')->get();
        echo json_encode($images);
        exit;
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
      
        /*echo "<pre>";
        print_r($request->input('variation'));
        die;*/
       abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       $icollection = ProductImage::where('product_id', $product->id)->select('id')->get();
       if($icollection->count() > 0){
        foreach($icollection as $i){
            ProductImage::find($i->id)->delete();
        }
       }

       $vcollection = ProductVariation::where('product_id', $product->id)->select('id')->get();
       if($vcollection->count() > 0){
        foreach($vcollection as $v){
            ProductVariation::find($v->id)->delete();
        }
       }

       $acollection = ProductAttribute::where('product_id', $product->id)->select('id')->get();
        if($acollection->count() > 0){
            foreach($acollection as $a){
                ProductAttribute::find($a->id)->delete();
            }
        }

       $product_data = $request->except('gallery', 'attributes', 'color_id', 'size_id','old','variation');
        $product->update($product_data);
        if ($request->has('gallery')) {
            foreach ($request->gallery as $key => $value) {
                 foreach($value as $newkey => $newvalue){
                    $imagepath            = $newvalue;
                    $path               = 'file/';
                    $upload             = 'file/';
                    ProductImage::create([
                        'type' => 1,
                        'file_name' => $imagepath,
                        'product_id' =>$product->id,
                        'product_color_id'=>$key
                    ]);
                 }
            }
        }


            if ($request->has('variation')) {
                
                
                foreach ($request->input('variation') as $key => $value) {
                    if ($key && isset($value['sizes'])) {
                        foreach($value['sizes'] as $k=> $v){
                            $record = explode(",",$v);
                            if ($product->discount_type == '1') {
                                $sales_single_price=$value['single_price'][$record[1]]-($product->discount/100)*$value['single_price'][$record[1]];
                                if (isset($request->primary[$key]) && $request->primary[$key]==1) {
                                    $product->update([
                                        'sales_price'=>$sales_single_price,
                                        'mrp_price'=>$value['single_price'][$record[1]]
                                      ]);
                                }
                                // $sales_wholesale_price=$value['wholesale_price'][$record[1]]-($product->discount/100)*$value['wholesale_price'][$record[1]];
                            }
                            else{
                                $sales_single_price=$value['single_price'][$record[1]]-$product->discount;
                                if (isset($request->primary[$key]) && $request->primary[$key]==1) {
                                    $product->update([
                                        'sales_price'=>$sales_single_price,
                                        'mrp_price'=>$value['single_price'][$record[1]]
                                      ]);
                                }
                                // $sales_wholesale_price=$value['wholesale_price'][$record[1]]-$product->discount;
                            }

                            $primary = 0;
                            if(isset($request->primary) && $request->primary != "" ){
                                if(array_key_exists((int)$key,$request->primary)){
                                    $primary = 1;
                                }
                            }
                            
                            $size_status = 0;
                            if(isset($value['size_status'][$record[1]]) && $value['size_status'][$record[1]] != "" ){
                                $size_status = $value['size_status'][$record[1]];
                            }
                            
                            $single_price_quantity = 0;
                            if(isset($value['single_price_quantity'][$record[1]]) && $value['single_price_quantity'][$record[1]] != "" ){
                                $single_price_quantity = $value['single_price_quantity'][$record[1]];
                            }
                            
                            $single_price = 0;
                            if(isset($value['single_price'][$record[1]]) && $value['single_price'][$record[1]] != "" ){
                                $single_price = $value['single_price'][$record[1]];
                            }

                            ProductVariation::create([
                               'color_id' => $key,
                               'size_id' => $record[0],
                               'single_price' => $single_price,
                               'single_sales_price' => $sales_single_price,
                            //    'wholesale_price' => $value['wholesale_price'][$record[1]],
                            //    'wholesale_sales_price' => $sales_wholesale_price,
                               'single_price_quantity' => $single_price_quantity,
                            //    'wholesale_price_quantity' => $value['wholesale_price_quantity'][$record[1]],
                               'size_status' => $size_status,
                               'product_id' => $product->id,
                               'status' => 1,
                               'primary_variation'=> $primary
                           ]);
                        }
                    }
                }
            }

        if ($request->has('attributes')) {
            foreach ($request->input('attributes') as $key => $value) {
                if ($key && $value) {
                     ProductAttribute::create([
                         'attribute_id' => $key,
                         'attribute_value_id' => $value,
                         'product_id' => $product->id,
                         'status' => 1,
                     ]);
                }
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('category', 'sub_category', 'user', 'brand', 'productProductImages', 'productProductVariations', 'productProductAttributes');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Request $request, $id)
    {
      
        // MassDestroyProductRequest
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        ProductVariation::where('product_id', $id)->update(['deleted_at' =>  Carbon::now()]);
        ProductAttribute::where('product_id', $id)->update(['deleted_at'=> Carbon::now()]);
        ProductImage::where('product_id', $id)->update(['deleted_at'=> Carbon::now()]);
        Product::where('id', $id)->update(['deleted_at' => Carbon::now()]);
        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function getImages()
    {
        $images = ProductImage::all()->toArray();
        foreach($images as $image){
            $tableImages[] = $image['file_name'];
        }
        $storeFolder = public_path('storage/product');
        $file_path = public_path('storage/product/');
        $files = scandir($storeFolder);
        foreach ( $files as $file ) {
            if ($file !='.' && $file !='..' && in_array($file,$tableImages)) {
                $obj['name'] = $file;
                $file_path = public_path('storage/product/').$file;
                $obj['size'] = filesize($file_path);
                $obj['path'] = url('public/storage/product/'.$file);
                $data[] = $obj;
            }

        }
        //dd($data);
        return response()->json($data);
    }


    public function mappedAttributes(Request $request)
    {
        $sizes = $brands = $colors = $attributes = [];
        $validator = Validator::make(
            $request->all(),
            [
                'category_id' => 'required',
                'sub_category_id' => 'required',
            ],
            [
                'category_id.required' => trans('validation.required.category_id'),
                'sub_category_id.required' => trans('validation.required.sub_category_id'),
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first()
            ]);
        }

        $mapAttributes = MapAttribute::where([
            'status' => 1,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id
        ]) ->first();

        $childCategory  = Category::where(['parent_id'=>$request->sub_category_id,'status' => 1])->get();
       
        if (!$mapAttributes) {
            return response()->json([
                'success' => false,
                'sizes' => [],
                'colors' => [],
                'brands' => [],
                'message' => 'Please add attribute first!!'
            ]);
        }

        if ($mapAttributes->sizes) {
            $sizes = Size::whereIn('id', $mapAttributes->sizes)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if ($mapAttributes->colors) {
            $colors = Color::whereIn('id', $mapAttributes->colors)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if ($mapAttributes->brands) {
            $brands = Brand::whereIn('id', $mapAttributes->brands)
                ->where('status', 1)
                ->select(['id', 'name'])
                ->get()
                ->toArray();
        }

        $attributes = $mapAttributes->attributes;
        return response()->json([
            'success' => true,
            'sizes' => count($sizes) ? $sizes : [],
            'colors' => count($colors) ? $colors : [],
            'brands' => count($brands) ? $brands : [],
            'child_category' => $childCategory ? $childCategory : array(),
            'html' => view('admin.products.variation', compact('colors', 'sizes'))->render(),
            'attribute_html' => view('admin.products.attributes', compact('attributes'))->render(),
            'message' => 'Attributes found'
        ]);
    }

 public function mappedChildAttributes(Request $request)
    {
        $sizes = $brands = $colors = $attributes = [];
        $validator = Validator::make(
            $request->all(),
            [
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'child_id' => 'required',
            ],
            [
                'category_id.required' => trans('validation.required.category_id'),
                'sub_category_id.required' => trans('validation.required.sub_category_id'),
                'child_id.required' => trans('validation.required.child_id'),
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first()
            ]);
        }

        $mapAttributes = MapAttribute::where([
            'status' => 1,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_category_child_id' => $request->child_id
        ]) ->first();


        if (!$mapAttributes) {
            return response()->json([
                'success' => false,
                'sizes' => [],
                'colors' => [],
                'brands' => [],
                'message' => 'Please add attribute first!!'
            ]);
        }

        if ($mapAttributes->sizes) {
            $sizes = Size::whereIn('id', $mapAttributes->sizes)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if ($mapAttributes->colors) {
            $colors = Color::whereIn('id', $mapAttributes->colors)
                ->where('status', 1)
                ->select(['id', 'name', 'value'])
                ->get();
        }

        if ($mapAttributes->brands) {
            $brands = Brand::whereIn('id', $mapAttributes->brands)
                ->where('status', 1)
                ->select(['id', 'name'])
                ->get()
                ->toArray();
        }

        $attributes = $mapAttributes->attributes;
        return response()->json([
            'success' => true,
            'sizes' => count($sizes) ? $sizes : [],
            'colors' => count($colors) ? $colors : [],
            'brands' => count($brands) ? $brands : [],
            'html' => view('admin.products.variation', compact('colors', 'sizes'))->render(),
            'attribute_html' => view('admin.products.attributes', compact('attributes'))->render(),
            'message' => 'Attributes found'
        ]);
    }

    public function subCategories(Request $request)
    {
        $query = Category::where(['status' => 1, 'parent_id' => $request->parent_id]);
        if(isset($request->exclude) && $request->exclude == 1){
          $maped_sub_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_id) as ids')->value('ids');
          $cats = [];
          $maped_sub_category_ids_arr = explode(',', $maped_sub_category_ids);
          foreach($maped_sub_category_ids_arr as $subcat){
            $subcats = Category::where(['status' => 1, 'parent_id' => $subcat])->select(['id', 'name'])->get();
            if(count($subcats) == 0){
              $cats[] = $subcat;
            }else{
              $mappedCats = MapAttribute::where(['sub_category_id' => $subcat])->get();
              if(count($subcats) == count($mappedCats)){
                $cats[] = $subcat;
              }
            }
          }
          if(count($cats) > 0){
            $query->whereNotIn('id', $cats);
          }
        }
        if(isset($request->child_category) && $request->child_category == 1){
          $maped_sub_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_child_id) as ids')->value('ids');
          $maped_sub_category_ids_arr = explode(',', $maped_sub_category_ids);
          if(count($maped_sub_category_ids_arr) > 0){
            $query->whereNotIn('id', $maped_sub_category_ids_arr);
          }
        }

        $map_remove = MapAttribute::where('category_id' , $request->parent_id)->get();

        $map_ids = [];
        foreach($map_remove as $map){
             array_push($map_ids, $map->sub_category_id);
        }
        $query->whereIn('id',$map_ids)->select(['id', 'name']);
        $subCategories = $query->get()->toArray();


        if (count($subCategories)) {
            return response()->json([
                'success' => true,
                'subCategories' => $subCategories,
                'message' => 'Sub Categories found'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'subCategories' => [],
                'message' => 'Sub Category not Exists in selected category'
            ]);
        }
    }


    public function childcategory(Request $request)
    {
        $query = Category::where(['status' => 1, 'parent_id' => $request->parent_id]);

          $maped_sub_category_ids = MapAttribute::selectRaw('GROUP_CONCAT(sub_category_child_id) as ids')->value('ids');
          $maped_sub_category_ids_arr = explode(',', $maped_sub_category_ids);
          if(count($maped_sub_category_ids_arr) > 0){
            $query->whereNotIn('id', $maped_sub_category_ids_arr);
          }

        $map_remove = MapAttribute::where('category_id' , $request->parent_id)->get();
        $map_ids = [];
        foreach($map_remove as $map){
             array_push($map_ids, $map->sub_category_id);
        }
        $query->whereNotIn('id',$map_ids)->select(['id', 'name']);
        $subCategories = $query->get()->toArray();


        if (count($subCategories)) {
            return response()->json([
                'success' => true,
                'subCategories' => $subCategories,
                'message' => 'Sub Categories found'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'subCategories' => [],
                'message' => 'Sub Category not Exists in selected category'
            ]);
        }
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;


        $product = Product::find($id);
        $product->status = $status;
        $product->save();

        if($product->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }


    public function sku_code($sku_code){
        $product = Product::where('sku_code', $sku_code)->first();
        $msg = '';
        $code = 0;
        if($product){
            $code = 404;
            $msg = 'Sku code not available';
        }
        else{
            $length = strlen($sku_code);
            if($length < 4){
                $code = 503;
                $msg = 'Sku code length should be atleast 4 character long';
            }
            else{
                $code = 200;
                $msg = 'Sku code is available';
            }
        }

        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => $msg
        ]);
    }

}
