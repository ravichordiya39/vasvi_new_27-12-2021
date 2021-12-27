<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function index(Request $request)
    {
        $config = Config::find(1);
        return view('admin.configs.edit', compact('config'));
    }

    public function store(Request $request)
    {
        $config = Config::find(1);
        $config->referral_amount = $request->referral_amount;
        $config->save();

        return back()->with('success','Config saved successfully.');
    }
}
