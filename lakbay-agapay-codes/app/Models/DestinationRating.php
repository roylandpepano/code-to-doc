<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationRating extends Model
{
    use HasFactory;
    protected $table = 'destination_ratings';
    protected $fillable = [
        'user_id',
        'destination_id',
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
