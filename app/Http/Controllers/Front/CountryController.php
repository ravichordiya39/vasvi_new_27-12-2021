<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CountryController extends Controller
{
    public function state($id){
      $states = DB::table('states')->where('country_id', $id)->get();
      return response()->json([
        'success' => true,
        'code' => 200,
        'message' => 'States are retrieve successfully.',
        'data' => $states
      ]);
    }
}
