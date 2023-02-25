<?php

namespace App\Http\Controllers\NavigationControllers;

use App\Helper\helper;
use App\Http\Controllers\Controller;
use App\Models\DestinationPackage;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteDestination;
use Illuminate\Support\Facades\DB;

class ShowFavoriteDestinationsController extends Controller
{
    public function index(){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $user_id = Auth::id();
        $fav_destinations = FavoriteDestination::where(['user_id' => $user_id])->paginate(8);
        $countFav = count($fav_destinations);

        // Lowest Package
        $lowestPackages = DestinationPackage::select('destination_packages.destination_id', DB::raw("MIN(CAST(SUBSTRING(destination_packages.dest_pkg_min_fee, 5, LENGTH(destination_packages.dest_pkg_min_fee)) AS INT)) as FEE"))
            ->groupBy('destination_id')
            ->get();

        return view('tourist.discover.favorite_destinations', compact('fav_destinations','lowestPackages', 'countFav', 'notifications','unread','owner'));
    }
}
