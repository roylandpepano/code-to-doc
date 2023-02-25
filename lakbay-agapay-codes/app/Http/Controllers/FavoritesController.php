<?php

namespace App\Http\Controllers;

use App\Models\FavoriteDestination;
use App\Models\FavoriteTourOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoritesController extends Controller
{

    public function updateFavorites(Request $request){
        if($request->ajax()){
            if ($request->has('tour_operator_id')) {
                $data = $request->all();
                $countFavorites = FavoriteTourOperator::countFavoriteOperators($data['tour_operator_id']);
                $favoriteOperators = new FavoriteTourOperator;

                if ($countFavorites == 0) {
                    $favoriteOperators->tour_operator_id = $data['tour_operator_id'];
                    $favoriteOperators->user_id = $data['user_id'];
                    $favoriteOperators->save();
                    return response()->json(['action' => 'add', 'message' => 'has been successfully added to your favorites.']);
                } else {
                    FavoriteTourOperator::where(['user_id' => Auth::user()->id, 'tour_operator_id' => $data['tour_operator_id']])->delete();
                    return response()->json(['action' => 'remove', 'message' => 'has been successfully removed from your favorites.']);
                }
            }

            if ($request->has('destination_id')) {
                $data = $request->all();
                $countFavorites = FavoriteDestination::countFavoriteDestinations($data['destination_id']);
                $favoriteDestinations = new FavoriteDestination;

                if ($countFavorites == 0) {
                    $favoriteDestinations->destination_id = $data['destination_id'];
                    $favoriteDestinations->user_id = $data['user_id'];
                    $favoriteDestinations->save();
                    return response()->json(['action' => 'add', 'message' => 'has been successfully added to your favorites.']);
                } else {
                    FavoriteDestination::where(['user_id' => Auth::user()->id, 'destination_id' => $data['destination_id']])->delete();
                    return response()->json(['action' => 'remove', 'message' => 'has been successfully removed from your favorites.']);
                }
            }
        }
    }
}
