<?php

namespace App\Http\Controllers\AuthenticationControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        try {
            $googleUser = Socialite::driver('google')->user();
            $existUser = User::where('user_email', $googleUser->email)->first();

            if($existUser && $existUser->user_type == "Tourist") {
                Auth::loginUsingId($existUser->id);
                return redirect()->route('tourist.home')->with('success', 'Welcome to Lakbay Agapay!');
            }else if ($existUser && $existUser->user_type == "Admin"){
                Auth::loginUsingId($existUser->id);
                return redirect()->route('admin.home')->with('success', 'Welcome to Lakbay Agapay Admin Homepage!');
            }else if ($existUser && $existUser->user_type == "Super Admin"){
                Auth::loginUsingId($existUser->id);
                return redirect()->route('admin.home')->with('success', 'Welcome to Lakbay Agapay Super Admin Homepage!');
            }  else {
                $uuid = Str::uuid()->toString();

                $fname = strtok($googleUser->getName(),  ' ');
                $lname = strrchr($googleUser->getName(),' ');
                $lname = str_replace(' ', '', $lname);
                $latestID = User::count('id');
                $username = $fname.$lname.$latestID;
                $username = str_replace(' ', '', $username);

                $user = new User();
                $user->user_type = "Tourist";
                $user->user_picture = $googleUser->getAvatar();
                $user->user_fname = $fname;
                $user->user_mname = "";
                $user->user_lname = $lname;
                $user->user_address = "";
                $user->user_phone = "";
                $user->user_username = $username;
                $user->user_email = $googleUser->email;
                $user->user_password = Hash::make($uuid . now());
                $user->user_logged_in_using = "Google";
                $user->google_id = $googleUser->getId();

                $user->save();
                Auth::login($user);
                return redirect()->route('tourist.home')->with('success', 'Welcome to Lakbay Agapay!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'The system encountered an error in signing you up.');
        }
    }
}
