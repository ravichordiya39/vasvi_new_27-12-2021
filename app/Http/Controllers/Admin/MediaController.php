<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Images;
use Carbon\Carbon;
use File;


class MediaController extends Controller
{
    public function index(Request $request)
    {
        $images = Images::latest()->paginate(48);
        return view('admin.media.index', compact('images'));
    }

    public function store(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$this->random_string(8).'.'.$image->extension();
        $image->move(public_path('file'),$imageName);
        $image = new Images;
        $image->name = $imageName;
        $image->created_at = Carbon::now();
        $image->updated_at = Carbon::now();
        $image->save();
        return response()->json(['success'=>$imageName]);
    }


    public function popstore(Request $request){

        $image = $request->file('file');
        $imageName = time().$this->random_string(8).'.'.$image->extension();
        $image->move(public_path('file'),$imageName);
        $image = new Images;
        $image->name = $imageName;
        $image->created_at = Carbon::now();
        $image->updated_at = Carbon::now();
        $image->save();
        if($image){
            return response()->json(['success'  => true, 'data' => $image]);
        }
        else{
            return response()->json(['success'  => false , 'data' => []]);
        }

    }

    public function view($id)
    {
        $image = Images::find($id);
        return response()->json(['code' => 200 , 'success' => true , 'data' => $image]);
    }

    public function destroy(Request $request)
    {
       $image_ids = $request->image_ids;
       foreach($image_ids as $id){
           $image = Images::find($id);
           Images::where('id', $id)->delete();
           \File::delete(public_path("file/$image->name"));
       }

       return response()->json(['code' => 200 , 'success' => true , 'data' => [], 'message' => 'Images are deleted successfully.']);
    }


    function random_string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }




}
