<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use DB, Auth;

class AddressController extends Controller
{
    public function index(){
        $addresses = [];
        if(Auth::check()){
            $addresses =  DB::table('user_addresses')->where('user_id',Auth::user()->id)->get();
        }

        return response()->json([
           'success' => true,
           'code' => 200,
           'data' => $addresses,
           'message' => 'Address retrieve successfully'
        ]);
    }

    public function store(Request $request){
        $addresses = [];
        if(Auth::check()){
            $addresses =  DB::table('user_addresses')->where('user_id',Auth::user()->id)->get();
        }
          DB::table('user_addresses')->where('user_id',Auth::user()->id)->update([
            'by_default' => 0
          ]);

        $address = new UserAddress();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->pincode = $request->pincode;
        $address->landmark = $request->landmark;
        $address->city = $request->city;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->address_type = $request->addtype;
        $address->house = $request->house;
        $address->area = $request->area;
        $address->mobile = $request->mobile;
        if(count($addresses) > 0){
           if($request->by_default){
             $address->by_default = 1;
           }
           else{
             $address->by_default = 0;
           }
        }
        else{
          $address->by_default = 1;
        }
        $address->save();


        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Address created successfully'
         ]);
    }

    public function show($id){
      $address = UserAddress::find($id);
      return response()->json([
          'success' => true,
          'code' => 200,
          'message' => 'Address data retrieve successfully.',
          'data' => $address
      ]);
    }

    public function update(Request $request){
        $addresses = DB::table('user_addresses')->where('user_id', Auth::user()->id)->get();
        $by_default = 0;
        if(count($addresses) > 0){
           if($request->by_default){
             $by_default = 1;
           }
           else{
             $by_default = 0;
           }
        }
        else{
          $by_default = 1;
        }


        $address = DB::table('user_addresses')
        ->where('id', $request->address_id)
        ->where('user_id', Auth::user()->id)
        ->update([
            'name' => $request->name,
            'pincode' => $request->pincode,
            'landmark' => $request->landmark,
            'city' => $request->city,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'address_type' => $request->addtype,
            'house' => $request->house,
            'area' => $request->area,
            'mobile' => $request->mobile,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'by_default' => $by_default
        ]);



        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Address updated successfully'
         ]);
    }

    public function destroy($id)
    {

        $get = DB::table('user_addresses')
        ->where('id', $request->id)
        ->where('user_id', $Auth::user()->id)
        ->first();
        if($get->by_dafault === 1){
            DB::table('user_addresses')
            ->where('id', $request->id)
            ->where('user_id', $Auth::user()->id)
            ->where('by_dafault', '!=', 1)
            ->first()
            ->update(['by_dafault',1]);
        }


        $address = DB::table('user_addresses')
        ->where('id', $request->id)
        ->where('user_id', $Auth::user()->id)
        ->delete();


        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Address deleted successfully'
         ]);
    }

    public function delete($id)
    {
        $get = UserAddress::where('id', $id)
        ->where('user_id', Auth::user()->id)
        ->first();

        if($get->by_default === 1){
            $info = UserAddress::where('user_id', Auth::user()->id)
            ->where('by_default', 0)
            ->first()
            ->update(['by_default'=> 1]);
        }

        $address = DB::table('user_addresses')
        ->where('id', $id)
        ->where('user_id', Auth::user()->id)
        ->delete();

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Address deleted successfully'
         ]);
    }
}
