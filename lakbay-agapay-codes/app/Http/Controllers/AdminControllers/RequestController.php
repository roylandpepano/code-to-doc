<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    public function index(){
        return view('admin.requests.index');
    }
}
