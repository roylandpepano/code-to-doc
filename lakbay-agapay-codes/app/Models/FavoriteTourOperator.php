<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FavoriteTourOperator extends Model
{
    use HasFactory;

    public static function countFavoriteOperators($tour_operator_id){
        $countFavorites = FavoriteTourOperator::where(['user_id' => Auth::user()->id, 'tour_operator_id' => $tour_operator_id]) ->count();
        return $countFavorites;
    }


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function touroperator(){
        return $this->belongsTo(TourOperator::class, 'tour_operator_id');
    }

}
