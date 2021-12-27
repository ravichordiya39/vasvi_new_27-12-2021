<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTestimonialRequest;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestimonialController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        // abort_if(Gate::denies('testimonial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonials = Testimonial::latest()->get();


        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        // abort_if(Gate::denies('testimonial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.testimonials.create');
    }

    public function store(StoreTestimonialRequest $request)
    {

        // $request = $this->imageUpload($request, 'social_icon');


               Testimonial::create($request->all());


        // if ($request->input('image', false)) {
        //     $testimonial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        // }

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $testimonial->id]);
        // }

        return redirect()->route('admin.testimonials.index');
    }

    public function edit(Testimonial $testimonial)
    {
        // abort_if(Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        // $request = $this->imageUpload($request, 'social_icon');
        $testimonial->update($request->all());






        // if ($request->input('image', false)) {
        //     if (!$testimonial->image || $request->input('image') !== $testimonial->image->file_name) {
        //         if ($testimonial->image) {
        //             $testimonial->image->delete();
        //         }
        //         $testimonial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        //     }
        // } elseif ($testimonial->image) {
        //     $testimonial->image->delete();
        // }

        return redirect()->route('admin.testimonials.index');
    }

    public function show(Testimonial $testimonial)
    {
        // abort_if(Gate::denies('testimonial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function destroy(Testimonial $testimonial)
    {
        // abort_if(Gate::denies('testimonial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonial->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestimonialRequest $request)
    {
        Testimonial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('testimonial_create') && Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Testimonial();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;


        $testo = Testimonial::find($id);
        $testo->status = $status;
        $testo->save();

        if($testo->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
