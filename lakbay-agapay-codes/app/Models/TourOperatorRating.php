<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourOperatorRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_operator_id',
        'rating_rate',
        'rating_review',
        'rating_picture1',
        'rating_picture2',
        'rating_picture3'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
