<?php

namespace App\Http\Controllers;

use App\Helper\helper;
use App\Http\Requests\CreateDestinationRequest;
use App\Models\Destination;
use App\Models\DestinationActivity;
use App\Models\DestinationAmenity;
use App\Models\DestinationImage;
use App\Models\DestinationPackage;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AddDestinationController extends Controller
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

        return view('tourist.add_destination.index', compact('notifications','unread','owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create(CreateDestinationRequest $request, Destination $destination)
    {

        $dest_date_opened = $request->input('dest_date_opened');
        $dest_phone = $request->input('dest_phone');
        $dest_email = $request->input('dest_email');
        $dest_fare = $request->input('dest_fare');
        $dest_direction = $request->input('dest_direction');

        if ($dest_phone == "")
            $dest_phone = "not specified";
        if ($dest_email == "")
            $dest_email = "not specified";
        if ($dest_date_opened == "")
            $dest_date_opened = "null";
        if ($dest_fare == "")
            $dest_fare = "not specified";
        if ($dest_direction == "")
            $dest_direction = "not specified";

        if (($request->input('owner')) == 'yes'){
            $dest_owner = Auth::guard('web')->user()->id;
        }else{
            $dest_owner = null;
        }

        $destination = Destination::create([
            'dest_name' => $request->input('destination_name'),
            'user_id' => Auth::guard('web')->user()->id,
            'dest_owner' => $dest_owner,
            'dest_operating' => $request->input('dest_operating'),
            'dest_description' => $request->input('destination_description'),
            'dest_date_opened' => $dest_date_opened,
            'dest_working_hours' => $request->input('destination_working_hours'),
            'dest_category' => $request->input('dest_category'),
            'dest_address' => $request->input('destination_address'),
            'dest_city' => $request->input('destination_city'),
            'dest_latitude' => $request->input('latitude'),
            'dest_longitude' => $request->input('longitude'),
            'dest_email' => $dest_email,
            'dest_phone' => $dest_phone,
            'dest_fb' => $request->input('dest_fb'),
            'dest_twt' => $request->input('dest_twt'),
            'dest_ig' => $request->input('dest_ig'),
            'dest_web' => $request->input('dest_web'),
            'dest_entrance_fee' => $request->input('destination_entrance_fee'),
            'dest_fare' => $dest_fare,
            'dest_direction' => $dest_direction,
            'hidden_gem' => 1,
            'famous' => 0,
            'dest_approval' => 'Pending',
            'dest_rating_average' => 0,
        ]);
        $destination->save();
        $dest_id = $destination->id;
//        Destination Main Picture
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $request->file('image')->getClientOriginalExtension();
            $fileName1 = $dest_id . 'main' . '.' . $ext;
            $file->move(public_path('img/destination_main_pic'), $fileName1);
            $fileName1 = "img/destination_main_pic/" . $fileName1;

            Destination::where('id', '=', $dest_id)
                ->update([
                    'dest_main_picture' => $fileName1
                ]);
        }
//        Destination Business Permit
        if ($request->hasFile('business_permit')) {

            $file = $request->file('business_permit');
            $ext = $request->file('business_permit')->getClientOriginalExtension();
            $fileName1 = $dest_id . 'main' . '.' . $ext;
            $file->move(public_path('img/destination_business_permit'), $fileName1);
            $fileName1 = "img/destination_business_permit/" . $fileName1;

            Destination::where('id', '=', $dest_id)
                ->update([
                    'dest_business_permit' => $fileName1
                ]);
        }

//        INSERTING REPEATING FIELD (Activity, Amenity, Package)

        if($destination->save()){
            $counter = 0;
//            insert Destination Images
            foreach ($request->file('images') as $imageFile) {
                $counter++;
                $fileName = $dest_id . 'dest_image' . $counter . '.' . $imageFile->getClientOriginalExtension();;
                $imageFile->move(public_path('img/destination_images'), $fileName);
                $fileName = "img/destination_images/" . $fileName;

                DestinationImage::create([
                        'destination_id' => $dest_id,
                        'dest_image' => $fileName
                    ]);
            }
//            insert Activity
            foreach($request->input('activity') as $key => $value) {
                $act_pax = $request->input('activity_number_of_pax')[$key];
                $act_fee = $request->input('activity_fee')[$key];
                if($act_pax == "")
                    $act_pax = "--";
                if($act_fee == "")
                    $act_fee = "--";
                if ($value != ""){
                    DestinationActivity::create([
                        'destination_id' => $dest_id,
                        'activity' => $value,
                        'activity_description' => $request->input('activity_description')[$key],
                        'activity_number_of_pax' => $act_pax,
                        'activity_fee' => $act_fee,
                    ]);
                }
            }
//            insert Amenity
            foreach($request->input('amenity') as $key => $value) {
                $am_fee = $request->input('amenity_fee')[$key];
                if($am_fee == "")
                    $am_fee = "--";
                if ($value != ""){
                    DestinationAmenity::create([
                        'destination_id' => $dest_id,
                        'amenity' => $value,
                        'amenity_description' => $request->input('amenity_description')[$key],
                        'amenity_fee' => $am_fee,
                    ]);
                }
            }
//            insert Package
            foreach($request->input('dest_pkg_name') as $key => $value) {
                $dest_pkg_min_fee = $request->input('dest_pkg_min_fee')[$key];
                $dest_pkg_rate = $request->input('dest_pkg_rate')[$key];
                $dest_pkg_inclusions = $request->input('dest_pkg_inclusions')[$key];
                if($dest_pkg_min_fee == "")
                    $dest_pkg_min_fee = "--";
                if($dest_pkg_rate == "")
                    $dest_pkg_rate = "--";
                if($dest_pkg_inclusions == "")
                    $dest_pkg_inclusions = "not specified";

                if ($value != ""){
                   DestinationPackage::create([
                        'destination_id' => $dest_id,
                        'dest_pkg_name' => $value,
                        'dest_pkg_description' => $request->input('dest_pkg_description')[$key],
                        'dest_pkg_min_fee' => $dest_pkg_min_fee,
                        'dest_pkg_rate' => $dest_pkg_rate,
                        'dest_pkg_inclusions' => $dest_pkg_inclusions,
                    ]);
                }
            }


            $user = User::where('id',Auth::guard('web')->user()->id)->first();

            Notification::create([
                'destination_id' => $dest_id,
                'notif_type' => 'Request',
                'notif_message' => $user->user_type.' '.$user->user_fname.' '.$user->user_lname.' requested to add a destination "'.$destination->dest_name.'".',
                'notif_read' => false
            ]);

            if($dest_owner == 1){
                return redirect()->route('owner.index')->with('success', 'Your request has been sent for approval. Thank you!');
            } else {
                return redirect()->route('tourist.discover')->with('success', 'Your request has been sent for approval. Thank you!');
            }

        }else{
            return redirect()->back()->with('error', 'The system encountered an error in adding the destination.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Destination $destination)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        //
    }
}
