<?php

namespace App\Http\Controllers;

use App\Models\DestinationRating;
use App\Models\TourOperatorRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    public function addRating(Request $request, TourOperatorRating $tour_operator_rating, DestinationRating $destination_rating)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $id = $request->get('tour_operator_id');
            $des_id = $request->get('destination_id');
            $user_id = Auth::id();
            //echo "<pre>"; print_r($data);die;

//
//            if (!Auth::check()) {
//                $message = "Login first";
//                Session::flash('error_message', $message);
//                return redirect()->back();
//            }

            $validator = Validator::make($request->all(), [
                'rate' => ['required'],
                'review' => ['required'],
                'image_one' => ['nullable', 'image'],
                'image_two' => ['nullable', 'image'],
                'image_three' => ['nullable', 'image']
            ]);


            if (!$validator->passes()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            } else {
                if ($request->has('tour_operator_id')) {
                    $fileName1 = '';

                    if ($request->hasFile('image_one')) {

                        $file = $request->file('image_one');
                        $ext = $request->file('image_one')->getClientOriginalExtension();
                        $fileName1 = $user_id . $id . '1' . '.' . $ext;
                        $file->move(public_path('img/to_reviews'), $fileName1);
                        $fileName1 = "img/to_reviews/" . $fileName1;
                    }

                    $fileName2 = '';

                    if ($request->hasFile('image_two')) {

                        $file = $request->file('image_two');
                        $ext = $request->file('image_two')->getClientOriginalExtension();
                        $fileName2 = $user_id . $id . '2' . '.' . $ext;
                        $file->move(public_path('img/to_reviews'), $fileName2);
                        $fileName2 = "img/to_reviews/" . $fileName2;
                    }

                    $fileName3 = '';

                    if ($request->hasFile('image_three')) {

                        $file = $request->file('image_three');
                        $ext = $request->file('image_three')->getClientOriginalExtension();
                        $fileName3 = $user_id . $id . '3' . '.' . $ext;
                        $file->move(public_path('img/to_reviews'), $fileName3);
                        $fileName3 = "img/to_reviews/" . $fileName3;
                    }


                    $tour_operator_rating->create([
                        'user_id' => $user_id,
                        'tour_operator_id' => $id,
                        'rating_rate' => $request->input('rate'),
                        'rating_review' => $request->input('review'),
                        'rating_picture1' => $fileName1,
                        'rating_picture2' => $fileName2,
                        'rating_picture3' => $fileName3

                    ]);
                }

                if ($request->has('destination_id')) {
                    $fileName1 = '';

                    if ($request->hasFile('image_one')) {

                        $file = $request->file('image_one');
                        $ext = $request->file('image_one')->getClientOriginalExtension();
                        $fileName1 = $user_id . $id . '1' . '.' . $ext;
                        $file->move(public_path('img/destination_reviews'), $fileName1);
                        $fileName1 = "img/destination_reviews/" . $fileName1;
                    }

                    $fileName2 = '';

                    if ($request->hasFile('image_two')) {

                        $file = $request->file('image_two');
                        $ext = $request->file('image_two')->getClientOriginalExtension();
                        $fileName2 = $user_id . $id . '2' . '.' . $ext;
                        $file->move(public_path('img/destination_reviews'), $fileName2);
                        $fileName2 = "img/destination_reviews/" . $fileName2;
                    }

                    $fileName3 = '';

                    if ($request->hasFile('image_three')) {

                        $file = $request->file('image_three');
                        $ext = $request->file('image_three')->getClientOriginalExtension();
                        $fileName3 = $user_id . $id . '3' . '.' . $ext;
                        $file->move(public_path('img/destination_reviews'), $fileName3);
                        $fileName3 = "img/destination_reviews/" . $fileName3;
                    }

                    $destination_rating->create([
                        'user_id' => $user_id,
                        'destination_id' => $des_id,
                        'rating_rate' => $request->input('rate'),
                        'rating_review' => $request->input('review'),
                        'rating_picture1' => $fileName1,
                        'rating_picture2' => $fileName2,
                        'rating_picture3' => $fileName3

                    ]);
                }

                return response()->json(['status' => 1, 'msg' => 'Successful']);

            }

        }
    }
}
