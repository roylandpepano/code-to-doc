<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationPackage;
use App\Models\TourOperator;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
//Visitor Counter
        if(!Visitor::where('visitor',session()->getId())->where('page_name','index')->exists()) {
            Visitor::create([
                'visitor' => session()->getId(),
                'page_name' => 'index'
            ]);
        }
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
            ->orderBy('updated_at', 'DESC')
            ->limit(3)
            ->get();

        // Lowest Package
        $lowestPackages = DestinationPackage::select('destination_packages.destination_id', DB::raw("MIN(CAST(SUBSTRING(destination_packages.dest_pkg_min_fee, 5, LENGTH(destination_packages.dest_pkg_min_fee)) AS INT)) as FEE"))
            ->groupBy('destination_id')
            ->get();

        return view('index', compact('destinations', 'lowestPackages', 'tour_operators', 'famousTop', 'hiddenGem'));
    }
}
