<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourOperatorImage extends Model
{
    use HasFactory;

//    /**
//     * @var false|mixed|string
//     */
    protected $table = 'tour_operator_images';
    protected $fillable = [
        'tour_operator_id',
        'operator_image'
    ];
}
