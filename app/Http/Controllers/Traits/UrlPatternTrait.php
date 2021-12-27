<?php
namespace App\Http\Controllers\Traits;
use Illuminate\Http\Request;

trait UrlPatternTrait{
  public function checkout_url(Request $request){
    $pattern = '';
    if($pattern){
      return true;
    }
    else{
      return view('errors.404');
    }
  }

  public function buynow_url(Request $request){
    $pattern = '';
    if($pattern){
      return true;
    }
    else{
      return view('errors.404');
    }
  }


}
 ?>
