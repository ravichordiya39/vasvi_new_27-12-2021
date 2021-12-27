<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductAttributeRequest;
use App\Http\Requests\UpdateProductAttributeRequest;
use App\Http\Requests\MassDestroyProductAttributeRequest;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Product;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;

class ProductAttributeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productAttributes = ProductAttribute::with(['product', 'attribute_value'])->get();

        return view('admin.productAttributes.index', compact('productAttributes'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attribute_values = AttributeValue::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productAttributes.create', compact('products', 'attribute_values'));
    }

    public function store(StoreProductAttributeRequest $request)
    {
        $productAttribute = ProductAttribute::create($request->all());

        return redirect()->route('admin.product-attributes.index');
    }

    public function edit(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attribute_values = AttributeValue::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productAttribute->load('product', 'attribute_value');

        return view('admin.productAttributes.edit', compact('products', 'attribute_values', 'productAttribute'));
    }

    public function update(UpdateProductAttributeRequest $request, ProductAttribute $productAttribute)
    {
        $productAttribute->update($request->all());

        return redirect()->route('admin.product-attributes.index');
    }

    public function show(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productAttribute->load('product', 'attribute_value');

        return view('admin.productAttributes.show', compact('productAttribute'));
    }

    public function destroy(ProductAttribute $productAttribute)
    {
        abort_if(Gate::denies('product_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductAttributeRequest $request)
    {
        ProductAttribute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
