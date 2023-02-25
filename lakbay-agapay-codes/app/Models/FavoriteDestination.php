<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FavoriteDestination extends Model
{
    use HasFactory;

    public static function countFavoriteDestinations($destination_id){
        $countFavorites = FavoriteDestination::where(['user_id' => Auth::user()->id, 'destination_id' => $destination_id]) ->count();
        return $countFavorites;
    }


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function destination(){
        return $this->belongsTo(Destination::class, 'destination_id');
    }

}
