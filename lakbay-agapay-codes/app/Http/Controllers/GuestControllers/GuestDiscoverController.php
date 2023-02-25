<?php

namespace App\Http\Controllers\GuestControllers;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationActivity;
use App\Models\DestinationAmenity;
use App\Models\DestinationImage;
use App\Models\DestinationPackage;
use App\Models\DestinationRating;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuestDiscoverController extends Controller
{
    public function index(){
        $queryDest = ['dest_approval' => 'Approved'];
        $destinations = Destination::where($queryDest)->orderBy('updated_at', 'DESC')->paginate(8);
        $categories = Destination::where($queryDest)
            ->distinct()
            ->orderBy('dest_category', 'ASC')
            ->get(['dest_category']);

        $option = '';
        $order = '';

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

        return view('guest.discover.index', compact('destinations','lowestPackages', 'rand1','rand2','rand3', 'categories', 'option', 'order'));
    }

    public function show(Request $request, $id)
    {
        $dest_images = DestinationImage::where('destination_id',$id)->get();
        $locations = Destination::where('dest_latitude','!=',null)->get();
        $discover_item = Destination::find($id);
        //Visitor Counter
        if(!Visitor::where('visitor',session()->getId())->where('page_name',$discover_item->dest_name)->exists()) {
            Visitor::create([
                'visitor' => session()->getId(),
                'destination_id' => $id,
                'page_name' => $discover_item->dest_name
            ]);
        }
        $i = 1;
        $j = 1;
        $k = 1;
        $packages = DestinationPackage::where('destination_id', $id)->orderBy('dest_pkg_name')->paginate(3, ['*'], 'packages');
        $activities = DestinationActivity::where('destination_id', $id)->get();
        $amenities = DestinationAmenity::where('destination_id', $id)->get();

        $rate_one = DestinationRating::where('destination_id', $id)->where('rating_rate', 1)->get();
        $rate_two = DestinationRating::where('destination_id', $id)->where('rating_rate', 2)->get();
        $rate_three = DestinationRating::where('destination_id', $id)->where('rating_rate', 3)->get();
        $rate_four = DestinationRating::where('destination_id', $id)->where('rating_rate',4)->get();
        $rate_five = DestinationRating::where('destination_id', $id)->where('rating_rate', 5)->get();

        $count_one = $rate_one->count();
        $count_two = $rate_two->count();
        $count_three = $rate_three->count();
        $count_four = $rate_four->count();
        $count_five = $rate_five->count();
        $total = $count_one + $count_two + $count_three + $count_four + $count_five;

        if($total > 0) {
            $average = DestinationRating::where('destination_id', $id)->avg('rating_rate');
            $rate_average = round($average, 2);
            $rate_average = sprintf('%0.2f', $rate_average);
            $total = $count_one + $count_two + $count_three + $count_four + $count_five;
            $average_one = $count_one / $total * 100;
            $average_two = $count_two / $total * 100;
            $average_three = $count_three / $total * 100;
            $average_four = $count_four / $total * 100;
            $average_five = $count_five / $total * 100;
        }else{
            $average = 0;
            $rate_average = sprintf('%0.2f', $average);
            $total = 0;
            $average_one = 0;
            $average_two = 0;
            $average_three = 0;
            $average_four = 0;
            $average_five = 0;
        }

        $rate = DestinationRating::where('destination_id', $id)->orderBy('created_at', 'desc')->paginate(3, ['*'], 'rate');
        $user_id = Auth::id();
        $findReview = DestinationRating::where(['user_id' => $user_id, 'destination_id' => $id])->get();
        $findReview = count($findReview);

        // Show Nearby Places
        $city = Destination::select('dest_city')
            ->where('destinations.id', $id)
            ->first();
        $nearby = Destination::where('dest_approval', 'Approved')
            ->where('dest_city', $city->dest_city)
            ->where('destinations.id', '!=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

        // Lowest Package
        $lowestPackages = DestinationPackage::select('destination_packages.destination_id', DB::raw("MIN(CAST(SUBSTRING(destination_packages.dest_pkg_min_fee, 5, LENGTH(destination_packages.dest_pkg_min_fee)) AS INT)) as FEE"))
            ->groupBy('destination_id')
            ->get();

        if($request->ajax()) {
            $rate = DestinationRating::where('destination_id', $id)->orderBy('created_at', 'desc')->paginate(3, ['*'], 'rate');

            if (request('id') == 0) {
                return view('reviews_pagination', compact('discover_item', 'lowestPackages', 'dest_images', 'nearby', 'packages', 'i', 'j', 'k', 'activities', 'amenities', 'locations', 'rate', 'rate_one', 'rate_two', 'rate_three',
                    'rate_four', 'rate_five', 'count_one', 'count_two', 'count_three', 'count_four', 'count_five', 'total', 'average', 'rate_average', 'average_one', 'average_two', 'average_three',
                    'average_four', 'average_five', 'rate', 'findReview'))->render();
            }
            if (request('id') == 1) {
                return view('dest_packages', compact('discover_item', 'lowestPackages', 'dest_images', 'nearby', 'packages', 'i', 'j', 'k', 'activities', 'amenities', 'locations', 'rate', 'rate_one', 'rate_two', 'rate_three',
                    'rate_four', 'rate_five', 'count_one', 'count_two', 'count_three', 'count_four', 'count_five', 'total', 'average', 'rate_average', 'average_one', 'average_two', 'average_three',
                    'average_four', 'average_five', 'rate', 'findReview'))->render();
            }
        }

        return view('guest.discover.show', compact('discover_item','lowestPackages', 'dest_images','nearby', 'packages','i','j','k','activities','amenities','locations', 'rate', 'rate_one', 'rate_two', 'rate_three',
            'rate_four', 'rate_five', 'count_one', 'count_two', 'count_three', 'count_four', 'count_five', 'total','average','rate_average', 'average_one', 'average_two', 'average_three', 'average_four', 'average_five', 'rate', 'findReview'));
    }
}
