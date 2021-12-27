<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\MassDestroyProductVariationRequest;
use App\Http\Requests\StoreProductVariationRequest;
use App\Http\Requests\UpdateProductVariationRequest;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Size;

class ProductVariationController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_variation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ProductVariation::with(['product', 'color', 'size'])->select(sprintf('%s.*', (new ProductVariation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_variation_show';
                $editGate = 'product_variation_edit';
                $deleteGate = 'product_variation_delete';
                $crudRoutePart = 'product-variations';

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
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->addColumn('color_name', function ($row) {
                return $row->color ? $row->color->name : '';
            });

            $table->addColumn('size_name', function ($row) {
                return $row->size ? $row->size->name : '';
            });

            $table->editColumn('mrp_price', function ($row) {
                return $row->mrp_price ? $row->mrp_price : '';
            });
            $table->editColumn('sales_price', function ($row) {
                return $row->sales_price ? $row->sales_price : '';
            });
            $table->editColumn('front_image', function ($row) {
                if ($photo = $row->front_image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('back_image', function ($row) {
                if ($photo = $row->back_image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('in_stock', function ($row) {
                return $row->in_stock ? ProductVariation::IN_STOCK_SELECT[$row->in_stock] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ProductVariation::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'color', 'size', 'front_image', 'back_image']);

            return $table->make(true);
        }

        return view('admin.productVariations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_variation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colors = Color::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = Size::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productVariations.create', compact('products', 'colors', 'sizes'));
    }

    public function store(StoreProductVariationRequest $request)
    {
        $productVariation = ProductVariation::create($request->all());

        if ($request->input('front_image', false)) {
            $productVariation->addMedia(storage_path('tmp/uploads/' . basename($request->input('front_image'))))->toMediaCollection('front_image');
        }

        if ($request->input('back_image', false)) {
            $productVariation->addMedia(storage_path('tmp/uploads/' . basename($request->input('back_image'))))->toMediaCollection('back_image');
        }

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $productVariation->id]);
        // }

        return redirect()->route('admin.product-variations.index');
    }

    public function edit(ProductVariation $productVariation)
    {
        abort_if(Gate::denies('product_variation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colors = Color::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sizes = Size::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productVariation->load('product', 'color', 'size');

        return view('admin.productVariations.edit', compact('products', 'colors', 'sizes', 'productVariation'));
    }

    public function update(UpdateProductVariationRequest $request, ProductVariation $productVariation)
    {
        $productVariation->update($request->all());

        if ($request->input('front_image', false)) {
            if (!$productVariation->front_image || $request->input('front_image') !== $productVariation->front_image->file_name) {
                if ($productVariation->front_image) {
                    $productVariation->front_image->delete();
                }
                $productVariation->addMedia(storage_path('tmp/uploads/' . basename($request->input('front_image'))))->toMediaCollection('front_image');
            }
        } elseif ($productVariation->front_image) {
            $productVariation->front_image->delete();
        }

        if ($request->input('back_image', false)) {
            if (!$productVariation->back_image || $request->input('back_image') !== $productVariation->back_image->file_name) {
                if ($productVariation->back_image) {
                    $productVariation->back_image->delete();
                }
                $productVariation->addMedia(storage_path('tmp/uploads/' . basename($request->input('back_image'))))->toMediaCollection('back_image');
            }
        } elseif ($productVariation->back_image) {
            $productVariation->back_image->delete();
        }

        return redirect()->route('admin.product-variations.index');
    }

    public function show(ProductVariation $productVariation)
    {
        abort_if(Gate::denies('product_variation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productVariation->load('product', 'color', 'size');

        return view('admin.productVariations.show', compact('productVariation'));
    }

    public function destroy(ProductVariation $productVariation)
    {
        abort_if(Gate::denies('product_variation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productVariation->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductVariationRequest $request)
    {
        ProductVariation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_variation_create') && Gate::denies('product_variation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProductVariation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
