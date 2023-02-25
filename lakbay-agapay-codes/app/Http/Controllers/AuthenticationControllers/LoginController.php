<?php

namespace App\Http\Controllers\AuthenticationControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:20',
        ]);

        $attempt = Auth::guard('web')->attempt([
            'user_email' => $request->input('email'),
            'user_password' => $request->input('password'),
        ]);

        $remember_me = $request->has('remember') ? true : false;

        if($attempt) {
            $email = $request->input('email');
            $user = User::where("user_email", '=', $email)->first();
            $userType = Auth()->user()->user_type;

            if($userType == "Tourist" || $userType == "Owner" || $userType == "Tour Operator"){
                Auth::login($user, $remember_me);
                return redirect()->route('tourist.home')->with('success', 'Welcome to Lakbay Agapay!');
            } elseif($userType == "Admin"){
                Auth::login($user, $remember_me);
                return redirect()->route('admin.home')->with('success', 'Welcome to Lakbay Agapay Admin Homepage!');
            } elseif($userType == "Super Admin"){
                Auth::login($user, $remember_me);
                return redirect()->route('admin.home')->with('success', 'Welcome to Lakbay Agapay Super Admin Homepage!');
            }
        }else{
            return redirect()->back()->with('error', "Your email and password has no match with our records");
        }
    }
}
