<?php

namespace App\Http\Controllers;


use App\Charts\UserChart;
use App\Helper\helper;
use App\Models\Destination;
use App\Models\FavoriteDestination;
use App\Models\FavoriteTourOperator;
use App\Models\TourOperator;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index(){
        $owner = helper::owner();
        $notifications = helper::touristNotifications();
        $unread = $notifications->where('notif_read',0);

//        // Most Loved Destinations
//        $destResults = FavoriteDestination::join('destinations', 'favorite_destinations.destination_id', '=', 'destinations.id')
//            ->select('destinations.id', 'destinations.dest_main_picture', 'destinations.dest_name', DB::raw('COUNT(favorite_destinations.destination_id) as Points'))
//            ->groupBy('destinations.id', 'destinations.dest_name', 'destinations.dest_main_picture')
//            ->orderBy('Points', 'desc')
//            ->limit(15)
//            ->get();
//
//        // Top Contributors
//        $contResults = User::join('destinations', 'users.id', '=', 'destinations.user_id')
//            ->select('users.id', 'users.user_picture', 'users.user_username',  DB::raw('COUNT(destinations.user_id) as Points'))
//            ->where('dest_approval', 'Approved')
//            ->groupBy('users.id', 'users.user_username', 'users.user_picture')
//            ->orderBy('Points', 'desc')
//            ->limit(15)
//            ->get();
//
//        // Most Favored Tour Operators
//        $tourResults = FavoriteTourOperator::join('tour_operators', 'favorite_tour_operators.tour_operator_id', '=', 'tour_operators.id')
//            ->select('tour_operators.id', 'tour_operators.operator_main_picture', 'tour_operators.operator_company',  DB::raw('COUNT(favorite_tour_operators.tour_operator_id) as Points'))
//            ->groupBy('tour_operators.id', 'tour_operators.operator_company', 'tour_operators.operator_main_picture')
//            ->orderBy('Points', 'desc')
//            ->limit(15)
//            ->get();

//        ============================================= GRAPHS


//        Line Graph
        $yearNow = Carbon::now()->format('Y');
        $janCountNow = Visitor::whereMonth('created_at', 1)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $febCountNow = Visitor::whereMonth('created_at', 2)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $marCountNow = Visitor::whereMonth('created_at', 3)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $aprCountNow = Visitor::whereMonth('created_at', 4)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $mayCountNow = Visitor::whereMonth('created_at', 5)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $junCountNow = Visitor::whereMonth('created_at', 6)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $julCountNow = Visitor::whereMonth('created_at', 7)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $augCountNow = Visitor::whereMonth('created_at', 8)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $sepCountNow = Visitor::whereMonth('created_at', 9)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $octCountNow = Visitor::whereMonth('created_at', 10)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $novCountNow = Visitor::whereMonth('created_at', 11)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $decCountNow = Visitor::whereMonth('created_at', 12)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
//        Previous Year
        $janCountPrev = Visitor::whereMonth('created_at', 1)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $febCountPrev = Visitor::whereMonth('created_at', 2)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $marCountPrev = Visitor::whereMonth('created_at', 3)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $aprCountPrev = Visitor::whereMonth('created_at', 4)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $mayCountPrev = Visitor::whereMonth('created_at', 5)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $junCountPrev = Visitor::whereMonth('created_at', 6)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $julCountPrev = Visitor::whereMonth('created_at', 7)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $augCountPrev = Visitor::whereMonth('created_at', 8)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $sepCountPrev = Visitor::whereMonth('created_at', 9)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $octCountPrev = Visitor::whereMonth('created_at', 10)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $novCountPrev = Visitor::whereMonth('created_at', 11)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $decCountPrev = Visitor::whereMonth('created_at', 12)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $usersChart = new UserChart;
        $usersChart->labels(['Jan', 'Feb', 'Mar','Apr','May', 'Jun', 'Jul','Aug','Sept','Oct','Nov','Dec']);
        $usersChart->dataset('Visitors This Year', 'line', [$janCountNow, $febCountNow, $marCountNow,$aprCountNow,$mayCountNow,$junCountNow,$julCountNow, $augCountNow, $sepCountNow,$octCountNow,$novCountNow,$decCountNow])
            ->color('rgba(34,198,246, 1)')
            ->backgroundcolor("rgba(34,198,246, 0.2)")
//            ->fill(false)
            ->lineTension(.2);
        $usersChart->dataset('Visitors Last Year', 'line', [$janCountPrev, $febCountPrev, $marCountPrev,$aprCountPrev,$mayCountPrev,$junCountPrev,$julCountPrev, $augCountPrev, $sepCountPrev,$octCountPrev,$novCountPrev,$decCountPrev])
            ->color('rgba(255, 99, 132, 1.0)')
            ->backgroundcolor("rgba(255, 99, 132, 0.2)")
//            ->fill(false)
            ->lineTension(.2);
//      Horizontal Bar Graph - Most Viewed Destination
        $usersChart3 = new UserChart;
        $usersChart5 = new UserChart;
        $usersChart6 = new UserChart;
        $usersChart7 = new UserChart;
        $usersChart8 = new UserChart;
        $usersChart9 = new UserChart;
        $usersChart10 = new UserChart;

        $getDestinationViews = Visitor::join("destinations", "destinations.id", "=", "destination_id")
            ->groupBy('destination_id', 'dest_name')->orderBy(DB::raw('COUNT(destination_id)'), 'desc')->limit(10)
            ->get(array(DB::raw('COUNT(destination_id) as total_views'), 'dest_name'));
        $getOperatorViews = Visitor::join("tour_operators", "tour_operators.id", "=", "tour_operator_id")
            ->groupBy('tour_operator_id','operator_company')->orderBy(DB::raw('COUNT(tour_operator_id)'), 'desc')->limit(10)
            ->get(array(DB::raw('COUNT(tour_operator_id) as total_views'),'operator_company'));
        $topRatedDestinations = Destination::join('destination_ratings', 'destinations.id', '=', 'destination_ratings.destination_id')
            ->select('destinations.*', 'destination_ratings.*')
            ->where('dest_approval', '=', 'Approved')
            ->orderBy('rating_rate', 'DESC')
            ->get();
        $topRatedOperators = TourOperator::join('tour_operator_ratings', 'tour_operators.id', '=', 'tour_operator_ratings.tour_operator_id')
            ->select('tour_operators.*', 'tour_operator_ratings.*')
            ->where('operator_approval', '=', 'Approved')
            ->orderBy('rating_rate', 'DESC')
            ->get();

//      Horizontal Bar Graph - Most Viewed Destinations
        $topDestinations = [];
        $topDestinationsViews = [];
        foreach ($getDestinationViews as $views) {
            $topDestinations[] = $views->dest_name;
            $topDestinationsViews[] = $views->total_views;
        }
        $topDestinationsViews[] = 0;
        $usersChart3->labels($topDestinations);
        $usersChart3->dataset('Views', 'horizontalBar', $topDestinationsViews)
            ->color('rgba(34,198,246, 1)')
            ->backgroundcolor('rgba(34,198,246, 0.5)');
//      Horizontal Bar Graph - Most Viewed Tour Operators
        $topOperators = [];
        $topOperatorsViews = [];
        foreach ($getOperatorViews as $views){
            $topOperators[] = $views->operator_company;
            $topOperatorsViews[] = $views->total_views;
        }
        $topOperatorsViews[] = 0;
        $usersChart5->labels($topOperators);
        $usersChart5->dataset('Views', 'horizontalBar', $topOperatorsViews)
            ->color('rgba(34,198,246, 1)')
            ->backgroundcolor('rgba(34,198,246, 0.5)');
//      Bar Graph - Top Rated Destination
        $dest = [];
        $avg = [];
        $arr_rate = [];
        foreach ($topRatedDestinations as $topRatedDestination ){
            $dest[] = $topRatedDestination->dest_name;
            $avg[] = $topRatedDestination->rate->avg('rating_rate');
        }
//        insert to multidimensional array for duplicate removal
        for($i=0; $i<$topRatedDestinations->count(); $i++){
            for($j=0; $j<2; $j++){
                if ($j == 0)
                    $arr_rate[$i][$j] = $dest[$i];
                else if ($j == 1)
                    $arr_rate[$i][$j] = $avg[$i];
            }
        }
        $unique_rating = array_map("unserialize", array_unique(array_map("serialize", $arr_rate)));

        $usersChart6->labels(array_column($unique_rating, 0));
        $usersChart6->dataset('Rating', 'bar', array_column($unique_rating, 1))
            ->color('rgba(255, 205, 86, 1.0)')
            ->backgroundcolor('rgba(255, 205, 86, 0.5)');
//      Bar Graph - Top Rated Tour Operator
        $operator = [];
        $avg = [];
        $arr_rate = [];
        foreach ($topRatedOperators as $topRatedOperator ){
            $operator[] = $topRatedOperator->operator_company;
            $avg[] = $topRatedOperator->rate->avg('rating_rate');
        }
//        insert to multidimensional array for duplicate removal
        for($i=0; $i<$topRatedOperators->count(); $i++){
            for($j=0; $j<2; $j++){
                if ($j == 0)
                    $arr_rate[$i][$j] = $operator[$i];
                else if ($j == 1)
                    $arr_rate[$i][$j] = $avg[$i];
            }
        }
        $unique_rating = array_map("unserialize", array_unique(array_map("serialize", $arr_rate)));

        $usersChart7->labels(array_column($unique_rating, 0));
        $usersChart7->dataset('Rating', 'bar', array_column($unique_rating, 1))
            ->color('rgba(255, 205, 86, 1.0)')
            ->backgroundcolor('rgba(255, 205, 86, 0.5)');

//  Leaderboards

        // Top Contributors - Destination Table
//        $dResults = User::join('destinations', 'users.id', '=', 'destinations.user_id')
//            ->select('users.id as DID', 'users.user_fname', 'users.user_lname',  DB::raw('COUNT(destinations.user_id) as DPoints'))
//            ->where('dest_approval', 'Approved')
//            ->groupBy('users.id', 'users.user_fname', 'users.user_lname')
//            ->orderBy('DPoints', 'desc')
//            ->get();

//        dd($dResults);

        // Top Contributors - Edit Destination Table
//        $eResults = User::join('edit_destination_details', 'users.id', '=', 'edit_destination_details.user_id')
//            ->select('users.id EID', 'users.user_fname', 'users.user_lname', DB::raw('COUNT(edit_destination_details.user_id) as EPoints'))
//            ->where('edit_dest_approval', 'Approved')
//            ->groupBy('users.id', 'users.user_fname', 'users.user_lname')
//            ->orderBy('EPoints', 'desc')
//            ->get();

//        dd($eResults);

        // Top Contributors
        $contResults = DB::select("SELECT users.id, users.user_fname, users.user_lname, sum(points) as points
                            FROM ((SELECT users.id, users.user_fname, users.user_lname, COUNT(user_id) as points FROM destinations
                                   INNER JOIN users ON users.id = destinations.user_id
                                   WHERE dest_approval = 'Approved'
                                   GROUP BY users.id, users.user_fname, users.user_lname)
                            UNION ALL (SELECT users.id, users.user_fname, users.user_lname, COUNT(user_id) as points FROM edit_destination_details
                                       INNER JOIN users ON users.id = edit_destination_details.user_id
                                       WHERE edit_dest_approval = 'Approved'
                                       GROUP BY users.id, users.user_fname, users.user_lname)) users
                            GROUP BY users.id, users.user_fname, users.user_lname
                            ORDER BY points DESC LIMIT 10");

        // Most Loved Destinations
        $destResults = FavoriteDestination::join('destinations', 'favorite_destinations.destination_id', '=', 'destinations.id')
            ->select('destinations.id', 'destinations.dest_name', DB::raw('COUNT(favorite_destinations.destination_id) as Points'))
            ->groupBy('destinations.id', 'destinations.dest_name')
            ->orderBy('Points', 'desc')
            ->limit(10)
            ->get();

        // Most Favored Tour Operators
        $tourResults = FavoriteTourOperator::join('tour_operators', 'favorite_tour_operators.tour_operator_id', '=', 'tour_operators.id')
            ->select('tour_operators.id', 'tour_operators.operator_company',  DB::raw('COUNT(favorite_tour_operators.tour_operator_id) as Points'))
            ->groupBy('tour_operators.id', 'tour_operators.operator_company')
            ->orderBy('Points', 'desc')
            ->limit(10)
            ->get();


//      Horizontal Bar Graph - Contributors
        $contributor = [];
        $contributorPoints = [];
        foreach ($contResults as $result) {
            $contributor[] = $result->user_fname." ".$result->user_lname;
            $contributorPoints[] = $result->points;
        }
        $contributorPoints[] = 0;
        $usersChart8->labels($contributor);
        $usersChart8->dataset('Contributions', 'horizontalBar', $contributorPoints)
            ->color('rgba(22,160,133, 1.0)')
            ->backgroundcolor('rgba(22,160,133, 0.5)');
//      Horizontal Bar Graph - Favorite Destination
        $favDestination = [];
        $favDestinationPoints = [];
        foreach ($destResults as $result) {
            $favDestination[] = $result->dest_name;
            $favDestinationPoints[] = $result->Points;
        }
        $favDestinationPoints[] = 0;
        $usersChart9->labels($favDestination);
        $usersChart9->dataset('Hearts', 'horizontalBar', $favDestinationPoints)
            ->color('rgba(255, 99, 132, 1.0)')
            ->backgroundcolor('rgba(255, 99, 132, 0.5)');
//      Horizontal Bar Graph - Favorite Tour Operator
        $favOperator = [];
        $favOperatorPoints = [];
        foreach ($tourResults as $result) {
            $favOperator[] = $result->operator_company;
            $favOperatorPoints[] = $result->Points;
        }
        $favOperatorPoints[] = 0;
        $usersChart10->labels($favOperator);
        $usersChart10->dataset('Hearts', 'horizontalBar', $favOperatorPoints)
            ->color('rgba(255, 99, 132, 1.0)')
            ->backgroundcolor('rgba(255, 99, 132, 0.5)');

        return view('tourist.leaderboard.index', compact( 'destResults', 'contResults', 'tourResults','notifications', 'unread', 'owner',
            'usersChart','usersChart3','usersChart5','usersChart6','usersChart7','usersChart8','usersChart9','usersChart10','destResults','contResults','tourResults'));
//        return view('tourist.leaderboard.index', compact('destResults', 'contResults', 'tourResults', 'owner', 'notifications', 'unread'));,
//            'most_viewed_destination_from','most_viewed_destination_to','most_viewed_operator_from','most_viewed_operator_to',
//            'top_rated_destination_from','top_rated_destination_to','top_rated_operator_from','top_rated_operator_to'
    }
}
