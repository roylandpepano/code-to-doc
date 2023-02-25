<?php

namespace App\Http\Controllers\AuthenticationControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('index');
    }
}
