<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\RegisterEvent;
use App\Events\OtpEvent;
use App\Models\User;
use App\Events\PasswordChangeEvent;

class EmailController extends Controller
{
    public function index()
    {
        $user = User::where('email', 'virendra.arekar@gmail.com')->first();


        // event(new RegisterEvent($user));
        // $user = [
        //     'otp' => '678956',
        //     'email' => $user->email
        // ];
        // event(new OtpEvent($user));
        $password = 'vfdsoipjasgsg';
        event(new PasswordChangeEvent($user, $password));
    }
}
