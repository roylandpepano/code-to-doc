<?php

namespace App\Http\Controllers;

use App\Helper\helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id) {
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $profile = User::where('users.id', '=', $id)->first();
        $pages = User::join('destinations', 'users.id', '=', 'destinations.user_id')
            ->select('destinations.*', 'users.*')
            ->where('destinations.user_id', '=', $id)
            ->get();

        $countSubmitted = count($pages);
        $countApproved = 0;
        $countPending = 0;
        $countRejected = 0;
        foreach($pages as $page)
        {
            if($page->dest_approval == "Approved")
                $countApproved++;
            elseif($page->dest_approval == "Pending")
                $countPending++;
            elseif($page->dest_approval == "Rejected")
                $countRejected++;
        }

        return view('tourist.profile.show', compact('profile', 'countSubmitted', 'countApproved', 'countPending', 'countRejected', 'notifications','unread','owner'));
    }
}
