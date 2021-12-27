<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductImageRequest;
use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductImageController extends Controller
{
    

    public function index()
    {
        abort_if(Gate::denies('product_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productImages = ProductImage::with(['product', 'media'])->get();

        return view('admin.productImages.index', compact('productImages'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_image_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productImages.create', compact('products'));
    }

    public function store(StoreProductImageRequest $request)
    {
        $productImage = ProductImage::create($request->all());

        foreach ($request->input('file_name', []) as $file) {
            $productImage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_name');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $productImage->id]);
        }

        return redirect()->route('admin.product-images.index');
    }

    public function edit(ProductImage $productImage)
    {
        abort_if(Gate::denies('product_image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productImage->load('product');

        return view('admin.productImages.edit', compact('products', 'productImage'));
    }

    public function update(UpdateProductImageRequest $request, ProductImage $productImage)
    {
        $productImage->update($request->all());

        if (count($productImage->file_name) > 0) {
            foreach ($productImage->file_name as $media) {
                if (!in_array($media->file_name, $request->input('file_name', []))) {
                    $media->delete();
                }
            }
        }
        $media = $productImage->file_name->pluck('file_name')->toArray();
        foreach ($request->input('file_name', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $productImage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_name');
            }
        }

        return redirect()->route('admin.product-images.index');
    }

    public function show(ProductImage $productImage)
    {
        abort_if(Gate::denies('product_image_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productImage->load('product');

        return view('admin.productImages.show', compact('productImage'));
    }

    public function destroy(ProductImage $productImage)
    {
        abort_if(Gate::denies('product_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productImage->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductImageRequest $request)
    {
        ProductImage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_image_create') && Gate::denies('product_image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductImage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function destroyImage(Request $request)
    {
        
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $productimage = ProductImage::find($request->id);
         $productimage->delete();

         return response()->json('Success',200);
    }
}
