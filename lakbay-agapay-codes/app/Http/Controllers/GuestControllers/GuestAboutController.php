<?php

namespace App\Http\Controllers\GuestControllers;

use App\Http\Controllers\Controller;
use App\Models\Destination;

class GuestAboutController extends Controller
{
    public function index(){
        return view('guest.about.index');
    }

    public function map(){
        $destinations = Destination::where('dest_approval','Approved')
            ->where('dest_longitude', '!=', '')
            ->where('dest_latitude','!=', '')
            ->where('dest_longitude', '!=', '123.72595988123209')
            ->where('dest_latitude', '!=', '13.143986664725428')
            ->get();

        $suggested = Destination::where('hidden_gem',1)->get()->random(3)->values();
        $numbers = range(0, 2);
        shuffle($numbers);
        $final = array_slice($numbers, 0, 3);
        $rand1 = $suggested[$final[0]];
        $rand2 = $suggested[$final[1]];
        $rand3 = $suggested[$final[2]];
//        $markers = $destinations->map(function ($item, $key){
//            return [$item->dest_name, $item->dest_latitude, $item->dest_longitude];
//        });
        return view('guest.map.map', compact('destinations','rand1','rand2','rand3'));
    }
}
