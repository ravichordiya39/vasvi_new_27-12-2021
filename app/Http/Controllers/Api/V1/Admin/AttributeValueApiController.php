<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeValueRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Http\Resources\Admin\AttributeValueResource;
use App\Models\AttributeValue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributeValueApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attribute_value_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttributeValueResource(AttributeValue::with(['attribute'])->get());
    }

    public function store(StoreAttributeValueRequest $request)
    {
        $attributeValue = AttributeValue::create($request->all());

        return (new AttributeValueResource($attributeValue))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AttributeValue $attributeValue)
    {
        abort_if(Gate::denies('attribute_value_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AttributeValueResource($attributeValue->load(['attribute']));
    }

    public function update(UpdateAttributeValueRequest $request, AttributeValue $attributeValue)
    {
        $attributeValue->update($request->all());

        return (new AttributeValueResource($attributeValue))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AttributeValue $attributeValue)
    {
        abort_if(Gate::denies('attribute_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attributeValue->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
