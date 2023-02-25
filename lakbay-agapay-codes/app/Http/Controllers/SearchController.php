<?php

namespace App\Http\Controllers;

use App\Helper\helper;
use App\Models\Destination;
use App\Models\DestinationPackage;
use App\Models\Notification;
use App\Models\TourOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchDiscoverGuest(Request $request){
        $request->validate([
            'search'=>'required'
        ]);

        $option = '';
        $order = '';
        $queryDest = ['dest_approval' => 'Approved'];
        $categories = Destination::where($queryDest)
            ->distinct()
            ->orderBy('dest_category', 'ASC')
            ->get(['dest_category']);

        // Suggested Places
        $suggested = Destination::where('hidden_gem',1)
            ->where('dest_approval', 'Approved')
            ->get()->random(3)->values();
        $numbers = range(0, 2);
        shuffle($numbers);
        $final = array_slice($numbers, 0, 3);
        $rand1 = $suggested[$final[0]];
        $rand2 = $suggested[$final[1]];
        $rand3 = $suggested[$final[2]];

        // Lowest Package
        $lowestPackages = DestinationPackage::select('destination_packages.destination_id', DB::raw("MIN(CAST(SUBSTRING(destination_packages.dest_pkg_min_fee, 5, LENGTH(destination_packages.dest_pkg_min_fee)) AS INT)) as FEE"))
            ->groupBy('destination_id')
            ->get();

        if(isset($_GET['search'])){
            $destinations = Destination::where('dest_approval', '=', 'Approved')
                ->where(function ($query) {
                    $search_text = $_GET['search'];
                    $query->orWhere('dest_city', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('dest_name', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('dest_category', 'LIKE', '%'.$search_text.'%');
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(8);

            return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
        }else{
            $empty = 1;
            return view('guest.discover.index', compact('empty'));
        }
    }

    public function searchTourOperatorGuest(Request $request){
        $request->validate([
            'search'=>'required'
        ]);

        $option = '';
        $order = '';

        $suggested = TourOperator::where('operator_approval', 'Approved')
            ->get()->random(3)->values();
        $numbers = range(0, 2);
        shuffle($numbers);
        $final = array_slice($numbers, 0, 3);
        $rand1 = $suggested[$final[0]];
        $rand2 = $suggested[$final[1]];
        $rand3 = $suggested[$final[2]];

        if(isset($_GET['search'])){
            $tour_operators = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
                ->select('tour_operators.*', 'users.*')
                ->where('operator_approval', '=', 'Approved')
                ->where(function ($query) {
                    $search_text = $_GET['search'];
                    $query->orWhere('operator_city', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('operator_company', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('user_fname', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('user_mname', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('user_lname', 'LIKE', '%'.$search_text.'%');
                })
                ->orderBy('tour_operators.created_at', 'DESC')
                ->paginate(8);

            return view('guest.tour_operator.index', compact('tour_operators', 'rand1','rand2','rand3','option', 'order'));
        }else{
            $empty = 1;
            return view('guest.tour_operator.index', compact('empty'));
        }
    }

    public function searchDiscoverTourist(Request $request){
        $request->validate([
            'search'=>'required'
        ]);

        $option = '';
        $order = '';
        $queryDest = ['dest_approval' => 'Approved'];
        $categories = Destination::where($queryDest)
            ->distinct()
            ->orderBy('dest_category', 'ASC')
            ->get(['dest_category']);

        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        // Suggested Places
        $suggested = Destination::where('hidden_gem',1)
            ->where('dest_approval', 'Approved')
            ->get()->random(3)->values();
        $numbers = range(0, 2);
        shuffle($numbers);
        $final = array_slice($numbers, 0, 3);
        $rand1 = $suggested[$final[0]];
        $rand2 = $suggested[$final[1]];
        $rand3 = $suggested[$final[2]];

        // Lowest Package
        $lowestPackages = DestinationPackage::select('destination_packages.destination_id', DB::raw("MIN(CAST(SUBSTRING(destination_packages.dest_pkg_min_fee, 5, LENGTH(destination_packages.dest_pkg_min_fee)) AS INT)) as FEE"))
            ->groupBy('destination_id')
            ->get();

        if(isset($_GET['search'])){
            $destinations = Destination::where('dest_approval', '=', 'Approved')
                ->where(function ($query) {
                    $search_text = $_GET['search'];
                    $query->orWhere('dest_city', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('dest_name', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('dest_category', 'LIKE', '%'.$search_text.'%');
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(8);

            return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
        }else{
            $empty = 1;
            return view('tourist.discover.index', compact('empty','owner'));
        }
    }

    public function searchTourOperatorTourist(Request $request){
        $request->validate([
            'search'=>'required'
        ]);

        $option = '';
        $order = '';

        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

        $suggested = TourOperator::where('operator_approval', 'Approved')
            ->get()->random(3)->values();
        $numbers = range(0, 2);
        shuffle($numbers);
        $final = array_slice($numbers, 0, 3);
        $rand1 = $suggested[$final[0]];
        $rand2 = $suggested[$final[1]];
        $rand3 = $suggested[$final[2]];

        if(isset($_GET['search'])){
            $tour_operators = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
                ->select('tour_operators.*', 'users.*')
                ->where('operator_approval', '=', 'Approved')
                ->where(function ($query) {
                    $search_text = $_GET['search'];
                    $query->orWhere('operator_city', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('operator_company', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('user_fname', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('user_mname', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('user_lname', 'LIKE', '%'.$search_text.'%');
                })
                ->orderBy('tour_operators.created_at', 'DESC')
                ->paginate(8);

            return view('tourist.tour_operator.index', compact('tour_operators','rand1','rand2','rand3', 'notifications','unread', 'option', 'order','owner'));
        }else{
            $empty = 1;
            return view('tourist.tour_operator.index', compact('empty','owner'));
        }
    }
}
