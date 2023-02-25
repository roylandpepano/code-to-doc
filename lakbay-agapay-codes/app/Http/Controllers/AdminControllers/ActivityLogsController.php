<?php

namespace App\Http\Controllers\AdminControllers;

use App\Helper\helper;
use App\Http\Controllers\Controller;
use App\Models\ActivityLogs;
use App\Models\EditDestination;
use App\Models\Notification;
use App\Models\TourOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if(Auth::guard('web')->user()->user_type == 'Super Admin'){
            $notifications = helper::adminNotifications();
            $unread = $notifications->where('notif_read',0);


            $table = 'activity_logs';
            $logs = ActivityLogs::join('users', 'activity_logs.user_id', '=', 'users.id')
                ->leftJoin('destinations', 'activity_logs.destination_id', '=', 'destinations.id')
                ->leftJoin('tour_operators', 'activity_logs.tour_operator_id', '=', 'tour_operators.id')
                ->leftJoin('edit_destination_details', function($join) use ($table){
                    $join->on($table . '.destination_id', '=',  'edit_destination_details.destination_id');
                    $join->on($table . '.editor','=', 'edit_destination_details.user_id');
                })
                ->select('activity_logs.*', 'destinations.id as dest_id', 'destinations.dest_name', 'dest_approval', 'users.id as user_id', 'users.user_fname',
                    'users.user_lname', 'users.user_type', 'tour_operators.id as to_id', 'tour_operators.operator_approval',
                    'destinations.created_at as dest_created', 'destinations.updated_at as dest_updated', 'activity_logs.created_at as logs_created',
                    'edit_dest_approval')
                ->orderBy('activity_logs.id', 'DESC')
                ->get();

            $tour_operators = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
                ->select('users.user_fname', 'users.user_lname','tour_operators.id as to_id','operator_company', 'tour_operators.created_at as to_created')
                ->get();

            return view('admin.logs.index', compact('logs','notifications','unread','tour_operators'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
