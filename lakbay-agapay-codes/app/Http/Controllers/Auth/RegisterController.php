<?php
//
//namespace App\Http\Controllers\Auth;
//
//use App\Http\Controllers\Controller;
//use App\Models\Register;
//use App\Providers\RouteServiceProvider;
//use App\Models\User;
//use Illuminate\Foundation\Auth\RegistersUsers;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
//
//class RegisterController extends Controller
//{
//    /*
//    |--------------------------------------------------------------------------
//    | Register Controller
//    |--------------------------------------------------------------------------
//    |
//    | This controller handles the registration of new users as well as their
//    | validation and creation. By default this controller uses a trait to
//    | provide this functionality without requiring any additional code.
//    |
//    */
//
//    use RegistersUsers;
//
//    /**
//     * Where to redirect users after registration.
//     *
//     * @var string
//     */
//    protected $redirectTo = RouteServiceProvider::HOME;
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('guest');
//    }
//
//    /**
//     * Get a validator for an incoming registration request.
//     *
//     * @param  array  $data
//     * @return \Illuminate\Contracts\Validation\Validator
//     */
//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'profile_pic' => 'required',
//            'first_name' => 'required',
//            'middle_name' => 'required',
//            'last_name' => 'required',
//            'address' => 'required',
//            'phone' => 'required',
//            'email' => 'required|email|unique:users,user_email',
//            'password' => 'required|min:8|max:20',
//            'confirm_password' => 'required|same:password'
//        ]);
//    }
//
//    /**
//     * Create a new tourist instance after a valid registration.
//     *
//     *
//     * @return \App\Models\User
//     */
//    public function create(Request $request, Register $users)
//    {
//        $request->validate([
//            'profile_pic'=>'required',
//            'first_name'=>'required',
//            'middle_name'=>'required',
//            'last_name'=>'required',
//            'address'=>'required',
//            'phone'=>'required',
//            'email'=>'required|email|unique:users,user_email',
//            'password'=>'required|min:8|max:20',
//            'confirm_password'=>'required|same:password'
//        ],[
//                'confirm_password.required'=>'The confirm password is required.',
//                'confirm_password.same'=>'The password and the confirm password must match.'
//            ]
//        );
//
//        $fileName = '';
//
//        if($request->hasFile('profile_pic')){
//            $file = $request->file('profile_pic');
//            $ext = $request->file('profile_pic')->getClientOriginalExtension();
//            $fileName = time().'.'.$ext;
//            $file->move(public_path('img/avatar'), $fileName);
//            $fileName = "img/avatar/".$fileName;
////            dd($fileName);
//        }else {
//            dd('No image was found');
//        }
//
//        $users->create([
//            'user_type' => $request->input('user_type'),
//            'user_picture' => $fileName,
//            'user_fname' => $request->input('first_name'),
//            'user_mname' => $request->input('middle_name'),
//            'user_lname' => $request->input('last_name'),
//            'user_address' => $request->input('address'),
//            'user_phone' => $request->input('phone'),
//            'user_username' => $request->input('first_name').' '.$request->input('last_name'),
//            'user_email' => $request->input('email'),
//            'user_password' => Hash::make($request->input('password')),
//            'user_logged_in_using' => $request->input('logged_using')
//        ]);
//
//        if($users){
//            return redirect()->route('tourist.login')->with('success', 'Thank you for signing up, now log in to Lakbay Agapay!');
//        }else{
//            return redirect()->back()->with('error', 'The system encountered an error in signing you up.');
//        }
//    }
//}
