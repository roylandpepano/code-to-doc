<?php

namespace App\Http\Controllers;

use App\Helper\helper;
use App\Models\Destination;
use App\Models\DestinationActivity;
use App\Models\DestinationAmenity;
use App\Models\DestinationImage;
use App\Models\DestinationPackage;
use App\Models\EditDestination;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isEmpty;

class EditDestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($id)
    {
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $user = User::find(Auth::guard('web')->user()->id);
        $request= User::join('destinations', 'users.id', '=', 'destinations.user_id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id', 'destinations.created_at as dest_created', 'destinations.updated_at as dest_updated')
            ->where('destinations.id', '=', $id)
            ->first();
        $destination = Destination::where('id',$id)->first();
        if ($destination->dest_owner != null){
            $owned = 1;
        }else{
            $owned = 0;
        }


        return view('tourist.edit_destination.index', compact('request','owned','user','notifications','unread','owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EditDestination  $editDestination
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'destination_name' => 'required',
            'business_permit' => 'required_if:owner,yes',
            'destination_description' => 'required',
            'destination_working_hours' => 'required',
            'destination_address' => 'required',
            'destination_city' => 'required|not_in:Select',
            'destination_entrance_fee' => 'required',
        ]);

        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);

        $userID = Auth::guard('web')->user()->id;
        $destination = Destination::find($id);
        $edit_destination = EditDestination::where('user_id',$userID)
            ->where('destination_id',$id)
            ->count();

        if (($request->input('owner')) == 'yes'){
            $dest_owner = $userID;
        }else{
            $dest_owner = null;
        }

        if (($request->input('dest_operating')) == 'no'){
            $dest_operating = 1;
        }else{
            $dest_operating = 0;
        }
        if ($edit_destination == 0){
            // CREATE STATEMENTS
            $edit_destination = EditDestination::create([
                'user_id' => $userID,
                'destination_id' => $id,
                'dest_name' => $request->input('destination_name'),
                'dest_operating' => $dest_operating,
                'dest_owner' => $dest_owner,
                'dest_description' => $request->input('destination_description'),
                'dest_date_opened' => $request->input('dest_date_opened'),
                'dest_working_hours' => $request->input('destination_working_hours'),
                'dest_address' => $request->input('destination_address'),
                'dest_city' => $request->input('destination_city'),
                'dest_email' => $request->input('dest_email'),
                'dest_phone' => $request->input('dest_phone'),
                'dest_fb' => $request->input('dest_fb'),
                'dest_twt' => $request->input('dest_twt'),
                'dest_ig' => $request->input('dest_ig'),
                'dest_web' => $request->input('dest_web'),
                'dest_entrance_fee' => $request->input('destination_entrance_fee'),
                'dest_direction' => $request->input('dest_direction'),
                'dest_fare' => $request->input('dest_fare'),
                'dest_category' => $request->input('dest_category'),
                'edit_dest_approval' => 'Pending',
            ]);
            $edit_destination->save();

//        Destination Business Permit
            if ($request->hasFile('business_permit')) {

                $file = $request->file('business_permit');
                $ext = $request->file('business_permit')->getClientOriginalExtension();
                $fileName1 = $id .'_'. $userID . 'main' . '.' . $ext;
                $file->move(public_path('img/edit_destination_business_permit'), $fileName1);
                $fileName1 = "img/edit_destination_business_permit/" . $fileName1;

                EditDestination::where('destination_id', $id)
                    ->where('user_id',$userID)
                    ->update([
                        'dest_business_permit' => $fileName1
                    ]);
            }
        }else{
            // UPDATE STATEMENTS
            EditDestination::where('user_id',$userID)
                ->where('destination_id',$id)
                ->update([
                    'user_id' => $userID,
                    'destination_id' => $id,
                    'dest_name' => $request->input('destination_name'),
                    'dest_operating' => $dest_operating,
                    'dest_owner' => $dest_owner,
                    'dest_description' => $request->input('destination_description'),
                    'dest_date_opened' => $request->input('dest_date_opened'),
                    'dest_working_hours' => $request->input('destination_working_hours'),
                    'dest_address' => $request->input('destination_address'),
                    'dest_city' => $request->input('destination_city'),
                    'dest_email' => $request->input('dest_email'),
                    'dest_phone' => $request->input('dest_phone'),
                    'dest_fb' => $request->input('dest_fb'),
                    'dest_twt' => $request->input('dest_twt'),
                    'dest_ig' => $request->input('dest_ig'),
                    'dest_web' => $request->input('dest_web'),
                    'dest_entrance_fee' => $request->input('destination_entrance_fee'),
                    'dest_direction' => $request->input('dest_direction'),
                    'dest_fare' => $request->input('dest_fare'),
                    'dest_category' => $request->input('dest_category'),
                    'edit_dest_approval' => 'Pending',
            ]);
//        Destination Business Permit
            if ($request->hasFile('business_permit')) {

                $file = $request->file('business_permit');
                $ext = $request->file('business_permit')->getClientOriginalExtension();
                $fileName1 = $id .'_'. $userID . 'main' . '.' . $ext;
                $file->move(public_path('img/edit_destination_business_permit'), $fileName1);
                $fileName1 = "img/edit_destination_business_permit/" . $fileName1;

                EditDestination::where('destination_id', $id)
                    ->where('user_id',$userID)
                    ->update([
                        'dest_business_permit' => $fileName1
                    ]);
            }else{
                $img = EditDestination::where('destination_id', $id)->where('user_id',$userID)->first();
                File::delete($img->dest_business_permit);

                EditDestination::where('destination_id', $id)
                    ->where('user_id',$userID)
                    ->update([
                        'dest_business_permit' => null
                    ]);

            }
        }

        $user = User::where('id',Auth::guard('web')->user()->id)->first();
        Notification::create([
            'destination_id' => $id,
            'user_id' => $userID,
            'notif_type' => 'Request',
            'notif_message' => $user->user_type.' '.$user->user_fname.' '.$user->user_lname.' suggested an edit to destination "'.$destination->dest_name.'".',
            'notif_read' => false
        ]);
        return redirect()->route('tourist.discover', compact( 'notifications','unread'))->with('success', 'Your edit suggestion on '. $request->input('destination_name'). ' was successfully sent for approval!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EditDestination  $editDestination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EditDestination $editDestination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EditDestination  $editDestination
     * @return \Illuminate\Http\Response
     */
    public function destroy(EditDestination $editDestination)
    {
        //
    }
}
