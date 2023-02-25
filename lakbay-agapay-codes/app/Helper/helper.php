<?php
namespace App\Helper;

use App\Models\Destination;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class helper
{
    public function touristNotifications(){
        $notifications_dest = Notification::join('destinations','notifications.destination_id','=','destinations.id')
            ->select('destinations.*', 'notifications.*', 'destinations.id as dest_id', 'notifications.id as notification_id')
            ->where('notif_type','Message')
            ->where(function ($query) {
                $query->where('destinations.user_id',Auth::guard('web')->user()->id)
                    ->orWhere('notifications.user_id',Auth::guard('web')->user()->id);
            })
            ->orderBy('notifications.created_at', 'DESC')
            ->get();
        $notifications_to = Notification::join('tour_operators','notifications.tour_operator_id','=','tour_operators.id')
            ->select('tour_operators.*', 'notifications.*','tour_operators.id as to_id', 'notifications.id as notification_id')
            ->where('tour_operators.user_id',Auth::guard('web')->user()->id)
            ->where('notif_type','Message')
            ->orderBy('notifications.created_at', 'DESC')
            ->get();
        $notifications = collect();
        if ($notifications_dest->isNotEmpty()){
            $notifications = $notifications_dest;
        }else if ($notifications_to->isNotEmpty()){
            $notifications = $notifications_to;
        }
        return $notifications;
    }

    public function adminNotifications(){
        $notifications = Notification::where('notif_type','Request')
            ->orderBy('notifications.created_at', 'DESC')
            ->get();
        return $notifications;
    }

    public function owner(): bool
    {
        $owned = Destination::where('dest_owner',Auth::guard('web')->user()->id)
            ->count();
        if ($owned != 0){
            return true;
        }else{
            return false;
        }
    }
}
