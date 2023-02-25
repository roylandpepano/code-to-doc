<?php

namespace App\Http\Controllers\NavigationControllers;

use App\Helper\helper;
use App\Http\Controllers\Controller;
use App\Models\FavoriteTourOperator;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ShowFavoriteOperatorsController extends Controller
{
    public function index(){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $user_id = Auth::id();
        $fav_operators = FavoriteTourOperator::where(['user_id' => $user_id])->paginate(8);
        $countFav = count($fav_operators);
        return view('tourist.tour_operator.favorite_tour_operators', compact('fav_operators','countFav', 'notifications','unread','owner'));
    }
}
