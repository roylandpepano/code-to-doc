<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationPackage;
use App\Models\Notification;
use App\Models\TourOperator;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helper\helper;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();
        $queryDest = ['dest_approval' => 'Approved'];
        $destinations = Destination::where($queryDest)
            ->where('hidden_gem', 1)
            ->orderBy('updated_at', 'DESC')
            ->limit(8)
            ->get();

        $queryTour = ['operator_approval' => 'Approved'];
        $tour_operators = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.user_picture')
            ->where($queryTour)->orderBy('created_at', 'DESC')
            ->limit(8)
            ->get();

        $famousTop = Destination::where($queryDest)
            ->where('famous', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->limit(2)
            ->get();

        $hiddenGem = Destination::where($queryDest)
            ->where('hidden_gem', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();

//Visitor Counter
        if(!Visitor::where('visitor',session()->getId())->where('page_name','index')->exists()) {
            Visitor::create([
                'visitor' => session()->getId(),
                'page_name' => 'index'
            ]);
        }

        // Lowest Package
        $lowestPackages = DestinationPackage::select('destination_packages.destination_id', DB::raw("MIN(CAST(SUBSTRING(destination_packages.dest_pkg_min_fee, 5, LENGTH(destination_packages.dest_pkg_min_fee)) AS INT)) as FEE"))
            ->groupBy('destination_id')
            ->get();

        return view('tourist.home', compact('notifications','lowestPackages', 'unread', 'owner', 'destinations', 'tour_operators', 'famousTop', 'hiddenGem'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $pages = User::join('destinations', 'users.id', '=', 'destinations.user_id')
            ->select('destinations.*', 'users.*')
            ->where('destinations.user_id', '=', Auth::guard('web')->user()->id)
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

        return view('tourist.users.show', compact('user','countSubmitted', 'countApproved', 'countPending', 'countRejected', 'notifications','unread','owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        return view('tourist.users.edit', compact('user','notifications','unread','owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request)
    {
        User::where('id', Auth::id())->update([
            'user_username' => $request->input('username'),
            'user_address' => $request->input('address'),
            'user_phone' => $request->input('phone'),
        ]);

        return redirect()->route('tourist.users.show', Auth::id())->with('success', 'Your profile information was successfully changed!');
    }

    /**
     * Update all notification notif_read to 1.
     *
     */
    public function markAllAsRead()
    {
        $notifications = helper::touristNotifications();
        foreach ($notifications as $notification){
            Notification::where('destination_id',$notification->dest_id)
                ->update([
                    'notif_read' => 1
                ]);
        }
        return redirect()->back();
    }
    /**
     * Update clicked notification notif_read to 1.
     *
     */
    public function readClickedNotification($id)
    {
        Notification::where('id',$id)
        ->update([
            'notif_read' => 1
        ]);
        $notification = Notification::leftJoin('destinations','notifications.destination_id','=','destinations.id')
            ->leftJoin('tour_operators','notifications.tour_operator_id','=','tour_operators.id')
            ->select('destinations.id as dest_id','dest_approval','tour_operators.id as to_id','operator_approval')
            ->where('notifications.id',$id)
            ->first();
        if ($notification->dest_id != null && $notification->dest_approval == 'Approved'){
            return redirect()->route('tourist.discover.show',$notification->dest_id);
        }else if ($notification->to_id != null && $notification->operator_approval == 'Approved' && $notification->user_id == null){
            return redirect()->route('tourist.tour_operator.show',$notification->to_id);
        }else{
            return redirect()->back();
        }
    }
}
