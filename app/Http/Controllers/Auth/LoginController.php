<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
    // use AuthenticatesUsers;
    use AuthenticatesUsers {
        logout as performLogout;
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        $this->performLogout($request);
        return redirect()->route('login');
    }
}
