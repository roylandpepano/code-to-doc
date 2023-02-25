<?php

namespace App\Http\Controllers\AdminControllers;

use App\Helper\helper;
use App\Charts\UserChart;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveDestinationRequest ;
use App\Http\Requests\ApproveTourOperatorRequest;
use App\Http\Requests\CreateDestinationRequest;
use App\Models\ActivityLogs;
use App\Models\Destination;
use App\Models\DestinationActivity;
use App\Models\DestinationAmenity;
use App\Models\DestinationImage;
use App\Models\DestinationPackage;
use App\Models\DestinationRating;
use App\Models\EditDestination;
use App\Models\FavoriteDestination;
use App\Models\FavoriteTourOperator;
use App\Models\Notification;
use App\Models\Package;
use App\Models\TourOperator;
use App\Models\TourOperatorImage;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isEmpty;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index(Request $request){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);

        $userCount = DB::table('users')->count();
        $approvedCount = DB::table('destinations')
            ->where('dest_approval', '=', 'Approved')
            ->count();
        $pendingCount = DB::table('destinations')
            ->where('dest_approval', '=', 'Pending')
            ->count();
        $rejectedCount = DB::table('destinations')
            ->where('dest_approval', '=', 'Rejected')
            ->count();

//        $approvedCountOperator = DB::table('tour_operators')
//            ->where('operator_approval', '=', 'Approved')
//            ->count();
//        $pendingCountOperator = DB::table('tour_operators')
//            ->where('operator_approval', '=', 'Pending')
//            ->count();
//        $rejectedCountOperator = DB::table('tour_operators')
//            ->where('operator_approval', '=', 'Rejected')
//            ->count();

//        CHARTS
        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.5)",
            "rgba(22,160,133, 0.5)",
            "rgba(255, 205, 86, 0.5)",
            "rgba(51,105,232, 0.5)",
            "rgba(244,67,54, 0.5)",
            "rgba(34,198,246, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 159, 64, 0.5)",
            "rgba(233,30,99, 0.5)",
            "rgba(205,220,57, 0.5)"

        ];
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
////      Doughnut Graph
//        $usersChart2 = new UserChart;
//        $usersChart2->minimalist(true);
//        $usersChart2->labels(['Rejected', 'Approved', 'Pending']);
//        $usersChart2->dataset('Destinations', 'doughnut', [$rejectedCountOperator,$approvedCountOperator,$pendingCountOperator])
//            ->color($borderColors)
//            ->backgroundcolor($fillColors);
////      Doughnut Graph
//        $usersChart4 = new UserChart;
//        $usersChart4->minimalist(true);
//        $usersChart4->labels(['Rejected', 'Approved', 'Pending']);
//        $usersChart4->dataset('Tour Operators', 'doughnut', [$rejectedCount,$approvedCount,$pendingCount])
//            ->color($borderColors)
//            ->backgroundcolor($fillColors);
//      Horizontal Bar Graph - Most Viewed Destination
        $usersChart3 = new UserChart;
        $usersChart5 = new UserChart;
        $usersChart6 = new UserChart;
        $usersChart7 = new UserChart;
        $usersChart8 = new UserChart;
        $usersChart9 = new UserChart;
        $usersChart10 = new UserChart;
        $most_viewed_destination_from = $request->input('most_viewed_destination_from');
        $most_viewed_destination_to = $request->input('most_viewed_destination_to');
        $most_viewed_operator_from = $request->input('most_viewed_operator_from');
        $most_viewed_operator_to = $request->input('most_viewed_operator_to');
        $top_rated_destination_from = $request->input('top_rated_destination_from');
        $top_rated_destination_to = $request->input('top_rated_destination_to');
        $top_rated_operator_from = $request->input('top_rated_operator_from');
        $top_rated_operator_to = $request->input('top_rated_operator_to');
        $getDestinationViews = collect();
        $getOperatorViews = collect();
        $topRatedDestinations = collect();
        $topRatedOperators = collect();
        switch ($request->input('submit')) {
            case 'load':
                if(!($most_viewed_destination_from == "" && $most_viewed_destination_to == ""
                    && $most_viewed_operator_from == "" && $most_viewed_operator_to == ""
                    && $top_rated_destination_from == "" && $top_rated_destination_to == ""
                    && $top_rated_operator_from == "" && $top_rated_operator_to == "")){

                    if ($most_viewed_destination_from != "" && $most_viewed_destination_to != ""){
                        $getDestinationViews = Visitor::join("destinations", "destinations.id", "=", "destination_id")
                            ->whereDate('visitors.created_at', '>=', $most_viewed_destination_from)
                            ->whereDate('visitors.created_at', '<=', $most_viewed_destination_to)
                            ->groupBy('destination_id', 'dest_name')->orderBy(DB::raw('COUNT(destination_id)'), 'desc')->limit(10)
                            ->get(array(DB::raw('COUNT(destination_id) as total_views'), 'dest_name'));
                        $most_viewed_operator_to = "";
                    }
                    if ($most_viewed_operator_from != "" && $most_viewed_operator_to != ""){
                        $getOperatorViews = Visitor::join("tour_operators", "tour_operators.id", "=", "tour_operator_id")
                            ->whereDate('visitors.created_at', '>=', $most_viewed_operator_from)
                            ->whereDate('visitors.created_at', '<=', $most_viewed_operator_to)
                            ->groupBy('tour_operator_id','operator_company')->orderBy(DB::raw('COUNT(tour_operator_id)'), 'desc')->limit(10)
                            ->get(array(DB::raw('COUNT(tour_operator_id) as total_views'),'operator_company'));
                    }
                    if ($top_rated_destination_from != "" && $top_rated_destination_to != ""){
                        $topRatedDestinations = Destination::join('destination_ratings', 'destinations.id', '=', 'destination_ratings.destination_id')
                            ->select('destinations.*', 'destination_ratings.*')
                            ->whereDate('destination_ratings.created_at', '>=', $top_rated_destination_from)
                            ->whereDate('destination_ratings.created_at', '<=', $top_rated_destination_to)
                            ->where('dest_approval', '=', 'Approved')
                            ->orderBy('rating_rate', 'DESC')
                            ->get();
                    }
                    if ($top_rated_operator_from != "" && $top_rated_operator_to != ""){
                        $topRatedOperators = TourOperator::join('tour_operator_ratings', 'tour_operators.id', '=', 'tour_operator_ratings.tour_operator_id')
                            ->select('tour_operators.*', 'tour_operator_ratings.*')
                            ->whereDate('tour_operator_ratings.created_at', '>=', $top_rated_operator_from)
                            ->whereDate('tour_operator_ratings.created_at', '<=', $top_rated_operator_to)
                            ->where('operator_approval', '=', 'Approved')
                            ->orderBy('rating_rate', 'DESC')
                            ->get();
                    }
                    if ($most_viewed_destination_from == "" || $most_viewed_destination_to == ""){
                        $getDestinationViews = Visitor::join("destinations", "destinations.id", "=", "destination_id")
                            ->groupBy('destination_id', 'dest_name')->orderBy(DB::raw('COUNT(destination_id)'), 'desc')->limit(10)
                            ->get(array(DB::raw('COUNT(destination_id) as total_views'), 'dest_name'));
                        $most_viewed_destination_from = "";
                        $most_viewed_destination_to = "";
                    }
                    if ($most_viewed_operator_from == "" || $most_viewed_operator_to == ""){
                        $getOperatorViews = Visitor::join("tour_operators", "tour_operators.id", "=", "tour_operator_id")
                            ->groupBy('tour_operator_id','operator_company')->orderBy(DB::raw('COUNT(tour_operator_id)'), 'desc')->limit(10)
                            ->get(array(DB::raw('COUNT(tour_operator_id) as total_views'),'operator_company'));
                        $most_viewed_operator_from = "";
                        $most_viewed_operator_to = "";
                    }
                    if ($top_rated_destination_from == "" || $top_rated_destination_to == ""){
                        $topRatedDestinations = Destination::join('destination_ratings', 'destinations.id', '=', 'destination_ratings.destination_id')
                            ->select('destinations.*', 'destination_ratings.*')
                            ->where('dest_approval', '=', 'Approved')
                            ->orderBy('rating_rate', 'DESC')
                            ->get();
                        $top_rated_destination_from = "";
                        $top_rated_destination_to = "";
                    }
                    if ($top_rated_operator_from == "" || $top_rated_operator_to == ""){
                        $topRatedOperators = TourOperator::join('tour_operator_ratings', 'tour_operators.id', '=', 'tour_operator_ratings.tour_operator_id')
                            ->select('tour_operators.*', 'tour_operator_ratings.*')
                            ->where('operator_approval', '=', 'Approved')
                            ->orderBy('rating_rate', 'DESC')
                            ->get();
                        $top_rated_operator_from = "";
                        $top_rated_operator_to = "";
                    }
                    break;
                }else{
                    goto all_time_label;
                }
            case 'all_time':
                all_time_label:
                $getDestinationViews = Visitor::join("destinations", "destinations.id", "=", "destination_id")
                    ->groupBy('destination_id', 'dest_name')->orderBy(DB::raw('COUNT(destination_id)'), 'desc')->limit(10)
                    ->get(array(DB::raw('COUNT(destination_id) as total_views'), 'dest_name'));
                $most_viewed_destination_from = "";
                $most_viewed_destination_to = "";
                $getOperatorViews = Visitor::join("tour_operators", "tour_operators.id", "=", "tour_operator_id")
                    ->groupBy('tour_operator_id','operator_company')->orderBy(DB::raw('COUNT(tour_operator_id)'), 'desc')->limit(10)
                    ->get(array(DB::raw('COUNT(tour_operator_id) as total_views'),'operator_company'));
                $most_viewed_operator_from = "";
                $most_viewed_operator_to = "";
                $topRatedDestinations = Destination::join('destination_ratings', 'destinations.id', '=', 'destination_ratings.destination_id')
                    ->select('destinations.*', 'destination_ratings.*')
                    ->where('dest_approval', '=', 'Approved')
                    ->orderBy('rating_rate', 'DESC')
                    ->get();
                $top_rated_destination_from = "";
                $top_rated_destination_to = "";
                $topRatedOperators = TourOperator::join('tour_operator_ratings', 'tour_operators.id', '=', 'tour_operator_ratings.tour_operator_id')
                    ->select('tour_operators.*', 'tour_operator_ratings.*')
                    ->where('operator_approval', '=', 'Approved')
                    ->orderBy('rating_rate', 'DESC')
                    ->get();
                $top_rated_operator_from = "";
                $top_rated_operator_to = "";
                break;
            default:
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
                break;
        }
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

        // Top Contributors
//        $contResults = User::join('destinations', 'users.id', '=', 'destinations.user_id')
//            ->select('users.id', 'users.user_fname', 'users.user_lname',  DB::raw('COUNT(destinations.user_id) as Points'))
//            ->where('dest_approval', 'Approved')
//            ->groupBy('users.id', 'users.user_fname', 'users.user_lname')
//            ->orderBy('Points', 'desc')
//            ->limit(20)
//            ->get();
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
                            ORDER BY points DESC LIMIT 20");
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

        return view('admin.home', compact('userCount', 'approvedCount', 'pendingCount', 'rejectedCount', 'notifications', 'unread',
            'usersChart','usersChart3','usersChart5','usersChart6','usersChart7','usersChart8','usersChart9','usersChart10',
            'most_viewed_destination_from','most_viewed_destination_to','most_viewed_operator_from','most_viewed_operator_to',
            'top_rated_destination_from','top_rated_destination_to','top_rated_operator_from','top_rated_operator_to','destResults','contResults','tourResults'));
    }

// Generate Report
    public function createPDF(Request $request){

        $user = User::where('id',Auth::guard('web')->user()->id)->first();
        $date = Carbon::now()->format('F d, Y');
        $time = Carbon::now()->format('g:i A');
        $user_count = User::all();
        $yearNow = Carbon::now()->format('Y');
//        Current Year
        $cur_jan = Visitor::whereMonth('created_at', 1)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_feb = Visitor::whereMonth('created_at', 2)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_mar = Visitor::whereMonth('created_at', 3)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_apr = Visitor::whereMonth('created_at', 4)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_may = Visitor::whereMonth('created_at', 5)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_jun = Visitor::whereMonth('created_at', 6)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_jul = Visitor::whereMonth('created_at', 7)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_aug = Visitor::whereMonth('created_at', 8)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_sep = Visitor::whereMonth('created_at', 9)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_oct = Visitor::whereMonth('created_at', 10)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_nov = Visitor::whereMonth('created_at', 11)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_dec = Visitor::whereMonth('created_at', 12)->whereYear('created_at', $yearNow)->where('page_name','index')->count();
        $cur_total = $cur_dec+$cur_nov+$cur_oct+$cur_sep+$cur_aug+$cur_jul+$cur_jun+$cur_may+$cur_apr+$cur_mar+$cur_feb+$cur_jan;
//        Previous Year
        $last_jan = Visitor::whereMonth('created_at', 1)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_feb = Visitor::whereMonth('created_at', 2)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_mar = Visitor::whereMonth('created_at', 3)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_apr = Visitor::whereMonth('created_at', 4)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_may = Visitor::whereMonth('created_at', 5)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_jun = Visitor::whereMonth('created_at', 6)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_jul = Visitor::whereMonth('created_at', 7)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_aug = Visitor::whereMonth('created_at', 8)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_sep = Visitor::whereMonth('created_at', 9)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_oct = Visitor::whereMonth('created_at', 10)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_nov = Visitor::whereMonth('created_at', 11)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_dec = Visitor::whereMonth('created_at', 12)->whereYear('created_at', $yearNow-1)->where('page_name','index')->count();
        $last_total = $last_dec+$last_nov+$last_oct+$last_sep+$last_aug+$last_jul+$last_jun+$last_may+$last_apr+$last_mar+$last_feb+$last_jan;
//        Destination and Tour Operator Counts
        $dest_approved = Destination::where('dest_approval','Approved')->count();
        $dest_pending = Destination::where('dest_approval','Pending')->count();
        $dest_rejected = Destination::where('dest_approval','Rejected')->count();
        $to_approved = TourOperator::where('operator_approval','Approved')->count();
        $to_pending = TourOperator::where('operator_approval','Pending')->count();
        $to_rejected = TourOperator::where('operator_approval','Rejected')->count();
//        from and to
        $most_viewed_destination_from = "";
        $most_viewed_destination_to = "";
        $most_viewed_operator_from = "";
        $most_viewed_operator_to = "";
        $top_rated_destination_from = "";
        $top_rated_destination_to = "";
        $top_rated_operator_from = "";
        $top_rated_operator_to = "";
        if ($request->input('vdf'))
        $most_viewed_destination_from = Carbon::createFromFormat('Y-m-d',$request->input('vdf'))->format('F, d Y');
        if ($request->input('vdt'))
        $most_viewed_destination_to = Carbon::createFromFormat('Y-m-d',$request->input('vdt'))->format('F, d Y');
        if ($request->input('vtf'))
        $most_viewed_operator_from = Carbon::createFromFormat('Y-m-d',$request->input('vtf'))->format('F, d Y');
        if ($request->input('vtt'))
        $most_viewed_operator_to = Carbon::createFromFormat('Y-m-d',$request->input('vtt'))->format('F, d Y');
        if ($request->input('rdf'))
        $top_rated_destination_from = Carbon::createFromFormat('Y-m-d',$request->input('rdf'))->format('F, d Y');
        if ($request->input('rdt'))
        $top_rated_destination_to = Carbon::createFromFormat('Y-m-d',$request->input('rdt'))->format('F, d Y');
        if ($request->input('rtf'))
        $top_rated_operator_from = Carbon::createFromFormat('Y-m-d',$request->input('rtf'))->format('F, d Y');
        if ($request->input('rtt'))
        $top_rated_operator_to = Carbon::createFromFormat('Y-m-d',$request->input('rtt'))->format('F, d Y');
        $getDestinationViews = collect();
        $getOperatorViews = collect();
        $topRatedDestinations = collect();
        $topRatedOperators = collect();
        switch ($request->input('submit')) {
            case 'load':
                if(!($most_viewed_destination_from == "" && $most_viewed_destination_to == ""
                    && $most_viewed_operator_from == "" && $most_viewed_operator_to == ""
                    && $top_rated_destination_from == "" && $top_rated_destination_to == ""
                    && $top_rated_operator_from == "" && $top_rated_operator_to == "")){

                    if ($most_viewed_destination_from != "" && $most_viewed_destination_to != ""){
                        $getDestinationViews = Visitor::join("destinations", "destinations.id", "=", "destination_id")
                            ->whereDate('visitors.created_at', '>=', $most_viewed_destination_from)
                            ->whereDate('visitors.created_at', '<=', $most_viewed_destination_to)
                            ->groupBy('destination_id', 'dest_name')->orderBy(DB::raw('COUNT(destination_id)'), 'desc')->limit(10)
                            ->get(array(DB::raw('COUNT(destination_id) as total_views'), 'dest_name'));
                    }
                    if ($most_viewed_operator_from != "" && $most_viewed_operator_to != ""){
                        $getOperatorViews = Visitor::join("tour_operators", "tour_operators.id", "=", "tour_operator_id")
                            ->whereDate('visitors.created_at', '>=', $most_viewed_operator_from)
                            ->whereDate('visitors.created_at', '<=', $most_viewed_operator_to)
                            ->groupBy('tour_operator_id','operator_company')->orderBy(DB::raw('COUNT(tour_operator_id)'), 'desc')->limit(10)
                            ->get(array(DB::raw('COUNT(tour_operator_id) as total_views'),'operator_company'));
                    }
                    if ($top_rated_destination_from != "" && $top_rated_destination_to != ""){
                        $topRatedDestinations = Destination::join('destination_ratings', 'destinations.id', '=', 'destination_ratings.destination_id')
                            ->select('destinations.*', 'destination_ratings.*')
                            ->whereDate('destination_ratings.created_at', '>=', $top_rated_destination_from)
                            ->whereDate('destination_ratings.created_at', '<=', $top_rated_destination_to)
                            ->where('dest_approval', '=', 'Approved')
                            ->orderBy('rating_rate', 'DESC')
                            ->get();
                    }
                    if ($top_rated_operator_from != "" && $top_rated_operator_to != ""){
                        $topRatedOperators = TourOperator::join('tour_operator_ratings', 'tour_operators.id', '=', 'tour_operator_ratings.tour_operator_id')
                            ->select('tour_operators.*', 'tour_operator_ratings.*')
                            ->whereDate('tour_operator_ratings.created_at', '>=', $top_rated_operator_from)
                            ->whereDate('tour_operator_ratings.created_at', '<=', $top_rated_operator_to)
                            ->where('operator_approval', '=', 'Approved')
                            ->orderBy('rating_rate', 'DESC')
                            ->get();
                    }
                    if ($most_viewed_destination_from == "" || $most_viewed_destination_to == ""){
                        $getDestinationViews = Visitor::join("destinations", "destinations.id", "=", "destination_id")
                            ->groupBy('destination_id', 'dest_name')->orderBy(DB::raw('COUNT(destination_id)'), 'desc')->limit(10)
                            ->get(array(DB::raw('COUNT(destination_id) as total_views'), 'dest_name'));
                        $most_viewed_destination_from = "";
                        $most_viewed_destination_to = "";
                    }
                    if ($most_viewed_operator_from == "" || $most_viewed_operator_to == ""){
                        $getOperatorViews = Visitor::join("tour_operators", "tour_operators.id", "=", "tour_operator_id")
                            ->groupBy('tour_operator_id','operator_company')->orderBy(DB::raw('COUNT(tour_operator_id)'), 'desc')->limit(10)
                            ->get(array(DB::raw('COUNT(tour_operator_id) as total_views'),'operator_company'));
                        $most_viewed_operator_from = "";
                        $most_viewed_operator_to = "";
                    }
                    if ($top_rated_destination_from == "" || $top_rated_destination_to == ""){
                        $topRatedDestinations = Destination::join('destination_ratings', 'destinations.id', '=', 'destination_ratings.destination_id')
                            ->select('destinations.*', 'destination_ratings.*')
                            ->where('dest_approval', '=', 'Approved')
                            ->orderBy('rating_rate', 'DESC')
                            ->get();
                        $top_rated_destination_from = "";
                        $top_rated_destination_to = "";
                    }
                    if ($top_rated_operator_from == "" || $top_rated_operator_to == ""){
                        $topRatedOperators = TourOperator::join('tour_operator_ratings', 'tour_operators.id', '=', 'tour_operator_ratings.tour_operator_id')
                            ->select('tour_operators.*', 'tour_operator_ratings.*')
                            ->where('operator_approval', '=', 'Approved')
                            ->orderBy('rating_rate', 'DESC')
                            ->get();
                        $top_rated_operator_from = "";
                        $top_rated_operator_to = "";
                    }
                    break;
                }else{
                    goto all_time_label;
                }
            case 'all_time':
                all_time_label:
                $getDestinationViews = Visitor::join("destinations", "destinations.id", "=", "destination_id")
                    ->groupBy('destination_id', 'dest_name')->orderBy(DB::raw('COUNT(destination_id)'), 'desc')->limit(10)
                    ->get(array(DB::raw('COUNT(destination_id) as total_views'), 'dest_name'));
                $most_viewed_destination_from = "";
                $most_viewed_destination_to = "";
                $getOperatorViews = Visitor::join("tour_operators", "tour_operators.id", "=", "tour_operator_id")
                    ->groupBy('tour_operator_id','operator_company')->orderBy(DB::raw('COUNT(tour_operator_id)'), 'desc')->limit(10)
                    ->get(array(DB::raw('COUNT(tour_operator_id) as total_views'),'operator_company'));
                $most_viewed_operator_from = "";
                $most_viewed_operator_to = "";
                $topRatedDestinations = Destination::join('destination_ratings', 'destinations.id', '=', 'destination_ratings.destination_id')
                    ->select('destinations.*', 'destination_ratings.*')
                    ->where('dest_approval', '=', 'Approved')
                    ->orderBy('rating_rate', 'DESC')
                    ->get();
                $top_rated_destination_from = "";
                $top_rated_destination_to = "";
                $topRatedOperators = TourOperator::join('tour_operator_ratings', 'tour_operators.id', '=', 'tour_operator_ratings.tour_operator_id')
                    ->select('tour_operators.*', 'tour_operator_ratings.*')
                    ->where('operator_approval', '=', 'Approved')
                    ->orderBy('rating_rate', 'DESC')
                    ->get();
                $top_rated_operator_from = "";
                $top_rated_operator_to = "";
                break;
            default:
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
                break;
        }
//        Destination Most Viewed
        $topDestinations = [];
        $topDestinationsViews = [];
        foreach ($getDestinationViews as $views) {
            $topDestinations[] = $views->dest_name;
            $topDestinationsViews[] = $views->total_views;
        }
//        Tour Operator Most Viewed
        $topOperators = [];
        $topOperatorsViews = [];
        foreach ($getOperatorViews as $views){
            $topOperators[] = $views->operator_company;
            $topOperatorsViews[] = $views->total_views;
        }
//        Destination Top Rated
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
        $top_rated_destinations = array_map("unserialize", array_unique(array_map("serialize", $arr_rate)));
//        Tour Operator Top Rated
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
        $top_rated_operators = array_map("unserialize", array_unique(array_map("serialize", $arr_rate)));


//  Leaderboards

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
                            ORDER BY points DESC LIMIT 20");
        $contributors = json_decode(json_encode($contResults), true);
//        dd($contributors);
        // Most Loved Destinations
        $destResults = FavoriteDestination::join('destinations', 'favorite_destinations.destination_id', '=', 'destinations.id')
            ->select('destinations.id', 'destinations.dest_name', DB::raw('COUNT(favorite_destinations.destination_id) as Points'))
            ->groupBy('destinations.id', 'destinations.dest_name')
            ->orderBy('Points', 'desc')
            ->limit(10)
            ->get();
        $favDestinations = $destResults->toArray();

        // Most Favored Tour Operators
        $tourResults = FavoriteTourOperator::join('tour_operators', 'favorite_tour_operators.tour_operator_id', '=', 'tour_operators.id')
            ->select('tour_operators.id', 'tour_operators.operator_company',  DB::raw('COUNT(favorite_tour_operators.tour_operator_id) as Points'))
            ->groupBy('tour_operators.id', 'tour_operators.operator_company')
            ->orderBy('Points', 'desc')
            ->limit(10)
            ->get();
        $favOperators = $tourResults->toArray();

        $pdf = PDF::loadView('admin.report', compact('user','date','time','user_count',
            'cur_jan','cur_feb','cur_mar','cur_apr','cur_may','cur_jun','cur_jul','cur_aug','cur_sep','cur_oct','cur_nov','cur_dec','cur_total',
            'last_jan','last_feb','last_mar','last_apr','last_may','last_jun','last_jul','last_aug','last_sep','last_oct','last_nov','last_dec','last_total',
            'dest_approved','dest_pending','dest_rejected','to_approved','to_pending','to_rejected',
            'most_viewed_destination_from','most_viewed_destination_to','most_viewed_operator_from','most_viewed_operator_to',
            'top_rated_destination_from','top_rated_destination_to','top_rated_operator_from','top_rated_operator_to',
            'topDestinations','topDestinationsViews','topOperators','topOperatorsViews','top_rated_destinations','top_rated_operators',
            'contributors', 'favDestinations', 'favOperators'));
        return $pdf->download('Lakbay Agapay Report.pdf');
//        return view('admin.report', compact('user','date','time','user_count',
//            'cur_jan','cur_feb','cur_mar','cur_apr','cur_may','cur_jun','cur_jul','cur_aug','cur_sep','cur_oct','cur_nov','cur_dec','cur_total',
//            'last_jan','last_feb','last_mar','last_apr','last_may','last_jun','last_jul','last_aug','last_sep','last_oct','last_nov','last_dec','last_total',
//            'dest_approved','dest_pending','dest_rejected','to_approved','to_pending','to_rejected',
//            'most_viewed_destination_from','most_viewed_destination_to','most_viewed_operator_from','most_viewed_operator_to',
//            'top_rated_destination_from','top_rated_destination_to','top_rated_operator_from','top_rated_operator_to',
//            'topDestinations','topDestinationsViews','topOperators','topOperatorsViews','top_rated_destinations','top_rated_operators',
//            'contributors', 'favDestinations', 'favOperators'
//        ));
    }
//   ----------------------------------------------------------------------------------------- SHOW USERS

    public function profile($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('id', '=', $id)->first();

        return view('admin.profile.show', compact('users','notifications','unread'));
    }

    public function users(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::orderBy('created_at','desc')->get();

        return view('admin.users.index', compact('users','notifications','unread'));
    }

    public function showUsers($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('id', '=', $id)->first();

        return view('admin.users.show', compact('users','notifications','unread'));
    }

    public function makeAdminUsers($id, Request $request){
        switch ($request->input('submit')) {
            case 'make':
                User::where('id', $id)->update([
                    'user_type' => 'Admin'
                ]);
                break;
            case 'remove':
                User::where('id', $id)->update([
                    'user_type' => 'Tourist'
                ]);
                break;
        }
        return redirect()->back();
    }

    public function touristUsers(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('user_type', '=', 'Tourist')->orderBy('created_at','desc')->get();

        return view('admin.users.tourist_user.index', compact('users','notifications','unread'));
    }

    public function showTouristUsers($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('id', '=', $id)->first();

        return view('admin.users.tourist_user.show', compact('users','notifications','unread'));
    }

    public function superAdminUsers(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('user_type', '=', 'Super Admin')->orderBy('created_at','desc')->get();

        return view('admin.users.super_admin_user.index', compact('users','notifications','unread'));
    }

    public function showSuperAdminUsers($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('id', '=', $id)->first();

        return view('admin.users.super_admin_user.show', compact('users','notifications','unread'));
    }

    public function adminUsers(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('user_type', '=', 'Admin')->orderBy('created_at','desc')->get();

        return view('admin.users.admin_user.index', compact('users','notifications','unread'));
    }

    public function showAdminUsers($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('id', '=', $id)->first();

        return view('admin.users.admin_user.show', compact('users','notifications','unread'));
    }

    public function tourOperatorUsers(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('user_type', '=', 'Tour Operator')->orderBy('created_at','desc')->get();

        return view('admin.users.tour_operator_user.index', compact('users','notifications','unread'));
    }

    public function showTourOperatorUsers($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $users = User::where('id', '=', $id)->first();

        return view('admin.users.tour_operator_user.show', compact('users','notifications','unread'));
    }

//   ------------------------------------------------------------------------------------------------------ SHOW NEW DESTINATIONS
    public function newDestinationRequest(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = Destination::leftJoin('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id', 'destinations.created_at as dest_created', 'destinations.updated_at as dest_updated')
            ->where('dest_approval', '=', 'Pending')
            ->orderBy('dest_updated', 'desc')
            ->get();

        return view('admin.requests.new_destination.index', compact('requests','notifications','unread'));
    }

    public function showNewDestinationRequest($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $request = Destination::join('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id')
            ->where('destinations.id', '=', $id)
            ->first();
        $images = Destination::join('destination_images', 'destinations.id', '=', 'destination_id')
            ->select('destination_images.*')
            ->where('destinations.id', '=', $id)
            ->get();
        $activities = Destination::join('destination_activities', 'id', '=', 'destination_id')
            ->select('destination_activities.*')
            ->where('id', '=', $id)
            ->get();
        $amenities = Destination::join('destination_amenities', 'id', '=', 'destination_id')
            ->select('destination_amenities.*')
            ->where('id', '=', $id)
            ->get();
        $packages = Destination::join('destination_packages', 'id', '=', 'destination_id')
            ->select('destination_packages.*')
            ->where('id', '=', $id)
            ->get();

//        dd($request);

        return view('admin.requests.new_destination.show', compact('request','images','activities','amenities','packages','notifications','unread'));
    }

    public function newDestinationRequestApproved(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = Destination::join('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id', 'destinations.created_at as dest_created', 'destinations.updated_at as dest_updated')
            ->where('dest_approval', '=', 'Approved')
            ->orderBy('dest_updated', 'desc')
            ->get();

        return view('admin.requests.new_destination.approved.index', compact('requests','notifications','unread'));
    }

    public function showNewDestinationRequestApproved($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $request = Destination::join('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id')
            ->where('destinations.id', '=', $id)
            ->first();
        $images = Destination::join('destination_images', 'destinations.id', '=', 'destination_id')
            ->select('destination_images.*')
            ->where('destinations.id', '=', $id)
            ->get();
        $activities = Destination::join('destination_activities', 'id', '=', 'destination_id')
            ->select('destination_activities.*')
            ->where('id', '=', $id)
            ->get();
        $amenities = Destination::join('destination_amenities', 'id', '=', 'destination_id')
            ->select('destination_amenities.*')
            ->where('id', '=', $id)
            ->get();
        $packages = Destination::join('destination_packages', 'id', '=', 'destination_id')
            ->select('destination_packages.*')
            ->where('id', '=', $id)
            ->get();

//        dd($request);

        return view('admin.requests.new_destination.approved.show', compact('request','images','activities','amenities','packages','notifications','unread'));
    }

    public function newDestinationRequestRejected(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = Destination::join('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id', 'destinations.created_at as dest_created', 'destinations.updated_at as dest_updated')
            ->where('dest_approval', '=', 'Rejected')
            ->orderBy('dest_updated', 'desc')
            ->get();

        return view('admin.requests.new_destination.rejected.index', compact('requests','notifications','unread'));
    }

    public function showNewDestinationRequestRejected($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $request = Destination::join('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id')
            ->where('destinations.id', '=', $id)
            ->first();
        $images = Destination::join('destination_images', 'destinations.id', '=', 'destination_id')
            ->select('destination_images.*')
            ->where('destinations.id', '=', $id)
            ->get();
        $activities = Destination::join('destination_activities', 'id', '=', 'destination_id')
            ->select('destination_activities.*')
            ->where('id', '=', $id)
            ->get();
        $amenities = Destination::join('destination_amenities', 'id', '=', 'destination_id')
            ->select('destination_amenities.*')
            ->where('id', '=', $id)
            ->get();
        $packages = Destination::join('destination_packages', 'id', '=', 'destination_id')
            ->select('destination_packages.*')
            ->where('id', '=', $id)
            ->get();

//        dd($request);

        return view('admin.requests.new_destination.rejected.show', compact('request','images','activities','amenities','packages','notifications','unread'));
    }

//    Approve or Reject Destinations

    public function approveNewDestinationRequest($id, ApproveDestinationRequest $request){
//        for multiple submit buttons in a form, use switch case
        switch ($request->input('submit')) {
            case 'approve':

//Hidden/Famous Radio Input
                if (($request->input('filter')) == 'hidden') {
                    $hidden_gem = 1;
                    $famous = 0;
                } else if(($request->input('filter')) == 'famous'){
                    $hidden_gem = 0;
                    $famous = 1;
                }else{
                    $hidden_gem = 0;
                    $famous = 0;
                }
//                IMAGE
//            Delete if removed and file is empty
                if (($request->input('hidden_input') == 'false') && (!$request->hasFile('image'))){
                    Destination::where('id', '=', $id)
                        ->update([
                            'dest_main_picture' => null
                        ]);
                }
//            Replace Image
                if($request->hasFile('image')){
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
//                Business Permit
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
//        UPDATE STATEMENTS
            Destination::where('id', '=', $id)
                ->update([
                    'dest_name' => $request->input('destination_name'),
                    'dest_operating' => $request->input('dest_operating'),
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
                    'hidden_gem' => $hidden_gem,
                    'famous' => $famous,
                    'dest_approval' => 'Approved',
                ]);


                // Some users delete their entries on the user side when updating, that's why, just fetch
                // the changes and insert it in Activities, Amenities, and Packages

                // Delete Previous Images
//                DestinationImage::where('destination_id', '=', $id)->delete();

                // Delete Previous Activities
                DestinationActivity::where('destination_id', '=', $id)->delete();

                // Delete Previous Amenity
                DestinationAmenity::where('destination_id', '=', $id)->delete();

                // Delete Previous Package
                DestinationPackage::where('destination_id', '=', $id)->delete();

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
//            update Activity
            if ($request->input('activity') != null){
                foreach($request->input('activity') as $key => $value) {
                    DestinationActivity::where('destination_id', '=', $id)
                        ->where('activity', $value)
                        ->update([
                            'activity_description' => $request->input('activity_description')[$key],
                            'activity_number_of_pax' => $request->input('activity_number_of_pax')[$key],
                            'activity_fee' => $request->input('activity_fee')[$key]
                        ]);
                }
            }
//            update Amenity
            if ($request->input('amenity') != null) {
                foreach ($request->input('amenity') as $key => $value) {
                    DestinationAmenity::where('destination_id', '=', $id)
                        ->where('amenity', $value)
                        ->update([
                            'amenity_description' => $request->input('amenity_description')[$key],
                            'amenity_fee' => $request->input('amenity_fee')[$key]
                        ]);
                }
            }
//            update Package
            if ($request->input('dest_pkg_name') != null) {
                foreach($request->input('dest_pkg_name') as $key => $value) {
                    DestinationPackage::where('destination_id', '=', $id)
                        ->where('dest_pkg_name', $value)
                        ->update([
                            'dest_pkg_description' => $request->input('dest_pkg_description')[$key],
                            'dest_pkg_min_fee' => $request->input('dest_pkg_min_fee')[$key],
                            'dest_pkg_rate' => $request->input('dest_pkg_rate')[$key],
                            'dest_pkg_inclusions' => $request->input('dest_pkg_inclusions')[$key]
                        ]);
                }
            }

//        INSERT STATEMENTS
            $activities_insert = DestinationActivity::where('destination_id','=',$id)->get('activity');

            if ($request->input('activity') != null) {
                foreach ($request->input('activity') as $key => $value) {
                    $checker = 'not found';
                    foreach ($activities_insert as $activity){
                        if ($value == $activity->activity){
                            $checker = 'found';
                            break;
                        }
                    }
                    if ($checker == 'not found' && $value != null) {
                        DestinationActivity::create([
                            'destination_id' => $id,
                            'activity' => $value,
                            'activity_description' => $request->input('activity_description')[$key],
                            'activity_number_of_pax' => $request->input('activity_number_of_pax')[$key],
                            'activity_fee' => $request->input('activity_fee')[$key]
                        ]);
                    }
                }
            }


            $amenities_insert = DestinationAmenity::where('destination_id','=',$id)->get('amenity');

            if ($request->input('amenity') != null) {
                foreach ($request->input('amenity') as $key => $value) {
                    $checker = 'not found';
                    foreach ($amenities_insert as $amenity){
                        if ($value == $amenity->amenity){
                            $checker = 'found';
                            break;
                        }
                    }
                    if ($checker == 'not found' && $value != null) {
                        DestinationAmenity::create([
                            'destination_id' => $id,
                            'amenity' => $value,
                            'amenity_description' => $request->input('amenity_description')[$key],
                            'amenity_fee' => $request->input('amenity_fee')[$key]
                        ]);
                    }
                }
            }


            $packages_insert = DestinationPackage::where('destination_id','=',$id)->get('dest_pkg_name');

            if ($request->input('dest_pkg_name') != null) {
                foreach ($request->input('dest_pkg_name') as $key => $value) {
                    $checker = 'not found';
                    foreach ($packages_insert as $package){
                        if ($value == $package->dest_pkg_name){
                            $checker = 'found';
                            break;
                        }
                    }
                    if ($checker == 'not found' && $value != null) {
                        DestinationPackage::create([
                            'destination_id' => $id,
                            'dest_pkg_name' => $value,
                            'dest_pkg_description' => $request->input('dest_pkg_description')[$key],
                            'dest_pkg_min_fee' => $request->input('dest_pkg_min_fee')[$key],
                            'dest_pkg_rate' => $request->input('dest_pkg_rate')[$key],
                            'dest_pkg_inclusions' => $request->input('dest_pkg_inclusions')[$key],
                        ]);
                    }
                }
            }

//            ADD APPROVE ACTION TO LOGS and NOTIFICATION

            $destination = Destination::join('users', 'destinations.user_id', '=', 'users.id')
                ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id')
                ->where('destinations.id', '=', $id)->first();
            $admin = User::where('id',Auth::guard('web')->user()->id)->first();

            ActivityLogs::create([
                'user_id' => Auth::guard('web')->user()->id,
                'destination_id' => $id,
                'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                    ' APPROVED a New Destination Request: "'.$destination->dest_name.
                    '" by '.$destination->user_type.' '.$destination->user_fname.' '.$destination->user_lname,
                'log_action' => 'Approve Destination',
            ]);

            Notification::create([
                'destination_id' => $id,
                'notif_type' => 'Message',
                'notif_message' => 'Your request "'.$destination->dest_name.'" has been approved. Thank you!',
                'notif_read' => false
            ]);


        return redirect()->route('admin.requests.new_destination.index')->with('approved','');

        case 'reject':

//            REJECT DESTINATION

                Destination::where('id', '=', $id)
                    ->update([
                        'dest_reasons' => $request->input('reason'),
                        'dest_approval' => 'Rejected'
                    ]);

                $destination = Destination::join('users', 'destinations.user_id', '=', 'users.id')
                    ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id')
                    ->where('destinations.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'destination_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' REJECTED a New Destination Request: "'.$destination->dest_name.
                        '" by '.$destination->user_type.' '.$destination->user_fname.' '.$destination->user_lname.' for the reason of "'.$destination->dest_reasons.'"',
                    'log_action' => 'Reject Destination',
                ]);

                Notification::create([
                    'destination_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your request "'.$destination->dest_name.'" has been Rejected for the reason of "'.$destination->dest_reasons.'" Thank you!',
                    'notif_read' => false
                ]);

        return redirect()->route('admin.requests.new_destination.index')->with('rejected','');

            case 'save':

//Hidden/Famous Radio Input
                if (($request->input('filter')) == 'hidden') {
                    $hidden_gem = 1;
                    $famous = 0;
                } else if(($request->input('filter')) == 'famous'){
                    $hidden_gem = 0;
                    $famous = 1;
                }else{
                    $hidden_gem = 0;
                    $famous = 0;
                }
//                IMAGE
//            Delete if removed and file is empty
                if (($request->input('hidden_input') == 'false') && (!$request->hasFile('image'))){
                    Destination::where('id', '=', $id)
                        ->update([
                            'dest_main_picture' => null
                        ]);
                }
//            Replace Image
                if($request->hasFile('image')){
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
//                Business Permit
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
//        UPDATE STATEMENTS
                $destinations = Destination::where('id', '=', $id)
                    ->update([
                        'dest_name' => $request->input('destination_name'),
                        'dest_operating' => $request->input('dest_operating'),
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
                        'hidden_gem' => $hidden_gem,
                        'famous' => $famous,
                        'dest_approval' => 'Approved',
                    ]);

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

                $counter = 0;
//            update Destination Images
                if ($request->file('images') != null) {
                    foreach ($request->file('images') as $imageFile) {
                        $counter++;
                        $fileName = $id . 'dest_image' . $counter . '.' . $imageFile->getClientOriginalExtension();
                        $imageFile->move(public_path('img/destination_images'), $fileName);
                        $fileName = "img/destination_images/" . $fileName;

                        $img = DestinationImage::where('dest_image', 'like', '%' . $id . 'dest_image' . $counter . '%')->first();
                        if ($img === null) {
                            DestinationImage::create([
                                'destination_id' => $id,
                                'dest_image' => $fileName
                            ]);
                        }
                    }
                }
//            update Activity
                if ($request->input('activity') != null){
                    foreach($request->input('activity') as $key => $value) {
                        DestinationActivity::where('destination_id', '=', $id)
                            ->where('activity', $value)
                            ->update([
                                'activity_description' => $request->input('activity_description')[$key],
                                'activity_number_of_pax' => $request->input('activity_number_of_pax')[$key],
                                'activity_fee' => $request->input('activity_fee')[$key]
                            ]);
                    }
                }
//            update Amenity
                if ($request->input('amenity') != null) {
                    foreach ($request->input('amenity') as $key => $value) {
                        DestinationAmenity::where('destination_id', '=', $id)
                            ->where('amenity', $value)
                            ->update([
                                'amenity_description' => $request->input('amenity_description')[$key],
                                'amenity_fee' => $request->input('amenity_fee')[$key]
                            ]);
                    }
                }
//            update Package
                if ($request->input('dest_pkg_name') != null) {
                    foreach($request->input('dest_pkg_name') as $key => $value) {
                        DestinationPackage::where('destination_id', '=', $id)
                            ->where('dest_pkg_name', $value)
                            ->update([
                                'dest_pkg_description' => $request->input('dest_pkg_description')[$key],
                                'dest_pkg_min_fee' => $request->input('dest_pkg_min_fee')[$key],
                                'dest_pkg_rate' => $request->input('dest_pkg_rate')[$key],
                                'dest_pkg_inclusions' => $request->input('dest_pkg_inclusions')[$key]
                            ]);
                    }
                }

//        INSERT STATEMENTS
                $activities_insert = DestinationActivity::where('destination_id','=',$id)->get('activity');

                if ($request->input('activity') != null) {
                    foreach ($request->input('activity') as $key => $value) {
                        $checker = 'not found';
                        foreach ($activities_insert as $activity){
                            if ($value == $activity->activity){
                                $checker = 'found';
                                break;
                            }
                        }
                        if ($checker == 'not found' && $value != null) {
                            DestinationActivity::create([
                                'destination_id' => $id,
                                'activity' => $value,
                                'activity_description' => $request->input('activity_description')[$key],
                                'activity_number_of_pax' => $request->input('activity_number_of_pax')[$key],
                                'activity_fee' => $request->input('activity_fee')[$key]
                            ]);
                        }
                    }
                }


                $amenities_insert = DestinationAmenity::where('destination_id','=',$id)->get('amenity');

                if ($request->input('amenity') != null) {
                    foreach ($request->input('amenity') as $key => $value) {
                        $checker = 'not found';
                        foreach ($amenities_insert as $amenity){
                            if ($value == $amenity->amenity){
                                $checker = 'found';
                                break;
                            }
                        }
                        if ($checker == 'not found' && $value != null) {
                            DestinationAmenity::create([
                                'destination_id' => $id,
                                'amenity' => $value,
                                'amenity_description' => $request->input('amenity_description')[$key],
                                'amenity_fee' => $request->input('amenity_fee')[$key]
                            ]);
                        }
                    }
                }


                $packages_insert = DestinationPackage::where('destination_id','=',$id)->get('dest_pkg_name');

                if ($request->input('dest_pkg_name') != null) {
                    foreach ($request->input('dest_pkg_name') as $key => $value) {
                        $checker = 'not found';
                        foreach ($packages_insert as $package){
                            if ($value == $package->dest_pkg_name){
                                $checker = 'found';
                                break;
                            }
                        }
                        if ($checker == 'not found' && $value != null) {
                            DestinationPackage::create([
                                'destination_id' => $id,
                                'dest_pkg_name' => $value,
                                'dest_pkg_description' => $request->input('dest_pkg_description')[$key],
                                'dest_pkg_min_fee' => $request->input('dest_pkg_min_fee')[$key],
                                'dest_pkg_rate' => $request->input('dest_pkg_rate')[$key],
                                'dest_pkg_inclusions' => $request->input('dest_pkg_inclusions')[$key],
                            ]);
                        }
                    }
                }

//            ADD EDIT ACTION TO LOGS and NOTIFICATION

                $destination = Destination::join('users', 'destinations.user_id', '=', 'users.id')
                    ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id')
                    ->where('destinations.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'destination_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' EDITED a Destination: "'.$destination->dest_name.
                        '" by '.$destination->user_type.' '.$destination->user_fname.' '.$destination->user_lname,
                    'log_action' => 'Edit Destination'
                ]);

                Notification::create([
                    'destination_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your added destination "'.$destination->dest_name.'" has been updated. Thank you!',
                    'notif_read' => false
                ]);


                return redirect()->route('admin.requests.new_destination.approved.index')->with('saved','');

            case 'remove':

//            REMOVE DESTINATION

                Destination::where('id', '=', $id)
                    ->update([
                        'dest_reasons' => $request->input('reason'),
                        'dest_approval' => 'Rejected'
                    ]);

                $destination = Destination::join('users', 'destinations.user_id', '=', 'users.id')
                    ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id')
                    ->where('destinations.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'destination_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' REMOVED a Destination: "'.$destination->dest_name.
                        '" by '.$destination->user_type.' '.$destination->user_fname.' '.$destination->user_lname.' for the reason of "'.$destination->dest_reasons.'"',
                    'log_action' => 'Remove Destination'
                ]);

                Notification::create([
                    'destination_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your added destination "'.$destination->dest_name.'" has been Removed for the reason of "'.$destination->dest_reasons.'" Thank you!',
                    'notif_read' => false
                ]);

                return redirect()->route('admin.requests.new_destination.index')->with('removed','');

            case 'restore':
//        UPDATE STATEMENTS
                Destination::where('id', '=', $id)
                    ->update([
                        'dest_approval' => 'Approved'
                    ]);
//            ADD RESTORE ACTION TO LOGS and NOTIFICATION

                $destination = Destination::join('users', 'destinations.user_id', '=', 'users.id')
                    ->select('destinations.*', 'users.*', 'destinations.id as dest_id', 'users.id as user_id')
                    ->where('destinations.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'destination_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' RESTORED a Destination: "'.$destination->dest_name.
                        '" by '.$destination->user_type.' '.$destination->user_fname.' '.$destination->user_lname,
                    'log_action' => 'Restore Destination'
                ]);

                Notification::create([
                    'destination_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your added destination "'.$destination->dest_name.'" has been restored. Thank you!',
                    'notif_read' => false
                ]);


                return redirect()->route('admin.requests.new_destination.index')->with('restored','');
        }
    }


    //  -------------------------------------------------------------------------------------------------------  SHOW EDIT DESTINATIONS
    public function editDestinationRequest(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = EditDestination::leftJoin('users', 'edit_destination_details.user_id', '=', 'users.id')
            ->select('edit_destination_details.*', 'users.*', 'edit_destination_details.created_at as edit_dest_created', 'edit_destination_details.updated_at as edit_dest_updated')
            ->where('edit_dest_approval', '=', 'Pending')
            ->orderBy('edit_dest_updated', 'desc')
            ->get();
        return view('admin.requests.edit_destination.index', compact('requests','notifications','unread'));
    }

    public function showEditDestinationRequest($id,$user){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $request = EditDestination::join('users', 'edit_destination_details.user_id', '=', 'users.id')
            ->select('edit_destination_details.*', 'users.*')
            ->where('destination_id', $id)
            ->where('user_id', $user)
            ->first();
        $destination = Destination::join('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*','destinations.id as dest_id', 'users.id as user_id')
            ->where('destinations.id', $id)
            ->first();

        return view('admin.requests.edit_destination.show', compact('request','destination','notifications','unread'));
    }

    public function editDestinationRequestApproved(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = EditDestination::leftJoin('users', 'edit_destination_details.user_id', '=', 'users.id')
            ->select('edit_destination_details.*', 'users.*', 'edit_destination_details.created_at as edit_dest_created', 'edit_destination_details.updated_at as edit_dest_updated')
            ->where('edit_dest_approval', '=', 'Approved')
            ->orderBy('edit_dest_updated', 'desc')
            ->get();

        return view('admin.requests.edit_destination.approved.index', compact('requests','notifications','unread'));
    }

    public function showEditDestinationRequestApproved($id,$user){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $request = EditDestination::join('users', 'edit_destination_details.user_id', '=', 'users.id')
            ->select('edit_destination_details.*', 'users.*')
            ->where('destination_id', $id)
            ->where('user_id', $user)
            ->first();
        $destination = Destination::join('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*','destinations.id as dest_id', 'users.id as user_id')
            ->where('destinations.id', $id)
            ->first();

        return view('admin.requests.edit_destination.approved.show', compact('request','destination','notifications','unread'));
    }

    public function editDestinationRequestRejected(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = EditDestination::leftJoin('users', 'edit_destination_details.user_id', '=', 'users.id')
            ->select('edit_destination_details.*', 'users.*', 'edit_destination_details.created_at as edit_dest_created', 'edit_destination_details.updated_at as edit_dest_updated')
            ->where('edit_dest_approval', '=', 'Rejected')
            ->orderBy('edit_dest_updated', 'desc')
            ->get();

        return view('admin.requests.edit_destination.rejected.index', compact('requests','notifications','unread'));
    }

    public function showEditDestinationRequestRejected($id,$user){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $request = EditDestination::join('users', 'edit_destination_details.user_id', '=', 'users.id')
            ->select('edit_destination_details.*', 'users.*')
            ->where('destination_id', $id)
            ->where('user_id', $user)
            ->first();
        $destination = Destination::join('users', 'destinations.user_id', '=', 'users.id')
            ->select('destinations.*', 'users.*','destinations.id as dest_id', 'users.id as user_id')
            ->where('destinations.id', $id)
            ->first();

        return view('admin.requests.edit_destination.rejected.show', compact('request','destination','notifications','unread'));
    }

//    Approve or Reject Destinations

    public function approveEditDestinationRequest($id,$user, ApproveDestinationRequest $request){

//        Original Destination Data
        $original_data = Destination::where('id', $id)->first();
        $suggested_data = EditDestination::where('destination_id', $id)->where('user_id',$user)->first();

        if (($request->input('dest_operating')) == 'no'){
            $dest_operating = 1;
        }else{
            $dest_operating = 0;
        }

        switch ($request->input('submit')) {
            case 'approve':
//        SWAP EDIT AND ORIGINAL DATA FOR RETRIEVAL
                //Put edit data on original destination table
                Destination::where('id', '=', $id)
                    ->update([
                        'dest_name' => $request->input('destination_name'),
                        'dest_operating' => $request->input('dest_operating'),
                        'dest_description' => $request->input('destination_description'),
                        'dest_date_opened' => $request->input('destination_date_opened'),
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
                    ]);
//        Destination Business Permit
                if ($request->input('business_permit') != null) {
                    Destination::where('id', $id)
                        ->update([
                            'dest_business_permit' => $request->input('business_permit'),
                            'dest_owner' => $user,
                        ]);
                }

                //Put original data on edit destination table
                EditDestination::where('destination_id', '=', $id)->where('user_id', $user)
                    ->update([
                        'dest_name' => $original_data->dest_name,
                        'dest_operating' => $original_data->dest_operating,
                        'dest_description' => $original_data->dest_description,
                        'dest_date_opened' => $original_data->dest_date_opened,
                        'dest_working_hours' => $original_data->dest_working_hours,
                        'dest_address' => $original_data->dest_address,
                        'dest_city' => $original_data->dest_city,
                        'dest_email' => $original_data->dest_email,
                        'dest_phone' => $original_data->dest_phone,
                        'dest_fb' => $original_data->dest_fb,
                        'dest_twt' => $original_data->dest_twt,
                        'dest_ig' => $original_data->dest_ig,
                        'dest_web' => $original_data->dest_web,
                        'dest_entrance_fee' => $original_data->dest_entrance_fee,
                        'dest_direction' => $original_data->dest_direction,
                        'dest_fare' => $original_data->dest_fare,
                        'dest_category' => $original_data->dest_category,
                        'edit_dest_approval' => 'Approved'
                    ]);
//        Destination Business Permit
                if ($request->hasFile('business_permit')) {
                    EditDestination::where('destination_id', $id)
                        ->where('user_id',$user)
                        ->update([
                            'dest_business_permit' => $original_data->dest_business_permit,
                            'dest_owner' => $original_data->dest_owner,
                        ]);
                }
//                else{
//                    EditDestination::where('destination_id', $id)
//                        ->where('user_id',$user)
//                        ->update([
//                            'dest_business_permit' => null,
//                            'dest_owner' => null,
//                        ]);
//                }

//            ADD APPROVE ACTION TO LOGS and NOTIFICATION
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();
                $user2 = User::where('id',$user)->first();
                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'destination_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' APPROVED an Edit Suggestion by '.$user2->user_type.' '.$user2->user_fname.' '.$user2->user_lname.'.',
                    'editor' => $user,
                    'log_action' => 'Approve Edit',
                ]);
                Notification::create([
                    'user_id' => $user,
                    'destination_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your edit suggestion on "'.$original_data->dest_name.'" has been approved. Thank you!',
                    'notif_read' => false
                ]);
                return redirect()->route('admin.requests.edit_destination.index')->with('approved', '');

            case 'reject':
                EditDestination::where('destination_id', '=', $id)->where('user_id', $user)
                    ->update([
                        'edit_dest_reasons' => $request->input('reason'),
                        'edit_dest_approval' => 'Rejected'
                    ]);

//            ADD APPROVE ACTION TO LOGS and NOTIFICATION
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();
                $user2 = User::where('id',$user)->first();
                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'destination_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' REJECTED an Edit Suggestion by '.$user2->user_type.' '.$user2->user_fname.' '.
                        $user2->user_lname.' on Destination: "'.$original_data->dest_name.' for the reason "'.$request->input("reason").'".',
                    'editor' => $user,
                    'log_action' => 'Reject Edit',
                ]);
                Notification::create([
                    'user_id' => $user,
                    'destination_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your edit suggestion on "'.$original_data->dest_name.'" has been rejected for the reason "'.$request->input('reason').'". Thank you!',
                    'notif_read' => false
                ]);
                return redirect()->route('admin.requests.edit_destination.index')->with('rejected', '');

            case 'restore':
                $request->validate([
                    'reason' => 'required'
                ]);
//        SWAP ORIGINAL AND EDIT DATA
                //Put original data to DESTINATION
                Destination::where('id', '=', $id)
                    ->update([
                        'dest_name' => $suggested_data->dest_name,
                        'dest_operating' => $suggested_data->dest_operating,
                        'dest_description' => $suggested_data->dest_description,
                        'dest_date_opened' => $suggested_data->dest_date_opened,
                        'dest_working_hours' => $suggested_data->dest_working_hours,
                        'dest_address' => $suggested_data->dest_address,
                        'dest_city' => $suggested_data->dest_city,
                        'dest_email' => $suggested_data->dest_email,
                        'dest_phone' => $suggested_data->dest_phone,
                        'dest_fb' => $suggested_data->dest_fb,
                        'dest_twt' => $suggested_data->dest_twt,
                        'dest_ig' => $suggested_data->dest_ig,
                        'dest_web' => $suggested_data->dest_web,
                        'dest_entrance_fee' => $suggested_data->dest_entrance_fee,
                        'dest_direction' => $suggested_data->dest_direction,
                        'dest_fare' => $suggested_data->dest_fare,
                        'dest_category' => $suggested_data->dest_category,
                    ]);
//        Destination Business Permit
                if ($request->input('business_permit') != null) {
                    Destination::where('id', $id)
                        ->update([
                            'dest_business_permit' => $suggested_data->dest_business_permit,
                            'dest_owner' => $suggested_data->dest_owner,
                        ]);
                }
//                else{
//                    Destination::where('id', $id)
//                        ->update([
//                            'dest_business_permit' => null,
//                            'dest_owner' => null,
//                        ]);
//                }

                //Put suggested data to EDIT DESTINATION DETAILS
                EditDestination::where('destination_id', '=', $id)->where('user_id', $user)
                    ->update([
                        'dest_name' => $original_data->dest_name,
                        'dest_operating' => $original_data->dest_operating,
                        'dest_description' => $original_data->dest_description,
                        'dest_date_opened' => $original_data->dest_date_opened,
                        'dest_working_hours' => $original_data->dest_working_hours,
                        'dest_address' => $original_data->dest_address,
                        'dest_city' => $original_data->dest_city,
                        'dest_email' => $original_data->dest_email,
                        'dest_phone' => $original_data->dest_phone,
                        'dest_fb' => $original_data->dest_fb,
                        'dest_twt' => $original_data->dest_twt,
                        'dest_ig' => $original_data->dest_ig,
                        'dest_web' => $original_data->dest_web,
                        'dest_entrance_fee' => $original_data->dest_entrance_fee,
                        'dest_direction' => $original_data->dest_direction,
                        'dest_fare' => $original_data->dest_fare,
                        'dest_category' => $original_data->dest_category,
                        'edit_dest_reasons' => $request->input('reason'),
                        'edit_dest_approval' => 'Rejected'
                    ]);
//        Destination Business Permit
                if ($original_data->dest_business_permit != null) {
                    EditDestination::where('destination_id', $id)
                        ->where('user_id',$user)
                        ->update([
                            'dest_business_permit' => $original_data->dest_business_permit,
                            'dest_owner' => $original_data->dest_owner,
                        ]);
                }
//                else{
//                    EditDestination::where('destination_id', $id)
//                        ->where('user_id',$user)
//                        ->update([
//                            'dest_business_permit' => null,
//                            'dest_owner' => null,
//                        ]);
//                }


//            ADD APPROVE ACTION TO LOGS and NOTIFICATION
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();
                $user2 = User::where('id',$user)->first();
                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'destination_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' RESTORED an Edit Suggestion by '.$user2->user_type.' '.$user2->user_fname.' '.$user2->user_lname.' for the reason of "'.$request->input('reason').'".',
                    'editor' => $user,
                    'log_action' => 'Restore Edit',
                ]);
                Notification::create([
                    'user_id' => $user,
                    'destination_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your edit suggestion on "'.$original_data->dest_name.'" has been reverted to the original data for the reason of "'.$request->input('reason').'". Thank you!',
                    'notif_read' => false
                ]);
                return redirect()->route('admin.requests.edit_destination.approved.index')->with('restored', '');

        }
    }


//   ------------------------------------------------------------------------------------------------------ SHOW NEW TOUR OPERATORS
    public function newTourOperatorRequest(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = TourOperator::leftJoin('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id', 'tour_operators.created_at as to_created', 'tour_operators.updated_at as to_updated')
            ->where('operator_approval', '=', 'Pending')
            ->orderBy('to_updated', 'desc')
            ->get();

        return view('admin.requests.new_tour_operator.index', compact('requests','notifications','unread'));
    }

    public function showNewTourOperatorRequest($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);

        $images = TourOperator::join('tour_operator_images', 'tour_operators.id', '=', 'tour_operator_id')
            ->select('tour_operator_images.*')
            ->where('tour_operators.id', '=', $id)
            ->get();
        $request = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id')
            ->where('tour_operators.id', '=', $id)
            ->first();
        $packages = TourOperator::join('packages', 'id', '=', 'tour_operator_id')
            ->select('packages.*')
            ->where('id', '=', $id)
            ->get();

        return view('admin.requests.new_tour_operator.show', compact('request','images','packages','notifications','unread'));
    }

    public function newTourOperatorRequestApproved(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id', 'tour_operators.created_at as to_created', 'tour_operators.updated_at as to_updated')
            ->where('operator_approval', '=', 'Approved')
            ->orderBy('to_updated', 'desc')
            ->get();

        return view('admin.requests.new_tour_operator.approved.index', compact('requests','notifications','unread'));
    }

    public function showNewTourOperatorRequestApproved($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $images = TourOperator::join('tour_operator_images', 'tour_operators.id', '=', 'tour_operator_id')
            ->select('tour_operator_images.*')
            ->where('tour_operators.id', '=', $id)
            ->get();
        $request = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id')
            ->where('tour_operators.id', '=', $id)
            ->first();
        $packages = TourOperator::join('packages', 'id', '=', 'tour_operator_id')
            ->select('packages.*')
            ->where('id', '=', $id)
            ->get();

        return view('admin.requests.new_tour_operator.approved.show', compact('request','images','packages','notifications','unread'));
    }

    public function newTourOperatorRequestRejected(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $requests = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id', 'tour_operators.created_at as to_created', 'tour_operators.updated_at as to_updated')
            ->where('operator_approval', '=', 'Rejected')
            ->orderBy('to_updated', 'desc')
            ->get();

        return view('admin.requests.new_tour_operator.rejected.index', compact('requests','notifications','unread'));
    }

    public function showNewTourOperatorRequestRejected($id){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);
        $images = TourOperator::join('tour_operator_images', 'tour_operators.id', '=', 'tour_operator_id')
            ->select('tour_operator_images.*')
            ->where('tour_operators.id', '=', $id)
            ->get();
        $request = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.*', 'tour_operators.id as dest_id', 'users.id as user_id')
            ->where('tour_operators.id', '=', $id)
            ->first();
        $packages = TourOperator::join('packages', 'id', '=', 'tour_operator_id')
            ->select('packages.*')
            ->where('id', '=', $id)
            ->get();

//        dd($request);

        return view('admin.requests.new_tour_operator.rejected.show', compact('request','images','packages','notifications','unread'));
    }

//    Approve or Reject Tour Operator

    public function approveNewTourOperatorRequest($id, ApproveTourOperatorRequest $request){
//        for multiple submit buttons in a form, use switch case
        switch ($request->input('submit')) {
            case 'approve':


//        UPDATE STATEMENTS
                TourOperator::where('id', '=', $id)
                    ->update([
                        'operator_company' => $request->input('operator_company'),
                        'operator_operating' => $request->input('operator_operating'),
                        'operator_location' => $request->input('operator_location'),
                        'operator_city' => $request->input('operator_city'),
                        'operator_services' => $request->input('operator_services'),
                        'operator_email' => $request->input('operator_email'),
                        'operator_phone_number' => $request->input('operator_phone'),
                        'operator_fb' => $request->input('operator_fb'),
                        'operator_twitter' => $request->input('operator_twt'),
                        'operator_instagram' => $request->input('operator_ig'),
                        'operator_website' => $request->input('operator_web'),
                        'operator_approval' => 'Approved',
                    ]);

//                IMAGE
//            Replace Image
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $ext = $request->file('image')->getClientOriginalExtension();
                    $fileName1 = $id . 'main' . '.' . $ext;
                    $file->move(public_path('img/tour_operator_main_pic'), $fileName1);
                    $fileName1 = "img/destination_main_pic/" . $fileName1;

                    TourOperator::where('id', '=', $id)
                        ->update([
                            'dest_main_picture' => $fileName1
                        ]);
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

                // Some users delete their entries on the user side when updating, that's why, just fetch
                // the Packages

                // Delete Previous Package
                Package::where('tour_operator_id', '=', $id)->delete();

                // Delete Previous Images
//                TourOperatorImage::where('tour_operator_id', '=', $id)->delete();

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
//            update Package
                if ($request->input('package_name') != null) {
                    foreach($request->input('package_name') as $key => $value) {
                        Package::where('tour_operator_id', '=', $id)
                            ->where('package_name', $value)
                            ->update([
                                'package_description' => $request->input('package_description')[$key],
                                'package_minimum_fee' => $request->input('package_minimum_fee')[$key],
                                'package_rate' => $request->input('package_rate')[$key],
                                'package_itinerary' => $request->input('package_itinerary')[$key],
                                'package_inclusions' => $request->input('package_inclusions')[$key]
                            ]);
                    }
                }
//        INSERT STATEMENTS
                $packages_insert = Package::where('tour_operator_id','=',$id)->get('package_name');

                if ($request->input('package_name') != null) {
                    foreach ($request->input('package_name') as $key => $value) {
                        $checker = 'not found';
                        foreach ($packages_insert as $package){
                            if ($value == $package->package_name){
                                $checker = 'found';
                                break;
                            }
                        }
                        if ($checker == 'not found' && $value != null) {
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
                }

//            ADD APPROVE ACTION TO LOGS and NOTIFICATION

                $operator = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
                    ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id')
                    ->where('tour_operators.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'tour_operator_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' APPROVED a New Tour Operator Request: "'.$operator->operator_company.
                        '" by '.$operator->user_fname.' '.$operator->user_lname,
                    'log_action' => 'Approve Tour Operator'
                ]);

                Notification::create([
                    'tour_operator_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your company "'.$operator->operator_company.'" has been approved. Thank you!',
                    'notif_read' => false
                ]);


                return redirect()->route('admin.requests.new_tour_operator.index')->with('approved','');

            case 'reject':

//            REJECT  TOUR OPERATOR

                TourOperator::where('id', '=', $id)
                    ->update([
                        'operator_reasons' => $request->input('reason'),
                        'operator_approval' => 'Rejected'
                    ]);

                $operator = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
                    ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id')
                    ->where('tour_operators.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'tour_operator_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' REJECTED a New Tour Operator Request: "'.$operator->operator_company.
                        '" by '.$operator->user_type.' '.$operator->user_fname.' '.$operator->user_lname.' for the reason of "'.$operator->operator_reasons.'"',
                    'log_action' => 'Reject Tour Operator'
                ]);

                Notification::create([
                    'tour_operator_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your request "'.$operator->operator_company.'" has been Rejected for the reason of "'.$operator->operator_reasons.'" Thank you!',
                    'notif_read' => false
                ]);

                return redirect()->route('admin.requests.new_tour_operator.index')->with('rejected','');

            case 'save':
//        UPDATE STATEMENTS
                TourOperator::where('id', '=', $id)
                    ->update([
                        'operator_company' => $request->input('operator_company'),
                        'operator_operating' => $request->input('operator_operating'),
                        'operator_location' => $request->input('operator_location'),
                        'operator_city' => $request->input('operator_city'),
                        'operator_services' => $request->input('operator_services'),
                        'operator_email' => $request->input('operator_email'),
                        'operator_phone_number' => $request->input('operator_phone'),
                        'operator_fb' => $request->input('operator_fb'),
                        'operator_twitter' => $request->input('operator_twt'),
                        'operator_instagram' => $request->input('operator_ig'),
                        'operator_website' => $request->input('operator_web'),
                        'operator_approval' => 'Approved',
                    ]);

                // Some users delete their entries on the user side when updating, that's why, just fetch
                // the Packages

                // Delete Previous Package
                Package::where('tour_operator_id', '=', $id)->delete();

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
//            update Package
                if ($request->input('package_name') != null) {
                    foreach($request->input('package_name') as $key => $value) {
                        Package::where('tour_operator_id', '=', $id)
                            ->where('package_name', $value)
                            ->update([
                                'package_description' => $request->input('package_description')[$key],
                                'package_minimum_fee' => $request->input('package_minimum_fee')[$key],
                                'package_rate' => $request->input('package_rate')[$key],
                                'package_inclusions' => $request->input('package_inclusions')[$key],
                                'package_itinerary' => $request->input('package_itinerary')[$key]
                            ]);
                    }
                }

//        INSERT STATEMENTS
                $packages_insert = Package::where('tour_operator_id','=',$id)->get('package_name');

                if ($request->input('package_name') != null) {
                    foreach ($request->input('package_name') as $key => $value) {
                        $checker = 'not found';
                        foreach ($packages_insert as $package){
                            if ($value == $package->package_name){
                                $checker = 'found';
                                break;
                            }
                        }
                        if ($checker == 'not found' && $value != null) {
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
                }

//            ADD EDIT ACTION TO LOGS and NOTIFICATION

                $operator = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
                    ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id')
                    ->where('tour_operators.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'tour_operator_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' EDITED a Tour Operator: "'.$operator->operator_company.
                        '" by '.$operator->user_type.' '.$operator->user_fname.' '.$operator->user_lname,
                    'log_action' => 'Edit Tour Operator'
                ]);

                Notification::create([
                    'tour_operator_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your Company "'.$operator->operator_company.'" has been updated. Thank you!',
                    'notif_read' => false
                ]);


                return redirect()->route('admin.requests.new_tour_operator.approved.index')->with('saved','');

            case 'remove':

//            REMOVE TOUR OPERATOR

                TourOperator::where('id', '=', $id)
                    ->update([
                        'operator_reasons' => $request->input('reason'),
                        'operator_approval' => 'Rejected'
                    ]);

                $operator = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
                    ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id')
                    ->where('tour_operators.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'tour_operator_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' REMOVED a Tour Operator: "'.$operator->operator_company.
                        '" by '.$operator->user_type.' '.$operator->user_fname.' '.$operator->user_lname.' for the reason of "'.$operator->operator_reasons.'"',
                    'log_action' => 'Remove Tour Operator'
                ]);

                Notification::create([
                    'tour_operator_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your company "'.$operator->operator_company.'" has been Removed for the reason of "'.$operator->operator_reasons.'" Thank you!',
                    'notif_read' => false
                ]);

                return redirect()->route('admin.requests.new_tour_operator.approved.index')->with('removed','');

            case 'restore':
//        UPDATE STATEMENTS
                TourOperator::where('id', '=', $id)
                    ->update([
                        'operator_approval' => 'Approved'
                    ]);
//            ADD RESTORE ACTION TO LOGS and NOTIFICATION

                $operator = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
                    ->select('tour_operators.*', 'users.*', 'tour_operators.id as to_id', 'users.id as user_id')
                    ->where('tour_operators.id', '=', $id)->first();
                $admin = User::where('id',Auth::guard('web')->user()->id)->first();

                ActivityLogs::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'tour_operator_id' => $id,
                    'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                        ' RESTORED a Tour Operator: "'.$operator->operator_company.
                        '" by '.$operator->user_type.' '.$operator->user_fname.' '.$operator->user_lname,
                    'log_action' => 'Restore Tour Operator'
                ]);

                Notification::create([
                    'tour_operator_id' => $id,
                    'notif_type' => 'Message',
                    'notif_message' => 'Your company "'.$operator->operator_company.'" has been restored. Thank you!',
                    'notif_read' => false
                ]);


                return redirect()->route('admin.requests.new_tour_operator.rejected.index')->with('restored','');
        }
    }

//    -----------------------------------------------------------------------------------------------------ADMIN ADD DESTINATION

    public function addDestinationIndex(){
        $notifications = helper::adminNotifications();
        $unread = $notifications->where('notif_read',0);

        return view('admin.add_destination.index', compact('notifications','unread'));
    }
    public function addDestinationCreate(CreateDestinationRequest $request)
    {
        $dest_date_opened = $request->input('dest_date_opened');
        $dest_phone = $request->input('dest_phone');
        $dest_email = $request->input('dest_email');
        $dest_fare = $request->input('dest_fare');
        $dest_direction = $request->input('destination_direction');

        if ($dest_phone == "")
            $dest_phone = "not specified";
        if ($dest_email == "")
            $dest_email = "not specified";
        if ($dest_fare == "")
            $dest_fare = "not specified";
        if ($dest_direction == "")
            $dest_direction = "not specified";
//Owner Radio Input
        if (($request->input('owner')) == 'yes') {
            $dest_owner = 1;
        } else {
            $dest_owner = 0;
        }
//Hidden/Famous Radio Input
        if (($request->input('filter')) == 'hidden') {
            $hidden_gem = 1;
            $famous = 0;
        } else if(($request->input('filter')) == 'famous'){
            $hidden_gem = 0;
            $famous = 1;
        }else{
            $hidden_gem = 0;
            $famous = 0;
        }

        $destination = Destination::create([
            'dest_name' => $request->input('destination_name'),
            'user_id' => Auth::guard('web')->user()->id,
            'dest_owner' => $dest_owner,
            'dest_description' => $request->input('destination_description'),
            'dest_date_opened' => $dest_date_opened,
            'dest_working_hours' => $request->input('destination_working_hours'),
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
            'dest_category' => 'Scenery',
            'hidden_gem' => $hidden_gem,
            'famous' => $famous,
            'dest_approval' => 'Approved',
        ]);
        $inserted = $destination->id;
        $submit_destination = $destination->save();
//        Destination Main Picture
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $ext = $request->file('image')->getClientOriginalExtension();
            $fileName1 = $inserted . 'main' . '.' . $ext;
            $file->move(public_path('img/destination_main_pic'), $fileName1);
            $fileName1 = "img/destination_main_pic/" . $fileName1;

            Destination::where('id', '=', $inserted)
                ->update([
                    'dest_main_picture' => $fileName1
                ]);
        }
//        Destination Business Permit
        if ($request->hasFile('business_permit')) {

            $file = $request->file('business_permit');
            $ext = $request->file('business_permit')->getClientOriginalExtension();
            $fileName1 = $inserted . 'main' . '.' . $ext;
            $file->move(public_path('img/destination_business_permit'), $fileName1);
            $fileName1 = "img/destination_business_permit/" . $fileName1;

            Destination::where('id', '=', $inserted)
                ->update([
                    'dest_business_permit' => $fileName1
                ]);
        }

//        INSERTING REPEATING FIELD (Activity, Amenity, Package)

        if ($submit_destination) {
            $counter = 0;
//            insert Destination Images
            foreach ($request->file('images') as $imageFile) {
                $counter++;
                $fileName = $inserted . 'dest_image' . $counter . '.' . $imageFile->getClientOriginalExtension();;
                $imageFile->move(public_path('img/destination_images'), $fileName);
                $fileName = "img/destination_images/" . $fileName;

                DestinationImage::create([
                    'destination_id' => $inserted,
                    'dest_image' => $fileName
                ]);
            }
//            insert Activity
            foreach ($request->input('activity') as $key => $value) {
                $act_pax = $request->input('activity_number_of_pax')[$key];
                $act_fee = $request->input('activity_fee')[$key];
                if ($act_pax == "")
                    $act_pax = "--";
                if ($act_fee == "")
                    $act_fee = "--";
                if ($value != "") {
                    DestinationActivity::create([
                        'destination_id' => $inserted,
                        'activity' => $value,
                        'activity_description' => $request->input('activity_description')[$key],
                        'activity_number_of_pax' => $act_pax,
                        'activity_fee' => $act_fee,
                    ]);
                }
            }
//            insert Amenity
            foreach ($request->input('amenity') as $key => $value) {
                $am_fee = $request->input('amenity_fee')[$key];
                if ($am_fee == "")
                    $am_fee = "--";
                if ($value != "") {
                    DestinationAmenity::create([
                        'destination_id' => $inserted,
                        'amenity' => $value,
                        'amenity_description' => $request->input('amenity_description')[$key],
                        'amenity_fee' => $am_fee,
                    ]);
                }
            }
//            insert Package
            foreach ($request->input('dest_pkg_name') as $key => $value) {
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
                        'destination_id' => $inserted,
                        'dest_pkg_name' => $value,
                        'dest_pkg_description' => $request->input('dest_pkg_description')[$key],
                        'dest_pkg_min_fee' => $dest_pkg_min_fee,
                        'dest_pkg_rate' => $dest_pkg_rate,
                        'dest_pkg_inclusions' => $dest_pkg_inclusions,
                    ]);
                }
            }
            $admin = User::where('id',Auth::guard('web')->user()->id)->first();
            ActivityLogs::create([
                'user_id' => $admin->id,
                'destination_id' => $inserted,
                'log_activity' => $admin->user_type.' '.$admin->user_fname.' '.$admin->user_lname.
                    ' REMOVED a Destination: "'.$destination->dest_name.
                    '" by '.$destination->user_type.' '.$destination->user_fname.' '.$destination->user_lname.' for the reason of "'.$destination->dest_reasons.'"',
                'log_action' => 'Add'
            ]);

            return redirect()->route('admin.requests.new_destination.approved.index')->with('added', '');
        }
    }

//    -----------------------------------------------------------------------------------------------------NOTIFICATION
    /**
     * Update all notification notif_read to 1.
     *
     */
//    public function markAllAsReadAdmin()
//    {
//        $notifications = Notification::leftJoin('destinations','notifications.destination_id','=','destinations.id')
//            ->leftJoin('tour_operators','notifications.tour_operator_id','=','tour_operators.id')
//            ->select('destinations.id as dest_id','destinations.user_id as dest_user','tour_operators.id as to_id','tour_operators.user_id as to_user')
//            ->where('notif_type','Request')
//            ->get();
//        foreach ($notifications as $notification){
//            if ($notification->dest_id != null){
//                Notification::where('destination_id',$notification->dest_id)
//                    ->update([
//                        'notif_read' => 1
//                    ]);
//            }else if ($notification->to_id != null){
//                Notification::where('tour_operator_id',$notification->to_id)
//                    ->update([
//                        'notif_read' => 1
//                    ]);
//            }
//        }
//        return redirect()->back();
//    }
    /**
     * Update clicked notification notif_read to 1.
     *
     */
    public function readClickedNotificationAdmin($id)
    {
        Notification::where('id',$id)
            ->update([
                'notif_read' => 1
            ]);

        $notification = Notification::leftJoin('tour_operators','notifications.tour_operator_id','=','tour_operators.id')
            ->leftJoin('destinations','notifications.destination_id','=','destinations.id')
            ->select('destinations.id as dest_id','dest_approval','tour_operators.id as to_id','operator_approval','notifications.user_id as edit_id')
            ->where('notifications.id',$id)
            ->first();
//        JOIN with composite key
        $table = 'notifications';
        $edit_notification = \DB::table($table)->leftJoin('edit_destination_details', function($join) use ($table){
                                                $join->on($table . '.destination_id', '=',  'edit_destination_details.destination_id');
                                                $join->on($table . '.user_id','=', 'edit_destination_details.user_id');
                                            })
            ->select('edit_dest_approval')
            ->where('notifications.id',$id)
            ->first();

        if ($notification->dest_id != null && $notification->edit_id == null){
            if ($notification->dest_approval == 'Approved'){
                return redirect()->route('admin.requests.new_destination.approved.show',$notification->dest_id);
            }else if ($notification->dest_approval == 'Rejected') {
                return redirect()->route('admin.requests.new_destination.rejected.show', $notification->dest_id);
            }else if ($notification->dest_approval == 'Pending'){
                return redirect()->route('admin.requests.new_destination.show',$notification->dest_id);
            }
        }else if ($notification->to_id != null && $notification->edit_id == null){
            if ($notification->operator_approval == 'Approved'){
                return redirect()->route('admin.requests.new_tour_operator.approved.show',$notification->to_id);
            }else if ($notification->operator_approval == 'Rejected'){
                return redirect()->route('admin.requests.new_tour_operator.rejected.show',$notification->to_id);
            }else if ($notification->operator_approval == 'Pending'){
                return redirect()->route('admin.requests.new_tour_operator.show',$notification->to_id);
            }
        }else if ($notification->edit_id != null){
            if ($edit_notification->edit_dest_approval == 'Approved'){
                return redirect()->route('admin.requests.edit_destination.approved.show',[$notification->dest_id,$notification->edit_id]);
            }else if ($edit_notification->edit_dest_approval == 'Rejected'){
                return redirect()->route('admin.requests.edit_destination.rejected.show',[$notification->dest_id,$notification->edit_id]);
            }else if ($edit_notification->edit_dest_approval == 'Pending'){
                return redirect()->route('admin.requests.edit_destination.show',[$notification->dest_id,$notification->edit_id]);
            }
        }else{
            return redirect()->back();
        }
    }
}
