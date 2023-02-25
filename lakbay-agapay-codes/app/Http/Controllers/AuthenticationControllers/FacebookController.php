<?php

namespace App\Http\Controllers\AuthenticationControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function loginUsingFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook(){
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            $existUser = User::where('user_email', $facebookUser->email)->first();

            if ($existUser) {
                Auth::loginUsingId($existUser->id);
                return redirect()->route('tourist.home')->with('success', 'Welcome to Lakbay Agapay!');
            } else {
                $uuidFB = Str::uuid()->toString();

                $fname = strtok($facebookUser->getName(),  ' ');
                $lname = strrchr($facebookUser->getName(),' ');
                $lname = str_replace(' ', '', $lname);
                $latestID = User::count('id');
                $username = $fname.$lname.$latestID;
                $username = str_replace(' ', '', $username);

                $user = new User();
                $user->user_type = "Tourist";
                $user->user_picture = $facebookUser->getAvatar();
                $user->user_fname = $fname;
                $user->user_mname = "";
                $user->user_lname = $lname;
                $user->user_address = $facebookUser->user_hometown;
                $user->user_phone = "";
                $user->user_username = $username;
                $user->user_email = $facebookUser->email;
                $user->user_password = Hash::make($uuidFB . now());
                $user->user_logged_in_using = "Facebook";
                $user->google_id = $facebookUser->getId();

                $user->save();
                Auth::login($user);
                return redirect()->route('tourist.home')->with('success', 'Welcome to Lakbay Agapay!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'The system encountered an error in signing you up.');
        }
    }
}
