<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailModule;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class EmailModuleController extends Controller
{
    public function index(Request $request){
        $modules = EmailModule::all();
        return view('admin.emailmodules.index', compact('modules'));
    }

    public function edit($id){
        $module = EmailModule::find($id);

        return view('admin.emailmodules.edit', compact('module'));
    }


    public function storeCKEditorImages(Request $request)
    {

        $model         = new EmailModule();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;

        // if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('emailmodule'), $fileName);
            $url = asset('emailmodule/'.$fileName);
        // }
        // $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => 5 ,'url' => $url], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {


          $module = EmailModule::find($id);
          $module->body = $request->body;
          $module->updated_at = Carbon::now();
          $module->save();

          return redirect(route('admin.emailmodule'))->with('success','Email module save successfully');
    }
}
