<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySocialProfileTypeRequest;
use App\Http\Requests\StoreSocialProfileTypeRequest;
use App\Http\Requests\UpdateSocialProfileTypeRequest;
use App\Models\SocialProfileType;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class SocialProfileTypeController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        // abort_if(Gate::denies('social_profile_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialProfileTypes = SocialProfileType::latest()->get();
        // dd($socialProfileTypes->toArray());

        return view('admin.socialProfileTypes.index', compact('socialProfileTypes'));
    }

    public function create()
    {
        // abort_if(Gate::denies('social_profile_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialProfileTypes.create');
    }

    public function store(StoreSocialProfileTypeRequest $request)
    // public function store(Request $request)
    {
        // dd($request->all());
        // $request = $this->imageUpload($request, 'social_icon');
        SocialProfileType::create($request->all());

        return redirect()->route('admin.social-profile-types.index');
    }

    public function edit(SocialProfileType $socialProfileType)
    {
        // abort_if(Gate::denies('social_profile_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialProfileTypes.edit', compact('socialProfileType'));
    }

    public function update(UpdateSocialProfileTypeRequest $request, SocialProfileType $socialProfileType)
    {
        // $request = $this->imageUpload($request, 'social_icon');
        $socialProfileType->update($request->all());


        // if ($request->input('logo', false)) {
        //     if (!$socialProfileType->logo || $request->input('logo') !== $socialProfileType->logo->file_name) {
        //         if ($socialProfileType->logo) {
        //             $socialProfileType->logo->delete();
        //         }
        //         $socialProfileType->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        //     }
        // } elseif ($socialProfileType->logo) {
        //     $socialProfileType->logo->delete();
        // }

        return redirect()->route('admin.social-profile-types.index');
    }

    public function show(SocialProfileType $socialProfileType)
    {
        // abort_if(Gate::denies('social_profile_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.socialProfileTypes.show', compact('socialProfileType'));
    }

    public function destroy(SocialProfileType $socialProfileType)
    {
        // abort_if(Gate::denies('social_profile_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialProfileType->delete();

        return back();
    }

    public function massDestroy(MassDestroySocialProfileTypeRequest $request)
    {
        SocialProfileType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('social_profile_type_create') && Gate::denies('social_profile_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SocialProfileType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $profile = SocialProfileType::find($id);
        $profile->status = $status;
        $profile->save();

        if($profile->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
