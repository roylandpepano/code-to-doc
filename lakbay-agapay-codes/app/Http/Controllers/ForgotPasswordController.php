<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotPage(){
        return view('password.forgot');
    }

    public function sendForgotLink(Request $request){
        $request->validate([
           'email'=>'required|email|exists:users,user_email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'user_email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);

        $email = $request->email;
        $user = User::select('user_fname', 'user_lname')
            ->where("user_email", '=', $email)
            ->first();

        $action_link = route('password.reset', ['token'=>$token, 'user_email'=>$request->email]);
        $body = "
                Hi ".$user->user_fname." ".$user->user_lname."!<br><br>
                There was a request to change your password in Lakbay Agapay!<br>
                If you did not make this request then please ignore this email.
                Otherwise, please click this link to change your password:";

        Mail::send('password.email', ['action_link'=>$action_link, 'body'=>$body], function ($message) use ($request){
            $message->from('noreply@lakbay-agapay.com', 'Lakbay Agapay');

            $email = $request->email;
            $user = User::select('user_fname', 'user_lname')
                ->where("user_email", '=', $email)
                ->first();

            $message->to($request->email, $user->user_fname)
                    ->subject('Reset Password');
        });

        return back()->with('success', 'We have successfully sent the password reset link to your email address.');
    }

    public function showResetPage(Request $request, $token = null){
        return view('password.reset')->with(['token'=>$token, 'user_email'=>$request->email]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,user_email',
            'password'=>'required|min:8|max:20',
            'confirm_password'=>'required|same:password'
        ]);

        $check_token = DB::table('password_resets')->where([
            'user_email'=>$request->email,
            'token'=>$request->token
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid token');
        }else{
            User::where('user_email', $request->email)->update([
                'user_password'=>Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'user_email'=>$request->email
            ])->delete();

            return redirect()->route('guest.login')->with('info', 'You successfully changed your password! Login now with your new password');
        }
    }
}
