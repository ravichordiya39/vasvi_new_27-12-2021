<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\City;
use App\Models\UserAddress;
use App\Models\MapAttribute;
use Illuminate\Database\Eloquent\Builder;
use Phpfastcache\Helper\Psr16Adapter;
use DB, PDF;

class DemoController extends Controller
{
    public function index()
    {
        $mobile = "8483988837";
        $client = new \GuzzleHttp\Client();
        $key = env('SMS_AUTH_KEY');
        $otp = generateNumericOTP(6);
        $message = 'Your VASVI verification OTP - ' . $otp;

        $response = $client->request('GET', "http://www.dakshinfosoft.com/api/sendhttp.php?authkey=$key&mobiles=$mobile&message=$message&sender=VASVII&route=4&country=91");
    }

    public function filter(){
        $sizes = DB::table('sizes')->get();
        foreach($sizes as $size)
        {
            $data = DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.size_id', $size->id);

            $sizecount = \App\Models\Product::where('status',1)->whereHas('productProductVariations', function (Builder $query)  use ($size) {
                $query->where('size_id', $size->id);
            });

            if(request()->get('category') !== 'all'){
                $category = \App\Models\Category::where('name',request()->get('category'))->first();


                $data =
                $data->where('products.category_id', $category->id)
                ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);


                // $sizecount =
                // $sizecount->where('category_id', request()->get('category'))
                // ->orWhere('sub_category_id', request()->get('category'))->orWhere('sub_category_child_id', request()->get('category'));
            }

            // $sizecount = $sizecount->get();
            $sizecount = $data->groupBy('product_variations.product_id')->get();
            echo $size->name;
            echo "-";
            echo $sizecount->count();
            echo "<br>";
        }

    }

    public function sample(){

      $error = false;
      $maps = MapAttribute::where('is_attribute',1)->get();
      foreach($maps as $map){
        foreach($map->attributes as $key => $value){
          echo $key;
        }
      }
      dd($map->attributes);
      echo 'here';
    }

    public function sample3()
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));
        }
        putenv("PROJECT=hero");
    }

    public function posts()
    {
        $instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client(), 'vasvi_jaipur', 'vasvi@123', new Psr16Adapter('Files'));
        $instagram->login();
        $posts = $instagram->getFeed();
        return view('store.partials.instapost', compact('posts'));

    }

    function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function sample2()
    {
        $data = [
            'name' => 'Virendra'
        ];

        view()->share('request',$data);
        $pdf = PDF::loadView('store.invoice.index', $data);
        // return $pdf->download('pdf_file.pdf');
        return $pdf->stream();
    }

}
