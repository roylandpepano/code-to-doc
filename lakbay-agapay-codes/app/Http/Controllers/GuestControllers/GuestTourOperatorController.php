<?php

namespace App\Http\Controllers\GuestControllers;

use App\Models\TourOperatorImage;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\TourOperator;
use App\Models\TourOperatorRating;
use Illuminate\Support\Facades\Auth;


class GuestTourOperatorController extends Controller
{
    public function index()
    {
        $queryTour = ['operator_approval' => 'Approved'];
        $tour_operators = TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
            ->select('tour_operators.*', 'users.user_picture')
            ->where($queryTour)
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

        $option = '';
        $order = '';

        $suggested = TourOperator::all()->random(3)->values();
        $numbers = range(0, 2);
        shuffle($numbers);
        $final = array_slice($numbers, 0, 3);
        $rand1 = $suggested[$final[0]];
        $rand2 = $suggested[$final[1]];
        $rand3 = $suggested[$final[2]];

        return view('guest.tour_operator.index', compact('tour_operators','rand1','rand2','rand3', 'option', 'order'));
    }

    public function show(Request $request, $id)
    {
        $operator_images = TourOperatorImage::where('tour_operator_id',$id)->get();
        $operator_item = TourOperator::find($id);
        //Visitor Counter
        if(!Visitor::where('visitor',session()->getId())->where('page_name',$operator_item->operator_company)->exists()) {
            Visitor::create([
                'visitor' => session()->getId(),
                'tour_operator_id' => $id,
                'page_name' => $operator_item->operator_company
            ]);
        }
        $i = 1;
        $packages = Package::where('tour_operator_id', $id)->orderBy('package_name')->paginate(3, ['*'], 'packages');

        $rate_one = TourOperatorRating::where('tour_operator_id', $id)->where('rating_rate', 1)->get();
        $rate_two = TourOperatorRating::where('tour_operator_id', $id)->where('rating_rate', 2)->get();
        $rate_three = TourOperatorRating::where('tour_operator_id', $id)->where('rating_rate', 3)->get();
        $rate_four = TourOperatorRating::where('tour_operator_id', $id)->where('rating_rate',4)->get();
        $rate_five = TourOperatorRating::where('tour_operator_id', $id)->where('rating_rate', 5)->get();

        $count_one = $rate_one->count();
        $count_two = $rate_two->count();
        $count_three = $rate_three->count();
        $count_four = $rate_four->count();
        $count_five = $rate_five->count();
        $total = $count_one + $count_two + $count_three + $count_four + $count_five;

        if($total > 0) {
            $average = TourOperatorRating::where('tour_operator_id', $id)->avg('rating_rate');
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
        $rate = TourOperatorRating::where('tour_operator_id', $id)->orderBy('created_at', 'desc')->paginate(3, ['*'], 'rate');
        $user_id = Auth::id();
        $findReview = TourOperatorRating::where(['user_id' => $user_id, 'tour_operator_id' => $id])->get();
        $findReview = count($findReview);

        if($request->ajax()) {
            $rate = TourOperatorRating::where('tour_operator_id', $id)->orderBy('created_at', 'desc')->paginate(3, ['*'], 'rate');

            if (request('id') == 0) {
                return view('reviews_pagination', compact('operator_item', 'i', 'packages', 'rate', 'rate_one', 'rate_two', 'rate_three',
                    'rate_four', 'rate_five', 'count_one', 'count_two', 'count_three', 'count_four', 'count_five', 'total', 'average', 'rate_average', 'average_one', 'average_two', 'average_three',
                    'average_four', 'average_five', 'rate', 'findReview'))->render();
            }
            if (request('id') == 1) {
                return view('to_packages', compact('operator_item','operator_images', 'i', 'packages', 'rate', 'rate_one', 'rate_two', 'rate_three',
                    'rate_four', 'rate_five', 'count_one', 'count_two', 'count_three', 'count_four', 'count_five', 'total', 'average', 'rate_average', 'average_one', 'average_two', 'average_three',
                    'average_four', 'average_five', 'rate', 'findReview'))->render();
            }
        }

        return view('guest.tour_operator.show', compact('operator_item','operator_images','i','packages', 'rate', 'rate_one', 'rate_two', 'rate_three',
            'rate_four', 'rate_five', 'count_one', 'count_two', 'count_three', 'count_four', 'count_five', 'total','average','rate_average', 'average_one', 'average_two', 'average_three',
            'average_four', 'average_five', 'rate', 'findReview'));
    }
}
