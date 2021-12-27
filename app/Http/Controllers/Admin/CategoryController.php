<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Controllers\Traits\CommonFunctionTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Category;
use App\Models\MapAttribute;
use App\Models\Product;

class CategoryController extends Controller
{
    use FileUploadTrait, CommonFunctionTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::where(['parent_id' => 0])
            ->orderby('id', 'desc')
            ->whereNull('deleted_at')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function getSubCategories(Request $request, $id)
    {
        // abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where(['parent_id' => $id])->orderby('id', 'desc')->get();
        $category = Category::find($id);
        return view('admin.categories.subcategories', compact('category', 'categories'));
    }

    public function createSubCategories($id)
    {
        // abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = Category::find($id);
        return view('admin.categories.create', compact('category'));
    }

    public function create()
    {
        // abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        // $request = $this->imageUpload($request, 'category');

        $category_data = $request->all();
        $category_data['slug'] = $this->getSlug($request['name'], 'categories');

        $cat = Category::create($category_data);

        if($request->has('size_chart')){
            $imageName = time().'.'.$request->size_chart->extension();
            $request->size_chart->move(public_path('file'), $imageName);
            $category = Category::find($cat->id);
            $category->size_chart = $imageName;
            $category->save();
        }


        if ($category_data['parent_id']) {
            return redirect()
                ->route('admin.subcategories.index', ['id' => $category_data['parent_id']])
                ->with('success', trans('global.create_success'));
        } else {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', trans('global.create_success'));
        }
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
        $query->select(['id', 'name']);

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

    public function edit(Category $category)
    {
        // abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // $request = $this->imageUpload($request, 'category');

        $category_data = $request->all();
        $category_data['slug'] = $this->getSlug($request['name'], 'categories', $category->id);

        $category->update($category_data);
        if($request->has('size_chart')){
            $imageName = time().'.'.$request->size_chart->extension();
            $request->size_chart->move(public_path('file'), $imageName);
            $category = Category::find($category->id);
            if($request->image === 'null'){
                $category->image = $request->image;
            }

            $category->size_chart = $imageName;
            $category->save();
        }

        if ($category_data['parent_id']) {
            return redirect()
                ->route('admin.subcategories.index', ['id' => $category_data['parent_id']])
                ->with('success', trans('global.update_success'));
        } else {
            return redirect()
                ->route('admin.categories.index')
                ->with('success', trans('global.update_success'));
        }
    }

    public function show(Category $category)
    {
        // abort_if(Gate::denies('categories'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.categories.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        $id = $category->id;
        $product = Product::where('category_id', $id)
                            ->orWhere('sub_category_id', $id)
                            ->orWhere('sub_category_child_id', $id)
                            ->first();
        // abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($product){
            return back()->with('warning','Category used in one of the product so please delete product then try again!');


        }
        else{
            $category->delete();
            // return back();
            return back()->with('success','Category deleted successfully.');
        }

    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('category_create') && Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Category();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $pattr = Product::where('category_id', $id)
                                   ->orWhere('sub_category_id', $id)
                                   ->orWhere('sub_category_child_id', $id)->first();

        if($pattr)
            return response()->json(['code' => 304, 'success' => false, 'message' => "Can't delete this because use in one of the live product"]);

        $cat = Category::find($id);
        $cat->status = $status;
        $cat->save();

        if($cat->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }


    public function remove_image(Request $request)
    {

    }
}
