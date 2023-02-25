<?php

namespace App\Http\Controllers\NavigationControllers;

use App\Helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index(){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        return view('tourist.about.index',compact('notifications','unread','owner'));
    }
    public function map(){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

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
        return view('tourist.map.map', compact('destinations','rand1','rand2','rand3','notifications','unread','owner'));
    }
}
