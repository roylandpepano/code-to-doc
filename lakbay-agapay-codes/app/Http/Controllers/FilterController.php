<?php
namespace App\Http\Controllers;
use App\Helper\helper;
use App\Models\Destination;
use App\Models\DestinationPackage;
use App\Models\Notification;
use App\Models\TourOperator;
use App\Models\TourOperatorRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class FilterController extends Controller
{
    public function filterDiscoverGuest(Request $request){
        $request->validate([
            'option'=>'required',
            'order'=>'required'
        ]);

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

        $queryDest = ['dest_approval' => 'Approved'];
        $categories = Destination::where($queryDest)
            ->distinct()
            ->orderBy('dest_category', 'ASC')
            ->get(['dest_category']);

        // Lowest Package
        $lowestPackages = DestinationPackage::select('destination_packages.destination_id', DB::raw("MIN(CAST(SUBSTRING(destination_packages.dest_pkg_min_fee, 5, LENGTH(destination_packages.dest_pkg_min_fee)) AS INT)) as FEE"))
            ->groupBy('destination_id')
            ->get();

        if(isset($_GET['option']) && isset($_GET['order'])){
            $option = $_GET['option'];
            $order = $_GET['order'];

            if($option == 'all'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('created_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'all';
                return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
            }
            elseif($option == 'name') {
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_name', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_name', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'name';
                return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
            }
            elseif($option == 'rating') {
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->where('dest_rating_average', '!=', 'Null')
                        ->orderBy('dest_rating_average', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->where('dest_rating_average', '!=', 'Null')
                        ->orderBy('dest_rating_average', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'rating';
                return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
            }
            elseif($option == 'published'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('updated_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'published';
                return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
            }
            elseif($option == 'hidden_gem'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->where('hidden_gem', '=', 1)
                        ->orderBy('updated_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->where('hidden_gem', '=', 1)
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'hidden_gem';
                return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
            }
            elseif($option == 'date_opened'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_date_opened', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_date_opened', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'date_opened';
                return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
            }
            elseif($option == 'municipality'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_city', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_city', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'municipality';
                return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
            }
//            elseif($option == 'entrance_fee'){
//                if($order == 'asc'){
//                    $destinations = Destination::where('dest_approval', '=', 'Approved')
//                        ->orderBy('dest_entrance_fee', 'ASC')
//                        ->paginate(8);
//                    $order = 'asc';
//                } else {
//                    $destinations = Destination::where('dest_approval', '=', 'Approved')
//                        ->orderBy('dest_entrance_fee', 'DESC')
//                        ->paginate(8);
//                    $order = 'desc';
//                }
//                $option = 'entrance_fee';
//                return view('guest.discover.index', compact('destinations', 'lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
//            }
        }else{
            $empty = 1;
            return view('guest.discover.index', compact('empty'));
        }
    }

    public function filterTourOperatorGuest(Request $request){
        $request->validate([
            'option'=>'required',
            'order'=>'required'
        ]);

        $suggested = TourOperator::where('operator_approval', 'Approved')
            ->get()->random(3)->values();
        $numbers = range(0, 2);
        shuffle($numbers);
        $final = array_slice($numbers, 0, 3);
        $rand1 = $suggested[$final[0]];
        $rand2 = $suggested[$final[1]];
        $rand3 = $suggested[$final[2]];

        if(isset($_GET['option']) && isset($_GET['order'])){
            $option = $_GET['option'];
            $order = $_GET['order'];
            if($option == 'all'){
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('created_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'all';
                return view('guest.tour_operator.index', compact('tour_operators', 'rand1','rand2','rand3', 'option', 'order'));
            }
            elseif($option == 'name') {
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('operator_company', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('operator_company', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'name';
                return view('guest.tour_operator.index', compact('tour_operators', 'rand1','rand2','rand3', 'option', 'order'));
            }
            elseif($option == 'rating') {
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->where('operator_rating_average', '!=', 'Null')
                        ->orderBy('operator_rating_average', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->where('operator_rating_average', '!=', 'Null')
                        ->orderBy('operator_rating_average', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'rating';
                return view('guest.tour_operator.index', compact('tour_operators', 'rand1','rand2','rand3', 'option', 'order'));
            }
            elseif($option == 'published'){
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('updated_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'published';
                return view('guest.tour_operator.index', compact('tour_operators', 'rand1','rand2','rand3', 'option', 'order'));
            }
            elseif($option == 'municipality'){
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('operator_city', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('operator_city', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'municipality';
                return view('guest.tour_operator.index', compact('tour_operators', 'rand1','rand2','rand3', 'option', 'order'));
            }
        }else{
            $empty = 1;
            return view('guest.tour_operator.index', compact('empty'));
        }
    }

    public function filterDiscoverTourist(Request $request){
        $request->validate([
            'option'=>'required',
            'order'=>'required'
        ]);

        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);
        $owner = helper::owner();

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

        if(isset($_GET['option']) && isset($_GET['order'])){
            $option = $_GET['option'];
            $order = $_GET['order'];

            if($option == 'all'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('created_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'all';
                return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'name') {
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_name', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_name', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'name';
                return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'rating') {
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->where('dest_rating_average', '!=', 'Null')
                        ->orderBy('dest_rating_average', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->where('dest_rating_average', '!=', 'Null')
                        ->orderBy('dest_rating_average', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'rating';
                return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'published'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('updated_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'published';
                return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'hidden_gem'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->where('hidden_gem', '=', 1)
                        ->orderBy('updated_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->where('hidden_gem', '=', 1)
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'hidden_gem';
                return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'date_opened'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_date_opened', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_date_opened', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'date_opened';
                return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'municipality'){
                if($order == 'asc'){
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_city', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $destinations = Destination::where('dest_approval', '=', 'Approved')
                        ->orderBy('dest_city', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'municipality';
                return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
            }
//            elseif($option == 'entrance_fee'){
//                if($order == 'asc'){
//                    $destinations = Destination::where('dest_approval', '=', 'Approved')
//                        ->orderBy('dest_entrance_fee', 'ASC')
//                        ->paginate(8);
//                    $order = 'asc';
//                } else {
//                    $destinations = Destination::where('dest_approval', '=', 'Approved')
//                        ->orderBy('dest_entrance_fee', 'DESC')
//                        ->paginate(8);
//                    $order = 'desc';
//                }
//                $option = 'entrance_fee';
//                return view('tourist.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'notifications','unread', 'option', 'order','owner'));
//            }
        }else{
            $empty = 1;
            return view('tourist.discover.index', compact('empty','owner'));
        }
    }

    public function filterTourOperatorTourist(Request $request){
        $request->validate([
            'option'=>'required',
            'order'=>'required'
        ]);

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

        if(isset($_GET['option']) && isset($_GET['order'])){
            $option = $_GET['option'];
            $order = $_GET['order'];

            if($option == 'all'){
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('created_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'all';
                return view('tourist.tour_operator.index', compact('tour_operators','rand1','rand2','rand3', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'name') {
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('operator_company', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('operator_company', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'name';
                return view('tourist.tour_operator.index', compact('tour_operators','rand1','rand2','rand3', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'rating') {
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->where('operator_rating_average', '!=', 'Null')
                        ->orderBy('operator_rating_average', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->where('operator_rating_average', '!=', 'Null')
                        ->orderBy('operator_rating_average', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'rating';
                return view('tourist.tour_operator.index', compact('tour_operators','rand1','rand2','rand3', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'published'){
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('updated_at', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'published';
                return view('tourist.tour_operator.index', compact('tour_operators','rand1','rand2','rand3', 'notifications','unread', 'option', 'order','owner'));
            }
            elseif($option == 'municipality'){
                if($order == 'asc'){
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('operator_city', 'ASC')
                        ->paginate(8);
                    $order = 'asc';
                } else {
                    $tour_operators = TourOperator::where('operator_approval', '=', 'Approved')
                        ->orderBy('operator_city', 'DESC')
                        ->paginate(8);
                    $order = 'desc';
                }
                $option = 'municipality';
                return view('tourist.tour_operator.index', compact('tour_operators','rand1','rand2','rand3', 'notifications','unread', 'option', 'order','owner'));
            }
        }else{
            $empty = 1;
            return view('tourist.tour_operator.index', compact('empty'));
        }
    }
}
