<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;

class CmsController extends Controller
{
    public function index(Request $request){
        $cms = CmsPage::where('url','like', '%' .$request->segment(1). '%')->first();
        return view('store.cms.index', compact('cms'));
    }
}
