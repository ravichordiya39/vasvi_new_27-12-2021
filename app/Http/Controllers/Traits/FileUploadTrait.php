<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait {
    // imageUpload function is used for uploading single & multiple image
    // input_name is used for multiple image upload

    public function imageUpload(Request $request, $folder_name, $input_name = '', $width = 160, $height = 120) {
        $image_path = "public/$folder_name";
        $thumb_path = "public/$folder_name/thumb";
        $new_request = $request;

        foreach ($request->all() as $key => $value) {
            if ($key == $input_name) {
                $image_arr = [];

                foreach ($request->$input_name as $arr_key => $arr_value) {
                    $file_name = md5(microtime()) . '.' . $arr_value->extension();

                    // Image store with actual size
                    $arr_value->storeAs($image_path, $file_name);

                    // Image store with (160 x 120) size
                    $imagePath = $arr_value->storeAs($thumb_path, $file_name);
                    $image = Image::make($arr_value)->resize($width, $height)->encode();
                    Storage::put($imagePath, $image);
                    $image_arr[] = $file_name;
                }

                $new_request = new Request(array_merge($new_request->all(), [$key => $image_arr]));
            } else if ($request->hasFile($key)) {
                $file_name = md5(microtime()) . '.' . $request->file($key)->extension();

                // Image store with actual size
                $request->file($key)->storeAs($image_path, $file_name);

                // Image store with (160 x 120) size
                $imagePath = $request->file($key)->storeAs($thumb_path, $file_name);
                $image = Image::make($request->file($key))->resize($width, $height)->encode();
                Storage::put($imagePath, $image);

                $new_request = new Request(array_merge($new_request->all(), [$key => $file_name]));
            }
        }

        return $new_request;
    }
}