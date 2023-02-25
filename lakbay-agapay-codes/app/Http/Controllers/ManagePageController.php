<?php

namespace App\Http\Controllers;

use App\Helper\helper;
use App\Models\Destination;
use App\Models\DestinationActivity;
use App\Models\DestinationAmenity;
use App\Models\DestinationImage;
use App\Models\DestinationPackage;
use App\Models\Notification;
use App\Models\Package;
use App\Models\TourOperator;
use App\Models\TourOperatorImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ManagePageController extends Controller
{
    public function indexOwnerManagePage(){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $userID = Auth::guard('web')->user()->id;
        $pages = User::join('destinations', 'users.id', '=', 'destinations.user_id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'destinations.created_at as dest_created', 'destinations.updated_at as dest_updated')
            ->where('dest_owner', $userID)
            ->orderBy('destinations.created_at', 'DESC')
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

        return view('owner.index', compact('pages', 'countSubmitted', 'countApproved', 'countPending', 'countRejected', 'notifications','unread','owner'));
    }

    public function showOwnerManagePage($id){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $request= User::join('destinations', 'users.id', '=', 'destinations.user_id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id', 'destinations.created_at as dest_created', 'destinations.updated_at as dest_updated')
            ->where('destinations.id', '=', $id)
            ->first();

        $images = Destination::join('destination_images', 'destinations.id', '=', 'destination_id')
            ->select('destination_images.*')
            ->where('destinations.id', '=', $id)
            ->get();
        $activities = Destination::join('destination_activities', 'id', '=', 'destination_id')
            ->select('destination_activities.*')
            ->where('id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
        $amenities = Destination::join('destination_amenities', 'id', '=', 'destination_id')
            ->select('destination_amenities.*')
            ->where('id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
        $packages = Destination::join('destination_packages', 'id', '=', 'destination_id')
            ->select('destination_packages.*')
            ->where('id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('owner.show', compact('request','images', 'activities','amenities','packages', 'notifications','unread','owner'));
    }

    public function updateOwnerManagePage(Request $request, $id){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);

        $userID = Auth()->user()->id;
        $pages = User::join('destinations', 'users.id', '=', 'destinations.user_id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'destinations.created_at as dest_created', 'destinations.updated_at as dest_updated')
            ->where('dest_owner', '=', $userID)
            ->orderBy('destinations.created_at', 'DESC')
            ->get();

        if (($request->input('dest_operating')) == 'no'){
            $dest_operating = 1;
        }else{
            $dest_operating = 0;
        }

        // UPDATE STATEMENTS
        Destination::where('id', '=', $id)
            ->update([
                'dest_name' => $request->input('destination_name'),
                'dest_operating' => $dest_operating,
                'dest_description' => $request->input('destination_description'),
                'dest_date_opened' => $request->input('dest_date_opened'),
                'dest_working_hours' => $request->input('destination_working_hours'),
                'dest_address' => $request->input('destination_address'),
                'dest_city' => $request->input('destination_city'),
                'dest_latitude' => $request->input('latitude'),
                'dest_longitude' => $request->input('longitude'),
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
            ]);

        // IMAGE
        // Delete if removed and file is empty
        if (($request->input('hidden_input') == 'false') && (!$request->hasFile('image'))) {
            Destination::where('id', '=', $id)
                ->update([
                    'dest_main_picture' => null
                ]);
        }
        // Replace Image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $request->file('image')->getClientOriginalExtension();
            $fileName1 = $id . 'main' . '.' . $ext;
            $file->move(public_path('img/destination_main_pic'), $fileName1);
            $fileName1 = "img/destination_main_pic/" . $fileName1;

            Destination::where('id', '=', $id)
                ->update([
                    'dest_main_picture' => $fileName1
                ]);
        }

        if ($request->hasFile('business_permit')) {

            $file = $request->file('business_permit');
            $ext = $request->file('business_permit')->getClientOriginalExtension();
            $fileName2 = $id . 'main' . '.' . $ext;
            $file->move(public_path('img/destination_business_permit'), $fileName2);
            $fileName2 = "img/destination_business_permit/" . $fileName2;

            Destination::where('id', '=', $id)
                ->update([
                    'dest_business_permit' => $fileName2
                ]);
        }

        // Some users delete their entries on the user side when updating, that's why, just fetch
        // the changes and insert it in Activities, Amenities, and Packages

        // Delete Previous Images
        DestinationImage::where('destination_id', '=', $id)->delete();

        // Delete Previous Activities
        DestinationActivity::where('destination_id', '=', $id)->delete();

        // Delete Previous Amenity
        DestinationAmenity::where('destination_id', '=', $id)->delete();

        // Delete Previous Package
        DestinationPackage::where('destination_id', '=', $id)->delete();

        // Create New List of Activities, Amenities, and Packages in their respective tables

        $counter = 0;
//            update Destination Images
        if ($request->file('images') != null) {
            foreach ($request->file('images') as $imageFile) {
                $counter++;
                $fileName = $id . 'dest_image' . $counter . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('img/destination_images'), $fileName);
                $fileName = "img/destination_images/" . $fileName;

                $img = DestinationImage::where('dest_image', 'like','%'.$id.'dest_image'.$counter.'%')->first();
                if ($img === null) {
                    DestinationImage::create([
                        'destination_id' => $id,
                        'dest_image' => $fileName
                    ]);
                }
            }
            for($i=$counter+1; $i <= 5; $i++){
                $img = DestinationImage::where('dest_image', 'like','%'.$id.'dest_image'.$i.'%')->first('dest_image');
                if ($img !== null)
                    File::delete($img->dest_image);

                DestinationImage::where('dest_image','like','%'.$id.'dest_image'.$i.'%')->delete();
            }
        }
        // Insert in Activity
        foreach ($request->input('activity') as $key => $value) {
            if ($value != null) {
                DestinationActivity::create([
                    'destination_id' => $id,
                    'activity' => $value,
                    'activity_description' => $request->input('activity_description')[$key],
                    'activity_number_of_pax' => $request->input('activity_number_of_pax')[$key],
                    'activity_fee' => $request->input('activity_fee')[$key]
                ]);
            }
        }

        // Insert in Amenity
        foreach ($request->input('amenity') as $key => $value) {
            if ($value != null) {
                DestinationAmenity::create([
                    'destination_id' => $id,
                    'amenity' => $value,
                    'amenity_description' => $request->input('amenity_description')[$key],
                    'amenity_fee' => $request->input('amenity_fee')[$key]
                ]);
            }
        }

        // Insert in Package
        foreach ($request->input('dest_pkg_name') as $key => $value) {
            if ($value != null) {
                DestinationPackage::create([
                    'destination_id' => $id,
                    'dest_pkg_name' => $value,
                    'dest_pkg_description' => $request->input('dest_pkg_description')[$key],
                    'dest_pkg_min_fee' => $request->input('dest_pkg_min_fee')[$key],
                    'dest_pkg_rate' => $request->input('dest_pkg_rate')[$key],
                    'dest_pkg_inclusions' => $request->input('dest_pkg_inclusions')[$key]
                ]);
            }
        }

        return redirect()->route('owner.index', compact('pages', 'notifications','unread'))->with('success', 'Your '. $request->input('destination_name'). ' was successfully updated!');
    }

    public function indexTourOpManagePage(){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $userID = Auth()->user()->id;
        $pages = User::join('tour_operators', 'users.id', '=', 'tour_operators.user_id')
            ->select('tour_operators.*', 'users.*', 'tour_operators.id as tour_id', 'tour_operators.created_at as tour_created', 'tour_operators.updated_at as tour_updated')
            ->where('tour_operators.user_id', '=', $userID)
            ->orderBy('tour_operators.created_at', 'DESC')
            ->get();

        $countSubmitted = count($pages);
        $countApproved = 0;
        $countPending = 0;
        $countRejected = 0;
        foreach($pages as $page)
        {
            if($page->operator_approval == "Approved")
                $countApproved++;
            elseif($page->operator_approval == "Pending")
                $countPending++;
            elseif($page->operator_approval == "Rejected")
                $countRejected++;
        }

        return view('tour_operator.index', compact('pages', 'countSubmitted', 'countApproved', 'countPending', 'countRejected', 'notifications','unread','owner'));
    }

    public function showTourOpManagePage($id){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $request = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id', 'tour_operators.created_at as to_created', 'tour_operators.updated_at as to_updated')
            ->where('tour_operators.id', '=', $id)
            ->first();

        $images = TourOperator::join('tour_operator_images', 'tour_operators.id', '=', 'tour_operator_id')
            ->select('tour_operator_images.*')
            ->where('tour_operators.id', '=', $id)
            ->get();
        $packages = Package::select('packages.*')
            ->where('tour_operator_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('tour_operator.show', compact('request', 'packages','images', 'notifications','unread','owner'));
    }

    public function updateTourOpManagePage(Request $request, $id){

        // Delete Previous Packages
        Package::where('tour_operator_id', '=', $id)->delete();

        try {
                // UPDATE STATEMENTS
                TourOperator::where('id', '=', $id)
                    ->update([
                        'operator_main_picture' => $fileName,
                        'operator_business_permit' => $fileName1,
                        'operator_operating' => $operator_operating,
                        'operator_company' => $request->input('operator_company'),
                        'operator_operating' => $request->input('operator_operating'),
                        'operator_location' => $request->input('operator_location'),
                        'operator_city' => $request->input('operator_city'),
                        'operator_description' => $request->input('operator_description'),
                        'operator_services' => $request->input('operator_services'),
                        'operator_email' => $request->input('operator_email'),
                        'operator_phone_number' => $request->input('operator_phone'),
                        'operator_fb' => $request->input('operator_fb'),
                        'operator_twitter' => $request->input('operator_twt'),
                        'operator_instagram' => $request->input('operator_ig'),
                        'operator_website' => $request->input('operator_web'),
                    ]);
                // Replace Image
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $ext = $request->file('image')->getClientOriginalExtension();
                    $fileName1 = $id . 'main' . '.' . $ext;
                    $file->move(public_path('img/tour_operator_main_pic'), $fileName1);
                    $fileName1 = "img/tour_operator_main_pic/" . $fileName1;

                    TourOperator::where('id', '=', $id)
                        ->update([
                            'operator_main_picture' => $fileName1
                        ]);
                }

            // Delete Previous Images
            TourOperatorImage::where('tour_operator_id', '=', $id)->delete();

                $counter = 0;
    //            update Tour Operator Images
                if ($request->file('images') != null) {
                    foreach ($request->file('images') as $imageFile) {
                        $counter++;
                        $fileName = $id . 'operator_image' . $counter . '.' . $imageFile->getClientOriginalExtension();
                        $imageFile->move(public_path('img/tour_operator_images'), $fileName);
                        $fileName = "img/tour_operator_images/" . $fileName;

                        $img = TourOperatorImage::where('operator_image', 'like','%'.$id.'operator_image'.$counter.'%')->first();
                        if ($img === null) {
                            TourOperatorImage::create([
                                'tour_operator_id' => $id,
                                'operator_image' => $fileName
                            ]);
                        }
                    }
                    for($i=$counter+1; $i <= 5; $i++){
                        $img = TourOperatorImage::where('operator_image', 'like','%'.$id.'operator_image'.$i.'%')->first('operator_image');
                        if ($img !== null)
                            File::delete($img->operator_image);

                        TourOperatorImage::where('operator_image','like','%'.$id.'operator_image'.$i.'%')->delete();
                    }
                }
                //Replace Business Permit
                if ($request->hasFile('business_permit')) {
                    $file = $request->file('business_permit');
                    $ext = $request->file('business_permit')->getClientOriginalExtension();
                    $fileName1 = $id . 'main' . '.' . $ext;
                    $file->move(public_path('img/tour_operator_business_permit'), $fileName1);
                    $fileName1 = "img/tour_operator_business_permit/" . $fileName1;

                    TourOperator::where('id', '=', $id)
                        ->update([
                            'operator_business_permit' => $fileName1
                        ]);
                }
                // Insert New List of Packages
                foreach ($request->input('package_name') as $key => $value) {
                    if ($value != null) {
                        Package::create([
                            'tour_operator_id' => $id,
                            'package_name' => $value,
                            'package_description' => $request->input('package_description')[$key],
                            'package_minimum_fee' => $request->input('package_minimum_fee')[$key],
                            'package_rate' => $request->input('package_rate')[$key],
                            'package_inclusions' => $request->input('package_inclusions')[$key],
                            'package_itinerary' => $request->input('package_itinerary')[$key],
                        ]);
                    }
                }

                return redirect()->route('tour_operator.index')->with('success', 'Your '. $request->input('operator_company'). ' was successfully updated! Thank you!');

        } catch (Exception $e){
            return redirect()->back()->with('error', $e);
        }
    }
}
