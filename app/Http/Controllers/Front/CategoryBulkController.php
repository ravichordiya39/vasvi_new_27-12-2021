<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryBulkController extends Controller
{
    public function index(){
        return view('front.category-bulk');
    }
}
