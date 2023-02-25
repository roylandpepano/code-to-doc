<?php

namespace App\Http\Controllers;

use App\Helper\helper;
use App\Models\Notification;
use App\Models\Package;
use App\Models\TourOperator;
use App\Models\TourOperatorImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddTourOperatorController extends Controller
{
    public function index(){
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        return view('tour_operator.add_tour_operator.index', compact('notifications','unread','owner'));
    }

    public function create(Request $request, TourOperator $tourOperator){
        $request->validate([
            'image'=>'required',
            'business_permit' => 'required',
            'operator_company'=>'required',
            'operator_location'=>'required',
            'operator_city'=>'required',
            'operator_description'=>'required',
            'operator_email'=>'required|email',
            'operator_phone'=>'required'
        ]);

        $operator_services = $request->input('operator_services');

        if ($operator_services == "")
            $operator_services = "not specified";

        try {
            $tourOperator = TourOperator::create([
                'user_id' => Auth::id(),
                'operator_main_picture' => 'empty',
                'operator_operating' => $request->input('operator_operating'),
                'operator_business_permit' => 'empty',
                'operator_company' => $request->input('operator_company'),
                'operator_location' => $request->input('operator_location'),
                'operator_city' => $request->input('operator_city'),
                'operator_description' => $request->input('operator_description'),
                'operator_services' => $operator_services,
                'operator_email' => $request->input('operator_email'),
                'operator_phone_number' => $request->input('operator_phone'),
                'operator_fb' => $request->input('operator_fb'),
                'operator_twitter' => $request->input('operator_twt'),
                'operator_instagram' => $request->input('operator_ig'),
                'operator_website' => $request->input('operator_web'),
                'operator_approval' => 'Pending',
            ]);

            $tourOperator->save();
            $id = $tourOperator->id;

//        Insert Destination Images
            $counter = 0;
            foreach ($request->file('images') as $imageFile) {
                $counter++;
                $fileName = $id . 'operator_image' . $counter . '.' . $imageFile->getClientOriginalExtension();;
                $imageFile->move(public_path('img/tour_operator_images'), $fileName);
                $fileName = "img/tour_operator_images/" . $fileName;

                TourOperatorImage::create([
                    'tour_operator_id' => $id,
                    'operator_image' => $fileName
                ]);
            }
//        Tour Operator Main Picture
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

//        Tour Operator Business Permit
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

            foreach ($request->input('package_name') as $key => $value) {
                $package_description = $request->input('package_description')[$key];
                $package_min_fee = $request->input('package_fee')[$key];
                $package_rate = $request->input('package_number_of_pax')[$key];
                $package_inclusions = $request->input('package_inclusions')[$key];
                $package_itinerary = $request->input('package_itinerary')[$key];

                if($package_min_fee == "")
                    $package_min_fee = "--";
                if($package_rate == "")
                    $package_rate = "--";
                if($package_inclusions== "")
                    $package_inclusions = "--";
                if($package_itinerary == "")
                    $package_itinerary = "--";
                if ($value != "") {
                    Package::create([
                        'tour_operator_id' => $id,
                        'package_name' => $value,
                        'package_description' => $package_description,
                        'package_minimum_fee' => $package_min_fee,
                        'package_rate' => $package_rate,
                        'package_inclusions' => $package_inclusions,
                        'package_itinerary' => $package_itinerary,
                    ]);
                }
            }

            $user = User::where('id',Auth::guard('web')->user()->id)->first();

            Notification::create([
                'tour_operator_id' => $id,
                'notif_type' => 'Request',
                'notif_message' => $user->user_type.' '.$user->user_fname.' '.$user->user_lname.' requested to add a tour operator "'.$tourOperator->operator_company.'".',
                'notif_read' => false
            ]);

            return redirect()->route('tour_operator.index')->with('success', 'Your company '. $request->input('operator_company'). ' was successfully added in Lakbay Agapay! Kindly wait for the approval of your submission.');
        } catch (Exception $e){
            return redirect()->back()->with('error', $e);
        }
    }
}

