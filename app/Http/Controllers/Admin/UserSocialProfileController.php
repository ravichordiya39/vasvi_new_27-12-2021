<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserSocialProfileRequest;
use App\Http\Requests\StoreUserSocialProfileRequest;
use App\Http\Requests\UpdateUserSocialProfileRequest;
use App\Models\SocialProfileType;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\User;
use App\Models\UserSocialProfile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;


class UserSocialProfileController extends Controller
{
    use FileUploadTrait;
    public function index(Request $request)
    {
        // abort_if(Gate::denies('user_social_profile_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserSocialProfile::with(['user', 'social_profile_type'])->select(sprintf('%s.*', (new UserSocialProfile())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_social_profile_show';
                $editGate = 'user_social_profile_edit';
                $deleteGate = 'user_social_profile_delete';
                $crudRoutePart = 'user-social-profiles';

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
            $table->addColumn('user_name', function ($row) {
                $name =  $row->user ? $row->user->name : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });

            $table->addColumn('social_profile_type_name', function ($row) {
                $type =  $row->social_profile_type ? $row->social_profile_type->name : '';
                return '<div class="text-center"><span class="text-primary font-weight-bold">'.$type.'</span></div>';
            });

            $table->editColumn('status', function ($row) {
                $status =  $row->status ? UserSocialProfile::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'social_profile_type','id','user_name','status','social_profile_type_name']);

            return $table->make(true);
        }

        return view('admin.userSocialProfiles.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('user_social_profile_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $social_profile_types = SocialProfileType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userSocialProfiles.create', compact('users', 'social_profile_types'));
    }

    public function store(StoreUserSocialProfileRequest $request)
    {
         UserSocialProfile::create($request->all());

        return redirect()->route('admin.user-social-profiles.index');
    }

    public function edit(UserSocialProfile $userSocialProfile)
    {
        // abort_if(Gate::denies('user_social_profile_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $social_profile_types = SocialProfileType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userSocialProfile->load('user', 'social_profile_type');

        return view('admin.userSocialProfiles.edit', compact('users', 'social_profile_types', 'userSocialProfile'));
    }

    public function update(UpdateUserSocialProfileRequest $request, UserSocialProfile $userSocialProfile)
    {
        $userSocialProfile->update($request->all());

        return redirect()->route('admin.user-social-profiles.index');
    }

    public function show(UserSocialProfile $userSocialProfile)
    {
        // abort_if(Gate::denies('user_social_profile_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userSocialProfile->load('user', 'social_profile_type');

        return view('admin.userSocialProfiles.show', compact('userSocialProfile'));
    }

    public function destroy(UserSocialProfile $userSocialProfile)
    {
        // abort_if(Gate::denies('user_social_profile_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userSocialProfile->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserSocialProfileRequest $request)
    {
        UserSocialProfile::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;


        $profile = UserSocialProfile::find($id);
        $profile->status = $status;
        $profile->save();

        if($profile->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
