<?php
//
//namespace App\Http\Controllers\Auth;
//
//use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class LoginController extends Controller
//{
//    /*
//    |--------------------------------------------------------------------------
//    | Login Controller
//    |--------------------------------------------------------------------------
//    |
//    | This controller handles authenticating users for the application and
//    | redirecting them to your home screen. The controller uses a trait
//    | to conveniently provide its functionality to your applications.
//    |
//    */
//
//    use AuthenticatesUsers;
//
//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
//    protected $redirectTo = RouteServiceProvider::HOME;
//        protected function redirectTo(){
//            if( Auth()->users()->user_type == "Tourist"){
//                return route('tourist.home');
//            } elseif(Auth()->users()->user_type == "Admin") {
//                return route('admin.home');
//            }
//        }
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }
//
//    public function login(Request $request)
//    {
//
//        $request->validate([
//            'email'=>'required|email',
//            'password'=>'required|min:8|max:20',
//        ]);
//
//        $attempt = Auth::guard('web')->attempt([
//            'user_email' => $request->input('email'),
//            'user_password' => $request->input('password')
//        ]);
//
//        dd(Auth()->users()->user_type == "Tourist");
//
//        if($attempt) {
//            if(Auth()->users()->user_type == "Tourist"){
//                return redirect()->route('tourist.home')->with('success', 'Welcome to Lakbay Agapay!');
//            } elseif(Auth()->users()->user_type == "Admin"){
//                return redirect()->route('admin.home')->with('success', 'Welcome to Lakbay Agapay Admin Homepage!');
//            }else{
//                return redirect()->route('index')->with('error', 'You do not have a role.');
//            }
//        }else{
//            return redirect()->back()->with('error', "Your email and password has no match with our records");
//        }
//    }
//}
