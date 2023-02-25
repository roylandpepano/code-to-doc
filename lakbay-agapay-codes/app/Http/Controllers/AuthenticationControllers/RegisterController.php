<?php

namespace App\Http\Controllers\AuthenticationControllers;

use App\Http\Controllers\Controller;
use App\Models\Register;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request, Register $user)
    {

        $request->validate([
            'profile_pic'=>'required',
            'first_name'=>'required',
            'middle_name'=>'required',
            'last_name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'user_type'=>'required',
            'email'=>'required|email|unique:users,user_email',
            'password'=>'required|min:8|max:20',
            'confirm_password'=>'required|same:password'
        ],[
                'confirm_password.required'=>'The confirm password is required.',
                'confirm_password.same'=>'The password and the confirm password must match.'
            ]
        );

        try {
            $fileName = '';

            if($request->hasFile('profile_pic')){
                $file = $request->file('profile_pic');
                $ext = $request->file('profile_pic')->getClientOriginalExtension();
                $fileName = time().'.'.$ext;
                $file->move(public_path('img/avatar'), $fileName);
                $fileName = "img/avatar/".$fileName;
//            dd($fileName);
            }else {
                dd('No image was found');
            }

            $latestID = User::count('id');

            $user->create([
                'user_type' => $request->input('user_type'),
                'user_picture' => $fileName,
                'user_fname' => $request->input('first_name'),
                'user_mname' => $request->input('middle_name'),
                'user_lname' => $request->input('last_name'),
                'user_address' => $request->input('address'),
                'user_phone' => $request->input('phone'),
                'user_username' => $request->input('first_name').$request->input('last_name').$latestID,
                'user_email' => $request->input('email'),
                'user_password' => Hash::make($request->input('password')),
                'user_logged_in_using' => $request->input('logged_using'),
                'google_id' => ""
            ]);

            return redirect()->route('guest.login')->with('success', 'Thank you for signing up, now log in to Lakbay Agapay!');
        } catch (Exception $e){
            return redirect()->back()->with('error', 'Please fill all the required fields.');
        }
    }
}
